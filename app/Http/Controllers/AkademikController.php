<?php

namespace App\Http\Controllers;

// WAJIB: Gunakan class Controller yang benar dari Laravel/Lumen
use Illuminate\Routing\Controller; 
use Illuminate\Http\Request;
// use App\Models\Mahasiswa; // Tambahkan jika model Mahasiswa sudah dibuat

class AkademikController extends Controller
{
    /**
     * Menampilkan halaman daftar mahasiswa.
     * Route: /akademik/data-mahasiswa (admin.mahasiswa.index)
     */
    public function index()
    {
        // Karena view data_mahasiswa.blade.php sudah memiliki logic data mockup di JavaScript,
        // kita hanya perlu me-return view tersebut.
        
        return view('akademik.data_mahasiswa');
    }

    public function dataDosen()
    {
        return view('akademik.data_dosen');
    }

    public function dataMataKuliah()
    {
        return view('akademik.data_mata_kuliah');
    }

    public function dataJadwal()
    {
        return view('akademik.data_jadwal');
    }

    public function validasiAbsensi()
    {
        return view('akademik.validasi_absensi');
    }
    /**
     * Method untuk memproses penambahan data mahasiswa (Contoh untuk masa depan).
     * Route: POST /akademik/data-mahasiswa (admin.mahasiswa.store)
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // 1. VALIDASI DATA
        // Ini memastikan data yang masuk sesuai dengan aturan yang Anda tetapkan.
        $validatedData = $request->validate([
            'nim' => 'required|string|max:15|unique:mahasiswa,nim', // Asumsi ada tabel 'mahasiswa'
            'nama_lengkap' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'tanggal_lahir' => 'nullable|date',
            'prodi' => 'required|string',
        ], [
            // Custom pesan kesalahan (Opsional)
            'nim.unique' => 'NIM ini sudah terdaftar. Mohon gunakan NIM lain.',
            'required' => 'Kolom :attribute wajib diisi.',
        ]);

        // 2. LOGIKA PENYIMPANAN DATA KE DATABASE (Mockup)
        try {
            // Contoh sederhana tanpa menggunakan Model
            // $mahasiswa = new Mahasiswa;
            // $mahasiswa->nim = $validatedData['nim'];
            // $mahasiswa->nama = $validatedData['nama_lengkap'];
            // ... dst
            // $mahasiswa->save();

            // Dalam konteks ini, kita hanya akan me-return respons sukses
            return redirect()->route('admin.mahasiswa.index')
                             ->with('success', 'Data mahasiswa ' . $validatedData['nama_lengkap'] . ' berhasil ditambahkan!');

        } catch (\Exception $e) {
            // Jika terjadi kesalahan database
            return redirect()->back()->withInput()
                             ->with('error', 'Gagal menyimpan data: ' . $e->getMessage());
        }
    }

    // ... di dalam class AkademikController { ...

    /**
     * Method untuk memproses PENGEDITAN data mahasiswa yang sudah ada.
     * Route: PUT/PATCH /akademik/mahasiswa/{id}
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int $id ID Mahasiswa yang akan di-update
     * @return \Illuminate\Http\Response
     */
    public function updateMahasiswa(Request $request, $id)
    {
        // 1. VALIDASI DATA
        $request->validate([
            'nim' => 'required|string|max:15',
            'nama_lengkap' => 'required|string|max:255',
            // ... validasi lainnya
        ]);
        
        // 2. SIMULASI PENGEDITAN DAN PENGEMBALIAN PESAN SUKSES
        $nama = $request->input('nama_lengkap') ?? 'Mahasiswa ID ' . $id;

        return redirect()->route('akademik.mahasiswa')
                         ->with('success', 'Data Mahasiswa ' . $nama . ' berhasil **diedit** (diperbarui)! ID: ' . $id);
    }

    /**
     * Method untuk memproses PENGHAPUSAN data mahasiswa.
     * Route: DELETE /akademik/mahasiswa/{id}
     *
     * @param  int $id ID Mahasiswa yang akan dihapus
     * @return \Illuminate\Http\Response
     */
    public function destroyMahasiswa($id)
    {
        // 1. SIMULASI PENGHAPUSAN DAN PENGEMBALIAN PESAN SUKSES
        return redirect()->route('akademik.mahasiswa')
                         ->with('success', 'Data Mahasiswa (ID: ' . $id . ') berhasil **dihapus**!');
    }

// ...

    // ... Kode controller sebelumnya (dataMahasiswa, dataMataKuliah, dataDosen, store Mahasiswa, store Dosen, store Mata Kuliah) ...

    /**
     * Method untuk memproses PENGEDITAN data dosen yang sudah ada.
     * Route: PUT/PATCH /akademik/dosen/{id}
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int $id ID Dosen yang akan di-update
     * @return \Illuminate\Http\Response
     */
    public function updateDosen(Request $request, $id)
    {
        // 1. VALIDASI DATA (Biasanya sama seperti store, tapi NIDN tidak perlu unique pada ID yang sama)
        $request->validate([
            'nidn' => 'required|string|max:20', 
            'nama_lengkap' => 'required|string|max:255',
            'pendidikan_terakhir' => 'required|in:S1,S2,S3', 
            'status' => 'required|in:Aktif,Cuti,Non-Aktif,Tugas Belajar',
        ]);

        // 2. LOGIKA PENGEDITAN DATA KE DATABASE
        // try {
            // Temukan Dosen berdasarkan ID
            // $dosen = Dosen::findOrFail($id);
            // $dosen->update($request->all());

            // --- SIMULASI SUKSES ---
            $nama = $request->input('nama_lengkap') ?? 'Dosen ID ' . $id;

            return redirect()->route('akademik.dosen') 
                             ->with('success', 'Data Dosen ' . $nama . ' berhasil **diedit** (diperbarui)! ID: ' . $id);

        // } catch (\Exception $e) {
        //     return redirect()->back()->with('error', 'Gagal mengedit data Dosen.');
        // }
    }


    /**
     * Method untuk memproses PENGHAPUSAN data dosen.
     * Route: DELETE /akademik/dosen/{id}
     *
     * @param  int $id ID Dosen yang akan dihapus
     * @return \Illuminate\Http\Response
     */
    public function destroyDosen($id)
    {
        // 1. LOGIKA PENGHAPUSAN DATA DARI DATABASE
        // try {
            // Dosen::destroy($id); 
            // Atau: $dosen = Dosen::findOrFail($id); $dosen->delete();

            // --- SIMULASI SUKSES ---
            return redirect()->route('akademik.dosen')
                             ->with('success', 'Data Dosen (ID: ' . $id . ') berhasil **dihapus**!');

        // } catch (\Exception $e) {
        //     return redirect()->back()->with('error', 'Gagal menghapus data Dosen.');
        // }
    }

    /** mata kuliah
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function storeMataKuliah(Request $request)
    {
        // 1. VALIDASI DATA MATA KULIAH
        $validatedData = $request->validate([
            'kode_mk' => 'required|string|max:10|unique:mata_kuliah,kode_mk', // Asumsi ada tabel 'mata_kuliah'
            'nama_mk' => 'required|string|max:255',
            'jurusan' => 'required|in:Teknik Informatika,Sistem Informasi,Akuntansi', // Sesuaikan dengan opsi di view
            'sks' => 'required|integer|min:1|max:6', // SKS biasanya antara 1 sampai 6
            'semester' => 'required|integer|min:1|max:8', // Asumsi maksimal 8 semester
        ], [
            // Custom pesan kesalahan
            'kode_mk.unique' => 'Kode Mata Kuliah ini sudah terdaftar.',
            'required' => 'Kolom :attribute wajib diisi.',
            'integer' => 'Kolom :attribute harus berupa angka.',
            'in' => 'Kolom :attribute memiliki nilai yang tidak valid.',
        ]);

        // 2. LOGIKA PENYIMPANAN DATA KE DATABASE (Mockup)
        try {
            // Jika model MataKuliah sudah dibuat, implementasi di sini:
            // MataKuliah::create([
            //     'kode_mk' => $validatedData['kode_mk'],
            //     'nama' => $validatedData['nama_mk'],
            //     'jurusan' => $validatedData['jurusan'],
            //     'sks' => $validatedData['sks'],
            //     'semester' => $validatedData['semester'],
            // ]);

            // Dalam konteks ini, kita me-return respons sukses dan redirect
            return redirect()->route('akademik.matakuliah') 
                             ->with('success', 'Mata Kuliah ' . $validatedData['nama_mk'] . ' berhasil ditambahkan!');

        } catch (\Exception $e) {
            // Jika terjadi kesalahan database/server
            return redirect()->back()->withInput()
                             ->with('error', 'Gagal menyimpan data Mata Kuliah: ' . $e->getMessage());
        }
    }

    // ... di dalam class AkademikController { ...

    /**
     * Method untuk memproses PENGEDITAN data Mata Kuliah yang sudah ada.
     * Route: PUT/PATCH /akademik/mata-kuliah/{id}
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int $id ID Mata Kuliah yang akan di-update
     * @return \Illuminate\Http\Response
     */
    public function updateMataKuliah(Request $request, $id)
    {
        // 1. VALIDASI DATA
        $request->validate([
            'kode_mk' => 'required|string|max:10',
            'nama_mk' => 'required|string|max:255',
            'sks' => 'required|integer|min:1|max:6',
            // ... validasi lainnya
        ]);
        
        // 2. SIMULASI PENGEDITAN DAN PENGEMBALIAN PESAN SUKSES
        $nama = $request->input('nama_mk') ?? 'Mata Kuliah ID ' . $id;

        return redirect()->route('akademik.matakuliah')
                         ->with('success', 'Data Mata Kuliah ' . $nama . ' berhasil **diedit** (diperbarui)! ID: ' . $id);
    }

    /**
     * Method untuk memproses PENGHAPUSAN data Mata Kuliah.
     * Route: DELETE /akademik/mata-kuliah/{id}
     *
     * @param  int $id ID Mata Kuliah yang akan dihapus
     * @return \Illuminate\Http\Response
     */
    public function destroyMataKuliah($id)
    {
        // 1. SIMULASI PENGHAPUSAN DAN PENGEMBALIAN PESAN SUKSES
        return redirect()->route('akademik.matakuliah')
                         ->with('success', 'Data Mata Kuliah (ID: ' . $id . ') berhasil **dihapus**!');
    }

    public function updateJadwal(Request $request, $id)
    {
        // ... logika validasi ...
        // $jadwal = Jadwal::findOrFail($id);
        // $jadwal->update($request->all());

        return redirect()->route('akademik.jadwal')->with('success', "Jadwal ID {$id} berhasil diperbarui.");
    }

    /**
     * Metode untuk DELETE Jadwal berdasarkan ID.
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroyJadwal($id)
    {
        // $jadwal = Jadwal::findOrFail($id);
        // $jadwal->delete();

        return redirect()->route('akademik.jadwal')->with('success', "Jadwal ID {$id} berhasil dihapus.");
    }

    /**
 * Metode untuk menyimpan hasil validasi absensi (Dipanggil via AJAX).
 * @param Request $request Harus berisi schedule_id dan array validation_data
 * @return \Illuminate\Http\JsonResponse
 */
public function storeValidasiAbsensi(Request $request)
{
    // Cuma log data yang diterima dan langsung kirim sukses
    \Log::info("Data Validasi Diterima:", $request->all());

    // LANGSUNG KEMBALIKAN RESPON SUKSES (Simulasi DB berhasil)
    return response()->json([
        'success' => true, 
        'message' => "Validasi absensi berhasil disimpan (Simulasi Sukses)."
    ], 200); 
}
// ...

}