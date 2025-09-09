<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::firstOrCreate([
            'email' => 'hello@tomhay.es'
        ], [
            'name' => 'Tom',
            'email' => 'hello@tomhay.es',
            'password' => Hash::make('updatethispassword'),
            'email_verified_at' => now(),
        ]);
    }
}
