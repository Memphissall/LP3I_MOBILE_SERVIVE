<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class JadwalSeeder extends Seeder
{
    public function run(): void
    {
        $items = [
            [
                'hari' => 'Senin',
                'jam_mulai' => '08:00',
                'jam_selesai' => '09:30',
                'semester' => 1,
                'id_mk' => 1,
                'id_pendidik' => 1,
                'id_kelas' => 1,
                'id_ruangan' => 101,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'hari' => 'Selasa',
                'jam_mulai' => '10:00',
                'jam_selesai' => '11:30',
                'semester' => 1,
                'id_mk' => 2,
                'id_pendidik' => 2,
                'id_kelas' => 2,
                'id_ruangan' => 102,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        foreach ($items as $item) {
            DB::table('jadwal')->updateOrInsert(
                [
                    'hari' => $item['hari'],
                    'jam_mulai' => $item['jam_mulai'],
                    'id_kelas' => $item['id_kelas'],
                ],
                $item
            );
        }
    }
}

