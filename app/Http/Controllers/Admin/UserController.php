<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pendidik;
use App\Models\User;

class UserController extends Controller
{
    public function index()
    {
        $users = User::orderBy('id', 'DESC')->get();
        return view('admin.users.index', compact('users'));
    }

    public function create()
    {
        return view('admin.users.create');
    }

    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|email|unique:users,email',
            'password' => 'required|string|min:6',
            'role'     => 'required|in:mahasiswa,pendidik,admin',
        ]);

        // Buat user
        $user = new User();
        $user->name     = $request->name;
        $user->email    = $request->email;
        $user->password = bcrypt($request->password);
        $user->role     = $request->role;
        $user->save();

        // Jika role pendidik, simpan data pendidik
        if ($request->role === 'pendidik') {
            $request->validate([
                'id_pendidik'          => 'required|unique:pendidik,id_pendidik',
                'nama_pendidik'    => 'required',
                'pendidikan'    => 'required',
                'bidang'        => 'required',
                'tempat'        => 'required',
                'tanggal_lahir' => 'required|date',
                'jenis_kelamin' => 'required',
                'agama'         => 'required',
                'email_pendidik'   => 'required|email|unique:pendidik,email',
                'no_telp'       => 'required',
                'honor_per_sks' => 'required',
            ]);

            $fotoPath = null;
            if ($request->hasFile('foto')) {
                $fotoPath = $request->file('foto')->store('foto_pendidik', 'public');
            }

            Pendidik::create([
                'user_id'       => $user->id,
                'id_pendidik'          => $request->id_pendidik,
                'nama_pendidik'    => $request->nama_pendidik,
                'pendidikan'    => $request->pendidikan,
                'bidang'        => $request->bidang,
                'tempat'        => $request->tempat,
                'tanggal_lahir' => $request->tanggal_lahir,
                'jenis_kelamin' => $request->jenis_kelamin,
                'agama'         => $request->agama,
                'email'         => $request->email_pendidik,
                'no_telp'       => $request->no_telp,
                'honor_per_sks' => $request->honor_per_sks,
                'foto'          => $fotoPath,
                'status'        => 'aktif',
            ]);
        }

        return redirect()->route('admin.users.index')->with('success', 'User berhasil dibuat!');
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);
        if ($user->role === 'pendidik') {
            Pendidik::where('user_id', $user->id)->delete();
        }
        $user->delete();
        return redirect()->route('admin.users.index')->with('success', 'User berhasil dihapus!');
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
        'name' => 'required|string|max:255',
        'email' => 'required|email|unique:users,email,' . $user->id,
        'role' => 'required|in:mahasiswa,pendidik,admin',
    ]);

    $user->update([
        'name' => $request->name,
        'email' => $request->email,
        'role' => $request->role,
    ]);

    return redirect()->route('admin.users.index')->with('success', 'User berhasil diperbarui!');
}

}
