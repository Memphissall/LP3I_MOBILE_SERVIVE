{{-- Tambah Jadwal Modal --}}
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

                    {{-- Program Studi --}}
                    <div>
                        <label for="tambah-program-studi" class="block text-sm font-medium text-gray-700">Program Studi *</label>
                        <select id="tambah-program-studi" name="program_studi_filter" required 
                            class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                            <option value="">-- Pilih Program Studi --</option>
                        </select>
                    </div>

                    {{-- Semester --}}
                    <div>
                        <label for="tambah-semester" class="block text-sm font-medium text-gray-700">Semester *</label>
                        <select id="tambah-semester" name="semester" required 
                            class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500" disabled>
                            <option value="">-- Pilih Semester --</option>
                            <option value="1">Semester 1</option>
                            <option value="2">Semester 2</option>
                            <option value="3">Semester 3</option>
                            <option value="4">Semester 4</option>
                        </select>
                    </div>

                    {{-- Materi Ajar --}}
                    <div>
                        <label for="tambah-id-mk" class="block text-sm font-medium text-gray-700">Materi Ajar *</label>
                        <select id="tambah-id-mk" name="id_mk" required 
                            class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500" disabled>
                            <option value="">-- Pilih Semester Dulu --</option>
                        </select>
                        <p id="tambah-sks-info" class="text-xs text-gray-500 mt-1 hidden"></p>
                    </div>

                    {{-- Pendidik --}}
                    <div>
                        <label for="tambah-id-pendidik" class="block text-sm font-medium text-gray-700">Pendidik *</label>
                        <select id="tambah-id-pendidik" name="id_pendidik" required 
                            class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                            <option value="">-- Pilih Pendidik --</option>
                        </select>
                    </div>

                    {{-- Kelas --}}
                    <div>
                        <label for="tambah-id-kelas" class="block text-sm font-medium text-gray-700">Kelas *</label>
                        <select id="tambah-id-kelas" name="id_kelas" required 
                            class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500" disabled>
                            <option value="">-- Pilih Program Studi Dulu --</option>
                        </select>
                    </div>

                    <div class="grid grid-cols-2 gap-4">
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
                                <option value="">-- Pilih Materi Ajar Dulu --</option>
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
