<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class KelasMatkulSeeder extends Seeder
{
    public function run()
    {
        // Matakuliah dummy
        DB::table('matakuliah')->insert([
            [
                'kode_mk' => 'MK001',
                'nama_mk' => 'Pemrograman Web',
                'sks' => 3,
                'semester' => '5',
                'sap' => 'SAP Pemrograman Web',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'kode_mk' => 'MK002',
                'nama_mk' => 'Basis Data',
                'sks' => 3,
                'semester' => '4',
                'sap' => 'SAP Basis Data',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'kode_mk' => 'MK003',
                'nama_mk' => 'Jaringan Komputer',
                'sks' => 3,
                'semester' => '5',
                'sap' => 'SAP Jaringan',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);

        // Kelas dummy (setiap kelas refer ke salah satu kode_mk)
        DB::table('kelas')->insert([
            [
                'kode_mk' => 'MK001',
                'nama_kelas' => 'A - Pemrograman Web',
                'jurusan' => 'Teknik Informatika',
                'tahun_ajaran' => '2024/2025',
                'nama_pa' => 'Dr. Budi',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'kode_mk' => 'MK002',
                'nama_kelas' => 'B - Basis Data',
                'jurusan' => 'Sistem Informasi',
                'tahun_ajaran' => '2024/2025',
                'nama_pa' => 'Ibu Sari',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'kode_mk' => 'MK003',
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
