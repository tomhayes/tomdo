<?php 

use App\Http\Controllers\WeightController;

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/weight', [WeightController::class, 'store']);
    Route::get('/weight', [WeightController::class, 'index']);
    Route::get('/weight/latest', [WeightController::class, 'latest']);
});