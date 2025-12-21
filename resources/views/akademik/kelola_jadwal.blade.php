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
            <h1 class="text-3xl font-extrabold tracking-tight">Kelola Jadwal Kuliah</h1>
        </div>
        <button id="btn-open-tambah-jadwal-modal" class="px-4 py-2 bg-green-600 text-white rounded-md hover:bg-green-700 transition flex items-center space-x-2">
            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <line x1="12" y1="5" x2="12" y2="19"></line>
                <line x1="5" y1="12" x2="19" y2="12"></line>
            </svg>
            <span>Tambah Jadwal</span>
        </button>
    </div>

    {{-- FILTER SECTION --}}
    <div class="bg-white p-6 rounded-xl shadow-lg mb-6 border border-gray-100">
        <h2 class="text-lg font-semibold text-gray-700 mb-4">Filter Data</h2>
        
        <div class="grid grid-cols-2 md:grid-cols-5 gap-4">
            <div class="flex flex-col space-y-1">
                <label for="filter-kelas" class="text-sm font-medium text-gray-700">Kelas</label>
                <select id="filter-kelas" class="p-2 border border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500">
                    <option value="Semua Kelas">Semua Kelas</option>
                </select>
            </div>
            
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

            <div class="flex flex-col space-y-1">
                <label for="filter-ruangan" class="text-sm font-medium text-gray-700">Ruangan</label>
                <select id="filter-ruangan" class="p-2 border border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500">
                    <option value="Semua Ruangan">Semua Ruangan</option>
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
        <h2 class="text-xl font-semibold text-gray-700 mb-4">Daftar Jadwal (<span id="jadwal-count">0</span> data)</h2>
        <div class="overflow-x-auto rounded-lg border border-gray-200">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-bold text-gray-600 uppercase tracking-wider w-[100px]">Hari</th>
                        <th class="px-6 py-3 text-left text-xs font-bold text-gray-600 uppercase tracking-wider w-[100px]">Waktu</th>
                        <th class="px-6 py-3 text-left text-xs font-bold text-gray-600 uppercase tracking-wider min-w-[300px]">Mata Kuliah</th>
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
    
    let dropdownData = {};

    // LOAD DROPDOWN DATA
    function loadDropdownData() {
        $.ajax({
            url: "{{ route('admin.api.jadwal.dropdown') }}",
            method: 'GET',
            success: function(data) {
                dropdownData = data;
                populateFilters();
            },
            error: function(xhr) {
                console.error('Error loading dropdown data', xhr);
            }
        });
    }

    // POPULATE FILTERS
    function populateFilters() {
        // Filter Kelas
        if (dropdownData.kelas) {
            dropdownData.kelas.forEach(k => {
                $('#filter-kelas').append(`<option value="${k.id_kelas}">${k.nama_kelas}</option>`);
            });
        }

        // Filter Ruangan
        if (dropdownData.ruangan) {
            dropdownData.ruangan.forEach(r => {
                $('#filter-ruangan').append(`<option value="${r.id_ruangan}">${r.nama_ruangan}</option>`);
            });
        }
    }

    // POPULATE MODAL DROPDOWNS
    function populateModalDropdowns(modalPrefix = 'tambah') {
        const mkSelector = `#${modalPrefix}-kode-mk`;
        const kelasSelector = `#${modalPrefix}-id-kelas`;
        const ruanganSelector = `#${modalPrefix}-id-ruangan`;

        // Clear existing options (except placeholder)
        $(mkSelector).find('option:not(:first)').remove();
        $(kelasSelector).find('option:not(:first)').remove();
        $(ruanganSelector).find('option:not(:first)').remove();

        // Populate Mata Kuliah
        if (dropdownData.mata_kuliah) {
            dropdownData.mata_kuliah.forEach(mk => {
                $(mkSelector).append(`<option value="${mk.kode_mk}">${mk.kode_mk} - ${mk.nama_mk}</option>`);
            });
        }

        // Populate Kelas
        if (dropdownData.kelas) {
            dropdownData.kelas.forEach(k => {
                $(kelasSelector).append(`<option value="${k.id_kelas}">${k.nama_kelas}</option>`);
            });
        }

        // Populate Ruangan
        if (dropdownData.ruangan) {
            dropdownData.ruangan.forEach(r => {
                $(ruanganSelector).append(`<option value="${r.id_ruangan}">${r.nama_ruangan}</option>`);
            });
        }
    }

    // TIME SLOTS BASED ON SKS
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
        4: [
            '08:00 - 11:30',
            '13:00 - 16:30',
            '16:40 - 20:10',
            '20:20 - 22:00'
        ]
    };

    // UPDATE TIME SLOTS BASED ON SKS
    function updateTimeSlots(modalPrefix, sks) {
        const waktuSelector = `#${modalPrefix}-waktu`;
        $(waktuSelector).find('option').remove();
        
        if (!sks || !timeSlots[sks]) {
            $(waktuSelector).append('<option value="">-- Pilih Mata Kuliah Dulu --</option>');
            return;
        }

        $(waktuSelector).append('<option value="">-- Pilih Waktu --</option>');
        timeSlots[sks].forEach(slot => {
            $(waktuSelector).append(`<option value="${slot}">${slot}</option>`);
        });
    }

    // HANDLE MATA KULIAH CHANGE - TAMBAH MODAL
    $(document).on('change', '#tambah-kode-mk', function() {
        const kodeMk = $(this).val();
        if (!kodeMk) {
            $('#tambah-sks-info').addClass('hidden').text('');
            updateTimeSlots('tambah', null);
            return;
        }

        const selectedMk = dropdownData.mata_kuliah.find(mk => mk.kode_mk === kodeMk);
        if (selectedMk) {
            $('#tambah-sks-info').removeClass('hidden').text(`SKS: ${selectedMk.sks}`);
            updateTimeSlots('tambah', selectedMk.sks);
        }
    });

    // HANDLE MATA KULIAH CHANGE - EDIT MODAL
    $(document).on('change', '#edit-kode-mk', function() {
        const kodeMk = $(this).val();
        if (!kodeMk) {
            $('#edit-sks-info').addClass('hidden').text('');
            updateTimeSlots('edit', null);
            return;
        }

        const selectedMk = dropdownData.mata_kuliah.find(mk => mk.kode_mk === kodeMk);
        if (selectedMk) {
            $('#edit-sks-info').removeClass('hidden').text(`SKS: ${selectedMk.sks}`);
            updateTimeSlots('edit', selectedMk.sks);
        }
    });

    // GET STATUS BADGE
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

    // RENDER TABLE
    function renderTable() {
        const id_kelas = $('#filter-kelas').val();
        const hari = $('#filter-hari').val();
        const id_ruangan = $('#filter-ruangan').val();

        $.ajax({
            url: "{{ route('admin.api.jadwal.list') }}",
            method: 'GET',
            data: { id_kelas, hari, id_ruangan },
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
                        const row = `
                            <tr class="hover:bg-gray-50 transition">
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">${j.hari}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">${j.waktu}</td>
                                <td class="px-6 py-4 text-sm text-gray-700">${j.mata_kuliah ? j.mata_kuliah.nama_mk : '-'}</td>
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
                console.error(xhr);
            }
        });
    }


    // TAMBAH JADWAL
    $('#btn-open-tambah-jadwal-modal').click(function() {
        populateModalDropdowns('tambah');
        $('#tambah-jadwal-modal').removeClass('hidden');
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

    // EDIT JADWAL
    $(document).on('click', '.btn-edit-jadwal', function() {
        const jadwalId = $(this).data('id');
        const editUrl = "{{ route('admin.jadwal.edit', ':id') }}".replace(':id', jadwalId);

        populateModalDropdowns('edit');

        $.ajax({
            url: editUrl,
            method: 'GET',
            success: function(data) {
                $('#edit-jadwal-id').val(data.id_jadwal);
                $('#edit-kode-mk').val(data.kode_mk);
                $('#edit-id-kelas').val(data.id_kelas);
                $('#edit-id-ruangan').val(data.id_ruangan);
                $('#edit-hari').val(data.hari);
                $('#edit-status').val(data.status || 'Belum Ada Konfirmasi');
                
                // Trigger change to populate time slots and SKS
                $('#edit-kode-mk').trigger('change');
                
                // Then set the time value
                setTimeout(function() {
                    $('#edit-waktu').val(data.waktu);
                }, 100);

                $('#edit-jadwal-modal').removeClass('hidden');
            },
            error: function(xhr) {
                alert('Gagal mengambil data');
                console.error(xhr);
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

    // DELETE JADWAL
    $(document).on('click', '.btn-delete-jadwal', function() {
        const jadwalId = $(this).data('id');

        if (!confirm('Hapus jadwal ini?\n\nData tidak dapat dikembalikan!')) {
            return;
        }

        const deleteUrl = "{{ route('admin.jadwal.destroy', ':id') }}".replace(':id', jadwalId);

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
        const id_kelas = $('#filter-kelas').val();
        const hari = $('#filter-hari').val();
        const id_ruangan = $('#filter-ruangan').val();

        let printUrl = "{{ route('admin.jadwal.print') }}";
        printUrl += `?id_kelas=${encodeURIComponent(id_kelas)}`;
        printUrl += `&hari=${encodeURIComponent(hari)}`;
        printUrl += `&id_ruangan=${encodeURIComponent(id_ruangan)}`;

        window.open(printUrl, '_blank');
    });

    // INIT
    loadDropdownData();

});
</script>
@endpush
