<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class LaporanController extends Controller
{
    // --- 1. HALAMAN FILTER ---
    public function indexMahasiswa() {
        return view('akademik.laporan.mahasiswa');
    }

    public function indexDosen() {
        return view('akademik.laporan.dosen');
    }

    // --- 2. LOGIKA CETAK DENGAN DATA MOCKUP ---
    public function cetakMahasiswa(Request $request)
    {
        // Data Mockup dalam bentuk Array (Bisa dianggap sebagai JSON)
        $mahasiswaMockup = [
            ['nim' => '2022001', 'nama' => 'Bambang Sudarsono', 'prodi' => 'TI', 'angkatan' => '2022', 'status' => 'Aktif'],
            ['nim' => '2022002', 'nama' => 'Dewi Lestari', 'prodi' => 'SI', 'angkatan' => '2023', 'status' => 'Aktif'],
            ['nim' => '2022003', 'nama' => 'Chandra Wijaya', 'prodi' => 'TI', 'angkatan' => '2022', 'status' => 'Cuti'],
            ['nim' => '2022004', 'nama' => 'Elsa Putri', 'prodi' => 'Akuntansi', 'angkatan' => '2024', 'status' => 'Lulus'],
        ];

        // Ubah array jadi Collection agar bisa difilter dengan mudah
        $data = collect($mahasiswaMockup);

        // --- PROSES FILTER (Simulasi Database) ---
        if ($request->prodi) {
            $data = $data->where('prodi', $request->prodi);
        }

        if ($request->angkatan) {
            $data = $data->where('angkatan', $request->angkatan);
        }

        if ($request->status) {
            $data = $data->where('status', $request->status);
        }

        // --- PENYIAPAN PDF ---
        $config = [
            'title' => 'LAPORAN DATA MAHASISWA',
            'date'  => date('d F Y'),
            'items' => $data // Data yang sudah difilter
        ];

        // Load view PDF (Kita buat file ini di langkah selanjutnya)
        $pdf = Pdf::loadView('akademik.laporan.pdf_mhs', $config);
        
        return $pdf->stream('laporan_mahasiswa.pdf');
    }

    public function cetakDosen(Request $request)
    {
        // 1. Data Mockup Dosen (Aku tambahkan prodi & pendidikan biar sesuai tabel)
        $dosenMockup = [
            ['nidn' => '00112233', 'nama' => 'Prof. Andi Wijaya, Ph.D', 'jabatan' => 'Lektor Kepala', 'prodi' => 'TI', 'pendidikan' => 'S3'],
            ['nidn' => '00445566', 'nama' => 'Budi Santoso, M.Kom', 'jabatan' => 'Asisten Ahli', 'prodi' => 'SI', 'pendidikan' => 'S2'],
            ['nidn' => '00998877', 'nama' => 'Siti Aminah, M.Si', 'jabatan' => 'Lektor', 'prodi' => 'Akuntansi', 'pendidikan' => 'S2'],
        ];

        $data = collect($dosenMockup);

        // 2. Proses Filter (Jika ada input dari form)
        if ($request->prodi) {
            $data = $data->where('prodi', $request->prodi);
        }

        // 3. Penyiapan Config (HARUS ADA 'title' dan 'date' biar nggak error)
        $config = [
            'title' => 'LAPORAN DATA DOSEN',
            'date'  => date('d F Y'), // Mengirim tanggal hari ini
            'items' => $data          // Mengirim data dosen
        ];

        // 4. Load view PDF
        $pdf = Pdf::loadView('akademik.laporan.pdf_dosen', $config);
        
        return $pdf->stream('laporan_dosen.pdf');
    }
}