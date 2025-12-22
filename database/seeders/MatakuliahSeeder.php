<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class MataKuliahSeeder extends Seeder
{
    public function run(): void
    {
        /* ==========================
           INSERT MATAKULIAH
        =========================== */
        DB::table('matakuliah')->insert([
            [
                'kode_mk' => 'MK001',
                'nama_mk' => 'Pemrograman Web',
                'sks' => 3,
                'semester' => 5,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'kode_mk' => 'MK002',
                'nama_mk' => 'Basis Data',
                'sks' => 3,
                'semester' => 4,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'kode_mk' => 'MK003',
                'nama_mk' => 'Jaringan Komputer',
                'sks' => 3,
                'semester' => 5,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'kode_mk' => 'MK004',
                'nama_mk' => 'Agama',
                'sks' => 2,
                'semester' => 1,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ]);

        /* ==========================
           RELASI KELAS ↔ MATAKULIAH
        =========================== */
        DB::table('kelas_matakuliah')->insert([
            // kelas 1
            ['id_kelas' => 1, 'kode_mk' => 'MK001'],
            ['id_kelas' => 1, 'kode_mk' => 'MK002'],
            ['id_kelas' => 1, 'kode_mk' => 'MK004'],

            // kelas 2
            ['id_kelas' => 2, 'kode_mk' => 'MK002'],
            ['id_kelas' => 2, 'kode_mk' => 'MK004'],

            // kelas 3
            ['id_kelas' => 3, 'kode_mk' => 'MK003'],
            ['id_kelas' => 3, 'kode_mk' => 'MK004'],
        ]);
    }
}
