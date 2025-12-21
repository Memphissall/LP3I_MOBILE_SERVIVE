<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\MataKuliah;

class MataKuliahSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $mataKuliah = [
            // Teknik Informatika - Semester 1
            ['kode_mk' => 'TI101', 'nama_mk' => 'Pengantar Teknologi Informasi', 'sks' => 3, 'semester' => 1, 'jenis' => 'Wajib', 'jurusan' => 'Teknik Informatika', 'deskripsi' => 'Mata kuliah pengenalan dasar teknologi informasi'],
            ['kode_mk' => 'TI102', 'nama_mk' => 'Algoritma dan Pemrograman', 'sks' => 4, 'semester' => 1, 'jenis' => 'Wajib', 'jurusan' => 'Teknik Informatika', 'deskripsi' => 'Dasar-dasar algoritma dan pemrograman'],
            ['kode_mk' => 'TI103', 'nama_mk' => 'Matematika Diskrit', 'sks' => 3, 'semester' => 1, 'jenis' => 'Wajib', 'jurusan' => 'Teknik Informatika', 'deskripsi' => 'Matematika untuk ilmu komputer'],
            
            // Teknik Informatika - Semester 2
            ['kode_mk' => 'TI201', 'nama_mk' => 'Struktur Data', 'sks' => 4, 'semester' => 2, 'jenis' => 'Wajib', 'jurusan' => 'Teknik Informatika', 'deskripsi' => 'Implementasi struktur data'],
            ['kode_mk' => 'TI202', 'nama_mk' => 'Basis Data', 'sks' => 3, 'semester' => 2, 'jenis' => 'Wajib', 'jurusan' => 'Teknik Informatika', 'deskripsi' => 'Konsep dan implementasi database'],
            ['kode_mk' => 'TI203', 'nama_mk' => 'Pemrograman Web', 'sks' => 3, 'semester' => 2, 'jenis' => 'Wajib', 'jurusan' => 'Teknik Informatika', 'deskripsi' => 'HTML, CSS, JavaScript'],
            
            // Teknik Informatika - Semester 3
            ['kode_mk' => 'TI301', 'nama_mk' => 'Pemrograman Berorientasi Objek', 'sks' => 4, 'semester' => 3, 'jenis' => 'Wajib', 'jurusan' => 'Teknik Informatika', 'deskripsi' => 'Konsep OOP dengan Java/C++'],
            ['kode_mk' => 'TI302', 'nama_mk' => 'Sistem Operasi', 'sks' => 3, 'semester' => 3, 'jenis' => 'Wajib', 'jurusan' => 'Teknik Informatika', 'deskripsi' => 'Prinsip dan konsep OS'],
            ['kode_mk' => 'TI303', 'nama_mk' => 'Jaringan Komputer', 'sks' => 3, 'semester' => 3, 'jenis' => 'Wajib', 'jurusan' => 'Teknik Informatika', 'deskripsi' => 'Dasar-dasar networking'],
            
            // Teknik Informatika - Pilihan
            ['kode_mk' => 'TI401', 'nama_mk' => 'Machine Learning', 'sks' => 3, 'semester' => 5, 'jenis' => 'Pilihan', 'jurusan' => 'Teknik Informatika', 'deskripsi' => 'Pengantar machine learning'],
            ['kode_mk' => 'TI402', 'nama_mk' => 'Mobile Programming', 'sks' => 3, 'semester' => 5, 'jenis' => 'Pilihan', 'jurusan' => 'Teknik Informatika', 'deskripsi' => 'Android/iOS development'],
            
            // Sistem Informasi - Semester 1
            ['kode_mk' => 'SI101', 'nama_mk' => 'Pengantar Sistem Informasi', 'sks' => 3, 'semester' => 1, 'jenis' => 'Wajib', 'jurusan' => 'Sistem Informasi', 'deskripsi' => 'Konsep dasar sistem informasi'],
            ['kode_mk' => 'SI102', 'nama_mk' => 'Dasar Pemrograman', 'sks' => 3, 'semester' => 1, 'jenis' => 'Wajib', 'jurusan' => 'Sistem Informasi', 'deskripsi' => 'Pengenalan pemrograman'],
            ['kode_mk' => 'SI103', 'nama_mk' => 'Manajemen dan Organisasi', 'sks' => 2, 'semester' => 1, 'jenis' => 'Wajib', 'jurusan' => 'Sistem Informasi', 'deskripsi' => 'Prinsip manajemen'],
            
            // Sistem Informasi - Semester 2
            ['kode_mk' => 'SI201', 'nama_mk' => 'Analisis dan Perancangan SI', 'sks' => 4, 'semester' => 2, 'jenis' => 'Wajib', 'jurusan' => 'Sistem Informasi', 'deskripsi' => 'SDLC dan metodologi'],
            ['kode_mk' => 'SI202', 'nama_mk' => 'Manajemen Basis Data', 'sks' => 3, 'semester' => 2, 'jenis' => 'Wajib', 'jurusan' => 'Sistem Informasi', 'deskripsi' => 'Database management'],
            ['kode_mk' => 'SI203', 'nama_mk' => 'E-Business', 'sks' => 3, 'semester' => 2, 'jenis' => 'Pilihan', 'jurusan' => 'Sistem Informasi', 'deskripsi' => 'Bisnis digital'],
            
            // Akuntansi - Semester 1
            ['kode_mk' => 'AK101', 'nama_mk' => 'Pengantar Akuntansi', 'sks' => 3, 'semester' => 1, 'jenis' => 'Wajib', 'jurusan' => 'Akuntansi', 'deskripsi' => 'Dasar-dasar akuntansi'],
            ['kode_mk' => 'AK102', 'nama_mk' => 'Ekonomi Mikro', 'sks' => 3, 'semester' => 1, 'jenis' => 'Wajib', 'jurusan' => 'Akuntansi', 'deskripsi' => 'Prinsip ekonomi mikro'],
            ['kode_mk' => 'AK103', 'nama_mk' => 'Matematika Bisnis', 'sks' => 2, 'semester' => 1, 'jenis' => 'Wajib', 'jurusan' => 'Akuntansi', 'deskripsi' => 'Matematika untuk bisnis'],
            
            // Akuntansi - Semester 2
            ['kode_mk' => 'AK201', 'nama_mk' => 'Akuntansi Keuangan', 'sks' => 4, 'semester' => 2, 'jenis' => 'Wajib', 'jurusan' => 'Akuntansi', 'deskripsi' => 'Akuntansi keuangan lanjutan'],
            ['kode_mk' => 'AK202', 'nama_mk' => 'Akuntansi Biaya', 'sks' => 3, 'semester' => 2, 'jenis' => 'Wajib', 'jurusan' => 'Akuntansi', 'deskripsi' => 'Cost accounting'],
            ['kode_mk' => 'AK203', 'nama_mk' => 'Perpajakan', 'sks' => 3, 'semester' => 2, 'jenis' => 'Wajib', 'jurusan' => 'Akuntansi', 'deskripsi' => 'Sistem perpajakan Indonesia'],
            
            // Akuntansi - Pilihan
            ['kode_mk' => 'AK301', 'nama_mk' => 'Akuntansi Syariah', 'sks' => 3, 'semester' => 3, 'jenis' => 'Pilihan', 'jurusan' => 'Akuntansi', 'deskripsi' => 'Akuntansi berbasis syariah'],
            ['kode_mk' => 'AK302', 'nama_mk' => 'Audit Internal', 'sks' => 3, 'semester' => 3, 'jenis' => 'Pilihan', 'jurusan' => 'Akuntansi', 'deskripsi' => 'Prinsip audit'],
        ];

        foreach ($mataKuliah as $mk) {
            MataKuliah::create($mk);
        }
    }
}
