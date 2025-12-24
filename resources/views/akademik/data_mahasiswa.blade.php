@extends('layouts.app')

@section('content')
<div class="p-6">
    {{-- Header & Tombol Tambah --}}
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold text-gray-800">Kelola Data Mahasiswa</h1>
        <button id="add-student-btn" class="bg-green-600 hover:bg-green-700 text-white px-6 py-2 rounded-lg flex items-center shadow-md transition font-semibold">
            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
            Add Student To Class
        </button>
    </div>

    {{-- Container Filter Utama --}}
    <div class="bg-white p-6 rounded-xl shadow-lg mb-6 border border-gray-100">
        <h2 class="text-lg font-semibold text-gray-700 mb-4">Pencarian Data</h2>
        <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
            <div class="flex flex-col space-y-1">
                <label class="text-sm font-medium text-gray-600">Bidang Keahlian</label>
                <select id="filter-jurusan" class="p-2 border rounded-lg outline-none text-sm text-gray-700 bg-gray-50">
                    <option value="">Semua Bidang Keahlian</option>
                </select>
            </div>
            <div class="flex flex-col space-y-1">
                <label class="text-sm font-medium text-gray-600">Angkatan</label>
                <select id="filter-tahun" class="p-2 border rounded-lg outline-none text-sm text-gray-700 bg-gray-50">
                    <option value="">Semua Tahun</option>
                </select>
            </div>
            <div class="flex flex-col space-y-1">
                <label class="text-sm font-medium text-gray-600">Kelas</label>
                <select id="filter-kelas" class="p-2 border rounded-lg outline-none text-sm text-gray-700 bg-gray-50">
                    <option value="">Semua Kelas</option>
                </select>
            </div>
            <div class="flex flex-col space-y-1">
                <label class="text-sm font-medium text-gray-600">Periode</label>
                <select id="filter-periode" class="p-2 border rounded-lg outline-none text-sm text-gray-700 bg-gray-50">
                    <option value="">Semua Periode</option>
                </select>
            </div>
        </div>
        <div class="mt-6 flex justify-end space-x-3">
            <button id="show-data-btn" class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded-lg font-semibold transition shadow-md flex items-center">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                Show Data
            </button>
            <button id="print-btn" class="bg-purple-600 hover:bg-purple-700 text-white px-6 py-2 rounded-lg font-semibold transition shadow-md flex items-center">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"></path></svg>
                Print
            </button>
        </div>
    </div>

    {{-- Tabel Utama --}}
    <div class="bg-white rounded-xl shadow-lg overflow-hidden border border-gray-100 mb-6">
        <div id="header-daftar-mahasiswa" class="p-4 border-b flex justify-between items-center">
            <h3 class="font-bold text-white">Daftar Mahasiswa (<span id="student-count">0</span> data)</h3>
        </div>
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-sm font-extrabold text-gray-500 uppercase">NIPD</th>
                        <th class="px-6 py-3 text-left text-sm font-extrabold text-gray-500 uppercase">Nama</th>
                        <th class="px-6 py-3 text-left text-sm font-extrabold text-gray-500 uppercase">Bidang Keahlian</th>
                        <th class="px-6 py-3 text-center text-sm font-extrabold text-gray-500 uppercase">Angkatan</th>
                        <th class="px-6 py-3 text-left text-sm font-extrabold text-gray-500 uppercase">Kelas</th>
                        <th class="px-6 py-3 text-center text-sm font-extrabold text-gray-500 uppercase">Aksi</th>
                    </tr>
                </thead>
                <tbody id="student-table-body" class="bg-white divide-y divide-gray-200 text-sm">
                    <tr><td colspan="6" class="px-6 py-10 text-center text-gray-500 italic">Click "Show Data"...</td></tr>
                </tbody>
            </table>
        </div>
    </div>
</div>

@include('components.edit_mahasiswa_modal')
@include('components.tambah_mahasiswa_modal')
@endsection

@push('scripts')
<script>
$(document).ready(function() {
    // Setup CSRF Token untuk Laravel
    $.ajaxSetup({ headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') } });

    // State Global
    let allClassData = [];
    let isFetchingMain = false;

    // --- 1. INISIALISASI DATA & FILTER ---
    function initFilters() {
        $.get("/akademik/api/filter-data", function(response) {
            if (response.status === 'success') {
                allClassData = response.kelas || [];

                let jHtml = '<option value="">Semua Jurusan</option>';
                response.jurusan.forEach(j => { jHtml += `<option value="${j}">${j}</option>`; });
                $('#filter-jurusan, #modal-filter-jurusan, #class-filter-jurusan, #new-jurusan').html(jHtml);

                let aHtml = '<option value="">Semua Tahun</option>';
                response.angkatan.forEach(a => { aHtml += `<option value="${a}">${a}</option>`; });
                $('#filter-tahun, #modal-filter-angkatan').html(aHtml);

                let pHtml = '<option value="">Semua Periode</option>';
                response.periode.forEach(p => { pHtml += `<option value="${p}">${p}</option>`; });
                $('#filter-periode, #modal-filter-periode').html(pHtml);

                let kHtml = '<option value="">Semua Kelas</option>';
                allClassData.forEach(k => { kHtml += `<option value="${k.id_kelas}">${k.nama_kelas}</option>`; });
                $('#filter-kelas').html(kHtml);

                renderClassOptions(''); 
            }
        });
    }
    initFilters();

    function renderClassOptions(selectedJurusan) {
        let kelasHtml = '<option value="">-- Pilih Kelas --</option>';
        const filterVal = (selectedJurusan === "Semua Jurusan") ? "" : selectedJurusan;
        const filtered = filterVal === "" ? allClassData : allClassData.filter(k => String(k.jurusan).toLowerCase() === String(filterVal).toLowerCase());

        if (filtered.length > 0) {
            filtered.forEach(k => { kelasHtml += `<option value="${k.id_kelas}">${k.nama_kelas}</option>`; });
        } else {
            kelasHtml = '<option value="">Tidak ada kelas tersedia</option>';
        }
        $('#select-kelas-existing').html(kelasHtml);
    }

    $(document).on('change', '#class-filter-jurusan', function() { renderClassOptions($(this).val()); });

    // --- 2. LOGIKA TABEL UTAMA ---
    function renderMainTable() {
        if (isFetchingMain) return;
        isFetchingMain = true;

        const filters = {
            jurusan: $('#filter-jurusan').val(),
            angkatan: $('#filter-tahun').val(),
            periode: $('#filter-periode').val(),
            kelas: $('#filter-kelas').val()
        };

        $('#show-data-btn').prop('disabled', true).addClass('opacity-50');
        $('#student-table-body').html('<tr><td colspan="6" class="px-6 py-10 text-center italic">Memuat data...</td></tr>');

        $.get("/akademik/api/mahasiswa-list", filters, function(data) {
            let html = '';
            if (data.length === 0) {
                html = '<tr><td colspan="6" class="px-6 py-10 text-center text-red-500 font-medium">Data tidak ditemukan</td></tr>';
            } else {
                data.forEach(s => {
                    const kelasLabel = s.data_kelas ? `<span class="bg-blue-100 text-blue-800 text-xs font-semibold px-2.5 py-1 rounded-full border border-blue-200">${s.data_kelas.nama_kelas}</span>` : '<span class="text-red-400 text-xs italic">Belum Ada Kelas</span>';
                    html += `<tr class="hover:bg-gray-50 transition border-b">
                        <td class="px-6 py-4 font-mono text-sm text-gray-600">${s.nipd || s.nim || '-'}</td>
                        <td class="px-6 py-4 font-bold text-gray-900">${s.nama}</td>
                        <td class="px-6 py-4 text-sm text-gray-600">${s.jurusan || '-'}</td>
                        <td class="px-6 py-4 text-center text-sm text-gray-600">${s.angkatan || '-'}</td>
                        <td class="px-6 py-4">${kelasLabel}</td>
                        <td class="px-6 py-4 text-center">
                            <div class="flex justify-center space-x-2">
                                <button data-id="${s.id_mahasiswa}" class="btn-edit-student p-2 bg-blue-50 text-blue-600 rounded-full hover:bg-blue-600 hover:text-white transition shadow-sm">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path></svg>
                                </button>
                                <button data-id="${s.id_mahasiswa}" class="btn-delete-student p-2 bg-red-50 text-red-600 rounded-full hover:bg-red-600 hover:text-white transition shadow-sm">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                </button>
                            </div>
                        </td>
                    </tr>`;
                });
            }
            $('#student-table-body').html(html);
            $('#student-count').text(data.length);
        }).always(function() {
            isFetchingMain = false;
            $('#show-data-btn').prop('disabled', false).removeClass('opacity-50');
        });
    }
    $('#show-data-btn').click(renderMainTable);

    // --- 3. LOGIKA MODAL TAMBAH ---
    $(document).on('click', '#add-student-btn', function() {
        $('#tambah-mahasiswa-modal').removeClass('hidden').addClass('flex items-center justify-center');
        resetTambahModal();
        fetchStudentsForModal();
    });

    function resetTambahModal() {
        $('#step-content-1').removeClass('hidden');
        $('#step-content-2').addClass('hidden');
        $('#btn-next').removeClass('hidden');
        $('#btn-submit, #btn-prev').addClass('hidden');
        $('#step-indicator-1').addClass('bg-blue-600').removeClass('bg-green-500');
        $('#step-indicator-2').addClass('bg-gray-200 text-gray-500').removeClass('bg-blue-600 text-white');
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
        $.get("/akademik/api/mahasiswa-list", filters, function(data) {
            let html = '';
            if (data.length > 0) {
                data.forEach(s => {
                    html += `<tr class="hover:bg-gray-50 border-b">
                        <td class="px-6 py-4"><input type="checkbox" class="student-checkbox rounded border-gray-300 text-blue-600" value="${s.id_mahasiswa}"></td>
                        <td class="px-6 py-4 font-mono text-sm">${s.nipd || s.nim}</td>
                        <td class="px-6 py-4 font-semibold text-sm">${s.nama}</td>
                        <td class="px-6 py-4 text-sm text-gray-600">${s.jurusan}</td>
                        <td class="px-6 py-4 text-sm text-red-500 italic">Kosong</td>
                    </tr>`;
                });
            } else {
                html = '<tr><td colspan="5" class="px-6 py-4 text-center text-gray-500">Tidak ada mahasiswa tanpa kelas.</td></tr>';
            }
            $('#modal-student-list').html(html);
        });
    }

    $(document).on('change', '#modal-filter-jurusan, #modal-filter-angkatan, #modal-filter-periode', fetchStudentsForModal);
    $(document).on('change', '.student-checkbox', function() { $('#selected-count').text($('.student-checkbox:checked').length); });
    $(document).on('change', '#select-all-students', function() {
        $('.student-checkbox').prop('checked', $(this).prop('checked'));
        $('#selected-count').text($('.student-checkbox:checked').length);
    });

    $('#btn-next').click(function() {
        if ($('.student-checkbox:checked').length === 0) { alert("Pilih minimal satu mahasiswa dulu ya, Bubub!"); return; }
        $('#step-content-1').addClass('hidden');
        $('#step-content-2').removeClass('hidden');
        $(this).addClass('hidden');
        $('#btn-submit, #btn-prev').removeClass('hidden');
        $('#step-indicator-1').removeClass('bg-blue-600').addClass('bg-green-500');
        $('#step-indicator-2').removeClass('bg-gray-200 text-gray-500').addClass('bg-blue-600 text-white');
    });

    $('#btn-prev').click(function() {
        $('#step-content-2').addClass('hidden');
        $('#step-content-1').removeClass('hidden');
        $('#btn-next').removeClass('hidden');
        $('#btn-submit, #btn-prev').addClass('hidden');
        $('#step-indicator-2').removeClass('bg-blue-600 text-white').addClass('bg-gray-200 text-gray-500');
        $('#step-indicator-1').removeClass('bg-green-500').addClass('bg-blue-600');
    });

    $(document).on('change', 'input[name="mode_kelas"]', function() {
        if ($(this).val() === 'new') {
            $('#form-new-class').removeClass('hidden');
            $('#form-existing-class').addClass('hidden');
        } else {
            $('#form-existing-class').removeClass('hidden');
            $('#form-new-class').addClass('hidden');
        }
    });

    $('#add-student-form').on('submit', function(e) {
        e.preventDefault();
        const studentIds = $('.student-checkbox:checked').map(function() { return $(this).val(); }).get();
        const mode = $('input[name="mode_kelas"]:checked').val();
        const selectedKelasId = $('#select-kelas-existing').val();

        if (studentIds.length === 0) { alert("Pilih mahasiswanya dulu dong!"); return; }
        if (mode === 'existing' && !selectedKelasId) { alert("Pilih kelasnya dulu ya!"); return; }

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
            beforeSend: function() { $('#btn-submit').prop('disabled', true).text('Sedang Menyimpan...'); },
            success: function(response) {
                alert("Mantap! Berhasil memproses data.");
                closeAllModals();
                renderMainTable();
                initFilters();
            },
            error: function(xhr) { alert("Gagal: " + (xhr.responseJSON?.message || "Error")); },
            complete: function() { $('#btn-submit').prop('disabled', false).text('Simpan Perubahan'); }
        });
    });

    // --- 4. EDIT & DELETE ---
    $(document).on('click', '.btn-edit-student', function() {
        const id = $(this).data('id');
        $('#edit-student-form')[0].reset();
        
        let jurusanHtml = '<option value="">-- Jurusan --</option>';
        $('#filter-jurusan option').each(function() { if ($(this).val() !== "") jurusanHtml += `<option value="${$(this).val()}">${$(this).text()}</option>`; });
        $('#edit-jurusan').html(jurusanHtml);

        let periodeHtml = '<option value="">-- Periode --</option>';
        $('#filter-periode option').each(function() { if ($(this).val() !== "") periodeHtml += `<option value="${$(this).val()}">${$(this).text()}</option>`; });
        $('#edit-periode').html(periodeHtml);

        let kelasHtml = '<option value="">-- Kelas --</option>';
        allClassData.forEach(k => { kelasHtml += `<option value="${k.id_kelas}">${k.nama_kelas}</option>`; });
        $('#edit-id-kelas').html(kelasHtml);

        $.get(`/akademik/mahasiswa/${id}/edit`, function(s) {
            $('#edit-student-id').val(s.id_mahasiswa);
            $('#edit-nama').val(s.nama);
            $('#edit-nipd').val(s.nipd || s.nim);
            $('#edit-jurusan').val(s.jurusan);
            $('#edit-angkatan').val(s.angkatan);
            $('#edit-periode').val(s.periode);
            $('#edit-id-kelas').val(s.id_kelas); 
            $('#edit-mahasiswa-modal').removeClass('hidden').addClass('flex items-center justify-center');
        }).fail(function() { alert("Gagal ambil data!"); });
    });

    $('#edit-student-form').on('submit', function(e) {
        e.preventDefault();
        const id = $('#edit-student-id').val();
        let formData = $(this).serialize();

        $.ajax({
            url: `/akademik/mahasiswa/${id}`,
            method: 'POST',
            data: formData + "&_method=PUT",
            success: function(response) {
                alert("Mantap! Data berhasil diperbarui.");
                closeAllModals();
                renderMainTable();
            },
            error: function(xhr) { alert("Gagal update data! Cek inputan kamu Bubub."); }
        });
    });

    $(document).on('click', '.btn-delete-student', function() {
        const id = $(this).data('id');
        if (confirm("Yakin mau hapus data ini? Data yang dihapus gak bisa balik lagi lho.")) {
            $.ajax({
                url: `/akademik/mahasiswa/${id}`,
                method: 'POST',
                data: { _method: 'DELETE' },
                success: function(response) {
                    alert("Data berhasil dihapus!");
                    renderMainTable();
                },
                error: function(xhr) { alert("Gagal hapus data!"); }
            });
        }
    });

    // --- 5. LOGIKA TUTUP MODAL (REVISI TOTAL SELECTOR) ---
function closeAllModals() {
    // Menutup semua modal dengan paksa lewat class hidden
    $('#edit-mahasiswa-modal').addClass('hidden').removeClass('flex items-center justify-center');
    $('#tambah-mahasiswa-modal').addClass('hidden').removeClass('flex items-center justify-center');
    
    // Reset form supaya bersih pas dibuka lagi
    if ($('#add-student-form').length) $('#add-student-form')[0].reset();
    if ($('#edit-student-form').length) $('#edit-student-form')[0].reset();
}

// Global click listener untuk tombol Batal dan Icon Close
$(document).on('click', function(e) {
    const target = $(e.target);

    // 1. Cek apakah yang diklik adalah tombol Batal atau tombol dengan atribut close
    // Kita tangkap semua kemungkinan class: .btn-batal, .close-modal, atau tombol Batal biasa
    if (target.closest('.btn-batal').length || 
        target.closest('.close-edit-modal').length || 
        target.closest('[data-modal-hide]').length ||
        target.attr('id') === 'btn-batal-edit' ||
        (target.is('button') && target.text().trim() === 'Batal')) {
        
        e.preventDefault();
        closeAllModals();
    }

    // 2. Cek apakah klik di area luar modal (overlay)
    if (target.is('#edit-mahasiswa-modal') || target.is('#tambah-mahasiswa-modal')) {
        closeAllModals();
    }
});

// Listener khusus untuk icon X (biasanya button paling pojok kanan atas)
$(document).on('click', 'button svg', function() {
    if ($(this).closest('#edit-mahasiswa-modal').length || $(this).closest('#tambah-mahasiswa-modal').length) {
        // Jika SVG di dalam modal diklik (icon close), tutup modal
        const parentBtn = $(this).parent();
        if (parentBtn.is('button')) {
            closeAllModals();
        }
    }
});

    // --- 6. LOGIKA PRINT ---

    $('#print-btn').click(function() {
        const params = $.param({ jurusan: $('#filter-jurusan').val(), angkatan: $('#filter-tahun').val(), periode: $('#filter-periode').val(), kelas: $('#filter-kelas').val() });
        window.open("{{ route('admin.mahasiswa.print') }}?" + params, '_blank');
    });
});
</script>
@endpush