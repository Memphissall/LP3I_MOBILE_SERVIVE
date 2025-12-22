<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DosenSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('dosen')->insert([
            [
                'user_id' => 1,
                'nidn' => '1234567890',
                'nama_dosen' => 'Dosen Satu',
                'pendidikan' => 'S2',
                'bidang' => 'Informatika',
                'tempat' => 'Jakarta',
                'tanggal_lahir' => '1980-01-01',
                'jenis_kelamin' => 'Laki-laki',
                'agama' => 'Islam',
                'email' => 'dosen1@example.com',
                'no_telp' => '081234567890',
                'honor_per_sks' => 100000,
                'status' => 'aktif',
                'foto' => null,
            ],
            [
                'user_id' => 2,
                'nidn' => '2345678901',
                'nama_dosen' => 'Dosen Dua',
                'pendidikan' => 'S1',
                'bidang' => 'Sistem Informasi',
                'tempat' => 'Bandung',
                'tanggal_lahir' => '1985-02-02',
                'jenis_kelamin' => 'Perempuan',
                'agama' => 'Islam',
                'email' => 'dosen2@example.com',
                'no_telp' => '081234567891',
                'honor_per_sks' => 120000,
                'status' => 'aktif',
                'foto' => null,
            ],
            [
                'user_id' => 3,
                'nidn' => '3456789012',
                'nama_dosen' => 'Dosen Tiga',
                'pendidikan' => 'S3',
                'bidang' => 'Komputer',
                'tempat' => 'Bekasi',
                'tanggal_lahir' => '1978-03-03',
                'jenis_kelamin' => 'Laki-laki',
                'agama' => 'Islam',
                'email' => 'dosen3@example.com',
                'no_telp' => '081234567892',
                'honor_per_sks' => 150000,
                'status' => 'aktif',
                'foto' => null,
            ],
        ]);
    }
}
