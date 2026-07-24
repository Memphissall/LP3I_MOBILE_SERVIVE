<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Pendidik;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;


class UserController extends Controller
{
    public function index()
    {
        $users = User::orderBy('id_user', 'DESC')->get();
        return view('admin.users.index', compact('users'));
    }

    public function create()
    {
        return view('admin.users.tambah');
    }

    public function store(Request $request)
    {
        // VALIDASI USER
        $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|email|unique:users,email',
            'password' => 'required|min:6',
            'role'     => 'required|in:admin,mahasiswa,pendidik',
        ]);

        DB::beginTransaction();

        try {
            // SIMPAN USER
            $user = User::create([
                'name'     => $request->name,
                'email'    => $request->email,
                'password' => bcrypt($request->password),
                'role'     => $request->role,
            ]);

            // JIKA ROLE PENDIDIK
            if ($request->role === 'pendidik') {

                $request->validate([
                    'id_pendidik'    => 'required|unique:pendidik,id_pendidik',
                    'nama_pendidik'  => 'required',
                    'pendidikan'     => 'required',
                    'bidang'         => 'required',
                    'tempat_lahir'   => 'required',
                    'tgl_lahir'      => 'required|date',
                    'jenis_kelamin'  => 'required',
                    'agama'          => 'required',
                    'email_pendidik' => 'required|email|unique:pendidik,email',
                    'no_tlp'         => 'required',
                    'rate_gaji'      => 'required|numeric',
                ]);

                $fotoPath = null;
                if ($request->hasFile('foto')) {
                    $fotoPath = $request->file('foto')
                        ->store('foto_pendidik', 'public');
                }

                Pendidik::create([
                    'id_user'       => $user->id_user,
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
                    'foto'          => $fotoPath,
                    'status'        => 'aktif',
                ]);
            }

            DB::commit();
            return redirect()->route('admin.users.index')
                ->with('success', 'User berhasil dibuat');

        } catch (\Throwable $e) {
            DB::rollBack();
            return back()->withErrors($e->getMessage());
        }
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);

        if ($user->role === 'pendidik') {
            Pendidik::where('id_user', $user->id_user)->delete();
        }

        $user->delete();
        return back()->with('success', 'User berhasil dihapus');
    }

    public function update(Request $request, $id)
{
    $user = User::findOrFail($id);

    // ================= VALIDASI =================
    $request->validate([
        'name'  => 'required|string|max:255',
        'email' => 'required|email|unique:users,email,' . $user->id_user . ',id_user',
        'role'  => 'required',

        // khusus pendidik
        'id_pendidik'     => 'nullable|string',
        'nama_pendidik'   => 'nullable|string',
        'pendidikan'      => 'nullable|string',
        'bidang'          => 'nullable|string',
        'tempat'          => 'nullable|string',
        'tanggal_lahir'   => 'nullable|date',
        'jenis_kelamin'   => 'nullable|string',
        'agama'           => 'nullable|string',
        'email_pendidik'  => 'nullable|email',
        'no_telp'         => 'nullable|string',
        'honor_per_sks'   => 'nullable|numeric',

        'foto' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
    ]);

    // ================= UPDATE USER =================
    $user->name  = $request->name;
    $user->email = $request->email;
    $user->role  = $request->role;

    if ($request->password) {
        $user->password = Hash::make($request->password);
    }

    // upload foto
    if ($request->hasFile('foto')) {
        if ($user->foto) {
            Storage::disk('public')->delete($user->foto);
        }
        $user->foto = $request->file('foto')->store('user', 'public');
    }

    $user->save();

    // ================= DATA PENDIDIK =================
    if ($request->role === 'pendidik') {
        $pendidik = Pendidik::updateOrCreate(
            ['id_user' => $user->id_user],
            [
                'id_pendidik'   => $request->id_pendidik,
                'nama_pendidik' => $request->nama_pendidik,
                'pendidikan'    => $request->pendidikan,
                'bidang'        => $request->bidang,
                'tempat'        => $request->tempat,
                'tanggal_lahir' => $request->tanggal_lahir,
                'jenis_kelamin' => $request->jenis_kelamin,
                'agama'         => $request->agama,
                'email'         => $request->email_pendidik,
                'no_telp'       => $request->no_telp,
                'honor_per_sks' => $request->honor_per_sks,
            ]
        );
    } else {
        // kalau role diganti bukan pendidik → hapus data pendidik
        $user->pendidik()->delete();
    }

    return redirect()
        ->route('admin.users.index')
        ->with('success', 'Data user berhasil diperbarui');
}

public function edit($id)
{
    $user = User::with('pendidik')->findOrFail($id);
    return view('admin.users.edit', compact('user'));
}

}
