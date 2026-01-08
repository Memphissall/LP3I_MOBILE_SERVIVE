<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use App\Models\BidangKeahlian;

class KelasSeeder extends Seeder
{
    public function run()
    {
        // Get available Bidang Keahlian
        // Assuming we map legacy names to existing keys for demo purposes
        // Teknik Informatika -> ASE (Software Engineering)
        // Sistem Informasi -> AIS (Accounting Info System - close enough)
        // Teknik Komputer -> OAA (Office Automation - fallback)
        
        $bkMap = BidangKeahlian::pluck('id_bidang_keahlian', 'kode')->toArray();
        
        // Define safe fallback IDs if codes exist, otherwise null
        $id_ase = $bkMap['ASE'] ?? null;
        $id_ais = $bkMap['AIS'] ?? null;
        $id_oaa = $bkMap['OAA'] ?? null;

        DB::table('kelas')->insert([
            [
                'nama_kelas' => 'A - Pemrograman Web',
                'id_bidang_keahlian' => $id_ase, // Was Teknik Informatika
                'tahun_ajaran' => '2024/2025',
                'nama_pa' => 'Dr. Budi',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_kelas' => 'B - Basis Data',
                'id_bidang_keahlian' => $id_ais, // Was Sistem Informasi
                'tahun_ajaran' => '2024/2025',
                'nama_pa' => 'Ibu Sari',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_kelas' => 'C - Jaringan',
                'id_bidang_keahlian' => $id_oaa, // Was Teknik Komputer
                'tahun_ajaran' => '2024/2025',
                'nama_pa' => 'Pak Andi',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
