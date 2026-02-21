<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Models\Mahasiswa;
use App\Models\User;

class MahasiswaSeeder extends Seeder
{
    public function run()
    {
        // Data dari Screenshot
        $data = [
            [
                'nipd' => '240780040005',
                'nama_mhs' => 'BAYU SETIAJI',
                'id_program_studi' => 1,
                'alamat' => 'Dsun krajan desa kedung jaya kecamatan cibuaya RT/RW 004/001, kabupaten karawang',
                'no_tlp' => '085891602476',
                'email' => 'bayusetiaji.lp3i.krw24@gmail.com',
                'tempat_lahir' => 'Karawang',
                'tgl_lahir' => '2006-04-18',
                'jenis_kelamin' => 'Laki-laki',
            ],
            [
                'nipd' => '2407810040004',
                'nama_mhs' => 'ARI APRIANTO',
                'id_program_studi' => 1,
                'alamat' => 'Dsn. Sukamaju RT 013/ RW 003, Desa Warungbambu, Kec. Karawang Timur, Kab. Karawang',
                'no_tlp' => '085887375719',
                'email' => 'ariaprianto.lp3i.krw24@gmail.com',
                'tempat_lahir' => 'Pemalang',
                'tgl_lahir' => '2006-04-02',
                'jenis_kelamin' => 'Laki-laki',
            ],
            [
                'nipd' => '2407810040008',
                'nama_mhs' => 'RAFI NUGRAHA',
                'id_program_studi' => 1,
                'alamat' => 'Dsn. Turimulya, Ds Pulomupya 1, RT/RW: 002/001, Kec. Lemahabang, Kab Karawang',
                'no_tlp' => '081288332599',
                'email' => 'rafinugraha.lp3i.krw24@gmail.com',
                'tempat_lahir' => 'Karawang',
                'tgl_lahir' => '2006-02-01',
                'jenis_kelamin' => 'Laki-laki',
            ],
            [
                'nipd' => '2407810040006',
                'nama_mhs' => 'ACHMAD SHAPEY',
                'id_program_studi' => 1,
                'alamat' => 'Dsn, Cikerti 1 RT/RW 008/003 Kec, Kutawaluya, Kab Karawang',
                'no_tlp' => '089525693190',
                'email' => 'sapeyamad.lp3i.krw24@gmail.com',
                'tempat_lahir' => 'KARAWANG',
                'tgl_lahir' => '2004-10-12',
                'jenis_kelamin' => 'Laki-laki',
            ],
            [
                'nipd' => '2407810040009',
                'nama_mhs' => 'SATRIA ERLANGGA PRADANA',
                'id_program_studi' => 1,
                'alamat' => 'Perum BWI 1 Blok A7 No 14, Kec KedungWaringin, Kab. Bekasi',
                'no_tlp' => '081387741545',
                'email' => 'satriaerlangga.lp3i.krw24@gmail.com',
                'tempat_lahir' => 'Karawang',
                'tgl_lahir' => '2006-06-12',
                'jenis_kelamin' => 'Laki-laki',
            ],
            [
                'nipd' => '2407810040013',
                'nama_mhs' => 'YUSRINA ZIHNI HAKIM',
                'id_program_studi' => 1,
                'alamat' => 'Dusun Cilewo, Rt 002/ Rw 001, Kel/Desa Cilewo, Kec Telagasari, Kab Karawang',
                'no_tlp' => '08966258900',
                'email' => 'yusrinazh.lp3i.krw24@gmail.com',
                'tempat_lahir' => 'Karawang',
                'tgl_lahir' => '2006-12-11',
                'jenis_kelamin' => 'Perempuan',
            ],
            [
                'nipd' => '2407810040002',
                'nama_mhs' => 'FAHAD VIDJAR APRIZA',
                'id_program_studi' => 1,
                'alamat' => 'Mutiara Jaya Regency E2/26 RT 050/RW 012, Desa Kondangjaya, Kec. Karawang Timur, Kab Karawang',
                'no_tlp' => '085716360512',
                'email' => 'fahadvidjarapriza.lp3i.krw24@gmail.com',
                'tempat_lahir' => 'Cianjur',
                'tgl_lahir' => '2006-04-09',
                'jenis_kelamin' => 'Laki-laki',
            ],
            [
                'nipd' => '2407810040012',
                'nama_mhs' => 'SARTIKA',
                'id_program_studi' => 1,
                'alamat' => 'Dusun Panyalinbanyu, RT 001/RW 004, Desa Cadaskertajaya, Kec Telagasari, Kab. Karawang',
                'no_tlp' => '0895332535570',
                'email' => 'sartika.lp3i.krw24@gmail.com',
                'tempat_lahir' => 'Karawang',
                'tgl_lahir' => '2006-12-05',
                'jenis_kelamin' => 'Perempuan',
            ],
            [
                'nipd' => '2407810040015',
                'nama_mhs' => 'AHMAD LITA SEPTIAN',
                'id_program_studi' => 1,
                'alamat' => 'Dusun. karang jaya Rt 001/ 003, Desa Tanjung pakis, Kec. Pakis jaya, Kab. Karawang',
                'no_tlp' => '085778083641',
                'email' => 'septianahmadlitalpi@gmail.com',
                'tempat_lahir' => 'Karawang',
                'tgl_lahir' => '2004-09-11',
                'jenis_kelamin' => 'Laki-laki',
            ],
            [
                'nipd' => '2407810040011',
                'nama_mhs' => 'NINA',
                'id_program_studi' => 1,
                'alamat' => 'Dusun Cengkeh 1, Rt/Rw 007/002, Desa Ciwaringin, Kecamatan Lemahabang, Kabupaten Karawang',
                'no_tlp' => '089638289712',
                'email' => 'nina.lp3i.krw24@gmail.com',
                'tempat_lahir' => 'Karawang',
                'tgl_lahir' => '2006-05-13',
                'jenis_kelamin' => 'Perempuan',
            ],
            [
                'nipd' => '2407810040007',
                'nama_mhs' => 'Faizal Azmi',
                'id_program_studi' => 1,
                'alamat' => 'Kp.Bojong RT 005/RW 001, Kelurahan Bojongsari, Kec Kedungwaringin, Kab Bekasi',
                'no_tlp' => '083893124467',
                'email' => 'faizalazmi.lp3i.krw24@gmail.com',
                'tempat_lahir' => 'Bekasi',
                'tgl_lahir' => '2006-04-23',
                'jenis_kelamin' => 'Laki-laki',
            ],
            [
                'nipd' => '2407810040016',
                'nama_mhs' => 'Nendi setiandi',
                'id_program_studi' => 1,
                'alamat' => 'Dusun karang jaya,Rt 001/Rw 003, Desa Tanjung pakis,kec pakis jaya,kab.karawang',
                'no_tlp' => '085591647506',
                'email' => 'nendysetiardi@gmail.com',
                'tempat_lahir' => 'Karawang',
                'tgl_lahir' => '2003-02-21',
                'jenis_kelamin' => 'Laki-laki',
            ],
            [
                'nipd' => '2407810040017',
                'nama_mhs' => 'Siti nur fatimah',
                'id_program_studi' => 1,
                'alamat' => 'Kp.tipar, RW/RT 003/005, Des Citarik, Kec.Tirtamulya, Kab, Karawang, Prov Jawa barat',
                'no_tlp' => '087835421047',
                'email' => 'fat.lp3i33@gmail.com',
                'tempat_lahir' => 'Karawang',
                'tgl_lahir' => '2006-07-16',
                'jenis_kelamin' => 'Perempuan',
            ],
            [
                'nipd' => '2407810040014',
                'nama_mhs' => 'Muhammad Ahwaz Hafizuddin',
                'id_program_studi' => 1,
                'alamat' => 'Karaba Indah Blok QQ No.40, Kelurahan Wadas, Kec, Telukjambe Timur, Kab Karawang',
                'no_tlp' => '081574965257',
                'email' => 'muhammadahwaz.lp3i.krw24@gmail.com',
                'tempat_lahir' => 'Jakarta',
                'tgl_lahir' => '2006-04-19',
                'jenis_kelamin' => 'Laki-laki',
            ]
        ];

        // Disable FK constraint temporarily to avoid issues if clearing before insert
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        // Optional: you can truncate to only have these exact ones, 
        // to avoid duplicating records if run multiple times.
        // DB::table('mahasiswa')->truncate();

        foreach ($data as $mhs) {
            // Cek apakah mahasiswa dengan email tersebut sudah ada
            $existingMahasiswa = Mahasiswa::where('email', $mhs['email'])->first();

            if (!$existingMahasiswa) {
                // Buat User Akun
                $user = User::firstOrCreate(
                    ['email' => $mhs['email']],
                    [
                        'name' => $mhs['nama_mhs'],
                        'password' => Hash::make('password123'),
                        'role' => 'mahasiswa',
                        'is_active' => true,
                    ]
                );

                // Buat Data Mahasiswa
                Mahasiswa::create([
                    'nipd' => $mhs['nipd'],
                    'nama_mhs' => $mhs['nama_mhs'],
                    'alamat' => $mhs['alamat'],
                    'domisili' => 'Karawang', // Default if needed
                    'tempat_lahir' => $mhs['tempat_lahir'],
                    'tgl_lahir' => $mhs['tgl_lahir'],
                    'angkatan' => '2024',
                    'periode' => '2024/2025',
                    'email' => $mhs['email'],
                    'agama' => 'Islam', // Asumsi default, you can change manually later
                    'no_tlp' => $mhs['no_tlp'],
                    'jenis_kelamin' => $mhs['jenis_kelamin'],
                    'status' => 'Aktif',
                    'id_user' => $user->id_user ?? $user->id,
                    'id_program_studi' => $mhs['id_program_studi'],
                ]);
            } else {
                // Update jika sudah ada update sedikit data
                $existingMahasiswa->update([
                    'nama_mhs' => $mhs['nama_mhs'],
                    'alamat' => $mhs['alamat'],
                    'tempat_lahir' => $mhs['tempat_lahir'],
                    'tgl_lahir' => $mhs['tgl_lahir'],
                    'no_tlp' => $mhs['no_tlp'],
                    'email' => $mhs['email'],
                    'jenis_kelamin' => $mhs['jenis_kelamin'],
                    'angkatan' => '2024',
                    'periode' => '2024/2025',
                ]);
            }
        }

        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}
