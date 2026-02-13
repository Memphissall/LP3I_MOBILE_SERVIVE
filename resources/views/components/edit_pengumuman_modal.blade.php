{{-- components/edit_pengumuman_modal.blade.php --}}

{{-- MODAL EDIT PENGUMUMAN --}}
<div id="edit-pengumuman-modal" class="fixed inset-0 bg-gray-900 bg-opacity-50 hidden z-50 flex items-center justify-center p-4">
    <div class="bg-white rounded-2xl shadow-2xl w-full max-w-2xl transform transition-all">
        {{-- Modal Header --}}
        <div class="relative overflow-hidden">
            <div class="h-1.5 w-full bg-gradient-to-r from-[#004269] via-[#00536e] to-[#009DA5]"></div>
            <div class="p-6 border-b border-gray-100">
                <div class="flex items-center justify-between">
                    <div class="flex items-center space-x-3">
                        <div class="bg-[#004269]/10 p-2.5 rounded-xl text-[#004269]">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                            </svg>
                        </div>
                        <div>
                            <h3 class="text-xl font-bold text-gray-800">Edit Pengumuman</h3>
                            <p class="text-xs text-gray-500 mt-0.5">Perbarui informasi pengumuman yang sudah ada</p>
                        </div>
                    </div>
                    <button type="button" class="close-edit-pengumuman-modal text-gray-400 hover:text-gray-600 hover:bg-gray-100 rounded-lg p-2 transition-all">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                        </svg>
                    </button>
                </div>
            </div>
        </div>

        {{-- Modal Body --}}
        <form id="edit-pengumuman-form" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <input type="hidden" id="edit-pengumuman-id" name="id">
            
            <div class="p-6 max-h-[60vh] overflow-y-auto space-y-5">
                
                {{-- Judul --}}
                <div class="group">
                    <label for="edit-judul" class="block text-xs font-bold text-gray-500 uppercase tracking-wider mb-2 flex items-center">
                        <svg class="w-4 h-4 mr-1.5 text-[#009DA5]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                        </svg>
                        Judul Pengumuman <span class="text-red-500 ml-1">*</span>
                    </label>
                    <input type="text" id="edit-judul" name="judul_pengumuman" required placeholder="Contoh: Jadwal Libur Semester Ganjil 2025" 
                        class="w-full p-3.5 text-sm font-bold text-gray-700 bg-gray-50 border border-gray-200 rounded-xl outline-none focus:bg-white focus:border-[#009DA5] focus:ring-4 focus:ring-[#009DA5]/10 transition-all duration-200 placeholder-gray-400">
                </div>

                {{-- Isi --}}
                <div class="group">
                    <label for="edit-isi" class="block text-xs font-bold text-gray-500 uppercase tracking-wider mb-2 flex items-center">
                        <svg class="w-4 h-4 mr-1.5 text-[#009DA5]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h7"/>
                        </svg>
                        Isi Pengumuman <span class="text-red-500 ml-1">*</span>
                    </label>
                    <textarea id="edit-isi" name="isi" rows="6" required placeholder="Tuliskan detail pengumuman secara lengkap di sini..." 
                        class="w-full p-3.5 text-sm font-medium text-gray-700 bg-gray-50 border border-gray-200 rounded-xl outline-none focus:bg-white focus:border-[#009DA5] focus:ring-4 focus:ring-[#009DA5]/10 transition-all duration-200 placeholder-gray-400 resize-none"></textarea>
                </div>

                {{-- Current File Info --}}
                <div id="edit-current-file-info" class="hidden">
                    <div class="mb-4 p-4 bg-blue-50 border border-blue-100 rounded-xl flex items-start space-x-3">
                        <div class="bg-white p-2 rounded-lg text-blue-500 shadow-sm">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                            </svg>
                        </div>
                        <div>
                            <p class="text-xs font-bold text-blue-800 uppercase tracking-wide mb-0.5">File Saat Ini</p>
                            <a id="edit-current-file-link" href="#" target="_blank" class="text-sm font-medium text-blue-600 hover:text-blue-800 hover:underline flex items-center transition-colors">
                                <span id="edit-current-file-name"></span>
                                <svg class="w-3 h-3 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/>
                                </svg>
                            </a>
                            <p class="text-[10px] text-blue-400 mt-1">*Upload file baru di bawah jika ingin mengganti file ini.</p>
                        </div>
                    </div>
                </div>

                {{-- File Upload --}}
                <div class="group">
                    <label class="block text-xs font-bold text-gray-500 uppercase tracking-wider mb-2 flex items-center">
                        <svg class="w-4 h-4 mr-1.5 text-[#009DA5]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.172 7l-6.586 6.586a2 2 0 102.828 2.828l6.414-6.586a4 4 0 00-5.656-5.656l-6.415 6.585a6 6 0 108.486 8.486L20.5 13"/>
                        </svg>
                        Lampiran File (Opsional)
                    </label>
                    <div class="flex items-center space-x-4">
                        <label for="edit-file" class="cursor-pointer group flex items-center justify-center px-5 py-3 bg-[#004269]/5 hover:bg-[#004269]/10 text-[#004269] border border-[#004269]/20 border-dashed rounded-xl font-bold transition-all duration-200">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"/>
                            </svg>
                            Pilih File Baru
                        </label>
                        <input type="file" id="edit-file" name="file" class="hidden" onchange="updateEditFileName(this)">
                        
                        <div class="flex-1">
                            <span id="edit-file-name" class="text-sm font-medium text-gray-500 italic block truncate">Tidak ada file baru dipilih</span>
                            <p class="text-[10px] text-gray-400 mt-0.5 font-medium">Format: PDF, JPG, PNG, DOCX (Max: 5MB)</p>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Modal Footer --}}
            <div class="p-6 border-t border-gray-100 flex justify-end space-x-3">
                <button type="button" class="close-edit-pengumuman-modal px-6 py-3 rounded-xl font-bold text-gray-500 hover:text-gray-700 hover:bg-gray-100 transition-all duration-200">
                    Batal
                </button>
                <button type="submit" id="btn-update-pengumuman" class="px-8 py-3 bg-[#004269] hover:bg-[#003350] text-white rounded-xl font-bold transition-all duration-300 shadow-[0_4px_14px_0_rgba(0,66,105,0.39)] hover:shadow-[0_6px_20px_rgba(0,66,105,0.23)] hover:-translate-y-0.5 flex items-center">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                    </svg>
                    Simpan Perubahan
                </button>
            </div>
        </form>
    </div>
</div>

<script>
function updateEditFileName(input) {
    const fileName = input.files[0] ? input.files[0].name : 'Tidak ada file baru dipilih';
    const displayElement = document.getElementById('edit-file-name');
    
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
