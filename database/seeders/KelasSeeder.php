<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class KelasSeeder extends Seeder
{
    public function run()
    {

        // Kelas dummy (setiap kelas refer ke salah satu kode_mk)
        DB::table('kelas')->insert([
            [
                'nama_kelas' => 'A - Pemrograman Web',
                'jurusan' => 'Teknik Informatika',
                'tahun_ajaran' => '2024/2025',
                'nama_pa' => 'Dr. Budi',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_kelas' => 'B - Basis Data',
                'jurusan' => 'Sistem Informasi',
                'tahun_ajaran' => '2024/2025',
                'nama_pa' => 'Ibu Sari',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_kelas' => 'C - Jaringan',
                'jurusan' => 'Teknik Komputer',
                'tahun_ajaran' => '2024/2025',
                'nama_pa' => 'Pak Andi',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
