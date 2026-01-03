<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Nilai;
use App\Models\Mahasiswa;
use App\Models\MataKuliah;
use App\Models\Dosen;

class NilaiSeeder extends Seeder
{
    public function run()
    {
        // Clear existing nilai
        DB::table('nilai')->truncate();

        // REVISI DI SINI: Tambahkan whereNotNull agar id_kelas tidak kosong saat di-insert
        $mahasiswaList = Mahasiswa::with('data_kelas')
            ->whereNotNull('id_kelas')
            ->get();
        
        if ($mahasiswaList->isEmpty()) {
            $this->command->info('No mahasiswa with class found in database. Skipping nilai seeder.');
            return;
        }

        // Get dosen (assume first dosen exists)
        $dosen = Dosen::first();
        $nidn = $dosen ? $dosen->nidn : '0000000000';

        $tahun_akademik = '2023/2024';

        foreach ($mahasiswaList as $mhs) {
            // Get mata kuliah for this student's semester/class
            // We'll create nilai for semester 1 mata kuliah
            $mataKuliahList = MataKuliah::where('semester', 1)
                ->limit(5) // Take 5 courses per student
                ->get();

            if ($mataKuliahList->isEmpty()) {
                continue;
            }

            foreach ($mataKuliahList as $mk) {
                // Generate random but realistic grades
                $kehadiran = rand(85, 100);
                $sikap = rand(80, 95);
                $formatif = rand(75, 90);
                $tugas = rand(80, 95);
                $uts = rand(75, 90);
                $uas = rand(75, 95);

                $nilaiAkhir = Nilai::hitungNilaiAkhir([
                    'nilai_kehadiran' => $kehadiran,
                    'nilai_sikap' => $sikap,
                    'nilai_formatif' => $formatif,
                    'nilai_tugas' => $tugas,
                    'nilai_uts' => $uts,
                    'nilai_uas' => $uas,
                ]);
                
                $mutu = Nilai::getMutu($nilaiAkhir);
                $bobotIP = Nilai::getBobotIP($mutu);

                DB::table('nilai')->insert([
                    'nidn' => $nidn,
                    'nipd' => $mhs->nipd,
                    'nama_mhs' => $mhs->nama,
                    'id_kelas' => $mhs->id_kelas, // Sekarang aman tidak akan null
                    'kode_mk' => $mk->kode_mk,
                    'semester' => 1,
                    'periode' => 'Ganjil',
                    'tahun_akademik' => $tahun_akademik,
                    'nilai_kehadiran' => $kehadiran,
                    'nilai_sikap' => $sikap,
                    'nilai_formatif' => $formatif,
                    'nilai_tugas' => $tugas,
                    'nilai_uts' => $uts,
                    'nilai_uas' => $uas,
                    'nilai_akhir' => $nilaiAkhir,
                    'mutu' => $mutu,
                    'bobot_ip' => $bobotIP,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }

            $this->command->info("Created nilai for: {$mhs->nama} ({$mhs->nipd})");
        }

        $this->command->info('Nilai seeding completed successfully!');
    }
}