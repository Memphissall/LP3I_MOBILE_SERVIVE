{{-- resources/views/akademik/pengumuman/index.blade.php --}}

@extends('layouts.app')

@section('content')

<div class="p-6">
    {{-- Header Page --}}
    <div class="flex justify-between items-center mb-8">
        <div>
            <h1 class="text-2xl font-extrabold text-[#004269] tracking-tight">Kelola Pengumuman</h1>
            <p class="text-sm text-gray-500 mt-1">Manajemen pengumuman dan informasi penting kampus.</p>
        </div>
    </div>

    {{-- TABLE SECTION --}}
    <div class="bg-white rounded-2xl shadow-xl shadow-gray-200/50 overflow-hidden mb-6 border border-gray-100">
        {{-- Header Tabel with Gradient --}}
        <div class="p-5 border-b bg-gradient-to-r from-[#004269] to-[#009DA5]">
            <div class="flex flex-col md:flex-row justify-between items-center gap-4">
                <div class="flex items-center space-x-3">
                    <div class="bg-white/20 p-2 rounded-lg backdrop-blur-sm">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5.882V19.24a1.76 1.76 0 01-3.417.592l-2.147-6.15M18 13a3 3 0 100-6M5.436 13.683A4.001 4.001 0 017 6h1.832c4.1 0 7.625-1.234 9.168-3v14c-1.543-1.766-5.067-3-9.168-3H7a3.988 3.988 0 01-1.564-.317z"/></svg>
                    </div>
                    <h3 class="text-xl font-bold text-white tracking-wide">
                        Daftar Pengumuman 
                        <span class="bg-white/20 px-2 py-0.5 rounded text-sm font-mono ml-2" id="pengumuman-count">{{ $pengumuman->total() }}</span>
                    </h3>
                </div>

                {{-- BUTTON ADD --}}
                <button id="btn-open-tambah-pengumuman" class="bg-white text-[#004269] px-4 py-2 rounded-lg font-bold hover:bg-gray-50 transition-all duration-200 shadow-lg shadow-black/10 flex items-center transform hover:scale-105 active:scale-95 text-sm">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/></svg>
                    Tambah Pengumuman
                </button>
            </div>
        </div>
        
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-3 py-3 text-center text-sm font-extrabold text-[#004269] uppercase tracking-wider w-12 border-b-2 border-gray-200">No</th>
                        <th class="px-3 py-3 text-left text-sm font-extrabold text-[#004269] uppercase tracking-wider min-w-[200px] border-b-2 border-gray-200">Judul</th>
                        <th class="px-3 py-3 text-left text-sm font-extrabold text-[#004269] uppercase tracking-wider border-b-2 border-gray-200">Isi Ringkas</th>
                        <th class="px-3 py-3 text-center text-sm font-extrabold text-[#004269] uppercase tracking-wider w-[100px] border-b-2 border-gray-200">File</th>
                        <th class="px-3 py-3 text-center text-sm font-extrabold text-[#004269] uppercase tracking-wider w-[150px] border-b-2 border-gray-200">Tanggal</th>
                        <th class="px-3 py-3 text-center text-sm font-extrabold text-[#004269] uppercase tracking-wider w-[100px] border-b-2 border-gray-200">Aksi</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-100 text-sm" id="pengumuman-table-body">
                    @forelse($pengumuman as $index => $item)
                    <tr class="hover:bg-gray-50 transition-colors duration-200 group border-b border-gray-100 last:border-b-0">
                        <td class="px-3 py-3 text-center font-bold text-gray-500">
                            {{ ($pengumuman->currentPage() - 1) * $pengumuman->perPage() + $index + 1 }}
                        </td>
                        <td class="px-3 py-3">
                            <div class="text-sm font-bold text-gray-800 group-hover:text-[#004269] transition-colors">
                                {{ $item->judul ?: '-' }}
                            </div>
                        </td>
                        <td class="px-3 py-3">
                            <div class="text-xs text-gray-600 line-clamp-2 font-medium">
                                {{ Str::limit($item->isi, 100) ?: '-' }}
                            </div>
                        </td>
                        <td class="px-3 py-3 text-center">
                            @if($item->file_path)
                                <a href="{{ asset('storage/' . $item->file_path) }}" target="_blank" class="inline-flex items-center px-2 py-1 text-[10px] font-bold rounded-lg bg-[#004269]/10 text-[#004269] hover:bg-[#004269] hover:text-white transition uppercase tracking-wide border border-[#004269]/20">
                                    <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.172 7l-6.586 6.586a2 2 0 102.828 2.828l6.414-6.586a4 4 0 00-5.656-5.656l-6.415 6.585a6 6 0 108.486 8.486L20.5 13"/></svg>
                                    UNDUH
                                </a>
                            @else
                                <span class="inline-flex items-center px-2 py-1 text-[10px] font-bold rounded-lg bg-gray-100 text-gray-400 uppercase tracking-wide border border-gray-200">
                                    No File
                                </span>
                            @endif
                        </td>
                        <td class="px-3 py-3 text-center text-xs font-bold text-gray-500">
                            {{ $item->created_at->format('d M Y') }}
                            <span class="block text-[10px] font-normal text-gray-400">{{ $item->created_at->format('H:i') }}</span>
                        </td>
                        <td class="px-3 py-3 whitespace-nowrap text-center text-xs font-medium">
                            <div class="flex justify-center space-x-1">
                                <button data-id="{{ $item->id }}" title="Edit" class="btn-edit-pengumuman p-1.5 text-indigo-600 hover:text-indigo-900 hover:bg-indigo-50 rounded transition-all duration-200">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"/></svg>
                                </button>
                                <button data-id="{{ $item->id }}" title="Hapus" class="btn-delete-pengumuman p-1.5 text-rose-500 hover:text-rose-700 hover:bg-rose-50 rounded transition-all duration-200">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                </button>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="px-6 py-12 text-center">
                            <div class="flex flex-col items-center justify-center">
                                <div class="bg-gray-50 rounded-full p-6 mb-4">
                                    <svg class="w-12 h-12 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"/></svg>
                                </div>
                                <h3 class="text-lg font-medium text-gray-900">Belum Ada Pengumuman</h3>
                                <p class="text-gray-500 mt-1">Klik tombol "Tambah Pengumuman" untuk membuat pengumuman baru</p>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        
        {{-- Pagination --}}
        @if($pengumuman->hasPages())
        <div class="bg-gray-50 px-6 py-3 border-t border-gray-100">
            {{ $pengumuman->links() }}
        </div>
        @endif
    </div>
</div>

{{-- MODALS --}}
@include('components.tambah_pengumuman_modal')
@include('components.edit_pengumuman_modal')

@endsection

@push('scripts')
<script>
$(document).ready(function() {
    // Setup CSRF Token
    $.ajaxSetup({ headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') } });

    // OPEN TAMBAH MODAL
    $('#btn-open-tambah-pengumuman').click(function() {
        $('#tambah-pengumuman-modal').removeClass('hidden');
    });

    // CLOSE TAMBAH MODAL
    $('.close-tambah-pengumuman-modal').click(function() {
        $('#tambah-pengumuman-modal').addClass('hidden');
        $('#tambah-pengumuman-form')[0].reset();
        $('#tambah-file-name').text('Tidak ada file dipilih').removeClass('text-[#004269] font-bold').addClass('text-gray-500 italic');
    });

    // SUBMIT TAMBAH PENGUMUMAN
    $('#tambah-pengumuman-form').submit(function(e) {
        e.preventDefault();
        
        const formData = new FormData(this);
        $('#btn-tambah-pengumuman').html('<svg class="animate-spin w-5 h-5 mr-2 inline" fill="none" stroke="currentColor" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path></svg>Menyimpan...').prop('disabled', true);

        $.ajax({
            url: "{{ route('admin.pengumuman.store') }}",
            method: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            success: function(response) {
                $('#tambah-pengumuman-modal').addClass('hidden');
                $('#tambah-pengumuman-form')[0].reset();
                $('#tambah-file-name').text('Tidak ada file dipilih').removeClass('text-[#004269] font-bold').addClass('text-gray-500 italic');
                
                Swal.fire({
                    icon: 'success',
                    title: 'Berhasil!',
                    text: response.message || 'Pengumuman berhasil ditambahkan!',
                    confirmButtonColor: '#004269',
                    timer: 2000,
                    timerProgressBar: true
                }).then(() => {
                    location.reload();
                });
            },
            error: function(xhr) {
                const res = xhr.responseJSON;
                Swal.fire({
                    icon: 'error',
                    title: 'Gagal!',
                    text: res.message || 'Terjadi kesalahan',
                    confirmButtonColor: '#004269'
                });
            },
            complete: function() {
                $('#btn-tambah-pengumuman').html('<svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>Terbitkan Pengumuman').prop('disabled', false);
            }
        });
    });

    // OPEN EDIT MODAL
    $(document).on('click', '.btn-edit-pengumuman', function() {
        const pengumumanId = $(this).data('id');
        const editUrl = "{{ route('admin.pengumuman.edit', ':id') }}".replace(':id', pengumumanId);

        $.ajax({
            url: editUrl,
            method: 'GET',
            success: function(data) {
                $('#edit-pengumuman-id').val(data.id);
                $('#edit-judul').val(data.judul);
                $('#edit-isi').val(data.isi);
                
                // Handle current file display
                if (data.file_path) {
                    $('#edit-current-file-info').removeClass('hidden');
                    $('#edit-current-file-name').text(data.file_path.split('/').pop());
                    $('#edit-current-file-link').attr('href', '/storage/' + data.file_path);
                } else {
                    $('#edit-current-file-info').addClass('hidden');
                }
                
                $('#edit-file-name').text('Tidak ada file baru dipilih').removeClass('text-[#004269] font-bold').addClass('text-gray-500 italic');
                $('#edit-pengumuman-modal').removeClass('hidden');
            },
            error: function(xhr) {
                Swal.fire({
                    icon: 'error',
                    title: 'Gagal!',
                    text: 'Gagal mengambil data pengumuman',
                    confirmButtonColor: '#004269'
                });
            }
        });
    });

    // CLOSE EDIT MODAL
    $('.close-edit-pengumuman-modal').click(function() {
        $('#edit-pengumuman-modal').addClass('hidden');
        $('#edit-pengumuman-form')[0].reset();
    });

    // SUBMIT UPDATE PENGUMUMAN
    $('#edit-pengumuman-form').submit(function(e) {
        e.preventDefault();
        
        const pengumumanId = $('#edit-pengumuman-id').val();
        const updateUrl = "{{ route('admin.pengumuman.update', ':id') }}".replace(':id', pengumumanId);
        const formData = new FormData(this);

        $('#btn-update-pengumuman').html('<svg class="animate-spin w-5 h-5 mr-2 inline" fill="none" stroke="currentColor" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path></svg>Menyimpan...').prop('disabled', true);

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
                $('#edit-pengumuman-modal').addClass('hidden');
                
                Swal.fire({
                    icon: 'success',
                    title: 'Berhasil!',
                    text: response.message || 'Pengumuman berhasil diperbarui!',
                    confirmButtonColor: '#004269',
                    timer: 2000,
                    timerProgressBar: true
                }).then(() => {
                    location.reload();
                });
            },
            error: function(xhr) {
                const res = xhr.responseJSON;
                Swal.fire({
                    icon: 'error',
                    title: 'Gagal!',
                    text: res.message || 'Terjadi kesalahan',
                    confirmButtonColor: '#004269'
                });
            },
            complete: function() {
                $('#btn-update-pengumuman').html('<svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>Simpan Perubahan').prop('disabled', false);
            }
        });
    });

    // DELETE PENGUMUMAN
    $(document).on('click', '.btn-delete-pengumuman', function() {
        const pengumumanId = $(this).data('id');
        const pengumumanRow = $(this).closest('tr');
        const pengumumanTitle = pengumumanRow.find('td:eq(1) div').text();

        Swal.fire({
            title: 'Hapus Pengumuman?',
            html: `Yakin ingin menghapus pengumuman<br><strong>"${pengumumanTitle}"</strong>?<br><br>Data tidak dapat dikembalikan!`,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#dc2626',
            cancelButtonColor: '#6b7280',
            confirmButtonText: 'Ya, Hapus!',
            cancelButtonText: 'Batal',
            reverseButtons: true
        }).then((result) => {
            if (result.isConfirmed) {
                const deleteUrl = "{{ route('admin.pengumuman.destroy', ':id') }}".replace(':id', pengumumanId);

                $.ajax({
                    url: deleteUrl,
                    method: 'DELETE',
                    data: { _token: "{{ csrf_token() }}" },
                    success: function(response) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Terhapus!',
                            text: response.message || 'Pengumuman berhasil dihapus!',
                            confirmButtonColor: '#004269',
                            timer: 2000,
                            timerProgressBar: true
                        }).then(() => {
                            location.reload();
                        });
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
});
</script>
@endpush