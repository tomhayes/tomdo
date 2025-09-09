<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WeightEntry extends Model
{
    protected $fillable = [
        'user_id',
        'weight_lbs',
        'recorded_at'
    ];
    
    protected $casts = [
        'recorded_at' => 'datetime',
        'weight_lbs' => 'decimal:2'
    ];
    
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    
    // Helper methods for different units
    public function getWeightKgsAttribute()
    {
        return round($this->weight_kg / 2.20462, 1);
    }
    
    public function getFormattedWeightAttribute()
    {
        return $this->weight_lbs . ' lbs';
    }
}
