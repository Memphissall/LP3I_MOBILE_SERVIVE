<!-- Modal Batch Add KRS -->
<div id="batch-add-modal" class="hidden fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">
    <div class="bg-white rounded-lg p-6 w-full max-w-4xl max-h-[90vh] overflow-y-auto">
        <div class="flex justify-between items-center mb-4 border-b pb-4">
            <h3 class="text-xl font-bold text-[#004269]">
                Tambah Paket KRS (Satu Kelas)
            </h3>
            <button id="close-batch-modal" class="text-gray-500 hover:text-gray-700">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </button>
        </div>

        <div class="mb-4 bg-[#004269]/10 p-4 rounded-md">
            <p class="text-sm text-[#004269]">
                <span class="font-bold">Info:</span> Mata kuliah yang dipilih akan ditambahkan ke KRS seluruh mahasiswa di kelas ini.
            </p>
        </div>

        <form id="form-batch-add">
            @csrf
            <input type="hidden" name="id_kelas" value="{{ $id_kelas }}">
            <input type="hidden" name="tahun_akademik" value="{{ $tahun_akademik }}">
            
            <!-- Cascading Select Filters -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6 p-4 bg-gray-50 rounded-lg">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Bidang Keahlian</label>
                    <select id="filter-bidang-keahlian" class="w-full px-3 py-2 border border-gray-300 rounded-md">
                        <option value="">Pilih Bidang Keahlian</option>
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Semester</label>
                    <select id="filter-semester-modal" name="semester" class="w-full px-3 py-2 border border-gray-300 rounded-md">
                        <option value="">Pilih Semester</option>
                        @for($i = 1; $i <= 8; $i++)
                            <option value="{{ $i }}">Semester {{ $i }}</option>
                        @endfor
                    </select>
                </div>
            </div>

            <div class="mb-4">
                <label class="flex items-center">
                    <input type="checkbox" id="check-all" class="mr-2 rounded text-[#004269] focus:ring-[#009DA5]">
                    <span class="font-bold text-gray-700">Pilih Semua Mata Kuliah</span>
                </label>
            </div>

            <div id="batch-matkul-list" class="space-y-2 mb-6 min-h-[200px]">
                <div class="text-center py-8 text-gray-500">
                    Pilih Bidang Keahlian dan Semester untuk melihat daftar mata kuliah
                </div>
            </div>

            <div class="flex justify-end gap-2 border-t pt-4">
                <button type="button" id="btn-cancel-batch" class="px-4 py-2 border border-gray-300 rounded-md text-gray-700 hover:bg-gray-50">
                    Batal
                </button>
                <button type="submit" class="px-4 py-2 bg-[#009DA5] text-white rounded-md hover:bg-[#00888f] font-bold shadow-lg transition">
                    Simpan Paket KRS
                </button>
            </div>
        </form>
    </div>
</div>

<script>
$(document).ready(function() {
    const id_kelas = '{{ $id_kelas }}';
    const tahun_akademik = '{{ $tahun_akademik }}';

    // Batch Add Modal
    $('#btn-batch-add').click(function() {
        if (!id_kelas) {
            Swal.fire({ icon: 'warning', title: 'Perhatian!', text: 'Pilih kelas terlebih dahulu pada filter!', confirmButtonColor: '#004269' });
            return;
        }
        $('#batch-add-modal').removeClass('hidden');
        loadBidangKeahlian();
    });

    $('#close-batch-modal, #btn-cancel-batch').click(function() {
        $('#batch-add-modal').addClass('hidden');
    });

    // Toggle Check All
    $('#check-all').change(function() {
        $('.matkul-checkbox').prop('checked', $(this).is(':checked'));
    });

    // Load Bidang Keahlian
    function loadBidangKeahlian() {
        $.ajax({
            url: "{{ route('admin.api.krs.bidang_keahlian') }}",
            method: 'GET',
            success: function(data) {
                const select = $('#filter-bidang-keahlian');
                select.find('option:not(:first)').remove();
                data.forEach(bk => {
                    select.append(`<option value="${bk.id_bidang_keahlian}">${bk.kode} - ${bk.nama}</option>`);
                });
            },
            error: function() {
                Swal.fire({ icon: 'error', title: 'Gagal!', text: 'Gagal memuat bidang keahlian', confirmButtonColor: '#004269' });
            }
        });
    }

    // Cascading: Load Mata Kuliah when filters change
    $('#filter-bidang-keahlian, #filter-semester-modal').change(function() {
        const id_bidang_keahlian = $('#filter-bidang-keahlian').val();
        const semester = $('#filter-semester-modal').val();

        if (id_bidang_keahlian && semester) {
            loadMataKuliah(id_bidang_keahlian, semester);
        } else {
            $('#batch-matkul-list').html('<div class="text-center py-8 text-gray-500">Pilih Bidang Keahlian dan Semester untuk melihat daftar mata kuliah</div>');
        }
    });

    function loadMataKuliah(id_bidang_keahlian, semester) {
        $('#batch-matkul-list').html('<div class="text-center py-8 text-gray-500"><svg class="animate-spin h-8 w-8 text-gray-500 mx-auto mb-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path></svg>Memuat mata kuliah...</div>');

        $.ajax({
            url: "{{ route('admin.api.krs.matkul_filtered') }}",
            method: 'GET',
            data: {
                id_bidang_keahlian: id_bidang_keahlian,
                semester: semester,
                id_kelas: id_kelas,
                tahun_akademik: tahun_akademik,
                nipd: 'dummy'
            },
            success: function(mataKuliah) {
                renderMataKuliahList(mataKuliah);
            },
            error: function() {
                $('#batch-matkul-list').html('<p class="text-red-500 text-center">Gagal memuat mata kuliah.</p>');
            }
        });
    }

    function renderMataKuliahList(mataKuliah) {
        const container = $('#batch-matkul-list');
        container.empty();

        if (mataKuliah.length === 0) {
            container.html('<p class="text-gray-500 text-center py-4">Tidak ada mata kuliah tersedia untuk kriteria filter ini.</p>');
            return;
        }

        mataKuliah.forEach(mk => {
            const row = $(`
                <label class="flex items-center p-3 border rounded hover:bg-gray-50 cursor-pointer transition">
                    <input type="checkbox" name="matkul_ids[]" value="${mk.id_matkul}" class="matkul-checkbox mr-3 h-5 w-5 text-[#004269] rounded focus:ring-[#009DA5]">
                    <div class="flex-1">
                        <div class="font-bold text-gray-800">${mk.kode_mk} - ${mk.nama_mk}</div>
                        <div class="text-xs text-gray-500 mt-1">
                            <span class="mr-4">SKS: ${mk.sks}</span>
                            <span class="mr-4">Semester: ${mk.semester}</span>
                            <span>Bobot: ${mk.bobot_kompetensi || '-'}</span>
                        </div>
                    </div>
                </label>
            `);
            container.append(row);
        });
    }

    // Handle Form Submit
    $('#form-batch-add').submit(function(e) {
        e.preventDefault();
        
        if ($('.matkul-checkbox:checked').length === 0) {
            Swal.fire({ icon: 'warning', title: 'Perhatian!', text: 'Pilih minimal satu mata kuliah!', confirmButtonColor: '#004269' });
            return;
        }

        const formData = $(this).serialize();
        const btn = $(this).find('button[type="submit"]');
        const originalText = btn.text();

        btn.prop('disabled', true).text('Menyimpan...');

        $.ajax({
            url: "{{ route('admin.krs.store.batch') }}",
            method: 'POST',
            data: formData,
            success: function(response) {
                Swal.fire({
                    icon: 'success',
                    title: 'Berhasil!',
                    text: response.message || 'Data KRS berhasil disimpan!',
                    confirmButtonColor: '#004269',
                    timer: 2000,
                    timerProgressBar: true
                }).then(() => {
                    location.reload();
                });
            },
            error: function(xhr) {
                Swal.fire({
                    icon: 'error',
                    title: 'Gagal!',
                    text: xhr.responseJSON?.error || xhr.responseText || 'Terjadi kesalahan',
                    confirmButtonColor: '#004269'
                });
                btn.prop('disabled', false).text(originalText);
            }
        });
    });
});
</script>
