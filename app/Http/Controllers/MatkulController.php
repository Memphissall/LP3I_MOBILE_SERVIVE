<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MataKuliah;
use App\Models\BidangKeahlian;
use Illuminate\Support\Facades\Validator;

class MatkulController extends Controller
{
    /**
     * Get list of courses with filters
     */
    public function index(Request $request)
    {
        $query = MataKuliah::with('bidangKeahlian');

        // Filter by id_bidang_keahlian
        if ($request->filled('id_bidang_keahlian') && $request->id_bidang_keahlian !== 'all') {
            $query->where('id_bidang_keahlian', $request->id_bidang_keahlian);
        }

        // Filter by semester
        if ($request->filled('semester') && $request->semester !== 'Semua Semester') {
            $query->where('semester', $request->semester);
        }

        $matkul = $query->orderBy('semester')->orderBy('kode_mk')->get();
        return response()->json($matkul);
    }

    /**
     * Get bidang keahlian list for dropdown
     */
    public function getBidangKeahlianList()
    {
        $bidangKeahlian = BidangKeahlian::orderBy('nama')->get();
        return response()->json($bidangKeahlian);
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
            'bobot_kompetensi' => 'required|integer|min:0|max:100',
            'semester' => 'required|integer|min:1|max:8',
            'id_bidang_keahlian' => 'required|exists:bidang_keahlian,id_bidang_keahlian',
            'deskripsi' => 'nullable|string',
            'sap_file' => 'nullable|file|mimes:pdf,doc,docx|max:10240'
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        try {
            $data = $request->except('sap_file');
            
            // Handle SAP file upload
            if ($request->hasFile('sap_file')) {
                $file = $request->file('sap_file');
                $fileName = time() . '_' . $file->getClientOriginalName();
                $file->move(public_path('uploads/sap'), $fileName);
                $data['sap'] = 'uploads/sap/' . $fileName;
            }
            
            $matkul = MataKuliah::create($data);
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
        $matkul = MataKuliah::with('bidangKeahlian')->findOrFail($id);
        return response()->json($matkul);
    }

    /**
     * Update course data
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'kode_mk' => 'required|string|unique:mata_kuliah,kode_mk,' . $id . ',id_matkul',
            'nama_mk' => 'required|string|max:255',
            'sks' => 'required|integer|min:1|max:6',
            'bobot_kompetensi' => 'required|integer|min:0|max:100',
            'semester' => 'required|integer|min:1|max:8',
            'id_bidang_keahlian' => 'required|exists:bidang_keahlian,id_bidang_keahlian',
            'deskripsi' => 'nullable|string',
            'sap_file' => 'nullable|file|mimes:pdf,doc,docx|max:10240'
        ]);

       if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        try {
            $matkul = MataKuliah::findOrFail($id);
            $data = $request->except('sap_file');
            
            // Ensure deskripsi has a value (empty string if not provided)
            if (!isset($data['deskripsi']) || $data['deskripsi'] === null) {
                $data['deskripsi'] = '';
            }
            
            // Handle SAP file upload
            if ($request->hasFile('sap_file')) {
                // Delete old file if exists
                if ($matkul->sap && file_exists(public_path($matkul->sap))) {
                    unlink(public_path($matkul->sap));
                }
                
                $file = $request->file('sap_file');
                $fileName = time() . '_' . $file->getClientOriginalName();
                $file->move(public_path('uploads/sap'), $fileName);
                $data['sap'] = 'uploads/sap/' . $fileName;
            }
            
            $matkul->update($data);

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
            
            // Delete SAP file if exists
            if ($matkul->sap && file_exists(public_path($matkul->sap))) {
                unlink(public_path($matkul->sap));
            }
            
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
        $id_bidang_keahlian = $request->input('id_bidang_keahlian');
        $semester = $request->input('semester');

        $query = MataKuliah::with('bidangKeahlian');

        if ($id_bidang_keahlian && $id_bidang_keahlian !== 'all') {
            $query->where('id_bidang_keahlian', $id_bidang_keahlian);
        }

        if ($semester && $semester !== 'Semua Semester') {
            $query->where('semester', $semester);
        }

        $matkul = $query->orderBy('semester')->orderBy('kode_mk')->get();

        return view('akademik.print_matkul', compact('matkul'));
    }
}
