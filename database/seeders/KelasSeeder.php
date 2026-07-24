<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KelasSeeder extends Seeder
{
    public function run(): void
    {
        $items = [
            [
                'nama_kelas' => 'AIS',
                'nama_pa' => 'MR YUGA',
                'id_program_studi' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_kelas' => 'ASE-10',
                'nama_pa' => 'MR EKO',
                'id_program_studi' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_kelas' => 'OAA13-A',
                'nama_pa' => 'MISS NISA',
                'id_program_studi' => 3,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        foreach ($items as $item) {
            DB::table('kelas')->updateOrInsert(['nama_kelas' => $item['nama_kelas']], $item);
        }
    }
}
