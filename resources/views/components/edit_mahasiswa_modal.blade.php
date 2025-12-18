{{-- resources/views/components/edit_mahasiswa_modal.blade.php --}}

<div id="edit-mahasiswa-modal" class="hidden fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full z-50">
    <div class="relative top-20 mx-auto p-5 border w-11/12 max-w-2xl shadow-lg rounded-md bg-white">
        
        {{-- Modal Header --}}
        <div class="flex justify-between items-center pb-3 border-b">
            <h3 class="text-xl font-bold text-gray-900">Edit Data Mahasiswa</h3>
            <button class="close-edit-modal text-gray-400 hover:text-gray-900 text-2xl font-bold">
                &times;
            </button>
        </div>

        {{-- Modal Body --}}
        <form id="edit-student-form" class="mt-4">
            @csrf
            @method('PUT')
            
            <input type="hidden" id="edit-student-id" name="student_id">

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                
                {{-- NIPD/NIM --}}
                <div>
                    <label for="edit-nipd" class="block text-sm font-medium text-gray-700">NIM *</label>
                    <input type="text" id="edit-nipd" name="nipd" required
                        class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                </div>

                {{-- Nama --}}
                <div>
                    <label for="edit-nama" class="block text-sm font-medium text-gray-700">Nama Lengkap *</label>
                    <input type="text" id="edit-nama" name="nama" required
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

                {{-- Tempat Lahir --}}
                <div>
                    <label for="edit-tempat-lahir" class="block text-sm font-medium text-gray-700">Tempat Lahir *</label>
                    <input type="text" id="edit-tempat-lahir" name="tempat_lahir" required
                        class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                </div>

                {{-- Tanggal Lahir --}}
                <div>
                    <label for="edit-tgl-lahir" class="block text-sm font-medium text-gray-700">Tanggal Lahir *</label>
                    <input type="date" id="edit-tgl-lahir" name="tgl_lahir" required
                        class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                </div>

                {{-- Jurusan --}}
                <div>
                    <label for="edit-jurusan" class="block text-sm font-medium text-gray-700">Jurusan *</label>
                    <select id="edit-jurusan" name="jurusan" required
                        class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                        <option value="">-- Pilih Jurusan --</option>
                        <option value="Teknik Informatika">Teknik Informatika</option>
                        <option value="Sistem Informasi">Sistem Informasi</option>
                        <option value="Akuntansi">Akuntansi</option>
                    </select>
                </div>

                {{-- Email --}}
                <div>
                    <label for="edit-email" class="block text-sm font-medium text-gray-700">Email *</label>
                    <input type="email" id="edit-email" name="email" required
                        class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                </div>

                {{-- No. Telepon --}}
                <div>
                    <label for="edit-no-tlp" class="block text-sm font-medium text-gray-700">No. Telepon *</label>
                    <input type="text" id="edit-no-tlp" name="no_tlp" required
                        class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                </div>

                {{-- Agama --}}
                <div>
                    <label for="edit-agama" class="block text-sm font-medium text-gray-700">Agama *</label>
                    <select id="edit-agama" name="agama" required
                        class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                        <option value="">-- Pilih Agama --</option>
                        <option value="Islam">Islam</option>
                        <option value="Kristen">Kristen</option>
                        <option value="Katolik">Katolik</option>
                        <option value="Hindu">Hindu</option>
                        <option value="Buddha">Buddha</option>
                        <option value="Konghucu">Konghucu</option>
                    </select>
                </div>

                {{-- Angkatan --}}
                <div>
                    <label for="edit-angkatan" class="block text-sm font-medium text-gray-700">Angkatan</label>
                    <input type="text" id="edit-angkatan" name="angkatan"
                        class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                </div>

                {{-- Periode --}}
                <div>
                    <label for="edit-periode" class="block text-sm font-medium text-gray-700">Periode</label>
                    <select id="edit-periode" name="periode"
                        class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                        <option value="">-- Pilih --</option>
                        <option value="Ganjil">Ganjil</option>
                        <option value="Genap">Genap</option>
                    </select>
                </div>

                {{-- Status --}}
                <div>
                    <label for="edit-status" class="block text-sm font-medium text-gray-700">Status *</label>
                    <select id="edit-status" name="status" required
                        class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                        <option value="">-- Pilih Status --</option>
                        <option value="Aktif">Aktif</option>
                        <option value="Tidak Aktif">Tidak Aktif</option>
                    </select>
                </div>

                {{-- Alamat (Full Width) --}}
                <div class="md:col-span-2">
                    <label for="edit-alamat" class="block text-sm font-medium text-gray-700">Alamat *</label>
                    <textarea id="edit-alamat" name="alamat" rows="3" required
                        class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500"></textarea>
                </div>

            </div>

            {{-- Modal Footer --}}
            <div class="mt-6 flex justify-end space-x-3 border-t pt-4">
                <button type="button" class="close-edit-modal px-4 py-2 bg-gray-300 text-gray-700 rounded-md hover:bg-gray-400 transition">
                    Batal
                </button>
                <button type="submit" id="btn-update-student" class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 transition">
                    Simpan Perubahan
                </button>
            </div>
        </form>

    </div>
</div>
