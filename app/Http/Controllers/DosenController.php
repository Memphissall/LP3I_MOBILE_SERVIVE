<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Dosen;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class DosenController extends Controller
{
    /**
     * Display the dosen management page
     */
    public function index()
    {
        return view('akademik.data_dosen');
    }

    /**
     * Get filter options from database (for dynamic dropdowns)
     */
    public function getFilterOptions()
    {
        // Return all possible status enum values
        $status = ['Aktif', 'Tidak Aktif', 'Kontrak', 'Tetap', 'Honorer'];
        
        $pendidikan = DB::table('dosen')
            ->distinct()
            ->orderBy('pendidikan')
            ->pluck('pendidikan');
        
        return response()->json([
            'status' => $status,
            'pendidikan' => $pendidikan
        ]);
    }

    /**
     * Get list of lecturers with filters (for AJAX)
     */
    public function apiList(Request $request)
    {
        $query = Dosen::query();

        // Filter by status
        if ($request->filled('status') && $request->status !== 'Semua Status') {
            $query->where('status', $request->status);
        }

        // Filter by education
        if ($request->filled('pendidikan') && $request->pendidikan !== 'Semua Pendidikan') {
            $query->where('pendidikan', $request->pendidikan);
        }

        $dosens = $query->get()->unique('nama_dosen')->values();
        return response()->json($dosens);
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
            'nidn' => 'required|string|unique:dosen,nidn,' . $id . ',id_dosen',
            'id_dosen_internal' => 'nullable|string|unique:dosen,id_dosen_internal,' . $id . ',id_dosen',
            'nama_dosen' => 'required|string|max:255',
            'pendidikan' => 'required|string|max:255',
            'bidang' => 'required|string|max:255',
            'tempat' => 'required|string',
            'tanggal_lahir' => 'required|date',
            'jenis_kelamin' => 'required|in:Laki-laki,Perempuan',
            'agama' => 'required|string',
            'alamat' => 'nullable|string',
            'email' => 'required|email|unique:dosen,email,' . $id . ',id_dosen',
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

        $dosens = $query->get()->unique('nama_dosen');

        return view('akademik.print_dosen', compact('dosens'));
    }
}
