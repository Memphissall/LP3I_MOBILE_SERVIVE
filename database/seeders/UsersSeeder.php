<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsersSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('users')->insert([
            [
                'name' => 'Siswanto',
                'email' => 'dosen1@example.com',
                'password' => Hash::make('12345678'),
                'role' => 'dosen',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Acang',
                'email' => 'dosen2@example.com',
                'password' => Hash::make('DosenDua@123'),
                'role' => 'dosen',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Mia',
                'email' => 'dosen3@example.com',
                'password' => Hash::make('DosenTiga@123'),
                'role' => 'user',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
