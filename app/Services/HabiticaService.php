<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Client\ConnectionException;

class HabiticaService
{
    public function getTodos()
    {
        try {
            $response = Http::timeout(10) // Add timeout
                ->withHeaders([
                    'x-api-user' => config('services.habitica.user_id'),
                    'x-api-key' => config('services.habitica.api_token'),
                    'x-client' => 'tomdo-laravel-1.0.0',
                ])
                ->get(config('services.habitica.base_url') . '/tasks/user', [
                    'type' => 'todos'
                ]);
            
            if ($response->successful()) {
                return $response->json('data') ?? [];
            }
            
            // Log the error for debugging
            Log::warning('Habitica API error', [
                'status' => $response->status(),
                'body' => $response->body()
            ]);
            
            return [];
            
        } catch (ConnectionException $e) {
            Log::error('Failed to connect to Habitica API', ['error' => $e->getMessage()]);
            return [];
        }
    }
}