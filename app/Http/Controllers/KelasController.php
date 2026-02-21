<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kelas;
use App\Models\Mahasiswa;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use App\Models\ProgramStudi;

class KelasController extends Controller
{
    public function getKelasList(Request $request)
    {
        $query = Kelas::with('programStudi'); // Eager load relation
        if ($request->filled('jurusan') && $request->jurusan !== 'Semua Jurusan') {
            // Support filter by id_program_studi or old behavior (if needed)
            $query->where('id_program_studi', $request->jurusan); 
        }
        $kelas = $query->get();
        return response()->json($kelas);
    }

    public function addMahasiswaToKelas(Request $request)
{
    $validator = Validator::make($request->all(), [
        'student_ids' => 'required|array|min:1',
        'student_ids.*' => 'exists:mahasiswa,id_mahasiswa', // Sudah benar pakai id_mahasiswa
        'mode_kelas' => 'required|in:existing,new',
        'id_kelas' => 'required_if:mode_kelas,existing|nullable|exists:kelas,id_kelas',
        'kode_mk' => 'required_if:mode_kelas,new',
        'nama_kelas' => 'required_if:mode_kelas,new',
        'jurusan' => 'required_if:mode_kelas,new',
        'tahun_ajaran' => 'required_if:mode_kelas,new',
    ]);

    if ($validator->fails()) {
        return response()->json(['errors' => $validator->errors()], 422);
    }

    try {
        DB::beginTransaction();

        $kelasId = $request->id_kelas;

        if ($request->mode_kelas === 'new') {
            // Handle jurusan input (bisa berupa ID atau nama)
            $idProgramStudi = $request->jurusan;
            if (!is_numeric($request->jurusan)) {
                $prodi = ProgramStudi::where('nama', $request->jurusan)->orWhere('kode', $request->jurusan)->first();
                $idProgramStudi = $prodi ? $prodi->id_program_studi : null;
            }

            $newKelas = Kelas::create([
                'kode_mk' => $request->kode_mk,
                'nama_kelas' => $request->nama_kelas,
                'id_program_studi' => $idProgramStudi,
                'tahun_ajaran' => $request->tahun_ajaran,
                'id_pendidik' => $request->id_pendidik,
            ]);
            $kelasId = $newKelas->id_kelas;
        } else {
            // Existing Class: Fetch Program Studi
            $existingClass = DB::table('kelas')->where('id_kelas', $kelasId)->first();
            if ($existingClass) {
                // We define $idProgramStudi here to be used in update
                // Note: In 'new' block, $idProgramStudi is defined inside, so we need to ensure scope or redefine
                // Actually, $idProgramStudi is defined in 'new' block. 
                // But to be safe, we should check availability.
            }
        }

        // Logic Refinement:
        // In 'new' block, $idProgramStudi is created.
        // In 'existing' (implicit else since $kelasId initialized at top), we need to fetch it.
        
        // Let's rewrite safely:
        $finalIdProgramStudi = null;

        if ($request->mode_kelas === 'new') {
             // It was already calculated as $idProgramStudi in the block above
             $finalIdProgramStudi = $idProgramStudi; 
        } else {
             $existingClass = DB::table('kelas')->where('id_kelas', $kelasId)->first();
             if ($existingClass) $finalIdProgramStudi = $existingClass->id_program_studi;
        }

        // UPDATE: Pastikan kolom WHERE adalah id_mahasiswa
        Mahasiswa::whereIn('id_mahasiswa', $request->student_ids)->update([
            'id_kelas' => $kelasId,
            'id_program_studi' => $finalIdProgramStudi
        ]);

        DB::commit();
        return response()->json(['message' => 'Berhasil memperbarui kelas mahasiswa']);

    } catch (\Exception $e) {
        DB::rollBack();
        return response()->json(['message' => 'Terjadi kesalahan: ' . $e->getMessage()], 500);
    }
}

    public function assignClass(Request $request)
{
    // 1. Hapus kode_mk dari validasi
    $validator = Validator::make($request->all(), [
        'student_ids' => 'required|array',
        'mode_kelas'  => 'required',
        'id_kelas'    => 'required_if:mode_kelas,existing',
        'nama_kelas_baru'  => 'required_if:mode_kelas,new',
        'jurusan_baru'     => 'required_if:mode_kelas,new',
    ]);

    if ($validator->fails()) {
        return response()->json([
            'status' => 'error',
            'message' => 'Validasi gagal: Ada data yang belum diisi nih, Bubub!',
            'errors' => $validator->errors()
        ], 422);
    }

    try {
        DB::beginTransaction();

        $id_kelas = $request->id_kelas;

        if ($request->mode_kelas === 'new') {
            // Handle jurusan input
            $jurusanInput = $request->jurusan_baru;
            $idProgramStudi = $jurusanInput;
            
            if (!is_numeric($jurusanInput)) {
                $prodi = ProgramStudi::where('nama', $jurusanInput)->orWhere('kode', $jurusanInput)->first();
                $idProgramStudi = $prodi ? $prodi->id_program_studi : null;
            }

            // 2. Insert tanpa kolom kode_mk / kode_kelas
            $id_kelas = DB::table('kelas')->insertGetId([
                'nama_kelas'   => $request->nama_kelas_baru,
                'id_program_studi' => $idProgramStudi,
                'tahun_ajaran' => $request->tahun_ajaran,
                'id_pendidik'  => $request->id_pendidik,
                'created_at'   => now(),
                'updated_at'   => now(),
            ]);
        } else {
            // Existing Class: Fetch Program Studi from the class
            $existingClass = DB::table('kelas')->where('id_kelas', $id_kelas)->first();
            if ($existingClass) {
                $idProgramStudi = $existingClass->id_program_studi;
            } else {
                $idProgramStudi = null;
            }
        }

        // Update Mahasiswa with Class AND Program Studi
        Mahasiswa::whereIn('id_mahasiswa', $request->student_ids)
                 ->update([
                     'id_kelas' => $id_kelas,
                     'id_program_studi' => $idProgramStudi
                 ]);

        DB::commit();
        return response()->json(['status' => 'success', 'message' => 'Data berhasil disimpan!']);

    } catch (\Exception $e) {
        DB::rollBack();
        return response()->json(['status' => 'error', 'message' => 'Waduh error: ' . $e->getMessage()], 500);
    }
}

}