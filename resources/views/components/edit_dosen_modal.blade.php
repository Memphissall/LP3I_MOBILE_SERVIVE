{{-- resources/views/components/edit_dosen_modal.blade.php --}}

<div id="edit-dosen-modal" class="hidden fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full z-50">
    <div class="relative top-20 mx-auto p-5 border w-11/12 max-w-3xl shadow-lg rounded-md bg-white">
        
        {{-- Modal Header --}}
        <div class="flex justify-between items-center pb-3 border-b">
            <h3 class="text-xl font-bold text-gray-900">Edit Data Dosen</h3>
            <button class="close-edit-dosen-modal text-gray-400 hover:text-gray-900 text-2xl font-bold">
                &times;
            </button>
        </div>

        {{-- Modal Body --}}
        <form id="edit-dosen-form" class="mt-4">
            @csrf
            @method('PUT')
            
            <input type="hidden" id="edit-dosen-id" name="dosen_id">

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                
                {{-- NIDN --}}
                <div>
                    <label for="edit-nidn" class="block text-sm font-medium text-gray-700">NIDN *</label>
                    <input type="text" id="edit-nidn" name="nidn" required
                        class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                </div>

                {{-- ID Dosen Internal --}}
                <div>
                    <label for="edit-id-internal" class="block text-sm font-medium text-gray-700">ID Internal Kampus</label>
                    <input type="text" id="edit-id-internal" name="id_dosen_internal"
                        placeholder="Contoh: DSN-001"
                        class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                </div>

                {{-- Nama Dosen --}}
                <div>
                    <label for="edit-nama" class="block text-sm font-medium text-gray-700">Nama Lengkap *</label>
                    <input type="text" id="edit-nama" name="nama_dosen" required
                        class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                </div>

                {{-- Pendidikan --}}
                <div>
                    <label for="edit-pendidikan-select" class="block text-sm font-medium text-gray-700">Pendidikan Terakhir *</label>
                    <select id="edit-pendidikan-select" required
                        class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                        <option value="">-- Pilih Pendidikan --</option>
                        <!-- Options will be populated from database -->
                        <option value="__custom__">Lainnya (Custom)</option>
                    </select>
                    
                    {{-- Hidden input for custom value --}}
                    <input type="text" id="edit-pendidikan-custom" name="pendidikan" 
                        placeholder="Masukkan pendidikan custom, contoh: S2 - Pendidikan Bahasa"
                        class="mt-2 hidden block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                    
                    {{-- Hidden input for selected value --}}
                    <input type="hidden" id="edit-pendidikan" name="pendidikan">
                </div>

                {{-- Bidang Keahlian --}}
                <div>
                    <label for="edit-bidang" class="block text-sm font-medium text-gray-700">Bidang Keahlian *</label>
                    <input type="text" id="edit-bidang" name="bidang" required
                        class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                </div>

                {{-- Tempat Lahir --}}
                <div>
                    <label for="edit-tempat" class="block text-sm font-medium text-gray-700">Tempat Lahir *</label>
                    <input type="text" id="edit-tempat" name="tempat" required
                        class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                </div>

                {{-- Tanggal Lahir --}}
                <div>
                    <label for="edit-tanggal-lahir" class="block text-sm font-medium text-gray-700">Tanggal Lahir *</label>
                    <input type="date" id="edit-tanggal-lahir" name="tanggal_lahir" required
                        class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                </div>

                {{-- Jenis Kelamin --}}
                <div>
                    <label for="edit-jenis-kelamin" class="block text-sm font-medium text-gray-700">Jenis Kelamin *</label>
                    <select id="edit-jenis-kelamin" name="jenis_kelamin" required
                        class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                        <option value="">-- Pilih --</option>
                        <option value="Laki-laki">Laki-laki</option>
                        <option value="Perempuan">Perempuan</option>
                    </select>
                </div>

                {{-- Agama --}}
                <div>
                    <label for="edit-agama" class="block text-sm font-medium text-gray-700">Agama *</label>
                    <select id="edit-agama" name="agama" required
                        class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                        <option value="">-- Pilih --</option>
                        <option value="Islam">Islam</option>
                        <option value="Kristen">Kristen</option>
                        <option value="Katolik">Katolik</option>
                        <option value="Hindu">Hindu</option>
                        <option value="Buddha">Buddha</option>
                        <option value="Konghucu">Konghucu</option>
                    </select>
                </div>

                {{-- Alamat --}}
                <div>
                    <label for="edit-alamat" class="block text-sm font-medium text-gray-700">Alamat</label>
                    <textarea id="edit-alamat" name="alamat" rows="2"
                        placeholder="Alamat lengkap dosen"
                        class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500"></textarea>
                </div>

                {{-- Email --}}
                <div>
                    <label for="edit-email" class="block text-sm font-medium text-gray-700">Email *</label>
                    <input type="email" id="edit-email" name="email" required
                        class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                </div>

                {{-- No. Telepon --}}
                <div>
                    <label for="edit-no-telp" class="block text-sm font-medium text-gray-700">No. Telepon *</label>
                    <input type="text" id="edit-no-telp" name="no_telp" required
                        class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                </div>

                {{-- Honor per SKS --}}
                <div>
                    <label for="edit-honor" class="block text-sm font-medium text-gray-700">Honor per SKS (Rp) *</label>
                    <input type="number" id="edit-honor" name="honor_per_sks" required min="0"
                        class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                </div>

                {{-- Status --}}
                <div>
                    <label for="edit-status" class="block text-sm font-medium text-gray-700">Status *</label>
                    <select id="edit-status" name="status" required
                        class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                        <option value="">-- Pilih Status --</option>
                        <option value="aktif">Aktif</option>
                        <option value="tidak aktif">Tidak Aktif</option>
                        <option value="kontrak">Kontrak</option>
                        <option value="tetap">Tetap</option>
                        <option value="honorer">Honorer</option>
                    </select>
                </div>

            </div>

            {{-- Modal Footer --}}
            <div class="mt-6 flex justify-end space-x-3 border-t pt-4">
                <button type="button" class="close-edit-dosen-modal px-4 py-2 bg-gray-300 text-gray-700 rounded-md hover:bg-gray-400 transition">
                    Batal
                </button>
                <button type="submit" id="btn-update-dosen" class="px-4 py-2 bg-[#009DA5] text-white rounded-md hover:bg-[#00888f] transition shadow-sm">
                    Simpan Perubahan
                </button>
            </div>
        </form>

    </div>
</div>
