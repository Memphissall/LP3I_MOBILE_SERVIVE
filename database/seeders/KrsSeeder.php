<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Krs;
use App\Models\Mahasiswa;
use App\Models\Dosen;
use App\Models\MataKuliah;
use App\Models\Kelas;

class KrsSeeder extends Seeder
{
    public function run(): void
    {
        // =========================
        // AMBIL MASTER DATA
        // =========================
        $mhsAIS = Mahasiswa::where('nipd', '2407810030002')->firstOrFail();
        $mhsASE = Mahasiswa::where('nipd', '2407810040005')->firstOrFail();
        $mhsOAA = Mahasiswa::where('nipd', '2407810070044')->firstOrFail();

        $kelasAIS = Kelas::where('nama_kelas', 'AIS-12')->firstOrFail();
        $kelasASE = Kelas::where('nama_kelas', 'ASE-10')->firstOrFail();
        $kelasOAA = Kelas::where('nama_kelas', 'OAA-13A')->firstOrFail();

        $dosenAIS = Dosen::where('bidang', 'Accounting Information System')->firstOrFail();
        $dosenASE = Dosen::where('bidang', 'Application Software Engineering')->firstOrFail();
        $dosenOAA = Dosen::where('bidang', 'Office Administration Automatization')->firstOrFail();

        // Mata kuliah umum
        $mkUmum = MataKuliah::whereNull('id_program_studi')->get();

        // Mata kuliah inti
        $mkAIS = MataKuliah::where('kode_mk', 'AIS-101')->firstOrFail();
        $mkASE = MataKuliah::where('kode_mk', 'ASE-101')->firstOrFail();
        $mkOAA = MataKuliah::where('kode_mk', 'OAA-101')->firstOrFail();

        // =========================
        // ISI KRS
        // =========================
        $data = [];

        // ===== AIS
        foreach ($mkUmum as $mk) {
            $data[] = [
                'id_mahasiswa' => $mhsAIS->id_mahasiswa,
                'id_pendidik' => $dosenAIS->id_pendidik,
                'id_kelas' => $kelasAIS->id_kelas,
                'id_mk' => $mk->id_mk,
                'semester' => 1,
                'sks' => $mk->sks,
            ];
        }

        $data[] = [
            'id_mahasiswa' => $mhsAIS->id_mahasiswa,
            'id_pendidik' => $dosenAIS->id_pendidik,
            'id_kelas' => $kelasAIS->id_kelas,
            'id_mk' => $mkAIS->id_mk,
            'semester' => 1,
            'sks' => $mkAIS->sks,
        ];

        // ===== ASE
        foreach ($mkUmum as $mk) {
            $data[] = [
                'id_mahasiswa' => $mhsASE->id_mahasiswa,
                'id_pendidik' => $dosenASE->id_pendidik,
                'id_kelas' => $kelasASE->id_kelas,
                'id_mk' => $mk->id_mk,
                'semester' => 1,
                'sks' => $mk->sks,
            ];
        }

        $data[] = [
            'id_mahasiswa' => $mhsASE->id_mahasiswa,
            'id_pendidik' => $dosenASE->id_pendidik,
            'id_kelas' => $kelasASE->id_kelas,
            'id_mk' => $mkASE->id_mk,
            'semester' => 1,
            'sks' => $mkASE->sks,
        ];

        // ===== OAA
        foreach ($mkUmum as $mk) {
            $data[] = [
                'id_mahasiswa' => $mhsOAA->id_mahasiswa,
                'id_pendidik' => $dosenOAA->id_pendidik,
                'id_kelas' => $kelasOAA->id_kelas,
                'id_mk' => $mk->id_mk,
                'semester' => 1,
                'sks' => $mk->sks,
            ];
        }

        $data[] = [
            'id_mahasiswa' => $mhsOAA->id_mahasiswa,
            'id_pendidik' => $dosenOAA->id_pendidik,
            'id_kelas' => $kelasOAA->id_kelas,
            'id_mk' => $mkOAA->id_mk,
            'semester' => 1,
            'sks' => $mkOAA->sks,
        ];

        foreach ($data as $item) {
            Krs::create($item);
        }
    }
}
