<?php

namespace App\Http\Controllers;

use App\Services\HabiticaService;
use Illuminate\Http\Request;
use Inertia\Inertia;

class TodoController extends Controller
{
    public function __construct(private HabiticaService $habiticaService)
    {
    }
    
    public function index()
    {
        $todos = $this->habiticaService->getTodos();
        
        return Inertia::render('Todos/Index', [
            'todos' => $todos
        ]);
    }
}
