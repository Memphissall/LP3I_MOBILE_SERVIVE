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

        // Get all mahasiswa from database
        $mahasiswaList = Mahasiswa::with('data_kelas')->get();
        
        if ($mahasiswaList->isEmpty()) {
            $this->command->info('No mahasiswa found in database. Skipping nilai seeder.');
            return;
        }

        // Get dosen (assume first dosen exists)
        $dosen = Dosen::first();
        $nidn = $dosen ? $dosen->nidn : '0000000000';

        foreach ($mahasiswaList as $mhs) {
            // Use mahasiswa's own periode as tahun_akademik (for consistency)
            $tahun_akademik = $mhs->periode ?? '2024/2025';
            
            // Determine how many semesters to seed based on class
            $kelasNama = $mhs->data_kelas->nama_kelas ?? '';
            $maxSemester = (strtoupper($kelasNama) === 'AIS-12') ? 4 : 1;
            
            // Loop through semesters
            for ($sem = 1; $sem <= $maxSemester; $sem++) {
                // Get mata kuliah for this semester
                $mataKuliahList = MataKuliah::where('semester', $sem)
                    ->limit(6) // Take 6 courses per semester
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
                        'id_kelas' => $mhs->id_kelas,
                        'kode_mk' => $mk->kode_mk,
                        'semester' => $sem,
                        'periode' => ($sem % 2 == 0) ? 'Genap' : 'Ganjil',
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
            }

            $semesterText = $maxSemester > 1 ? "semesters 1-{$maxSemester}" : "semester 1";
            $this->command->info("Created nilai for: {$mhs->nama} ({$mhs->nipd}) - {$semesterText}");
        }

        $this->command->info('Nilai seeding completed successfully!');
    }
}
