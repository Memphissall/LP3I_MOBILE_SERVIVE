{{-- resources/views/akademik/data_dosen.blade.php --}}

@extends('layouts.app') 

@section('content')

<div class="p-6">
    {{-- Header Page --}}
    <div class="flex justify-between items-center mb-8">
        <div>
            <h1 class="text-2xl font-extrabold text-[#004269] tracking-tight">Kelola Data Pendidik</h1>
            <p class="text-sm text-gray-500 mt-1">Manajemen data tenaga pengajar (Dosen Tetap, Kontrak, & Honorer).</p>
        </div>
    </div>

    {{-- 1. Container Filter Utama (REMASTERED) --}}
    <div class="bg-white rounded-2xl shadow-xl shadow-gray-200/50 mb-8 overflow-hidden relative border border-gray-100">
        {{-- Decorative Top Bar --}}
        <div class="h-1.5 w-full bg-gradient-to-r from-[#004269] via-[#00536e] to-[#009DA5]"></div>

        <div class="p-6 md:p-8">
            {{-- Header Filter --}}
            <div class="flex items-center space-x-3 mb-6 border-b border-gray-100 pb-4">
                <div class="bg-[#004269]/10 p-2.5 rounded-xl text-[#004269]">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z"/>
                    </svg>
                </div>
                <div>
                    <h2 class="text-lg font-bold text-gray-800">Filter Pencarian</h2>
                    <p class="text-xs text-gray-400 font-medium">Saring data dosen berdasarkan kriteria berikut</p>
                </div>
            </div>

            {{-- Grid Input --}}
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6" id="filter-container">
                
                {{-- Dropdown Status --}}
                <div class="group">
                    <label class="block text-xs font-bold text-gray-500 uppercase tracking-wider mb-2 flex items-center">
                        <svg class="w-4 h-4 mr-1.5 text-[#009DA5]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        Status Kepegawaian
                    </label>
                    <div class="relative">
                        <select id="filter-status" class="w-full p-3 pl-4 text-sm font-medium text-gray-700 bg-gray-50 border border-gray-200 rounded-xl outline-none focus:bg-white focus:border-[#009DA5] focus:ring-4 focus:ring-[#009DA5]/10 transition-all duration-200 appearance-none cursor-pointer hover:border-gray-300">
                            <option value="Semua Status">Semua Status</option>
                            <option value="Aktif">Aktif</option>
                            <option value="Tidak Aktif">Tidak Aktif</option>
                            <option value="Kontrak">Kontrak</option>
                            <option value="Tetap">Tetap</option>
                            <option value="Honorer">Honorer</option>
                        </select>
                        <div class="absolute inset-y-0 right-0 flex items-center px-3 pointer-events-none text-gray-400 group-hover:text-[#004269] transition-colors">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                        </div>
                    </div>
                </div>

                {{-- Dropdown Pendidikan --}}
                <div class="group">
                    <label class="block text-xs font-bold text-gray-500 uppercase tracking-wider mb-2 flex items-center">
                        <svg class="w-4 h-4 mr-1.5 text-[#009DA5]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l9-5-9-5-9 5 9 5z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14z"/></svg>
                        Pendidikan Terakhir
                    </label>
                    <div class="relative">
                        <select id="filter-pendidikan" class="w-full p-3 pl-4 text-sm font-medium text-gray-700 bg-gray-50 border border-gray-200 rounded-xl outline-none focus:bg-white focus:border-[#009DA5] focus:ring-4 focus:ring-[#009DA5]/10 transition-all duration-200 appearance-none cursor-pointer hover:border-gray-300">
                            <option value="Semua Pendidikan">Semua Pendidikan</option>
                            <!-- Options will be populated dynamically from database -->
                        </select>
                        <div class="absolute inset-y-0 right-0 flex items-center px-3 pointer-events-none text-gray-400 group-hover:text-[#004269] transition-colors">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                        </div>
                    </div>
                </div>

            </div>
            
            {{-- Action Button --}}
            <div class="mt-8 flex justify-end">
                <button id="btn-filter" class="relative overflow-hidden group bg-[#004269] hover:bg-[#003350] text-white pl-6 pr-8 py-3 rounded-xl font-bold transition-all duration-300 shadow-[0_4px_14px_0_rgba(0,66,105,0.39)] hover:shadow-[0_6px_20px_rgba(0,66,105,0.23)] hover:-translate-y-1 active:translate-y-0 flex items-center">
                    <span class="absolute right-0 w-8 h-32 -mt-12 transition-all duration-1000 transform translate-x-12 bg-white opacity-10 rotate-12 group-hover:-translate-x-40 ease"></span>
                    <svg class="w-5 h-5 mr-2 animate-pulse" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                    Terapkan Filter
                </button>
            </div>
        </div>
    </div>

    {{-- 2. TABLE SECTION (COMPACT & BOLD) --}}
    <div class="bg-white rounded-2xl shadow-xl shadow-gray-200/50 overflow-hidden mb-6 border border-gray-100">
        {{-- Header Tabel with Gradient --}}
        <div id="header-daftar-dosen" class="p-5 border-b bg-gradient-to-r from-[#004269] to-[#009DA5]">
            <div class="flex flex-col md:flex-row justify-between items-center gap-4">
                <div class="flex items-center space-x-3">
                    <div class="bg-white/20 p-2 rounded-lg backdrop-blur-sm">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/></svg>
                    </div>
                    <h3 class="text-xl font-bold text-white tracking-wide">Daftar Data Pendidik <span class="bg-white/20 px-2 py-0.5 rounded text-sm font-mono ml-2" id="lecturer-count">0</span></h3>
                </div>

                <div class="flex space-x-3">
                    {{-- Tombol Print (Hidden by default) --}}
                    <button id="btn-print" class="bg-white/10 text-white border border-white/30 backdrop-blur-md px-4 py-2 rounded-lg font-bold hover:bg-white hover:text-[#004269] transition-all duration-200 flex items-center text-sm hidden">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"/>
                        </svg>
                        Print Data
                    </button>
                    {{-- Tombol Tambah (Placeholder/Optional) --}}
                    {{-- <button class="bg-white text-[#004269] px-4 py-2 rounded-lg font-bold ...">Tambah</button> --}}
                </div>
            </div>
        </div>
        
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-3 py-3 text-center text-sm font-extrabold text-[#004269] uppercase tracking-wider w-12 border-b-2 border-gray-200">No</th>
                        <th class="px-3 py-3 text-left text-sm font-extrabold text-[#004269] uppercase tracking-wider border-b-2 border-gray-200">Id Pendidik</th>
                        <th class="px-3 py-3 text-left text-sm font-extrabold text-[#004269] uppercase tracking-wider border-b-2 border-gray-200">Id</th>
                        <th class="px-3 py-3 text-left text-sm font-extrabold text-[#004269] uppercase tracking-wider border-b-2 border-gray-200">Nama Pendidik</th>
                        <th class="px-3 py-3 text-left text-sm font-extrabold text-[#004269] uppercase tracking-wider border-b-2 border-gray-200">Tempat Lahir</th>
                        <th class="px-3 py-3 text-center text-sm font-extrabold text-[#004269] uppercase tracking-wider border-b-2 border-gray-200 w-24">Tanggal Lahir</th>
                        <th class="px-3 py-3 text-center text-sm font-extrabold text-[#004269] uppercase tracking-wider border-b-2 border-gray-200 w-24">Alamat</th>
                        <th class="px-3 py-3 text-center text-sm font-extrabold text-[#004269] uppercase tracking-wider border-b-2 border-gray-200 w-24">Email</th>
                        <th class="px-3 py-3 text-center text-sm font-extrabold text-[#004269] uppercase tracking-wider border-b-2 border-gray-200 w-24">Pendidikan</th>
                        <th class="px-3 py-3 text-center text-sm font-extrabold text-[#004269] uppercase tracking-wider border-b-2 border-gray-200 w-24">No Telp</th>
                        <th class="px-3 py-3 text-center text-sm font-extrabold text-[#004269] uppercase tracking-wider w-28 border-b-2 border-gray-200">Status</th>
                        <th class="px-3 py-3 text-center text-sm font-extrabold text-[#004269] uppercase tracking-wider w-24 border-b-2 border-gray-200">Aksi</th>
                    </tr>
                </thead>
                <tbody id="lecturer-table-body" class="bg-white divide-y divide-gray-100 text-sm">
                    <tr>
                         {{-- Colspan 12 untuk 12 Kolom --}}
                        <td colspan="12" class="px-6 py-10 text-center text-gray-500 italic">
                             <div class="flex flex-col items-center justify-center">
                                <span class="text-sm font-medium text-gray-400">Silakan klik tombol "Terapkan Filter" untuk memuat data.</span>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        {{-- Footer Tabel --}}
        <div class="bg-gray-50 px-6 py-3 border-t border-gray-100 flex justify-between items-center">
            <span class="text-xs text-gray-500 font-medium">Menampilkan data Pendidik terdaftar.</span>
        </div>
    </div>
</div>

{{-- MODAL COMPONENTS --}}
@include('components.edit_dosen_modal')

@endsection

@push('scripts')
<script>
$(document).ready(function() {
    
    // =========================================================================
    // LOAD DYNAMIC FILTER OPTIONS ON PAGE LOAD
    // =========================================================================
    
    function loadFilterOptions() {
        $.ajax({
            url: "{{ route('admin.api.dosen.filter-options') }}",
            method: 'GET',
            success: function(data) {
                // Populate Status dropdown
                const $statusSelect = $('#filter-status');
                const currentStatus = $statusSelect.val();
                $statusSelect.empty();
                $statusSelect.append('<option value="Semua Status">Semua Status</option>');
                data.status.forEach(function(status) {
                    // Database now uses Title case, use value directly
                    $statusSelect.append(`<option value="${status}">${status}</option>`);
                });
                if (currentStatus) $statusSelect.val(currentStatus);
                
                // Populate Pendidikan dropdown
                const $pendidikanSelect = $('#filter-pendidikan');
                const currentPendidikan = $pendidikanSelect.val();
                $pendidikanSelect.empty();
                $pendidikanSelect.append('<option value="Semua Pendidikan">Semua Pendidikan</option>');
                data.pendidikan.forEach(function(pendidikan) {
                    $pendidikanSelect.append(`<option value="${pendidikan}">${pendidikan}</option>`);
                });
                if (currentPendidikan) $pendidikanSelect.val(currentPendidikan);
            },
            error: function(xhr) {
                console.error('Failed to load filter options:', xhr);
            }
        });
    }
    
    // Load filter options on page load
    loadFilterOptions();
    
    // =========================================================================
    // RENDER TABLE FUNCTION
    // =========================================================================
    
    function renderTable() {
        const status = $('#filter-status').val();
        const pendidikan = $('#filter-pendidikan').val();

        // Loading State
        const $tbody = $('#lecturer-table-body');
        $tbody.html('<tr><td colspan="12" class="px-6 py-16 text-center"><div class="inline-flex items-center px-4 py-2 font-semibold leading-6 text-sm shadow rounded-md text-white bg-[#004269] transition ease-in-out duration-150 cursor-not-allowed"><svg class="animate-spin -ml-1 mr-3 h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path></svg>Sedang memuat data...</div></td></tr>');
        $('#btn-filter').prop('disabled', true).addClass('opacity-75');

        $.ajax({
            url: "{{ route('admin.api.dosen.list') }}",
            method: 'GET',
            data: { status, pendidikan },
            success: function(data) {
                $tbody.empty();

                if (data.length === 0) {
                     // Empty State Illustration
                     const emptyHtml = `
                    <tr>
                        <td colspan="12" class="px-6 py-12 text-center">
                            <div class="flex flex-col items-center justify-center">
                                <div class="bg-gray-50 rounded-full p-6 mb-4">
                                    <svg class="w-12 h-12 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/></svg>
                                </div>
                                <h3 class="text-lg font-medium text-gray-900">Data Tidak Ditemukan</h3>
                                <p class="text-gray-500 mt-1">Coba sesuaikan filter pencarian Anda.</p>
                            </div>
                        </td>
                    </tr>`;
                    $tbody.html(emptyHtml);
                    $('#btn-print').addClass('hidden').removeClass('flex');
                } else {
                    $('#btn-print').removeClass('hidden').addClass('flex');
                    
                    data.forEach((dosen, index) => {
                        const statusBadge = getStatusBadge(dosen.status);
                        
                        const row = `
                            <tr data-id="${dosen.id_dosen}" class="hover:bg-gray-50 transition-colors duration-200 group border-b border-gray-100 last:border-b-0">
                                <td class="px-3 py-3 text-center font-bold text-gray-500">
                                    ${index + 1}
                                </td>
                                <td class="px-3 py-3 whitespace-nowrap">
                                    <span class="font-mono text-xs text-[#004269] font-bold bg-[#004269]/5 px-1.5 py-0.5 rounded border border-[#004269]/10">${dosen.nidn || '-'}</span>
                                </td>
                                <td class="px-3 py-3 whitespace-nowrap">
                                    <span class="font-mono text-xs text-gray-500">${dosen.id_dosen_internal || '-'}</span>
                                </td>
                                <td class="px-3 py-3">
                                    <div class="text-xs font-bold text-gray-800 group-hover:text-[#004269] transition-colors">${dosen.nama_dosen}</div>
                                    <div class="text-[10px] text-gray-400">${dosen.bidang || ''}</div>
                                </td>
                                <td class="px-3 py-3 text-xs text-gray-600">${dosen.tempat || '-'}</td>
                                <td class="px-3 py-3 text-xs text-gray-600 text-center">${dosen.tanggal_lahir || '-'}</td>
                                <td class="px-3 py-3 text-xs text-gray-600 truncate max-w-xs" title="${dosen.alamat || '-'}">${dosen.alamat || '-'}</td>
                                <td class="px-3 py-3 text-xs text-gray-600 truncate" title="${dosen.email || '-'}">${dosen.email || '-'}</td>
                                <td class="px-3 py-3 text-center">
                                    <span class="inline-flex items-center px-2 py-0.5 rounded text-[10px] font-bold bg-gray-100 text-gray-700 uppercase tracking-wide border border-gray-200">
                                        ${dosen.pendidikan}
                                    </span>
                                </td>
                                <td class="px-3 py-3 text-xs text-gray-600">${dosen.no_telp || '-'}</td>
                                <td class="px-3 py-3 text-center">${statusBadge}</td>
                                <td class="px-3 py-3 text-center whitespace-nowrap text-xs font-medium">
                                    <div class="flex justify-center space-x-1">
                                        <button data-id="${dosen.id_dosen}" title="Edit" class="btn-edit-dosen p-1.5 text-indigo-600 hover:text-indigo-900 hover:bg-indigo-50 rounded transition-all duration-200">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path></svg>
                                        </button>
                                        <button data-id="${dosen.id_dosen}" title="Hapus" class="btn-delete-dosen p-1.5 text-rose-500 hover:text-rose-700 hover:bg-rose-50 rounded transition-all duration-200">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        `;
                        $tbody.append(row);
                    });
                }
                
                $('#lecturer-count').text(data.length);
            },
            error: function(xhr) {
                Swal.fire({ icon: 'error', title: 'Gagal!', text: 'Gagal memuat data dosen', confirmButtonColor: '#004269' });
                console.error(xhr);
                $tbody.html('<tr><td colspan="12" class="px-6 py-10 text-center text-red-500 italic">Terjadi kesalahan saat memuat data.</td></tr>');
            },
            complete: function() {
                $('#btn-filter').prop('disabled', false).removeClass('opacity-75');
            }
        });
    }

    // Fungsi helper untuk badge warna sesuai brand (Pill Style)
    function getStatusBadge(statusRaw) {
        const status = statusRaw.toLowerCase();
        let colorClass = 'bg-gray-100 text-gray-600';
        let dotColor = 'bg-gray-400';

        if (status === 'aktif') {
            colorClass = 'bg-[#009DA5]/10 text-[#009DA5]'; 
            dotColor = 'bg-[#009DA5]';
        } 
        else if (status === 'tidak aktif') {
            colorClass = 'bg-rose-50 text-rose-600'; 
            dotColor = 'bg-rose-500';
        } 
        else if (status === 'tetap') {
            colorClass = 'bg-[#004269]/10 text-[#004269]'; 
            dotColor = 'bg-[#004269]';
        }
        else if (status === 'kontrak') {
            colorClass = 'bg-amber-50 text-amber-600';
            dotColor = 'bg-amber-500';
        }

        return `<span class="inline-flex items-center px-2 py-0.5 rounded-full text-[10px] font-bold ${colorClass} uppercase tracking-wide">
                    <span class="w-1.5 h-1.5 ${dotColor} rounded-full mr-1.5"></span>
                    ${statusRaw}
                </span>`;
    }

    // =========================================================================
    // EDIT DOSEN MODAL
    // =========================================================================

    $(document).on('click', '.btn-edit-dosen', function() {
        const dosenId = $(this).data('id');
        const editUrl = "{{ route('admin.dosen.edit', ':id') }}".replace(':id', dosenId);

        $.ajax({
            url: editUrl,
            method: 'GET',
            success: function(data) {
                // First, populate pendidikan options from filter data
                $.ajax({
                    url: "{{ route('admin.api.dosen.filter-options') }}",
                    method: 'GET',
                    success: function(filterData) {
                        console.log('Filter data received:', filterData);
                        
                        // Populate select dropdown with database values
                        const $pendidikanSelect = $('#edit-pendidikan-select');
                        $pendidikanSelect.find('option:not(:first):not(:last)').remove(); // Keep first (placeholder) and last (custom) option
                        
                        filterData.pendidikan.forEach(function(pendidikan) {
                            // Insert before the "Lainnya (Custom)" option
                            $pendidikanSelect.find('option:last').before(`<option value="${pendidikan}">${pendidikan}</option>`);
                        });
                        console.log('Select dropdown populated with', filterData.pendidikan.length, 'options');
                        
                        // Populate form fields
                        $('#edit-dosen-id').val(data.id_dosen);
                        $('#edit-nidn').val(data.nidn);
                        $('#edit-id-internal').val(data.id_dosen_internal);
                        $('#edit-nama').val(data.nama_dosen);
                        $('#edit-bidang').val(data.bidang);
                        $('#edit-tempat').val(data.tempat);
                        $('#edit-tanggal-lahir').val(data.tanggal_lahir);
                        $('#edit-jenis-kelamin').val(data.jenis_kelamin);
                        $('#edit-agama').val(data.agama);
                        $('#edit-alamat').val(data.alamat);
                        $('#edit-email').val(data.email);
                        $('#edit-no-telp').val(data.no_telp);
                        $('#edit-honor').val(data.honor_per_sks);
                        $('#edit-status').val(data.status ? data.status.toLowerCase() : '');

                        // Set pendidikan value
                        const pendidikanValue = data.pendidikan;
                        
                        // Check if value exists in select options
                        const optionExists = $('#edit-pendidikan-select option[value="' + pendidikanValue + '"]').length > 0;
                        
                        if (optionExists) {
                            // Use existing option from database
                            $('#edit-pendidikan-select').val(pendidikanValue);
                            $('#edit-pendidikan-custom').addClass('hidden').prop('required', false);
                            $('#edit-pendidikan').val(pendidikanValue);
                        } else {
                            // Use custom option
                            $('#edit-pendidikan-select').val('__custom__');
                            $('#edit-pendidikan-custom').removeClass('hidden').prop('required', true).val(pendidikanValue);
                            $('#edit-pendidikan').val(pendidikanValue);
                        }
                        
                        $('#edit-dosen-modal').removeClass('hidden');
                    },
                    error: function(xhr) {
                        console.error('Failed to load pendidikan options:', xhr);
                        // Still show modal even if datalist fails
                        $('#edit-dosen-id').val(data.id_dosen);
                        $('#edit-nidn').val(data.nidn);
                        $('#edit-id-internal').val(data.id_dosen_internal);
                        $('#edit-nama').val(data.nama_dosen);
                        
                        // Set pendidikan value (error handler)
                        const pendidikanValue = data.pendidikan;
                        
                        // Check if value exists in select options
                        const optionExists = $('#edit-pendidikan-select option[value="' + pendidikanValue + '"]').length > 0;
                        
                        if (optionExists) {
                            $('#edit-pendidikan-select').val(pendidikanValue);
                            $('#edit-pendidikan-custom').addClass('hidden').prop('required', false);
                            $('#edit-pendidikan').val(pendidikanValue);
                        } else {
                            $('#edit-pendidikan-select').val('__custom__');
                            $('#edit-pendidikan-custom').removeClass('hidden').prop('required', true).val(pendidikanValue);
                            $('#edit-pendidikan').val(pendidikanValue);
                        }
                        
                        $('#edit-dosen-modal').removeClass('hidden');
                    }
                });
            },
            error: function(xhr) {
                Swal.fire({ icon: 'error', title: 'Gagal!', text: 'Gagal mengambil data dosen', confirmButtonColor: '#004269' });
                console.error(xhr);
            }
        });
    });

    $('.close-edit-dosen-modal').click(function() {
        $('#edit-dosen-modal').addClass('hidden');
    });

    $('#edit-dosen-form').submit(function(e) {
        e.preventDefault();
        
        const dosenId = $('#edit-dosen-id').val();
        const updateUrl = "{{ route('admin.dosen.update', ':id') }}".replace(':id', dosenId);
        const formData = $(this).serialize();

        $('#btn-update-dosen').text('Menyimpan...').prop('disabled', true);

        $.ajax({
            url: updateUrl,
            method: 'PUT',
            data: formData,
            success: function(response) {
                Swal.fire({
                    icon: 'success',
                    title: 'Berhasil!',
                    text: response.message || 'Data dosen berhasil diperbarui!',
                    confirmButtonColor: '#004269',
                    timer: 2000,
                    timerProgressBar: true
                });
                $('#edit-dosen-modal').addClass('hidden');
                renderTable();
                $('#btn-update-dosen').text('Simpan Perubahan').prop('disabled', false);
            },
            error: function(xhr) {
                const res = xhr.responseJSON;
                Swal.fire({
                    icon: 'error',
                    title: 'Gagal!',
                    text: res.message || 'Terjadi kesalahan',
                    confirmButtonColor: '#004269'
                });
                $('#btn-update-dosen').text('Simpan Perubahan').prop('disabled', false);
            }
        });
    });

    // =========================================================================
    // DELETE DOSEN
    // =========================================================================

    $(document).on('click', '.btn-delete-dosen', function() {
        const dosenId = $(this).data('id');
        const dosenRow = $(this).closest('tr');
        const dosenName = dosenRow.find('td:eq(3) div:first-child').text(); 

        Swal.fire({
            title: 'Hapus Data Dosen?',
            html: `Yakin ingin menghapus dosen<br><strong>"${dosenName}"</strong>?<br><br>Data tidak dapat dikembalikan!`,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#dc2626',
            cancelButtonColor: '#6b7280',
            confirmButtonText: 'Ya, Hapus!',
            cancelButtonText: 'Batal',
            reverseButtons: true
        }).then((result) => {
            if (result.isConfirmed) {
                const deleteUrl = "{{ route('admin.dosen.destroy', ':id') }}".replace(':id', dosenId);

                $.ajax({
                    url: deleteUrl,
                    method: 'DELETE',
                    data: { _token: "{{ csrf_token() }}" },
                    success: function(response) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Terhapus!',
                            text: response.message || 'Data dosen berhasil dihapus!',
                            confirmButtonColor: '#004269',
                            timer: 2000,
                            timerProgressBar: true
                        });
                        renderTable();
                    },
                    error: function(xhr) {
                        const res = xhr.responseJSON;
                        Swal.fire({
                            icon: 'error',
                            title: 'Gagal!',
                            text: res.message || 'Terjadi kesalahan',
                            confirmButtonColor: '#004269'
                        });
                    }
                });
            }
        });
    });

    // =========================================================================
    // FILTER & PRINT
    // =========================================================================

    $('#btn-filter').click(function() {
        renderTable();
    });
    
    // Handle Pendidikan Select Change
    $('#edit-pendidikan-select').on('change', function() {
        const value = $(this).val();
        if (value === '__custom__') {
            $('#edit-pendidikan-custom').removeClass('hidden').prop('required', true).focus();
            $('#edit-pendidikan-select').prop('required', false);
        } else {
            $('#edit-pendidikan-custom').addClass('hidden').prop('required', false).val('');
            $('#edit-pendidikan-select').prop('required', true);
            $('#edit-pendidikan').val(value);
        }
    });
    
    // Handle Custom Input Change
    $('#edit-pendidikan-custom').on('input', function() {
        $('#edit-pendidikan').val($(this).val());
    });
    
    // EDIT BUTTON HANDLER
    // This seems to be a misplaced comment/handler, assuming it's meant for the print button based on context
    // If it's a new edit button handler, it should be placed with other edit-related handlers.
    // For now, I'm placing it as per the instruction's provided snippet.
    $('#btn-print').click(function() {
        const status = $('#filter-status').val();
        const pendidikan = $('#filter-pendidikan').val();

        let printUrl = "{{ route('admin.dosen.print') }}";
        printUrl += `?status=${encodeURIComponent(status)}`;
        printUrl += `&pendidikan=${encodeURIComponent(pendidikan)}`;

        window.open(printUrl, '_blank');
    });

});
</script>
@endpush