<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Mahasiswa;
use App\Models\Kelas;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class MahasiswaController extends Controller
{

    public function index()
{
    // Jangan ambil data mahasiswa di sini karena kita pakai AJAX (apiList)
    // Cukup kembalikan view kosongnya saja
    return view('akademik.mahasiswa'); 
}

    /**
     * API untuk mengambil data pendukung filter (Dropdown)
     */
    public function getFilterData()
{
    try {
        $jurusan = DB::table('mahasiswa')->whereNotNull('jurusan')->distinct()->pluck('jurusan');
        $angkatan = DB::table('mahasiswa')->whereNotNull('angkatan')->distinct()->pluck('angkatan');
        $periode = DB::table('mahasiswa')->whereNotNull('periode')->distinct()->pluck('periode');
        
        // REVISI DI SINI: Tambahkan 'jurusan' agar JavaScript bisa memfilter!
        $kelas = DB::table('kelas')->select('id_kelas', 'nama_kelas', 'jurusan')->get();
        
        return response()->json([
            'status'   => 'success',
            'jurusan'  => $jurusan,
            'angkatan' => $angkatan,
            'periode'  => $periode,
            'kelas'    => $kelas
        ]);
    } catch (\Exception $e) {
        return response()->json(['status' => 'error', 'message' => $e->getMessage()], 500);
    }
}

    /**
     * API untuk list mahasiswa dengan filter
     */
    public function apiList(Request $request)
{
    try {
        // Gunakan eager loading (with) tapi batasi kolom yang ditarik
        // Hanya ambil id dan nama_kelas saja untuk menghemat RAM
        $query = Mahasiswa::with(['data_kelas' => function($q) {
            $q->select('id_kelas', 'nama_kelas');
        }]);

        // 1. Filter Jurusan
        if ($request->filled('jurusan') && !in_array($request->jurusan, ['', 'Semua Jurusan'])) {
            $query->where('jurusan', $request->jurusan);
        }

        // 2. Filter Angkatan
        if ($request->filled('angkatan') && !in_array($request->angkatan, ['', 'Semua Tahun'])) {
            $query->where('angkatan', $request->angkatan);
        }

        // 3. Filter Periode
        if ($request->filled('periode') && !in_array($request->periode, ['', 'Semua Periode'])) {
            $query->where('periode', $request->periode);
        }

        // 4. Filter Kelas
        if ($request->filled('kelas') && !in_array($request->kelas, ['', 'Semua Kelas'])) {
            if (is_numeric($request->kelas)) {
                $query->where('id_kelas', $request->kelas);
            } else {
                $query->whereHas('data_kelas', function($q) use ($request) {
                    $q->where('nama_kelas', $request->kelas);
                });
            }
        }

        // 5. Filter Khusus untuk Modal
        if ($request->status_kelas === 'kosong') {
            $query->whereNull('id_kelas');
        }

        // --- OPTIMASI UTAMA BUBUB ---
        // Batasi kolom yang ditarik dari tabel mahasiswa.
        // Ganti nama kolom sesuai database kamu (nipd/nim/nama/jurusan/angkatan/id_kelas)
        $mahasiswa = $query->select('id_mahasiswa', 'nipd', 'nama', 'jurusan', 'angkatan', 'id_kelas')
                           ->limit(500) // Kasih batas maksimal 500 biar memory aman
                           ->get(); 
        
        return response()->json($mahasiswa);

    } catch (\Exception $e) {
        return response()->json(['message' => 'Gagal memuat data: ' . $e->getMessage()], 500);
    }
}

    public function edit($id)
    {
        $mahasiswa = Mahasiswa::find($id);
        if (!$mahasiswa) {
            return response()->json(['message' => 'Data tidak ditemukan.'], 404);
        }
        return response()->json($mahasiswa);
    }

    public function update(Request $request, $id)
{
    $mahasiswa = Mahasiswa::findOrFail($id);

    // Validasi data
    $request->validate([
        'nama' => 'required',
        'jurusan' => 'required',
        'angkatan' => 'required',
        'id_kelas' => 'nullable' 
    ]);

    // UPDATE SEMUA KOLOM TERMASUK KELAS
    $mahasiswa->nama = $request->nama;
    $mahasiswa->nipd = $request->nipd; 
    $mahasiswa->jurusan = $request->jurusan;
    $mahasiswa->angkatan = $request->angkatan;
    $mahasiswa->periode = $request->periode; // Jangan lupa periode juga ya
    $mahasiswa->id_kelas = $request->id_kelas; 
    
    $mahasiswa->save();

    return response()->json([
        'status' => 'success', 
        'message' => 'Data berhasil diperbarui.'
    ]);
}

    public function destroy($id)
    {
        try {
            $mahasiswa = Mahasiswa::findOrFail($id);
            $mahasiswa->delete();

            return response()->json([
                'status' => 'success',
                'message' => 'Mahasiswa berhasil dihapus dari database!'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Gagal hapus: ' . $e->getMessage()
            ], 500);
        }
    }

    public function printStudents(Request $request)
    {
        try {
            $query = Mahasiswa::query();

            if ($request->filled('jurusan') && $request->jurusan !== 'Semua Jurusan') {
                $query->where('jurusan', $request->jurusan);
            }
            if ($request->filled('angkatan') && $request->angkatan !== 'Semua Tahun') {
                $query->where('angkatan', $request->angkatan);
            }
            if ($request->filled('periode') && $request->periode !== 'Semua Periode') {
                $query->where('periode', $request->periode);
            }

            $mahasiswa = $query->with('data_kelas')->get();
            return view('akademik.print_mahasiswa', compact('mahasiswa'));
            
        } catch (\Exception $e) {
            return back()->with('error', 'Gagal mencetak: ' . $e->getMessage());
        }
    }
}