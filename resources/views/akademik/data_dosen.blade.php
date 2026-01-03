{{-- resources/views/akademik/data_dosen.blade.php --}}

@extends('layouts.app') 

@section('content')

<div class="p-6">
    {{-- Header --}}
      <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold text-gray-800">Kelola Data Dosen</h1>
        {{-- Jika nanti ada tombol Tambah Dosen, gunakan warna Viridian Green (#009DA5) --}}
    </div>

    {{-- FILTER SECTION --}}
    <div class="bg-white p-6 rounded-xl shadow-lg mb-6 border-t-4 border-[#004269]"> {{-- Border atas Indigo Dye --}}
        <h2 class="text-lg font-semibold text-[#004269] mb-4">Pencarian Data</h2>
        
        <div class="grid grid-cols-2 md:grid-cols-4 gap-4" id="filter-container">
            {{-- Dropdown Status --}}
            <div class="flex flex-col space-y-1">
                <label for="filter-status" class="text-sm font-medium text-gray-600">Status</label>
                <select id="filter-status" class="p-2 border rounded-lg outline-none text-sm text-gray-700 bg-gray-50 focus:border-[#009DA5] focus:ring-1 focus:ring-[#009DA5]">
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
                <label for="filter-pendidikan" class="text-sm font-medium text-gray-600">Pendidikan</label>
                <select id="filter-pendidikan" class="p-2 border rounded-lg outline-none text-sm text-gray-700 bg-gray-50 focus:border-[#009DA5] focus:ring-1 focus:ring-[#009DA5]">
                    <option value="Semua Pendidikan">Semua Pendidikan</option>
                    <option value="S1">S1</option>
                    <option value="S2">S2</option>
                    <option value="S3">S3</option>
                </select>
            </div>

        </div>
        <div class="mt-6 flex justify-end space-x-3">
            {{-- Tombol Show Data: Indigo Dye --}}
            <button id="btn-filter" class="bg-[#004269] hover:bg-[#003350] text-white px-6 py-2 rounded-lg font-semibold transition shadow-md flex items-center">
                <x-heroicon-o-magnifying-glass class="w-4 h-4 mr-2" />
                Show Data
            </button>
            {{-- Tombol Print: Fiery Rose --}}
            <button id="btn-print" class="bg-[#F15B67] hover:bg-[#d64551] text-white px-6 py-2 rounded-lg font-semibold transition shadow-md flex items-center">
                <x-heroicon-o-printer class="w-4 h-4 mr-2" />
                Print
            </button>
        </div>
    </div>

    {{-- TABLE SECTION --}}
    <div class="bg-white rounded-xl shadow-lg overflow-hidden border border-gray-100 mb-6">
        {{-- Header Tabel: Indigo Dye (#004269) --}}
        <div id="header-daftar-dosen" class="p-4 border-b flex justify-between items-center bg-[#004269]">
            <h3 class="font-bold text-white">Daftar Dosen (<span id="lecturer-count">0</span> data)</h3>
        </div>
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        {{-- Text Header: Indigo Dye --}}
                        <th class="px-6 py-3 text-left text-sm font-extrabold text-[#004269] uppercase">NIDN</th>
                        <th class="px-6 py-3 text-left text-sm font-extrabold text-[#004269] uppercase">ID Internal</th>
                        <th class="px-6 py-3 text-left text-sm font-extrabold text-[#004269] uppercase">Nama Dosen</th>
                        <th class="px-6 py-3 text-left text-sm font-extrabold text-[#004269] uppercase">Pendidikan</th>
                        <th class="px-6 py-3 text-left text-sm font-extrabold text-[#004269] uppercase">Bidang Keahlian</th>
                        <th class="px-6 py-3 text-center text-sm font-extrabold text-[#004269] uppercase">Status</th>
                        <th class="px-6 py-3 text-center text-sm font-extrabold text-[#004269] uppercase">Aksi</th>
                    </tr>
                </thead>
                <tbody id="lecturer-table-body" class="bg-white divide-y divide-gray-200 text-sm">
                    <tr><td colspan="7" class="px-6 py-10 text-center text-gray-500 italic">Click "Show Data"...</td></tr>
                </tbody>
            </table>
            <div id="no-data-message" class="text-center py-10 text-[#FF0000] italic hidden">
                <p>Tidak ada data dosen yang sesuai dengan filter saat ini.</p>
            </div>
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
                    $('#no-data-message').removeClass('hidden').show();
                    $tbody.closest('table').addClass('hidden');
                } else {
                    $('#no-data-message').addClass('hidden').hide();
                    $tbody.closest('table').removeClass('hidden');
                    
                    data.forEach(dosen => {
                        const statusBadge = getStatusBadge(dosen.status);
                        
                        const row = `
                            <tr data-id="${dosen.id_dosen}" class="hover:bg-gray-50 transition border-b">
                                <td class="px-6 py-4 font-mono text-sm text-gray-600">${dosen.nidn}</td>
                                <td class="px-6 py-4 font-mono text-sm text-gray-600">${dosen.id_dosen_internal || '-'}</td>
                                <td class="px-6 py-4 font-bold text-gray-900">${dosen.nama_dosen}</td>
                                <td class="px-6 py-4 text-sm text-gray-600">${dosen.pendidikan}</td>
                                <td class="px-6 py-4 text-sm text-gray-600" title="${dosen.bidang}">${dosen.bidang}</td>
                                <td class="px-6 py-4 text-center">${statusBadge}</td>
                                <td class="px-6 py-4 text-center">
                                    <div class="flex justify-center space-x-2">
                                        <button data-id="${dosen.id_dosen}" class="btn-edit-dosen p-2 bg-[#009DA5]/10 text-[#009DA5] rounded-full hover:bg-[#009DA5] hover:text-white transition shadow-sm">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path></svg>
                                        </button>
                                        <button data-id="${dosen.id_dosen}" class="btn-delete-dosen p-2 bg-[#FF0000]/10 text-[#FF0000] rounded-full hover:bg-[#FF0000] hover:text-white transition shadow-sm">
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
                alert('Gagal memuat data dosen');
                console.error(xhr);
            }
        });
    }

    // Fungsi helper untuk badge warna sesuai brand
    function getStatusBadge(statusRaw) {
        const status = statusRaw.toLowerCase();
        let colorClass = 'bg-gray-100 text-gray-800';

        if (status === 'aktif') {
            // Viridian Green
            colorClass = 'bg-[#009DA5]/10 text-[#009DA5]'; 
        } 
        else if (status === 'tidak aktif') {
            // Red
            colorClass = 'bg-[#FF0000]/10 text-[#FF0000]'; 
        } 
        else if (status === 'tetap') {
            // Indigo Dye (Tetap = Identitas Perusahaan)
            colorClass = 'bg-[#004269]/10 text-[#004269]'; 
        }
        else if (status === 'kontrak') {
            // Fiery Rose (Warning/Temporary)
            colorClass = 'bg-[#F15B67]/10 text-[#F15B67]';
        }
        else if (status === 'honorer') {
             // Gray (Neutral) or same as Contract
            colorClass = 'bg-gray-100 text-gray-800';
        }

        return `<span class="inline-flex items-center px-3 py-1 text-xs font-semibold rounded-full ${colorClass}">${statusRaw.charAt(0).toUpperCase() + statusRaw.slice(1)}</span>`;
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
                $('#edit-dosen-id').val(data.id_dosen);
                $('#edit-nidn').val(data.nidn);
                $('#edit-id-internal').val(data.id_dosen_internal);
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