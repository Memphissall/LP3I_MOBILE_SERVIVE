{{-- resources/views/akademik/data_jadwal.blade.php --}}

@extends('layouts.app') 

@section('title', 'Kelola Jadwal Kuliah')

@section('content')

<div class="min-h-screen bg-gray-50 p-4 md:p-8 font-sans">
    <h1 class="text-3xl font-extrabold text-gray-800 mb-6 border-b pb-2">
        Kelola Jadwal Kuliah
    </h1>

    {{-- --- BAGIAN FILTER DAN TOMBOL TAMBAH --- --}}
    <div class="bg-white p-6 rounded-xl shadow-lg mb-6">
        <h2 class="text-lg font-semibold text-gray-700 mb-4">Pencarian dan Filter Jadwal</h2>
        
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
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="4">4</option>
                    <option value="5">5</option>
                    <option value="6">6</option>
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
                <input type="text" id="search-input" placeholder="Masukkan Nama MK atau Nama Dosen..." 
                        class="p-2 border border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500 transition duration-150">
            </div>
        </div>
        
        <div class="mt-6 flex justify-end">
            <button id="add-schedule-btn"
                class="flex items-center space-x-2 px-4 py-2 bg-green-600 text-white font-semibold rounded-lg shadow-md hover:bg-green-700 transition duration-150 transform hover:scale-[1.02] active:scale-100"
            >
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="12" y1="5" x2="12" y2="19"></line><line x1="5" y1="12" x2="19" y2="12"></line></svg>
                <span>Tambah Jadwal Baru</span>
            </button>
        </div>
    </div>

    {{-- --- BAGIAN TABEL DATA JADWAL --- --}}
    <div class="bg-white p-6 rounded-xl shadow-lg">
        <h2 class="text-lg font-semibold text-gray-700 mb-4">Daftar Jadwal Kuliah (<span id="schedule-count">0</span> data)</h2>
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Mata Kuliah</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Dosen Pengampu</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Jurusan/Sem.</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Hari & Jam</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Ruangan</th>
                        <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200" id="schedule-table-body">
                    {{-- Data akan diisi oleh JavaScript --}}
                </tbody>
            </table>
            <div id="no-data-message" class="text-center py-10 text-gray-500 hidden">
                <p>Tidak ada data jadwal kuliah yang sesuai dengan filter saat ini.</p>
                <p class="mt-2 text-sm">Coba ubah filter atau tambahkan jadwal baru.</p>
            </div>
        </div>
    </div>
</div>

@endsection

{{-- 🚀 Blok script JQuery yang akan di-push ke @stack('scripts') di layouts/app.blade.php --}}
@push('scripts')
<script>
$(document).ready(function() {
    // --- DATA MOCKUP ---
    let schedules = [
        { id: 1, mata_kuliah: 'Algoritma & Pemrograman', dosen: 'Prof. Dr. Andi Putra', jurusan: 'Teknik Informatika', semester: 1, hari: 'Senin', jam_mulai: '08:00', jam_selesai: '10:30', ruangan: 'Lab Komp A' },
        { id: 2, mata_kuliah: 'Basis Data', dosen: 'Bpk. Budi Santoso, M.Kom.', jurusan: 'Sistem Informasi', semester: 3, hari: 'Selasa', jam_mulai: '13:00', jam_selesai: '15:30', ruangan: 'Ruang B201' },
        { id: 3, mata_kuliah: 'Akuntansi Keuangan I', dosen: 'Ibu Citra Dewi, SE., M.Ak.', jurusan: 'Akuntansi', semester: 2, hari: 'Rabu', jam_mulai: '10:00', jam_selesai: '12:30', ruangan: 'Auditorium' },
        { id: 4, mata_kuliah: 'Pemrograman Web', dosen: 'Prof. Dr. Andi Putra', jurusan: 'Teknik Informatika', semester: 5, hari: 'Jumat', jam_mulai: '08:00', jam_selesai: '10:30', ruangan: 'Lab Komp B' },
    ];

    // --- FUNGSI RENDERING ---
    function renderTable() {
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
            
            // Pencarian cepat pada Mata Kuliah atau Dosen
            const matchSearch = filters.search === '' || 
                                schedule.mata_kuliah.toLowerCase().includes(filters.search) ||
                                schedule.dosen.toLowerCase().includes(filters.search);

            return matchJurusan && matchSemester && matchHari && matchSearch;
        });

        const $tbody = $('#schedule-table-body');
        $tbody.empty();

        if (filteredSchedules.length === 0) {
            $('#no-data-message').show();
            $tbody.closest('table').addClass('hidden'); 
        } else {
            $('#no-data-message').hide();
            $tbody.closest('table').removeClass('hidden'); // Tampilkan tabel
            
            filteredSchedules.forEach(schedule => {
                const row = `
                    <tr data-id="${schedule.id}" class="hover:bg-gray-50 transition duration-100">
                        <td class="px-6 py-4 text-sm font-medium text-gray-900">${schedule.mata_kuliah}</td>
                        <td class="px-6 py-4 text-sm text-gray-700">${schedule.dosen}</td>
                        <td class="px-6 py-4 text-sm text-gray-700">${schedule.jurusan} (Sem. ${schedule.semester})</td>
                        <td class="px-6 py-4 text-sm text-gray-700">${schedule.hari}, ${schedule.jam_mulai} - ${schedule.jam_selesai}</td>
                        <td class="px-6 py-4 text-sm text-gray-700">${schedule.ruangan}</td>
                        <td class="px-6 py-4 text-sm font-medium flex justify-center space-x-2">
                            <button onclick="window.handleEditClick(${schedule.id})"
                                class="text-blue-600 hover:text-blue-900 bg-blue-100 p-2 rounded-full transition duration-150 hover:shadow-md"
                                title="Edit Jadwal">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M17 3a2.85 2.85 0 0 1 4 4L7.5 20.5 2 22l1.5-5.5L17 3z"></path></svg>
                            </button>
                            <button onclick="window.handleDeleteClick(${schedule.id})"
                                class="text-red-600 hover:text-red-900 bg-red-100 p-2 rounded-full transition duration-150 hover:shadow-md"
                                title="Hapus Jadwal">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M3 6h18"></path><path d="M19 6v14c0 1-1 2-2 2H7c-1 0-2-1-2-2V6"></path><path d="M8 6V4c0-1 1-2 2-2h4c1 0 2 1 2 2v2"></path><line x1="10" y1="11" x2="10" y2="17"></line><line x1="14" y1="11" x2="14" y2="17"></line></svg>
                            </button>
                        </td>
                    </tr>
                `;
                $tbody.append(row);
            });
        }
        
        // Update hitungan data
        $('#schedule-count').text(filteredSchedules.length);
    }

    // --- HANDLER TAMBAH/EDIT MENGGUNAKAN PROMPT ---
    function promptScheduleData(schedule = null) {
        let title = schedule ? `Edit Jadwal (${schedule.mata_kuliah})` : "Tambah Jadwal Baru";
        
        let mata_kuliah = prompt(`Nama Mata Kuliah (${title}):`, schedule ? schedule.mata_kuliah : "Struktur Data");
        if (!mata_kuliah) return;

        let dosen = prompt(`Dosen Pengampu (${title}):`, schedule ? schedule.dosen : "Ibu Maya Sari, M.T.");
        if (!dosen) return;
        
        let jurusan = prompt(`Jurusan (${title}):`, schedule ? schedule.jurusan : "Teknik Informatika");
        let semester = prompt(`Semester (${title}):`, schedule ? schedule.semester : "3");
        let hari = prompt(`Hari (${title}):`, schedule ? schedule.hari : "Kamis");
        let jam_mulai = prompt(`Jam Mulai (Format HH:MM, ${title}):`, schedule ? schedule.jam_mulai : "15:30");
        let jam_selesai = prompt(`Jam Selesai (Format HH:MM, ${title}):`, schedule ? schedule.jam_selesai : "18:00");
        let ruangan = prompt(`Ruangan (${title}):`, schedule ? schedule.ruangan : "Ruang C305");


        if (mata_kuliah && dosen && jurusan && semester && hari && jam_mulai && jam_selesai && ruangan) {
            const newSchedule = {
                mata_kuliah: mata_kuliah,
                dosen: dosen,
                jurusan: jurusan,
                semester: parseInt(semester),
                hari: hari,
                jam_mulai: jam_mulai,
                jam_selesai: jam_selesai,
                ruangan: ruangan
            };

            if (schedule) {
                // UPDATE
                schedules = schedules.map(s => s.id === schedule.id ? { ...s, ...newSchedule } : s);
                alert(`Jadwal Mata Kuliah ${mata_kuliah} berhasil diperbarui!`);
            } else {
                // ADD
                const newId = schedules.length > 0 ? Math.max(...schedules.map(s => s.id)) + 1 : 1;
                schedules.push({ id: newId, ...newSchedule });
                alert(`Jadwal Mata Kuliah ${mata_kuliah} berhasil ditambahkan!`);
            }
            renderTable();
        } else {
            alert("Semua data jadwal wajib diisi.");
        }
    }

    // --- GLOBAL HANDLERS UNTUK BUTTON TABLE (Dipanggil via onclick) ---
    window.handleEditClick = function(id) {
        const schedule = schedules.find(s => s.id === id);
        if (schedule) {
            promptScheduleData(schedule);
        }
    }

    window.handleDeleteClick = function(id) {
        const schedule = schedules.find(s => s.id === id);
        if (schedule && confirm(`Anda yakin ingin menghapus jadwal "${schedule.mata_kuliah}" pada hari ${schedule.hari}? Aksi ini tidak dapat dibatalkan.`)) {
            schedules = schedules.filter(s => s.id !== id);
            alert(`Jadwal Mata Kuliah ${schedule.mata_kuliah} berhasil dihapus.`);
            renderTable();
        }
    }
    
    // --- EVENT LISTENERS JQUERY ---
    
    // Tombol Tambah
    $('#add-schedule-btn').on('click', function() {
        promptScheduleData(null);
    });

    // Filter dan Pencarian
    $('#filter-container select, #search-input').on('change keyup', renderTable);

    // Initial load
    renderTable();
});
</script>
@endpush