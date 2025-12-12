<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Dosen;
use Illuminate\Http\Request;

class DosenController extends Controller
{
    public function index()
    {
        $dosen = Dosen::with('user')->get();
        return view('admin.dosen.index', compact('dosen'));
    }

    public function create()
    {
        return view('admin.dosen.tambah');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nidn' => 'required|unique:dosen,nidn',
            'nama_dosen' => 'required',
            'email_dosen' => 'required|email|unique:dosen,email',
            'status' => 'required',
            'foto' => 'image|mimes:jpg,jpeg,png|max:2048'
        ]);

        // Upload foto
        $fotoPath = null;
        if ($request->hasFile('foto')) {
            $fotoPath = $request->file('foto')->store('foto_dosen', 'public');
        }

        Dosen::create([
            'user_id' => auth()->id(),
            'nidn' => $request->nidn,
            'nama_dosen' => $request->nama_dosen,
            'pendidikan' => $request->pendidikan,
            'bidang' => $request->bidang,
            'tempat' => $request->tempat,
            'tanggal_lahir' => $request->tanggal_lahir,
            'jenis_kelamin' => $request->jenis_kelamin,
            'agama' => $request->agama,
            'email' => $request->email_dosen,   // ← FIX DISINI
            'no_telp' => $request->no_telp,
            'honor_per_sks' => $request->honor_per_sks,
            'status' => $request->status,
            'foto' => $fotoPath,
        ]);

        return redirect()->route('admin.dosen.index')
            ->with('success', 'Dosen berhasil ditambahkan.');
    }

    public function edit(Dosen $dosen)
    {
        return view('admin.dosen.edit', compact('dosen'));
    }

    public function update(Request $request, Dosen $dosen)
    {
        $request->validate([
            'foto' => 'image|mimes:jpg,jpeg,png|max:2048'
        ]);

        if ($request->hasFile('foto')) {
            $fotoPath = $request->file('foto')->store('foto_dosen', 'public');
            $dosen->foto = $fotoPath;
        }

        $dosen->update($request->except('foto'));

        return redirect()->route('admin.dosen.index')->with('success', 'Data dosen diperbarui.');
    }

    public function destroy(Dosen $dosen)
    {
        $dosen->delete();
        return back()->with('success', 'Dosen dihapus.');
    }
}
