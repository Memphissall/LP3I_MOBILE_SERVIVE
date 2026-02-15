<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MataKuliahSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('matakuliah')->insert([
            [
                'kode_mk'   => 'AIS001',
                'nama_mk'   => 'Pengantar Akuntansi',
                'semester'  => 1,
                'sks'       => 2,
                'deskripsi' => 'Mata kuliah pengenalan dasar akuntansi',
                'sap'       => 1, // Menggunakan integer
                'created_at'=> now(),
                'updated_at'=> now(),
            ],
            [
                'kode_mk'   => 'AIS002',
                'nama_mk'   => 'Akuntansi Keuangan',
                'semester'  => 1,
                'sks'       => 4,
                'deskripsi' => 'Mata kuliah akuntansi keuangan dasar',
                'sap'       => 2, // Menggunakan integer
                'created_at'=> now(),
                'updated_at'=> now(),
            ],
            [
                'kode_mk'   => 'ASE001',
                'nama_mk'   => 'Web Programming 1',
                'semester'  => 1,
                'sks'       => 4,
                'deskripsi' => 'Pemrograman web dasar menggunakan HTML, CSS, dan PHP',
                'sap'       => 3, // Menggunakan integer
                'created_at'=> now(),
                'updated_at'=> now(),
            ],
        ]);
    }
}