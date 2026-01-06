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
        // Get bidang keahlian from bidang_keahlian table
        $jurusan = DB::table('bidang_keahlian')->select('id_bidang_keahlian', 'nama', 'kode')->get();
        $angkatan = DB::table('mahasiswa')->whereNotNull('angkatan')->distinct()->pluck('angkatan');
        $periode = DB::table('mahasiswa')->whereNotNull('periode')->distinct()->pluck('periode');
        
        // Get kelas
        $kelas = DB::table('kelas')->select('id_kelas', 'nama_kelas')->get();
        
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
        // Eager load both kelas and bidang_keahlian relationships
        $query = Mahasiswa::with(['data_kelas' => function($q) {
            $q->select('id_kelas', 'nama_kelas');
        }, 'bidangKeahlian' => function($q) {
            $q->select('id_bidang_keahlian', 'nama', 'kode');
        }]);

        // 1. Filter Bidang Keahlian (was Jurusan)
        if ($request->filled('jurusan') && !in_array($request->jurusan, ['', 'Semua Jurusan'])) {
            $query->where('id_bidang_keahlian', $request->jurusan);
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
        $mahasiswa = $query->select('id_mahasiswa', 'nipd', 'nama', 'id_bidang_keahlian', 'angkatan', 'periode', 'status', 'id_kelas')
                           ->limit(500)
                           ->get();
        
        return response()->json($mahasiswa);

    } catch (\Exception $e) {
        return response()->json(['message' => 'Gagal memuat data: ' . $e->getMessage()], 500);
    }
}

    /**
     * API untuk mendapatkan filter options yang dependent/berantai
     */
    public function getDependentFilterData(Request $request)
    {
        try {
            // Base query untuk mahasiswa
            $query = DB::table('mahasiswa');
            
            // Apply existing filters untuk narrow down options
            if ($request->filled('jurusan') && $request->jurusan !== '') {
                $query->where('id_bidang_keahlian', $request->jurusan);
            }
            if ($request->filled('angkatan') && $request->angkatan !== '') {
                $query->where('angkatan', $request->angkatan);  
            }
            if ($request->filled('periode') && $request->periode !== '') {
                $query->where('periode', $request->periode);
            }
            
            // Get distinct values sesuai filter yang sudah dipilih
            $jurusan = DB::table('bidang_keahlian')->select('id_bidang_keahlian', 'nama', 'kode')->get();
            $angkatan = (clone $query)->whereNotNull('angkatan')->distinct()->orderBy('angkatan', 'desc')->pluck('angkatan');
            $periode = (clone $query)->whereNotNull('periode')->distinct()->orderBy('periode', 'desc')->pluck('periode');
            
            // For kelas, join dengan tabel kelas dan apply filters
            $kelasQuery = DB::table('mahasiswa')
                ->join('kelas', 'mahasiswa.id_kelas', '=', 'kelas.id_kelas')
                ->select('kelas.id_kelas', 'kelas.nama_kelas')
                ->whereNotNull('mahasiswa.id_kelas');
            
            if ($request->filled('jurusan') && $request->jurusan !== '') {
                $kelasQuery->where('mahasiswa.id_bidang_keahlian', $request->jurusan);
            }
            if ($request->filled('angkatan') && $request->angkatan !== '') {
                $kelasQuery->where('mahasiswa.angkatan', $request->angkatan);
            }
            if ($request->filled('periode') && $request->periode !== '') {
                $kelasQuery->where('mahasiswa.periode', $request->periode);
            }
            
            $kelas = $kelasQuery->distinct()->get();
            
            return response()->json([
                'status' => 'success',
                'jurusan' => $jurusan,
                'angkatan' => $angkatan,
                'periode' => $periode,
                'kelas' => $kelas
            ]);
        } catch (\Exception $e) {
            return response()->json(['status' => 'error', 'message' => $e->getMessage()], 500);
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
        'id_bidang_keahlian' => 'required',
        'angkatan' => 'required',
        'id_kelas' => 'nullable',
        'foto' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        'jenis_kelamin' => 'nullable|in:L,P',
        'tempat_lahir' => 'nullable|string',
        'tgl_lahir' => 'nullable|date',
        'agama' => 'nullable|string',
        'email' => 'nullable|email',
        'no_tlp' => 'nullable|string',
        'alamat' => 'nullable|string',
        'status' => 'nullable|string'
    ]);

    // UPDATE SEMUA KOLOM
    $mahasiswa->nama = $request->nama;
    $mahasiswa->nipd = $request->nipd; 
    $mahasiswa->id_bidang_keahlian = $request->id_bidang_keahlian;
    $mahasiswa->angkatan = $request->angkatan;
    $mahasiswa->periode = $request->periode;
    $mahasiswa->id_kelas = $request->id_kelas;
    
    // Personal data
    $mahasiswa->jenis_kelamin = $request->jenis_kelamin;
    $mahasiswa->tempat_lahir = $request->tempat_lahir;
    $mahasiswa->tgl_lahir = $request->tgl_lahir;
    $mahasiswa->agama = $request->agama;
    $mahasiswa->email = $request->email;
    $mahasiswa->no_tlp = $request->no_tlp;
    $mahasiswa->alamat = $request->alamat;
    $mahasiswa->status = $request->status;

    // Handle foto upload
    if ($request->hasFile('foto')) {
        // Delete old foto if exists
        if ($mahasiswa->foto && file_exists(public_path($mahasiswa->foto))) {
            unlink(public_path($mahasiswa->foto));
        }
        
        $file = $request->file('foto');
        $filename = time() . '_' . $mahasiswa->nipd . '.' . $file->getClientOriginalExtension();
        $file->move(public_path('uploads/mahasiswa'), $filename);
        $mahasiswa->foto = 'uploads/mahasiswa/' . $filename;
    }

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
                $query->where('id_bidang_keahlian', $request->jurusan);
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