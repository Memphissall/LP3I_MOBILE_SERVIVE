<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Dosen;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class DosenController extends Controller
{
    /**
     * Display the dosen/pendidik management page
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
        $status = ['Aktif', 'Tidak Aktif', 'Kontrak', 'Tetap', 'Honorer'];
        
        $pendidikan = DB::table('pendidik')
            ->distinct()
            ->whereNotNull('pendidikan')
            ->orderBy('pendidikan')
            ->pluck('pendidikan');
        
        $bidang = DB::table('pendidik')
            ->distinct()
            ->whereNotNull('bidang')
            ->orderBy('bidang')
            ->pluck('bidang');
        
        return response()->json([
            'status' => $status,
            'pendidikan' => $pendidikan,
            'bidang' => $bidang
        ]);
    }

    /**
     * Get list of pendidik with filters (for AJAX)
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

        // Filter by bidang
        if ($request->filled('bidang') && $request->bidang !== 'Semua Bidang') {
            $query->where('bidang', $request->bidang);
        }

        $pendidik = $query->orderBy('nama_pendidik')->get();
        return response()->json($pendidik);
    }

    /**
     * Get pendidik data for editing
     */
    public function edit($id)
    {
        $dosen = Dosen::findOrFail($id);
        return response()->json($dosen);
    }

    /**
     * Update pendidik data
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'nama_pendidik' => 'required|string|max:255',
            'pendidikan' => 'required|string|max:50',
            'bidang' => 'required|string|max:100',
            'tempat_lahir' => 'nullable|string|max:100',
            'tgl_lahir' => 'nullable|date',
            'jenis_kelamin' => 'required|in:L,P',
            'agama' => 'nullable|string|max:50',
            'email' => 'required|email|unique:pendidik,email,' . $id . ',id_pendidik',
            'no_tlp' => 'nullable|string|max:20',
            'rate_gaji' => 'nullable|numeric|min:0',
            'status' => 'required|string',
            'foto' => 'nullable|string'
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        try {
            $dosen = Dosen::findOrFail($id);
            $dosen->update($request->all());

            return response()->json([
                'message' => 'Data pendidik berhasil diupdate',
                'data' => $dosen
            ]);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Terjadi kesalahan: ' . $e->getMessage()], 500);
        }
    }

    /**
     * Delete pendidik
     */
    public function destroy($id)
    {
        try {
            $dosen = Dosen::findOrFail($id);
            $dosen->delete();

            return response()->json([
                'message' => 'Data pendidik berhasil dihapus'
            ]);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Terjadi kesalahan: ' . $e->getMessage()], 500);
        }
    }

    /**
     * Print pendidik data based on filters
     */
    public function printDosen(Request $request)
    {
        $status = $request->input('status');
        $pendidikan = $request->input('pendidikan');

        $query = Dosen::query();

        // Only active pendidik for print
        $query->where('status', 'Aktif');

        if ($pendidikan && $pendidikan !== 'Semua Pendidikan') {
            $query->where('pendidikan', $pendidikan);
        }

        $dosens = $query->orderBy('nama_pendidik')->get();

        return view('akademik.print_dosen', compact('dosens'));
    }
}
