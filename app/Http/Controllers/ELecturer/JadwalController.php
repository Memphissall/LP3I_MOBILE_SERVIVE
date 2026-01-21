<?php

namespace App\Http\Controllers\ELecturer;

use App\Http\Controllers\Controller;
use App\Models\Jadwal;
use Illuminate\Support\Facades\Auth;

class JadwalController extends Controller
{
  public function index()
    {
        // Ambil data pendidik dari user yang login
        $pendidik = Auth::user()->pendidik;

        if (!$pendidik) {
            return back()->with('error', 'Data pendidik tidak ditemukan untuk akun ini.');
        }

        $jadwal = Jadwal::with(['matakuliah', 'kelas', 'ruangan', 'pendidik'])
            ->where('id_pendidik', $pendidik->id_pendidik)
            ->get();

        return view('admin.pendidik.jadwal.index', compact('jadwal'));
    }


}
