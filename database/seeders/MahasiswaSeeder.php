<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MahasiswaSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('mahasiswa')->insert([
            [
                'nipd' => '20240101',
                'nama_mhs' => 'Ahmad Fauzi',
                'alamat' => 'Jakarta',
                'domisili' => 'Jakarta',
                'tempat_lahir' => 'Jakarta',
                'tgl_lahir' => '2004-01-10',
                'angkatan' => '2024',
                'periode' => '2024/2025',
                'email' => 'ahmad.fauzi@mail.com',
                'agama' => 'Islam',
                'no_tlp' => '081234510',
                'status' => 'Aktif',

                'id_user' => 1,
                'id_program_studi' => 1,
                'id_kelas' => 1,

                'foto' => 'default.png',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nipd' => '20240102',
                'nama_mhs' => 'Siti Aisyah',
                'alamat' => 'Depok',
                'domisili' => 'Depok',
                'tempat_lahir' => 'Depok',
                'tgl_lahir' => '2004-02-15',
                'angkatan' => '2024',
                'periode' => '2024/2025',
                'email' => 'siti.aisyah@mail.com',
                'agama' => 'Islam',
                'no_tlp' => '081234520',
                'status' => 'Aktif',

                'id_user' => 2,
                'id_program_studi' => 2,
                'id_kelas' => 2,

                'foto' => 'default.png',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
