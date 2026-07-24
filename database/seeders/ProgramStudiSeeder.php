<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProgramStudiSeeder extends Seeder
{
    public function run(): void
    {
        $items = [
            [
                'id_program_studi' => 1,
                'nama_program_studi' => 'Accounting Information System',
                'kode_program_studi' => 'AIS',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_program_studi' => 2,
                'nama_program_studi' => 'Application Software Engineering',
                'kode_program_studi' => 'ASE',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_program_studi' => 3,
                'nama_program_studi' => 'Office Administration Automation',
                'kode_program_studi' => 'OAA',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        foreach ($items as $item) {
            DB::table('program_studi')->updateOrInsert(['id_program_studi' => $item['id_program_studi']], $item);
        }
    }
}
