<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KrsSeeder extends Seeder
{
    public function run()
    {
        // Clear existing data
        DB::table('krs')->truncate();

        // Get all students with their class and major info
        $students = \App\Models\Mahasiswa::with(['data_kelas'])->get();
        
        $totalInserted = 0;
        $skippedCount = 0;

        foreach ($students as $mhs) {
            // Skip if no class assigned
            if (!$mhs->data_kelas) {
                $skippedCount++;
                continue;
            }

            $currentSem = $mhs->data_kelas->semester ?? 1;
            $idKelas = $mhs->id_kelas;
            $idProdi = $mhs->data_kelas->id_bidang_keahlian;

            // Scenario 1: Current Academic Year (2025/2026)
            // Assign courses for the current semester
            $count = $this->assignKrs($mhs, $currentSem, '2025/2026', $idProdi);
            $totalInserted += $count;

            // Scenario 2: Previous Academic Year (2024/2025)
            // If student is in sem 3 or higher, they had history in sem 1
            if ($currentSem >= 3) {
                $prevSem = $currentSem - 2; // e.g. Sem 3 now -> Sem 1 last year
                if ($prevSem > 0) {
                    $count = $this->assignKrs($mhs, $prevSem, '2024/2025', $idProdi);
                    $totalInserted += $count;
                }
            }
        }
        
        $this->command->info("KRS Seeder completed!");
        $this->command->info("Total KRS entries created: $totalInserted");
        $this->command->info("Students skipped (no class): $skippedCount");
    }

    private function assignKrs($mhs, $semester, $tahunAkademik, $idProdi)
    {
        // Get courses for this semester and prodi
        $courses = \App\Models\MataKuliah::where('semester', $semester)
            ->where('id_bidang_keahlian', $idProdi)
            ->inRandomOrder()
            ->take(6) // Take 6 random courses
            ->get();

        if ($courses->isEmpty()) {
            // No courses available for this combination
            return 0;
        }

        $count = 0;
        foreach ($courses as $mk) {
            DB::table('krs')->insert([
                'nipd' => $mhs->nipd,
                'nama_mhs' => $mhs->nama,
                'id_kelas' => $mhs->id_kelas,
                'id_matkul' => $mk->id_matkul,
                'semester' => $semester,
                'periode' => ($semester % 2 == 1) ? 'Ganjil' : 'Genap',
                'tahun_akademik' => $tahunAkademik,
                'status' => 'Approved',
                'created_at' => now(),
                'updated_at' => now(),
            ]);
            $count++;
        }
        
        return $count;
    }
}
