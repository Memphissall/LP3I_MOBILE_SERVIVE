<!-- Modal Edit Mahasiswa -->
<div id="edit-modal" class="hidden fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full z-50">
    <div class="relative top-10 mx-auto p-5 border w-full max-w-4xl shadow-lg rounded-md bg-white">
        <div class="flex justify-between items-center pb-3 border-b">
            <h3 class="text-xl font-semibold text-gray-900">Edit Data Mahasiswa</h3>
            <button type="button" class="text-gray-400 hover:text-gray-500" onclick="closeEditModal()">
                <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </button>
        </div>

        <form id="edit-form" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <input type="hidden" id="edit-id" name="id">

            <!-- Tab Navigation -->
            <div class="border-b border-gray-200 mt-4">
                <nav class="-mb-px flex space-x-8">
                    <button type="button" class="tab-btn active border-[#004269] text-[#004269] whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm" data-tab="akademik">
                        Data Akademik
                    </button>
                    <button type="button" class="tab-btn border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300 whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm" data-tab="pribadi">
                        Data Pribadi
                    </button>
                </nav>
            </div>

            <!-- Tab Content -->
            <div class="mt-4">
                <!-- Tab Akademik -->
                <div id="tab-akademik" class="tab-content">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        {{-- Kolom NIPD --}}
                        <div>
                            <label class="block text-sm font-medium text-gray-700">NIPD</label>
                            <input type="text" id="edit-nipd" name="nipd" required class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm bg-gray-100" readonly>
                        </div>

                        {{-- Kolom Nama --}}
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Nama Lengkap</label>
                            <input type="text" id="edit-nama" name="nama_mhs" required class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm">
                        </div>

                        {{-- Kolom Program Studi --}}
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Program Studi</label>
                            <select id="edit-id-bidang-keahlian" name="id_program_studi" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md">
                                <option value="">-- Pilih Program Studi --</option>
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
                            <input type="text" id="edit-periode" name="periode" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md" placeholder="2024/2025/1">
                        </div>

                        {{-- Kolom Kelas --}}
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Kelas</label>
                            <select id="edit-id-kelas" name="id_kelas" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md">
                                <option value="">-- Kelas --</option>
                            </select>
                        </div>

                        {{-- Kolom Foto --}}
                        <div class="col-span-2">
                            <label class="block text-sm font-medium text-gray-700 mb-2">Foto Profil</label>
                            <div class="flex items-start gap-4">
                                <div id="edit-foto-preview" class="w-24 h-24 border-2 border-gray-300 rounded-lg overflow-hidden bg-gray-50 flex items-center justify-center">
                                    <svg class="w-12 h-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                    </svg>
                                </div>
                                <div class="flex-1">
                                    <input type="file" id="edit-foto" name="foto" accept="image/*" class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-[#009DA5] file:text-white hover:file:bg-[#00888f]">
                                    <p class="text-xs text-gray-500 mt-1">Format: JPG, PNG. Max 2MB</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Tab Pribadi -->
                <div id="tab-pribadi" class="tab-content hidden">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        {{-- Jenis Kelamin --}}
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Jenis Kelamin</label>
                            <select id="edit-jenis-kelamin" name="jenis_kelamin" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md">
                                <option value="">-- Pilih --</option>
                                <option value="L">Laki-laki</option>
                                <option value="P">Perempuan</option>
                            </select>
                        </div>

                        {{-- Tempat Lahir --}}
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Tempat Lahir</label>
                            <input type="text" id="edit-tempat-lahir" name="tempat_lahir" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md">
                        </div>

                        {{-- Tanggal Lahir --}}
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Tanggal Lahir</label>
                            <input type="date" id="edit-tgl-lahir" name="tgl_lahir" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md">
                        </div>

                        {{-- Agama --}}
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Agama</label>
                            <select id="edit-agama" name="agama" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md">
                                <option value="">-- Pilih --</option>
                                <option value="Islam">Islam</option>
                                <option value="Kristen">Kristen</option>
                                <option value="Katolik">Katolik</option>
                                <option value="Hindu">Hindu</option>
                                <option value="Buddha">Buddha</option>
                                <option value="Konghucu">Konghucu</option>
                            </select>
                        </div>

                        {{-- Email --}}
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Email</label>
                            <input type="email" id="edit-email" name="email" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md">
                        </div>

                        {{-- No Telepon --}}
                        <div>
                            <label class="block text-sm font-medium text-gray-700">No. Telepon</label>
                            <input type="text" id="edit-no-tlp" name="no_tlp" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md">
                        </div>

                        {{-- Status --}}
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Status</label>
                            <select id="edit-status" name="status" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md">
                                <option value="">-- Pilih --</option>
                                <option value="Aktif">Aktif</option>
                                <option value="Cuti">Cuti</option>
                                <option value="Non-Aktif">Non-Aktif</option>
                                <option value="Lulus">Lulus</option>
                                <option value="Drop Out">Drop Out</option>
                            </select>
                        </div>

                        {{-- Alamat --}}
                        <div class="col-span-2">
                            <label class="block text-sm font-medium text-gray-700">Alamat</label>
                            <textarea id="edit-alamat" name="alamat" rows="3" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md"></textarea>
                        </div>
                    </div>
                </div>
            </div>

            <div class="mt-6 flex justify-end space-x-3 border-t pt-4">
                <button type="button" onclick="closeEditModal()" class="px-4 py-2 border border-gray-300 rounded-md text-gray-700 hover:bg-gray-50 transition">
                    Batal
                </button>
                <button type="submit" class="px-4 py-2 bg-[#009DA5] text-white rounded-md hover:bg-[#00888f] transition">
                    Simpan Perubahan
                </button>
            </div>
        </form>
    </div>
</div>

<script>
// Tab Switching
document.querySelectorAll('.tab-btn').forEach(btn => {
    btn.addEventListener('click', function() {
        const tab = this.dataset.tab;
        
        // Update button states
        document.querySelectorAll('.tab-btn').forEach(b => {
            b.classList.remove('active', 'border-[#004269]', 'text-[#004269]');
            b.classList.add('border-transparent', 'text-gray-500');
        });
        this.classList.add('active', 'border-[#004269]', 'text-[#004269]');
        this.classList.remove('border-transparent', 'text-gray-500');
        
        // Update content
        document.querySelectorAll('.tab-content').forEach(content => {
            content.classList.add('hidden');
        });
        document.getElementById('tab-' + tab).classList.remove('hidden');
    });
});

// Photo preview on change
document.getElementById('edit-foto').addEventListener('change', function(e) {
    const file = e.target.files[0];
    if (file) {
        const reader = new FileReader();
        reader.onload = function(e) {
            document.getElementById('edit-foto-preview').innerHTML = `<img src="${e.target.result}" class="w-full h-full object-cover">`;
        };
        reader.readAsDataURL(file);
    }
});

function closeEditModal() {
    document.getElementById('edit-modal').classList.add('hidden');
}
</script>