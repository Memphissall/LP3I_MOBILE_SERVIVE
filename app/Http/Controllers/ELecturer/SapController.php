<?php

namespace App\Http\Controllers\ELecturer;

use App\Http\Controllers\Controller;
use App\Models\Kelas;
use App\Models\Matakuliah;
use Illuminate\Http\Request;

class SapController extends Controller
{
    // ==========================
    // HALAMAN PILIH
    // ==========================
    public function pilih()
    {
        $kelas = Kelas::orderBy('nama_kelas')->get();

        return view('admin.pendidik.sap.pilih', compact('kelas'));
    }

    // ==========================
    // AJAX: MATKUL BY SEMESTER
    // ==========================
    public function getMatkulBySemester(Request $request)
    {
        $kelas = Kelas::findOrFail($request->id_kelas);

        $matkul = Matakuliah::where('id_program_studi', $kelas->id_program_studi)
            ->where('semester', $request->semester)
             //->whereNotNull('sap')
            ->orderBy('nama_mk')
            ->get();

        return response()->json($matkul);
    }

    // ==========================
    // LIST SAP
    // ==========================
    public function index($id_kelas, $id_mk)
    {
        $kelas  = Kelas::where('id_kelas', $id_kelas)->firstOrFail();
        $matkul = Matakuliah::where('id_mk', $id_mk)
                    //->whereNotNull('sap')
                    ->firstOrFail();

        return view('admin.pendidik.sap.index', compact(
            'kelas',
            'matkul',
            'id_kelas',
            'id_mk'
        ));
    }

    // ==========================
    // DOWNLOAD
    // ==========================
    public function download($id)
    {
        $matkul = Matakuliah::where('id_mk', $id)->firstOrFail();

        if (!$matkul->sap) {
            return back()->with('error', 'File SAP tidak tersedia.');
        }

        $filePath = public_path($matkul->sap);

        if (!file_exists($filePath)) {
            return back()->with('error', 'File tidak ditemukan.');
        }

        return response()->download($filePath);
    }
}
