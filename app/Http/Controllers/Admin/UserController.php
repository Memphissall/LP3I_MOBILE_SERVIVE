<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Dosen; 
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use App\Models\Mahasiswa;


class UserController extends Controller
{
    // ====================================
    // Tampilkan daftar user
    // ====================================
    public function index()
    {
        $users = User::orderBy('id', 'DESC')->get();
        return view('admin.users.index', compact('users'));
    }

    // ====================================
    // Form tambah user
    // ====================================
    public function create()
    {
        return view('admin.users.create');
    }

   public function store(Request $request)
{
    // Buat user terlebih dahulu
    $user = new User();
    $user->name     = $request->name;
    $user->email    = $request->email;
    $user->password = bcrypt($request->password);
    $user->role     = $request->role;
    $user->save();

    // ====================================
    // SIMPAN DATA DOSEN
    // ====================================
    if ($user->role == 'dosen') {

        $request->validate([
            'nidn'        => 'required',
            'nama_dosen'  => 'required',
            'pendidikan'  => 'required',
            'bidang'      => 'required',
            'tanggal_lahir' => 'required|date',
            'jenis_kelamin' => 'required',
            'agama'         => 'required',
            'email_dosen'   => 'required|email',
            'no_telp'       => 'required',
            'honor_per_sks' => 'required'
        ]);

        Dosen::create([
            'user_id'      => $user->id,
            'nidn'         => $request->nidn,
            'nama_dosen'   => $request->nama_dosen,
            'pendidikan'   => $request->pendidikan,
            'bidang'       => $request->bidang,
            'tanggal_lahir'=> $request->tanggal_lahir,
            'jenis_kelamin'=> $request->jenis_kelamin,
            'agama'        => $request->agama,
            'email'        => $request->email_dosen,
            'no_telp'      => $request->no_telp,
            'honor_per_sks'=> $request->honor_per_sks,
        ]);
    }

    // ====================================
    // SIMPAN DATA MAHASISWA
    // ====================================
    elseif ($user->role == 'mahasiswa') {

        $request->validate([
            'nim'             => 'required',
            'nama_mahasiswa'  => 'required',
            'prodi'           => 'required',
            'angkatan'        => 'required',
            'email_mahasiswa' => 'required|email',
            'no_telp_mahasiswa'=> 'required'
        ]);

        Mahasiswa::create([
            'user_id'       => $user->id,
            'nim'           => $request->nim,
            'nama_mhs'      => $request->nama_mahasiswa,
            'prodi'         => $request->prodi,
            'angkatan'      => $request->angkatan,
            'email'         => $request->email_mahasiswa,
            'no_telp'       => $request->no_telp_mahasiswa,
        ]);
    }

    return redirect()->route('admin.users.index')->with('success', 'User berhasil ditambahkan!');
}

public function destroy($id)
{
    // Hapus user
    $user = User::findOrFail($id);

    // Jika role dosen => hapus data dosen
    if ($user->role == 'dosen') {
        Dosen::where('user_id', $user->id)->delete();
    }

    // Jika role mahasiswa => hapus data mahasiswa
     $user = User::findOrFail($id);
    $user->delete();

    return redirect()->route('admin.users.index')->with('success', 'Akun mahasiswa berhasil dihapus.');
}


public function edit($id)
{
    $user = User::findOrFail($id);
    return view('admin.users.edit', compact('user'));
}

public function update(Request $request, $id)
{
    $user = User::findOrFail($id);

    $request->validate([
        'name' => 'required',
        'email' => 'required|email',
    ]);

    $user->update([
        'name'  => $request->name,
        'email' => $request->email,
    ]);

    return redirect()->route('admin.users.index')->with('success', 'User berhasil diperbarui!');
}


    
}
