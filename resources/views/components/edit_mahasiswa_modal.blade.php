<div id="edit-mahasiswa-modal" class="hidden fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full z-50">
    <div class="relative top-10 mx-auto p-5 border w-11/12 max-w-2xl shadow-lg rounded-md bg-white">
        <div class="flex justify-between items-center pb-3 border-b">
            <h3 class="text-xl font-bold text-gray-900">Edit Data Mahasiswa</h3>
            <button type="button" class="close-edit-modal text-gray-400 hover:text-gray-900 text-2xl">&times;</button>
        </div>

        <form id="edit-student-form" class="mt-4">
            @csrf
            @method('PUT')
            {{-- ID ini penting banget buat logic UPDATE --}}
            <input type="hidden" id="edit-student-id" name="id">

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                {{-- Kolom NIPD --}}
                <div>
                    <label class="block text-sm font-medium text-gray-700">NIM/NIPD</label>
                    <input type="text" id="edit-nipd" name="nipd" required class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md bg-gray-50" readonly>
                </div>

                {{-- Kolom Nama --}}
                <div>
                    <label class="block text-sm font-medium text-gray-700">Nama Lengkap</label>
                    <input type="text" id="edit-nama" name="nama" required class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm">
                </div>

                {{-- Kolom Jurusan --}}
                <div>
                    <label class="block text-sm font-medium text-gray-700">Jurusan</label>
                    <select id="edit-jurusan" name="jurusan" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md">
                        <option value="">-- Jurusan --</option>
                    </select>
                </div>

                {{-- Kolom Angkatan --}}
                <div>
                    <label class="block text-sm font-medium text-gray-700">Angkatan</label>
                    <input type="number" id="edit-angkatan" name="angkatan" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md">
                </div>

                {{-- Kolom Periode --}}
                <div>
                    <label class="block text-sm font-medium text-gray-700">Periode</label>
                    <select id="edit-periode" name="periode" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md">
                    <option value="">-- Periode --</option>
                    </select>
                </div>

                {{-- Kolom Kelas --}}                    
                <div>
                    <label class="text-sm font-medium text-gray-600">Kelas</label>
                    <select name="id_kelas" id="edit-id-kelas"" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md">
                        <option value="">-- Kelas --</option>
                    </select>
                </div>
            </div>

            <div class="mt-6 flex justify-end space-x-3 border-t pt-4">
                <button type="button" class="close-edit-modal px-4 py-2 bg-gray-300 text-gray-700 rounded-md hover:bg-gray-400">Batal</button>
                <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700">Simpan Perubahan</button>
            </div>
        </form>
    </div>
</div>