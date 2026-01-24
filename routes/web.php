<?php

use Illuminate\Support\Facades\Route;

// Controllers
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\PendidikController;
use App\Http\Controllers\Admin\MahasiswaController;
use App\Http\Controllers\Admin\BobotNilaiController;
use App\Http\Controllers\ELecturer\TugasController;
use App\Http\Controllers\ELecturer\NilaiController;
use App\Http\Controllers\ELecturer\MateriController;
use App\Http\Controllers\ELecturer\AbsensiLkmController;
use App\Http\Controllers\ELecturer\DashboardController;
use App\Http\Controllers\ELecturer\HonorController;
use App\Http\Controllers\Admin\HonorTambahanController;
use App\Http\Controllers\Admin\HonorRekapController;
 use App\Http\Controllers\Admin\LkmRekapController;


// ==========================
// HALAMAN AWAL
// ==========================
Route::get('/', function () {
    return view('auth.login');
})->name('auth.login');
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

    Route::get('/dashboard', [DashboardController::class, 'index'])
        ->name('user.dashboard');

    // Jadwal pendidik
    Route::get('/pendidik/jadwal', [\App\Http\Controllers\ELecturer\JadwalController::class, 'index'])
        ->name('pendidik.jadwal.index');

    // ==========================================================
    // BAGIAN FITUR ABSENSI & LKM PENDIDIK (DIPERBAIKI)
    // ==========================================================
    Route::prefix('pendidik')->group(function () {
        // 1. Halaman Pilih (Sudah Oke)
        Route::get('/absen', [AbsensiLkmController::class, 'pilihKelasMK'])
            ->name('pendidik.absen');
        // 2. get matakuliah
       Route::get('/absensi/get-matkul',[AbsensiLkmController::class, 'getMatkulBySemester'])->name('absensi.getMatkul');

        // 3. Halaman Input Absen Mahasiswa (TAMBAHKAN parameter {semester})
        Route::get('/absensi/create/{id_kelas}/{kode_mk}/{semester}', [AbsensiLkmController::class, 'create'])
            ->name('admin.pendidik.absen.create');

        // 4. Simpan Absen
        Route::post('/absensi/store/{id_kelas}/{kode_mk}', [AbsensiLkmController::class, 'storeAbsen'])
            ->name('admin.pendidik.absen.store');

        // 5. Halaman Form LKM (Tambahkan semester agar alur tidak putus)
        Route::get('/lkm/form/{id_kelas}/{kode_mk}/{semester}', [AbsensiLkmController::class, 'createLkm'])
            ->name('admin.pendidik.lkm.form');

        // 6. Simpan LKM
        Route::post('/lkm/store/{id_kelas}/{kode_mk}', [AbsensiLkmController::class, 'storeLkm'])
            ->name('pendidik.lkm.store');

        // 7. Riwayat LKM
        Route::get('/absensi/list/{id_kelas}/{kode_mk}', [AbsensiLkmController::class, 'listLkm'])
            ->name('pendidik.lkm.list');

        // --- FITUR BARU: ROUTE UNTUK EDIT LKM ---
        Route::get('/lkm/edit/{id_kelas}/{kode_mk}/{id_pertemuan}', [AbsensiLkmController::class, 'editLkm'])
            ->name('admin.pendidik.lkm.edit');
        
        

        // hapus lkm
        Route::delete('/lkm/delete/{id_kelas}/{kode_mk}/{id_pertemuan}',[AbsensiLkmController::class, 'destroy'])->name('pendidik.lkm.delete');

        Route::get('/pendidik/lkm/detail/{id_kelas}/{kode_mk}/{id_pertemuan}',[AbsensiLkmController::class, 'detailAbsensi'])->name('pendidik.lkm.detail');

    });


    // ==========================
    // FITUR TUGAS PENDIDIK
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
    

    Route::get('/tugas/{id_kelas}/{kode_mk}/{tugas_id}/submissi', [TugasController::class, 'lihatSubmissi'])
            ->name('submissi.index');

    });

    // Ajax get matkul
    
    // ==========================
// CRUD NILAI PENDIDIK
// ==========================
    Route::prefix('nilai')->group(function () {

    Route::get('/pilih', [NilaiController::class, 'index'])
        ->name('nilai.index');

    // AJAX MATKUL
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
// HONOR / GAJI PENDIDIK
// ==========================
Route::middleware(['auth'])->prefix('pendidik')->group(function () {

    Route::get(
        '/honor/hitung/{semester}/{tahun}',
        [HonorController::class, 'hitungGajiPendidik']
    )->name('pendidik.honor.hitung');

    Route::get(
        '/honor/rekap/{semester}/{tahun}',
        [HonorController::class, 'rekap']
    )->name('pendidik.honor.rekap');


    Route::get('/pendidik/gaji', [AbsensiLkmController::class, 'totalGaji'])
     ->name('pendidik.gaji');


     
});



// ==========================
// FITUR MATERI PENDIDIK
// ==========================
Route::prefix('materi')->group(function () {

Route::get('/get-by-semester', [MateriController::class, 'getBySemester'])
        ->name('materi.getBySemester');

    // Pilih kelas & matkul
    Route::get('/pilih', [MateriController::class, 'pilihKelasMK'])
        ->name('materi.pilih');

    // Ajax get matkul by kelas
    Route::post('/get-matkul', [MateriController::class, 'getMatkul'])
        ->name('materi.getMatkul');

    // EDIT (harus di atas)
    Route::get('/{id}/edit', [MateriController::class, 'edit'])
        ->name('materi.edit');

    // UPDATE
    Route::put('/{id}', [MateriController::class, 'update'])
        ->name('materi.update');

    // DELETE
    Route::delete('/{id}', [MateriController::class, 'destroy'])
        ->name('materi.destroy');

    // LIST materi per kelas & mk
    Route::get('/{id_kelas}/{kode_mk}', [MateriController::class, 'index'])
        ->name('materi.index');

    // FORM TAMBAH
    Route::get('/{id_kelas}/{kode_mk}/tambah', [MateriController::class, 'create'])
        ->name('materi.tambah');

    // SIMPAN
    Route::post('/{id_kelas}/{kode_mk}', [MateriController::class, 'store'])
        ->name('materi.store');
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

    // CRUD Pendidik
    Route::resource('/admin/pendidik', PendidikController::class)->names('admin.pendidik');

    // CRUD Mahasiswa
    Route::resource('/admin/mahasiswa', MahasiswaController::class)->names('admin.mahasiswa');

    // Tambah user manual
    // Route::get('/user/create', [UserController::class, 'create'])->name('admin.user.create');
    // Route::post('/user/store', [UserController::class, 'store'])->name('admin.user.store');

    //  Bobot Nilai
    Route::get('/bobot-nilai', [BobotNilaiController::class, 'index'])->name('admin.bobot.index');
    Route::post('/bobot-nilai/store', [BobotNilaiController::class, 'store'])->name('admin.bobot.store');

    // ==========================
// HONOR TAMBAHAN PENDIDIK (AKADEMIK)
// ==========================
Route::prefix('admin/akademik')
    ->name('admin.akademik.')
    ->group(function () {

        Route::get('/tambahan-honor', [HonorTambahanController::class, 'index'])
            ->name('tambahan-honor');

        Route::get('/tambahan-honor/create', [HonorTambahanController::class, 'create'])
            ->name('tambahan-honor.create');

        Route::post('/tambahan-honor', [HonorTambahanController::class, 'store'])
            ->name('tambahan-honor.store');
    });

         Route::get('/admin/rekap-gaji-pendidik',[HonorRekapController::class, 'index']
            )->name('admin.rekap.gaji-pendidik');

           

Route::middleware(['auth','admin'])->prefix('admin')->group(function () {
    Route::get('/rekap-lkm', [LkmRekapController::class, 'index'])
        ->name('admin.rekap.lkm');
});



});
