<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class JadwalSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('jadwal')->insert([
            [
                'id_ruangan'   => 'R101',
                'nidn'         => '1234567890',  // Dosen Satu
                'id_kelas'     => 1,             // Pastikan kelas id=1 ada
                'kode_mk'      => 'AIS001',      // Pastikan MK001 ada
                'hari'         => 'Senin',
                'jam_mulai'    => '08:00:00',
                'jam_selesai'  => '09:30:00',
                'created_at'   => now(),
                'updated_at'   => now(),
            ],
            [
                'id_ruangan'   => 'R102',
                'nidn'         => '2345678901',  // Dosen Dua
                'id_kelas'     => 2,
                'kode_mk'      => 'ASE001',
                'hari'         => 'Selasa',
                'jam_mulai'    => '10:00:00',
                'jam_selesai'  => '11:30:00',
                'created_at'   => now(),
                'updated_at'   => now(),
            ],
            [
                'id_ruangan'   => 'R103',
                'nidn'         => '3456789012', // Dosen Tiga
                'id_kelas'     => 3,
                'kode_mk'      => 'OAA001',
                'hari'         => 'Rabu',
                'jam_mulai'    => '13:00:00',
                'jam_selesai'  => '14:30:00',
                'created_at'   => now(),
                'updated_at'   => now(),
            ],
        ]);
    }
}
