<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\AkademikController; // Wajib: Untuk Master Data Akademik
use App\Http\Controllers\DashboardController; // Asumsi: Untuk menampilkan dashboard
use App\Http\Controllers\LecturerController; // Asumsi: Untuk menampilkan dosen

// =========================================================================
// RUTE HALAMAN AWAL
// =========================================================================

Route::get('/', function () {
    // Arahkan / ke halaman login jika belum login
    if (session('auth_mock_role')) {
        return redirect()->route('admin.dashboard');
    }
    return redirect()->route('login');
})->name('welcome');


// =========================================================================
// RUTE OTENTIKASI (LOGIN & LOGOUT)
// =========================================================================

// ROUTE LOGIN (Menampilkan Form dan Memproses Form)
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);

// ROUTE LOGOUT
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');


// =========================================================================
// RUTE E-MANAGEMENT (ADMIN) - DILINDUNGI OLEH MIDDLEWARE 'admin'
// =========================================================================

// Menggunakan alias middleware 'admin' dan prefix 'akademik'
Route::middleware('admin')->prefix('akademik')->name('admin.')->group(function () {
    
    // 1. Dashboard Utama E-Management (digunakan setelah login berhasil)
    // Diganti dari Route::view('/dashboard', 'dashboard')
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // 2. Data Master (Kelola Dosen, Mahasiswa, Ruangan, Jurusan)
    // Mahasiswa
    Route::get('/mahasiswa', [AkademikController::class, 'index'])->name('mahasiswa.index');
    Route::post('/mahasiswa', [AkademikController::class, 'store'])->name('mahasiswa.store');
    Route::put('/mahasiswa/{id}', [AkademikController::class, 'updateMahasiswa'])->name('akademik.mahasiswa.update'); // Update
    Route::delete('/mahasiswa/{id}', [AkademikController::class, 'destroyMahasiswa'])->name('akademik.mahasiswa.destroy');
    
    // Dosen
    Route::get('/dosen', [AkademikController::class, 'dataDosen'])->name('dosen.index');
    Route::post('/dosen', [AkademikController::class, 'storeDosen'])->name('akademik.dosen.store'); 
    Route::put('/dosen/{id}', [AkademikController::class, 'updateDosen'])->name('akademik.dosen.update'); 
    Route::patch('/dosen/{id}', [AkademikController::class, 'updateDosen']); // Alias
    Route::delete('/dosen/{id}', [AkademikController::class, 'destroyDosen'])->name('akademik.dosen.destroy');

    // Mata Kuliah
    Route::get('/mata-kuliah', [AkademikController::class, 'dataMataKuliah'])->name('matakuliah.index');
    Route::post('/mata-kuliah', [AkademikController::class, 'storeMataKuliah'])->name('akademik.matakuliah.store');
    Route::put('/mata-kuliah/{id}', [AkademikController::class, 'updateMataKuliah'])->name('akademik.matakuliah.update'); // Update
    Route::delete('/mata-kuliah/{id}', [AkademikController::class, 'destroyMataKuliah'])->name('akademik.matakuliah.destroy'); // Delete

    // Jadwal
    Route::get('/jadwal', [AkademikController::class, 'dataJadwal'])->name('jadwal.index');
    Route::post('/jadwal', [AkademikController::class, 'storeJadwal'])->name('akademik.jadwal.store');
    Route::put('/jadwal/{id}', [AkademikController::class, 'updateJadwal'])->name('akademik.jadwal.update'); // Update
    Route::delete('/jadwal/{id}', [AkademikController::class, 'destroyJadwal'])->name('akademik.jadwal.destroy'); // Delete
    
    // Absensi
    Route::get('/akademik/validasi-absensi', [AkademikController::class, 'validasiAbsensi'])->name('validasiAbsensi.index');
    Route::post('/akademik/validasi-absensi/save', [AkademikController::class, 'storeValidasiAbsensi'])->middleware('Auth');

    // Menggunakan Route::view untuk rute yang masih murni statis (tanpa controller)
    Route::view('laporan-krs', 'akademik.krs')->name('krs.laporan');
    Route::view('kelola-matkul', 'akademik.kelola_matkul')->name('kelola_matkul');
    Route::view('kelola-jadwal', 'akademik.kelola_jadwal')->name('kelola_jadwal');

    // 3. Validasi & Laporan
    Route::view('validasi-absensi', 'akademik.validasi_absensi')->name('validasi_absensi');
    Route::view('kelola-laporan', 'akademik.kelola_laporan')->name('kelola_laporan');

});