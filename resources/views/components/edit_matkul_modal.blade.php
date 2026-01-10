{{-- resources/views/components/edit_matkul_modal.blade.php --}}

<div id="edit-matkul-modal" class="hidden fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full z-50">
    <div class="relative top-20 mx-auto p-5 border w-11/12 max-w-2xl shadow-lg rounded-md bg-white">
        
        {{-- Modal Header --}}
        <div class="flex justify-between items-center pb-3 border-b">
            <h3 class="text-xl font-bold text-gray-900">Edit Materi Ajar</h3>
            <button class="close-edit-matkul-modal text-gray-400 hover:text-gray-900 text-2xl font-bold">
                &times;
            </button>
        </div>

        {{-- Modal Body --}}
        <form id="edit-matkul-form" class="mt-4" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            
            <input type="hidden" id="edit-matkul-id" name="matkul_id">

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                
                {{-- Kode MK --}}
                <div>
                    <label for="edit-kode-mk" class="block text-sm font-medium text-gray-700">Kode MK *</label>
                    <input type="text" id="edit-kode-mk" name="kode_mk" required
                        class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                </div>

                {{-- Nama Mata Kuliah --}}
                <div>
                    <label for="edit-nama-mk" class="block text-sm font-medium text-gray-700">Nama Mata Kuliah *</label>
                    <input type="text" id="edit-nama-mk" name="nama_mk" required
                        class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                </div>

                {{-- SKS --}}
                <div>
                    <label for="edit-sks" class="block text-sm font-medium text-gray-700">SKS *</label>
                    <input type="number" id="edit-sks" name="sks" required min="1" max="6"
                        class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                </div>

                {{-- Bobot Kompetensi --}}
                <div>
                    <label for="edit-bobot-kompetensi" class="block text-sm font-medium text-gray-700">Bobot Kompetensi *</label>
                    <input type="number" id="edit-bobot-kompetensi" name="bobot_kompetensi" required min="0" max="100"
                        placeholder="0-100"
                        class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                </div>

                {{-- Semester --}}
                <div>
                    <label for="edit-semester" class="block text-sm font-medium text-gray-700">Semester *</label>
                    <select id="edit-semester" name="semester" required
                        class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                        <option value="">-- Pilih Semester --</option>
                        {{-- Will be populated by JavaScript from database --}}
                    </select>
                </div>

                {{-- Bidang Keahlian --}}
                <div>
                    <label for="edit-bidang-keahlian" class="block text-sm font-medium text-gray-700">Bidang Keahlian *</label>
                    <select id="edit-bidang-keahlian" name="id_bidang_keahlian" required
                        class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                        <option value="">-- Pilih Bidang Keahlian --</option>
                        {{-- Will be populated by JavaScript --}}
                    </select>
                </div>

                {{-- Current SAP File & Upload New --}}
                <div class="md:col-span-2">
                    <label class="block text-sm font-medium text-gray-700">File SAP Saat Ini</label>
                    <div id="current-sap-display" class="mt-1 mb-2 text-sm text-gray-600">
                        <span id="current-sap-name">Tidak ada file</span>
                    </div>
                    
                    <label for="edit-sap-file" class="block text-sm font-medium text-gray-700 mt-3">Upload SAP Baru (PDF/DOC/DOCX, Max 10MB)</label>
                    <input type="file" id="edit-sap-file" name="sap_file" accept=".pdf,.doc,.docx"
                        class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                    <p class="mt-1 text-xs text-gray-500">Optional: Upload file baru untuk mengganti yang lama</p>
                </div>

                {{-- Deskripsi (Full Width) --}}
                <div class="md:col-span-2">
                    <label for="edit-deskripsi" class="block text-sm font-medium text-gray-700">Deskripsi</label>
                    <textarea id="edit-deskripsi" name="deskripsi" rows="3"
                        class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500"></textarea>
                </div>

            </div>

            {{-- Modal Footer --}}
            <div class="mt-6 flex justify-end space-x-3 border-t pt-4">
                <button type="button" class="close-edit-matkul-modal px-4 py-2 bg-gray-300 text-gray-700 rounded-md hover:bg-gray-400 transition">
                    Batal
                </button>
                <button type="submit" id="btn-update-matkul" class="px-4 py-2 bg-[#009DA5] text-white rounded-md hover:bg-[#00888f] transition shadow-sm">
                    Simpan
                </button>
            </div>
        </form>

    </div>
</div>
