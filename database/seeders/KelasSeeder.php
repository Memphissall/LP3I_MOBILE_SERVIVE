<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KelasSeeder extends Seeder
{
    public function run()
    {
        // Program Studi IDs based on database
        // 1 = Accounting Information System (002)
        // 2 = Application Software Engineering (004)
        // 3 = Office Administration Automatization (007)

        DB::table('kelas')->insert([
            // ASE10 - Application Software Engineering
            [
                'nama_kelas' => 'ASE10',
                'id_program_studi' => 2, // Application Software Engineering
                'semester' => 1,
                'tahun_ajaran' => '2024/2025',
                'id_pendidik' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            // AIS12 - Accounting Information System
            [
                'nama_kelas' => 'AIS12',
                'id_program_studi' => 1, // Accounting Information System
                'semester' => 1,
                'tahun_ajaran' => '2024/2025',
                'id_pendidik' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            // OAA13 Q - Office Administration Automatization
            [
                'nama_kelas' => 'OAA13 Q',
                'id_program_studi' => 3, // Office Administration Automatization
                'semester' => 1,
                'tahun_ajaran' => '2024/2025',
                'id_pendidik' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            // OAA13 B - Office Administration Automatization
            [
                'nama_kelas' => 'OAA13 B',
                'id_program_studi' => 3, // Office Administration Automatization
                'semester' => 1,
                'tahun_ajaran' => '2024/2025',
                'id_pendidik' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
