<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Kelas;
use App\Models\BidangKeahlian;

class KelasSeeder extends Seeder
{
    public function run(): void
    {
        // Ambil bidang keahlian
        $ase = BidangKeahlian::where('kode_program_studi', '002')->firstOrFail();
        $ais = BidangKeahlian::where('kode_program_studi', '004')->firstOrFail();
        $oaa = BidangKeahlian::where('kode_program_studi', '007')->firstOrFail();

        $data = [
            [
                'nama_kelas' => 'AIS-12',
                'id_program_studi' => $ais->id_program_studi,
                'semester'=> 1
            ],
            [
                'nama_kelas' => 'ASE-10',
                'id_program_studi' => $ase->id_program_studi,
                'semester'=> 1
            ],
            [
                'nama_kelas' => 'OAA-13A',
                'id_program_studi' => $oaa->id_program_studi,
                'semester'=> 1
            ],
        ];

        foreach ($data as $kelas) {
            Kelas::create($kelas);
        }
    }
}
