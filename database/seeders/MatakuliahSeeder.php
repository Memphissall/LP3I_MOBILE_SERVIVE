<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class MataKuliahSeeder extends Seeder
{
    public function run(): void
    {
        /* ==========================
           INSERT MATA KULIAH
        =========================== */
        DB::table('matakuliah')->insert([

            /* ===== AIS (id_kelas = 1) ===== */
            [
                'kode_mk' => 'AIS001',
                'nama_mk' => 'Pengantar Akuntansi',
                'sks' => 2,
                'semester' => 1,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'kode_mk' => 'AIS002',
                'nama_mk' => 'Akuntansi Keuangan',
                'sks' => 4,
                'semester' => 1,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'kode_mk' => 'AIS003',
                'nama_mk' => 'Sistem Informasi Akuntansi',
                'sks' => 4,
                'semester' => 1,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'kode_mk' => 'AIS004',
                'nama_mk' => 'Basis Data Akuntansi',
                'sks' => 2,
                'semester' => 1,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'kode_mk' => 'AIS005',
                'nama_mk' => 'Akuntansi Biaya',
                'sks' => 4,
                'semester' => 1,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'kode_mk' => 'AIS006',
                'nama_mk' => 'Audit Sistem Informasi',
                'sks' => 4,
                'semester' => 1,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'kode_mk' => 'AIS007',
                'nama_mk' => 'Analisis dan Perancangan Sistem',
                'sks' => 2,
                'semester' => 1,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'kode_mk' => 'AIS008',
                'nama_mk' => 'Aplikasi Akuntansi (MYOB / Accurate)',
                'sks' => 4,
                'semester' => 1,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],

            /* ===== ASE (id_kelas = 2) ===== */
            [
                'kode_mk' => 'ASE001',
                'nama_mk' => 'Database Administration',
                'sks' => 4,
                'semester' => 1,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'kode_mk' => 'ASE002',
                'nama_mk' => 'Web Programming 1',
                'sks' => 4,
                'semester' => 1,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'kode_mk' => 'ASE003',
                'nama_mk' => 'Computer Network Design',
                'sks' => 2,
                'semester' => 1,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'kode_mk' => 'ASE004',
                'nama_mk' => 'English for General Communication 2',
                'sks' => 2,
                'semester' => 1,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'kode_mk' => 'ASE005',
                'nama_mk' => 'Technique of Presentation',
                'sks' => 2,
                'semester' => 1,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'kode_mk' => 'ASE006',
                'nama_mk' => 'Education of Religion',
                'sks' => 2,
                'semester' => 1,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'kode_mk' => 'ASE007',
                'nama_mk' => 'Smart Entrepreneurship 1',
                'sks' => 2,
                'semester' => 1,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'kode_mk' => 'ASE008',
                'nama_mk' => 'Design Thinking',
                'sks' => 2,
                'semester' => 1,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'kode_mk' => 'ASE009',
                'nama_mk' => 'Graphics Design',
                'sks' => 2,
                'semester' => 1,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],

            /* ===== OAA (id_kelas = 3) ===== */
            [
                'kode_mk' => 'OAA001',
                'nama_mk' => 'Pengantar Administrasi Perkantoran',
                'sks' => 2,
                'semester' => 1,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'kode_mk' => 'OAA002',
                'nama_mk' => 'Otomatisasi Perkantoran',
                'sks' => 4,
                'semester' => 1,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'kode_mk' => 'OAA003',
                'nama_mk' => 'Manajemen Arsip Digital',
                'sks' => 2,
                'semester' => 1,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'kode_mk' => 'OAA004',
                'nama_mk' => 'Aplikasi Perkantoran (Word, Excel, PPT)',
                'sks' => 4,
                'semester' => 1,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'kode_mk' => 'OAA005',
                'nama_mk' => 'Korespondensi Bisnis',
                'sks' => 2,
                'semester' => 1,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'kode_mk' => 'OAA006',
                'nama_mk' => 'Sistem Informasi Perkantoran',
                'sks' => 4,
                'semester' => 1,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'kode_mk' => 'OAA007',
                'nama_mk' => 'Etika Profesi dan Komunikasi Kantor',
                'sks' => 2,
                'semester' => 1,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'kode_mk' => 'OAA008',
                'nama_mk' => 'Administrasi Sumber Daya Manusia',
                'sks' => 4,
                'semester' => 1,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ]);

        /* ==========================
           RELASI KELAS ↔ MATAKULIAH
        =========================== */
        DB::table('kelas_matakuliah')->insert([

            /* ===== AIS ===== */
            ['id_kelas' => 1, 'kode_mk' => 'AIS001'],
            ['id_kelas' => 1, 'kode_mk' => 'AIS002'],
            ['id_kelas' => 1, 'kode_mk' => 'AIS003'],
            ['id_kelas' => 1, 'kode_mk' => 'AIS004'],
            ['id_kelas' => 1, 'kode_mk' => 'AIS005'],
            ['id_kelas' => 1, 'kode_mk' => 'AIS006'],
            ['id_kelas' => 1, 'kode_mk' => 'AIS007'],
            ['id_kelas' => 1, 'kode_mk' => 'AIS008'],

            /* ===== ASE ===== */
            ['id_kelas' => 2, 'kode_mk' => 'ASE001'],
            ['id_kelas' => 2, 'kode_mk' => 'ASE002'],
            ['id_kelas' => 2, 'kode_mk' => 'ASE003'],
            ['id_kelas' => 2, 'kode_mk' => 'ASE004'],
            ['id_kelas' => 2, 'kode_mk' => 'ASE005'],
            ['id_kelas' => 2, 'kode_mk' => 'ASE006'],
            ['id_kelas' => 2, 'kode_mk' => 'ASE007'],
            ['id_kelas' => 2, 'kode_mk' => 'ASE008'],
            ['id_kelas' => 2, 'kode_mk' => 'ASE009'],

            /* ===== OAA ===== */
            ['id_kelas' => 3, 'kode_mk' => 'OAA001'],
            ['id_kelas' => 3, 'kode_mk' => 'OAA002'],
            ['id_kelas' => 3, 'kode_mk' => 'OAA003'],
            ['id_kelas' => 3, 'kode_mk' => 'OAA004'],
            ['id_kelas' => 3, 'kode_mk' => 'OAA005'],
            ['id_kelas' => 3, 'kode_mk' => 'OAA006'],
            ['id_kelas' => 3, 'kode_mk' => 'OAA007'],
            ['id_kelas' => 3, 'kode_mk' => 'OAA008'],
        ]);
    }
}
