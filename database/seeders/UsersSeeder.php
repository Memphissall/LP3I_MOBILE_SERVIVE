<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsersSeeder extends Seeder
{
    public function run(): void
    {
        $users = [
            [
                'name' => 'Siswanto',
                'email' => 'pendidik1@example.com',
                'password' => Hash::make('12345678'),
                'role' => 'pendidik',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Acang',
                'email' => 'pendidik2@example.com',
                'password' => Hash::make('12345678'),
                'role' => 'pendidik',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Mia',
                'email' => 'pendidik3@example.com',
                'password' => Hash::make('PendidikTiga@123'),
                'role' => 'user',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        foreach ($users as $user) {
            DB::table('users')->updateOrInsert(['email' => $user['email']], $user);
        }
    }
}
