{{-- resources/views/akademik/data_mahasiswa.blade.php --}}

@extends('layouts.app') 

@section('content')

<div class="min-h-screen bg-gray-50 p-4 md:p-8 font-sans">
    <h1 class="text-3xl font-extrabold text-gray-800 mb-6 border-b pb-2">
        Kelola Data Mahasiswa
    </h1>

    {{-- --- BAGIAN FILTER DAN TOMBOL TAMBAH --- --}}
    <div class="bg-white p-6 rounded-xl shadow-lg mb-6">
        <h2 class="text-lg font-semibold text-gray-700 mb-4">Pencarian Data</h2>
        
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
            
            {{-- Dropdown Tahun Masuk --}}
            <div class="flex flex-col space-y-1">
                <label for="filter-tahun" class="text-sm font-medium text-gray-700">Tahun Masuk</label>
                <select id="filter-tahun" class="p-2 border border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500 transition duration-150">
                    <option value="Semua Tahun">Semua Tahun</option>
                    <option value="2023">2023</option>
                    <option value="2022">2022</option>
                    <option value="2021">2021</option>
                </select>
            </div>
            
            {{-- Dropdown Periode --}}
            <div class="flex flex-col space-y-1">
                <label for="filter-periode" class="text-sm font-medium text-gray-700">Periode</label>
                <select id="filter-periode" class="p-2 border border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500 transition duration-150">
                    <option value="Semua Periode">Semua Periode</option>
                    <option value="Ganjil">Ganjil</option>
                    <option value="Genap">Genap</option>
                </select>
            </div>

            {{-- Dropdown Kelas --}}
            <div class="flex flex-col space-y-1">
                <label for="filter-kelas" class="text-sm font-medium text-gray-700">Kelas</label>
                <select id="filter-kelas" class="p-2 border border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500 transition duration-150">
                    <option value="Semua Kelas">Semua Kelas</option>
                    <option value="A">A</option>
                    <option value="B">B</option>
                    <option value="C">C</option>
                </select>
            </div>
        </div>
        
        <div class="mt-6 flex justify-end">
            <button id="add-student-btn"
                class="flex items-center space-x-2 px-4 py-2 bg-green-600 text-white font-semibold rounded-lg shadow-md hover:bg-green-700 transition duration-150 transform hover:scale-[1.02] active:scale-100"
            >
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="12" y1="5" x2="12" y2="19"></line><line x1="5" y1="12" x2="19" y2="12"></line></svg>
                <span>Tambah Mahasiswa</span>
            </button>
        </div>
    </div>

    {{-- --- BAGIAN TABEL DATA MAHASISWA --- --}}
    <div class="bg-white p-6 rounded-xl shadow-lg">
        <h2 class="text-lg font-semibold text-gray-700 mb-4">Daftar Mahasiswa (<span id="student-count">0</span> data)</h2>
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">NIM</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Jurusan</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Thn Masuk</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Periode</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Kelas</th>
                        <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200" id="student-table-body">
                    {{-- Data akan diisi oleh JavaScript --}}
                </tbody>
            </table>
            <div id="no-data-message" class="text-center py-10 text-gray-500 hidden">
                <p>Tidak ada data mahasiswa yang sesuai dengan filter saat ini.</p>
                <p class="mt-2 text-sm">Coba ubah filter atau tambahkan data mahasiswa baru.</p>
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
    let students = [
        { id: 1, nim: '1901001', nama: 'Budi Santoso', jurusan: 'Teknik Informatika', tahun: 2021, periode: 'Ganjil', kelas: 'A' },
        { id: 2, nim: '2002002', nama: 'Siti Rahayu', jurusan: 'Sistem Informasi', tahun: 2022, periode: 'Genap', kelas: 'B' },
        { id: 3, nim: '2103003', nama: 'Joko Prabowo', jurusan: 'Teknik Informatika', tahun: 2023, periode: 'Ganjil', kelas: 'C' },
        { id: 4, nim: '2204004', nama: 'Dewi Lestari', jurusan: 'Akuntansi', tahun: 2022, periode: 'Ganjil', kelas: 'A' },
        { id: 5, nim: '2305005', nama: 'Fajar Nugraha', jurusan: 'Sistem Informasi', tahun: 2023, periode: 'Genap', kelas: 'B' },
    ];

    // --- FUNGSI RENDERING ---
    function renderTable() {
        const filters = {
            jurusan: $('#filter-jurusan').val(),
            tahun: $('#filter-tahun').val(),
            periode: $('#filter-periode').val(),
            kelas: $('#filter-kelas').val(),
        };

        const filteredStudents = students.filter(student => {
            const matchJurusan = filters.jurusan === 'Semua Jurusan' || student.jurusan === filters.jurusan;
            // Konversi filter tahun ke integer untuk perbandingan
            const matchTahun = filters.tahun === 'Semua Tahun' || student.tahun === parseInt(filters.tahun);
            const matchPeriode = filters.periode === 'Semua Periode' || student.periode === filters.periode;
            const matchKelas = filters.kelas === 'Semua Kelas' || student.kelas === filters.kelas;
            return matchJurusan && matchTahun && matchPeriode && matchKelas;
        });

        const $tbody = $('#student-table-body');
        $tbody.empty();

        if (filteredStudents.length === 0) {
            $('#no-data-message').show();
            // Optional: Sembunyikan tabel kosong jika perlu
            $tbody.closest('table').addClass('hidden'); 
        } else {
            $('#no-data-message').hide();
            $tbody.closest('table').removeClass('hidden'); // Tampilkan tabel
            
            filteredStudents.forEach(student => {
                const row = `
                    <tr data-id="${student.id}" class="hover:bg-gray-50 transition duration-100">
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">${student.nim}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">${student.nama}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">${student.jurusan}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">${student.tahun}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">${student.periode}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">${student.kelas}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium flex justify-center space-x-2">
                            <button onclick="window.handleEditClick(${student.id})"
                                class="text-blue-600 hover:text-blue-900 bg-blue-100 p-2 rounded-full transition duration-150 hover:shadow-md"
                                title="Edit Data">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M17 3a2.85 2.85 0 0 1 4 4L7.5 20.5 2 22l1.5-5.5L17 3z"></path></svg>
                            </button>
                            <button onclick="window.handleDeleteClick(${student.id})"
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
        $('#student-count').text(filteredStudents.length);
    }

    // --- HANDLER TAMBAH/EDIT MENGGUNAKAN PROMPT ---
    // Diubah agar fungsi ini lokal dan dipanggil melalui listener.
    function promptStudentData(student = null) {
        let title = student ? `Edit Data Mahasiswa (${student.nama})` : "Tambah Data Mahasiswa Baru";
        
        // Mengganti fungsionalitas modal React dengan prompt/confirm sederhana
        let nim = prompt(`NIM (${title}):`, student ? student.nim : "");
        if (!nim) return; // Batal jika NIM kosong

        let nama = prompt(`Nama Lengkap (${title}):`, student ? student.nama : "");
        if (!nama) return; // Batal jika Nama kosong
        
        // Untuk Jurusan/Tahun/Periode/Kelas, kita gunakan nilai default yang lebih terstruktur.
        let jurusan = prompt(`Jurusan (${title}):`, student ? student.jurusan : "Teknik Informatika");
        let tahun = prompt(`Tahun Masuk (${title}):`, student ? student.tahun : "2023");
        let periode = prompt(`Periode (${title}):`, student ? student.periode : "Ganjil");
        let kelas = prompt(`Kelas (${title}):`, student ? student.kelas : "A");

        if (nim && nama) {
            const newStudent = {
                nim: nim,
                nama: nama,
                jurusan: jurusan,
                tahun: parseInt(tahun),
                periode: periode,
                kelas: kelas,
            };

            if (student) {
                // UPDATE
                students = students.map(s => s.id === student.id ? { ...s, ...newStudent } : s);
                alert(`Data Mahasiswa ${nama} berhasil diperbarui!`);
            } else {
                // ADD
                const newId = students.length > 0 ? Math.max(...students.map(s => s.id)) + 1 : 1;
                students.push({ id: newId, ...newStudent });
                alert(`Mahasiswa ${nama} berhasil ditambahkan!`);
            }
            renderTable();
        } else {
            alert("NIM dan Nama Lengkap wajib diisi.");
        }
    }

    // --- GLOBAL HANDLERS UNTUK BUTTON TABLE (Dipanggil via onclick) ---
    // Dipasang di window agar bisa dipanggil langsung dari atribut `onclick` di HTML
    window.handleEditClick = function(id) {
        const student = students.find(s => s.id === id);
        if (student) {
            promptStudentData(student);
        }
    }

    window.handleDeleteClick = function(id) {
        const student = students.find(s => s.id === id);
        if (student && confirm(`Anda yakin ingin menghapus data mahasiswa bernama "${student.nama}" (NIM: ${student.nim})? Aksi ini tidak dapat dibatalkan.`)) {
            students = students.filter(s => s.id !== id);
            alert(`Data Mahasiswa ${student.nama} berhasil dihapus.`);
            renderTable();
        }
    }
    
    // --- EVENT LISTENERS JQUERY ---
    
    // Tombol Tambah
    $('#add-student-btn').on('click', function() {
        promptStudentData(null);
    });

    // Filter
    $('#filter-container select').on('change', renderTable);

    // Initial load
    renderTable();
});
</script>
@endpush