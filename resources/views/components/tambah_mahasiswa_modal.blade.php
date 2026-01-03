@props(['id' => 'tambah-mahasiswa-modal'])

<div id="{{ $id }}" class="fixed inset-0 z-50 hidden overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
    <!-- Backdrop -->
    <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" aria-hidden="true"></div>

    <!-- Modal Panel -->
    <div class="flex min-h-screen items-end justify-center p-4 text-center sm:items-center sm:p-0">
        <div id="modal-panel" class="relative transform overflow-hidden rounded-lg bg-white text-left shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-4xl">
            
            <!-- Header -->
            <div class="bg-white px-4 pb-4 pt-5 sm:p-6 sm:pb-4 border-b border-gray-200">
                <div class="sm:flex sm:items-start justify-between">
                    <div>
                        <h3 class="text-xl font-semibold leading-6 text-gray-900" id="modal-title">Tambah Mahasiswa ke Kelas</h3>
                        <div class="mt-2">
                            <p class="text-sm text-gray-500">Ikuti langkah-langkah untuk menambahkan mahasiswa ke dalam kelas.</p>
                        </div>
                    </div>
                    <button type="button" class="close-modal text-gray-400 hover:text-gray-500">
                        <span class="sr-only">Close</span>
                        <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
                
                <!-- Progress Steps -->
                <div class="mt-6 flex justify-center">
                    <div class="flex items-center w-full max-w-xs">
                        <div class="flex items-center relative w-full">
                            <div class="w-8 h-8 rounded-full flex items-center justify-center font-bold text-white bg-blue-600 transition-colors duration-300" id="step-indicator-1">1</div>
                            <div class="absolute top-10 w-32 -ml-12 text-center text-xs font-semibold text-blue-600" id="step-label-1">Pilih Mahasiswa</div>
                            
                            <div class="flex-auto border-t-2 transition duration-500 ease-in-out border-gray-300" id="step-line-1"></div>
                            
                            <div class="w-8 h-8 rounded-full flex items-center justify-center font-bold text-gray-500 bg-gray-200 transition-colors duration-300" id="step-indicator-2">2</div>
                            <div class="absolute top-10 right-0 w-32 -mr-12 text-center text-xs font-semibold text-gray-500" id="step-label-2">Pilih Kelas</div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Content Area -->
            <form id="add-student-form">
                <div class="px-4 py-5 sm:p-6 h-[500px] overflow-y-auto">
                    
                    <!-- STEP 1: PILIH MAHASISWA -->
                    <div id="step-content-1" class="step-content">
                        <!-- Filters -->
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-4 bg-gray-50 p-4 rounded-lg">
                            <div>
                                <label for="modal-filter-jurusan" class="block text-sm font-medium text-gray-700">Jurusan</label>
                                <select id="modal-filter-jurusan" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm p-2 border">
                                    <option value="Semua Jurusan">Semua Jurusan</option>
                                </select>
                            </div>
                            <div>
                                <label for="modal-filter-angkatan" class="block text-sm font-medium text-gray-700">Angkatan</label>
                                <select id="modal-filter-angkatan" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm p-2 border">
                                    <option value="Semua Tahun">Semua Tahun</option>
                                </select>
                            </div>
                            <div>
                                <label for="modal-filter-periode" class="block text-sm font-medium text-gray-700">Periode</label>
                                <select id="modal-filter-periode" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm p-2 border">
                                    <option value="Semua Periode">Semua Periode</option>
                                </select>
                            </div>
                        </div>

                        <!-- Table -->
                        <div class="border rounded-lg overflow-hidden">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            <input type="checkbox" id="select-all-students" class="rounded border-gray-300 text-blue-600 focus:ring-blue-500">
                                        </th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">NIPD</th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama</th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Bidang Keahlian</th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Kelas Saat Ini</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200" id="modal-student-list">
                                    <!-- Data populated by JS -->
                                    <tr>
                                        <td colspan="5" class="px-6 py-4 text-center text-sm text-gray-500">Memuat data...</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <p class="mt-2 text-sm text-gray-600">Dipilih: <span id="selected-count" class="font-bold text-blue-600">0</span> mahasiswa</p>
                    </div>

                    <!-- STEP 2: PILIH KELAS -->
                    <div id="step-content-2" class="step-content hidden">
                        
                        <div class="mb-6">
                            <label class="text-base font-semibold text-gray-900">Tujuan Kelas</label>
                            <p class="text-sm text-gray-500">Pilih apakah ingin memasukkan ke kelas yang sudah ada atau membuat kelas baru.</p>
                            <fieldset class="mt-4">
                                <div class="space-y-4 sm:flex sm:items-center sm:space-x-10 sm:space-y-0">
                                    <div class="flex items-center">
                                        <input id="mode-existing" name="mode_kelas" type="radio" value="existing" checked class="h-4 w-4 border-gray-300 text-blue-600 focus:ring-blue-500">
                                        <label for="mode-existing" class="ml-3 block text-sm font-medium leading-6 text-gray-900">Pilih Kelas Existing</label>
                                    </div>
                                    <div class="flex items-center">
                                        <input id="mode-new" name="mode_kelas" type="radio" value="new" class="h-4 w-4 border-gray-300 text-blue-600 focus:ring-blue-500">
                                        <label for="mode-new" class="ml-3 block text-sm font-medium leading-6 text-gray-900">Buat Kelas Baru</label>
                                    </div>
                                </div>
                            </fieldset>
                        </div>

                        <!-- Form Existing Class -->
                        <div id="form-existing-class" class="space-y-4 bg-gray-50 p-4 rounded-lg border border-gray-200">
                            <div>
                                <label for="class-filter-jurusan" class="block text-sm font-medium text-gray-700">Filter Jurusan Kelas</label>
                                <select id="class-filter-jurusan" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm p-2 border">
                                    <option value="Semua Jurusan">Semua Jurusan</option>
                                </select>
                            </div>
                            <div>
                                <label for="select-kelas-existing" class="block text-sm font-medium text-gray-700">Pilih Kelas</label>
                                <select id="select-kelas-existing" name="id_kelas" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm p-2 border">
                                    <option value="">-- Pilih Kelas --</option>
                                    <!-- Populated by JS -->
                                </select>
                            </div>
                        </div>

                        <!-- Form New Class -->
                        <div id="form-new-class" class="space-y-4 hidden bg-blue-50 p-4 rounded-lg border border-blue-200">
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div>
                                    <label for="new-nama-kelas" class="block text-sm font-medium text-gray-700">Nama Kelas</label>
                                    <input type="text" name="nama_kelas" id="new-nama-kelas" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 p-2 border sm:text-sm" placeholder="Cth: Kelas A">
                                </div>
                                <div>
                                    <label for="new-jurusan" class="block text-sm font-medium text-gray-700">Jurusan</label>
                                    <select name="jurusan" id="new-jurusan" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 p-2 border sm:text-sm">
                                    </select>
                                </div>
                                <div>
                                    <label for="new-tahun-ajaran" class="block text-sm font-medium text-gray-700">Tahun Ajaran</label>
                                    <input type="text" name="tahun_ajaran" id="new-tahun-ajaran" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 p-2 border sm:text-sm" placeholder="Cth: 2023/2024">
                                </div>
                                <div class="md:col-span-2">
                                    <label for="new-nama-pa" class="block text-sm font-medium text-gray-700">Pembimbing Akademik</label>
                                    <input type="text" name="nama_pa" id="new-nama-pa" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 p-2 border sm:text-sm" placeholder="Nama Dosen PA">
                                </div>
                            </div>
                        </div>

                    </div>
                </div>

                <!-- Footer -->
                <div class="bg-gray-50 px-4 py-3 sm:flex sm:flex-row-reverse sm:px-6">
                    <button type="button" id="btn-next" class="inline-flex w-full justify-center rounded-md bg-blue-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-blue-500 sm:ml-3 sm:w-auto">
                        Lanjut (Step 2)
                    </button>
                    <button type="submit" id="btn-submit" class="hidden inline-flex w-full justify-center rounded-md bg-green-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-green-500 sm:ml-3 sm:w-auto">
                        Simpan Perubahan
                    </button>
                    <button type="button" id="btn-prev" class="hidden mt-3 inline-flex w-full justify-center rounded-md bg-white px-3 py-2 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50 sm:mt-0 sm:w-auto">
                        Kembali
                    </button>
                    <button type="button" class="close-modal mt-3 inline-flex w-full justify-center rounded-md bg-white px-3 py-2 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50 sm:mr-auto sm:mt-0 sm:w-auto">
                        Batal
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
