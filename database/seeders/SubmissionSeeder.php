<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class SubmissionSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('submission')->insert([
            [
                'file_tugas' => 'tugas_ahmad.pdf',
                'id_tugas' => 1,
                'id_mahasiswa' => 1,
                'status' => 'Dikumpulkan',
                'submitted_at' => Carbon::now()->subHours(2),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'file_tugas' => 'tugas_siti.pdf',
                'id_tugas' => 1,
                'id_mahasiswa' => 2,
                'status' => 'Terlambat',
                'submitted_at' => Carbon::now(),
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ]);
    }
}