<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DosenSeeder extends Seeder
{
    public function run()
    {
        // Get mata kuliah IDs for assignment
        $matkul = DB::table('mata_kuliah')->select('id_matkul', 'kode_mk', 'nama_mk')->get()->keyBy('kode_mk');
        
        $dosen = [
            // DOSEN BAHASA INGGRIS (untuk semua English courses)
            [
                'nidn' => '0103038803',
                'nama_dosen' => 'Citra Dewi, S.S., M.Pd.',
                'email' => 'citra.dewi@lp3i.ac.id',
                'no_telp' => '081234567003',
                'pendidikan' => 'S2 - Pendidikan Bahasa',
                'bidang' => 'Bahasa Inggris',
                'jenis_kelamin' => 'Perempuan',
                'status' => 'Aktif',
                'id_matkul' => $matkul['23OA0101']->id_matkul ?? null, // English 1
            ],
            
            // DOSEN PEMROGRAMAN WEB (untuk Web Programming courses)
            [
                'nidn' => '0108088808',
                'nama_dosen' => 'Hendra Kusuma, S.Kom., M.T.',
                'email' => 'hendra.kusuma@lp3i.ac.id',
                'no_telp' => '081234567008',
                'pendidikan' => 'S2 - Teknologi Informasi',
                'bidang' => 'Pemrograman Web',
                'jenis_kelamin' => 'Laki-laki',
                'status' => 'Aktif',
                'id_matkul' => $matkul['23AD0201']->id_matkul ?? null, // Web Programming 1
            ],
            
            // DOSEN DATABASE
            [
                'nidn' => '0109098809',
                'nama_dosen' => 'Indah Permata, S.Kom., M.Sc.',
                'email' => 'indah.permata@lp3i.ac.id',
                'no_telp' => '081234567009',
                'pendidikan' => 'S2 - Computer Science',
                'bidang' => 'Database & Big Data',
                'jenis_kelamin' => 'Perempuan',
                'status' => 'Aktif',
                'id_matkul' => $matkul['23AD0202']->id_matkul ?? null, // Database 1
            ],
            
            // DOSEN PEMROGRAMAN (Java, Python, dll)
            [
                'nidn' => '0107078807',
                'nama_dosen' => 'Dr. Gunawan Wibisono, S.T., M.Kom.',
                'email' => 'gunawan.wibisono@lp3i.ac.id',
                'no_telp' => '081234567007',
                'pendidikan' => 'S3 - Teknik Informatika',
                'bidang' => 'Pemrograman & RPL',
                'jenis_kelamin' => 'Laki-laki',
                'status' => 'Aktif',
                'id_matkul' => $matkul['23AD0101']->id_matkul ?? null, // Algorithms & Programming
            ],
            
            // DOSEN AKUNTANSI
            [
                'nidn' => '0104048804',
                'nama_dosen' => 'Dr. Denny Prasetyo, S.E., M.Ak.',
                'email' => 'denny.prasetyo@lp3i.ac.id',
                'no_telp' => '081234567004',
                'pendidikan' => 'S3 - Akuntansi',
                'bidang' => 'Akuntansi',
                'jenis_kelamin' => 'Laki-laki',
                'status' => 'Aktif',
                'id_matkul' => $matkul['23CA0101']->id_matkul ?? null, // Pengantar Akuntansi
            ],
            
            // DOSEN PERPAJAKAN
            [
                'nidn' => '0105058805',
                'nama_dosen' => 'Eka Yulianti, S.E., M.Si.',
                'email' => 'eka.yulianti@lp3i.ac.id',
                'no_telp' => '081234567005',
                'pendidikan' => 'S2 - Perpajakan',
                'bidang' => 'Perpajakan',
                'jenis_kelamin' => 'Perempuan',
                'status' => 'Aktif',
                'id_matkul' => $matkul['23CA0201']->id_matkul ?? null, // Perpajakan
            ],
            
            // DOSEN MANAJEMEN
            [
                'nidn' => '0106068806',
                'nama_dosen' => 'Faisal Rahman, S.E., M.M.',
                'email' => 'faisal.rahman@lp3i.ac.id',
                'no_telp' => '081234567006',
                'pendidikan' => 'S2 - Manajemen',
                'bidang' => 'Manajemen',
                'jenis_kelamin' => 'Laki-laki',
                'status' => 'Aktif',
                'id_matkul' => $matkul['23OA0201']->id_matkul ?? null, // Business Management
            ],
            
            // DOSEN OFFICE (Ms. Office, dll)
            [
                'nidn' => '0101018801',
                'nama_dosen' => 'Dr. Anita Rahmawati, S.E., M.M.',
                'email' => 'anita.rahmawati@lp3i.ac.id',
                'no_telp' => '081234567001',
                'pendidikan' => 'S3 - Manajemen',
                'bidang' => 'Aplikasi Perkantoran',
                'jenis_kelamin' => 'Perempuan',
                'status' => 'Aktif',
                'id_matkul' => $matkul['23OA0102']->id_matkul ?? null, // Office Applications
            ],
            
            // DOSEN SISTEM INFORMASI
            [
                'nidn' => '0102028802',
                'nama_dosen' => 'Budi Santoso, S.Kom., M.T.',
                'email' => 'budi.santoso@lp3i.ac.id',
                'no_telp' => '081234567002',
                'pendidikan' => 'S2 - Sistem Informasi',
                'bidang' => 'Sistem Informasi',
                'jenis_kelamin' => 'Laki-laki',
                'status' => 'Aktif',
                'id_matkul' => $matkul['23CA0102']->id_matkul ?? null, // Sistem Informasi Akuntansi
            ],
            
            // DOSEN JARINGAN
            [
                'nidn' => '0110108810',
                'nama_dosen' => 'Joko Widodo, S.T., M.T.',
                'email' => 'joko.widodo@lp3i.ac.id',
                'no_telp' => '081234567010',
                'pendidikan' => 'S2 - Teknik Elektro',
                'bidang' => 'Jaringan Komputer',
                'jenis_kelamin' => 'Laki-laki',
                'status' => 'Aktif',
                'id_matkul' => $matkul['23AD0301']->id_matkul ?? null, // Computer Networks
            ],
            
            // DOSEN SOFT SKILLS
            [
                'nidn' => '0111118811',
                'nama_dosen' => 'Prof. Dr. Kartini Sari, S.Pd., M.Pd.',
                'email' => 'kartini.sari@lp3i.ac.id',
                'no_telp' => '081234567011',
                'pendidikan' => 'S3 - Pendidikan',
                'bidang' => 'Kewirausahaan & Soft Skills',
                'jenis_kelamin' => 'Perempuan',
                'status' => 'Aktif',
                'id_matkul' => $matkul['23AD0103']->id_matkul ?? null, // Character Building
            ],
            
            // DOSEN HUKUM BISNIS
            [
                'nidn' => '0112128812',
                'nama_dosen' => 'Linda Setyawati, S.H., M.H.',
                'email' => 'linda.setyawati@lp3i.ac.id',
                'no_telp' => '081234567012',
                'pendidikan' => 'S2 - Hukum',
                'bidang' => 'Hukum Bisnis',
                'jenis_kelamin' => 'Perempuan',
                'status' => 'Aktif',
                'id_matkul' => $matkul['23OA0301']->id_matkul ?? null, // Business Law
            ],
        ];

        foreach ($dosen as $d) {
            DB::table('dosen')->insert(array_merge($d, [
                'created_at' => now(),
                'updated_at' => now()
            ]));
        }
        
        // Update related courses dengan dosen yang sama
        $this->assignRelatedCourses();
    }
    
    private function assignRelatedCourses()
    {
        // English courses - semua English pakai dosen yang sama
        $dosenEnglish = DB::table('dosen')->where('bidang', 'Bahasa Inggris')->first();
        if ($dosenEnglish) {
            DB::table('mata_kuliah')
                ->where('nama_mk', 'LIKE', '%English%')
                ->update(['updated_at' => now()]); // Tetap pakai id_matkul yang sudah di-set di dosen
            
            // Clone dosen untuk English 2, 3, 4
            $englishCourses = DB::table('mata_kuliah')
                ->where('nama_mk', 'LIKE', '%English%')
                ->where('kode_mk', '!=', '23OA0101')
                ->get();
                
            foreach ($englishCourses as $course) {
                DB::table('dosen')->insert([
                    'nidn' => $dosenEnglish->nidn . '_' . $course->kode_mk,
                    'nama_dosen' => $dosenEnglish->nama_dosen,
                    'email' => str_replace('@', "+{$course->kode_mk}@", $dosenEnglish->email),
                    'no_telp' => $dosenEnglish->no_telp,
                    'pendidikan' => $dosenEnglish->pendidikan,
                    'bidang' => $dosenEnglish->bidang,
                    'jenis_kelamin' => $dosenEnglish->jenis_kelamin,
                    'status' => $dosenEnglish->status,
                    'id_matkul' => $course->id_matkul,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }
        
        // Web Programming courses
        $dosenWeb = DB::table('dosen')->where('bidang', 'Pemrograman Web')->first();
        if ($dosenWeb) {
            $webCourses = DB::table('mata_kuliah')
                ->where(function($q) {
                    $q->where('nama_mk', 'LIKE', '%Web Programming%')
                      ->orWhere('nama_mk', 'LIKE', '%Frontend%')
                      ->orWhere('nama_mk', 'LIKE', '%Backend%');
                })
                ->where('kode_mk', '!=', '23AD0201')
                ->get();
                
            foreach ($webCourses as $course) {
                DB::table('dosen')->insert([
                    'nidn' => $dosenWeb->nidn . '_' . $course->kode_mk,
                    'nama_dosen' => $dosenWeb->nama_dosen,
                    'email' => str_replace('@', "+{$course->kode_mk}@", $dosenWeb->email),
                    'no_telp' => $dosenWeb->no_telp,
                    'pendidikan' => $dosenWeb->pendidikan,
                    'bidang' => $dosenWeb->bidang,
                    'jenis_kelamin' => $dosenWeb->jenis_kelamin,
                    'status' => $dosenWeb->status,
                    'id_matkul' => $course->id_matkul,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }
        
        // Database courses
        $dosenDB = DB::table('dosen')->where('bidang', 'Database & Big Data')->first();
        if ($dosenDB) {
            $dbCourses = DB::table('mata_kuliah')
                ->where('nama_mk', 'LIKE', '%Database%')
                ->where('kode_mk', '!=', '23AD0202')
                ->get();
                
            foreach ($dbCourses as $course) {
                DB::table('dosen')->insert([
                    'nidn' => $dosenDB->nidn . '_' . $course->kode_mk,
                    'nama_dosen' => $dosenDB->nama_dosen,
                    'email' => str_replace('@', "+{$course->kode_mk}@", $dosenDB->email),
                    'no_telp' => $dosenDB->no_telp,
                    'pendidikan' => $dosenDB->pendidikan,
                    'bidang' => $dosenDB->bidang,
                    'jenis_kelamin' => $dosenDB->jenis_kelamin,
                    'status' => $dosenDB->status,
                    'id_matkul' => $course->id_matkul,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }
    }
}
