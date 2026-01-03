<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KelasSeeder extends Seeder
{
    public function run()
    {
        // Ingat Bubub: Kolom 'jurusan' sudah tidak ada, diganti 'id_bidang_keahlian'
        // Isinya harus ANGKA (Integer), bukan teks.
        
        DB::table('kelas')->insert([
            [
                'nama_kelas' => 'A - Pemrograman Web',
                'id_bidang_keahlian' => 1, // Asumsi 1 = Teknik Informatika
                'tahun_ajaran' => '2024/2025',
                'nama_pa' => 'Dr. Budi',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_kelas' => 'B - Basis Data',
                'id_bidang_keahlian' => 2, // Asumsi 2 = Sistem Informasi
                'tahun_ajaran' => '2024/2025',
                'nama_pa' => 'Ibu Sari',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_kelas' => 'C - Jaringan',
                'id_bidang_keahlian' => 3, // Asumsi 3 = Teknik Komputer
                'tahun_ajaran' => '2024/2025',
                'nama_pa' => 'Pak Andi',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}