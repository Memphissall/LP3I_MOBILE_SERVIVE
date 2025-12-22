<?php

use Illuminate\Support\Facades\Route;

// Controllers
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\DosenController;
use App\Http\Controllers\Admin\MahasiswaController;
use App\Http\Controllers\Admin\BobotNilaiController;
use App\Http\Controllers\ELecturer\TugasController;
use App\Http\Controllers\ELecturer\NilaiController;



// ==========================
// HALAMAN AWAL
// ==========================
Route::get('/', function () {
    return view('welcome');
});

// ==========================
// AUTH (LOGIN)
// ==========================
Route::get('/login', [AuthenticatedSessionController::class, 'create'])
    ->name('login');

Route::post('/login', [AuthenticatedSessionController::class, 'store'])
    ->name('login.store');

// ==========================
// AREA USER (HARUS LOGIN)
// ==========================
Route::middleware(['auth'])->group(function () {

    // Dashboard user
    Route::get('/dashboard', fn() => view('dashboard'))
        ->name('user.dashboard');
    
    // Jadwal dosen
    Route::get('/dosen/jadwal', [\App\Http\Controllers\ELecturer\JadwalController::class, 'index'])
        ->name('dosen.jadwal.index');

    // ==========================
    // FITUR TUGAS DOSEN
    // ==========================

    Route::get('/tugas/get-matkul',  [TugasController::class, 'getMatkulBySemester'])->name('tugas.getMatkulBySemester');
    //view
    Route::get('/tugas-view/{id_kelas}/{kode_mk}',[TugasController::class, 'viewTugas']) ->name('tugas.view');

    // Halaman pilih kelas + matkul
    Route::get('/tugas/pilih', [TugasController::class, 'pilihKelasMK'])
        ->name('tugas.pilih');

    // Filter kelas & matkul
    Route::post('/tugas/filter', [TugasController::class, 'filter'])
        ->name('tugas.filter');

    // Routes yang pakai {id} harus ditempatkan dulu supaya tidak bentrok
    Route::prefix('tugas')->group(function () {

        // Edit
        Route::get('/{id}/edit', [TugasController::class, 'edit'])
            ->name('tugas.edit');

        // Update
        Route::put('/{id}', [TugasController::class, 'update'])
            ->name('tugas.update');

        // Delete
        Route::delete('/{id}', [TugasController::class, 'destroy'])
            ->name('tugas.destroy');

        // List tugas berdasarkan kelas & mk
        Route::get('/{id_kelas}/{kode_mk}', [TugasController::class, 'index'])
            ->name('tugas.index');
            
        // Create
        Route::get('/{id_kelas}/{kode_mk}/tambah', [TugasController::class, 'create'])
            ->name('tugas.tambah');

        // Store
        Route::post('/{id_kelas}/{kode_mk}', [TugasController::class, 'store'])
            ->name('tugas.store');
        
        // Lihat submissi mahasiswa untuk tugas tertentu
    Route::get('/tugas/{id_kelas}/{kode_mk}/submissi', [TugasController::class, 'lihatSubmissi'])
            ->name('submissi.index');


    });

    // Ajax get matkul
    

    // ==========================
// CRUD NILAI DOSEN
// ==========================
Route::prefix('nilai')->group(function () {

    Route::get('/pilih', [NilaiController::class, 'index'])
        ->name('nilai.index');

    // ✅ SATU-SATUNYA AJAX MATKUL
    Route::get('/get-matkul', [NilaiController::class, 'getMatkulBySemester'])
        ->name('nilai.getMatkul');

    Route::post('/filter', [NilaiController::class, 'filter'])
        ->name('nilai.filter');

   Route::get('/{id_kelas}/{kode_mk}/{semester}/input', [NilaiController::class, 'input'])
    ->name('nilai.input');


    Route::post('/store', [NilaiController::class, 'store'])
        ->name('nilai.store');                

   Route::get('/{id_kelas}/{kode_mk}/{semester}/view', [NilaiController::class, 'view'])->name('nilai.view');


    Route::get('/{id_nilai}/edit', [NilaiController::class, 'edit'])
        ->name('nilai.edit');

    Route::put('/{id_nilai}', [NilaiController::class, 'update'])
        ->name('nilai.update');


        //ajak nilai
    Route::get('/ajax/view', [NilaiController::class, 'ajaxView'])
        ->name('nilai.ajax.view');
});




    // ==========================
    // PROFILE
    // ==========================
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Logout
    Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');
});

// ==========================
// AREA ADMIN (ROLE ADMIN)
// ==========================
Route::middleware(['auth', 'admin'])->group(function () {

    // Dashboard admin
    Route::get('/admin/dashboard', fn() => view('admin.dashboard'))->name('admin.dashboard');

    // Registrasi user
    Route::get('/register', [RegisteredUserController::class, 'create'])->name('register');
    Route::post('/register', [RegisteredUserController::class, 'store'])->name('register.store');

    // CRUD User
    Route::resource('/admin/users', UserController::class)->names('admin.users');

    // CRUD Dosen
    Route::resource('/admin/dosen', DosenController::class)->names('admin.dosen');

    // CRUD Mahasiswa
    Route::resource('/admin/mahasiswa', MahasiswaController::class)->names('admin.mahasiswa');

    // Tambah user manual
    Route::get('/user/create', [UserController::class, 'create'])->name('admin.user.create');
    Route::post('/user/store', [UserController::class, 'store'])->name('admin.user.store');

    //  Bobot Nilai
    Route::get('/bobot-nilai', [BobotNilaiController::class, 'index'])->name('admin.bobot.index');
    Route::post('/bobot-nilai/store', [BobotNilaiController::class, 'store'])->name('admin.bobot.store');
});
