<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\AkademikController; // Wajib: Untuk Master Data Akademik
use App\Http\Controllers\DashboardController; // Asumsi: Untuk menampilkan dashboard
use App\Http\Controllers\DosenController; // Asumsi: Untuk menampilkan dosen
use App\Http\Controllers\MahasiswaController; // Asumsi: Untuk menampilkan mahasiswa
use App\Http\Controllers\KelasController; // Asumsi: Untuk menampilkan kelas

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
    Route::get('/dosen', [DosenController::class, 'index'])->name('dosen.index');
    
    // Menggunakan Route::view untuk rute yang masih murni statis (tanpa controller)
    Route::view('laporan-krs', 'akademik.krs')->name('krs.laporan');
    Route::view('kelola-matkul', 'akademik.kelola_matkul')->name('kelola_matkul');
    Route::view('kelola-jadwal', 'akademik.kelola_jadwal')->name('kelola_jadwal');

    // 3. Validasi & Laporan
    Route::view('validasi-absensi', 'akademik.validasi_absensi')->name('validasi_absensi');
    Route::view('kelola-laporan', 'akademik.kelola_laporan')->name('kelola_laporan');

    // API Routes for Modal
    Route::get('/api/mahasiswa-list', [App\Http\Controllers\MahasiswaController::class, 'apiList'])->name('api.mahasiswa.list');
    Route::get('/api/kelas-list', [App\Http\Controllers\KelasController::class, 'getKelasList'])->name('api.kelas.list');
    Route::post('/api/kelas/add-students', [App\Http\Controllers\KelasController::class, 'addMahasiswaToKelas'])->name('api.kelas.add_students');
    Route::get('/mahasiswa/print', [App\Http\Controllers\MahasiswaController::class, 'printStudents'])->name('mahasiswa.print');
    Route::get('/api/filter-data', [App\Http\Controllers\MahasiswaController::class, 'getFilterData'])->name('api.filter.data');
    
    // Mahasiswa CRUD Routes
    Route::get('/mahasiswa/{id}/edit', [App\Http\Controllers\MahasiswaController::class, 'edit'])->name('mahasiswa.edit');
    Route::put('/mahasiswa/{id}', [App\Http\Controllers\MahasiswaController::class, 'update'])->name('mahasiswa.update');
    Route::delete('/mahasiswa/{id}', [App\Http\Controllers\MahasiswaController::class, 'destroy'])->name('mahasiswa.destroy');

    // Kelas Routes
    // Sesuaikan dengan nama Controller kamu ya, Bubub
    Route::post('/mahasiswa/assign-class', [KelasController::class, 'assignClass'])->name('mahasiswa.assign');
    
    // Dosen CRUD Routes
    Route::get('/api/dosen-list', [App\Http\Controllers\DosenController::class, 'index'])->name('api.dosen.list');
    Route::post('/dosen', [App\Http\Controllers\DosenController::class, 'store'])->name('dosen.store');
    Route::get('/dosen/{id}/edit', [App\Http\Controllers\DosenController::class, 'edit'])->name('dosen.edit');
    Route::put('/dosen/{id}', [App\Http\Controllers\DosenController::class, 'update'])->name('dosen.update');
    Route::delete('/dosen/{id}', [App\Http\Controllers\DosenController::class, 'destroy'])->name('dosen.destroy');
    Route::get('/dosen/print', [App\Http\Controllers\DosenController::class, 'printDosen'])->name('dosen.print');
    
    // Matkul CRUD Routes
    Route::get('/api/matkul-list', [App\Http\Controllers\MatkulController::class, 'index'])->name('api.matkul.list');
    Route::post('/matkul', [App\Http\Controllers\MatkulController::class, 'store'])->name('matkul.store');
    Route::get('/matkul/{id}/edit', [App\Http\Controllers\MatkulController::class, 'edit'])->name('matkul.edit');
    Route::put('/matkul/{id}', [App\Http\Controllers\MatkulController::class, 'update'])->name('matkul.update');
    Route::delete('/matkul/{id}', [App\Http\Controllers\MatkulController::class, 'destroy'])->name('matkul.destroy');
    Route::get('/matkul/print', [App\Http\Controllers\MatkulController::class, 'printMatkul'])->name('matkul.print');
    
    // Jadwal CRUD Routes
    Route::get('/api/jadwal-list', [App\Http\Controllers\JadwalController::class, 'index'])->name('api.jadwal.list');
    Route::get('/api/jadwal-dropdown', [App\Http\Controllers\JadwalController::class, 'getDropdownData'])->name('api.jadwal.dropdown');
    Route::post('/jadwal', [App\Http\Controllers\JadwalController::class, 'store'])->name('jadwal.store');
    Route::get('/jadwal/{id}/edit', [App\Http\Controllers\JadwalController::class, 'edit'])->name('jadwal.edit');
    Route::put('/jadwal/{id}', [App\Http\Controllers\JadwalController::class, 'update'])->name('jadwal.update');
    Route::delete('/jadwal/{id}', [App\Http\Controllers\JadwalController::class, 'destroy'])->name('jadwal.destroy');
    Route::get('/jadwal/print', [App\Http\Controllers\JadwalController::class, 'printJadwal'])->name('jadwal.print');
    Route::get('/get-waktu/{id}', [JadwalController::class, 'getWaktu']);

});