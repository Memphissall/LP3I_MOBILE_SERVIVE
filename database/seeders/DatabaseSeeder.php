<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            // ===== USER & AUTH =====
            UsersSeeder::class,        // ⬅️ WAJIB PERTAMA
            SuperAdminSeeder::class,  // ⬅️ ADMIN

            // ===== MASTER DATA =====
            ProgramStudiSeeder::class,
            
            RuanganSeeder::class,
            KelasSeeder::class,
            MataKuliahSeeder::class,

            // ===== AKTOR =====
            PendidikSeeder::class,       // ⬅️ BUTUH users
            MahasiswaSeeder::class,

            // ===== TRANSAKSI =====
            JadwalSeeder::class,
        ]);
    }
}
