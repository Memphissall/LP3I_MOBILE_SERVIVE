<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Clear existing users (optional)
        // User::truncate();

        $users = [
            [
                'name' => 'Ari Aprianto',
                'email' => 'ari@kampus.test',
                'password' => Hash::make('password123'),
                'role' => 'mahasiswa',
                'is_active' => 1,
            ],
            [
                'name' => 'Esa Nabila Cahyani',
                'email' => 'esa@kampus.test',
                'password' => Hash::make('password123'),
                'role' => 'mahasiswa',
                'is_active' => 1,
            ],
            [
                'name' => 'Novi Imawati',
                'email' => 'novi@kampus.test',
                'password' => Hash::make('password123'),
                'role' => 'mahasiswa',
                'is_active' => 1,
            ],
            // Admin user untuk testing
            [
                'name' => 'Admin E-Academic',
                'email' => 'admin@kampus.test',
                'password' => Hash::make('admin123'),
                'role' => 'admin',
                'is_active' => 1,
            ],
        ];

        foreach ($users as $userData) {
            User::updateOrCreate(
                ['email' => $userData['email']], // Find by email
                $userData // Insert/update with this data
            );
        }

        $this->command->info('UserSeeder: ' . count($users) . ' users seeded successfully!');
    }
}
