<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RuanganSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $ruangan = [
            [
                'kode_ruangan' => 'R001',
                'nama_ruangan' => 'Bill Gates',
                'kapasitas' => 30,
                'status' => 'Tersedia',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'kode_ruangan' => 'R002',
                'nama_ruangan' => 'Soekarno',
                'kapasitas' => 15,
                'status' => 'Tersedia',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'kode_ruangan' => 'R003',
                'nama_ruangan' => 'BJ Habibie',
                'kapasitas' => 40,
                'status' => 'Tersedia',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'kode_ruangan' => 'R004',
                'nama_ruangan' => 'Crown',
                'kapasitas' => 25,
                'status' => 'Tersedia',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'kode_ruangan' => 'R005',
                'nama_ruangan' => 'Pullman',
                'kapasitas' => 25,
                'status' => 'Tersedia',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        DB::table('ruangan')->insert($ruangan);
    }
}
