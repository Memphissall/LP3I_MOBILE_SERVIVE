<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KelasSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('kelas')->insert([
            [
                'nama_kelas' => 'A - Pemrograman Web',
                'jurusan' => 'Teknik Informatika',
                'nama_pa' => 'Dr. Budi',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_kelas' => 'B - Basis Data',
                'jurusan' => 'Sistem Informasi',
                'nama_pa' => 'Ibu Sari',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_kelas' => 'C - Jaringan Komputer',
                'jurusan' => 'Teknik Komputer',
                'nama_pa' => 'Pak Andi',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
