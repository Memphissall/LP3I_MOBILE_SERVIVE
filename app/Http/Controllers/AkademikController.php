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

    // Tambahkan method controller lain untuk fitur akademik di sini
}