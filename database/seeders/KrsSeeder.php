<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KrsSeeder extends Seeder
{
    public function run()
    {
        // Sample student
        $nipd = '2023010001';
        $nama_mhs = 'John Doe';
        $id_kelas = 1;
        $tahun_akademik = '2023/2024';

        // Get jadwal for semester 3 (from the uploaded image example)
        // Assuming we have jadwal data seeded
        $jadwalSem3 = DB::table('jadwal')
            ->join('mata_kuliah', 'jadwal.id_matkul', '=', 'mata_kuliah.id_matkul')
            ->where('mata_kuliah.semester', 3)
            ->where('jadwal.id_kelas', $id_kelas)
            ->select('jadwal.id_jadwal')
            ->limit(8)
            ->get();

        foreach ($jadwalSem3 as $jadwal) {
            DB::table('krs')->insert([
                'nipd' => $nipd,
                'nama_mhs' => $nama_mhs,
                'id_kelas' => $id_kelas,
                'id_jadwal' => $jadwal->id_jadwal,
                'semester' => 3,
                'periode' => 'Ganjil',
                'tahun_akademik' => $tahun_akademik,
                'status' => 'Approved',
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
