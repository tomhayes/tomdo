@extends('layouts.app')

@section('content')
<div class="container">
    <h1>My Habitica Todos</h1>
    
    @if(empty($todos))
        <div class="alert alert-info">
            <p>No todos found. Either you have no todos in Habitica, or there was an issue connecting to the API.</p>
        </div>
    @else
        <div class="row">
            @foreach($todos as $todo)
                <div class="col-md-6 mb-3">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">{{ $todo['text'] }}</h5>
                            
                            @if(!empty($todo['notes']))
                                <p class="card-text">{{ $todo['notes'] }}</p>
                            @endif
                            
                            <div class="d-flex justify-content-between align-items-center">
                                <span class="badge {{ $todo['completed'] ? 'bg-success' : 'bg-warning' }}">
                                    {{ $todo['completed'] ? 'Completed' : 'Pending' }}
                                </span>
                                
                                @if(!empty($todo['date']))
                                    <small class="text-muted">Due: {{ \Carbon\Carbon::parse($todo['date'])->format('M j, Y') }}</small>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</div>
@endsection