{{-- resources/views/akademik/kelola_jadwal.blade.php --}}

@extends('layouts.app')

@section('content')

<div class="min-h-screen bg-gray-50 p-4 md:p-8 font-sans">
    <div class="flex items-center justify-between space-x-4 text-gray-800 border-b border-gray-200 pb-4 mb-6">
        <div class="flex items-center space-x-4">
            <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect>
                <line x1="16" y1="2" x2="16" y2="6"></line>
                <line x1="8" y1="2" x2="8" y2="6"></line>
                <line x1="3" y1="10" x2="21" y2="10"></line>
            </svg>
            <h1 class="text-2xl font-extrabold tracking-tight">Kelola Jadwal</h1>
        </div>
        <button id="btn-open-tambah-jadwal-modal" class="px-4 py-2 bg-[#009DA5] hover:bg-[#00888f] text-white rounded-md transition flex items-center space-x-2">
            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <line x1="12" y1="5" x2="12" y2="19"></line>
                <line x1="5" y1="12" x2="19" y2="12"></line>
            </svg>
            <span>Tambah Jadwal</span>
        </button>
    </div>

    {{-- FILTER SECTION WITH CASCADING--}}
    <div class="bg-white p-6 rounded-xl shadow-lg mb-6 border-t-4 border-[#004269]">
        <h2 class="text-lg font-semibold text-[#004269] mb-4">Filter Data</h2>
        
        <div class="grid grid-cols-2 md:grid-cols-6 gap-4">
            {{-- Bidang Keahlian --}}
            <div class="flex flex-col space-y-1">
                <label for="filter-bidang-keahlian" class="text-sm font-medium text-gray-700">Bidang Keahlian</label>
                <select id="filter-bidang-keahlian" class="p-2 border border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500">
                    <option value="all">Semua Prodi</option>
                </select>
            </div>

            {{-- Semester --}}
            <div class="flex flex-col space-y-1">
                <label for="filter-semester" class="text-sm font-medium text-gray-700">Semester</label>
                <select id="filter-semester" class="p-2 border border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500">
                    <option value="all">Semua Semester</option>
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

            {{-- Kelas --}}
            <div class="flex flex-col space-y-1">
                <label for="filter-kelas" class="text-sm font-medium text-gray-700">Kelas</label>
                <select id="filter-kelas" class="p-2 border border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500">
                    <option value="Semua Kelas">Semua Kelas</option>
                </select>
            </div>
            
            {{-- Hari --}}
            <div class="flex flex-col space-y-1">
                <label for="filter-hari" class="text-sm font-medium text-gray-700">Hari</label>
                <select id="filter-hari" class="p-2 border border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500">
                    <option value="Semua Hari">Semua Hari</option>
                    <option value="Senin">Senin</option>
                    <option value="Selasa">Selasa</option>
                    <option value="Rabu">Rabu</option>
                    <option value="Kamis">Kamis</option>
                    <option value="Jumat">Jumat</option>
                    <option value="Sabtu">Sabtu</option>
                </select>
            </div>

            {{-- Ruangan --}}
            <div class="flex flex-col space-y-1">
                <label for="filter-ruangan" class="text-sm font-medium text-gray-700">Ruangan</label>
                <select id="filter-ruangan" class="p-2 border border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500">
                    <option value="Semua Ruangan">Semua Ruangan</option>
                </select>
            </div>

            {{-- Button Filter --}}
            <div class="flex items-end">
               <button id="btn-filter" class="w-full px-4 py-2 bg-[#004269] hover:bg-[#003350] text-white rounded-lg transition flex items-center justify-center space-x-2">
                    <svg class="w-4 h-4 mr-2" width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                    <span>Tampilkan</span>
                </button>
            </div>
        </div>
    </div>

    {{-- TABLE SECTION --}}
    <div class="bg-white p-4 md:p-6 rounded-xl shadow-lg border border-gray-100">
        <h2 class="text-xl font-semibold text-gray-700 mb-4">Daftar Jadwal (<span id="jadwal-count">0</span> data)</h2>
        <div class="overflow-x-auto rounded-lg border border-gray-200">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-bold text-gray-600 uppercase tracking-wider w-[100px]">Hari</th>
                        <th class="px-6 py-3 text-left text-xs font-bold text-gray-600 uppercase tracking-wider w-[100px]">Waktu</th>
                        <th class="px-6 py-3 text-left text-xs font-bold text-gray-600 uppercase tracking-wider min-w-[300px]">Mata Kuliah</th>
                        <th class="px-6 py-3 text-left text-xs font-bold text-gray-600 uppercase tracking-wider w-[200px]">Dosen</th>
                        <th class="px-6 py-3 text-left text-xs font-bold text-gray-600 uppercase tracking-wider w-[150px]">Kelas</th>
                        <th class="px-6 py-3 text-left text-xs font-bold text-gray-600 uppercase tracking-wider w-[150px]">Ruangan</th>
                        <th class="px-6 py-3 text-center text-xs font-bold text-gray-600 uppercase tracking-wider w-[180px]">Status</th>
                        <th class="px-6 py-3 text-center text-xs font-bold text-gray-600 uppercase tracking-wider w-[100px]">Aksi</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200" id="jadwal-table-body">
                    {{-- Data akan diisi oleh JavaScript --}}
                </tbody>
            </table>
            <div id="no-data-message" class="text-center py-10 text-gray-500 hidden">
                <p>Tidak ada jadwal yang sesuai dengan filter.</p>
            </div>
        </div>
    </div>
</div>

{{-- MODALS --}}
@include('components.tambah_jadwal_modal')
@include('components.edit_jadwal_modal')

@endsection

@push('scripts')
<script>
$(document).ready(function() {
    
    let dropdownData = {
        bidang_keahlian: [],
        ruangan: []
    };
    let mataKuliahCache = {};
    let kelasCache = {};
    let dosenCache = {};

    // TIME SLOTS DATA
    const timeSlots = {
        2: [
            '08:00 - 09:40',
            '09:50 - 11:30',
            '13:00 - 14:40',
            '14:50 - 16:30',
            '16:40 - 18:20',
            '18:30 - 20:10',
            '20:20 - 22:00'
        ],
        3: [
            '08:00 - 10:30',
            '10:40 - 13:10',
            '13:20 - 15:50'
        ],
        4: [
            '08:00 - 11:30',
            '13:00 - 16:30',
            '16:40 - 20:10',
            '20:20 - 22:00'
        ]
    };

    // 1. LOAD BIDANG KEAHLIAN & RUANGAN & DOSEN
    function loadDropdownData() {
        $.ajax({
            url: "{{ route('admin.api.jadwal.dropdown') }}",
            method: 'GET',
            success: function(data) {
                dropdownData = data;
                populateBidangKeahlianDropdowns();
                populateRuanganDropdowns();
            },
            error: function(xhr) {
                console.error('Error loading dropdown data', xhr);
            }
        });
    }

    function populateBidangKeahlianDropdowns() {
        const selectors = ['#filter-bidang-keahlian', '#tambah-bidang-keahlian', '#edit-bidang-keahlian'];
        
        selectors.forEach(selector => {
            const $select = $(selector);
            $select.find('option:not(:first)').remove();
            
            dropdownData.bidang_keahlian.forEach(bk => {
                const isFilter = selector.includes('filter');
                const option = `<option value="${bk.id_bidang_keahlian}">${bk.nama} (${bk.kode})</option>`;
                $select.append(option);
            });
        });

        // Populate filter kelas initially (all kelas)
        loadFilterKelas('all');
    }

    function populateRuanganDropdowns() {
        const selectors = ['#filter-ruangan', '#tambah-id-ruangan', '#edit-id-ruangan'];
        
        selectors.forEach(selector => {
            const $select = $(selector);
            $select.find('option:not(:first)').remove();
            
            dropdownData.ruangan.forEach(r => {
                $select.append(`<option value="${r.id_ruangan}">${r.nama_ruangan}</option>`);
            });
        });
    }

    // 3. CASCADING: Load Dosen by Mata Kuliah
    function loadDosen(id_matkul, modalPrefix) {
        const cacheKey = id_matkul || 'all';
        
        if (dosenCache[cacheKey]) {
            populateDosenDropdown(dosenCache[cacheKey], modalPrefix);
            return;
        }

        $.ajax({
            url: "{{ route('admin.api.jadwal.dosen_filtered') }}",
            method: 'GET',
            data: { id_matkul: id_matkul || 'all' },
            success: function(data) {
                dosenCache[cacheKey] = data;
                populateDosenDropdown(data, modalPrefix);
            },
            error: function(xhr) {
                console.error('Error loading dosen', xhr);
            }
        });
    }

    function populateDosenDropdown(dosenData, modalPrefix) {
        const $select = $(`#${modalPrefix}-id-dosen`);
        $select.find('option:not(:first)').remove();
        $select.prop('disabled', false);

        if (dosenData.length === 0) {
            $select.append('<option value="">-- Tidak Ada Dosen --</option>');
            return;
        }

        dosenData.forEach(d => {
            $select.append(`<option value="${d.id_dosen}">${d.nama_dosen} (${d.nidn})</option>`);
        });
    }

    // 4. CASCADING: Load Kelas by Bidang Keahlian and Semester
    function loadKelas(id_bidang_keahlian, semester, modalPrefix) {
        const cacheKey = `${id_bidang_keahlian || 'all'}_${semester || 'all'}`;
        
        if (kelasCache[cacheKey]) {
            populateKelasDropdown(kelasCache[cacheKey], modalPrefix);
            return;
        }

        $.ajax({
            url: "{{ route('admin.api.jadwal.kelas_filtered') }}",
            method: 'GET',
            data: { 
                id_bidang_keahlian: id_bidang_keahlian || 'all',
                semester: semester || 'all'
            },
            success: function(data) {
                kelasCache[cacheKey] = data;
                populateKelasDropdown(data, modalPrefix);
            },
            error: function(xhr) {
                console.error('Error loading kelas', xhr);
            }
        });
    }

    function loadFilterKelas(id_bidang_keahlian) {
        $.ajax({
            url: "{{ route('admin.api.jadwal.kelas_filtered') }}",
            method: 'GET',
            data: { id_bidang_keahlian: id_bidang_keahlian || 'all' },
            success: function(data) {
                const $select = $('#filter-kelas');
                $select.find('option:not(:first)').remove();
                
                data.forEach(k => {
                    const prodiInfo = k.bidang_keahlian ? ` - ${k.bidang_keahlian.kode}` : '';
                    $select.append(`<option value="${k.id_kelas}">${k.nama_kelas}${prodiInfo}</option>`);
                });
            }
        });
    }

    function populateKelasDropdown(kelasData, modalPrefix) {
        const $select = $(`#${modalPrefix}-id-kelas`);
        $select.find('option:not(:first)').remove();
        $select.prop('disabled', false);

        if (kelasData.length === 0) {
            $select.append('<option value="">-- Tidak Ada Kelas --</option>');
            return;
        }

        kelasData.forEach(k => {
            const prodiInfo = k.bidang_keahlian ? ` - ${k.bidang_keahlian.kode}` : '';
            $select.append(`<option value="${k.id_kelas}">${k.nama_kelas}${prodiInfo}</option>`);
        });
    }

    // 3. CASCADING: Load Mata Kuliah by Bidang Keahlian + Semester
    function loadMataKuliah(id_bidang_keahlian, semester, modalPrefix) {
        const cacheKey = `${id_bidang_keahlian || 'all'}_${semester || 'all'}`;
        
        if (mataKuliahCache[cacheKey]) {
            populateMataKuliahDropdown(mataKuliahCache[cacheKey], modalPrefix);
            return;
        }

        $.ajax({
            url: "{{ route('admin.api.jadwal.matkul_filtered') }}",
            method: 'GET',
            data: { 
                id_bidang_keahlian: id_bidang_keahlian || 'all',
                semester: semester || 'all'
            },
            success: function(data) {
                mataKuliahCache[cacheKey] = data;
                populateMataKuliahDropdown(data, modalPrefix);
            },
            error: function(xhr) {
                console.error('Error loading mata kuliah', xhr);
            }
        });
    }

    function populateMataKuliahDropdown(matkulData, modalPrefix) {
        const $select = $(`#${modalPrefix}-id-matkul`);
        $select.find('option:not(:first)').remove();
        $select.prop('disabled', false);

        if (matkulData.length === 0) {
            $select.append('<option value="">-- Tidak Ada Mata Kuliah --</option>');
            return;
        }

        matkulData.forEach(mk => {
            $select.append(`<option value="${mk.id_matkul}" data-sks="${mk.sks}">${mk.kode_mk} - ${mk.nama_mk} (${mk.sks} SKS)</option>`);
        });
    }

    // 4. UPDATE TIME SLOTS based on SKS
    function updateTimeSlots(modalPrefix, sks) {
        const $waktuDropdown = $(`#${modalPrefix}-waktu`);
        $waktuDropdown.empty();

        if (!sks || !timeSlots[sks]) {
            $waktuDropdown.append('<option value="">-- Pilih Mata Kuliah Dulu --</option>');
            return;
        }

        $waktuDropdown.append('<option value="">-- Pilih Waktu --</option>');
        timeSlots[sks].forEach(slot => {
            $waktuDropdown.append(`<option value="${slot}">${slot}</option>`);
        });
    }

    // 5. CASCADING EVENT HANDLERS - TAMBAH MODAL
    $(document).on('change', '#tambah-bidang-keahlian', function() {
        const id_bidang_keahlian = $(this).val();
        
        // Enable semester
        $('#tambah-semester').prop('disabled', false);
        
        // Reset dependent fields (kelas will load when semester is selected)
        $('#tambah-semester').val('');
        $('#tambah-id-kelas').html('<option value="">-- Pilih Semester Dulu --</option>').prop('disabled', true);
        $('#tambah-id-matkul').html('<option value="">-- Pilih Semester Dulu --</option>').prop('disabled', true);
        $('#tambah-waktu').html('<option value="">-- Pilih Mata Kuliah Dulu --</option>');
        $('#tambah-sks-info').addClass('hidden');
    });

    $(document).on('change', '#tambah-semester', function() {
        const semester = $(this).val();
        const id_bidang_keahlian = $('#tambah-bidang-keahlian').val();
        
        if (semester && id_bidang_keahlian) {
            // Reload kelas filtered by semester
            loadKelas(id_bidang_keahlian, semester, 'tambah');
            // Load mata kuliah
            loadMataKuliah(id_bidang_keahlian, semester, 'tambah');
        } else {
            $('#tambah-id-matkul').html('<option value="">-- Pilih Bidang Keahlian & Semester --</option>').prop('disabled', true);
        }
    });

    $(document).on('change', '#tambah-id-matkul', function() {
        const sks = $(this).find(':selected').data('sks');
        const id_matkul = $(this).val();
        
        if (sks && id_matkul) {
            $('#tambah-sks-info').removeClass('hidden').text(`SKS: ${sks}`);
            updateTimeSlots('tambah', sks);
            // Load dosen filtered by mata kuliah
            loadDosen(id_matkul, 'tambah');
        } else {
            $('#tambah-sks-info').addClass('hidden');
            updateTimeSlots('tambah', null);
            $('#tambah-id-dosen').html('<option value="">-- Pilih Mata Kuliah Dulu --</option>').prop('disabled', true);
        }
    });

    // 6. CASCADING EVENT HANDLERS - EDIT MODAL
    $(document).on('change', '#edit-bidang-keahlian', function() {
        const id_bidang_keahlian = $(this).val();
        
        // Reset dependent fields (kelas will load when semester is selected)
        $('#edit-semester').val('');
        $('#edit-id-kelas').html('<option value="">-- Pilih Semester Dulu --</option>').prop('disabled', true);
        $('#edit-id-matkul').html('<option value="">-- Pilih Semester Dulu --</option>').prop('disabled', true);
        $('#edit-waktu').html('<option value="">-- Pilih Mata Kuliah Dulu --</option>');
        $('#edit-sks-info').addClass('hidden');
    });

    $(document).on('change', '#edit-semester', function() {
        const semester = $(this).val();
        const id_bidang_keahlian = $('#edit-bidang-keahlian').val();
        
        if (semester && id_bidang_keahlian) {
            // Reload kelas filtered by semester
            loadKelas(id_bidang_keahlian, semester, 'edit');
            // Load mata kuliah
            loadMataKuliah(id_bidang_keahlian, semester, 'edit');
        }
    });

    $(document).on('change', '#edit-id-matkul', function() {
        const sks = $(this).find(':selected').data('sks');
        const id_matkul = $(this).val();
        
        if (sks && id_matkul) {
            $('#edit-sks-info').removeClass('hidden').text(`SKS: ${sks}`);
            updateTimeSlots('edit', sks);
            // Load dosen filtered by mata kuliah
            loadDosen(id_matkul, 'edit');
        } else {
            $('#edit-sks-info').addClass('hidden');
            updateTimeSlots('edit', null);
            $('#edit-id-dosen').html('<option value="">-- Pilih Mata Kuliah Dulu --</option>').prop('disabled', true);
        }
    });

    // 7. FILTER CASCADING - Bidang Keahlian change
    $(document).on('change', '#filter-bidang-keahlian', function() {
        const id_bidang_keahlian = $(this).val();
        loadFilterKelas(id_bidang_keahlian);
    });

    // 8. RENDER TABLE
    function getStatusBadge(status) {
        const badges = {
            'Offline': '<span class="inline-flex items-center px-2.5 py-0.5 text-xs font-semibold rounded-full bg-green-100 text-green-800">Offline</span>',
            'Online': '<span class="inline-flex items-center px-2.5 py-0.5 text-xs font-semibold rounded-full bg-yellow-100 text-yellow-800">Online</span>',
            'Libur': '<span class="inline-flex items-center px-2.5 py-0.5 text-xs font-semibold rounded-full bg-red-100 text-red-800">Libur</span>',
            'Kelas Tunjangan': '<span class="inline-flex items-center px-2.5 py-0.5 text-xs font-semibold rounded-full bg-blue-100 text-blue-800">Kelas Tunjangan</span>',
            'Belum Ada Konfirmasi': '<span class="inline-flex items-center px-2.5 py-0.5 text-xs font-semibold rounded-full bg-gray-100 text-gray-800">Belum Ada Konfirmasi</span>'
        };
        return badges[status] || status;
    }

    function renderTable() {
        const id_bidang_keahlian = $('#filter-bidang-keahlian').val();
        const semester = $('#filter-semester').val();
        const id_kelas = $('#filter-kelas').val();
        const hari = $('#filter-hari').val();
        const id_ruangan = $('#filter-ruangan').val();

        $.ajax({
            url: "{{ route('admin.api.jadwal.list') }}",
            method: 'GET',
            data: { id_bidang_keahlian, semester, id_kelas, hari, id_ruangan },
            success: function(data) {
                const $tbody = $('#jadwal-table-body');
                $tbody.empty();

                if (data.length === 0) {
                    $('#no-data-message').show();
                    $tbody.closest('table').addClass('hidden');
                } else {
                    $('#no-data-message').hide();
                    $tbody.closest('table').removeClass('hidden');
                    
                    data.forEach(j => {
                        const statusBadge = getStatusBadge(j.status || 'Belum Ada Konfirmasi');
                        const dosenNama = j.dosen ? j.dosen.nama_dosen : '-';
                        
                        const row = `
                            <tr class="hover:bg-gray-50 transition">
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">${j.hari}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">${j.waktu}</td>
                                <td class="px-6 py-4 text-sm text-gray-700">${j.mata_kuliah ? j.mata_kuliah.nama_mk : '-'}</td>
                                <td class="px-6 py-4 text-sm text-gray-700">${dosenNama}</td>
                                <td class="px-6 py-4 text-sm text-gray-700">${j.kelas ? j.kelas.nama_kelas : '-'}</td>
                                <td class="px-6 py-4 text-sm text-gray-700">${j.ruangan ? j.ruangan.nama_ruangan : '-'}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-center">${statusBadge}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium flex justify-center space-x-2">
                                    <button data-id="${j.id_jadwal}" class="btn-edit-jadwal text-blue-600 hover:text-white bg-blue-100 p-2 rounded-full transition hover:bg-blue-600">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M17 3a2.85 2.85 0 0 1 4 4L7.5 20.5 2 22l1.5-5.5L17 3z"></path></svg>
                                    </button>
                                    <button data-id="${j.id_jadwal}" class="btn-delete-jadwal text-red-600 hover:text-white bg-red-100 p-2 rounded-full transition hover:bg-red-600">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M3 6h18"></path><path d="M19 6v14c0 1-1 2-2 2H7c-1 0-2-1-2-2V6"></path><path d="M8 6V4c0-1 1-2 2-2h4c1 0 2 1 2 2v2"></path></svg>
                                    </button>
                                </td>
                            </tr>
                        `;
                        $tbody.append(row);
                    });
                }
                $('#jadwal-count').text(data.length);
            },
            error: function(xhr) {
                alert('Gagal memuat data');
            }
        });
    }

    // 9. TAMBAH JADWAL
    $('#btn-open-tambah-jadwal-modal').click(function() {
        $('#tambah-jadwal-modal').removeClass('hidden');
        // Reset all filters
        $('#tambah-bidang-keahlian').val('');
        $('#tambah-semester').val('').prop('disabled', true);
        $('#tambah-id-matkul').html('<option value="">-- Pilih Semester Dulu --</option>').prop('disabled', true);
        $('#tambah-id-kelas').html('<option value="">-- Pilih Bidang Keahlian Dulu --</option>').prop('disabled', true);
    });

    $('.close-tambah-jadwal-modal').click(function() {
        $('#tambah-jadwal-modal').addClass('hidden');
        $('#tambah-jadwal-form')[0].reset();
    });

    $('#tambah-jadwal-form').submit(function(e) {
        e.preventDefault();
        const formData = $(this).serialize();
        $('#btn-tambah-jadwal').text('Menyimpan...').prop('disabled', true);

        $.ajax({
            url: "{{ route('admin.jadwal.store') }}",
            method: 'POST',
            data: formData,
            success: function(response) {
                alert(response.message);
                $('#tambah-jadwal-modal').addClass('hidden');
                $('#tambah-jadwal-form')[0].reset();
                renderTable();
                $('#btn-tambah-jadwal').text('Simpan Data').prop('disabled', false);
            },
            error: function(xhr) {
                const res = xhr.responseJSON;
                alert('Gagal: ' + (res.message || 'Terjadi kesalahan'));
                $('#btn-tambah-jadwal').text('Simpan Data').prop('disabled', false);
            }
        });
    });

    // 10. EDIT JADWAL
    $(document).on('click', '.btn-edit-jadwal', function() {
        const jadwalId = $(this).data('id');
        const editUrl = "{{ route('admin.jadwal.edit', ':id') }}".replace(':id', jadwalId);

        $.ajax({
            url: editUrl,
            method: 'GET',
            success: function(data) {
                $('#edit-jadwal-id').val(data.id_jadwal);
                
                // Get bidang keahlian from mata kuliah
                const id_bidang_keahlian = data.mata_kuliah?.id_bidang_keahlian;
                const semester = data.mata_kuliah?.semester;
                
                // Set bidang keahlian
                $('#edit-bidang-keahlian').val(id_bidang_keahlian);
                
                // Set semester
                $('#edit-semester').val(semester);
                
                // Load kelas for this bidang keahlian AND semester
                loadKelas(id_bidang_keahlian, semester, 'edit');
                
                // Load mata kuliah for this bidang keahlian + semester
                loadMataKuliah(id_bidang_keahlian, semester, 'edit');
                
                // Wait for dropdowns to populate, then set values
                setTimeout(function() {
                    $('#edit-id-matkul').val(data.id_matkul).trigger('change');
                    // Dosen will be loaded via change event above
                    $('#edit-id-kelas').val(data.id_kelas);
                    $('#edit-hari').val(data.hari);
                    $('#edit-id-ruangan').val(data.id_ruangan);
                    $('#edit-status').val(data.status || 'Belum Ada Konfirmasi');
                    
                    // Wait for waktu and dosen dropdowns to populate
                    setTimeout(function() {
                        $('#edit-waktu').val(data.waktu);
                        $('#edit-id-dosen').val(data.id_dosen);
                    }, 300);
                }, 300);

                $('#edit-jadwal-modal').removeClass('hidden');
            },
            error: function(xhr) {
                alert('Gagal mengambil data');
            }
        });
    });

    $('.close-edit-jadwal-modal').click(function() {
        $('#edit-jadwal-modal').addClass('hidden');
    });

    $('#edit-jadwal-form').submit(function(e) {
        e.preventDefault();
        const jadwalId = $('#edit-jadwal-id').val();
        const updateUrl = "{{ route('admin.jadwal.update', ':id') }}".replace(':id', jadwalId);
        const formData = $(this).serialize();

        $('#btn-update-jadwal').text('Menyimpan...').prop('disabled', true);

        $.ajax({
            url: updateUrl,
            method: 'PUT',
            data: formData,
            success: function(response) {
                alert(response.message);
                $('#edit-jadwal-modal').addClass('hidden');
                renderTable();
                $('#btn-update-jadwal').text('Simpan Perubahan').prop('disabled', false);
            },
            error: function(xhr) {
                const res = xhr.responseJSON;
                alert('Gagal: ' + (res.message || 'Terjadi kesalahan'));
                $('#btn-update-jadwal').text('Simpan Perubahan').prop('disabled', false);
            }
        });
    });

    // 11. DELETE JADWAL
    $(document).on('click', '.btn-delete-jadwal', function() {
        const jadwalId = $(this).data('id');
        if (!confirm('Hapus jadwal ini?\n\nData tidak dapat dikembalikan!')) return;

        $.ajax({
            url: "{{ route('admin.jadwal.destroy', ':id') }}".replace(':id', jadwalId),
            method: 'DELETE',
            data: { _token: "{{ csrf_token() }}" },
            success: function(response) {
                alert(response.message);
                renderTable();
            },
            error: function(xhr) {
                alert('Gagal menghapus data');
            }
        });
    });

    // 12. FILTER BUTTON
    $('#btn-filter').click(function() {
        renderTable();
    });

    // INIT
    loadDropdownData();

});
</script>
@endpush