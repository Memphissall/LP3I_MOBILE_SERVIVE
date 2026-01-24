<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RuanganSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('ruangan')->insert([
            [
                'id_ruangan' => 101,
                'nama_ruangan' => 'Lab Komputer 1',
                'kapasitas' => 30,
                'status' => 'Tersedia',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_ruangan' => 102,
                'nama_ruangan' => 'Lab Komputer 2',
                'kapasitas' => 35,
                'status' => 'Tersedia',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_ruangan' => 103,
                'nama_ruangan' => 'Kelas Teori 1',
                'kapasitas' => 40,
                'status' => 'Digunakan',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
