<?php

namespace App\Http\Controllers;

use App\Services\HabiticaService;
use Illuminate\Http\Request;

class TodoController extends Controller
{
    public function __construct(private HabiticaService $habiticaService)
    {
    }
    
    public function index()
    {
        $todos = $this->habiticaService->getTodos();
        
        return view('todos.index', compact('todos'));
    }
}
