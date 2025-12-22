<?php

namespace App\Http\Controllers\ELecturer;

use App\Http\Controllers\Controller;
use App\Models\Jadwal;
use Illuminate\Support\Facades\Auth;

class JadwalController extends Controller
{
  public function index()
    {
        // Ambil data dosen dari user yang login
        $dosen = Auth::user()->dosen;

        if (!$dosen) {
            return back()->with('error', 'Data dosen tidak ditemukan untuk akun ini.');
        }

        $jadwal = Jadwal::with(['matakuliah', 'kelas', 'ruangan', 'dosen'])
            ->where('nidn', $dosen->nidn)
            ->get();

        return view('admin.dosen.jadwal.index', compact('jadwal'));
    }


}
