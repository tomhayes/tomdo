<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('weight_entries', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained();
            $table->decimal('weight_lbs', 5, 2); // Max 999.99 lbs
            $table->timestamp('recorded_at');
            $table->timestamps();
            
            $table->index(['user_id', 'recorded_at']);
            // Prevent duplicate entries for same user on same day
            $table->unique(['user_id', 'recorded_at']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('weight_entries');
    }
};
