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
                'nama_kelas' => 'AIS',
                'bidang_keahlian' => 'Accounting Information System',
                'nama_pa' => 'MR YUGA',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_kelas' => 'ASE-10',
                'bidang_keahlian' => 'Application Software Engineering',
                'nama_pa' => 'MR EKO',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_kelas' => 'OAA13-A',
                'bidang_keahlian' => 'Office Administration Automatizion',
                'nama_pa' => 'MISS NISA',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
