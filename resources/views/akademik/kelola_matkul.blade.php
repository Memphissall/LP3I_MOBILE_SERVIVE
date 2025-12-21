{{-- resources/views/akademik/kelola_matkul.blade.php --}}

@extends('layouts.app')

@section('content')

<div class="min-h-screen bg-gray-50 p-4 md:p-8 font-sans">
    <div class="flex items-center justify-between space-x-4 text-gray-800 border-b border-gray-200 pb-4 mb-6">
        <div class="flex items-center space-x-4">
            <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <path d="M4 19.5A2.5 2.5 0 0 1 6.5 17H20"></path>
                <path d="M6.5 2H20v20h-1.5"></path>
                <path d="M18 2v20"></path>
                <path d="M6.5 7h11"></path>
                <path d="M6.5 12h11"></path>
            </svg>
            <h1 class="text-3xl font-extrabold tracking-tight">Kelola Mata Kuliah</h1>
        </div>
        <button id="btn-open-tambah-matkul-modal" class="px-4 py-2 bg-green-600 text-white rounded-md hover:bg-green-700 transition flex items-center space-x-2">
            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <line x1="12" y1="5" x2="12" y2="19"></line>
                <line x1="5" y1="12" x2="19" y2="12"></line>
            </svg>
            <span>Tambah Mata Kuliah</span>
        </button>
    </div>

    {{-- FILTER SECTION --}}
    <div class="bg-white p-6 rounded-xl shadow-lg mb-6 border border-gray-100">
        <h2 class="text-lg font-semibold text-gray-700 mb-4">Filter Data</h2>
        
        <div class="grid grid-cols-2 md:grid-cols-5 gap-4">
            <div class="flex flex-col space-y-1">
                <label for="filter-jurusan" class="text-sm font-medium text-gray-700">Jurusan</label>
                <select id="filter-jurusan" class="p-2 border border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500">
                    <option value="Semua Jurusan">Semua Jurusan</option>
                    <option value="Teknik Informatika">Teknik Informatika</option>
                    <option value="Sistem Informasi">Sistem Informasi</option>
                    <option value="Akuntansi">Akuntansi</option>
                </select>
            </div>
            
            <div class="flex flex-col space-y-1">
                <label for="filter-semester" class="text-sm font-medium text-gray-700">Semester</label>
                <select id="filter-semester" class="p-2 border border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500">
                    <option value="Semua Semester">Semua Semester</option>
                    <option value="1">Semester 1</option>
                    <option value="2">Semester 2</option>
                    <option value="3">Semester 3</option>
                    <option value="4">Semester 4</option>
                    <option value="5">Semester 5</option>
                    <option value="6">Semester 6</option>
                    <option value="7">Semester 7</option>
                    <option value="8">Semester 8</option>
                </select>
            </div>

            <div class="flex flex-col space-y-1">
                <label for="filter-jenis" class="text-sm font-medium text-gray-700">Jenis</label>
                <select id="filter-jenis" class="p-2 border border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500">
                    <option value="Semua Jenis">Semua Jenis</option>
                    <option value="Wajib">Wajib</option>
                    <option value="Pilihan">Pilihan</option>
                </select>
            </div>

            <div class="flex items-end">
                <button id="btn-filter" class="w-full px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition">
                    Tampilkan Data
                </button>
            </div>

            <div class="flex items-end">
                <button id="btn-print" class="w-full px-4 py-2 bg-purple-600 text-white rounded-lg hover:bg-purple-700 transition flex items-center justify-center space-x-2">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <polyline points="6 9 6 2 18 2 18 9"></polyline>
                        <path d="M6 18H4a2 2 0 0 1-2-2v-5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v5a2 2 0 0 1-2 2h-2"></path>
                        <rect x="6" y="14" width="12" height="8"></rect>
                    </svg>
                    <span>Print</span>
                </button>
            </div>
        </div>
    </div>

    {{-- TABLE SECTION --}}
    <div class="bg-white p-4 md:p-6 rounded-xl shadow-lg border border-gray-100">
        <h2 class="text-xl font-semibold text-gray-700 mb-4">Daftar Mata Kuliah (<span id="matkul-count">0</span> data)</h2>
        <div class="overflow-x-auto rounded-lg border border-gray-200">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-bold text-gray-600 uppercase tracking-wider w-[120px]">Kode MK</th>
                        <th class="px-6 py-3 text-left text-xs font-bold text-gray-600 uppercase tracking-wider min-w-[300px]">Nama Mata Kuliah</th>
                        <th class="px-6 py-3 text-center text-xs font-bold text-gray-600 uppercase tracking-wider w-[80px]">SKS</th>
                        <th class="px-6 py-3 text-center text-xs font-bold text-gray-600 uppercase tracking-wider w-[100px]">Semester</th>
                        <th class="px-6 py-3 text-center text-xs font-bold text-gray-600 uppercase tracking-wider w-[100px]">Jenis</th>
                        <th class="px-6 py-3 text-left text-xs font-bold text-gray-600 uppercase tracking-wider min-w-[180px]">Jurusan</th>
                        <th class="px-6 py-3 text-center text-xs font-bold text-gray-600 uppercase tracking-wider w-[100px]">Aksi</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200" id="matkul-table-body">
                    {{-- Data akan diisi oleh JavaScript --}}
                </tbody>
            </table>
            <div id="no-data-message" class="text-center py-10 text-gray-500 hidden">
                <p>Tidak ada mata kuliah yang sesuai dengan filter.</p>
                <p class="mt-2 text-sm">Klik "Tampilkan Data" atau ubah filter.</p>
            </div>
        </div>
    </div>
</div>

{{-- MODALS --}}
@include('components.tambah_matkul_modal')
@include('components.edit_matkul_modal')

@endsection

@push('scripts')
<script>
$(document).ready(function() {
    
    // RENDER TABLE
    function renderTable() {
        const jurusan = $('#filter-jurusan').val();
        const semester = $('#filter-semester').val();
        const jenis = $('#filter-jenis').val();

        $.ajax({
            url: "{{ route('admin.api.matkul.list') }}",
            method: 'GET',
            data: { jurusan, semester, jenis },
            success: function(data) {
                const $tbody = $('#matkul-table-body');
                $tbody.empty();

                if (data.length === 0) {
                    $('#no-data-message').show();
                    $tbody.closest('table').addClass('hidden');
                } else {
                    $('#no-data-message').hide();
                    $tbody.closest('table').removeClass('hidden');
                    
                    data.forEach(mk => {
                        const jenisBadge = mk.jenis === 'Wajib' 
                            ? '<span class="inline-flex items-center px-2.5 py-0.5 text-xs font-semibold rounded-full bg-blue-100 text-blue-800">Wajib</span>'
                            : '<span class="inline-flex items-center px-2.5 py-0.5 text-xs font-semibold rounded-full bg-green-100 text-green-800">Pilihan</span>';
                        
                        const row = `
                            <tr class="hover:bg-gray-50 transition">
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">${mk.kode_mk}</td>
                                <td class="px-6 py-4 text-sm text-gray-700">${mk.nama_mk}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-center text-gray-700">${mk.sks}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-center text-gray-700">${mk.semester}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-center">${jenisBadge}</td>
                                <td class="px-6 py-4 text-sm text-gray-700">${mk.jurusan}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium flex justify-center space-x-2">
                                    <button data-id="${mk.id}" class="btn-edit-matkul text-blue-600 hover:text-white bg-blue-100 p-2 rounded-full transition hover:bg-blue-600">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M17 3a2.85 2.85 0 0 1 4 4L7.5 20.5 2 22l1.5-5.5L17 3z"></path></svg>
                                    </button>
                                    <button data-id="${mk.id}" class="btn-delete-matkul text-red-600 hover:text-white bg-red-100 p-2 rounded-full transition hover:bg-red-600">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M3 6h18"></path><path d="M19 6v14c0 1-1 2-2 2H7c-1 0-2-1-2-2V6"></path><path d="M8 6V4c0-1 1-2 2-2h4c1 0 2 1 2 2v2"></path></svg>
                                    </button>
                                </td>
                            </tr>
                        `;
                        $tbody.append(row);
                    });
                }
                
                $('#matkul-count').text(data.length);
            },
            error: function(xhr) {
                alert('Gagal memuat data');
                console.error(xhr);
            }
        });
    }

    // TAMBAH MATKUL
    $('#btn-open-tambah-matkul-modal').click(function() {
        $('#tambah-matkul-modal').removeClass('hidden');
    });

    $('.close-tambah-matkul-modal').click(function() {
        $('#tambah-matkul-modal').addClass('hidden');
        $('#tambah-matkul-form')[0].reset();
    });

    $('#tambah-matkul-form').submit(function(e) {
        e.preventDefault();
        
        const formData = $(this).serialize();
        $('#btn-tambah-matkul').text('Menyimpan...').prop('disabled', true);

        $.ajax({
            url: "{{ route('admin.matkul.store') }}",
            method: 'POST',
            data: formData,
            success: function(response) {
                alert(response.message);
                $('#tambah-matkul-modal').addClass('hidden');
                $('#tambah-matkul-form')[0].reset();
                renderTable();
                $('#btn-tambah-matkul').text('Simpan Data').prop('disabled', false);
            },
            error: function(xhr) {
                const res = xhr.responseJSON;
                alert('Gagal: ' + (res.message || 'Terjadi kesalahan'));
                $('#btn-tambah-matkul').text('Simpan Data').prop('disabled', false);
            }
        });
    });

    // EDIT MATKUL
    $(document).on('click', '.btn-edit-matkul', function() {
        const matkulId = $(this).data('id');
        const editUrl = "{{ route('admin.matkul.edit', ':id') }}".replace(':id', matkulId);

        $.ajax({
            url: editUrl,
            method: 'GET',
            success: function(data) {
                $('#edit-matkul-id').val(data.id);
                $('#edit-kode-mk').val(data.kode_mk);
                $('#edit-nama-mk').val(data.nama_mk);
                $('#edit-sks').val(data.sks);
                $('#edit-semester').val(data.semester);
                $('#edit-jenis').val(data.jenis);
                $('#edit-jurusan').val(data.jurusan);
                $('#edit-deskripsi').val(data.deskripsi);

                $('#edit-matkul-modal').removeClass('hidden');
            },
            error: function(xhr) {
                alert('Gagal mengambil data');
                console.error(xhr);
            }
        });
    });

    $('.close-edit-matkul-modal').click(function() {
        $('#edit-matkul-modal').addClass('hidden');
    });

    $('#edit-matkul-form').submit(function(e) {
        e.preventDefault();
        
        const matkulId = $('#edit-matkul-id').val();
        const updateUrl = "{{ route('admin.matkul.update', ':id') }}".replace(':id', matkulId);
        const formData = $(this).serialize();

        $('#btn-update-matkul').text('Menyimpan...').prop('disabled', true);

        $.ajax({
            url: updateUrl,
            method: 'PUT',
            data: formData,
            success: function(response) {
                alert(response.message);
                $('#edit-matkul-modal').addClass('hidden');
                renderTable();
                $('#btn-update-matkul').text('Simpan Perubahan').prop('disabled', false);
            },
            error: function(xhr) {
                const res = xhr.responseJSON;
                alert('Gagal: ' + (res.message || 'Terjadi kesalahan'));
                $('#btn-update-matkul').text('Simpan Perubahan').prop('disabled', false);
            }
        });
    });

    // DELETE MATKUL
    $(document).on('click', '.btn-delete-matkul', function() {
        const matkulId = $(this).data('id');
        const matkulRow = $(this).closest('tr');
        const matkulName = matkulRow.find('td:eq(1)').text();

        if (!confirm(`Hapus mata kuliah "${matkulName}"?\n\nData tidak dapat dikembalikan!`)) {
            return;
        }

        const deleteUrl = "{{ route('admin.matkul.destroy', ':id') }}".replace(':id', matkulId);

        $.ajax({
            url: deleteUrl,
            method: 'DELETE',
            data: { _token: "{{ csrf_token() }}" },
            success: function(response) {
                alert(response.message);
                renderTable();
            },
            error: function(xhr) {
                const res = xhr.responseJSON;
                alert('Gagal: ' + (res.message || 'Terjadi kesalahan'));
            }
        });
    });

    // FILTER & PRINT
    $('#btn-filter').click(function() {
        renderTable();
    });

    $('#btn-print').click(function() {
        const jurusan = $('#filter-jurusan').val();
        const semester = $('#filter-semester').val();
        const jenis = $('#filter-jenis').val();

        let printUrl = "{{ route('admin.matkul.print') }}";
        printUrl += `?jurusan=${encodeURIComponent(jurusan)}`;
        printUrl += `&semester=${encodeURIComponent(semester)}`;
        printUrl += `&jenis=${encodeURIComponent(jenis)}`;

        window.open(printUrl, '_blank');
    });

});
</script>
@endpush
