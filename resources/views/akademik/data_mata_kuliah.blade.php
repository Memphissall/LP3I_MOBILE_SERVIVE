{{-- resources/views/akademik/data_mata_kuliah.blade.php --}}

@extends('layouts.app') 

@section('content')

<div class="min-h-screen bg-gray-50 p-4 md:p-8 font-sans">
    <h1 class="text-3xl font-extrabold text-gray-800 mb-6 border-b pb-2">
        Kelola Data Mata Kuliah
    </h1>

    {{-- --- BAGIAN FILTER DAN TOMBOL TAMBAH --- --}}
    <div class="bg-white p-6 rounded-xl shadow-lg mb-6">
        <h2 class="text-lg font-semibold text-gray-700 mb-4">Pencarian dan Filter</h2>
        
        <div class="grid grid-cols-2 md:grid-cols-4 gap-4" id="filter-container">
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
                    <option value="1">1 (Satu)</option>
                    <option value="2">2 (Dua)</option>
                    <option value="3">3 (Tiga)</option>
                    <option value="4">4 (Empat)</option>
                    <option value="5">5 (Lima)</option>
                    <option value="6">6 (Enam)</option>
                </select>
            </div>

            {{-- Kolom Pencarian Cepat --}}
            <div class="flex flex-col space-y-1 col-span-2 md:col-span-2">
                <label for="search-input" class="text-sm font-medium text-gray-700">Cari Cepat (Kode/Nama)</label>
                <input type="text" id="search-input" placeholder="Masukkan Kode atau Nama Mata Kuliah..." 
                       class="p-2 border border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500 transition duration-150">
            </div>
        </div>
        
        <div class="mt-6 flex justify-end">
            <button id="add-course-btn"
                class="flex items-center space-x-2 px-4 py-2 bg-green-600 text-white font-semibold rounded-lg shadow-md hover:bg-green-700 transition duration-150 transform hover:scale-[1.02] active:scale-100"
            >
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="12" y1="5" x2="12" y2="19"></line><line x1="5" y1="12" x2="19" y2="12"></line></svg>
                <span>Tambah Mata Kuliah</span>
            </button>
        </div>
    </div>

    {{-- --- BAGIAN TABEL DATA MATA KULIAH --- --}}
    <div class="bg-white p-6 rounded-xl shadow-lg">
        <h2 class="text-lg font-semibold text-gray-700 mb-4">Daftar Mata Kuliah (<span id="course-count">0</span> data)</h2>
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Kode MK</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama Mata Kuliah</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Jurusan</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">SKS</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Semester</th>
                        <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200" id="course-table-body">
                    {{-- Data akan diisi oleh JavaScript --}}
                </tbody>
            </table>
            <div id="no-data-message" class="text-center py-10 text-gray-500 hidden">
                <p>Tidak ada data mata kuliah yang sesuai dengan filter saat ini.</p>
                <p class="mt-2 text-sm">Coba ubah filter atau tambahkan data mata kuliah baru.</p>
            </div>
        </div>
    </div>
</div>

@endsection

{{-- 🚀 WAJIB: Blok script JQuery yang akan di-push ke @stack('scripts') di layouts/app.blade.php --}}
@push('scripts')
<script>
$(document).ready(function() {
    // --- DATA MOCKUP ---
    let courses = [
        { id: 101, kode: 'IF401', nama: 'Algoritma & Pemrograman', jurusan: 'Teknik Informatika', sks: 3, semester: 1 },
        { id: 102, kode: 'SI302', nama: 'Basis Data', jurusan: 'Sistem Informasi', sks: 3, semester: 3 },
        { id: 103, kode: 'AK205', nama: 'Akuntansi Keuangan I', jurusan: 'Akuntansi', sks: 4, semester: 2 },
        { id: 104, kode: 'IF404', nama: 'Struktur Data', jurusan: 'Teknik Informatika', sks: 3, semester: 3 },
        { id: 105, kode: 'SI305', nama: 'Jaringan Komputer', jurusan: 'Sistem Informasi', sks: 2, semester: 4 },
        { id: 106, kode: 'IF406', nama: 'Pemrograman Web', jurusan: 'Teknik Informatika', sks: 4, semester: 5 },
    ];

    // --- FUNGSI RENDERING ---
    function renderTable() {
        const filters = {
            jurusan: $('#filter-jurusan').val(),
            semester: $('#filter-semester').val(),
            search: $('#search-input').val().toLowerCase(),
        };

        const filteredCourses = courses.filter(course => {
            const matchJurusan = filters.jurusan === 'Semua Jurusan' || course.jurusan === filters.jurusan;
            // Konversi filter semester ke integer untuk perbandingan
            const matchSemester = filters.semester === 'Semua Semester' || course.semester === parseInt(filters.semester);
            
            // Pencarian cepat
            const matchSearch = filters.search === '' || 
                                course.kode.toLowerCase().includes(filters.search) ||
                                course.nama.toLowerCase().includes(filters.search);

            return matchJurusan && matchSemester && matchSearch;
        });

        const $tbody = $('#course-table-body');
        $tbody.empty();

        if (filteredCourses.length === 0) {
            $('#no-data-message').show();
            $tbody.closest('table').addClass('hidden'); 
        } else {
            $('#no-data-message').hide();
            $tbody.closest('table').removeClass('hidden'); // Tampilkan tabel
            
            filteredCourses.forEach(course => {
                const row = `
                    <tr data-id="${course.id}" class="hover:bg-gray-50 transition duration-100">
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">${course.kode}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">${course.nama}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">${course.jurusan}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">${course.sks}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">${course.semester}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium flex justify-center space-x-2">
                            <button onclick="window.handleEditClick(${course.id})"
                                class="text-blue-600 hover:text-blue-900 bg-blue-100 p-2 rounded-full transition duration-150 hover:shadow-md"
                                title="Edit Data">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M17 3a2.85 2.85 0 0 1 4 4L7.5 20.5 2 22l1.5-5.5L17 3z"></path></svg>
                            </button>
                            <button onclick="window.handleDeleteClick(${course.id})"
                                class="text-red-600 hover:text-red-900 bg-red-100 p-2 rounded-full transition duration-150 hover:shadow-md"
                                title="Hapus Data">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M3 6h18"></path><path d="M19 6v14c0 1-1 2-2 2H7c-1 0-2-1-2-2V6"></path><path d="M8 6V4c0-1 1-2 2-2h4c1 0 2 1 2 2v2"></path><line x1="10" y1="11" x2="10" y2="17"></line><line x1="14" y1="11" x2="14" y2="17"></line></svg>
                            </button>
                        </td>
                    </tr>
                `;
                $tbody.append(row);
            });
        }
        
        // Update hitungan data
        $('#course-count').text(filteredCourses.length);
    }

    // --- HANDLER TAMBAH/EDIT MENGGUNAKAN PROMPT ---
    function promptCourseData(course = null) {
        let title = course ? `Edit Mata Kuliah (${course.nama})` : "Tambah Mata Kuliah Baru";
        
        let kode = prompt(`Kode Mata Kuliah (${title}):`, course ? course.kode : "");
        if (!kode) return;

        let nama = prompt(`Nama Mata Kuliah (${title}):`, course ? course.nama : "");
        if (!nama) return;
        
        let jurusan = prompt(`Jurusan (${title}):`, course ? course.jurusan : "Teknik Informatika");
        let sks = prompt(`Jumlah SKS (${title}):`, course ? course.sks : "3");
        let semester = prompt(`Semester (${title}):`, course ? course.semester : "1");

        if (kode && nama && sks && semester) {
            const newCourse = {
                kode: kode.toUpperCase(), // Pastikan kode huruf besar
                nama: nama,
                jurusan: jurusan,
                sks: parseInt(sks),
                semester: parseInt(semester),
            };

            if (course) {
                // UPDATE
                courses = courses.map(c => c.id === course.id ? { ...c, ...newCourse } : c);
                alert(`Data Mata Kuliah ${nama} berhasil diperbarui!`);
            } else {
                // ADD
                const newId = courses.length > 0 ? Math.max(...courses.map(c => c.id)) + 1 : 100;
                courses.push({ id: newId, ...newCourse });
                alert(`Mata Kuliah ${nama} berhasil ditambahkan!`);
            }
            renderTable();
        } else {
            alert("Kode, Nama, SKS, dan Semester wajib diisi.");
        }
    }

    // --- GLOBAL HANDLERS UNTUK BUTTON TABLE (Dipanggil via onclick) ---
    window.handleEditClick = function(id) {
        const course = courses.find(c => c.id === id);
        if (course) {
            promptCourseData(course);
        }
    }

    window.handleDeleteClick = function(id) {
        const course = courses.find(c => c.id === id);
        if (course && confirm(`Anda yakin ingin menghapus data mata kuliah "${course.nama}" (Kode: ${course.kode})? Aksi ini tidak dapat dibatalkan.`)) {
            courses = courses.filter(c => c.id !== id);
            alert(`Data Mata Kuliah ${course.nama} berhasil dihapus.`);
            renderTable();
        }
    }
    
    // --- EVENT LISTENERS JQUERY ---
    
    // Tombol Tambah
    $('#add-course-btn').on('click', function() {
        promptCourseData(null);
    });

    // Filter dan Pencarian
    $('#filter-container select, #search-input').on('change keyup', renderTable);

    // Initial load
    renderTable();
});
</script>
@endpush