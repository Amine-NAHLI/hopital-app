<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'name' => 'Admin Principal',
            'email' => 'admin@hopital.ma',
            'password' => Hash::make('password123'),
            'role' => 'admin',
        ]);

        User::create([
            'name' => 'Dr. Karim Bennani',
            'email' => 'karim@hopital.ma',
            'password' => Hash::make('password123'),
            'role' => 'medecin',
        ]);

        User::create([
            'name' => 'Dr. Sara Alami',
            'email' => 'sara@hopital.ma',
            'password' => Hash::make('password123'),
            'role' => 'medecin',
        ]);

        User::create([
            'name' => 'Dr. Youssef Tazi',
            'email' => 'youssef@hopital.ma',
            'password' => Hash::make('password123'),
            'role' => 'medecin',
        ]);
    }
}