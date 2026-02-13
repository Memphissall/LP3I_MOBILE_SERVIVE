<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DosenSeeder extends Seeder
{
    public function run()
    {
        // Helper to find matkul by name
        $findMatkul = function($pattern) {
            return DB::table('mata_kuliah')->where('nama_mk', 'LIKE', $pattern)->first()->id_matkul ?? null;
        };

        // CLEANUP: Delete all generated 'clone' lecturers (identifiers containing '_') 
        // to ensure a fresh start for smart assignment logic.
        // This fixes the issue where old 'random' assignments persist because they are skipped by 'already assigned' checks.
        $deleted = DB::table('dosen')->where('nidn', 'LIKE', '%\_%')->delete();
        if ($deleted > 0) {
            $this->command->info("Deleted $deleted old generated lecturer assignments.");
        }

        $dosen = [
            // DOSEN BAHASA INGGRIS
            [
                'nidn' => '0103038803',
                'nama_dosen' => 'Citra Dewi, S.S., M.Pd.',
                'email' => 'citra.dewi@lp3i.ac.id',
                'no_telp' => '081234567003',
                'pendidikan' => 'S2 - Pendidikan Bahasa',
                'bidang' => 'Bahasa Inggris',
                'jenis_kelamin' => 'Perempuan',
                'status' => 'Aktif',
                'id_matkul' => $findMatkul('%English%1%') ?? $findMatkul('%English%'),
            ],
            
            // DOSEN PEMROGRAMAN WEB
            [
                'nidn' => '0108088808',
                'nama_dosen' => 'Hendra Kusuma, S.Kom., M.T.',
                'email' => 'hendra.kusuma@lp3i.ac.id',
                'no_telp' => '081234567008',
                'pendidikan' => 'S2 - Teknologi Informasi',
                'bidang' => 'Pemrograman Web',
                'jenis_kelamin' => 'Laki-laki',
                'status' => 'Aktif',
                'id_matkul' => $findMatkul('%Web%Programming%') ?? $findMatkul('%Pemrograman%Web%'),
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
                'id_matkul' => $findMatkul('%Database%') ?? $findMatkul('%Basis%Data%'),
            ],
            
            // DOSEN PEMROGRAMAN
            [
                'nidn' => '0107078807',
                'nama_dosen' => 'Dr. Gunawan Wibisono, S.T., M.Kom.',
                'email' => 'gunawan.wibisono@lp3i.ac.id',
                'no_telp' => '081234567007',
                'pendidikan' => 'S3 - Teknik Informatika',
                'bidang' => 'Pemrograman & RPL',
                'jenis_kelamin' => 'Laki-laki',
                'status' => 'Aktif',
                'id_matkul' => $findMatkul('%Algoritma%') ?? $findMatkul('%Programming%'),
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
                'id_matkul' => $findMatkul('%Pengantar%Akuntansi%'),
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
                'id_matkul' => $findMatkul('%Perpajakan%'),
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
                'id_matkul' => $findMatkul('%Business%Management%') ?? $findMatkul('%Manajemen%'),
            ],
            
            // DOSEN OFFICE
            [
                'nidn' => '0101018801',
                'nama_dosen' => 'Dr. Anita Rahmawati, S.E., M.M.',
                'email' => 'anita.rahmawati@lp3i.ac.id',
                'no_telp' => '081234567001',
                'pendidikan' => 'S3 - Manajemen',
                'bidang' => 'Aplikasi Perkantoran',
                'jenis_kelamin' => 'Perempuan',
                'status' => 'Aktif',
                'id_matkul' => $findMatkul('%Office%') ?? $findMatkul('%Perkantoran%'),
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
                'id_matkul' => $findMatkul('%Sistem%Informasi%'),
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
                'id_matkul' => $findMatkul('%Networking%') ?? $findMatkul('%Jaringan%'),
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
                'id_matkul' => $findMatkul('%Character%') ?? $findMatkul('%Kewirausahaan%'),
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
                'id_matkul' => $findMatkul('%Law%') ?? $findMatkul('%Hukum%'),
            ],
        ];

        foreach ($dosen as $d) {
            DB::table('dosen')->updateOrInsert(
                ['nidn' => $d['nidn']],
                array_merge($d, [
                    'updated_at' => now()
                ])
            );
        }
        
        // Update related courses dengan dosen yang sama
        // DISABLED: assignRemainingCourses() already handles all Materi Ajar assignment
        // $this->assignRelatedCourses();
        
        // Assign ALL remaining Materi Ajar to dosen
        $this->assignRemainingCourses();
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
                DB::table('dosen')->updateOrInsert(
                    ['nidn' => $dosenEnglish->nidn . '_' . $course->kode_mk],
                    [
                        'nama_dosen' => $dosenEnglish->nama_dosen,
                        'email' => str_replace('@', "+{$course->kode_mk}@", $dosenEnglish->email),
                        'no_telp' => $dosenEnglish->no_telp,
                        'pendidikan' => $dosenEnglish->pendidikan,
                        'bidang' => $dosenEnglish->bidang,
                        'jenis_kelamin' => $dosenEnglish->jenis_kelamin,
                        'status' => $dosenEnglish->status,
                        'id_matkul' => $course->id_matkul,
                        'updated_at' => now(),
                    ]
                );
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
                DB::table('dosen')->updateOrInsert(
                    ['nidn' => $dosenWeb->nidn . '_' . $course->kode_mk],
                    [
                        'nama_dosen' => $dosenWeb->nama_dosen,
                        'email' => str_replace('@', "+{$course->kode_mk}@", $dosenWeb->email),
                        'no_telp' => $dosenWeb->no_telp,
                        'pendidikan' => $dosenWeb->pendidikan,
                        'bidang' => $dosenWeb->bidang,
                        'jenis_kelamin' => $dosenWeb->jenis_kelamin,
                        'status' => $dosenWeb->status,
                        'id_matkul' => $course->id_matkul,
                        'updated_at' => now(),
                    ]
                );
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
                DB::table('dosen')->updateOrInsert(
                    ['nidn' => $dosenDB->nidn . '_' . $course->kode_mk],
                    [
                        'nama_dosen' => $dosenDB->nama_dosen,
                        'email' => str_replace('@', "+{$course->kode_mk}@", $dosenDB->email),
                        'no_telp' => $dosenDB->no_telp,
                        'pendidikan' => $dosenDB->pendidikan,
                        'bidang' => $dosenDB->bidang,
                        'jenis_kelamin' => $dosenDB->jenis_kelamin,
                        'status' => $dosenDB->status,
                        'id_matkul' => $course->id_matkul,
                        'updated_at' => now(),
                    ]
                );
            }
        }
        
        // Assign ALL remaining Materi Ajar to dosen
        $this->assignRemainingCourses();
    }
    
    private function assignRemainingCourses()
    {
        // Get all Materi Ajar
        $allMatkul = DB::table('mata_kuliah')->orderBy('id_matkul')->get(); // Order to ensure deterministic seed
        
        // Get ALL existing dosen with their assigned matkul (including clones)
        $assignedMatkulIds = DB::table('dosen')->pluck('id_matkul')->toArray();
        
        // Find unassigned Materi Ajar
        $unassignedMatkul = $allMatkul->filter(function($mk) use ($assignedMatkulIds) {
            return !in_array($mk->id_matkul, $assignedMatkulIds);
        });
        
        if ($unassignedMatkul->isEmpty()) {
            echo "All Materi Ajar already have assigned dosen.\n";
            return; // All Materi Ajar already assigned
        }
        
        echo "Found " . $unassignedMatkul->count() . " unassigned Materi Ajar. Assigning dosen with smart matching...\n";
        
        // Get base dosen templates (the original 12 dosen)
        $baseDosen = DB::table('dosen')
            ->where('nidn', 'NOT LIKE', '%\_%') // Only original dosen, not clones
            ->get();
        
        if ($baseDosen->isEmpty()) {
            return; // No dosen to assign
        }

        // Keywords mapping for smarter matching
        $matchRules = [
            'Bahasa Inggris' => ['English', 'Communication', 'Language', 'TOEFL'],
            'Pemrograman Web' => ['Web', 'Internet', 'E-Business', 'Frontend', 'Backend', 'HTML', 'CSS', 'Javascript', 'PHP', 'Framework'],
            'Database & Big Data' => ['Data', 'Basis', 'Information', 'Warehouse', 'Mining', 'SQL'],
            'Pemrograman & RPL' => ['Algoritma', 'Algorithm', 'Program', 'Logic', 'Computer', 'Digital', 'System Design', 'OOP', 'Java', 'C++', 'Python', 'Mobile', 'Android', 'IOS'],
            'Akuntansi' => ['Account', 'Akuntan', 'Cost', 'Biaya', 'Keuangan', 'Finance', 'Budget', 'Audit'],
            'Perpajakan' => ['Tax', 'Pajak', 'Fiskal'],
            'Manajemen' => ['Manage', 'Manajemen', 'Bisnis', 'Business', 'Marketing', 'Lead', 'Entrepreneur', 'Wirausaha'],
            'Aplikasi Perkantoran' => ['Office', 'Perkantoran', 'Excel', 'Word', 'PowerPoint', 'Typing', 'Arsip', 'Filing', 'Correspondence', 'Surat'],
            'Sistem Informasi' => ['Sistem Informasi', 'Information System', 'Analisis', 'Analysis', 'ERP', 'SAP'],
            'Jaringan Komputer' => ['Network', 'Jaringan', 'Security', 'Hardware', 'Operating System', 'Linux', 'Cloud', 'Server', 'Mikrotik', 'Cisco'],
            'Kewirausahaan & Soft Skills' => ['Character', 'Kewirausahaan', 'Soft', 'Personality', 'K3', 'Ethics', 'Etika', 'Pancasila', 'Kewarganegaraan', 'Religion', 'Agama'],
            'Hukum Bisnis' => ['Law', 'Hukum', 'Legal'],
        ];
        
        // Assign unassigned Materi Ajar to dosen
        $dosenIndex = 0;
        foreach ($unassignedMatkul as $matkul) {
            
            // 1. Try to find BEST MATCH dosen based on keywords
            $matchedDosen = null;
            foreach ($matchRules as $bidang => $keywords) {
                foreach ($keywords as $keyword) {
                    if (stripos($matkul->nama_mk, $keyword) !== false) {
                        // Found a keyword match! Find the dosen with this bidang
                        $matchedDosen = $baseDosen->firstWhere('bidang', $bidang);
                        if ($matchedDosen) break 2;
                    }
                }
            }
            
            // 2. Fallback to round-robin if no match found
            $templateDosen = $matchedDosen ?? $baseDosen[$dosenIndex % $baseDosen->count()];
            if (!$matchedDosen) $dosenIndex++; // Only increment round-robin index if we used it

            // Create new dosen entry for this matkul
            DB::table('dosen')->updateOrInsert(
                ['nidn' => $templateDosen->nidn . '_' . $matkul->kode_mk],
                [
                    'nama_dosen' => $templateDosen->nama_dosen,
                    'email' => str_replace('@', "+{$matkul->kode_mk}@", $templateDosen->email),
                    'no_telp' => $templateDosen->no_telp,
                    'pendidikan' => $templateDosen->pendidikan,
                    'bidang' => $templateDosen->bidang,
                    'jenis_kelamin' => $templateDosen->jenis_kelamin,
                    'status' => $templateDosen->status,
                    'id_matkul' => $matkul->id_matkul,
                    'tempat' => $templateDosen->tempat ?? 'Jakarta',
                    'tanggal_lahir' => $templateDosen->tanggal_lahir ?? '1990-01-01',
                    'agama' => $templateDosen->agama ?? 'Islam',
                    'honor_per_sks' => $templateDosen->honor_per_sks ?? 150000,
                    'user_id' => $templateDosen->user_id ?? 1,
                    'alamat' => $templateDosen->alamat ?? 'Karawang',
                    'created_at' => now(),
                    'updated_at' => now(),
                ]
            );
        }
        
        echo "Successfully assigned " . $unassignedMatkul->count() . " Materi Ajar to dosen.\n";
    }
}
