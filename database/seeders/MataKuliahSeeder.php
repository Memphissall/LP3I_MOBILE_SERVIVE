<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\MataKuliah;
use App\Models\BidangKeahlian;

class MataKuliahSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Get Bidang Keahlian IDs
        $bkMap = BidangKeahlian::pluck('id_bidang_keahlian', 'kode')->toArray();
        
        $id_ase = $bkMap['ASE'] ?? null;
        $id_ais = $bkMap['AIS'] ?? null;
        // $id_oaa = $bkMap['OAA'] ?? null;

        $mataKuliah = [
            // Teknik Informatika - Semester 1 -> ASE
            ['kode_mk' => 'TI101', 'nama_mk' => 'Pengantar Teknologi Informasi', 'sks' => 3, 'semester' => 1, 'id_bidang_keahlian' => $id_ase, 'deskripsi' => 'Mata kuliah pengenalan dasar teknologi informasi'],
            ['kode_mk' => 'TI102', 'nama_mk' => 'Algoritma dan Pemrograman', 'sks' => 4, 'semester' => 1, 'id_bidang_keahlian' => $id_ase, 'deskripsi' => 'Dasar-dasar algoritma dan pemrograman'],
            ['kode_mk' => 'TI103', 'nama_mk' => 'Matematika Diskrit', 'sks' => 3, 'semester' => 1, 'id_bidang_keahlian' => $id_ase, 'deskripsi' => 'Matematika untuk ilmu komputer'],
            
            // Teknik Informatika - Semester 2 -> ASE
            ['kode_mk' => 'TI201', 'nama_mk' => 'Struktur Data', 'sks' => 4, 'semester' => 2, 'id_bidang_keahlian' => $id_ase, 'deskripsi' => 'Implementasi struktur data'],
            ['kode_mk' => 'TI202', 'nama_mk' => 'Basis Data', 'sks' => 3, 'semester' => 2, 'id_bidang_keahlian' => $id_ase, 'deskripsi' => 'Konsep dan implementasi database'],
            ['kode_mk' => 'TI203', 'nama_mk' => 'Pemrograman Web', 'sks' => 3, 'semester' => 2, 'id_bidang_keahlian' => $id_ase, 'deskripsi' => 'HTML, CSS, JavaScript'],
            
            // Teknik Informatika - Semester 3 -> ASE
            ['kode_mk' => 'TI301', 'nama_mk' => 'Pemrograman Berorientasi Objek', 'sks' => 4, 'semester' => 3, 'id_bidang_keahlian' => $id_ase, 'deskripsi' => 'Konsep OOP dengan Java/C++'],
            ['kode_mk' => 'TI302', 'nama_mk' => 'Sistem Operasi', 'sks' => 3, 'semester' => 3, 'id_bidang_keahlian' => $id_ase, 'deskripsi' => 'Prinsip dan konsep OS'],
            ['kode_mk' => 'TI303', 'nama_mk' => 'Jaringan Komputer', 'sks' => 3, 'semester' => 3, 'id_bidang_keahlian' => $id_ase, 'deskripsi' => 'Dasar-dasar networking'],
            
            // Teknik Informatika - Pilihan -> ASE
            ['kode_mk' => 'TI401', 'nama_mk' => 'Machine Learning', 'sks' => 3, 'semester' => 5, 'id_bidang_keahlian' => $id_ase, 'deskripsi' => 'Pengantar machine learning'],
            ['kode_mk' => 'TI402', 'nama_mk' => 'Mobile Programming', 'sks' => 3, 'semester' => 5, 'id_bidang_keahlian' => $id_ase, 'deskripsi' => 'Android/iOS development'],
            
            // Sistem Informasi - Semester 1 -> AIS
            ['kode_mk' => 'SI101', 'nama_mk' => 'Pengantar Sistem Informasi', 'sks' => 3, 'semester' => 1, 'id_bidang_keahlian' => $id_ais, 'deskripsi' => 'Konsep dasar sistem informasi'],
            ['kode_mk' => 'SI102', 'nama_mk' => 'Dasar Pemrograman', 'sks' => 3, 'semester' => 1, 'id_bidang_keahlian' => $id_ais, 'deskripsi' => 'Pengenalan pemrograman'],
            ['kode_mk' => 'SI103', 'nama_mk' => 'Manajemen dan Organisasi', 'sks' => 2, 'semester' => 1, 'id_bidang_keahlian' => $id_ais, 'deskripsi' => 'Prinsip manajemen'],
            
            // Sistem Informasi - Semester 2 -> AIS
            ['kode_mk' => 'SI201', 'nama_mk' => 'Analisis dan Perancangan SI', 'sks' => 4, 'semester' => 2, 'id_bidang_keahlian' => $id_ais, 'deskripsi' => 'SDLC dan metodologi'],
            ['kode_mk' => 'SI202', 'nama_mk' => 'Manajemen Basis Data', 'sks' => 3, 'semester' => 2, 'id_bidang_keahlian' => $id_ais, 'deskripsi' => 'Database management'],
            ['kode_mk' => 'SI203', 'nama_mk' => 'E-Business', 'sks' => 3, 'semester' => 2, 'id_bidang_keahlian' => $id_ais, 'deskripsi' => 'Bisnis digital'],
            
            // Akuntansi - Semester 1 -> AIS
            ['kode_mk' => 'AK101', 'nama_mk' => 'Pengantar Akuntansi', 'sks' => 3, 'semester' => 1, 'id_bidang_keahlian' => $id_ais, 'deskripsi' => 'Dasar-dasar akuntansi'],
            ['kode_mk' => 'AK102', 'nama_mk' => 'Ekonomi Mikro', 'sks' => 3, 'semester' => 1, 'id_bidang_keahlian' => $id_ais, 'deskripsi' => 'Prinsip ekonomi mikro'],
            ['kode_mk' => 'AK103', 'nama_mk' => 'Matematika Bisnis', 'sks' => 2, 'semester' => 1, 'id_bidang_keahlian' => $id_ais, 'deskripsi' => 'Matematika untuk bisnis'],
            
            // Akuntansi - Semester 2 -> AIS
            ['kode_mk' => 'AK201', 'nama_mk' => 'Akuntansi Keuangan', 'sks' => 4, 'semester' => 2, 'id_bidang_keahlian' => $id_ais, 'deskripsi' => 'Akuntansi keuangan lanjutan'],
            ['kode_mk' => 'AK202', 'nama_mk' => 'Akuntansi Biaya', 'sks' => 3, 'semester' => 2, 'id_bidang_keahlian' => $id_ais, 'deskripsi' => 'Cost accounting'],
            ['kode_mk' => 'AK203', 'nama_mk' => 'Perpajakan', 'sks' => 3, 'semester' => 2, 'id_bidang_keahlian' => $id_ais, 'deskripsi' => 'Sistem perpajakan Indonesia'],
            
            // Akuntansi - Pilihan -> AIS
            ['kode_mk' => 'AK301', 'nama_mk' => 'Akuntansi Syariah', 'sks' => 3, 'semester' => 3, 'id_bidang_keahlian' => $id_ais, 'deskripsi' => 'Akuntansi berbasis syariah'],
            ['kode_mk' => 'AK302', 'nama_mk' => 'Audit Internal', 'sks' => 3, 'semester' => 3, 'id_bidang_keahlian' => $id_ais, 'deskripsi' => 'Prinsip audit'],
        ];

        foreach ($mataKuliah as $mk) {
            MataKuliah::create($mk);
        }
    }
}
