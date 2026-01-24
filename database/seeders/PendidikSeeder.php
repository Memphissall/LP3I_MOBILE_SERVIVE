<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PendidikSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('pendidik')->insert([
            [
                'id_user' => 1,
                'nama_pendidik' => 'Pendidik Satu',
                'pendidikan' => 'S2',
                'bidang' => 'Informatika',
                'tempat_lahir' => 'Jakarta',
                'tgl_lahir' => '1980-01-01',
                'jenis_kelamin' => 'Laki-laki',
                'agama' => 'Islam',
                'email' => 'pendidik1@example.com',
                'no_tlp' => '081234567890',
                'rate_gaji' => 100000,
                'status' => 'Aktif',
                'foto' => null,
                'total_gaji_diterima' => 0,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_user' => 2,
                'nama_pendidik' => 'Pendidik Dua',
                'pendidikan' => 'S1',
                'bidang' => 'Sistem Informasi',
                'tempat_lahir' => 'Bandung',
                'tgl_lahir' => '1985-02-02',
                'jenis_kelamin' => 'perempuan',
                'agama' => 'Islam',
                'email' => 'pendidik2@example.com',
                'no_tlp' => '081234567891',
                'rate_gaji' => 120000,
                'status' => 'Aktif',
                'foto' => null,
                'total_gaji_diterima' => 0,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
