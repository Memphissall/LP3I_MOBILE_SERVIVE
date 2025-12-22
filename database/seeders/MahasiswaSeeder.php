<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MahasiswaSeeder extends Seeder
{
    public function run(): void
    {
        $mahasiswa = [];

        // ================= KELAS 1 - Teknik Informatika =================
        $namaKelas1 = [
            'Ahmad Fauzi','Rizky Maulana','Bagus Pratama','Dimas Saputra','Rafi Anugrah',
            'Ilham Ramadhan','Fajar Setiawan','Arif Nugroho','Yoga Prasetyo','Kevin Andika'
        ];

        foreach ($namaKelas1 as $i => $nama) {
            $mahasiswa[] = [
                'nipd' => 20241001 + $i,
                'nama' => $nama,
                'jenis_kelamin' => 'Laki-laki',
                'tempat_lahir' => 'Jakarta',
                'tgl_lahir' => '2004-01-10',
                'id_kelas' => 1,
                'jurusan' => 'Teknik Informatika',
                'email' => strtolower(str_replace(' ', '.', $nama)).'@mail.com',
                'alamat' => 'Jakarta',
                'agama' => 'Islam',
                'no_tlp' => '08123451'.$i,
                'foto' => 'default.png',
                'status' => 'Aktif',
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        // ================= KELAS 2 - Sistem Informasi =================
        $namaKelas2 = [
            'Siti Aisyah','Dewi Lestari','Nabila Putri','Intan Permata','Aulia Rahma',
            'Putri Ayu','Nina Safitri','Rina Kurnia','Maya Sari','Fitri Handayani'
        ];

        foreach ($namaKelas2 as $i => $nama) {
            $mahasiswa[] = [
                'nipd' => 20242001 + $i,
                'nama' => $nama,
                'jenis_kelamin' => 'Perempuan',
                'tempat_lahir' => 'Depok',
                'tgl_lahir' => '2004-02-15',
                'id_kelas' => 2,
                'jurusan' => 'Sistem Informasi',
                'email' => strtolower(str_replace(' ', '.', $nama)).'@mail.com',
                'alamat' => 'Depok',
                'agama' => 'Islam',
                'no_tlp' => '08123452'.$i,
                'foto' => 'default.png',
                'status' => 'Aktif',
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        // ================= KELAS 3 - Teknik Komputer =================
        $namaKelas3 = [
            'Fajar Nugroho','Agus Santoso','Bayu Wicaksono','Hendra Wijaya','Rian Firmansyah',
            'Eko Prasetyo','Yusuf Hidayat','Adi Saptono','Reza Kurniawan','Taufik Hidayah'
        ];

        foreach ($namaKelas3 as $i => $nama) {
            $mahasiswa[] = [
                'nipd' => 20243001 + $i,
                'nama' => $nama,
                'jenis_kelamin' => 'Laki-laki',
                'tempat_lahir' => 'Semarang',
                'tgl_lahir' => '2004-03-20',
                'id_kelas' => 3,
                'jurusan' => 'Teknik Komputer',
                'email' => strtolower(str_replace(' ', '.', $nama)).'@mail.com',
                'alamat' => 'Semarang',
                'agama' => 'Islam',
                'no_tlp' => '08123453'.$i,
                'foto' => 'default.png',
                'status' => 'Aktif',
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        DB::table('mahasiswa')->insert($mahasiswa);
    }
}
