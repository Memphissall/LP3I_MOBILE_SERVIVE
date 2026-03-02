{{-- resources/views/akademik/kelola_matkul.blade.php --}}

@extends('layouts.app')

@section('page-title', 'Kelola Materi Ajar')
@section('page-description', 'Manajemen kurikulum, bobot SKS, dan SAP pembelajaran.')

@section('content')

<div class="p-6">


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
                    <h2 class="text-lg font-bold text-gray-800">Filter Data</h2>
                    <p class="text-xs text-gray-400 font-medium">Cari Materi Ajar berdasarkan kriteria</p>
                </div>
            </div>

            {{-- Grid Input --}}
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                
                {{-- Filter Program Studi --}}
                <div class="group">
                    <label class="block text-xs font-bold text-gray-500 uppercase tracking-wider mb-2 flex items-center">
                        <svg class="w-4 h-4 mr-1.5 text-[#009DA5]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/></svg>
                        Program Studi
                    </label>
                    <div class="relative">
                        <select id="filter-program-studi" class="w-full p-3 pl-4 text-sm font-medium text-gray-700 bg-gray-50 border border-gray-200 rounded-xl outline-none focus:bg-white focus:border-[#009DA5] focus:ring-4 focus:ring-[#009DA5]/10 transition-all duration-200 appearance-none cursor-pointer hover:border-gray-300">
                            <option value="all">Semua Program Studi</option>
                            {{-- Populated by JS --}}
                        </select>
                        <div class="absolute inset-y-0 right-0 flex items-center px-3 pointer-events-none text-gray-400 group-hover:text-[#004269] transition-colors">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                        </div>
                    </div>
                </div>
                
                {{-- Filter Semester --}}
                <div class="group">
                    <label class="block text-xs font-bold text-gray-500 uppercase tracking-wider mb-2 flex items-center">
                        <svg class="w-4 h-4 mr-1.5 text-[#009DA5]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                        Semester
                    </label>
                    <div class="relative">
                        <select id="filter-semester" class="w-full p-3 pl-4 text-sm font-medium text-gray-700 bg-gray-50 border border-gray-200 rounded-xl outline-none focus:bg-white focus:border-[#009DA5] focus:ring-4 focus:ring-[#009DA5]/10 transition-all duration-200 appearance-none cursor-pointer hover:border-gray-300">
                            <option value="Semua Semester">Semua Semester</option>
                            <!-- Options will be populated dynamically -->
                        </select>
                        <div class="absolute inset-y-0 right-0 flex items-center px-3 pointer-events-none text-gray-400 group-hover:text-[#004269] transition-colors">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                        </div>
                    </div>
                </div>

                {{-- Action Button --}}
                <div class="flex items-end">
                    <button id="btn-filter" class="w-full relative overflow-hidden group bg-[#004269] hover:bg-[#003350] text-white py-3 rounded-xl font-bold transition-all duration-300 shadow-[0_4px_14px_0_rgba(0,66,105,0.39)] hover:shadow-[0_6px_20px_rgba(0,66,105,0.23)] hover:-translate-y-1 active:translate-y-0 flex items-center justify-center">
                        <span class="absolute right-0 w-8 h-32 -mt-12 transition-all duration-1000 transform translate-x-12 bg-white opacity-10 rotate-12 group-hover:-translate-x-40 ease"></span>
                        <svg class="w-5 h-5 mr-2 animate-pulse" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                        Tampilkan Data
                    </button>
                </div>
            </div>
        </div>
    </div>

    {{-- 2. TABLE SECTION (COMPACT & BOLD) --}}
    <div class="bg-white rounded-2xl shadow-xl shadow-gray-200/50 overflow-hidden mb-6 border border-gray-100">
        {{-- Header Tabel with Gradient --}}
        <div class="p-5 border-b bg-gradient-to-r from-[#004269] to-[#009DA5]">
            <div class="flex flex-col md:flex-row justify-between items-center gap-4">
                <div class="flex items-center space-x-3">
                    <div class="bg-white/20 p-2 rounded-lg backdrop-blur-sm">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/></svg>
                    </div>
                    <h3 class="text-xl font-bold text-white tracking-wide">Daftar Materi Ajar <span class="bg-white/20 px-2 py-0.5 rounded text-sm font-mono ml-2" id="matkul-count">0</span></h3>
                </div>

                {{-- BUTTON GROUP --}}
                <div class="flex space-x-3">
                    <button id="btn-open-tambah-matkul-modal" class="bg-white text-[#004269] px-4 py-2 rounded-lg font-bold hover:bg-gray-50 transition-all duration-200 shadow-lg shadow-black/10 flex items-center transform hover:scale-105 active:scale-95 text-sm">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                            <line x1="12" y1="5" x2="12" y2="19"></line>
                            <line x1="5" y1="12" x2="19" y2="12"></line>
                        </svg>
                        Tambah Data
                    </button>
                </div>
            </div>
        </div>
        
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-3 py-3 text-center text-sm font-extrabold text-[#004269] uppercase tracking-wider w-12 border-b-2 border-gray-200">No</th>
                        <th class="px-3 py-3 text-left text-sm font-extrabold text-[#004269] uppercase tracking-wider w-[120px] border-b-2 border-gray-200">Kode MK</th>
                        <th class="px-3 py-3 text-left text-sm font-extrabold text-[#004269] uppercase tracking-wider min-w-[250px] border-b-2 border-gray-200">Materi Ajar</th>
                        <th class="px-3 py-3 text-center text-sm font-extrabold text-[#004269] uppercase tracking-wider w-[80px] border-b-2 border-gray-200">BK</th>
                        <th class="px-3 py-3 text-center text-sm font-extrabold text-[#004269] uppercase tracking-wider w-[100px] border-b-2 border-gray-200">Semester</th>
                        <th class="px-3 py-3 text-left text-sm font-extrabold text-[#004269] uppercase tracking-wider min-w-[180px] border-b-2 border-gray-200">Program Studi</th>
                        <th class="px-3 py-3 text-center text-sm font-extrabold text-[#004269] uppercase tracking-wider w-[100px] border-b-2 border-gray-200">SAP</th>
                        <th class="px-3 py-3 text-center text-sm font-extrabold text-[#004269] uppercase tracking-wider w-[100px] border-b-2 border-gray-200">Aksi</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-100 text-sm" id="matkul-table-body">
                    <tr>
                        <td colspan="9" class="px-6 py-10 text-center text-gray-500 italic">
                             <div class="flex flex-col items-center justify-center">
                                <span class="text-sm font-medium text-gray-400">Silakan klik tombol "Tampilkan Data" untuk memuat.</span>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="bg-gray-50 px-6 py-3 border-t border-gray-100 flex justify-between items-center">
            <span class="text-xs text-gray-500 font-medium">Menampilkan data Materi Ajar aktif.</span>
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

    let programStudiList = [];

    // LOAD PROGRAM STUDI OPTIONS
    function loadProgramStudi() {
        $.ajax({
            url: "{{ route('admin.api.program_studi.list') }}",
            method: 'GET',
            success: function(data) {
                programStudiList = data;
                
                // Populate filter dropdown
                const $filterSelect = $('#filter-program-studi');
                $filterSelect.find('option:not(:first)').remove();
                data.forEach(ps => {
                    $filterSelect.append(`<option value="${ps.id_program_studi}">${ps.nama_program_studi} (${ps.kode_program_studi})</option>`);
                });
                
                // Populate modal dropdowns
                const $tambahSelect = $('#tambah-program-studi');
                const $editSelect = $('#edit-program-studi');
                
                $tambahSelect.find('option:not(:first)').remove();
                $editSelect.find('option:not(:first)').remove();
                
                data.forEach(ps => {
                    const option = `<option value="${ps.id_program_studi}">${ps.nama_program_studi} (${ps.kode_program_studi})</option>`;
                    $tambahSelect.append(option);
                    $editSelect.append(option);
                });
            },
            error: function(xhr) {
                console.error('Failed to load program studi:', xhr);
            }
        });
    }

    loadProgramStudi();
    
    // LOAD SEMESTER OPTIONS DYNAMICALLY
    function loadSemesterOptions() {
        console.log('Loading Semester options...');
        $.ajax({
            url: "{{ route('admin.api.matkul.filter-options') }}",
            method: 'GET',
            success: function(data) {
                console.log('Semester data received:', data);
                const $semesterSelect = $('#filter-semester');
                const currentSemester = $semesterSelect.val();
                $semesterSelect.empty();
                $semesterSelect.append('<option value="Semua Semester">Semua Semester</option>');
                data.semesters.forEach(function(semester) {
                    $semesterSelect.append(`<option value="${semester}">Semester ${semester}</option>`);
                });
                console.log('Semester dropdown populated with', data.semesters.length, 'options');
                if (currentSemester) $semesterSelect.val(currentSemester);
            },
            error: function(xhr) {
                console.error('Failed to load semester options:', xhr);
                console.error('Status:', xhr.status, 'Response:', xhr.responseText);
            }
        });
    }
    
    // Load Program Studi options for filter
    function loadProgramStudiOptions() {
        console.log('Loading Program Studi options...');
        $.ajax({
            url: "{{ route('admin.api.program_studi.list') }}",
            method: 'GET',
            success: function(data) {
                console.log('Program Studi data received:', data);
                const $prodiSelect = $('#filter-program-studi');
                const currentProdi = $prodiSelect.val();
                $prodiSelect.empty();
                $prodiSelect.append('<option value="all">Semua Program Studi</option>');
                data.forEach(function(prodi) {
                    $prodiSelect.append(`<option value="${prodi.id_program_studi}">${prodi.nama_program_studi} (${prodi.kode_program_studi})</option>`);
                });
                console.log('Program Studi dropdown populated with', data.length, 'options');
                if (currentProdi && currentProdi !== 'all') $prodiSelect.val(currentProdi);
            },
            error: function(xhr) {
                console.error('Failed to load program studi options:', xhr);
                console.error('Status:', xhr.status, 'Response:', xhr.responseText);
            }
        });
    }
    
    loadProgramStudiOptions();
    loadSemesterOptions();
    
    // RENDER TABLE
    function renderTable() {
        const id_program_studi = $('#filter-program-studi').val();
        const semester = $('#filter-semester').val();

        const $tbody = $('#matkul-table-body');
        
        // Loading State
        $tbody.html('<tr><td colspan="9" class="px-6 py-16 text-center"><div class="inline-flex items-center px-4 py-2 font-semibold leading-6 text-sm shadow rounded-md text-white bg-[#004269] transition ease-in-out duration-150 cursor-not-allowed"><svg class="animate-spin -ml-1 mr-3 h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path></svg>Sedang memuat data...</div></td></tr>');
        $('#btn-filter').prop('disabled', true).addClass('opacity-75');

        $.ajax({
            url: "{{ route('admin.api.matkul.list') }}",
            method: 'GET',
            data: { id_program_studi, semester },
            success: function(data) {
                $tbody.empty();

                if (data.length === 0) {
                     // Empty State
                     const emptyHtml = `
                    <tr>
                        <td colspan="9" class="px-6 py-12 text-center">
                            <div class="flex flex-col items-center justify-center">
                                <div class="bg-gray-50 rounded-full p-6 mb-4">
                                    <svg class="w-12 h-12 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/></svg>
                                </div>
                                <h3 class="text-lg font-medium text-gray-900">Data Materi Ajar Kosong</h3>
                                <p class="text-gray-500 mt-1">Coba sesuaikan filter pencarian Anda.</p>
                            </div>
                        </td>
                    </tr>`;
                    $tbody.html(emptyHtml);
                } else {
                    data.forEach((mk, index) => {
                        const programStudiNama = mk.program_studi ? mk.program_studi.nama_program_studi : '-';
                        
                        // SAP Badge
                        const sapCell = mk.sap 
                            ? `<a href="/${mk.sap}" target="_blank" class="inline-flex items-center px-2 py-1 text-[10px] font-bold rounded-lg bg-[#004269]/10 text-[#004269] hover:bg-[#004269] hover:text-white transition uppercase tracking-wide border border-[#004269]/20">
                                <svg xmlns="http://www.w3.org/2000/svg" width="10" height="10" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" class="mr-1">
                                    <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path>
                                    <polyline points="14 2 14 8 20 8"></polyline>
                                </svg>
                                FILE SAP
                               </a>`
                            : `<span class="inline-flex items-center px-2 py-1 text-[10px] font-bold rounded-lg bg-gray-100 text-gray-400 uppercase tracking-wide border border-gray-200">
                                No File
                               </span>`;
                        
                        const row = `
                            <tr class="hover:bg-gray-50 transition-colors duration-200 group border-b border-gray-100 last:border-b-0">
                                <td class="px-3 py-3 text-center font-bold text-gray-500">
                                    ${index + 1}
                                </td>
                                <td class="px-3 py-3 whitespace-nowrap">
                                    <span class="font-mono text-xs text-[#004269] font-bold bg-[#004269]/5 px-1.5 py-0.5 rounded border border-[#004269]/10">${mk.kode_mk}</span>
                                </td>
                                <td class="px-3 py-3">
                                    <div class="text-xs font-bold text-gray-800 group-hover:text-[#004269] transition-colors">${mk.nama_mk}</div>
                                </td>
                                <td class="px-3 py-3 text-center">
                                    <span class="inline-flex items-center justify-center w-6 h-6 rounded-full bg-[#009DA5]/10 text-[#009DA5] text-xs font-bold border border-[#009DA5]/20">
                                        ${mk.sks}
                                    </span>
                                </td>
                                <td class="px-3 py-3 text-center">
                                     <span class="inline-flex items-center px-2 py-0.5 rounded text-[10px] font-bold bg-amber-50 text-amber-600 uppercase tracking-wide border border-amber-100">
                                        SMT ${mk.semester}
                                    </span>
                                </td>
                                <td class="px-3 py-3 text-xs text-gray-600 font-medium">${programStudiNama}</td>
                                <td class="px-3 py-3 whitespace-nowrap text-center">${sapCell}</td>
                                <td class="px-3 py-3 whitespace-nowrap text-center text-xs font-medium">
                                    <div class="flex justify-center space-x-1">
                                        <button data-id="${mk.id_mk}" title="Edit" class="btn-edit-matkul p-1.5 text-indigo-600 hover:text-indigo-900 hover:bg-indigo-50 rounded transition-all duration-200">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M17 3a2.85 2.85 0 0 1 4 4L7.5 20.5 2 22l1.5-5.5L17 3z"></path></svg>
                                        </button>
                                        <button data-id="${mk.id_mk}" title="Hapus" class="btn-delete-matkul p-1.5 text-rose-500 hover:text-rose-700 hover:bg-rose-50 rounded transition-all duration-200">
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
                Swal.fire({
                    icon: 'error',
                    title: 'Gagal Memuat Data',
                    text: 'Terjadi kesalahan saat mengambil data Materi Ajar.',
                    confirmButtonColor: '#004269'
                });
                console.error(xhr);
                $tbody.html('<tr><td colspan="9" class="px-6 py-10 text-center text-red-500 italic">Terjadi kesalahan saat memuat data.</td></tr>');
            },
            complete: function() {
                $('#btn-filter').prop('disabled', false).removeClass('opacity-75');
            }
        });
    }

    // TAMBAH MATKUL
    $('#btn-open-tambah-matkul-modal').click(function() {
        $('#tambah-matkul-modal').removeClass('hidden');
        // Load semester options for modal
        loadSemesterOptionsForSelect('#tambah-semester');
    });

    $('.close-tambah-matkul-modal').click(function() {
        $('#tambah-matkul-modal').addClass('hidden');
        $('#tambah-matkul-form')[0].reset();
    });
    
    // Function to load semester options for a specific select element
    function loadSemesterOptionsForSelect(selectId) {
        $.ajax({
            url: "{{ route('admin.api.matkul.filter-options') }}",
            method: 'GET',
            success: function(data) {
                const $select = $(selectId);
                const currentValue = $select.val();
                $select.find('option:not(:first)').remove();
                data.semesters.forEach(function(semester) {
                    $select.append(`<option value="${semester}">Semester ${semester}</option>`);
                });
                if (currentValue) $select.val(currentValue);
            }
        });
    }

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
                Swal.fire({
                    icon: 'success',
                    title: 'Berhasil!',
                    text: response.message,
                    confirmButtonColor: '#004269',
                    timer: 2000,
                    showConfirmButton: false
                });
                $('#tambah-matkul-modal').addClass('hidden');
                $('#tambah-matkul-form')[0].reset();
                renderTable();
                $('#btn-tambah-matkul').text('Simpan Data').prop('disabled', false);
            },
            error: function(xhr) {
                let errorMessage = 'Terjadi kesalahan pada server';
                
                if (xhr.status === 413) {
                    errorMessage = 'Ukuran file terlalu besar! Silakan upload file yang lebih kecil (Max upload server limited).';
                } else if (xhr.responseJSON) {
                    const res = xhr.responseJSON;
                    if (res.errors) {
                        errorMessage = Object.values(res.errors).flat().join('\n');
                    } else if (res.message) {
                        errorMessage = res.message;
                    }
                }

                Swal.fire({
                    icon: 'error',
                    title: 'Gagal Menyimpan',
                    text: errorMessage,
                    confirmButtonColor: '#004269'
                });
                $('#btn-tambah-matkul').text('Simpan Data').prop('disabled', false);
            }
        });
    });

    // EDIT MATKUL
    $(document).on('click', '.btn-edit-matkul', function() {
        const matkulId = $(this).data('id');
        const editUrl = "{{ route('admin.matkul.edit', ':id') }}".replace(':id', matkulId);

        // Load semester options first
        loadSemesterOptionsForSelect('#edit-semester');

        $.ajax({
            url: editUrl,
            method: 'GET',
            success: function(data) {
                $('#edit-matkul-id').val(data.id_mk);
                $('#edit-kode-mk').val(data.kode_mk);
                $('#edit-nama-mk').val(data.nama_mk);
                $('#edit-sks').val(data.sks);
                $('#edit-bobot-kompetensi').val(data.bobot_kompetensi);
                
                // Set semester after options are loaded
                setTimeout(() => {
                    $('#edit-semester').val(data.semester);
                }, 200);
                
                $('#edit-program-studi').val(data.id_program_studi);
                $('#edit-deskripsi').val(data.deskripsi);

                // Display current SAP file
                if (data.sap) {
                    const fileName = data.sap.split('/').pop();
                    $('#current-sap-name').html(`<a href="/${data.sap}" target="_blank" class="text-[#004269] hover:underline font-semibold flex items-center"><svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.172 7l-6.586 6.586a2 2 0 102.828 2.828l6.414-6.586a4 4 0 00-5.656-5.656l-6.415 6.585a6 6 0 108.486 8.486L20.5 13"/></svg>${fileName}</a>`);
                } else {
                    $('#current-sap-name').text('Tidak ada file');
                }

                $('#edit-matkul-modal').removeClass('hidden');
            },
            error: function(xhr) {
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'Gagal mengambil data Materi Ajar',
                    confirmButtonColor: '#004269'
                });
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
                Swal.fire({
                    icon: 'success',
                    title: 'Berhasil Update!',
                    text: response.message,
                    confirmButtonColor: '#004269',
                    timer: 2000,
                    showConfirmButton: false
                });
                $('#edit-matkul-modal').addClass('hidden');
                renderTable();
                $('#btn-update-matkul').text('Simpan Perubahan').prop('disabled', false);
            },
            error: function(xhr) {
                let errorMessage = 'Terjadi kesalahan pada server';
                
                if (xhr.status === 413) {
                    errorMessage = 'Ukuran file terlalu besar! Silakan upload file yang lebih kecil (Max upload server limited).';
                } else if (xhr.responseJSON) {
                    const res = xhr.responseJSON;
                    if (res.errors) {
                        errorMessage = Object.values(res.errors).flat().join('\n');
                    } else if (res.message) {
                        errorMessage = res.message;
                    }
                }

                Swal.fire({
                    icon: 'error',
                    title: 'Gagal Update',
                    text: errorMessage,
                    confirmButtonColor: '#004269'
                });
                $('#btn-update-matkul').text('Simpan Perubahan').prop('disabled', false);
            }
        });
    });

    // DELETE MATKUL
    $(document).on('click', '.btn-delete-matkul', function() {
        const matkulId = $(this).data('id');
        const matkulRow = $(this).closest('tr');
        const matkulName = matkulRow.find('td:eq(2) div').text(); // Adjust index based on column position (0=No, 1=Kode, 2=Nama)

        Swal.fire({
            title: 'Apakah Anda yakin?',
            text: `Hapus Materi Ajar "${matkulName}"? Data tidak dapat dikembalikan!`,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Ya, Hapus!',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                // Lakukan request penghapusan
                const deleteUrl = "{{ route('admin.matkul.destroy', ':id') }}".replace(':id', matkulId);

                $.ajax({
                    url: deleteUrl,
                    method: 'DELETE',
                    data: { _token: "{{ csrf_token() }}" },
                    success: function(response) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Terhapus!',
                            text: response.message,
                            confirmButtonColor: '#004269',
                            timer: 2000,
                            showConfirmButton: false
                        });
                        renderTable();
                    },
                    error: function(xhr) {
                        const res = xhr.responseJSON;
                        Swal.fire({
                            icon: 'error',
                            title: 'Gagal Menghapus',
                            text: res.message || 'Terjadi kesalahan',
                            confirmButtonColor: '#004269'
                        });
                    }
                });
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