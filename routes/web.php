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
Route::get('/logout', [LoginController::class, 'logout'])->name('logout');


// =========================================================================
// RUTE E-MANAGEMENT (ADMIN) - DILINDUNGI OLEH MIDDLEWARE 'admin'
// =========================================================================

// Menggunakan alias middleware 'admin' dan prefix 'akademik'
Route::middleware('admin')->prefix('akademik')->name('admin.')->group(function () {
    
    // 1. Dashboard Utama E-Management (digunakan setelah login berhasil)
    // Diganti dari Route::view('/dashboard', 'dashboard')
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // 2. Data Master (Kelola Dosen, Mahasiswa, Ruangan, Jurusan)
    // Menggunakan Controller untuk arsitektur yang lebih baik
    Route::get('/mahasiswa', [AkademikController::class, 'index'])->name('mahasiswa.index');
    Route::get('/dosen', [LecturerController::class, 'index'])->name('dosen.index');
    
    // Menggunakan Route::view untuk rute yang masih murni statis (tanpa controller)
    Route::view('laporan-krs', 'akademik.krs')->name('krs.laporan');
    Route::view('kelola-matkul', 'akademik.kelola_matkul')->name('kelola_matkul');
    Route::view('kelola-jadwal', 'akademik.kelola_jadwal')->name('kelola_jadwal');

    // 3. Validasi & Laporan
    Route::view('validasi-absensi', 'akademik.validasi_absensi')->name('validasi_absensi');
    Route::view('kelola-laporan', 'akademik.kelola_laporan')->name('kelola_laporan');

});