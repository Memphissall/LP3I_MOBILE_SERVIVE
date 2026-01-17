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

    public function getBySemester(Request $request)
{
    return Matakuliah::whereHas('kelas', function ($q) use ($request) {
            $q->where('kelas_matakuliah.id_kelas', $request->id_kelas);
        })
        ->orderBy('nama_mk')
        ->get([
            'kode_mk as id_materi',
            'nama_mk as judul_materi'
        ]);
}

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
        'judul_materi' => 'required|string|max:255',
        'pertemuan'    => 'required|integer|min:1',
        'tipe_materi'  => 'required|in:file,link',
        'file_materi'  => 'required_if:tipe_materi,file|file|mimes:pdf,doc,docx,ppt,pptx|max:10240',
        'link_materi'  => 'nullable:tipe_materi,link|url'
    ]);

    $data = [
        'id_kelas'     => $id_kelas,
        'kode_mk'      => $kode_mk,
        'judul_materi' => $request->judul_materi,
        'deskripsi'    => $request->deskripsi,
        'pertemuan'    => $request->pertemuan,
        'tipe_materi'  => $request->tipe_materi,
        'nidn'         => auth()->user()->dosen->nidn,
    ];

    // ➜ JIKA FILE
    if ($request->tipe_materi === 'file') {
        $data['file_materi'] = $request
            ->file('file_materi')
            ->store('materi', 'public');
        $data['link_materi'] = null;
    }

    // ➜ JIKA LINK
    if ($request->tipe_materi === 'link') {
        $data['link_materi'] = $request->link_materi;
        $data['file_materi'] = null;
    }

    Materi::create($data);

    return redirect()
        ->route('materi.index', [$id_kelas, $kode_mk])
        ->with('success', 'Materi berhasil ditambahkan');
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
    $materi = Materi::findOrFail($id);

    $request->validate([
        'judul_materi' => 'required|string|max:255',
        'pertemuan'    => 'required|integer|min:1',
        'tipe_materi'  => 'required|in:file,link',
        'file_materi'  => 'nullable|file|mimes:pdf,doc,docx,ppt,pptx|max:10240',
        'link_materi'  => 'nullable|url',
    ]);

    $materi->judul_materi = $request->judul_materi;
    $materi->deskripsi   = $request->deskripsi;
    $materi->pertemuan   = $request->pertemuan;
    $materi->tipe_materi = $request->tipe_materi;

    // ➜ UPDATE FILE BARU
    if ($request->tipe_materi === 'file') {

        if ($request->hasFile('file_materi')) {

            // hapus file lama
            if ($materi->file_materi && Storage::disk('public')->exists($materi->file_materi)) {
                Storage::disk('public')->delete($materi->file_materi);
            }

            $materi->file_materi = $request
                ->file('file_materi')
                ->store('materi', 'public');
        }

        $materi->link_materi = null;
    }

    // ➜ UPDATE LINK
    if ($request->tipe_materi === 'link') {

        // hapus file lama jika ada
        if ($materi->file_materi && Storage::disk('public')->exists($materi->file_materi)) {
            Storage::disk('public')->delete($materi->file_materi);
        }

        $materi->file_materi = null;
        $materi->link_materi = $request->link_materi;
    }

    $materi->save();

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
