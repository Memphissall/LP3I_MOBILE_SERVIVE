<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Kelas;
use App\Models\Mahasiswa;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Barryvdh\DomPDF\Facade\Pdf;

class KelasController extends Controller
{
    /**
     * API: Get list of students based on filters
     */
    public function getMahasiswaList(Request $request)
    {
        $query = Mahasiswa::query();

        // Filter: Belum punya kelas (optional, tergantung requirement, tapi biasanya yang mau ditambahin itu yg belum punya kelas, atau bisa overwrite)
        // $query->whereNull('id_kelas'); 

        // Filter Jurusan
        if ($request->filled('jurusan') && $request->jurusan !== 'Semua Jurusan') {
            $query->where('jurusan', $request->jurusan);
        }

        // Filter Angkatan (Tahun Masuk)
        if ($request->filled('angkatan') && $request->angkatan !== 'Semua Tahun') {
            $query->where('angkatan', $request->angkatan);
        }

        // Filter Periode
        if ($request->filled('periode') && $request->periode !== 'Semua Periode') {
            $query->where('periode', $request->periode);
        }

        $mahasiswa = $query->get(['id', 'nipd as nim', 'nama', 'jurusan', 'angkatan', 'periode', 'id_kelas']);
        // Wait, migration said 'nipd', model might have 'nim' or 'nipd'.
        // Let's check migration again. Migration has 'nipd'. Model has $fillable 'nidn/nim'?
        // Model file I saw earlier had 'nidn'.
        // Let's re-check model file to be sure about column names.
        
        return response()->json($mahasiswa);
    }

    /**
     * API: Get list of classes based on filters
     */
    public function getKelasList(Request $request)
    {
        $query = Kelas::query();

        if ($request->filled('jurusan') && $request->jurusan !== 'Semua Jurusan') {
            $query->where('jurusan', $request->jurusan);
        }

        $kelas = $query->get();
        return response()->json($kelas);
    }

    /**
     * API: Add students to class
     */
    public function addMahasiswaToKelas(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'student_ids' => 'required|array|min:1',
            'student_ids.*' => 'exists:mahasiswa,id',
            'mode_kelas' => 'required|in:existing,new',
            'id_kelas' => 'required_if:mode_kelas,existing|nullable|exists:kelas,id_kelas',
            // New class validation
            'kode_mk' => 'required_if:mode_kelas,new',
            'nama_kelas' => 'required_if:mode_kelas,new',
            'jurusan' => 'required_if:mode_kelas,new',
            'tahun_ajaran' => 'required_if:mode_kelas,new',
            'nama_pa' => 'nullable',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        try {
            DB::beginTransaction();

            $kelasId = $request->id_kelas;

            // If creating new class
            if ($request->mode_kelas === 'new') {
                $newKelas = Kelas::create([
                    'kode_mk' => $request->kode_mk,
                    'nama_kelas' => $request->nama_kelas,
                    'jurusan' => $request->jurusan,
                    'tahun_ajaran' => $request->tahun_ajaran,
                    'nama_pa' => $request->nama_pa,
                ]);
                $kelasId = $newKelas->id_kelas; // Primary key is id_kelas
            }

            // Update students
            Mahasiswa::whereIn('id', $request->student_ids)->update([
                'id_kelas' => $kelasId
            ]);

            DB::commit();

            return response()->json([
                'message' => 'Mahasiswa berhasil ditambahkan ke kelas',
                'kelas_id' => $kelasId
            ]);

        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['message' => 'Terjadi kesalahan: ' . $e->getMessage()], 500);
        }
    }
    /**
     * Print Students (PDF Export) based on Filters
     */
    public function printStudents(Request $request)
    {
        // 1. Ambil data filter dari request
        $jurusan = $request->query('jurusan'); // Use query parameters for GET request usually, but POST also works.
        // If frontend sends POST, use $request->jurusan
        // If frontend sends GET (standard for links), use $request->query or input.
        
        // Let's support both or assume Input (covers both)
        $jurusan = $request->input('jurusan');
        $angkatan = $request->input('angkatan');
        $periode = $request->input('periode');
        $kelas = $request->input('kelas');

        // 2. Query Data similar to getMahasiswaList
        $query = Mahasiswa::with('dataKelas');

        if ($jurusan && $jurusan !== 'Semua Jurusan') {
            $query->where('jurusan', $jurusan);
        }
        if ($angkatan && $angkatan !== 'Semua Tahun') {
            $query->where('angkatan', $angkatan);
        }
        if ($periode && $periode !== 'Semua Periode') {
            $query->where('periode', $periode);
        }
        
        if ($kelas && $kelas !== 'Semua Kelas') {
            $query->whereHas('dataKelas', function($q) use ($kelas) {
                $q->where('nama_kelas', $kelas);
            });
        }

        $students = $query->get();

        // 3. Return HTML view that will trigger browser print dialog
        return view('akademik.print_mahasiswa', compact('students'));
    }
}
