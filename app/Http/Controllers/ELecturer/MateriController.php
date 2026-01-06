<?php

namespace App\Http\Controllers\ELecturer;

use App\Http\Controllers\Controller;
use App\Models\Kelas;
use App\Models\Matakuliah;
use App\Models\Materi;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;

class MateriController extends Controller
{
    // ==========================
    // PILIH KELAS & MATA KULIAH
    // ==========================
    public function pilihKelasMK()
    {
        $kelas = Kelas::orderBy('nama_kelas')->get();
        return view('admin.dosen.materi.pilih', compact('kelas'));
    }

    // ==========================
    // AJAX: MATKUL BY KELAS
    // ==========================
    public function getMatkul(Request $request)
    {
        $request->validate([
            'id_kelas' => 'required'
        ]);

        $matkul = Matakuliah::where(function ($q) use ($request) {
            $q->whereHas('kelas', function ($sub) use ($request) {
                $sub->where('kelas_matakuliah.id_kelas', $request->id_kelas);
            })
            ->orWhere('tipe_matakuliah', 1);
        })
        ->orderBy('nama_mk')
        ->get(['kode_mk', 'nama_mk']);

        return response()->json($matkul);
    }

    // ==========================
    // FILTER (REDIRECT)
    // ==========================
    public function filter(Request $request)
    {
        $request->validate([
            'id_kelas' => 'required',
            'kode_mk'  => 'required'
        ]);

        return redirect()->route('materi.index', [
            $request->id_kelas,
            $request->kode_mk
        ]);
    }

    // ==========================
    // LIST MATERI
    // ==========================
    public function index($id_kelas, $kode_mk)
    {
        $kelas  = Kelas::where('id_kelas', $id_kelas)->firstOrFail();
        $matkul = Matakuliah::where('kode_mk', $kode_mk)->firstOrFail();

        $materi = Materi::where('id_kelas', $id_kelas)
            ->where('kode_mk', $kode_mk)
            ->orderBy('pertemuan')
            ->get();

        return view('admin.dosen.materi.index', compact(
            'kelas',
            'matkul',
            'materi',
            'id_kelas',
            'kode_mk'
        ));
    }

    // ==========================
    // FORM TAMBAH MATERI
    // ==========================
    public function create($id_kelas, $kode_mk)
{
    $kelas  = Kelas::where('id_kelas', $id_kelas)->firstOrFail();
    $matkul = Matakuliah::where('kode_mk', $kode_mk)->firstOrFail();

    return view('admin.dosen.materi.tambah', compact(
        'kelas',
        'matkul',
        'id_kelas',
        'kode_mk'
    ));
}


    // ==========================
    // SIMPAN MATERI
    // ==========================
    

public function store(Request $request, $id_kelas, $kode_mk)
{
    $request->validate([
        'judul_materi' => 'required',
        'pertemuan'    => 'required|integer',
        'file_materi'  => 'required|file|mimes:pdf,doc,docx,ppt,pptx'
    ]);

    try {
        DB::beginTransaction();

        $file = $request->file('file_materi')
            ->store('materi', 'public');

        Materi::create([
            'id_kelas'     => $id_kelas,
            'kode_mk'      => $kode_mk,
            'judul_materi' => $request->judul_materi,
            'deskripsi'    => $request->deskripsi,
            'file_materi'  => $file,
            'pertemuan'    => $request->pertemuan,
            'nidn'         => auth()->user()->dosen->nidn,
        ]);

        DB::commit(); // ⬅⬅⬅ PALING PENTING

        return redirect()
            ->route('materi.index', [$id_kelas, $kode_mk])
            ->with('success', 'Materi berhasil diupload');

    } catch (\Throwable $e) {
        DB::rollBack();
        return back()->withErrors($e->getMessage());
    }
}




    // ==========================
    // FORM EDIT
    // ==========================
    public function edit($id)
    {
        $materi = Materi::findOrFail($id);
        return view('admin.dosen.materi.edit', compact('materi'));
    }

    // ==========================
    // UPDATE MATERI
    // ==========================
    public function update(Request $request, $id)
    {
        $request->validate([
            'judul_materi' => 'required',
            'pertemuan'    => 'required|integer'
        ]);

        $materi = Materi::findOrFail($id);

        if ($request->hasFile('file_materi')) {
            Storage::disk('public')->delete($materi->file_materi);
            $materi->file_materi = $request->file('file_materi')
                ->store('materi', 'public');
        }

        $materi->update([
            'judul_materi' => $request->judul_materi,
            'deskripsi'    => $request->deskripsi,
            'pertemuan'    => $request->pertemuan
        ]);

        return redirect()
            ->route('materi.index', [$materi->id_kelas, $materi->kode_mk])
            ->with('success', 'Materi berhasil diperbarui');
    }

    // ==========================
    // HAPUS MATERI
    // ==========================
    public function destroy($id)
    {
        $materi = Materi::findOrFail($id);
        Storage::disk('public')->delete($materi->file_materi);
        $materi->delete();

        return back()->with('success', 'Materi berhasil dihapus');
    }

    // ==========================
    // VIEW MATERI (READ ONLY)
    // ==========================
    public function viewMateri($id_kelas, $kode_mk)
    {
        $kelas  = Kelas::findOrFail($id_kelas);
        $matkul = Matakuliah::where('kode_mk', $kode_mk)->firstOrFail();

        $materi = Materi::where('id_kelas', $id_kelas)
            ->where('kode_mk', $kode_mk)
            ->orderBy('pertemuan')
            ->get();

        return view('admin.dosen.materi.view', compact(
            'kelas',
            'matkul',
            'materi'
        ));
    }
}
