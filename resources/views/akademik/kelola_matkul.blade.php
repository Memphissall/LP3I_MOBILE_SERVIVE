{{-- resources/views/akademik/kelola_matkul.blade.php --}}

@extends('layouts.app')

@section('content')

<div class="p-6">
    {{-- Header & Tombol Tambah --}}
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold text-gray-800">Kelola Mata Kuliah</h1>
        {{-- Tombol Tambah: Viridian Green (#009DA5) --}}
        <button id="btn-open-tambah-matkul-modal" class="bg-[#009DA5] hover:bg-[#00888f] text-white px-6 py-2 rounded-lg flex items-center shadow-md transition font-semibold">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <line x1="12" y1="5" x2="12" y2="19"></line>
                <line x1="5" y1="12" x2="19" y2="12"></line>
            </svg>
            Tambah Mata Kuliah
        </button>
    </div>

    {{-- FILTER SECTION --}}
    <div class="bg-white p-6 rounded-xl shadow-lg mb-6 border-t-4 border-[#004269]"> {{-- Border atas Indigo Dye --}}
        <h2 class="text-lg font-semibold text-[#004269] mb-4">Filter Data</h2>
        
        <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
            <div class="flex flex-col space-y-1">
                <label for="filter-bidang-keahlian" class="text-sm font-medium text-gray-600">Bidang Keahlian</label>
                <select id="filter-bidang-keahlian" class="p-2 border rounded-lg outline-none text-sm text-gray-700 bg-gray-50 focus:border-[#009DA5] focus:ring-1 focus:ring-[#009DA5]">
                    <option value="all">Semua Bidang Keahlian</option>
                    {{-- Populated by JS --}}
                </select>
            </div>
            
            <div class="flex flex-col space-y-1">
                <label for="filter-semester" class="text-sm font-medium text-gray-600">Semester</label>
                <select id="filter-semester" class="p-2 border rounded-lg outline-none text-sm text-gray-700 bg-gray-50 focus:border-[#009DA5] focus:ring-1 focus:ring-[#009DA5]">
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

            <div class="flex items-end">
                {{-- Tombol Tampilkan: Indigo Dye --}}
                <button id="btn-filter" class="w-full px-4 py-2 bg-[#004269] hover:bg-[#003350] text-white rounded-lg transition font-semibold shadow-md flex items-center justify-center">
                    <x-heroicon-o-magnifying-glass class="w-4 h-4 mr-2" />
                    Tampilkan Data
                </button>
            </div>
        </div>
    </div>

    {{-- TABLE SECTION --}}
    <div class="bg-white rounded-xl shadow-lg overflow-hidden border border-gray-100 mb-6">
        {{-- Header Tabel: Indigo Dye (#004269) --}}
        <div class="p-4 border-b flex justify-between items-center bg-[#004269]">
            <h3 class="font-bold text-white">Daftar Mata Kuliah (<span id="matkul-count">0</span> data)</h3>
        </div>
        
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        {{-- Text Header: Indigo Dye --}}
                        <th class="px-6 py-3 text-left text-sm font-extrabold text-[#004269] uppercase tracking-wider w-[120px]">Kode MK</th>
                        <th class="px-6 py-3 text-left text-sm font-extrabold text-[#004269] uppercase tracking-wider min-w-[300px]">Nama Mata Kuliah</th>
                        <th class="px-6 py-3 text-center text-sm font-extrabold text-[#004269] uppercase tracking-wider w-[80px]">SKS</th>
                        <th class="px-6 py-3 text-center text-sm font-extrabold text-[#004269] uppercase tracking-wider w-[100px]">Bobot</th>
                        <th class="px-6 py-3 text-center text-sm font-extrabold text-[#004269] uppercase tracking-wider w-[100px]">Semester</th>
                        <th class="px-6 py-3 text-left text-sm font-extrabold text-[#004269] uppercase tracking-wider min-w-[180px]">Bidang Keahlian</th>
                        <th class="px-6 py-3 text-center text-sm font-extrabold text-[#004269] uppercase tracking-wider w-[80px]">SAP</th>
                        <th class="px-6 py-3 text-center text-sm font-extrabold text-[#004269] uppercase tracking-wider w-[100px]">Aksi</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200 text-sm" id="matkul-table-body">
                    <tr><td colspan="8" class="px-6 py-10 text-center text-gray-500 italic">Click "Tampilkan Data"...</td></tr>
                </tbody>
            </table>
            <div id="no-data-message" class="text-center py-10 text-[#FF0000] italic hidden">
                <p>Tidak ada mata kuliah yang sesuai dengan filter.</p>
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
    
    // Setup CSRF Token
    $.ajaxSetup({ headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') } });

    let bidangKeahlianList = [];

    // LOAD BIDANG KEAHLIAN OPTIONS
    function loadBidangKeahlian() {
        $.ajax({
            url: "{{ route('admin.api.bidang_keahlian.list') }}",
            method: 'GET',
            success: function(data) {
                bidangKeahlianList = data;
                
                // Populate filter dropdown
                const $filterSelect = $('#filter-bidang-keahlian');
                $filterSelect.find('option:not(:first)').remove();
                data.forEach(bk => {
                    $filterSelect.append(`<option value="${bk.id_bidang_keahlian}">${bk.nama} (${bk.kode})</option>`);
                });
                
                // Populate modal dropdowns
                const $tambahSelect = $('#tambah-bidang-keahlian');
                const $editSelect = $('#edit-bidang-keahlian');
                
                $tambahSelect.find('option:not(:first)').remove();
                $editSelect.find('option:not(:first)').remove();
                
                data.forEach(bk => {
                    const option = `<option value="${bk.id_bidang_keahlian}">${bk.nama} (${bk.kode})</option>`;
                    $tambahSelect.append(option);
                    $editSelect.append(option);
                });
            },
            error: function(xhr) {
                console.error('Failed to load bidang keahlian:', xhr);
            }
        });
    }

    loadBidangKeahlian();
    
    // RENDER TABLE
    function renderTable() {
        const id_bidang_keahlian = $('#filter-bidang-keahlian').val();
        const semester = $('#filter-semester').val();

        $.ajax({
            url: "{{ route('admin.api.matkul.list') }}",
            method: 'GET',
            data: { id_bidang_keahlian, semester },
            success: function(data) {
                const $tbody = $('#matkul-table-body');
                $tbody.empty();

                if (data.length === 0) {
                    $('#no-data-message').removeClass('hidden').show();
                    $tbody.closest('table').addClass('hidden');
                } else {
                    $('#no-data-message').addClass('hidden').hide();
                    $tbody.closest('table').removeClass('hidden');
                    
                    data.forEach(mk => {
                        const bidangKeahlianNama = mk.bidang_keahlian ? mk.bidang_keahlian.nama : '-';
                        
                        // SAP Badge: Menggunakan style Indigo Dye soft agar terlihat formal
                        const sapCell = mk.sap 
                            ? `<a href="/${mk.sap}" target="_blank" class="inline-flex items-center px-2.5 py-0.5 text-xs font-semibold rounded-full bg-[#004269]/10 text-[#004269] hover:bg-[#004269] hover:text-white transition">
                                <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="mr-1">
                                    <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path>
                                    <polyline points="14 2 14 8 20 8"></polyline>
                                </svg>
                                Lihat
                               </a>`
                            : '<span class="text-gray-400 text-xs">-</span>';
                        
                        const row = `
                            <tr class="hover:bg-gray-50 transition border-b">
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-mono text-gray-600">${mk.kode_mk}</td>
                                <td class="px-6 py-4 text-sm font-bold text-gray-900">${mk.nama_mk}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-center text-gray-700">${mk.sks}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-center text-gray-700">${mk.bobot_kompetensi}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-center text-gray-700">${mk.semester}</td>
                                <td class="px-6 py-4 text-sm text-gray-700">${bidangKeahlianNama}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-center">${sapCell}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-center">
                                    <div class="flex justify-center space-x-2">
                                        {{-- Tombol Edit: Viridian Green (#009DA5) --}}
                                        <button data-id="${mk.id_matkul}" class="btn-edit-matkul p-2 bg-[#009DA5]/10 text-[#009DA5] rounded-full hover:bg-[#009DA5] hover:text-white transition shadow-sm">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M17 3a2.85 2.85 0 0 1 4 4L7.5 20.5 2 22l1.5-5.5L17 3z"></path></svg>
                                        </button>
                                        {{-- Tombol Delete: Red (#FF0000) --}}
                                        <button data-id="${mk.id_matkul}" class="btn-delete-matkul p-2 bg-[#FF0000]/10 text-[#FF0000] rounded-full hover:bg-[#FF0000] hover:text-white transition shadow-sm">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M3 6h18"></path><path d="M19 6v14c0 1-1 2-2 2H7c-1 0-2-1-2-2V6"></path><path d="M8 6V4c0-1 1-2 2-2h4c1 0 2 1 2 2v2"></path></svg>
                                        </button>
                                    </div>
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
        
        const formData = new FormData(this);
        $('#btn-tambah-matkul').text('Menyimpan...').prop('disabled', true);

        $.ajax({
            url: "{{ route('admin.matkul.store') }}",
            method: 'POST',
            data: formData,
            processData: false,
            contentType: false,
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
                $('#edit-matkul-id').val(data.id_matkul);
                $('#edit-kode-mk').val(data.kode_mk);
                $('#edit-nama-mk').val(data.nama_mk);
                $('#edit-sks').val(data.sks);
                $('#edit-bobot-kompetensi').val(data.bobot_kompetensi);
                $('#edit-semester').val(data.semester);
                $('#edit-bidang-keahlian').val(data.id_bidang_keahlian);
                $('#edit-deskripsi').val(data.deskripsi);

                // Display current SAP file
                if (data.sap) {
                    const fileName = data.sap.split('/').pop();
                    $('#current-sap-name').html(`<a href="/${data.sap}" target="_blank" class="text-[#004269] hover:underline font-semibold">${fileName}</a>`);
                } else {
                    $('#current-sap-name').text('Tidak ada file');
                }

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
        const formData = new FormData(this);

        $('#btn-update-matkul').text('Menyimpan...').prop('disabled', true);

        $.ajax({
            url: updateUrl,
            method: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            headers: {
                'X-HTTP-Method-Override': 'PUT'
            },
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

    // FILTER
    $('#btn-filter').click(function() {
        renderTable();
    });

});
</script>
@endpush