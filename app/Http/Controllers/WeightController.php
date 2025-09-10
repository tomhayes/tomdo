<?php

namespace App\Http\Controllers;

use App\Models\WeightEntry;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Inertia\Inertia;

class WeightController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'weight_lbs' => 'required|numeric|min:1|max:999',
            'recorded_at' => 'required|date'
        ]);
        
        // Update or create - prevent duplicates for same day
        $weightEntry = WeightEntry::updateOrCreate(
            [
                'user_id' => auth()->id(),
                'recorded_at' => $request->recorded_at
            ],
            [
                'weight_lbs' => $request->weight_lbs
            ]
        );
        
        Log::info('Weight data received', [
            'user_id' => auth()->id(),
            'weight' => $request->weight_lbs,
            'recorded_at' => $request->recorded_at
        ]);
        
        return response()->json([
            'success' => true,
            'message' => 'Weight recorded successfully',
            'data' => $weightEntry
        ]);
    }

    public function dashboard()
    {
        $weightEntries = auth()->user()
            ->weightEntries()
            ->orderBy('recorded_at', 'desc')
            ->limit(30) // Last 30 entries
            ->get();
            
        $stats = [
            'current_weight' => $weightEntries->first()?->weight_lbs,
            'total_entries' => $weightEntries->count(),
            'date_range' => [
                'earliest' => $weightEntries->last()?->recorded_at?->format('M j, Y'),
                'latest' => $weightEntries->first()?->recorded_at?->format('M j, Y'),
            ]
        ];
        
        return Inertia::render('Weight/Dashboard', [
            'weightEntries' => $weightEntries,
            'stats' => $stats
        ]);
    }
    
    public function index(Request $request)
    {
        $limit = $request->get('limit', 30); // Default last 30 entries
        
        $entries = auth()->user()
            ->weightEntries()
            ->orderBy('recorded_at', 'desc')
            ->limit($limit)
            ->get();
        
        return response()->json($entries);
    }
    
    public function latest()
    {
        $latest = auth()->user()->latestWeight;
        
        return response()->json([
            'latest_weight' => $latest,
            'has_weight_data' => !is_null($latest)
        ]);
    }
    
    public function getDashboardData()
    {
        return auth()->user()
            ->weightEntries()
            ->orderBy('recorded_at', 'desc')
            ->limit(30)
            ->get();
    }
}