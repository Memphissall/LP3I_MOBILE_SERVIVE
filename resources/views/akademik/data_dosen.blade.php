{{-- resources/views/akademik/data_dosen.blade.php --}}

@extends('layouts.app') 

@section('content')

<div class="min-h-screen bg-gray-50 p-4 md:p-8 font-sans">
    <div class="flex items-center space-x-4 text-gray-800 border-b border-gray-200 pb-4 mb-6">
        <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-blue-600"><path d="M4 19.5A2.5 2.5 0 0 1 6.5 17H20"></path><path d="M6.5 2H20v20h-1.5"></path><path d="M14 6H9.5a2.5 2.5 0 0 0 0 5H17"></path><path d="M14 10H9.5a2.5 2.5 0 0 0 0 5H17"></path></svg>
        <h1 class="text-3xl font-extrabold tracking-tight">
            Sistem Manajemen Data Dosen
        </h1>
    </div>

    {{-- --- BAGIAN FILTER (Sesuai skema Dosen) --- --}}
    <div class="bg-white p-6 rounded-xl shadow-lg mb-6 border border-gray-100">
        <h2 class="text-lg font-semibold text-gray-700 mb-4">Filter Data</h2>
        
        <div class="grid grid-cols-2 md:grid-cols-4 gap-4" id="filter-container">
            {{-- Dropdown Status --}}
            <div class="flex flex-col space-y-1">
                <label for="filter-status" class="text-sm font-medium text-gray-700">Status</label>
                <select id="filter-status" class="p-2 border border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500 transition duration-150">
                    <option value="Semua Status">Semua Status</option>
                    <option value="Aktif">Aktif</option>
                    <option value="Cuti">Cuti</option>
                    <option value="Non-Aktif">Non-Aktif</option>
                    <option value="Tugas Belajar">Tugas Belajar</option>
                </select>
            </div>
            
            {{-- Dropdown Pendidikan --}}
            <div class="flex flex-col space-y-1">
                <label for="filter-pendidikan" class="text-sm font-medium text-gray-700">Pendidikan</label>
                <select id="filter-pendidikan" class="p-2 border border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500 transition duration-150">
                    <option value="Semua Pendidikan">Semua Pendidikan</option>
                    <option value="S1">S1</option>
                    <option value="S2">S2</option>
                    <option value="S3">S3</option>
                </select>
            </div>

        </div>
    </div>

    {{-- --- BAGIAN TABEL DATA DOSEN --- --}}
    <div class="bg-white p-4 md:p-6 rounded-xl shadow-lg border border-gray-100">
        <h2 class="text-xl font-semibold text-gray-700 mb-4">Daftar Dosen (<span id="lecturer-count">0</span> data)</h2>
        <div class="overflow-x-auto rounded-lg border border-gray-200">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-bold text-gray-600 uppercase tracking-wider w-[150px]">NIDN</th>
                        <th class="px-6 py-3 text-left text-xs font-bold text-gray-600 uppercase tracking-wider min-w-[250px]">Nama Dosen</th>
                        <th class="px-6 py-3 text-left text-xs font-bold text-gray-600 uppercase tracking-wider">Pendidikan</th>
                        <th class="px-6 py-3 text-left text-xs font-bold text-gray-600 uppercase tracking-wider min-w-[200px]">Bidang Keahlian</th>
                        <th class="px-6 py-3 text-center text-xs font-bold text-gray-600 uppercase tracking-wider w-[120px]">Status</th>
                        <th class="px-6 py-3 text-center text-xs font-bold text-gray-600 uppercase tracking-wider w-[100px]">Aksi</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200" id="lecturer-table-body">
                    {{-- Data akan diisi oleh JavaScript --}}
                </tbody>
            </table>
            <div id="no-data-message" class="text-center py-10 text-gray-500 bg-gray-50 hidden">
                <p>Tidak ada data dosen yang sesuai dengan filter saat ini.</p>
            </div>
        </div>
    </div>
</div>

@endsection

{{-- JQuery Script untuk Data Dosen --}}
@push('scripts')
<script>
$(document).ready(function() {
    // --- DATA MOCKUP DOSEN (Diambil dari LecturerController lama Anda) ---
    let lecturers = [
        { id: 1, nidn: '0011058201', nama: 'Dr. Ahmad Fauzi, M.Kom.', pendidikan_terakhir: 'S3', bidang: 'Jaringan Komputer', status: 'Aktif' },
        { id: 2, nidn: '0502107502', nama: 'Prof. Bintang Timur, S.T., M.Eng.', pendidikan_terakhir: 'S2', bidang: 'AI & Data Science', status: 'Tugas Belajar' },
        { id: 3, nidn: '1504907901', nama: 'Citra Dewi, S.E., M.M.', pendidikan_terakhir: 'S2', bidang: 'Akuntansi Syariah', status: 'Aktif' },
        { id: 4, nidn: '0812038801', nama: 'Doni Pratama, S.Kom.', pendidikan_terakhir: 'S1', bidang: 'Web Development', status: 'Cuti' },
        { id: 5, nidn: '0101018501', nama: 'Erlina Sari, M.Pd.', pendidikan_terakhir: 'S2', bidang: 'Bahasa Inggris', status: 'Non-Aktif' },
    ];

    // --- FUNGSI HELPER (Status Badge) ---
    function getStatusBadge(status) {
        let colorClass = 'bg-gray-100 text-gray-800';
        if (status === 'Aktif') colorClass = 'bg-green-100 text-green-800';
        else if (status === 'Cuti') colorClass = 'bg-yellow-100 text-yellow-800';
        else if (status === 'Tugas Belajar') colorClass = 'bg-blue-100 text-blue-800';
        else if (status === 'Non-Aktif') colorClass = 'bg-red-100 text-red-800';

        return `<span class="inline-flex items-center px-3 py-1 text-xs font-semibold rounded-full ${colorClass}">${status}</span>`;
    }

    // --- FUNGSI RENDERING TABEL ---
    function renderTable() {
        const filters = {
            status: $('#filter-status').val(),
            pendidikan: $('#filter-pendidikan').val(),
        };

        const filteredLecturers = lecturers.filter(lecturer => {
            const matchStatus = filters.status === 'Semua Status' || lecturer.status === filters.status;
            const matchPendidikan = filters.pendidikan === 'Semua Pendidikan' || lecturer.pendidikan_terakhir === filters.pendidikan;
            return matchStatus && matchPendidikan;
        });

        const $tbody = $('#lecturer-table-body');
        $tbody.empty();

        if (filteredLecturers.length === 0) {
            $('#no-data-message').show();
            $tbody.closest('table').addClass('hidden'); 
        } else {
            $('#no-data-message').hide();
            $tbody.closest('table').removeClass('hidden');
            
            filteredLecturers.forEach(lecturer => {
                const row = `
                    <tr data-id="${lecturer.id}" class="hover:bg-blue-50/50 transition duration-100">
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">${lecturer.nidn}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">${lecturer.nama}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">${lecturer.pendidikan_terakhir}</td>
                        <td class="px-6 py-4 text-sm text-gray-700 max-w-xs truncate" title="${lecturer.bidang}">${lecturer.bidang}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-center">
                            ${getStatusBadge(lecturer.status)}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium flex justify-center space-x-2">
                            {{-- BUTTON EDIT: Menggunakan title untuk tooltip --}}
                            <button onclick="window.handleEditClick(${lecturer.id})"
                                class="text-blue-600 hover:text-white bg-blue-100 p-2 rounded-full transition duration-150 hover:bg-blue-600 hover:shadow-md"
                                title="Edit Data Dosen">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M17 3a2.85 2.85 0 0 1 4 4L7.5 20.5 2 22l1.5-5.5L17 3z"></path></svg>
                            </button>
                            {{-- BUTTON HAPUS: Menggunakan title untuk tooltip --}}
                            <button onclick="window.handleDeleteClick(${lecturer.id})"
                                class="text-red-600 hover:text-white bg-red-100 p-2 rounded-full transition duration-150 hover:bg-red-600 hover:shadow-md"
                                title="Hapus Data Dosen">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M3 6h18"></path><path d="M19 6v14c0 1-1 2-2 2H7c-1 0-2-1-2-2V6"></path><path d="M8 6V4c0-1 1-2 2-2h4c1 0 2 1 2 2v2"></path><line x1="10" y1="11" x2="10" y2="17"></line><line x1="14" y1="11" x2="14" y2="17"></line></svg>
                            </button>
                        </td>
                    </tr>
                `;
                $tbody.append(row);
            });
        }
        
        // Update hitungan data
        $('#lecturer-count').text(filteredLecturers.length);
    }

    // --- HANDLER EDIT DATA (menggunakan Prompt) ---
    function promptLecturerData(lecturer) {
        let title = `Edit Data Dosen (${lecturer.nama})`;
        
        // Karena ini simulasi sederhana, kita hanya edit NIDN, Nama, Bidang, dan Status
        let nidn = prompt(`NIDN (${title}):`, lecturer.nidn);
        if (!nidn) return;

        let nama = prompt(`Nama Lengkap & Gelar (${title}):`, lecturer.nama);
        if (!nama) return;

        let bidang = prompt(`Bidang Keahlian (${title}):`, lecturer.bidang);
        
        // Status/Pendidikan di sini menggunakan text input sederhana
        let status = prompt(`Status (Aktif, Cuti, Non-Aktif, Tugas Belajar) (${title}):`, lecturer.status);
        let pendidikan_terakhir = prompt(`Pendidikan Terakhir (S1, S2, S3) (${title}):`, lecturer.pendidikan_terakhir);

        if (nidn && nama) {
            const updatedData = {
                nidn: nidn,
                nama: nama,
                bidang: bidang,
                status: status,
                pendidikan_terakhir: pendidikan_terakhir,
            };

            // UPDATE data
            lecturers = lecturers.map(l => l.id === lecturer.id ? { ...l, ...updatedData } : l);
            alert(`Data Dosen ${nama} berhasil diperbarui!`);
            
            renderTable();
        } else {
            alert("NIDN dan Nama Lengkap wajib diisi.");
        }
    }
    
    // --- GLOBAL HANDLERS UNTUK BUTTON TABLE ---
    window.handleEditClick = function(id) {
        const lecturer = lecturers.find(l => l.id === id);
        if (lecturer) {
            promptLecturerData(lecturer);
        }
    }

    window.handleDeleteClick = function(id) {
        const lecturer = lecturers.find(l => l.id === id);
        if (lecturer && confirm(`Anda yakin ingin menghapus data dosen bernama "${lecturer.nama}" (NIDN: ${lecturer.nidn})? Aksi ini tidak dapat dibatalkan.`)) {
            lecturers = lecturers.filter(l => l.id !== id);
            alert(`Data Dosen ${lecturer.nama} berhasil dihapus.`);
            renderTable();
        }
    }
    
    // --- EVENT LISTENERS JQUERY ---
    
    // Filter
    $('#filter-container select').on('change', renderTable);

    // Initial load
    renderTable();
});
</script>
@endpush