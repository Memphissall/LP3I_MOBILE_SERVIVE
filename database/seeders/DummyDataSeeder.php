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
        
        // Jurusan mapping (code => full name)
        $jurusanMapping = [
            'OAA' => 'Office Automation Authorization',
            'ASE' => 'Application Software Engineering',
            'AIS' => 'Accounting Information System'
        ];
        
        // Kelas untuk Angkatan 2024 (dengan strip)
        $kelas2024 = [
            ['nama' => 'OAA-13A', 'jurusan_code' => 'OAA', 'tahun_ajaran' => '2024/2025'],
            ['nama' => 'OAA-13B', 'jurusan_code' => 'OAA', 'tahun_ajaran' => '2024/2025'],
            ['nama' => 'ASE-10', 'jurusan_code' => 'ASE', 'tahun_ajaran' => '2024/2025'],
            ['nama' => 'AIS-12', 'jurusan_code' => 'AIS', 'tahun_ajaran' => '2024/2025'],
        ];
        
        // Kelas untuk Angkatan 2025 (dengan strip)
        $kelas2025 = [
            ['nama' => 'OAA-14A', 'jurusan_code' => 'OAA', 'tahun_ajaran' => '2025/2026'],
            ['nama' => 'OAA-14B', 'jurusan_code' => 'OAA', 'tahun_ajaran' => '2025/2026'],
            ['nama' => 'ASE-11', 'jurusan_code' => 'ASE', 'tahun_ajaran' => '2025/2026'],
            ['nama' => 'AIS-13', 'jurusan_code' => 'AIS', 'tahun_ajaran' => '2025/2026'],
        ];
        
        $kelasIds['2024'] = [];
        $kelasIds['2025'] = [];
        
        // Create kelas 2024
        foreach ($kelas2024 as $k) {
            $kelas = Kelas::create([
                'nama_kelas' => $k['nama'],
                'jurusan' => $jurusanMapping[$k['jurusan_code']], // Full name
                'tahun_ajaran' => $k['tahun_ajaran'],
                'nama_pa' => $faker->name,
            ]);
            $kelasIds['2024'][$k['jurusan_code']][] = $kelas->id_kelas;
        }
        
        // Create kelas 2025
        foreach ($kelas2025 as $k) {
            $kelas = Kelas::create([
                'nama_kelas' => $k['nama'],
                'jurusan' => $jurusanMapping[$k['jurusan_code']], // Full name
                'tahun_ajaran' => $k['tahun_ajaran'],
                'nama_pa' => $faker->name,
            ]);
            $kelasIds['2025'][$k['jurusan_code']][] = $kelas->id_kelas;
        }

        // 2. Create Dummy Mahasiswa
        // A. Mahasiswa WITH Class
        for ($i = 0; $i < 15; $i++) {
            $jurusanCode = $faker->randomElement(['OAA', 'ASE', 'AIS']);
            $jurusanFullName = $jurusanMapping[$jurusanCode];
            
            // Generate angkatan (hanya 2024 dan 2025 karena kelas cuma ada untuk tahun ini)
            $angkatan = $faker->randomElement(['2024', '2025']);
            $periodeStart = (int)$angkatan;
            $periodeEnd = $periodeStart + 1;
            $periode = "$periodeStart/$periodeEnd";
            
            // Select class based on angkatan and jurusan code
            $selectedClass = $faker->randomElement($kelasIds[$angkatan][$jurusanCode]);
            
            Mahasiswa::create([
                'nipd' => $faker->unique()->numerify('##########'),
                'nama' => $faker->name,
                'jenis_kelamin' => $faker->randomElement(['Laki-laki', 'Perempuan']),
                'tempat_lahir' => $faker->city,
                'tgl_lahir' => $faker->date('Y-m-d', '2005-01-01'),
                'kelas' => 'null', // Optional legacy field
                'id_kelas' => $selectedClass,
                'jurusan' => $jurusanFullName, // Use full name
                'angkatan' => $angkatan,
                'periode' => $periode,
                'email' => $faker->unique()->safeEmail,
                'alamat' => $faker->address,
                'agama' => 'Islam',
                'no_tlp' => $faker->numerify('08##########'),
                'foto' => 'default.jpg',
                'status' => 'Aktif',
            ]);
        }

        // B. Mahasiswa WITHOUT Class (New Students)
        for ($i = 0; $i < 5; $i++) {
            $jurusanCode = $faker->randomElement(['OAA', 'ASE', 'AIS']);
            $jurusanFullName = $jurusanMapping[$jurusanCode];
            
            // Generate angkatan and matching periode
            $angkatan = '2025';
            $periode = '2025/2026';
            
            Mahasiswa::create([
                'nipd' => $faker->unique()->numerify('##########'),
                'nama' => $faker->name,
                'jenis_kelamin' => $faker->randomElement(['Laki-laki', 'Perempuan']),
                'tempat_lahir' => $faker->city,
                'tgl_lahir' => $faker->date('Y-m-d', '2005-01-01'),
                'kelas' => null, // Explicitly null
                'id_kelas' => null, // Explicitly null
                'jurusan' => $jurusanFullName, // Use full name
                'angkatan' => $angkatan,
                'periode' => $periode,
                'email' => $faker->unique()->safeEmail,
                'alamat' => $faker->address,
                'agama' => 'Islam',
                'no_tlp' => $faker->numerify('08##########'),
                'foto' => 'default.jpg',
                'status' => 'Aktif',
            ]);
        }
    }
}
