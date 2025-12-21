<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MataKuliah;
use Illuminate\Support\Facades\Validator;

class MatkulController extends Controller
{
    /**
     * Get list of courses with filters
     */
    public function index(Request $request)
    {
        $query = MataKuliah::query();

        // Filter by jurusan
        if ($request->filled('jurusan') && $request->jurusan !== 'Semua Jurusan') {
            $query->where('jurusan', $request->jurusan);
        }

        // Filter by semester
        if ($request->filled('semester') && $request->semester !== 'Semua Semester') {
            $query->where('semester', $request->semester);
        }

        // Filter by jenis
        if ($request->filled('jenis') && $request->jenis !== 'Semua Jenis') {
            $query->where('jenis', $request->jenis);
        }

        $matkul = $query->orderBy('semester')->orderBy('kode_mk')->get();
        return response()->json($matkul);
    }

    /**
     * Store new course
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'kode_mk' => 'required|string|unique:mata_kuliah,kode_mk',
            'nama_mk' => 'required|string|max:255',
            'sks' => 'required|integer|min:1|max:6',
            'semester' => 'required|integer|min:1|max:8',
            'jenis' => 'required|in:Wajib,Pilihan',
            'jurusan' => 'required|string',
            'deskripsi' => 'nullable|string'
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        try {
            $matkul = MataKuliah::create($request->all());
            return response()->json([
                'message' => 'Mata kuliah berhasil ditambahkan',
                'data' => $matkul
            ]);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Terjadi kesalahan: ' . $e->getMessage()], 500);
        }
    }

    /**
     * Get course data for editing
     */
    public function edit($id)
    {
        $matkul = MataKuliah::findOrFail($id);
        return response()->json($matkul);
    }

    /**
     * Update course data
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'kode_mk' => 'required|string|unique:mata_kuliah,kode_mk,' . $id,
            'nama_mk' => 'required|string|max:255',
            'sks' => 'required|integer|min:1|max:6',
            'semester' => 'required|integer|min:1|max:8',
            'jenis' => 'required|in:Wajib,Pilihan',
            'jurusan' => 'required|string',
            'deskripsi' => 'nullable|string'
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        try {
            $matkul = MataKuliah::findOrFail($id);
            $matkul->update($request->all());

            return response()->json([
                'message' => 'Mata kuliah berhasil diupdate',
                'data' => $matkul
            ]);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Terjadi kesalahan: ' . $e->getMessage()], 500);
        }
    }

    /**
     * Delete course
     */
    public function destroy($id)
    {
        try {
            $matkul = MataKuliah::findOrFail($id);
            $matkul->delete();

            return response()->json([
                'message' => 'Mata kuliah berhasil dihapus'
            ]);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Terjadi kesalahan: ' . $e->getMessage()], 500);
        }
    }

    /**
     * Print courses data based on filters
     */
    public function printMatkul(Request $request)
    {
        $jurusan = $request->input('jurusan');
        $semester = $request->input('semester');
        $jenis = $request->input('jenis');

        $query = MataKuliah::query();

        if ($jurusan && $jurusan !== 'Semua Jurusan') {
            $query->where('jurusan', $jurusan);
        }

        if ($semester && $semester !== 'Semua Semester') {
            $query->where('semester', $semester);
        }

        if ($jenis && $jenis !== 'Semua Jenis') {
            $query->where('jenis', $jenis);
        }

        $matkul = $query->orderBy('semester')->orderBy('kode_mk')->get();

        return view('akademik.print_matkul', compact('matkul'));
    }
}
