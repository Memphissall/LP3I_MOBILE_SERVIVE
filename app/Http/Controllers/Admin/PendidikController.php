<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Pendidik;
use Illuminate\Http\Request;

class PendidikController extends Controller
{
    public function index()
    {
        $pendidik = Pendidik::with('user')->get();
        return view('admin.pendidik.index', compact('pendidik'));
    }

    public function create()
    {
        return view('admin.pendidik.tambah');
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_pendidik' => 'required|unique:pendidik,id_pendidik',
            'nama_pendidik' => 'required',
            'email_pendidik' => 'required|email|unique:pendidik,email',
            'status' => 'required',
            'foto' => 'image|mimes:jpg,jpeg,png|max:2048'
        ]);

        // Upload foto
        $fotoPath = null;
        if ($request->hasFile('foto')) {
            $fotoPath = $request->file('foto')->store('foto_pendidik', 'public');
        }

        Pendidik::create([
            'user_id' => auth()->id(),
            'id_pendidik' => $request->id_pendidik,
            'nama_pendidik' => $request->nama_pendidik,
            'pendidikan' => $request->pendidikan,
            'bidang' => $request->bidang,
            'tempat' => $request->tempat,
            'tanggal_lahir' => $request->tanggal_lahir,
            'jenis_kelamin' => $request->jenis_kelamin,
            'agama' => $request->agama,
            'email' => $request->email_pendidik,   // ← FIX DISINI
            'no_telp' => $request->no_telp,
            'honor_per_sks' => $request->honor_per_sks,
            'status' => $request->status,
            'foto' => $fotoPath,
        ]);

        return redirect()->route('admin.pendidik.index')
            ->with('success', 'Pendidik berhasil ditambahkan.');
    }

    public function edit(Pendidik $pendidik)
    {
        return view('admin.pendidik.edit', compact('pendidik'));
    }

    public function update(Request $request, Pendidik $pendidik)
    {
        $request->validate([
            'foto' => 'image|mimes:jpg,jpeg,png|max:2048'
        ]);

        if ($request->hasFile('foto')) {
            $fotoPath = $request->file('foto')->store('foto_pendidik', 'public');
            $pendidik->foto = $fotoPath;
        }

        $pendidik->update($request->except('foto'));

        return redirect()->route('admin.pendidik.index')->with('success', 'Data pendidik diperbarui.');
    }

    public function destroy(Pendidik $pendidik)
    {
        $pendidik->delete();
        return back()->with('success', 'Pendidik dihapus.');
    }
}
