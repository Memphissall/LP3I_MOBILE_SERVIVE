<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Mahasiswa;
use App\Models\Kelas;

class MahasiswaController extends Controller
{
    public function create()
    {
        $kelas = Kelas::all();
        return view('admin.mahasiswa.tambah', compact('kelas'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nim_mhs' => 'nullable|string|unique:mahasiswa,nim_mhs',
            'nama_mhs' => 'required|string|max:255',
            'jk_mhs' => 'required|in:Laki-laki,Perempuan',
            'tempat_lahir' => 'nullable|string',
            'tgl_lahir' => 'nullable|date',
            'agama' => 'nullable|string',
            'id_kelas' => 'nullable|exists:kelas,id',
            'jurusan' => 'nullable|string',
            'email_mhs' => 'required|email|unique:mahasiswa,email',
            'alamat' => 'nullable|string',
            'no_telp_mhs' => 'nullable|string',
        ]);

        Mahasiswa::create([
            'nim_mhs' => $request->nim_mhs,
            'nama_mhs' => $request->nama_mhs,
            'jenis_kelamin' => $request->jk_mhs,
            'tempat_lahir' => $request->tempat_lahir,
            'tgl_lahir' => $request->tgl_lahir,
            'agama' => $request->agama,
            'id_kelas' => $request->id_kelas,
            'jurusan' => $request->jurusan,
            'email' => $request->email_mhs, // FIX
            'alamat' => $request->alamat,
            'no_telp' => $request->no_telp_mhs, // FIX
        ]);

        return redirect()->back()->with('success', 'Mahasiswa berhasil ditambahkan!');
    }
}
