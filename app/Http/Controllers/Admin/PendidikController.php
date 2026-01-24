<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
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
            'id_pendidik'   => 'required|unique:pendidik,id_pendidik',
            'nama_pendidik' => 'required',
            'email_pendidik'=> 'required|email|unique:pendidik,email',
            'tempat_lahir'  => 'required',
            'tgl_lahir'     => 'required|date',
            'no_tlp'        => 'required',
            'rate_gaji'     => 'required',
            'status'        => 'required'
        ]);

        $fotoPath = null;
        if ($request->hasFile('foto')) {
            $fotoPath = $request->file('foto')->store('foto_pendidik', 'public');
        }

        Pendidik::create([
            'id_user'       => auth()->user()->id_user,
            'id_pendidik'   => $request->id_pendidik,
            'nama_pendidik' => $request->nama_pendidik,
            'pendidikan'    => $request->pendidikan,
            'bidang'        => $request->bidang,
            'tempat_lahir'  => $request->tempat_lahir,
            'tgl_lahir'     => $request->tgl_lahir,
            'jenis_kelamin' => $request->jenis_kelamin,
            'agama'         => $request->agama,
            'email'         => $request->email_pendidik,
            'no_tlp'        => $request->no_tlp,
            'rate_gaji'     => $request->rate_gaji,
            'status'        => $request->status,
            'foto'          => $fotoPath,
        ]);

        return redirect()->route('admin.pendidik.index')
            ->with('success', 'Pendidik berhasil ditambahkan');
    }
}
