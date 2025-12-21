{{-- resources/views/components/tambah_jadwal_modal.blade.php --}}

<div id="tambah-jadwal-modal" class="hidden fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full z-50">
    <div class="relative top-20 mx-auto p-5 border w-11/12 max-w-2xl shadow-lg rounded-md bg-white">
        
        {{-- Modal Header --}}
        <div class="flex justify-between items-center pb-3 border-b">
            <h3 class="text-xl font-bold text-gray-900">Tambah Jadwal</h3>
            <button class="close-tambah-jadwal-modal text-gray-400 hover:text-gray-900 text-2xl font-bold">
                &times;
            </button>
        </div>

        {{-- Modal Body --}}
        <form id="tambah-jadwal-form" class="mt-4">
            @csrf

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                
                {{-- Mata Kuliah --}}
                <div class="md:col-span-2">
                    <label for="tambah-kode-mk" class="block text-sm font-medium text-gray-700">Mata Kuliah *</label>
                    <select id="tambah-kode-mk" name="kode_mk" required
                        class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                        <option value="">-- Pilih Mata Kuliah --</option>
                    </select>
                    <span id="tambah-sks-info" class="text-sm text-gray-600 mt-1 hidden"></span>
                </div>

                {{-- Kelas --}}
                <div>
                    <label for="tambah-id-kelas" class="block text-sm font-medium text-gray-700">Kelas *</label>
                    <select id="tambah-id-kelas" name="id_kelas" required
                        class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                        <option value="">-- Pilih Kelas --</option>
                    </select>
                </div>

                {{-- Ruangan --}}
                <div>
                    <label for="tambah-id-ruangan" class="block text-sm font-medium text-gray-700">Ruangan *</label>
                    <select id="tambah-id-ruangan" name="id_ruangan" required
                        class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                        <option value="">-- Pilih Ruangan --</option>
                    </select>
                </div>

                {{-- Hari --}}
                <div>
                    <label for="tambah-hari" class="block text-sm font-medium text-gray-700">Hari *</label>
                    <select id="tambah-hari" name="hari" required
                        class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                        <option value="">-- Pilih Hari --</option>
                        <option value="Senin">Senin</option>
                        <option value="Selasa">Selasa</option>
                        <option value="Rabu">Rabu</option>
                        <option value="Kamis">Kamis</option>
                        <option value="Jumat">Jumat</option>
                        <option value="Sabtu">Sabtu</option>
                    </select>
                </div>

                {{-- Waktu (Dynamic based on SKS) --}}
                <div>
                    <label for="tambah-waktu" class="block text-sm font-medium text-gray-700">Waktu *</label>
                    <select id="tambah-waktu" name="waktu" required
                        class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                        <option value="">-- Pilih Mata Kuliah Dulu --</option>
                    </select>
                </div>

                {{-- Status --}}
                <div class="md:col-span-2">
                    <label for="tambah-status" class="block text-sm font-medium text-gray-700">Status *</label>
                    <select id="tambah-status" name="status" required
                        class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                        <option value="">-- Pilih Status --</option>
                        <option value="Offline">Offline</option>
                        <option value="Online">Online</option>
                        <option value="Libur">Libur</option>
                        <option value="Kelas Tunjangan">Kelas Tunjangan</option>
                        <option value="Belum Ada Konfirmasi">Belum Ada Konfirmasi</option>
                    </select>
                </div>

            </div>

            {{-- Modal Footer --}}
            <div class="mt-6 flex justify-end space-x-3 border-t pt-4">
                <button type="button" class="close-tambah-jadwal-modal px-4 py-2 bg-gray-300 text-gray-700 rounded-md hover:bg-gray-400 transition">
                    Batal
                </button>
                <button type="submit" id="btn-tambah-jadwal" class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 transition">
                    Simpan Data
                </button>
            </div>
        </form>

    </div>
</div>
