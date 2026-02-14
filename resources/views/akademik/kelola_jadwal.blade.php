{{-- resources/views/akademik/kelola_jadwal.blade.php --}}

@extends('layouts.app')

@section('content')

<div class="p-6">
    {{-- Header Page --}}
    <div class="flex justify-between items-center mb-8">
        <div>
            <h1 class="text-2xl font-extrabold text-[#004269] tracking-tight">Kelola Jadwal Perkuliahan</h1>
            <p class="text-sm text-gray-500 mt-1">Atur jadwal, plot pendidik, dan alokasi ruangan kelas.</p>
        </div>
    </div>

    {{-- 1. Container Filter Utama --}}
    <div class="bg-white rounded-2xl shadow-xl shadow-gray-200/50 mb-8 overflow-hidden relative border border-gray-100">
        {{-- Decorative Top Bar --}}
        <div class="h-1.5 w-full bg-gradient-to-r from-[#004269] via-[#00536e] to-[#009DA5]"></div>

        <div class="p-6 md:p-8">
            {{-- Header Filter --}}
            <div class="flex items-center space-x-3 mb-6 border-b border-gray-100 pb-4">
                <div class="bg-[#004269]/10 p-2.5 rounded-xl text-[#004269]">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                    </svg>
                </div>
                <div>
                    <h2 class="text-lg font-bold text-gray-800">Filter Jadwal</h2>
                    <p class="text-xs text-gray-400 font-medium">Cari jadwal berdasarkan kriteria spesifik</p>
                </div>
            </div>

            {{-- Grid Input Filter --}}
            <div class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-6 gap-4">
                {{-- Program Studi --}}
                <div class="group col-span-1 md:col-span-2">
                    <label class="block text-xs font-bold text-gray-500 uppercase tracking-wider mb-2">Program Studi</label>
                    <select id="filter-program-studi" class="w-full p-2.5 text-sm font-medium text-gray-700 bg-gray-50 border border-gray-200 rounded-lg outline-none focus:bg-white focus:border-[#009DA5] focus:ring-2 focus:ring-[#009DA5]/20 transition-all">
                        <option value="all">Semua Program Studi</option>
                    </select>
                </div>

                {{-- Semester --}}
                <div class="group">
                    <label class="block text-xs font-bold text-gray-500 uppercase tracking-wider mb-2">Semester</label>
                    <select id="filter-semester" class="w-full p-2.5 text-sm font-medium text-gray-700 bg-gray-50 border border-gray-200 rounded-lg outline-none focus:bg-white focus:border-[#009DA5] focus:ring-2 focus:ring-[#009DA5]/20 transition-all">
                        <option value="all">Semua</option>
                        <option value="1">Smt 1</option>
                        <option value="2">Smt 2</option>
                        <option value="3">Smt 3</option>
                        <option value="4">Smt 4</option>
                    </select>
                </div>

                {{-- Kelas --}}
                <div class="group col-span-1 md:col-span-1">
                    <label class="block text-xs font-bold text-gray-500 uppercase tracking-wider mb-2">Kelas</label>
                    <select id="filter-kelas" class="w-full p-2.5 text-sm font-medium text-gray-700 bg-gray-50 border border-gray-200 rounded-lg outline-none focus:bg-white focus:border-[#009DA5] focus:ring-2 focus:ring-[#009DA5]/20 transition-all">
                        <option value="Semua Kelas">Semua Kelas</option>
                    </select>
                </div>
                
                {{-- Hari --}}
                <div class="group">
                    <label class="block text-xs font-bold text-gray-500 uppercase tracking-wider mb-2">Hari</label>
                    <select id="filter-hari" class="w-full p-2.5 text-sm font-medium text-gray-700 bg-gray-50 border border-gray-200 rounded-lg outline-none focus:bg-white focus:border-[#009DA5] focus:ring-2 focus:ring-[#009DA5]/20 transition-all">
                        <option value="">Semua Hari</option>
                        <option value="Senin">Senin</option>
                        <option value="Selasa">Selasa</option>
                        <option value="Rabu">Rabu</option>
                        <option value="Kamis">Kamis</option>
                        <option value="Jumat">Jumat</option>
                        <option value="Sabtu">Sabtu</option>
                    </select>
                </div>

                {{-- Ruangan --}}
                <div class="group">
                    <label class="block text-xs font-bold text-gray-500 uppercase tracking-wider mb-2">Ruangan</label>
                    <select id="filter-ruangan" class="w-full p-2.5 text-sm font-medium text-gray-700 bg-gray-50 border border-gray-200 rounded-lg outline-none focus:bg-white focus:border-[#009DA5] focus:ring-2 focus:ring-[#009DA5]/20 transition-all">
                        <option value="Semua Ruangan">Semua</option>
                    </select>
                </div>
            </div>

            {{-- Action Button --}}
            <div class="mt-6 flex justify-end">
                <button id="btn-filter" class="relative overflow-hidden group bg-[#004269] hover:bg-[#003350] text-white pl-6 pr-8 py-2.5 rounded-xl font-bold transition-all duration-300 shadow-[0_4px_14px_0_rgba(0,66,105,0.39)] hover:shadow-[0_6px_20px_rgba(0,66,105,0.23)] hover:-translate-y-1 active:translate-y-0 flex items-center">
                    <span class="absolute right-0 w-8 h-32 -mt-12 transition-all duration-1000 transform translate-x-12 bg-white opacity-10 rotate-12 group-hover:-translate-x-40 ease"></span>
                    <svg class="w-5 h-5 mr-2 animate-pulse" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                    Tampilkan Jadwal
                </button>
            </div>
        </div>
    </div>

    {{-- 2. TABLE SECTION --}}
    <div class="bg-white rounded-2xl shadow-xl shadow-gray-200/50 overflow-hidden mb-6 border border-gray-100">
        {{-- Header Tabel with Gradient --}}
        <div class="p-5 border-b bg-gradient-to-r from-[#004269] to-[#009DA5]">
            <div class="flex flex-col md:flex-row justify-between items-center gap-4">
                <div class="flex items-center space-x-3">
                    <div class="bg-white/20 p-2 rounded-lg backdrop-blur-sm">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    </div>
                    <h3 class="text-xl font-bold text-white tracking-wide">Daftar Jadwal <span class="bg-white/20 px-2 py-0.5 rounded text-sm font-mono ml-2" id="jadwal-count">0</span></h3>
                </div>

                {{-- BUTTON TAMBAH DI HEADER TABEL --}}
                <div class="flex space-x-3">
                    <button id="btn-open-tambah-jadwal-modal" class="bg-white text-[#004269] px-4 py-2 rounded-lg font-bold hover:bg-gray-50 transition-all duration-200 shadow-lg shadow-black/10 flex items-center transform hover:scale-105 active:scale-95 text-sm">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                            <line x1="12" y1="5" x2="12" y2="19"></line>
                            <line x1="5" y1="12" x2="19" y2="12"></line>
                        </svg>
                        Tambah Jadwal
                    </button>
                </div>
            </div>
        </div>
        
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-3 py-3 text-left text-sm font-extrabold text-[#004269] uppercase tracking-wider w-[100px] border-b-2 border-gray-200">Hari</th>
                        <th class="px-3 py-3 text-left text-sm font-extrabold text-[#004269] uppercase tracking-wider w-[140px] border-b-2 border-gray-200">Waktu</th>
                        <th class="px-3 py-3 text-left text-sm font-extrabold text-[#004269] uppercase tracking-wider min-w-[250px] border-b-2 border-gray-200">Materi Ajar</th>
                        <th class="px-3 py-3 text-left text-sm font-extrabold text-[#004269] uppercase tracking-wider w-[200px] border-b-2 border-gray-200">Pendidik</th>
                        <th class="px-3 py-3 text-center text-sm font-extrabold text-[#004269] uppercase tracking-wider w-[100px] border-b-2 border-gray-200">Kelas</th>
                        <th class="px-3 py-3 text-center text-sm font-extrabold text-[#004269] uppercase tracking-wider w-[120px] border-b-2 border-gray-200">Ruangan</th>
                        <th class="px-3 py-3 text-center text-sm font-extrabold text-[#004269] uppercase tracking-wider w-[100px] border-b-2 border-gray-200">Aksi</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-100 text-sm" id="jadwal-table-body">
                    <tr>
                        <td colspan="7" class="px-6 py-10 text-center text-gray-500 italic">
                             <div class="flex flex-col items-center justify-center">
                                <span class="text-sm font-medium text-gray-400">Silakan klik tombol "Tampilkan Jadwal" untuk memuat.</span>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div id="no-data-message" class="hidden bg-gray-50 px-6 py-8 border-t border-gray-100 flex flex-col items-center justify-center text-center">
            <svg class="w-12 h-12 text-gray-300 mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
            <p class="text-gray-500 font-medium">Tidak ada jadwal yang ditemukan.</p>
        </div>
    </div>
</div>

{{-- MODALS --}}
@include('components.tambah_jadwal_modal')
@include('components.edit_jadwal_modal')

{{-- Toast Notification Container --}}
<div id="toast-container" class="fixed top-4 right-4 z-50 space-y-2"></div>

@endsection

@push('scripts')
<script>
$(document).ready(function() {
    
    // Setup CSRF Token
    $.ajaxSetup({ headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') } });

    // Toast Notification Function
    function showToast(message, type = 'success') {
        const colors = {
            success: 'bg-green-500',
            error: 'bg-red-500',
            info: 'bg-blue-500',
            warning: 'bg-yellow-500'
        };
        
        const icons = {
            success: '<svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>',
            error: '<svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>',
            info: '<svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>',
            warning: '<svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path></svg>'
        };
        
        const toast = $(`
            <div class="flex items-center gap-3 ${colors[type]} text-white px-4 py-3 rounded-lg shadow-lg transform transition-all duration-300 translate-x-full opacity-0 min-w-[300px]">
                <div class="flex-shrink-0">${icons[type]}</div>
                <p class="flex-1 text-sm font-medium">${message}</p>
                <button class="flex-shrink-0 hover:bg-white/20 rounded p-1 transition-colors" onclick="$(this).parent().remove()">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                </button>
            </div>
        `);
        
        $('#toast-container').append(toast);
        
        setTimeout(() => { toast.removeClass('translate-x-full opacity-0'); }, 10);
        setTimeout(() => {
            toast.addClass('translate-x-full opacity-0');
            setTimeout(() => toast.remove(), 300);
        }, 3000);
    }

    let dropdownData = { program_studi: [], ruangan: [] };
    let mataKuliahCache = {};
    let kelasCache = {};
    let pendidikCache = {};

    // TIME SLOTS DATA based on SKS
    const timeSlots = {
        0: ['08:00 - 09:40', '09:50 - 11:30', '13:00 - 14:40', '14:50 - 16:30', '16:40 - 18:20', '18:30 - 20:10', '20:20 - 22:00'],
        1: ['08:00 - 08:50', '09:00 - 09:50', '10:00 - 10:50', '11:00 - 11:50', '13:00 - 13:50', '14:00 - 14:50', '15:00 - 15:50'],
        2: ['08:00 - 09:40', '09:50 - 11:30', '13:00 - 14:40', '14:50 - 16:30', '16:40 - 18:20', '18:30 - 20:10', '20:20 - 22:00'],
        3: ['08:00 - 10:30', '10:40 - 13:10', '13:20 - 15:50', '16:00 - 18:30', '18:30 - 21:00'],
        4: ['08:00 - 11:30', '13:00 - 16:30', '16:40 - 20:10', '20:20 - 22:00']
    };

    function updateTimeSlots(modalPrefix, sks) {
        const $waktuDropdown = $(`#${modalPrefix}-waktu`);
        $waktuDropdown.empty();
        
        // Convert to string key just to be safe, though timeSlots[0] works with int key too
        // Fallback to 2 SKS if sks is defined but not in list
        const slots = timeSlots[sks] || timeSlots[2]; 
        
        if (sks === undefined || sks === null) { 
            $waktuDropdown.append('<option value="">-- Pilih Materi Ajar Dulu --</option>'); 
            return; 
        }
        $waktuDropdown.append('<option value="">-- Pilih Waktu --</option>');
        timeSlots[sks].forEach(slot => { $waktuDropdown.append(`<option value="${slot}">${slot}</option>`); });
    }

    // 1. LOAD DROPDOWN DATA
    function loadDropdownData() {
        $.ajax({
            url: "{{ route('admin.api.jadwal.dropdown') }}",
            method: 'GET',
            success: function(data) {
                dropdownData = data;
                populateProgramStudiDropdowns();
                populateRuanganDropdowns();
            },
            error: function(xhr) { console.error('Error loading dropdown data', xhr); }
        });
        loadPendidikList();
    }

    function loadPendidikList() {
        $.ajax({
            url: "{{ route('admin.api.pendidik.list') }}",
            method: 'GET',
            success: function(data) {
                pendidikCache['all'] = data;
                populatePendidikDropdowns(data);
            }
        });
    }

    function populateProgramStudiDropdowns() {
        if (!dropdownData.program_studi || dropdownData.program_studi.length === 0) {
            console.warn('Program Studi data is empty');
            return;
        }
        const selectors = ['#filter-program-studi', '#tambah-program-studi', '#edit-program-studi'];
        selectors.forEach(selector => {
            const $select = $(selector);
            $select.find('option:not(:first)').remove();
            dropdownData.program_studi.forEach(ps => {
                $select.append(`<option value="${ps.id_program_studi}">${ps.nama_program_studi} (${ps.kode_program_studi})</option>`);
            });
        });
        loadFilterKelas('all');
    }

    function populateRuanganDropdowns() {
        const selectors = ['#filter-ruangan', '#tambah-id-ruangan', '#edit-id-ruangan'];
        selectors.forEach(selector => {
            const $select = $(selector);
            $select.find('option:not(:first)').remove();
            if (dropdownData.ruangan) {
                dropdownData.ruangan.forEach(r => {
                    $select.append(`<option value="${r.id_ruangan}">${r.nama_ruangan}</option>`);
                });
            }
        });
    }

    function populatePendidikDropdowns(pendidikData) {
        const selectors = ['#tambah-id-pendidik', '#edit-id-pendidik'];
        selectors.forEach(selector => {
            const $select = $(selector);
            $select.find('option:not(:first)').remove();
            pendidikData.forEach(p => {
                $select.append(`<option value="${p.id_pendidik}">${p.nama_pendidik}</option>`);
            });
        });
    }

    // 2. LOAD DATA HELPERS
    function loadKelas(id_program_studi, modalPrefix, callback) {
        const cacheKey = id_program_studi || 'all';
        if (kelasCache[cacheKey]) { 
            populateKelasDropdown(kelasCache[cacheKey], modalPrefix);
            if(callback) callback();
            return; 
        }
        $.ajax({
            url: "{{ route('admin.api.jadwal.kelas_filtered') }}",
            method: 'GET',
            data: { id_program_studi: id_program_studi || 'all' },
            success: function(data) {
                kelasCache[cacheKey] = data;
                populateKelasDropdown(data, modalPrefix);
                if(callback) callback();
            }
        });
    }

    function loadFilterKelas(id_program_studi) {
        $.ajax({
            url: "{{ route('admin.api.jadwal.kelas_filtered') }}",
            method: 'GET',
            data: { id_program_studi: id_program_studi || 'all' },
            success: function(data) {
                const $select = $('#filter-kelas');
                $select.find('option:not(:first)').remove();
                
                const seenNames = new Set();
                const uniqueKelas = [];
                data.forEach(k => {
                    if (!seenNames.has(k.nama_kelas)) {
                        seenNames.add(k.nama_kelas);
                        uniqueKelas.push(k);
                    }
                });
                
                uniqueKelas.forEach(k => { 
                    $select.append(`<option value="${k.id_kelas}">${k.nama_kelas}</option>`); 
                });
            }
        });
    }

    function populateKelasDropdown(kelasData, modalPrefix) {
        const $select = $(`#${modalPrefix}-id-kelas`);
        $select.find('option:not(:first)').remove();
        $select.prop('disabled', false);
        if (kelasData.length === 0) { $select.append('<option value="">-- Tidak Ada Kelas --</option>'); return; }
        
        const seenNames = new Set();
        const uniqueKelas = [];
        kelasData.forEach(k => {
            if (!seenNames.has(k.nama_kelas)) {
                seenNames.add(k.nama_kelas);
                uniqueKelas.push(k);
            }
        });
        
        uniqueKelas.forEach(k => { $select.append(`<option value="${k.id_kelas}">${k.nama_kelas}</option>`); });
    }

    function loadMataKuliah(id_program_studi, semester, modalPrefix, callback) {
        const cacheKey = `${id_program_studi || 'all'}_${semester || 'all'}`;
        if (mataKuliahCache[cacheKey]) { 
            populateMataKuliahDropdown(mataKuliahCache[cacheKey], modalPrefix);
            if(callback) callback();
            return; 
        }
        $.ajax({
            url: "{{ route('admin.api.jadwal.matkul_filtered') }}",
            method: 'GET',
            data: { id_program_studi: id_program_studi || 'all', semester: semester || 'all' },
            success: function(data) {
                mataKuliahCache[cacheKey] = data;
                populateMataKuliahDropdown(data, modalPrefix);
                if(callback) callback();
            }
        });
    }

    function populateMataKuliahDropdown(matkulData, modalPrefix) {
        const $select = $(`#${modalPrefix}-id-mk`);
        $select.find('option:not(:first)').remove();
        $select.prop('disabled', false);
        if (matkulData.length === 0) { $select.append('<option value="">-- Tidak Ada Materi Ajar --</option>'); return; }
        matkulData.forEach(mk => { $select.append(`<option value="${mk.id_mk}" data-sks="${mk.sks}">${mk.kode_mk} - ${mk.nama_mk} (${mk.sks} SKS)</option>`); });
    }

    // 3. EVENT HANDLERS - TAMBAH & EDIT MODAL (Combined Logic)
    const setupCascading = (prefix) => {
        $(document).on('change', `#${prefix}-program-studi`, function() {
            const id_ps = $(this).val();
            if (id_ps) {
                // Enable semester dropdown when program studi is selected
                $(`#${prefix}-semester`).prop('disabled', false);
                loadKelas(id_ps, prefix);
            } else {
                // Disable semester if no program studi selected
                $(`#${prefix}-semester`).prop('disabled', true).val('');
            }
            $(`#${prefix}-id-mk`).html('<option value="">-- Pilih Semester Dulu --</option>').prop('disabled', true);
        });

        $(document).on('change', `#${prefix}-semester`, function() {
            const semester = $(this).val();
            const id_ps = $(`#${prefix}-program-studi`).val();
            if (semester && id_ps) {
                loadMataKuliah(id_ps, semester, prefix);
            }
        });

        $(document).on('change', `#${prefix}-id-mk`, function() {
            const sks = $(this).find(':selected').data('sks');
            if (sks !== undefined && sks !== null) {
                $(`#${prefix}-sks-info`).removeClass('hidden').text(`SKS: ${sks}`);
                updateTimeSlots(prefix, sks);
            } else {
                $(`#${prefix}-sks-info`).addClass('hidden');
                updateTimeSlots(prefix, null);
            }
        });
    };

    setupCascading('tambah');
    setupCascading('edit');

    $(document).on('change', '#filter-program-studi', function() { loadFilterKelas($(this).val()); });

    // 4. RENDER TABLE
    function renderTable() {
        const filters = {
            id_program_studi: $('#filter-program-studi').val(),
            semester: $('#filter-semester').val(),
            id_kelas: $('#filter-kelas').val(),
            hari: $('#filter-hari').val(),
            id_ruangan: $('#filter-ruangan').val()
        };

        const $tbody = $('#jadwal-table-body');
        $tbody.html('<tr><td colspan="7" class="px-6 py-16 text-center"><div class="inline-flex items-center px-4 py-2 font-semibold leading-6 text-sm shadow rounded-md text-white bg-[#004269] transition ease-in-out duration-150 cursor-not-allowed"><svg class="animate-spin -ml-1 mr-3 h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path></svg>Sedang memuat data...</div></td></tr>');
        $('#btn-filter').prop('disabled', true).addClass('opacity-75');

        $.ajax({
            url: "{{ route('admin.api.jadwal.list') }}",
            method: 'GET',
            data: filters,
            success: function(data) {
                $tbody.empty();
                if (data.length === 0) {
                    $('#no-data-message').removeClass('hidden');
                    $tbody.closest('table').addClass('hidden');
                } else {
                    $('#no-data-message').addClass('hidden');
                    $tbody.closest('table').removeClass('hidden');
                    data.forEach(j => {
                        const waktu = j.jam_mulai && j.jam_selesai ? `${j.jam_mulai} - ${j.jam_selesai}` : '-';
                        const row = `
                            <tr class="hover:bg-gray-50 transition-colors duration-200 group border-b border-gray-100 last:border-b-0">
                                <td class="px-3 py-3 text-sm font-bold text-gray-700">${j.hari}</td>
                                <td class="px-3 py-3 whitespace-nowrap">
                                    <span class="font-mono text-sm text-[#004269] font-bold bg-[#004269]/5 px-2 py-1 rounded border border-[#004269]/10">${waktu}</span>
                                </td>
                                <td class="px-3 py-3 text-sm font-bold text-gray-800 group-hover:text-[#004269] transition-colors">${j.mata_kuliah ? j.mata_kuliah.nama_mk : '-'}</td>
                                <td class="px-3 py-3 text-sm text-gray-600 font-medium">${j.pendidik ? j.pendidik.nama_pendidik : '-'}</td>
                                <td class="px-3 py-3 text-center text-sm font-bold text-gray-700">
                                    ${j.kelas ? `<span class="bg-gray-100 px-2.5 py-1 rounded border border-gray-200">${j.kelas.nama_kelas}</span>` : '-'}
                                </td>
                                <td class="px-3 py-3 text-center text-sm font-bold text-gray-700">
                                    ${j.ruangan ? `<span class="bg-blue-50 text-blue-700 px-2.5 py-1 rounded border border-blue-100">${j.ruangan.nama_ruangan}</span>` : '-'}
                                </td>
                                <td class="px-3 py-3 text-center whitespace-nowrap text-sm font-medium">
                                    <div class="flex justify-center space-x-1">
                                        <button data-id="${j.id_jadwal}" title="Edit" class="btn-edit-jadwal p-1.5 text-indigo-600 hover:text-indigo-900 hover:bg-indigo-50 rounded transition-all duration-200">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M17 3a2.85 2.85 0 0 1 4 4L7.5 20.5 2 22l1.5-5.5L17 3z"></path></svg>
                                        </button>
                                        <button data-id="${j.id_jadwal}" title="Hapus" class="btn-delete-jadwal p-1.5 text-rose-500 hover:text-rose-700 hover:bg-rose-50 rounded transition-all duration-200">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M3 6h18"></path><path d="M19 6v14c0 1-1 2-2 2H7c-1 0-2-1-2-2V6"></path><path d="M8 6V4c0-1 1-2 2-2h4c1 0 2 1 2 2v2"></path></svg>
                                        </button>
                                    </div>
                                </td>
                            </tr>`;
                        $tbody.append(row);
                    });
                }
                $('#jadwal-count').text(data.length);
            },
            complete: function() { $('#btn-filter').prop('disabled', false).removeClass('opacity-75'); }
        });
    }

    // 5. MODAL & ACTIONS
    $('#btn-open-tambah-jadwal-modal').click(function() { 
        $('#tambah-jadwal-modal').removeClass('hidden'); 
    });

    $('.close-tambah-jadwal-modal').click(function() { $('#tambah-jadwal-modal').addClass('hidden'); $('#tambah-jadwal-form')[0].reset(); });
    $('.close-edit-jadwal-modal').click(function() { $('#edit-jadwal-modal').addClass('hidden'); });

    $('#tambah-jadwal-form').submit(function(e) {
        e.preventDefault();
        $('#btn-tambah-jadwal').text('Menyimpan...').prop('disabled', true);
        $.ajax({
            url: "{{ route('admin.jadwal.store') }}",
            method: 'POST',
            data: $(this).serialize(),
            success: function(response) {
                showToast(response.message, 'success');
                $('#tambah-jadwal-modal').addClass('hidden');
                $('#tambah-jadwal-form')[0].reset();
                renderTable();
            },
            error: function(xhr) { showToast('Gagal: ' + (xhr.responseJSON?.message || 'Terjadi kesalahan'), 'error'); },
            complete: function() { $('#btn-tambah-jadwal').text('Simpan Data').prop('disabled', false); }
        });
    });

    $(document).on('click', '.btn-edit-jadwal', function() {
        // Reset form first
        $('#edit-jadwal-form')[0].reset();
        
        const jadwalId = $(this).data('id');
        const url = "{{ route('admin.jadwal.edit', ':id') }}".replace(':id', jadwalId);
        
        $.get(url, function(data) {
            $('#edit-jadwal-id').val(data.id_jadwal);
            
            // 1. Set Program Studi & Semester
            const id_program_studi = data.mata_kuliah?.id_program_studi;
            const semester = data.semester;
            
            $('#edit-program-studi').val(id_program_studi);
            $('#edit-semester').val(semester).prop('disabled', false);

            $('#edit-id-pendidik').val(data.id_pendidik);
            $('#edit-hari').val(data.hari);
            $('#edit-id-ruangan').val(data.id_ruangan);

            // 2. Load Cascading Options with Callbacks
            // Load Kelas first
            loadKelas(id_program_studi, 'edit', function() {
                $('#edit-id-kelas').val(data.id_kelas);
            });

            // Load Matkul, then set value, then trigger change for time slots
            loadMataKuliah(id_program_studi, semester, 'edit', function() {
                $('#edit-id-mk').val(data.id_mk).trigger('change');
                
                // Set time slot after trigger change logic runs
                const waktu = data.jam_mulai && data.jam_selesai ? `${data.jam_mulai} - ${data.jam_selesai}` : '';
                // Wait small microtask because trigger('change') might have async part or UI update
                setTimeout(() => {
                    $('#edit-waktu').val(waktu);
                }, 50);
            });

            $('#edit-jadwal-modal').removeClass('hidden');
        }).fail(function() {
            showToast('Gagal mengambil data jadwal', 'error');
        });
    });

    $('#edit-jadwal-form').submit(function(e) {
        e.preventDefault();
        $('#btn-update-jadwal').text('Menyimpan...').prop('disabled', true);
        $.ajax({
            url: "{{ route('admin.jadwal.update', ':id') }}".replace(':id', $('#edit-jadwal-id').val()),
            method: 'PUT',
            data: $(this).serialize(),
            success: function(response) {
                showToast(response.message, 'success');
                $('#edit-jadwal-modal').addClass('hidden');
                renderTable();
            },
            error: function(xhr) { showToast('Gagal: ' + (xhr.responseJSON?.message || 'Terjadi kesalahan'), 'error'); },
            complete: function() { $('#btn-update-jadwal').text('Simpan Perubahan').prop('disabled', false); }
        });
    });

    $(document).on('click', '.btn-delete-jadwal', function() {
        if (!confirm('Hapus jadwal ini?\n\nData tidak dapat dikembalikan!')) return;
        $.ajax({
            url: "{{ route('admin.jadwal.destroy', ':id') }}".replace(':id', $(this).data('id')),
            method: 'DELETE',
            data: { _token: "{{ csrf_token() }}" },
            success: function(response) { showToast(response.message, 'success'); renderTable(); },
            error: function() { showToast('Gagal menghapus data', 'error'); }
        });
    });

    $('#btn-filter').click(function() { renderTable(); });
    loadDropdownData();
});
</script>
@endpush