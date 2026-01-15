<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;
use App\Models\Mahasiswa;
use App\Models\Kelas;
use App\Models\BidangKeahlian;

class DummyDataSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create('id_ID');

        // Fetch Bidang Keahlian IDs
        // Map: Code => ID
        $bkMap = BidangKeahlian::pluck('id_bidang_keahlian', 'kode')->toArray();

        // 1. Create Dummy Kelas
        $kelasIds = [];

        // Kelas untuk Angkatan 2024 (semester 1-3)
        $kelas2024 = [
            // OAA - Semester 1-3
            ['nama' => 'OAA-13A', 'jurusan_code' => 'OAA', 'tahun_ajaran' => '2024/2025', 'semester' => 1],
            ['nama' => 'OAA-13B', 'jurusan_code' => 'OAA', 'tahun_ajaran' => '2024/2025', 'semester' => 2],
            ['nama' => 'OAA-13C', 'jurusan_code' => 'OAA', 'tahun_ajaran' => '2024/2025', 'semester' => 3],

            // ASE - Semester 1-3
            ['nama' => 'ASE-10A', 'jurusan_code' => 'ASE', 'tahun_ajaran' => '2024/2025', 'semester' => 1],
            ['nama' => 'ASE-10B', 'jurusan_code' => 'ASE', 'tahun_ajaran' => '2024/2025', 'semester' => 2],
            ['nama' => 'ASE-10C', 'jurusan_code' => 'ASE', 'tahun_ajaran' => '2024/2025', 'semester' => 3],

            // AIS - Semester 1-3
            ['nama' => 'AIS-12A', 'jurusan_code' => 'AIS', 'tahun_ajaran' => '2024/2025', 'semester' => 1],
            ['nama' => 'AIS-12B', 'jurusan_code' => 'AIS', 'tahun_ajaran' => '2024/2025', 'semester' => 2],
            ['nama' => 'AIS-12C', 'jurusan_code' => 'AIS', 'tahun_ajaran' => '2024/2025', 'semester' => 3],
        ];

        // Kelas untuk Angkatan 2025 (semester 4-6)
        $kelas2025 = [
            // OAA - Semester 4-6
            ['nama' => 'OAA-14A', 'jurusan_code' => 'OAA', 'tahun_ajaran' => '2025/2026', 'semester' => 4],
            ['nama' => 'OAA-14B', 'jurusan_code' => 'OAA', 'tahun_ajaran' => '2025/2026', 'semester' => 5],
            ['nama' => 'OAA-14C', 'jurusan_code' => 'OAA', 'tahun_ajaran' => '2025/2026', 'semester' => 6],

            // ASE - Semester 4-6
            ['nama' => 'ASE-11A', 'jurusan_code' => 'ASE', 'tahun_ajaran' => '2025/2026', 'semester' => 4],
            ['nama' => 'ASE-11B', 'jurusan_code' => 'ASE', 'tahun_ajaran' => '2025/2026', 'semester' => 5],
            ['nama' => 'ASE-11C', 'jurusan_code' => 'ASE', 'tahun_ajaran' => '2025/2026', 'semester' => 6],

            // AIS - Semester 4-6
            ['nama' => 'AIS-13A', 'jurusan_code' => 'AIS', 'tahun_ajaran' => '2025/2026', 'semester' => 4],
            ['nama' => 'AIS-13B', 'jurusan_code' => 'AIS', 'tahun_ajaran' => '2025/2026', 'semester' => 5],
            ['nama' => 'AIS-13C', 'jurusan_code' => 'AIS', 'tahun_ajaran' => '2025/2026', 'semester' => 6],

            // Additional Classes for Semester 7-8 coverage
            ['nama' => 'OAA-15A', 'jurusan_code' => 'OAA', 'tahun_ajaran' => '2025/2026', 'semester' => 7],
            ['nama' => 'OAA-15B', 'jurusan_code' => 'OAA', 'tahun_ajaran' => '2025/2026', 'semester' => 8],
            ['nama' => 'ASE-12A', 'jurusan_code' => 'ASE', 'tahun_ajaran' => '2025/2026', 'semester' => 7],
            ['nama' => 'ASE-12B', 'jurusan_code' => 'ASE', 'tahun_ajaran' => '2025/2026', 'semester' => 8],
            ['nama' => 'AIS-14A', 'jurusan_code' => 'AIS', 'tahun_ajaran' => '2025/2026', 'semester' => 7],
            ['nama' => 'AIS-14B', 'jurusan_code' => 'AIS', 'tahun_ajaran' => '2025/2026', 'semester' => 8],
        ];

        $kelasIds['2024'] = [];
        $kelasIds['2025'] = [];

        // Create kelas 2024
        foreach ($kelas2024 as $k) {
            $kelas = Kelas::create([
                'nama_kelas' => $k['nama'],
                'id_bidang_keahlian' => $bkMap[$k['jurusan_code']] ?? null,
                'tahun_ajaran' => $k['tahun_ajaran'],
                'semester' => $k['semester'],
                'nama_pa' => $faker->name,
            ]);
            $kelasIds['2024'][$k['jurusan_code']][] = $kelas->id_kelas;
        }

        // Create kelas 2025
        foreach ($kelas2025 as $k) {
            $kelas = Kelas::create([
                'nama_kelas' => $k['nama'],
                'id_bidang_keahlian' => $bkMap[$k['jurusan_code']] ?? null,
                'tahun_ajaran' => $k['tahun_ajaran'],
                'semester' => $k['semester'],
                'nama_pa' => $faker->name,
            ]);
            $kelasIds['2025'][$k['jurusan_code']][] = $kelas->id_kelas;
        }

        // 2. Create Dummy Mahasiswa
        // A. Mahasiswa WITH Class
        for ($i = 0; $i < 15; $i++) {
            $jurusanCode = $faker->randomElement(['OAA', 'ASE', 'AIS']);

            // Generate angkatan (hanya 2024 dan 2025 karena kelas cuma ada untuk tahun ini)
            $angkatan = $faker->randomElement(['2024', '2025']);
            $periodeStart = (int) $angkatan;
            $periodeEnd = $periodeStart + 1;
            $semesterNum = $faker->numberBetween(1, 8);
            $periode = "$periodeStart/$periodeEnd/$semesterNum";

            // Select class based on angkatan and jurusan code
            $selectedClass = null;
            if (isset($kelasIds[$angkatan][$jurusanCode])) {
                $selectedClass = $faker->randomElement($kelasIds[$angkatan][$jurusanCode]);
            }

            // Get kelas name for selected class
            $kelasName = '';
            if ($selectedClass) {
                $kelasObj = Kelas::find($selectedClass);
                $kelasName = $kelasObj ? $kelasObj->nama_kelas : '';
            }

            Mahasiswa::create([
                'nipd' => $faker->unique()->numerify('##########'),
                'nama' => $faker->name,
                'jenis_kelamin' => $faker->randomElement(['Laki-laki', 'Perempuan']),
                'tempat_lahir' => $faker->city,
                'tgl_lahir' => $faker->date('Y-m-d', '2005-01-01'),
                'kelas' => $kelasName, // Use kelas name from selected class
                'id_kelas' => $selectedClass,
                'id_bidang_keahlian' => $bkMap[$jurusanCode] ?? null,
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

        // B. Mahasiswa WITHOUT Class (NEW: Ensure complete coverage for semesters 1-8 for BOTH 2024 & 2025)
        $angkatans = ['2024', '2025'];
        $semesters = range(1, 8); // [1, 2, 3, 4, 5, 6, 7, 8]

        foreach ($angkatans as $angkatan) {
            foreach ($semesters as $sem) {
                // Create at least 1 student per semester/angkatan
                for ($k = 0; $k < 1; $k++) {
                    $jurusanCode = $faker->randomElement(['OAA', 'ASE', 'AIS']);
                    $periodeStart = (int) $angkatan;
                    $periodeEnd = $periodeStart + 1;
                    $periode = "$periodeStart/$periodeEnd/$sem";

                    Mahasiswa::create([
                        'nipd' => $faker->unique()->numerify('##########'),
                        'nama' => $faker->name,
                        'jenis_kelamin' => $faker->randomElement(['Laki-laki', 'Perempuan']),
                        'tempat_lahir' => $faker->city,
                        'tgl_lahir' => $faker->date('Y-m-d', '2005-01-01'),
                        'kelas' => '', // No class assigned, use empty string
                        'id_kelas' => null,
                        'id_bidang_keahlian' => $bkMap[$jurusanCode] ?? null,
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

    }
}
