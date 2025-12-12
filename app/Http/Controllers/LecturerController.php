<?php
// app/Http/Controllers/LecturerController.php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;

class LecturerController extends Controller
{
    // Gunakan data mockup yang sama, tetapi di PHP
    protected $initialLecturers = [
        [
            'id' => 99,
            'nidn' => 'TEST01',
            'nama' => 'Test Dosen 1',
            'kelas_diajar' => 'Testing',
            'tempat_lahir' => 'Test',
            'tanggal_lahir' => '2000-01-01',
            'alamat' => 'Test',
            'jenis_kelamin' => 'Laki-laki',
            'pendidikan_terakhir' => 'S1',
            'bidang' => 'Test',
            'agama' => 'Islam',
            'foto' => '', 
            'email' => 'test@test.com',
            'no_tlp' => '00000',
            'honor' => '100',
            'status' => 'Aktif',
        ],
    ];

    public function index()
    {
        // Di sini, kamu akan mengambil data dari database (misal: Lecturer::all())
        // Untuk saat ini, kita gunakan data mockup:
        $lecturers = $this->initialLecturers;

        return view('akademik.data_dosen', [
            'lecturers' => $lecturers
        ]);
    }

    // CATATAN:
    // Fungsi store(), update(), dan destroy() untuk API 
    // akan kamu buat terpisah di Controller ini
}
