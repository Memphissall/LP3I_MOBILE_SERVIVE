@extends('layouts.app')

@section('content')
    <div class="p-6">
        {{-- Header Page --}}
        <div class="flex justify-between items-center mb-8">
            <div>
                <h1 class="text-2xl font-extrabold text-[#004269] tracking-tight">Kelola Data Mahasiswa</h1>
                <p class="text-sm text-gray-500 mt-1">Manajemen data akademik mahasiswa aktif dan alumni.</p>
            </div>
        </div>

        {{-- 1. Container Filter Utama (REMASTERED) --}}
        <div class="bg-white rounded-2xl shadow-xl shadow-gray-200/50 mb-8 overflow-hidden relative border border-gray-100">
            {{-- Decorative Top Bar --}}
            <div class="h-1.5 w-full bg-gradient-to-r from-[#004269] via-[#00536e] to-[#009DA5]"></div>

            <div class="p-6 md:p-8">
                {{-- Header Filter --}}
                <div class="flex items-center space-x-3 mb-6 border-b border-gray-100 pb-4">
                    <div class="bg-[#004269]/10 p-2.5 rounded-xl text-[#004269]">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z" />
                        </svg>
                    </div>
                    <div>
                        <h2 class="text-lg font-bold text-gray-800">Filter Pencarian</h2>
                        <p class="text-xs text-gray-400 font-medium">Saring data berdasarkan kriteria berikut</p>
                    </div>
                </div>

                {{-- Grid Input --}}
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">

                    {{-- Bidang Keahlian --}}
                    <div class="group">
                        <label
                            class="block text-xs font-bold text-gray-500 uppercase tracking-wider mb-2 flex items-center">
                            <svg class="w-4 h-4 mr-1.5 text-[#009DA5]" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                            </svg>
                            Program Studi
                        </label>
                        <div class="relative">
                            <select id="filter-jurusan"
                                class="w-full p-3 pl-4 text-sm font-medium text-gray-700 bg-gray-50 border border-gray-200 rounded-xl outline-none focus:bg-white focus:border-[#009DA5] focus:ring-4 focus:ring-[#009DA5]/10 transition-all duration-200 appearance-none cursor-pointer hover:border-gray-300">
                                <option value="">Semua Bidang Keahlian</option>
                            </select>
                            <div
                                class="absolute inset-y-0 right-0 flex items-center px-3 pointer-events-none text-gray-400 group-hover:text-[#004269] transition-colors">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M19 9l-7 7-7-7" />
                                </svg>
                            </div>
                        </div>
                    </div>

                    {{-- Angkatan --}}
                    <div class="group">
                        <label
                            class="block text-xs font-bold text-gray-500 uppercase tracking-wider mb-2 flex items-center">
                            <svg class="w-4 h-4 mr-1.5 text-[#009DA5]" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                            Angkatan
                        </label>
                        <div class="relative">
                            <select id="filter-tahun"
                                class="w-full p-3 pl-4 text-sm font-medium text-gray-700 bg-gray-50 border border-gray-200 rounded-xl outline-none focus:bg-white focus:border-[#009DA5] focus:ring-4 focus:ring-[#009DA5]/10 transition-all duration-200 appearance-none cursor-pointer hover:border-gray-300">
                                <option value="">Semua Tahun</option>
                            </select>
                            <div
                                class="absolute inset-y-0 right-0 flex items-center px-3 pointer-events-none text-gray-400 group-hover:text-[#004269] transition-colors">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M19 9l-7 7-7-7" />
                                </svg>
                            </div>
                        </div>
                    </div>

                    {{-- Kelas --}}
                    <div class="group">
                        <label
                            class="block text-xs font-bold text-gray-500 uppercase tracking-wider mb-2 flex items-center">
                            <svg class="w-4 h-4 mr-1.5 text-[#009DA5]" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                            </svg>
                            Kelas
                        </label>
                        <div class="relative">
                            <select id="filter-kelas"
                                class="w-full p-3 pl-4 text-sm font-medium text-gray-700 bg-gray-50 border border-gray-200 rounded-xl outline-none focus:bg-white focus:border-[#009DA5] focus:ring-4 focus:ring-[#009DA5]/10 transition-all duration-200 appearance-none cursor-pointer hover:border-gray-300">
                                <!-- Options will be populated by JavaScript -->
                            </select>
                            <div
                                class="absolute inset-y-0 right-0 flex items-center px-3 pointer-events-none text-gray-400 group-hover:text-[#004269] transition-colors">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M19 9l-7 7-7-7" />
                                </svg>
                            </div>
                        </div>
                    </div>

                    {{-- Periode --}}
                    <div class="group">
                        <label
                            class="block text-xs font-bold text-gray-500 uppercase tracking-wider mb-2 flex items-center">
                            <svg class="w-4 h-4 mr-1.5 text-[#009DA5]" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            Periode
                        </label>
                        <div class="relative">
                            <select id="filter-periode"
                                class="w-full p-3 pl-4 text-sm font-medium text-gray-700 bg-gray-50 border border-gray-200 rounded-xl outline-none focus:bg-white focus:border-[#009DA5] focus:ring-4 focus:ring-[#009DA5]/10 transition-all duration-200 appearance-none cursor-pointer hover:border-gray-300">
                                <option value="">Semua Periode</option>
                            </select>
                            <div
                                class="absolute inset-y-0 right-0 flex items-center px-3 pointer-events-none text-gray-400 group-hover:text-[#004269] transition-colors">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M19 9l-7 7-7-7" />
                                </svg>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Action Button --}}
                <div class="mt-8 flex justify-end">
                    <button id="show-data-btn"
                        class="relative overflow-hidden group bg-[#004269] hover:bg-[#003350] text-white pl-6 pr-8 py-3 rounded-xl font-bold transition-all duration-300 shadow-[0_4px_14px_0_rgba(0,66,105,0.39)] hover:shadow-[0_6px_20px_rgba(0,66,105,0.23)] hover:-translate-y-1 active:translate-y-0 flex items-center">
                        <span
                            class="absolute right-0 w-8 h-32 -mt-12 transition-all duration-1000 transform translate-x-12 bg-white opacity-10 rotate-12 group-hover:-translate-x-40 ease"></span>
                        <svg class="w-5 h-5 mr-2 animate-pulse" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg>
                        Tampilkan Data
                    </button>
                </div>
            </div>
        </div>

        {{-- 2. Tabel Utama (COMPACT & BOLD EDITION) --}}
        <div class="bg-white rounded-2xl shadow-xl shadow-gray-200/50 overflow-hidden mb-6 border border-gray-100">
            {{-- HEADER TABEL --}}
            <div class="p-5 border-b bg-gradient-to-r from-[#004269] to-[#009DA5]">
                <div class="flex flex-col md:flex-row justify-between items-center gap-4">
                    <div class="flex items-center space-x-3">
                        <div class="bg-white/20 p-2 rounded-lg backdrop-blur-sm">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                            </svg>
                        </div>
                        <h3 class="text-xl font-bold text-white tracking-wide">Daftar Mahasiswa <span
                                class="bg-white/20 px-2 py-0.5 rounded text-sm font-mono ml-2" id="student-count">0</span>
                        </h3>
                    </div>

                    <div class="flex space-x-3">
                        <button id="add-student-btn"
                            class="bg-white text-[#004269] px-4 py-2 rounded-lg font-bold hover:bg-gray-50 transition-all duration-200 shadow-lg shadow-black/10 flex items-center transform hover:scale-105 active:scale-95 text-sm">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                                    d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                            </svg>
                            Tambah Data
                        </button>
                        <button id="print-btn"
                            class="bg-white/10 text-white border border-white/30 backdrop-blur-md px-4 py-2 rounded-lg font-bold hover:bg-white hover:text-[#004269] transition-all duration-200 flex items-center text-sm hidden">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z" />
                            </svg>
                            Print
                        </button>
                    </div>
                </div>
            </div>

            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th
                                class="px-3 py-3 text-center text-sm font-extrabold text-[#004269] uppercase tracking-wider w-12 border-b-2 border-gray-200">
                                No</th>
                            <th
                                class="px-3 py-3 text-left text-sm font-extrabold text-[#004269] uppercase tracking-wider w-32 border-b-2 border-gray-200">
                                NIPD</th>
                            <th
                                class="px-3 py-3 text-left text-sm font-extrabold text-[#004269] uppercase tracking-wider border-b-2 border-gray-200">
                                Mahasiswa</th>
                            <th
                                class="px-3 py-3 text-left text-sm font-extrabold text-[#004269] uppercase tracking-wider w-32 border-b-2 border-gray-200">
                                Kelas</th>
                            <th
                                class="px-3 py-3 text-left text-sm font-extrabold text-[#004269] uppercase tracking-wider border-b-2 border-gray-200">
                                Tempat Lahir</th>
                            <th
                                class="px-3 py-3 text-center text-sm font-extrabold text-[#004269] uppercase tracking-wider w-32 border-b-2 border-gray-200">
                                Tgl Lahir</th>
                            <th
                                class="px-3 py-3 text-left text-sm font-extrabold text-[#004269] uppercase tracking-wider border-b-2 border-gray-200">
                                Alamat</th>
                            <th
                                class="px-3 py-3 text-center text-sm font-extrabold text-[#004269] uppercase tracking-wider w-28 border-b-2 border-gray-200">
                                No Telp</th>
                            <th
                                class="px-3 py-3 text-left text-sm font-extrabold text-[#004269] uppercase tracking-wider border-b-2 border-gray-200">
                                Email</th>
                            <th
                                class="px-3 py-3 text-center text-sm font-extrabold text-[#004269] uppercase tracking-wider w-28 border-b-2 border-gray-200">
                                Status</th>
                            <th
                                class="px-3 py-3 text-center text-sm font-extrabold text-[#004269] uppercase tracking-wider w-28 border-b-2 border-gray-200">
                                Aksi</th>
                        </tr>
                    </thead>
                    <tbody id="student-table-body" class="bg-white divide-y divide-gray-100 text-sm">
                        <tr>
                            {{-- Colspan jadi 9 karena ada kolom No --}}
                            <td colspan="10" class="px-6 py-16 text-center">
                                <div class="flex flex-col items-center justify-center text-gray-400">
                                    <svg class="w-16 h-16 mb-4 text-gray-300" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                            d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                                    </svg>
                                    <p class="text-base font-medium text-gray-500">Silakan gunakan filter di atas untuk
                                        menampilkan data.</p>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            {{-- Footer Tabel --}}
            <div class="bg-gray-50 px-6 py-3 border-t border-gray-100 flex justify-between items-center">
                <span class="text-xs text-gray-500 font-medium">Menampilkan data mahasiswa terdaftar.</span>
            </div>
        </div>
    </div>

    @include('components.edit_mahasiswa_modal')
    @include('components.tambah_mahasiswa_modal')
@endsection

@push('scripts')
    <script>
        $(document).ready(function () {
            // Setup CSRF Token
            $.ajaxSetup({ headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') } });

            // State Global
            let allBidangKeahlianData = [];
            let allClassData = [];
            let globalData = {};
            let isFetchingMain = false;

            // Helper function to format date
            function formatDate(dateString) {
                if (!dateString) return '-';
                try {
                    const date = new Date(dateString);
                    if (isNaN(date.getTime())) return '-';
                    const day = String(date.getDate()).padStart(2, '0');
                    const month = String(date.getMonth() + 1).padStart(2, '0');
                    const year = date.getFullYear();
                    return `${day}-${month}-${year}`;
                } catch (e) {
                    return '-';
                }
            }

            // --- 1. INISIALISASI DATA & FILTER ---
            function initFilters() {
                $.get("/akademik/api/filter-data", function (res) {
                    if (res.status === 'success') {
                        globalData = res;
                        allClassData = res.kelas || [];
                        allBidangKeahlianData = res.jurusan || [];

                        // DEBUG: Check for duplicates in API response
                        console.log('Total kelas from API:', allClassData.length);
                        console.log('Kelas data:', allClassData);
                        const uniqueIds = new Set(allClassData.map(k => k.id_kelas));
                        console.log('Unique kelas IDs:', uniqueIds.size);
                        if (allClassData.length !== uniqueIds.size) {
                            console.warn('⚠️ DUPLICATE KELAS DETECTED IN API RESPONSE!');
                        }

                        let jHtml = '<option value="">Semua Program Studi</option>';
                        allBidangKeahlianData.forEach(j => { jHtml += `<option value="${j.id_program_studi}">${j.nama_program_studi} (${j.kode_program_studi})</option>`; });
                        $('#filter-jurusan, #modal-filter-jurusan, #class-filter-jurusan, #new-jurusan').html(jHtml);

                        let aHtml = '<option value="">Semua Tahun</option>';
                        res.angkatan.forEach(a => { aHtml += `<option value="${a}">${a}</option>`; });
                        $('#filter-tahun, #modal-filter-angkatan').html(aHtml);

                        let pHtml = '<option value="">Semua Periode</option>';
                        res.periode.forEach(p => { pHtml += `<option value="${p}">${p}</option>`; });
                        $('#filter-periode, #modal-filter-periode').html(pHtml);

                        // Populate kelas dropdown with ALL kelas initially (with deduplication)
                        // Deduplicate by NAMA KELAS (not ID) to avoid showing duplicate names
                        let kHtml = '<option value="">Semua Kelas</option>';
                        const seenKelasNames = new Set(); // Track unique kelas NAMES
                        allClassData.forEach(k => {
                            if (!seenKelasNames.has(k.nama_kelas)) {
                                seenKelasNames.add(k.nama_kelas);
                                // Find program studi name for this kelas
                                const prodi = allBidangKeahlianData.find(b => b.id_program_studi == k.id_program_studi);
                                const prodiInfo = prodi ? ` (${prodi.kode_program_studi})` : '';
                                kHtml += `<option value="${k.id_kelas}">${k.nama_kelas}${prodiInfo}</option>`;
                            }
                        });

                        // Force clear and repopulate
                        $('#filter-kelas').empty().html(kHtml);

                        console.log('Dropdown populated with', seenKelasNames.size, 'unique kelas names');
                        console.log('Actual options in DOM:', $('#filter-kelas option').length - 1); // -1 for "Semua Kelas"

                        renderClassOptions('');
                    }
                });
            }
            initFilters();

            function renderClassOptions(selectedJurusan) {
                let kelasHtml = '<option value="">-- Pilih Kelas --</option>';
                const filterVal = (selectedJurusan === "Semua Bidang Keahlian" || selectedJurusan === "") ? "" : selectedJurusan;

                // Fix column name: id_program_studi (not jurusan)
                const filtered = filterVal === "" ? allClassData : allClassData.filter(k => String(k.id_program_studi) === String(filterVal));

                if (filtered.length > 0) {
                    const seen = new Set();
                    filtered.forEach(k => {
                        if (!seen.has(k.nama_kelas)) {
                            seen.add(k.nama_kelas);
                            kelasHtml += `<option value="${k.id_kelas}">${k.nama_kelas}</option>`;
                        }
                    });
                } else {
                    kelasHtml = '<option value="">Tidak ada kelas tersedia</option>';
                }
                $('#select-kelas-existing').html(kelasHtml);
            }

            $(document).on('change', '#class-filter-jurusan', function () { renderClassOptions($(this).val()); });

            // --- SMART CASCADING FILTER ---
            // When user selects Bidang Keahlian, filter Kelas to show only matching ones
            function updateKelasBasedOnBidangKeahlian() {
                const selectedBidangKeahlian = $('#filter-jurusan').val();
                const currentKelas = $('#filter-kelas').val();

                let kHtml = '<option value="">Semua Kelas</option>';
                let isCurrentKelasValid = false;
                const seenKelasNames = new Set(); // Prevent duplicates by NAME

                if (selectedBidangKeahlian === '' || selectedBidangKeahlian === null) {
                    // Show all kelas if no bidang keahlian selected
                    allClassData.forEach(k => {
                        if (!seenKelasNames.has(k.nama_kelas)) {
                            seenKelasNames.add(k.nama_kelas);
                            // Find program studi name
                            const prodi = allBidangKeahlianData.find(b => b.id_program_studi == k.id_program_studi);
                            const prodiInfo = prodi ? ` (${prodi.kode_program_studi})` : '';
                            kHtml += `<option value="${k.id_kelas}">${k.nama_kelas}${prodiInfo}</option>`;
                            if (k.id_kelas == currentKelas) {
                                isCurrentKelasValid = true;
                            }
                        }
                    });
                } else {
                    // Filter kelas by selected program studi
                    const filteredKelas = allClassData.filter(k =>
                        String(k.id_program_studi) === String(selectedBidangKeahlian)
                    );

                    // Get selected program studi info
                    const selectedProdi = allBidangKeahlianData.find(b => b.id_program_studi == selectedBidangKeahlian);
                    const prodiInfo = selectedProdi ? ` (${selectedProdi.kode_program_studi})` : '';

                    filteredKelas.forEach(k => {
                        if (!seenKelasNames.has(k.nama_kelas)) {
                            seenKelasNames.add(k.nama_kelas);
                            // Since we're filtering by prodi, all kelas have same prodi
                            kHtml += `<option value="${k.id_kelas}">${k.nama_kelas}${prodiInfo}</option>`;
                            if (k.id_kelas == currentKelas) {
                                isCurrentKelasValid = true;
                            }
                        }
                    });
                }

                $('#filter-kelas').html(kHtml);

                // Restore kelas selection if it's still valid
                if (isCurrentKelasValid && currentKelas) {
                    $('#filter-kelas').val(currentKelas);
                }
            }


            // Filter change handlers
            $('#filter-jurusan').on('change', function () {
                // When bidang keahlian changes, update kelas dropdown
                updateKelasBasedOnBidangKeahlian();
            });

            // Angkatan and Periode are independent - no cascading needed
            $('#filter-tahun, #filter-periode').on('change', function () {
                // These filters don't affect other dropdowns
                // Angkatan and Periode always show all options
            });

            // --- 2. LOGIKA TABEL UTAMA (COMPACT RENDER) ---
            function renderMainTable() {
                if (isFetchingMain) return;
                isFetchingMain = true;

                const filters = {
                    jurusan: $('#filter-jurusan').val(),
                    angkatan: $('#filter-tahun').val(),
                    periode: $('#filter-periode').val(),
                    kelas: $('#filter-kelas').val()
                };

                $('#show-data-btn').prop('disabled', true).addClass('opacity-75 cursor-not-allowed');
                // Colspan 9
                $('#student-table-body').html('<tr><td colspan="10" class="px-6 py-16 text-center"><div class="inline-flex items-center px-4 py-2 font-semibold leading-6 text-sm shadow rounded-md text-white bg-[#004269] transition ease-in-out duration-150 cursor-not-allowed"><svg class="animate-spin -ml-1 mr-3 h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path></svg>Sedang memuat data...</div></td></tr>');

                $.get("/akademik/api/mahasiswa-list", filters, function (data) {
                    let html = '';
                    if (data.length === 0) {
                        // Empty State Illustration (Colspan 9)
                        html = `
                    <tr>
                        <td colspan="10" class="px-6 py-12 text-center">
                            <div class="flex flex-col items-center justify-center">
                                <div class="bg-gray-50 rounded-full p-6 mb-4">
                                    <svg class="w-12 h-12 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                </div>
                                <h3 class="text-lg font-medium text-gray-900">Data Tidak Ditemukan</h3>
                                <p class="text-gray-500 mt-1">Coba sesuaikan filter pencarian Anda.</p>
                            </div>
                        </td>
                    </tr>`;
                        $('#print-btn').addClass('hidden').removeClass('flex');
                    } else {
                        // Gunakan index untuk penomoran
                        data.forEach((s, index) => {
                            // Status Badge (Compact)
                            const isAktif = s.status && s.status.toLowerCase() === 'aktif';
                            const statusBadge = isAktif
                                ? `<span class="inline-flex items-center px-2 py-0.5 rounded-full text-[10px] font-bold bg-[#009DA5]/10 text-[#009DA5] uppercase tracking-wide">
                                 Aktif
                               </span>`
                                : `<span class="inline-flex items-center px-2 py-0.5 rounded-full text-[10px] font-bold bg-gray-100 text-gray-600 uppercase tracking-wide">
                                 ${s.status || 'Non-Aktif'}
                               </span>`;

                            // Padding diperkecil jadi px-3 py-3
                            html += `
                        <tr class="hover:bg-gray-50 transition-colors duration-200 group border-b border-gray-100 last:border-b-0">
                            <td class="px-3 py-3 text-center font-bold text-gray-500">
                                ${index + 1}
                            </td>
                            <td class="px-3 py-3 whitespace-nowrap">
                                <span class="font-mono text-xs text-[#004269] font-bold bg-[#004269]/5 px-1.5 py-0.5 rounded border border-[#004269]/10">${s.nipd}</span>
                            </td>
                            <td class="px-3 py-3">
                                <div class="text-xs font-bold text-gray-800 group-hover:text-[#004269] transition-colors">${s.nama_mhs}</div>
                            </td>
                            <td class="px-3 py-3 text-xs text-gray-600 font-medium">${s.data_kelas ? s.data_kelas.nama_kelas : '-'}</td>
                            <td class="px-3 py-3 text-xs text-gray-600 font-medium">${s.tempat_lahir || '-'}</td>
                            <td class="px-3 py-3 text-center text-xs text-gray-600 font-medium">${formatDate(s.tgl_lahir)}</td>
                            <td class="px-3 py-3 text-xs text-gray-600 font-medium">${s.alamat || '-'}</td>
                            <td class="px-3 py-3 text-center text-xs text-gray-600 font-medium">${s.no_tlp || '-'}</td>
                            <td class="px-3 py-3 text-xs text-gray-600 font-medium">${s.email || '-'}</td>
                            <td class="px-3 py-3 text-center">${statusBadge}</td>
                            <td class="px-3 py-3 text-center whitespace-nowrap text-xs font-medium">
                                <div class="flex justify-center space-x-1">
                                    <button data-id="${s.id_mahasiswa}" title="Edit" class="btn-edit-student p-1.5 text-indigo-600 hover:text-indigo-900 hover:bg-indigo-50 rounded transition-all duration-200">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                                    </button>
                                    <button data-id="${s.id_mahasiswa}" title="Hapus" class="btn-delete-student p-1.5 text-rose-500 hover:text-rose-700 hover:bg-rose-50 rounded transition-all duration-200">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                    </button>
                                </div>
                            </td>
                        </tr>`;
                        });
                        $('#print-btn').removeClass('hidden').addClass('flex');
                    }
                    $('#student-table-body').html(html);
                    $('#student-count').text(data.length);
                }).always(function () {
                    isFetchingMain = false;
                    $('#show-data-btn').prop('disabled', false).removeClass('opacity-75 cursor-not-allowed');
                });
            }
            $('#show-data-btn').click(renderMainTable);

            // --- 3. LOGIKA MODAL TAMBAH ---
            $(document).on('click', '#add-student-btn', function () {
                $('#tambah-mahasiswa-modal').removeClass('hidden').addClass('flex items-center justify-center');
                resetTambahModal();
                fetchStudentsForModal();
            });

            function resetTambahModal() {
                $('#step-content-1').removeClass('hidden');
                $('#step-content-2').addClass('hidden');
                $('#btn-next').removeClass('hidden');
                $('#btn-submit, #btn-prev').addClass('hidden');
                $('#step-indicator-1').addClass('bg-[#004269]').removeClass('bg-[#009DA5]');
                $('#step-indicator-2').addClass('bg-gray-200 text-gray-500').removeClass('bg-[#004269] text-white');
                $('#add-student-form')[0].reset();
                $('#selected-count').text('0');
                $('#select-all-students').prop('checked', false);
                renderClassOptions('');
            }

            function fetchStudentsForModal() {
                const filters = {
                    jurusan: $('#modal-filter-jurusan').val(),
                    angkatan: $('#modal-filter-angkatan').val(),
                    periode: $('#modal-filter-periode').val(),
                    status_kelas: 'kosong'
                };
                $('#modal-student-list').html('<tr><td colspan="5" class="px-6 py-4 text-center italic text-sm">Memuat daftar mahasiswa...</td></tr>');
                $.get("/akademik/api/mahasiswa-list", filters, function (data) {
                    let html = '';
                    if (data.length > 0) {
                        data.forEach(s => {
                            html += `<tr class="hover:bg-gray-50 border-b">
                            <td class="px-6 py-4"><input type="checkbox" class="student-checkbox rounded border-gray-300 text-[#004269]" value="${s.id_mahasiswa}"></td>
                            <td class="px-6 py-4 font-mono text-sm">${s.nipd}</td>
                            <td class="px-6 py-4 font-semibold text-sm">${s.nama_mhs}</td>
                            <td class="px-6 py-4 text-sm text-gray-600">${s.program_studi ? s.program_studi.nama_program_studi : '-'}</td>
                            <td class="px-6 py-4 text-sm text-[#FF0000] italic">Kosong</td>
                        </tr>`;
                        });
                    } else {
                        html = '<tr><td colspan="5" class="px-6 py-8 text-center text-gray-500 flex flex-col items-center"><svg class="w-8 h-8 mb-2 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 12H4"/></svg>Tidak ada mahasiswa tanpa kelas.</td></tr>';
                    }
                    $('#modal-student-list').html(html);
                });
            }

            $(document).on('change', '#modal-filter-jurusan, #modal-filter-angkatan, #modal-filter-periode', fetchStudentsForModal);
            $(document).on('change', '.student-checkbox', function () { $('#selected-count').text($('.student-checkbox:checked').length); });
            $(document).on('change', '#select-all-students', function () {
                $('.student-checkbox').prop('checked', $(this).prop('checked'));
                $('#selected-count').text($('.student-checkbox:checked').length);
            });

            $('#btn-next').click(function () {
                if ($('.student-checkbox:checked').length === 0) {
                    Swal.fire({ icon: 'warning', title: 'Oops!', text: 'Pilih minimal satu mahasiswa dulu ya!', confirmButtonColor: '#004269' });
                    return;
                }
                $('#step-content-1').addClass('hidden');
                $('#step-content-2').removeClass('hidden');
                $(this).addClass('hidden');
                $('#btn-submit, #btn-prev').removeClass('hidden');
                $('#step-indicator-1').removeClass('bg-[#004269]').addClass('bg-[#009DA5]');
                $('#step-indicator-2').removeClass('bg-gray-200 text-gray-500').addClass('bg-[#004269] text-white');
            });

            $('#btn-prev').click(function () {
                $('#step-content-2').addClass('hidden');
                $('#step-content-1').removeClass('hidden');
                $('#btn-next').removeClass('hidden');
                $('#btn-submit, #btn-prev').addClass('hidden');
                $('#step-indicator-2').removeClass('bg-[#004269] text-white').addClass('bg-gray-200 text-gray-500');
                $('#step-indicator-1').removeClass('bg-[#009DA5]').addClass('bg-[#004269]');
            });

            $(document).on('change', 'input[name="mode_kelas"]', function () {
                if ($(this).val() === 'new') {
                    $('#form-new-class').removeClass('hidden');
                    $('#form-existing-class').addClass('hidden');
                } else {
                    $('#form-existing-class').removeClass('hidden');
                    $('#form-new-class').addClass('hidden');
                }
            });

            $('#add-student-form').on('submit', function (e) {
                e.preventDefault();
                const studentIds = $('.student-checkbox:checked').map(function () { return $(this).val(); }).get();
                const mode = $('input[name="mode_kelas"]:checked').val();
                const selectedKelasId = $('#select-kelas-existing').val();

                if (studentIds.length === 0) {
                    Swal.fire({ icon: 'warning', title: 'Oops!', text: 'Pilih mahasiswanya dulu dong!', confirmButtonColor: '#004269' });
                    return;
                }
                if (mode === 'existing' && !selectedKelasId) {
                    Swal.fire({ icon: 'warning', title: 'Oops!', text: 'Pilih kelasnya dulu ya!', confirmButtonColor: '#004269' });
                    return;
                }

                let payload = {
                    student_ids: studentIds,
                    mode_kelas: mode,
                    id_kelas: selectedKelasId,
                    kode_mk: $('#new-kode-mk').val(),
                    nama_kelas_baru: $('#new-nama-kelas').val(),
                    jurusan_baru: $('#new-jurusan').val(),
                    tahun_ajaran: $('#new-tahun-ajaran').val(),
                    nama_pa: $('#new-nama-pa').val()
                };

                $.ajax({
                    url: "/akademik/mahasiswa/assign-class",
                    method: "POST",
                    data: payload,
                    beforeSend: function () { $('#btn-submit').prop('disabled', true).text('Sedang Menyimpan...'); },
                    success: function (response) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Berhasil!',
                            text: 'Data berhasil disimpan!',
                            confirmButtonColor: '#004269',
                            timer: 2000,
                            timerProgressBar: true
                        });
                        closeAllModals();
                        renderMainTable();
                        initFilters();
                    },
                    error: function (xhr) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Gagal!',
                            text: xhr.responseJSON?.message || "Terjadi kesalahan",
                            confirmButtonColor: '#004269'
                        });
                    },
                    complete: function () { $('#btn-submit').prop('disabled', false).text('Simpan Perubahan'); }
                });
            });

            // --- 4. EDIT & DELETE ---
            $(document).on('click', '.btn-edit-student', function () {
                const id = $(this).data('id');
                $('#edit-form')[0].reset();

                let programStudiHtml = '<option value="">-- Pilih Program Studi --</option>';
                allBidangKeahlianData.forEach(ps => {
                    programStudiHtml += `<option value="${ps.id_program_studi}">${ps.nama_program_studi} (${ps.kode_program_studi})</option>`;
                });
                $('#edit-id-bidang-keahlian').html(programStudiHtml);

                let periodeHtml = '<option value="">-- Periode --</option>';
                $('#filter-periode option').each(function () { if ($(this).val() !== "") periodeHtml += `<option value="${$(this).val()}">${$(this).text()}</option>`; });
                $('#edit-periode').html(periodeHtml);

                let kelasHtml = '<option value="">-- Kelas --</option>';
                allClassData.forEach(k => { kelasHtml += `<option value="${k.id_kelas}">${k.nama_kelas}</option>`; });
                $('#edit-id-kelas').html(kelasHtml);

                $.get(`/akademik/mahasiswa/${id}/edit`, function (s) {
                    $('#edit-id').val(s.id_mahasiswa);
                    $('#edit-nama').val(s.nama_mhs);
                    $('#edit-nipd').val(s.nipd);
                    $('#edit-id-bidang-keahlian').val(s.id_program_studi);
                    $('#edit-angkatan').val(s.angkatan);
                    $('#edit-periode').val(s.periode);
                    $('#edit-id-kelas').val(s.id_kelas);
                    $('#edit-jenis-kelamin').val(s.jenis_kelamin === 'Laki-laki' ? 'L' : (s.jenis_kelamin === 'Perempuan' ? 'P' : s.jenis_kelamin));
                    $('#edit-tempat-lahir').val(s.tempat_lahir);
                    $('#edit-tgl-lahir').val(s.tgl_lahir);
                    $('#edit-agama').val(s.agama);
                    $('#edit-email').val(s.email);
                    $('#edit-no-tlp').val(s.no_tlp);
                    $('#edit-alamat').val(s.alamat);
                    $('#edit-status').val(s.status);

                    if (s.foto) {
                        $('#edit-foto-preview').html(`<img src="/${s.foto}" class="w-full h-full object-cover">`);
                    } else {
                        $('#edit-foto-preview').html(`<svg class="w-12 h-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>`);
                    }
                    $('#edit-modal').removeClass('hidden');
                }).fail(function () {
                    Swal.fire({ icon: 'error', title: 'Gagal!', text: 'Gagal mengambil data mahasiswa', confirmButtonColor: '#004269' });
                });
            });

            $('#edit-form').on('submit', function (e) {
                e.preventDefault();
                const id = $('#edit-id').val();
                let formData = new FormData(this);
                formData.append('_method', 'PUT');

                $.ajax({
                    url: `/akademik/mahasiswa/${id}`,
                    method: 'POST',
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function (response) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Berhasil!',
                            text: 'Data berhasil diperbarui!',
                            confirmButtonColor: '#004269',
                            timer: 2000,
                            timerProgressBar: true
                        });
                        $('#edit-modal').addClass('hidden');
                        renderMainTable();
                    },
                    error: function (xhr) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Gagal!',
                            text: xhr.responseJSON?.message || "Terjadi kesalahan",
                            confirmButtonColor: '#004269'
                        });
                    }
                });
            });

            $(document).on('click', '.btn-delete-student', function () {
                const id = $(this).data('id');

                Swal.fire({
                    title: 'Hapus Data Mahasiswa?',
                    text: 'Data yang sudah dihapus tidak dapat dikembalikan!',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#dc2626',
                    cancelButtonColor: '#6b7280',
                    confirmButtonText: 'Ya, Hapus!',
                    cancelButtonText: 'Batal',
                    reverseButtons: true
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: `/akademik/mahasiswa/${id}`,
                            method: 'POST',
                            data: { _method: 'DELETE' },
                            success: function (response) {
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Terhapus!',
                                    text: 'Data mahasiswa berhasil dihapus!',
                                    confirmButtonColor: '#004269',
                                    timer: 2000,
                                    timerProgressBar: true
                                });
                                renderMainTable();
                            },
                            error: function (xhr) {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Gagal!',
                                    text: 'Gagal menghapus data mahasiswa',
                                    confirmButtonColor: '#004269'
                                });
                            }
                        });
                    }
                });
            });

            // --- 5. LOGIKA TUTUP MODAL ---
            function closeAllModals() {
                $('#edit-mahasiswa-modal').addClass('hidden').removeClass('flex items-center justify-center');
                $('#tambah-mahasiswa-modal, #edit-modal').addClass('hidden').removeClass('flex');
                if ($('#add-student-form').length) $('#add-student-form')[0].reset();
                if ($('#edit-form').length) $('#edit-form')[0].reset();
            }
            window.closeEditModal = function () {
                $('#edit-modal').addClass('hidden');
                $('#edit-form')[0].reset();
            }
            $(document).on('click', function (e) {
                const target = $(e.target);
                if (target.closest('.btn-batal').length || target.closest('.close-edit-modal').length || target.closest('[data-modal-hide]').length || target.attr('id') === 'btn-batal-edit' || (target.is('button') && target.text().trim() === 'Batal')) {
                    e.preventDefault();
                    closeAllModals();
                }
                if (target.is('#edit-mahasiswa-modal') || target.is('#tambah-mahasiswa-modal')) {
                    closeAllModals();
                }
            });
            $(document).on('click', 'button svg', function () {
                if ($(this).closest('#edit-mahasiswa-modal').length || $(this).closest('#tambah-mahasiswa-modal').length) {
                    const parentBtn = $(this).parent();
                    if (parentBtn.is('button')) {
                        closeAllModals();
                    }
                }
            });

            // --- 6. LOGIKA PRINT ---
            $('#print-btn').click(function () {
                const params = $.param({ jurusan: $('#filter-jurusan').val(), angkatan: $('#filter-tahun').val(), periode: $('#filter-periode').val(), kelas: $('#filter-kelas').val() });
                window.open("{{ route('admin.mahasiswa.print') }}?" + params, '_blank');
            });
        });
    </script>
@endpush