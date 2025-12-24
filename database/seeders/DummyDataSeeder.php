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
        $jurusan = ['Teknik Informatika', 'Sistem Informasi', 'Akuntansi'];
        
        foreach ($jurusan as $j) {
            // Create 2 classes per major
            for ($i = 0; $i < 2; $i++) {
                $kelas = Kelas::create([
                    'nama_kelas' => 'Kelas ' . strtoupper(substr($j, 0, 2)) . ' ' . ($i + 1),
                    'jurusan' => $j,
                    'tahun_ajaran' => '2023/2024',
                    'nama_pa' => $faker->name,
                ]);
                $kelasIds[$j][] = $kelas->id_kelas;
            }
        }

        // 2. Create Dummy Mahasiswa
        // A. Mahasiswa WITH Class
        for ($i = 0; $i < 10; $i++) {
            $major = $faker->randomElement($jurusan);
            $selectedClass = $faker->randomElement($kelasIds[$major]);
            
            Mahasiswa::create([
                'nipd' => $faker->unique()->numerify('##########'),
                'nama' => $faker->name,
                'jenis_kelamin' => $faker->randomElement(['Laki-laki', 'Perempuan']),
                'tempat_lahir' => $faker->city,
                'tgl_lahir' => $faker->date('Y-m-d', '2005-01-01'),
                'kelas' => 'null', // Optional legacy field
                'id_kelas' => $selectedClass,
                'jurusan' => $major,
                'angkatan' => $faker->randomElement(['2021', '2022', '2023']),
                'periode' => $faker->randomElement(['Ganjil', 'Genap']),
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
            $major = $faker->randomElement($jurusan);
            
            Mahasiswa::create([
                'nipd' => $faker->unique()->numerify('##########'),
                'nama' => $faker->name,
                'jenis_kelamin' => $faker->randomElement(['Laki-laki', 'Perempuan']),
                'tempat_lahir' => $faker->city,
                'tgl_lahir' => $faker->date('Y-m-d', '2005-01-01'),
                'kelas' => null, // Explicitly null
                'id_kelas' => null, // Explicitly null
                'jurusan' => $major,
                'angkatan' => '2023',
                'periode' => 'Ganjil',
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
