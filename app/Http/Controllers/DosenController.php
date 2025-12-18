<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Dosen;
use Illuminate\Support\Facades\Validator;

class DosenController extends Controller
{
    /**
     * Get list of lecturers with filters (for AJAX)
     */
    public function index(Request $request)
    {
        $query = Dosen::query();

        // Filter by status
        if ($request->filled('status') && $request->status !== 'Semua Status') {
            $query->where('status', strtolower($request->status));
        }

        // Filter by education
        if ($request->filled('pendidikan') && $request->pendidikan !== 'Semua Pendidikan') {
            $query->where('pendidikan', $request->pendidikan);
        }

        $dosens = $query->get();
        return response()->json($dosens);
    }

    /**
     * Store new lecturer
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nidn' => 'required|string|unique:dosen,nidn',
            'nama_dosen' => 'required|string|max:255',
            'pendidikan' => 'required|in:S1,S2,S3',
            'bidang' => 'required|string|max:255',
            'tempat' => 'required|string',
            'tanggal_lahir' => 'required|date',
            'jenis_kelamin' => 'required|in:Laki-laki,Perempuan',
            'agama' => 'required|string',
            'email' => 'required|email|unique:dosen,email',
            'no_telp' => 'required|string',
            'honor_per_sks' => 'required|integer|min:0',
            'status' => 'required|in:aktif,tidak aktif,kontrak,tetap,honorer',
            'foto' => 'nullable|string'
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        try {
            $dosen = Dosen::create($request->all());
            return response()->json([
                'message' => 'Data dosen berhasil ditambahkan',
                'data' => $dosen
            ]);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Terjadi kesalahan: ' . $e->getMessage()], 500);
        }
    }

    /**
     * Get lecturer data for editing
     */
    public function edit($id)
    {
        $dosen = Dosen::findOrFail($id);
        return response()->json($dosen);
    }

    /**
     * Update lecturer data
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'nidn' => 'required|string|unique:dosen,nidn,' . $id,
            'nama_dosen' => 'required|string|max:255',
            'pendidikan' => 'required|in:S1,S2,S3',
            'bidang' => 'required|string|max:255',
            'tempat' => 'required|string',
            'tanggal_lahir' => 'required|date',
            'jenis_kelamin' => 'required|in:Laki-laki,Perempuan',
            'agama' => 'required|string',
            'email' => 'required|email|unique:dosen,email,' . $id,
            'no_telp' => 'required|string',
            'honor_per_sks' => 'required|integer|min:0',
            'status' => 'required|in:aktif,tidak aktif,kontrak,tetap,honorer',
            'foto' => 'nullable|string'
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        try {
            $dosen = Dosen::findOrFail($id);
            $dosen->update($request->all());

            return response()->json([
                'message' => 'Data dosen berhasil diupdate',
                'data' => $dosen
            ]);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Terjadi kesalahan: ' . $e->getMessage()], 500);
        }
    }

    /**
     * Delete lecturer
     */
    public function destroy($id)
    {
        try {
            $dosen = Dosen::findOrFail($id);
            $dosen->delete();

            return response()->json([
                'message' => 'Data dosen berhasil dihapus'
            ]);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Terjadi kesalahan: ' . $e->getMessage()], 500);
        }
    }

    /**
     * Print lecturers data based on filters
     */
    public function printDosen(Request $request)
    {
        $status = $request->input('status');
        $pendidikan = $request->input('pendidikan');

        $query = Dosen::query();

        if ($status && $status !== 'Semua Status') {
            $query->where('status', strtolower($status));
        }

        if ($pendidikan && $pendidikan !== 'Semua Pendidikan') {
            $query->where('pendidikan', $pendidikan);
        }

        $dosens = $query->get();

        return view('akademik.print_dosen', compact('dosens'));
    }
}
