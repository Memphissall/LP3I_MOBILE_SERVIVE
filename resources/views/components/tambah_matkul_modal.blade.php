{{-- resources/views/components/tambah_matkul_modal.blade.php --}}

<div id="tambah-matkul-modal" class="hidden fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full z-50">
    <div class="relative top-20 mx-auto p-5 border w-11/12 max-w-2xl shadow-lg rounded-md bg-white">
        
        {{-- Modal Header --}}
        <div class="flex justify-between items-center pb-3 border-b">
            <h3 class="text-xl font-bold text-gray-900">Tambah Mata Kuliah</h3>
            <button class="close-tambah-matkul-modal text-gray-400 hover:text-gray-900 text-2xl font-bold">
                &times;
            </button>
        </div>

        {{-- Modal Body --}}
        <form id="tambah-matkul-form" class="mt-4">
            @csrf

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                
                {{-- Kode MK --}}
                <div>
                    <label for="tambah-kode-mk" class="block text-sm font-medium text-gray-700">Kode MK *</label>
                    <input type="text" id="tambah-kode-mk" name="kode_mk" required
                        placeholder="e.g., TI101"
                        class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                </div>

                {{-- Nama Mata Kuliah --}}
                <div>
                    <label for="tambah-nama-mk" class="block text-sm font-medium text-gray-700">Nama Mata Kuliah *</label>
                    <input type="text" id="tambah-nama-mk" name="nama_mk" required
                        class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                </div>

                {{-- SKS --}}
                <div>
                    <label for="tambah-sks" class="block text-sm font-medium text-gray-700">SKS *</label>
                    <input type="number" id="tambah-sks" name="sks" required min="1" max="6"
                        class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                </div>

                {{-- Semester --}}
                <div>
                    <label for="tambah-semester" class="block text-sm font-medium text-gray-700">Semester *</label>
                    <select id="tambah-semester" name="semester" required
                        class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                        <option value="">-- Pilih Semester --</option>
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

                {{-- Jenis --}}
                <div>
                    <label for="tambah-jenis" class="block text-sm font-medium text-gray-700">Jenis *</label>
                    <select id="tambah-jenis" name="jenis" required
                        class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                        <option value="">-- Pilih Jenis --</option>
                        <option value="Wajib">Wajib</option>
                        <option value="Pilihan">Pilihan</option>
                    </select>
                </div>

                {{-- Jurusan --}}
                <div>
                    <label for="tambah-jurusan" class="block text-sm font-medium text-gray-700">Jurusan *</label>
                    <select id="tambah-jurusan" name="jurusan" required
                        class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                        <option value="">-- Pilih Jurusan --</option>
                        <option value="Teknik Informatika">Teknik Informatika</option>
                        <option value="Sistem Informasi">Sistem Informasi</option>
                        <option value="Akuntansi">Akuntansi</option>
                    </select>
                </div>

                {{-- Deskripsi (Full Width) --}}
                <div class="md:col-span-2">
                    <label for="tambah-deskripsi" class="block text-sm font-medium text-gray-700">Deskripsi</label>
                    <textarea id="tambah-deskripsi" name="deskripsi" rows="3"
                        class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500"></textarea>
                </div>

            </div>

            {{-- Modal Footer --}}
            <div class="mt-6 flex justify-end space-x-3 border-t pt-4">
                <button type="button" class="close-tambah-matkul-modal px-4 py-2 bg-gray-300 text-gray-700 rounded-md hover:bg-gray-400 transition">
                    Batal
                </button>
                <button type="submit" id="btn-tambah-matkul" class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 transition">
                    Simpan Data
                </button>
            </div>
        </form>

    </div>
</div>
