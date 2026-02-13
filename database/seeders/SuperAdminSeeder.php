<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class SuperAdminSeeder extends Seeder
{
    public function run(): void
    {
        User::updateOrCreate(
            ['email' => 'adminlp3i@gmail.com'],
            [
                'name' => 'Admin Akademik LP3I',
                'username' => 'admin',
                'password' => Hash::make('12345678'),
                'role' => 'admin',
            ]
        );
    }
}
