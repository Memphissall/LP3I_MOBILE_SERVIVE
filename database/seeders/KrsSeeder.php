<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Mahasiswa;

class KrsSeeder extends Seeder
{
    public function run()
    {
        // 1. Kosongkan tabel KRS dulu biar nggak double
        DB::table('krs')->truncate();

        // 2. Ambil semua mahasiswa yang punya kelas
        $mahasiswaList = Mahasiswa::whereNotNull('id_kelas')->get();
        $tahun_akademik = '2023/2024';

        if ($mahasiswaList->isEmpty()) {
            $this->command->info('Tidak ada mahasiswa. Jalankan MahasiswaSeeder dulu ya Bubub!');
            return;
        }

        foreach ($mahasiswaList as $mhs) {
            // 3. Ambil jadwal semester 1 (sesuai kebutuhan awal)
            // Sesuaikan filter semester-nya di sini kalau mau semester 3
            $jadwalList = DB::table('jadwal')
                ->join('mata_kuliah', 'jadwal.id_matkul', '=', 'mata_kuliah.id_matkul')
                ->where('mata_kuliah.semester', 1) 
                ->where('jadwal.id_kelas', $mhs->id_kelas)
                ->select('jadwal.id_jadwal', 'jadwal.id_matkul')
                ->get();

            if ($jadwalList->isEmpty()) {
                $this->command->warn("Jadwal untuk kelas {$mhs->id_kelas} belum ada. Lewati...");
                continue;
            }

            foreach ($jadwalList as $jadwal) {
                DB::table('krs')->insert([
                    'nipd' => $mhs->nipd,
                    'nama_mhs' => $mhs->nama,
                    'id_kelas' => $mhs->id_kelas,
                    'id_jadwal' => $jadwal->id_jadwal,
                    'id_matkul' => $jadwal->id_matkul, // Tambahkan ini sesuai relasi model kamu
                    'semester' => 1,
                    'periode' => 'Ganjil',
                    'tahun_akademik' => $tahun_akademik,
                    'status' => 'Approved',
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
            $this->command->info("Berhasil isi KRS untuk: {$mhs->nama}");
        }
    }
}