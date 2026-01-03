{{-- Edit Jadwal Modal with Cascading Dropdowns --}}
<div id="edit-jadwal-modal" class="fixed z-50 inset-0 overflow-y-auto hidden">
    <div class="flex items-center justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:block sm:p-0">
        <div class="fixed inset-0 transition-opacity bg-gray-500 bg-opacity-75" aria-hidden="true"></div>
        
        <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-2xl sm:w-full">
            <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="text-lg leading-6 font-bold text-gray-900">Edit Jadwal</h3>
                    <button class="close-edit-jadwal-modal text-gray-400 hover:text-gray-600">
                        <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                </div>

                <form id="edit-jadwal-form" class="space-y-4">
                    @csrf
                    <input type="hidden" id="edit-jadwal-id" name="id_jadwal">

                    {{-- CASCADING SECTION 1: Bidang Keahlian --}}
                    <div>
                        <label for="edit-bidang-keahlian" class="block text-sm font-medium text-gray-700">Bidang Keahlian (Prodi) *</label>
                        <select id="edit-bidang-keahlian" name="bidang_keahlian_filter" required 
                            class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                            <option value="">-- Pilih Bidang Keahlian --</option>
                        </select>
                    </div>

                    {{-- CASCADING SECTION 2: Semester --}}
                    <div>
                        <label for="edit-semester" class="block text-sm font-medium text-gray-700">Semester *</label>
                        <select id="edit-semester" name="semester_filter" required 
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

                    {{-- CASCADING SECTION 3: Mata Kuliah --}}
                    <div>
                        <label for="edit-id-matkul" class="block text-sm font-medium text-gray-700">Mata Kuliah *</label>
                        <select id="edit-id-matkul" name="id_matkul" required 
                            class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                            <option value="">-- Pilih Semester Dulu --</option>
                        </select>
                        <p id="edit-sks-info" class="text-xs text-gray-500 mt-1 hidden"></p>
                    </div>

                    {{-- Dosen --}}
                    <div>
                        <label for="edit-id-dosen" class="block text-sm font-medium text-gray-700">Dosen Pengampu *</label>
                        <select id="edit-id-dosen" name="id_dosen" required 
                            class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                            <option value="">-- Pilih Mata Kuliah Dulu --</option>
                        </select>
                    </div>

                    {{-- CASCADING SECTION 4: Kelas --}}
                    <div>
                        <label for="edit-id-kelas" class="block text-sm font-medium text-gray-700">Kelas *</label>
                        <select id="edit-id-kelas" name="id_kelas" required 
                            class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                            <option value="">-- Pilih Bidang Keahlian Dulu --</option>
                        </select>
                    </div>

                    <div class="grid grid-cols-2 gap-4">
                        {{-- Hari --}}
                        <div>
                            <label for="edit-hari" class="block text-sm font-medium text-gray-700">Hari *</label>
                            <select id="edit-hari" name="hari" required 
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
                            <label for="edit-waktu" class="block text-sm font-medium text-gray-700">Waktu *</label>
                            <select id="edit-waktu" name="waktu" required 
                                class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                                <option value="">-- Pilih Mata Kuliah Dulu --</option>
                            </select>
                        </div>
                    </div>

                    {{-- Ruangan --}}
                    <div>
                        <label for="edit-id-ruangan" class="block text-sm font-medium text-gray-700">Ruangan *</label>
                        <select id="edit-id-ruangan" name="id_ruangan" required 
                            class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                            <option value="">-- Pilih Ruangan --</option>
                        </select>
                    </div>

                    {{-- Status --}}
                    <div>
                        <label for="edit-status" class="block text-sm font-medium text-gray-700">Status *</label>
                        <select id="edit-status" name="status" required 
                            class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                            <option value="">-- Pilih Status --</option>
                            <option value="Offline">Offline</option>
                            <option value="Online">Online</option>
                            <option value="Libur">Libur</option>
                            <option value="Kelas Tunjangan">Kelas Tunjangan</option>
                            <option value="Belum Ada Konfirmasi">Belum Ada Konfirmasi</option>
                        </select>
                    </div>

                    <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse gap-2">
                        <button type="submit" id="btn-update-jadwal" 
                            class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-blue-600 text-base font-medium text-white hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 sm:ml-3 sm:w-auto sm:text-sm">
                            Simpan Perubahan
                        </button>
                        <button type="button" class="close-edit-jadwal-modal mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500 sm:mt-0 sm:w-auto sm:text-sm">
                            Batal
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
