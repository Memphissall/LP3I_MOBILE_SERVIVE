<?php

namespace App\Http\Controllers;

use App\Models\Kelas;
use App\Models\Matakuliah;
use App\Models\Tugas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class TugasController extends Controller
{
    
    // Form pilih kelas + matkul
    public function pilihKelasMK()
{
    $kelas = Kelas::orderBy('nama_kelas')->get();
    $matkul = Matakuliah::orderBy('nama_mk')->get();

    return view('admin.dosen.tugas.pilih', compact('kelas','matkul'));
}

public function filter(Request $request)
{
    // dd($request->all()); // cek dulu sampai fix

    $request->validate([
        'id_kelas' => 'required',
        'kode_mk' => 'required',
    ]);

    return redirect()->route('tugas.index', [
        'id_kelas' => $request->id_kelas,
        'kode_mk'  => $request->kode_mk,
    ]);
}

public function getMatkul($id_kelas)
{
    $matkul = Matakuliah::where('id_kelas', $id_kelas)->get();
    return response()->json($matkul);
}


public function index($id_kelas, $kode_mk)
{
    $kelas = Kelas::where('id_kelas', $id_kelas)->first(); 
    $matkul = Matakuliah::where('kode_mk', $kode_mk)->first();

    $tugas = Tugas::where('id_kelas', $id_kelas)
                  ->where('kode_mk', $kode_mk)
                  ->get();

    return view('admin.dosen.tugas.index', [
        'kelas'     => $kelas,
        'matkul'    => $matkul,
        'tugas'     => $tugas,
        'id_kelas'  => $id_kelas,
        'kode_mk'   => $kode_mk,
    ]);
}

// fungsi membuat membuat tugas
public function create($id_kelas, $kode_mk)
{
    $kelas = Kelas::where('id_kelas', $id_kelas)->first();
    $matkul = Matakuliah::where('kode_mk', $kode_mk)->first();

    return view('admin.dosen.tugas.tambah', [
        'kelas'    => $kelas,
        'matkul'   => $matkul,
        'id_kelas' => $id_kelas,
        'kode_mk'  => $kode_mk,
    ]);
}

// tempan penyimpanan

public function store(Request $request, $id_kelas, $kode_mk)
{
    // validasi
    $request->validate([
        'judul'       => 'required|string|max:255',
        'deskripsi'   => 'nullable|string',
        'deadline'    => 'required|date',
        'file_tugas'  => 'nullable|file|max:2048',
    ]);

    // upload file
    $namaFile = null;
    if ($request->hasFile('file_tugas')) {
        $namaFile = time() . '_' . $request->file('file_tugas')->getClientOriginalName();
        $request->file('file_tugas')->storeAs('tugas', $namaFile, 'public');
    }

    // simpan tugas
    Tugas::create([
        'id_kelas'        => $id_kelas,
        'kode_mk'         => $kode_mk,
        'judul'           => $request->judul,
        'deskripsi'       => $request->deskripsi,
        'deadline'        => $request->deadline,
        'file'            => $namaFile,
        'status'          => 'Aktif',
        'tanggal_upload'  => now(),
    ]);

    return redirect()
        ->route('tugas.index', [$id_kelas, $kode_mk])
        ->with('success', 'Tugas berhasil ditambahkan!');
}


    
}
