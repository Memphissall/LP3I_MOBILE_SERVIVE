{{-- Tambah Jadwal Modal with Cascading Dropdowns --}}
<div id="tambah-jadwal-modal" class="fixed z-50 inset-0 overflow-y-auto hidden">
    <div class="flex items-center justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:block sm:p-0">
        <div class="fixed inset-0 transition-opacity bg-gray-500 bg-opacity-75" aria-hidden="true"></div>
        
        <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-2xl sm:w-full">
            <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="text-lg leading-6 font-bold text-gray-900">Tambah Jadwal Baru</h3>
                    <button class="close-tambah-jadwal-modal text-gray-400 hover:text-gray-600">
                        <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                </div>

                <form id="tambah-jadwal-form" class="space-y-4">
                    @csrf

                    {{-- CASCADING SECTION 1: Bidang Keahlian --}}
                    <div>
                        <label for="tambah-bidang-keahlian" class="block text-sm font-medium text-gray-700">Bidang Keahlian *</label>
                        <select id="tambah-bidang-keahlian" name="bidang_keahlian_filter" required 
                            class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                            <option value="">-- Pilih Bidang Keahlian --</option>
                        </select>
                    </div>

                    {{-- CASCADING SECTION 2: Semester --}}
                    <div>
                        <label for="tambah-semester" class="block text-sm font-medium text-gray-700">Semester *</label>
                        <select id="tambah-semester" name="semester_filter" required 
                            class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500" disabled>
                            <option value="">-- Pilih Semester --</option>
                            {{-- Will be populated by JavaScript from database --}}
                        </select>
                    </div>

                    {{-- CASCADING SECTION 3: Mata Kuliah --}}
                    <div>
                        <label for="tambah-id-matkul" class="block text-sm font-medium text-gray-700">Mata Kuliah *</label>
                        <select id="tambah-id-matkul" name="id_matkul" required 
                            class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500" disabled>
                            <option value="">-- Pilih Semester Dulu --</option>
                        </select>
                        <p id="tambah-sks-info" class="text-xs text-gray-500 mt-1 hidden"></p>
                    </div>

                    {{-- Dosen --}}
                    <div>
                        <label for="tambah-id-dosen" class="block text-sm font-medium text-gray-700">Dosen Pengampu *</label>
                        <select id="tambah-id-dosen" name="id_dosen" required 
                            class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500" disabled>
                            <option value="">-- Pilih Mata Kuliah Dulu --</option>
                        </select>
                    </div>

                    {{-- CASCADING SECTION 4: Kelas --}}
                    <div>
                        <label for="tambah-id-kelas" class="block text-sm font-medium text-gray-700">Kelas *</label>
                        <select id="tambah-id-kelas" name="id_kelas" required 
                            class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500" disabled>
                            <option value="">-- Pilih Bidang Keahlian Dulu --</option>
                        </select>
                    </div>

                    <div class="grid grid-cols-2 gap-4">
                        {{-- Hari --}}
                        <div class="col-span-1">
                            <label for="tambah-hari" class="block text-sm font-medium text-gray-700">Hari *</label>
                            <select id="tambah-hari" name="hari" required 
                                class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                                <option value="">-- Pilih Hari --</option>
                                {{-- Will be populated by JavaScript from database --}}
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
                    </div>

                    {{-- Ruangan --}}
                    <div>
                        <label for="tambah-id-ruangan" class="block text-sm font-medium text-gray-700">Ruangan *</label>
                        <select id="tambah-id-ruangan" name="id_ruangan" required 
                            class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                            <option value="">-- Pilih Ruangan --</option>
                        </select>
                    </div>

                    <div>
                        <label for="tambah-status" class="block text-sm font-medium text-gray-700">Status *</label>
                        <select id="tambah-status" name="status" required 
                            class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                            <option value="">-- Pilih Status --</option>
                            {{-- Will be populated by JavaScript --}}
                        </select>
                    </div>

                    <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse gap-2">
                        <button type="submit" id="btn-tambah-jadwal" 
                            class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-green-600 text-base font-medium text-white hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 sm:ml-3 sm:w-auto sm:text-sm">
                            Simpan Data
                        </button>
                        <button type="button" class="close-tambah-jadwal-modal mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500 sm:mt-0 sm:w-auto sm:text-sm">
                            Batal
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
