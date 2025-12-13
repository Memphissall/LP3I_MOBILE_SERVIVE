{{-- resources/views/akademik/validasi_absensi.blade.php --}}

@extends('layouts.app') 

@section('title', 'Validasi Absensi Kuliah')

@section('content')

<div class="min-h-screen bg-gray-50 p-4 md:p-8 font-sans">
    <h1 class="text-3xl font-extrabold text-gray-800 mb-6 border-b pb-2">
        Validasi Absensi Mahasiswa
    </h1>

    {{-- --- BAGIAN FILTER JADWAL --- --}}
    <div class="bg-white p-6 rounded-xl shadow-lg mb-6">
        <h2 class="text-lg font-semibold text-gray-700 mb-4">Pilih Jadwal untuk Validasi</h2>
        
        <div class="grid grid-cols-2 md:grid-cols-5 gap-4" id="filter-container">
            {{-- Dropdown Jurusan --}}
            <div class="flex flex-col space-y-1">
                <label for="filter-jurusan" class="text-sm font-medium text-gray-700">Jurusan</label>
                <select id="filter-jurusan" class="p-2 border border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500 transition duration-150">
                    <option value="Semua Jurusan">Semua Jurusan</option>
                    <option value="Teknik Informatika">Teknik Informatika</option>
                    <option value="Sistem Informasi">Sistem Informasi</option>
                    <option value="Akuntansi">Akuntansi</option>
                </select>
            </div>
            
            {{-- Dropdown Semester --}}
            <div class="flex flex-col space-y-1">
                <label for="filter-semester" class="text-sm font-medium text-gray-700">Semester</label>
                <select id="filter-semester" class="p-2 border border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500 transition duration-150">
                    <option value="Semua Semester">Semua Semester</option>
                    <option value="1">1</option>
                    <option value="3">3</option>
                    <option value="5">5</option>
                </select>
            </div>

            {{-- Dropdown Hari --}}
            <div class="flex flex-col space-y-1">
                <label for="filter-hari" class="text-sm font-medium text-gray-700">Hari</label>
                <select id="filter-hari" class="p-2 border border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500 transition duration-150">
                    <option value="Semua Hari">Semua Hari</option>
                    <option value="Senin">Senin</option>
                    <option value="Selasa">Selasa</option>
                    <option value="Rabu">Rabu</option>
                    <option value="Kamis">Kamis</option>
                    <option value="Jumat">Jumat</option>
                </select>
            </div>

            {{-- Kolom Pencarian Cepat --}}
            <div class="flex flex-col space-y-1 col-span-2">
                <label for="search-input" class="text-sm font-medium text-gray-700">Cari Cepat (MK/Dosen)</label>
                <input type="text" id="search-input" placeholder="Nama MK atau Dosen..." 
                        class="p-2 border border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500 transition duration-150">
            </div>
        </div>
    </div>

    {{-- --- BAGIAN TABEL JADWAL --- --}}
    <div class="bg-white p-6 rounded-xl shadow-lg mb-8">
        <h2 class="text-lg font-semibold text-gray-700 mb-4">Daftar Jadwal Kuliah Tersedia (<span id="schedule-count">0</span> data)</h2>
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Mata Kuliah</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Dosen Pengampu</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Hari & Jam</th>
                        <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200" id="schedule-table-body">
                    {{-- Data Jadwal akan diisi oleh JavaScript --}}
                </tbody>
            </table>
            <div id="no-schedule-message" class="text-center py-10 text-gray-500 hidden">
                <p>Tidak ada jadwal kuliah yang sesuai dengan filter.</p>
            </div>
        </div>
    </div>

    {{-- --- DETAIL VALIDASI ABSENSI --- --}}
    <div id="validation-detail" class="bg-white p-6 rounded-xl shadow-lg hidden">
        <h2 class="text-xl font-bold text-gray-800 mb-4">
            Validasi Absensi: <span id="matkul-title" class="text-blue-600"></span>
            <span id="session-info" class="text-sm font-normal text-gray-500 ml-2"></span>
        </h2>
        
        <div class="overflow-x-auto mt-4">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">NIM</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama Mahasiswa</th>
                        <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Status Awal (Dosen)</th>
                        <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Status Validasi</th>
                        <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi Validasi</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200" id="student-table-body">
                    {{-- Data Mahasiswa/Absensi akan diisi oleh JavaScript --}}
                </tbody>
            </table>
        </div>
        
        <div class="mt-6 flex justify-end space-x-3">
            <button id="save-validation-btn"
                class="flex items-center space-x-2 px-6 py-2 bg-blue-600 text-white font-semibold rounded-lg shadow-md hover:bg-blue-700 transition duration-150 transform hover:scale-[1.02]">
                <i data-lucide="check-circle" class="w-5 h-5"></i>
                <span>Simpan Validasi</span>
            </button>
            <button id="cancel-validation-btn"
                class="flex items-center space-x-2 px-6 py-2 bg-gray-300 text-gray-800 font-semibold rounded-lg shadow-md hover:bg-gray-400 transition duration-150">
                <i data-lucide="x" class="w-5 h-5"></i>
                <span>Batal</span>
            </button>
        </div>
    </div>
</div>

@endsection

{{-- 🚀 WAJIB: Blok script JQuery yang akan di-push ke @stack('scripts') --}}

@push('scripts')
<script>
// Pastikan Anda memiliki meta tag CSRF token di <head> layout.app:
// <meta name="csrf-token" content="{{ csrf_token() }}">

$(document).ready(function() {
    // Ambil CSRF Token dari meta tag (diperlukan Laravel)
    const CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
    
    // --- DATA MOCKUP JADWAL --- (Tidak Berubah)
    let schedules = [
        { id: 1, matkul: 'Algoritma & Pemrograman', dosen: 'Prof. Andi', jurusan: 'Teknik Informatika', semester: 1, hari: 'Senin', jam: '08:00-10:30', ruangan: 'Lab A', pertemuan: 8 },
        { id: 2, matkul: 'Basis Data', dosen: 'Bpk. Budi', jurusan: 'Sistem Informasi', semester: 3, hari: 'Selasa', jam: '13:00-15:30', ruangan: 'B201', pertemuan: 7 },
        { id: 3, matkul: 'Akuntansi Keuangan I', dosen: 'Ibu Citra', jurusan: 'Akuntansi', semester: 2, hari: 'Rabu', jam: '10:00-12:30', ruangan: 'Auditorium', pertemuan: 9 },
    ];
    
    // --- DATA MOCKUP ABSENSI --- (Tidak Berubah)
    const attendanceData = {
        1: [ // Absensi untuk jadwal ID 1 (Algoritma & Pemrograman)
            { nim: '2022001', nama: 'Bambang Sudarsono', status_dosen: 'Hadir', status_validasi: null },
            { nim: '2022002', nama: 'Dewi Lestari', status_dosen: 'Izin', status_validasi: null }, 
            { nim: '2022003', nama: 'Chandra Wijaya', status_dosen: 'Alfa', status_validasi: null },
            { nim: '2022004', nama: 'Elsa Putri', status_dosen: 'Hadir', status_validasi: 'Sakit' }, 
        ],
    };

    let currentSchedule = null;

    function getStatusColor(status) {
        // ... (fungsi penentu warna badge tetap sama) ...
        if (status === 'Hadir') return 'bg-green-100 text-green-800';
        if (status === 'Alfa') return 'bg-red-100 text-red-800';
        if (status === 'Sakit') return 'bg-pink-100 text-pink-800';
        if (status === 'Izin') return 'bg-yellow-100 text-yellow-800'; 
        return 'bg-gray-100 text-gray-800'; 
    }

    // --- FUNGSI RENDERING DAFTAR JADWAL --- (Tidak Berubah)
    function renderScheduleTable() {
        // ... (Logika render schedules tetap sama) ...
        const filters = {
            jurusan: $('#filter-jurusan').val(),
            semester: $('#filter-semester').val(),
            hari: $('#filter-hari').val(),
            search: $('#search-input').val().toLowerCase(),
        };

        const filteredSchedules = schedules.filter(schedule => {
            const matchJurusan = filters.jurusan === 'Semua Jurusan' || schedule.jurusan === filters.jurusan;
            const matchSemester = filters.semester === 'Semua Semester' || schedule.semester === parseInt(filters.semester);
            const matchHari = filters.hari === 'Semua Hari' || schedule.hari === filters.hari;
            
            const matchSearch = filters.search === '' || 
                                schedule.matkul.toLowerCase().includes(filters.search) ||
                                schedule.dosen.toLowerCase().includes(filters.search);

            return matchJurusan && matchSemester && matchHari && matchSearch;
        });

        const $tbody = $('#schedule-table-body');
        $tbody.empty();

        if (filteredSchedules.length === 0) {
            $('#no-schedule-message').show();
        } else {
            $('#no-schedule-message').hide();
            
            filteredSchedules.forEach(schedule => {
                const row = `
                    <tr data-id="${schedule.id}" class="hover:bg-gray-50 transition duration-100">
                        <td class="px-6 py-4 text-sm font-medium text-gray-900">${schedule.matkul}</td>
                        <td class="px-6 py-4 text-sm text-gray-700">${schedule.dosen}</td>
                        <td class="px-6 py-4 text-sm text-gray-700">${schedule.hari}, ${schedule.jam} (P. ${schedule.pertemuan})</td>
                        <td class="px-6 py-4 text-sm font-medium text-center">
                            <button data-schedule-id="${schedule.id}"
                                class="btn-load-validation text-blue-600 hover:text-white bg-blue-100 hover:bg-blue-600 p-2 rounded-full transition duration-150"
                                title="Validasi Absensi">
                                <i data-lucide="file-check-2" class="w-5 h-5"></i>
                            </button>
                        </td>
                    </tr>
                `;
                $tbody.append(row);
            });
            lucide.createIcons(); 
        }
        $('#schedule-count').text(filteredSchedules.length);
    }

    // --- FUNGSI RENDERING DETAIL ABSENSI --- (Tidak Berubah)
    function loadValidationDetail(scheduleId) {
        // ... (Logika load detail tetap sama) ...
        currentSchedule = schedules.find(s => s.id === scheduleId);
        const data = attendanceData[scheduleId];

        if (!currentSchedule || !data) {
            alert('Data absensi untuk jadwal ini tidak tersedia.');
            return;
        }

        // Update Header
        $('#matkul-title').text(currentSchedule.matkul);
        $('#session-info').text(`| ${currentSchedule.hari}, ${currentSchedule.jam} | Pertemuan ke-${currentSchedule.pertemuan}`);
        
        const $tbody = $('#student-table-body');
        $tbody.empty();

        data.forEach((student, index) => {
            let displayStatus = student.status_validasi !== null ? student.status_validasi : student.status_dosen;
            
            const statusOptions = ['Hadir', 'Izin', 'Sakit', 'Alfa']
                .map(status => 
                    `<option value="${status}" ${displayStatus === status ? 'selected' : ''}>${status}</option>`
                ).join('');
            
            const validationBadge = `<span class="px-3 py-1 rounded-full text-xs font-semibold ${getStatusColor(displayStatus)}">${displayStatus}</span>`;


            const row = `
                <tr data-nim="${student.nim}">
                    <td class="px-6 py-3 text-sm font-semibold text-gray-900">${student.nim}</td>
                    <td class="px-6 py-3 text-sm text-gray-700">${student.nama}</td>
                    
                    {{-- Status Awal (Dosen) --}}
                    <td class="px-6 py-3 text-center text-sm text-gray-500">
                        <span class="px-3 py-1 rounded-full text-xs font-semibold ${getStatusColor(student.status_dosen)}">
                            ${student.status_dosen}
                        </span>
                    </td>

                    {{-- Status Validasi Terakhir (Menggunakan displayStatus) --}}
                    <td class="px-6 py-3 text-center text-sm text-gray-500">
                        ${validationBadge}
                    </td>

                    {{-- Dropdown Aksi Validasi (Dropdown diatur ke displayStatus) --}}
                    <td class="px-6 py-3 text-center">
                        <select data-nim="${student.nim}" 
                            class="validation-status p-2 border border-gray-300 rounded-lg text-sm focus:ring-blue-500 focus:border-blue-500">
                            ${statusOptions}
                        </select>
                    </td>
                </tr>
            `;
            $tbody.append(row);
        });

        $('#validation-detail').removeClass('hidden');
        lucide.createIcons();
    }
    
    // --- HANDLER SIMPAN VALIDASI (REVISI FINAL: Mengaktifkan AJAX ke Controller) ---
    $('#save-validation-btn').on('click', function() {
        if (!currentSchedule) return;

        const scheduleId = currentSchedule.id;
        const currentAttendanceList = attendanceData[scheduleId];
        let changesMade = false;
        const validationUpdates = [];

        if (currentAttendanceList) {
            
            $('.validation-status').each(function() {
                const $selectElement = $(this); 
                const nim = $selectElement.data('nim'); 
                const newStatus = $selectElement.val(); 
                
                const student = currentAttendanceList.find(s => s.nim === nim);

                if (student) {
                    const previouslySavedStatus = student.status_validasi;
                    const statusDosen = student.status_dosen;
                    
                    const finalStatusCurrently = previouslySavedStatus !== null ? previouslySavedStatus : statusDosen;
                    
                    if (newStatus !== finalStatusCurrently || (previouslySavedStatus === null && newStatus === statusDosen)) {
                        
                        // *** PERUBAHAN KRITIS: Menggunakan 'status' (bukan 'status_validasi') untuk Controller Laravel
                        validationUpdates.push({ nim: nim, status: newStatus }); 
                        changesMade = true;

                        // Perbarui data MOCKUP di client side (Simulasi DB)
                        student.status_validasi = newStatus;
                    }
                }
            });
            
            if (changesMade) {
                
                // Matikan tombol Simpan selama proses AJAX
                const $saveBtn = $(this).prop('disabled', true).find('span').text('Menyimpan...');

                // --- PANGGILAN AJAX SEBENARNYA KE LARAVEL CONTROLLER ---
                $.ajax({
                    // Asumsi Route Anda menggunakan URL yang konsisten dengan nama fungsi
                    // Misalnya: Route::post('/akademik/validasi-absensi', [AbsensiController::class, 'storeValidasiAbsensi']);
                    url: '/akademik/validasi-absensi', 
                    method: 'POST',
                    data: { 
                        _token: CSRF_TOKEN, // Pastikan CSRF Token ada
                        schedule_id: scheduleId,
                        // *** PERUBAHAN KRITIS: Menggunakan nama key 'validation_data'
                        validation_data: validationUpdates 
                    },
                    success: function(response) {
                        alert(`SUCCESS: ${response.message}`);
                        // PENTING: Panggil ulang fungsi rendering detail untuk memuat data MOCKUP yang baru
                        loadValidationDetail(scheduleId); 
                    },
                    error: function(xhr) {
                        let errorMessage = 'Gagal menyimpan validasi. Silakan periksa koneksi atau log server.';
                        if (xhr.responseJSON && xhr.responseJSON.message) {
                            errorMessage = 'ERROR: ' + xhr.responseJSON.message;
                        }
                        alert(errorMessage);
                        
                        // Jika GAGAL, kita harus me-reset data MOCKUP (yang sudah terlanjur diubah di frontend)
                        // agar konsisten dengan apa yang seharusnya gagal disimpan di server.
                        // Namun, karena ini hanya MOCKUP, kita akan membiarkan perubahan MOCKUP agar user bisa melihat 
                        // hasil simulasinya, atau Anda dapat memilih untuk me-load ulang halaman untuk me-reset.
                        // Untuk saat ini, kita biarkan saja (karena user mungkin ingin coba simpan lagi).
                    },
                    complete: function() {
                        $saveBtn.prop('disabled', false).find('span').text('Simpan Validasi');
                    }
                });

            } else {
                alert(`Tidak ada perubahan status yang terdeteksi.`);
            }

        } else {
            alert("Gagal menemukan data absensi untuk diperbarui.");
        }
    });

    // --- HANDLER BATAL VALIDASI ---
    $('#cancel-validation-btn').on('click', function() {
        if (confirm("Anda yakin ingin membatalkan validasi?")) {
            $('#validation-detail').addClass('hidden');
            currentSchedule = null;
            // Catatan: Karena kita langsung update MOCKUP, 'Batal' tidak me-reset MOCKUP
        }
    });

    // --- EVENT LISTENERS JQUERY (Delegated Events) ---
    $('#schedule-table-body').on('click', '.btn-load-validation', function() {
        const scheduleId = $(this).data('schedule-id');
        loadValidationDetail(scheduleId);
    });
    
    $('#filter-container select, #search-input').on('change keyup', function() {
        $('#validation-detail').addClass('hidden');
        currentSchedule = null;
        renderScheduleTable();
    });

    // Initial load
    renderScheduleTable();
    lucide.createIcons();
});
</script>
@endpush