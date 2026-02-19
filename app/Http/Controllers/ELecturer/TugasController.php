<?php

namespace App\Http\Controllers\ELecturer;
use Illuminate\Support\Facades\Log;

use App\Http\Controllers\Controller;
use App\Models\Kelas;
use App\Models\Matakuliah;
use App\Models\Tugas;
use App\Models\Mahasiswa;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;
use App\Mail\NotifTugasBaru;


class TugasController extends Controller
{
    // ==========================
    // HALAMAN PILIH KELAS & SEMESTER
    // ==========================
    public function pilihKelasMK()
    {
        $kelas = Kelas::orderBy('nama_kelas')->get();
        return view('admin.pendidik.tugas.pilih', compact('kelas'));
    }

    // ==========================
    // AJAX: MATKUL (SAMA DENGAN NILAI CONTROLLER)
    // ==========================
    public function getMatkulBySemester(Request $request)
{
    $kelas = Kelas::findOrFail($request->id_kelas);

    $matkul = Matakuliah::where('id_program_studi', $kelas->id_program_studi)
                ->where('semester', $request->semester)
                ->orderBy('nama_mk')
                ->get();

    return response()->json($matkul);
}

    
    // ==========================
    // LIST TUGAS
    // ==========================
    public function index($id_kelas, $id_mk)
{
    $kelas = Kelas::findOrFail($id_kelas);
    $matkul = Matakuliah::findOrFail($id_mk);

    $tugas = Tugas::where('id_kelas', $id_kelas)
                ->where('id_mk', $id_mk)
                ->orderBy('deadline')
                ->get();

    return view('admin.pendidik.tugas.index', compact(
        'kelas',
        'matkul',
        'tugas',
        'id_kelas',
        'id_mk'
    ));
}


    // ==========================
    // FORM TAMBAH
    // ==========================
    public function create($id_kelas, $id_mk)
    {
        $kelas  = Kelas::where('id_kelas', $id_kelas)->firstOrFail();
        $matkul = Matakuliah::where('id_mk', $id_mk)->firstOrFail();

        return view('admin.pendidik.tugas.tambah', compact(
            'kelas',
            'matkul',
            'id_kelas',
            'id_mk'
        ));
    }

    // ==========================
    // SIMPAN
    // ==========================
// ==========================
    // SIMPAN & KIRIM EMAIL NOTIFIKASI
    // ==========================
    public function store(Request $request, $id_kelas, $id_mk)
    {
        // Validasi input
        $request->validate([
            'judul_tugas' => 'required',
            'deadline'    => 'required|date'
        ]);

        // 1. Simpan data tugas ke database
        $tugas = Tugas::create([
            'judul_tugas'    => $request->judul_tugas,   
            'deskripsi'      => $request->deskripsi,
            'deadline'       => $request->deadline,
            'tanggal_upload' => now(),
            'status'         => 'Aktif',
            'id_kelas'       => $id_kelas,
            'id_mk'          => $id_mk,
        ]);

        // 2. Ambil HANYA mahasiswa yang berada di kelas tersebut
        $daftarMahasiswa = Mahasiswa::where('id_kelas', $id_kelas)->get();

        // 3. Kirim Email ke masing-masing mahasiswa di kelas itu
        foreach ($daftarMahasiswa as $mhs) {
            // Pastikan kolom 'email' di tabel mahasiswa ada isinya (tidak null/kosong)
            if (!empty($mhs->email)) {
                \Illuminate\Support\Facades\Mail::to($mhs->email)->send(new \App\Mail\NotifTugasBaru($tugas, $mhs));
            }
        }

        // 4. Redirect kembali dengan pesan sukses
        return redirect()
            ->route('tugas.index', [$id_kelas, $id_mk])
            ->with('success', 'Tugas berhasil ditambahkan dan notifikasi terkirim ke mahasiswa.');
    }



    // ==========================
    // EDIT
    // ==========================
    public function edit($id)
    {
        $tugas = Tugas::findOrFail($id);
        return view('admin.pendidik.tugas.edit', compact('tugas'));
    }

    // ==========================
    // UPDATE
    // ==========================
    public function update(Request $request, $id)
{
    $request->validate([
        'judul_tugas'    => 'required',
        'deadline' => 'required|date',
        'status'   => 'required'
    ]);

    $tugas = Tugas::findOrFail($id);

    $tugas->update([
        'judul_tugas' => $request->judul_tugas,   
        'deskripsi'   => $request->deskripsi,
        'deadline'    => $request->deadline,
        'status'      => $request->status,
    ]);

    return redirect()
        ->route('tugas.index', [$tugas->id_kelas, $tugas->id_mk])
        ->with('success', 'Tugas berhasil diperbarui');
}

    // ==========================
    // DELETE
    // ==========================
    public function destroy($id)
    {
        Tugas::findOrFail($id)->delete();
        return back()->with('success', 'Tugas berhasil dihapus');
    }

    // ==========================
    // VIEW TUGAS (MAHASISWA)
    // ==========================
    public function viewTugas($id_kelas, $id_mk)
    {
        $kelas  = Kelas::findOrFail($id_kelas);
        $matkul = Matakuliah::where('id_mk', $id_mk)->firstOrFail();

        $tugas = Tugas::where('id_kelas', $id_kelas)
            ->where('id_mk', $id_mk)
            ->orderBy('deadline')
            ->get();

        return view('admin.pendidik.tugas.view', compact(
            'kelas',
            'matkul',
            'tugas'
        ));
    }

    public function lihatSubmissi($id_kelas, $id_mk, $id_tugas)
{
    $tugas = \App\Models\Tugas::findOrFail($id_tugas);

    $submissions = \App\Models\Submission::where('id_tugas', $id_tugas)
        ->with('mahasiswa') // nanti relasi
        ->get();

    return view('admin.pendidik.tugas.submissi.index', compact(
        'tugas',
        'submissions',
        'id_kelas',
        'id_mk'
    ));
}

}


