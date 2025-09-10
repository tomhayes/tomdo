<?php

use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\TodoController;
use App\Services\HabiticaService;
use App\Http\Controllers\WeightController;

Route::middleware('auth')->group(function () {
    Route::get('/todos', [TodoController::class, 'index'])->name('todos.index');
    Route::get('/weight', [WeightController::class, 'dashboard'])->name('weight.dashboard');
});

Route::get('/', function () {
    return Inertia::render('Welcome');
})->name('home');

Route::get('dashboard', function (HabiticaService $habiticaService, WeightController $weightController) {
    $todos = $habiticaService->getTodos();
    $dailys = $habiticaService->getDailys();
    $weight = $weightController->getDashboardData();
    
    return Inertia::render('Dashboard', [
        'todos' => $todos,
        'dailys' => $dailys,
        'weight' => $weight
    ]);
})->middleware(['auth', 'verified'])->name('dashboard');

require __DIR__.'/settings.php';
require __DIR__.'/auth.php';
