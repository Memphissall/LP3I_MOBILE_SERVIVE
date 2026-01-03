<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;
use App\Models\Mahasiswa;
use App\Models\Kelas;

class DummyDataSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create('id_ID');

        // 1. Create Dummy Kelas
        $kelasIds = [];
        
        $kelas2024 = [
            ['nama' => 'OAA-13A', 'jurusan_code' => 'OAA', 'tahun_ajaran' => '2024/2025', 'bidang_id' => 1],
            ['nama' => 'OAA-13B', 'jurusan_code' => 'OAA', 'tahun_ajaran' => '2024/2025', 'bidang_id' => 1],
            ['nama' => 'ASE-10', 'jurusan_code' => 'ASE', 'tahun_ajaran' => '2024/2025', 'bidang_id' => 2],
            ['nama' => 'AIS-12', 'jurusan_code' => 'AIS', 'tahun_ajaran' => '2024/2025', 'bidang_id' => 3],
        ];
        
        $kelas2025 = [
            ['nama' => 'OAA-14A', 'jurusan_code' => 'OAA', 'tahun_ajaran' => '2025/2026', 'bidang_id' => 1],
            ['nama' => 'OAA-14B', 'jurusan_code' => 'OAA', 'tahun_ajaran' => '2025/2026', 'bidang_id' => 1],
            ['nama' => 'ASE-11', 'jurusan_code' => 'ASE', 'tahun_ajaran' => '2025/2026', 'bidang_id' => 2],
            ['nama' => 'AIS-13', 'jurusan_code' => 'AIS', 'tahun_ajaran' => '2025/2026', 'bidang_id' => 3],
        ];
        
        $kelasIds['2024'] = [];
        $kelasIds['2025'] = [];
        
        foreach ($kelas2024 as $k) {
            $kelas = Kelas::create([
                'nama_kelas' => $k['nama'],
                'id_bidang_keahlian' => $k['bidang_id'],
                'tahun_ajaran' => $k['tahun_ajaran'],
                'nama_pa' => $faker->name,
            ]);
            $kelasIds['2024'][$k['jurusan_code']][] = $kelas->id_kelas;
        }
        
        foreach ($kelas2025 as $k) {
            $kelas = Kelas::create([
                'nama_kelas' => $k['nama'],
                'id_bidang_keahlian' => $k['bidang_id'],
                'tahun_ajaran' => $k['tahun_ajaran'],
                'nama_pa' => $faker->name,
            ]);
            $kelasIds['2025'][$k['jurusan_code']][] = $kelas->id_kelas;
        }

        // 2. Create Dummy Mahasiswa
        for ($i = 0; $i < 15; $i++) {
            $jurusanCode = $faker->randomElement(['OAA', 'ASE', 'AIS']);
            $bidangId = ($jurusanCode == 'OAA') ? 1 : (($jurusanCode == 'ASE') ? 2 : 3);
            $angkatan = $faker->randomElement(['2024', '2025']);
            $selectedClass = $faker->randomElement($kelasIds[$angkatan][$jurusanCode]);
            
            Mahasiswa::create([
                'nipd' => $faker->unique()->numerify('##########'),
                'nama' => $faker->name,
                'jenis_kelamin' => $faker->randomElement(['Laki-laki', 'Perempuan']),
                'tempat_lahir' => $faker->city,
                'tgl_lahir' => $faker->date('Y-m-d', '2005-01-01'),
                'id_kelas' => $selectedClass,
                'id_bidang_keahlian' => $bidangId,
                'angkatan' => $angkatan,
                'periode' => "$angkatan/" . ((int)$angkatan + 1),
                'email' => $faker->unique()->safeEmail,
                'alamat' => $faker->address,
                'agama' => 'Islam',
                'no_tlp' => $faker->numerify('08##########'),
                'foto' => 'default.jpg', // AKU BALIKIN INI BUB!
                'status' => 'Aktif',
            ]);
        }

        for ($i = 0; $i < 5; $i++) {
            $jurusanCode = $faker->randomElement(['OAA', 'ASE', 'AIS']);
            $bidangId = ($jurusanCode == 'OAA') ? 1 : (($jurusanCode == 'ASE') ? 2 : 3);

            Mahasiswa::create([
                'nipd' => $faker->unique()->numerify('##########'),
                'nama' => $faker->name,
                'jenis_kelamin' => $faker->randomElement(['Laki-laki', 'Perempuan']),
                'tempat_lahir' => $faker->city,
                'tgl_lahir' => $faker->date('Y-m-d', '2005-01-01'),
                'id_kelas' => null,
                'id_bidang_keahlian' => $bidangId,
                'angkatan' => '2025',
                'periode' => '2025/2026',
                'email' => $faker->unique()->safeEmail,
                'alamat' => $faker->address,
                'agama' => 'Islam',
                'no_tlp' => $faker->numerify('08##########'),
                'foto' => 'default.jpg', // INI JUGA!
                'status' => 'Aktif',
            ]);
        }
    }
}