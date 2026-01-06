<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MahasiswaSeeder extends Seeder
{
    public function run(): void
    {
        $mahasiswa = [];

        // ================= DATA KELAS =================
        $kelasData = [
            1 => [
                'nama_kelas' => 'AIS',
                'kode_kelas' => 1,
                'bidang_keahlian' => 'Accounting Information System',
                'jenis_kelamin' => 'Laki-laki',
                'tempat_lahir' => 'Jakarta',
                'tgl_lahir' => '2004-01-10',
                'alamat' => 'Jakarta',
                'no_tlp_prefix' => '08123451',
                'nama_mhs' => [
                    'Ahmad Fauzi','Rizky Maulana','Bagus Pratama','Dimas Saputra','Rafi Anugrah',
                    'Ilham Ramadhan','Fajar Setiawan','Arif Nugroho','Yoga Prasetyo','Kevin Andika'
                ],
            ],
            2 => [
                'nama_kelas' => 'ASE',
                'kode_kelas' => 2,
                'bidang_keahlian' => 'Application Software Engineering',
                'jenis_kelamin' => 'Perempuan',
                'tempat_lahir' => 'Depok',
                'tgl_lahir' => '2004-02-15',
                'alamat' => 'Depok',
                'no_tlp_prefix' => '08123452',
                'nama_mhs' => [
                    'Siti Aisyah','Dewi Lestari','Nabila Putri','Intan Permata','Aulia Rahma',
                    'Putri Ayu','Nina Safitri','Rina Kurnia','Maya Sari','Fitri Handayani'
                ],
            ],
            3 => [
                'nama_kelas' => 'OAA',
                'kode_kelas' => 3,
                'bidang_keahlian' => 'Office Administration Automatizion',
                'jenis_kelamin' => 'Laki-laki',
                'tempat_lahir' => 'Semarang',
                'tgl_lahir' => '2004-03-20',
                'alamat' => 'Semarang',
                'no_tlp_prefix' => '08123453',
                'nama_mhs' => [
                    'Fajar Nugroho','Agus Santoso','Bayu Wicaksono','Hendra Wijaya','Rian Firmansyah',
                    'Eko Prasetyo','Yusuf Hidayat','Adi Saptono','Reza Kurniawan','Taufik Hidayah'
                ],
            ],
        ];

        // ================= GENERATE MAHASISWA =================
        foreach ($kelasData as $id_kelas => $data) {
            foreach ($data['nama_mhs'] as $i => $nama_mhs) {
                $mahasiswa[] = [
                    // NIPD format: 2024 + kode_kelas (2 digit) + nomor urut (2 digit)
                    'nipd' => 20240000 + ($data['kode_kelas'] * 100) + ($i + 1),
                    'nama_mhs' => $nama_mhs,
                    'jenis_kelamin' => $data['jenis_kelamin'],
                    'tempat_lahir' => $data['tempat_lahir'],
                    'tgl_lahir' => $data['tgl_lahir'],
                    'id_kelas' => $id_kelas,
                    'bidang_keahlian' => $data['bidang_keahlian'],
                    'email' => strtolower(str_replace(' ', '.', $nama_mhs)).'@mail.com',
                    'alamat' => $data['alamat'],
                    'agama' => 'Islam',
                    'no_tlp' => $data['no_tlp_prefix'] . $i,
                    'foto' => 'default.png',
                    'status' => 'Aktif',
                    'created_at' => now(),
                    'updated_at' => now(),
                ];
            }
        }

        // ================= INSERT KE DATABASE =================
        DB::table('mahasiswa')->insert($mahasiswa);
    }
}
