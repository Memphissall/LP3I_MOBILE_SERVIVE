<?php

namespace App\Http\Controllers\ELecturer;

use App\Http\Controllers\Controller;
use App\Models\Kelas;
use App\Models\Matakuliah;
use App\Models\Tugas;
use Illuminate\Http\Request;
use Carbon\Carbon;

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
        $request->validate([
            'semester' => 'required',
            'id_kelas' => 'required'
        ]);

        $matkul = Matakuliah::where('semester', $request->semester)
            ->where(function ($q) use ($request) {

                // matkul khusus kelas
                $q->whereHas('kelas', function ($sub) use ($request) {
                    $sub->where('kelas_matakuliah.id_kelas', $request->id_kelas);
                })

                // matkul umum
                ->orWhere('tipe_matakuliah', 1);

            })
            ->orderBy('nama_mk')
            ->get(['kode_mk', 'nama_mk']);

        return response()->json($matkul);
    }

    // ==========================
    // LIST TUGAS
    // ==========================
    public function index($id_kelas, $kode_mk)
    {
        $kelas  = Kelas::where('id_kelas', $id_kelas)->firstOrFail();
        $matkul = Matakuliah::where('kode_mk', $kode_mk)->firstOrFail();

        $tugas = Tugas::where('id_kelas', $id_kelas)
            ->where('kode_mk', $kode_mk)
            ->orderBy('created_at', 'desc')
            ->get();

        return view('admin.pendidik.tugas.index', compact(
            'kelas',
            'matkul',
            'tugas',
            'id_kelas',
            'kode_mk'
        ));
    }

    // ==========================
    // FORM TAMBAH
    // ==========================
    public function create($id_kelas, $kode_mk)
    {
        $kelas  = Kelas::where('id_kelas', $id_kelas)->firstOrFail();
        $matkul = Matakuliah::where('kode_mk', $kode_mk)->firstOrFail();

        return view('admin.pendidik.tugas.tambah', compact(
            'kelas',
            'matkul',
            'id_kelas',
            'kode_mk'
        ));
    }

    // ==========================
    // SIMPAN
    // ==========================
    public function store(Request $request, $id_kelas, $kode_mk)
    {
        $request->validate([
            'judul'    => 'required',
            'deadline' => 'required|date'
        ]);

        Tugas::create([
            'id_kelas'       => $id_kelas,
            'kode_mk'        => $kode_mk,
            'judul'          => $request->judul,
            'deskripsi'      => $request->deskripsi,
            'deadline'       => $request->deadline,
            'tanggal_upload' => Carbon::now(),
            'id_pendidik'           => auth()->user()->pendidik->id_pendidik
        ]);

        return redirect()
            ->route('tugas.index', [$id_kelas, $kode_mk])
            ->with('success', 'Tugas berhasil ditambahkan');
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
            'judul'    => 'required',
            'deadline' => 'required|date',
            'status'   => 'required'
        ]);

        $tugas = Tugas::findOrFail($id);

        $tugas->update([
            'judul'     => $request->judul,
            'deskripsi' => $request->deskripsi,
            'deadline'  => $request->deadline,
            'status'    => $request->status,
        ]);

        return redirect()
            ->route('tugas.index', [$tugas->id_kelas, $tugas->kode_mk])
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
    public function viewTugas($id_kelas, $kode_mk)
    {
        $kelas  = Kelas::findOrFail($id_kelas);
        $matkul = Matakuliah::where('kode_mk', $kode_mk)->firstOrFail();

        $tugas = Tugas::where('id_kelas', $id_kelas)
            ->where('kode_mk', $kode_mk)
            ->orderBy('deadline')
            ->get();

        return view('admin.pendidik.tugas.view', compact(
            'kelas',
            'matkul',
            'tugas'
        ));
    }

    public function lihatSubmissi($id_kelas, $kode_mk, $tugas_id)
{
    $tugas = \App\Models\Tugas::findOrFail($tugas_id);

    $submissions = \App\Models\Submission::where('tugas_id', $tugas_id)
        ->with('mahasiswa') // nanti relasi
        ->get();

    return view('admin.pendidik.tugas.submissi.index', compact(
        'tugas',
        'submissions',
        'id_kelas',
        'kode_mk'
    ));
}

}


