{{-- resources/views/akademik/pengumuman/create.blade.php --}}

@extends('layouts.app')

@section('content')

<div class="p-6">
    {{-- Header Page --}}
    <div class="flex justify-between items-center mb-8">
        <div>
            <h1 class="text-2xl font-extrabold text-[#004269] tracking-tight">Buat Pengumuman Baru</h1>
            <p class="text-sm text-gray-500 mt-1">Publikasikan informasi penting untuk mahasiswa dan dosen.</p>
        </div>
        <a href="{{ route('admin.pengumuman.index') }}" class="group flex items-center px-4 py-2 bg-gray-100 hover:bg-gray-200 text-gray-600 hover:text-gray-800 rounded-xl font-bold transition-all duration-200 text-sm">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 mr-2 transition-transform group-hover:-translate-x-1" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
            </svg>
            Kembali
        </a>
    </div>

    {{-- Form Card --}}
    <div class="bg-white rounded-2xl shadow-xl shadow-gray-200/50 overflow-hidden border border-gray-100 max-w-4xl mx-auto">
        {{-- Decorative Top Bar --}}
        <div class="h-1.5 w-full bg-gradient-to-r from-[#004269] via-[#00536e] to-[#009DA5]"></div>
        
        <form action="{{ route('admin.pengumuman.store') }}" method="POST" enctype="multipart/form-data" class="p-8">
            @csrf
            
            <div class="space-y-6">
                
                {{-- Judul --}}
                <div class="group">
                    <label for="judul" class="block text-xs font-bold text-gray-500 uppercase tracking-wider mb-2 flex items-center">
                        <svg class="w-4 h-4 mr-1.5 text-[#009DA5]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                        Judul Pengumuman <span class="text-red-500 ml-1">*</span>
                    </label>
                    <input type="text" id="judul" name="judul" required placeholder="Contoh: Jadwal Libur Semester Ganjil 2025" 
                        class="w-full p-3.5 text-sm font-bold text-gray-700 bg-gray-50 border border-gray-200 rounded-xl outline-none focus:bg-white focus:border-[#009DA5] focus:ring-4 focus:ring-[#009DA5]/10 transition-all duration-200 placeholder-gray-400">
                    @error('judul') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>

                {{-- Isi --}}
                <div class="group">
                    <label for="isi" class="block text-xs font-bold text-gray-500 uppercase tracking-wider mb-2 flex items-center">
                        <svg class="w-4 h-4 mr-1.5 text-[#009DA5]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h7"/></svg>
                        Isi Pengumuman <span class="text-red-500 ml-1">*</span>
                    </label>
                    <textarea id="isi" name="isi" rows="8" required placeholder="Tuliskan detail pengumuman secara lengkap di sini..." 
                        class="w-full p-3.5 text-sm font-medium text-gray-700 bg-gray-50 border border-gray-200 rounded-xl outline-none focus:bg-white focus:border-[#009DA5] focus:ring-4 focus:ring-[#009DA5]/10 transition-all duration-200 placeholder-gray-400 resize-none"></textarea>
                    @error('isi') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>

                {{-- File Upload --}}
                <div class="group">
                    <label class="block text-xs font-bold text-gray-500 uppercase tracking-wider mb-2 flex items-center">
                        <svg class="w-4 h-4 mr-1.5 text-[#009DA5]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.172 7l-6.586 6.586a2 2 0 102.828 2.828l6.414-6.586a4 4 0 00-5.656-5.656l-6.415 6.585a6 6 0 108.486 8.486L20.5 13"/></svg>
                        Lampiran File (Opsional)
                    </label>
                    <div class="flex items-center space-x-4">
                        <label for="file" class="cursor-pointer group flex items-center justify-center px-5 py-3 bg-[#004269]/5 hover:bg-[#004269]/10 text-[#004269] border border-[#004269]/20 border-dashed rounded-xl font-bold transition-all duration-200">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"/></svg>
                            Pilih File
                        </label>
                        <input type="file" id="file" name="file" class="hidden" onchange="updateFileName(this)">
                        
                        <div class="flex-1">
                            <span id="file-name" class="text-sm font-medium text-gray-500 italic block truncate">Tidak ada file dipilih</span>
                            <p class="text-[10px] text-gray-400 mt-0.5 font-medium">Format: PDF, JPG, PNG, DOCX (Max: 5MB)</p>
                        </div>
                    </div>
                    @error('file') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>

            </div>

            {{-- Submit Button --}}
            <div class="mt-10 flex justify-end space-x-3 pt-6 border-t border-gray-100">
                <a href="{{ route('admin.pengumuman.index') }}" class="px-6 py-3 rounded-xl font-bold text-gray-500 hover:text-gray-700 hover:bg-gray-100 transition-all duration-200">
                    Batal
                </a>
                <button type="submit" class="px-8 py-3 bg-[#004269] hover:bg-[#003350] text-white rounded-xl font-bold transition-all duration-300 shadow-[0_4px_14px_0_rgba(0,66,105,0.39)] hover:shadow-[0_6px_20px_rgba(0,66,105,0.23)] hover:-translate-y-0.5 flex items-center">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                    Terbitkan Pengumuman
                </button>
            </div>
        </form>
    </div>
</div>

<script>
    function updateFileName(input) {
        const fileName = input.files[0] ? input.files[0].name : 'Tidak ada file dipilih';
        const displayElement = document.getElementById('file-name');
        
        displayElement.textContent = fileName;
        
        if (input.files[0]) {
            displayElement.classList.remove('text-gray-500', 'italic');
            displayElement.classList.add('text-[#004269]', 'font-bold');
        } else {
            displayElement.classList.add('text-gray-500', 'italic');
            displayElement.classList.remove('text-[#004269]', 'font-bold');
        }
    }
</script>

@endsection