{{-- resources/views/akademik/data_dosen.blade.php --}}

@extends('layouts.app') 

@section('content')

<div class="min-h-screen bg-gray-50 p-4 md:p-8 font-sans">
    <div class="flex items-center justify-between space-x-4 text-gray-800 border-b border-gray-200 pb-4 mb-6">
        <div class="flex items-center space-x-4">
            <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-blue-600"><path d="M4 19.5A2.5 2.5 0 0 1 6.5 17H20"></path><path d="M6.5 2H20v20h-1.5"></path><path d="M14 6H9.5a2.5 2.5 0 0 0 0 5H17"></path><path d="M14 10H9.5a2.5 2.5 0 0 0 0 5H17"></path></svg>
            <h1 class="text-3xl font-extrabold tracking-tight">
                Sistem Manajemen Data Dosen
            </h1>
        </div>
        {{-- Tombol Tambah Dosen --}}
        <button id="btn-open-tambah-modal" class="px-4 py-2 bg-green-600 text-white rounded-md hover:bg-green-700 transition flex items-center space-x-2">
            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="12" y1="5" x2="12" y2="19"></line><line x1="5" y1="12" x2="19" y2="12"></line></svg>
            <span>Tambah Dosen</span>
        </button>
    </div>

    {{-- FILTER SECTION --}}
    <div class="bg-white p-6 rounded-xl shadow-lg mb-6 border border-gray-100">
        <h2 class="text-lg font-semibold text-gray-700 mb-4">Filter Data</h2>
        
        <div class="grid grid-cols-2 md:grid-cols-4 gap-4" id="filter-container">
            {{-- Dropdown Status --}}
            <div class="flex flex-col space-y-1">
                <label for="filter-status" class="text-sm font-medium text-gray-700">Status</label>
                <select id="filter-status" class="p-2 border border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500 transition duration-150">
                    <option value="Semua Status">Semua Status</option>
                    <option value="Aktif">Aktif</option>
                    <option value="Tidak Aktif">Tidak Aktif</option>
                    <option value="Kontrak">Kontrak</option>
                    <option value="Tetap">Tetap</option>
                    <option value="Honorer">Honorer</option>
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

            {{-- Tombol Tampilkan --}}
            <div class="flex items-end">
                <button id="btn-filter" class="w-full px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition">
                    Tampilkan Data
                </button>
            </div>

            {{-- Tombol Print --}}
            <div class="flex items-end">
                <button id="btn-print" class="w-full px-4 py-2 bg-purple-600 text-white rounded-lg hover:bg-purple-700 transition flex items-center justify-center space-x-2">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="6 9 6 2 18 2 18 9"></polyline><path d="M6 18H4a2 2 0 0 1-2-2v-5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v5a2 2 0 0 1-2 2h-2"></path><rect x="6" y="14" width="12" height="8"></rect></svg>
                    <span>Print</span>
                </button>
            </div>

        </div>
    </div>

    {{-- TABLE SECTION --}}
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
                <p class="mt-2 text-sm">Klik "Tampilkan Data" untuk melihat semua data atau ubah filter.</p>
            </div>
        </div>
    </div>
</div>

{{-- MODAL COMPONENTS --}}
@include('components.tambah_dosen_modal')
@include('components.edit_dosen_modal')

@endsection

@push('scripts')
<script>
$(document).ready(function() {
    
    // =========================================================================
    // RENDER TABLE FUNCTION
    // =========================================================================
    
    function renderTable() {
        const status = $('#filter-status').val();
        const pendidikan = $('#filter-pendidikan').val();

        $.ajax({
            url: "{{ route('admin.api.dosen.list') }}",
            method: 'GET',
            data: { status, pendidikan },
            success: function(data) {
                const $tbody = $('#lecturer-table-body');
                $tbody.empty();

                if (data.length === 0) {
                    $('#no-data-message').show();
                    $tbody.closest('table').addClass('hidden');
                } else {
                    $('#no-data-message').hide();
                    $tbody.closest('table').removeClass('hidden');
                    
                    data.forEach(dosen => {
                        const statusBadge = getStatusBadge(dosen.status);
                        
                        const row = `
                            <tr data-id="${dosen.id}" class="hover:bg-blue-50/50 transition duration-100">
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">${dosen.nidn}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">${dosen.nama_dosen}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">${dosen.pendidikan}</td>
                                <td class="px-6 py-4 text-sm text-gray-700 max-w-xs truncate" title="${dosen.bidang}">${dosen.bidang}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-center">${statusBadge}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium flex justify-center space-x-2">
                                    <button data-id="${dosen.id}" class="btn-edit-dosen text-blue-600 hover:text-white bg-blue-100 p-2 rounded-full transition duration-150 hover:bg-blue-600 hover:shadow-md" title="Edit Data Dosen">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M17 3a2.85 2.85 0 0 1 4 4L7.5 20.5 2 22l1.5-5.5L17 3z"></path></svg>
                                    </button>
                                    <button data-id="${dosen.id}" class="btn-delete-dosen text-red-600 hover:text-white bg-red-100 p-2 rounded-full transition duration-150 hover:bg-red-600 hover:shadow-md" title="Hapus Data Dosen">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M3 6h18"></path><path d="M19 6v14c0 1-1 2-2 2H7c-1 0-2-1-2-2V6"></path><path d="M8 6V4c0-1 1-2 2-2h4c1 0 2 1 2 2v2"></path></svg>
                                    </button>
                                </td>
                            </tr>
                        `;
                        $tbody.append(row);
                    });
                }
                
                $('#lecturer-count').text(data.length);
            },
            error: function(xhr) {
                alert('Gagal memuat data dosen');
                console.error(xhr);
            }
        });
    }

    function getStatusBadge(status) {
        let colorClass = 'bg-gray-100 text-gray-800';
        if (status === 'aktif') colorClass = 'bg-green-100 text-green-800';
        else if (status === 'tidak aktif') colorClass = 'bg-red-100 text-red-800';
        else if (status === 'kontrak') colorClass = 'bg-yellow-100 text-yellow-800';
        else if (status === 'tetap') colorClass = 'bg-blue-100 text-blue-800';
        else if (status === 'honorer') colorClass = 'bg-purple-100 text-purple-800';

        return `<span class="inline-flex items-center px-3 py-1 text-xs font-semibold rounded-full ${colorClass}">${status.charAt(0).toUpperCase() + status.slice(1)}</span>`;
    }

    // =========================================================================
    // TAMBAH DOSEN MODAL
    // =========================================================================

    $('#btn-open-tambah-modal').click(function() {
        $('#tambah-dosen-modal').removeClass('hidden');
    });

    $('.close-tambah-modal').click(function() {
        $('#tambah-dosen-modal').addClass('hidden');
        $('#tambah-dosen-form')[0].reset();
    });

    $('#tambah-dosen-form').submit(function(e) {
        e.preventDefault();
        
        const formData = $(this).serialize();
        $('#btn-tambah-dosen').text('Menyimpan...').prop('disabled', true);

        $.ajax({
            url: "{{ route('admin.dosen.store') }}",
            method: 'POST',
            data: formData,
            success: function(response) {
                alert(response.message);
                $('#tambah-dosen-modal').addClass('hidden');
                $('#tambah-dosen-form')[0].reset();
                renderTable();
                $('#btn-tambah-dosen').text('Simpan Data').prop('disabled', false);
            },
            error: function(xhr) {
                const res = xhr.responseJSON;
                alert('Gagal menambah: ' + (res.message || 'Terjadi kesalahan'));
                $('#btn-tambah-dosen').text('Simpan Data').prop('disabled', false);
            }
        });
    });

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
                $('#edit-dosen-id').val(data.id);
                $('#edit-nidn').val(data.nidn);
                $('#edit-nama').val(data.nama_dosen);
                $('#edit-pendidikan').val(data.pendidikan);
                $('#edit-bidang').val(data.bidang);
                $('#edit-tempat').val(data.tempat);
                $('#edit-tanggal-lahir').val(data.tanggal_lahir);
                $('#edit-jenis-kelamin').val(data.jenis_kelamin);
                $('#edit-agama').val(data.agama);
                $('#edit-email').val(data.email);
                $('#edit-no-telp').val(data.no_telp);
                $('#edit-honor').val(data.honor_per_sks);
                $('#edit-status').val(data.status);

                $('#edit-dosen-modal').removeClass('hidden');
            },
            error: function(xhr) {
                alert('Gagal mengambil data dosen');
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
                alert(response.message);
                $('#edit-dosen-modal').addClass('hidden');
                renderTable();
                $('#btn-update-dosen').text('Simpan Perubahan').prop('disabled', false);
            },
            error: function(xhr) {
                const res = xhr.responseJSON;
                alert('Gagal update: ' + (res.message || 'Terjadi kesalahan'));
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
        const dosenName = dosenRow.find('td:eq(1)').text();

        if (!confirm(`Apakah Anda yakin ingin menghapus dosen "${dosenName}"?\n\nData yang sudah dihapus tidak dapat dikembalikan!`)) {
            return;
        }

        const deleteUrl = "{{ route('admin.dosen.destroy', ':id') }}".replace(':id', dosenId);

        $.ajax({
            url: deleteUrl,
            method: 'DELETE',
            data: {
                _token: "{{ csrf_token() }}"
            },
            success: function(response) {
                alert(response.message);
                renderTable();
            },
            error: function(xhr) {
                const res = xhr.responseJSON;
                alert('Gagal menghapus: ' + (res.message || 'Terjadi kesalahan'));
            }
        });
    });

    // =========================================================================
    // FILTER & PRINT
    // =========================================================================

    $('#btn-filter').click(function() {
        renderTable();
    });

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