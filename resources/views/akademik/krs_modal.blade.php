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
                <span class="font-bold">Info:</span> Materi Ajar yang dipilih akan ditambahkan ke KRS seluruh mahasiswa di kelas ini.
            </p>
        </div>

        <form id="form-batch-krs">
            @csrf
            <input type="hidden" name="id_kelas" value="{{ $id_kelas }}">
            
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4 mb-6 p-4 bg-gray-50 rounded-lg">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Tahun Akademik</label>
                    <input 
                        type="text" 
                        name="tahun_akademik" 
                        class="w-full px-3 py-2 border border-gray-300 rounded-md" 
                        placeholder="2024/2025"
                        pattern="\d{4}/\d{4}"
                        title="Format: YYYY/YYYY (contoh: 2024/2025)"
                        value="{{ $tahun_akademik }}"
                        required
                    >
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Dosen Pengampu</label>
                    <select name="id_pendidik" class="w-full px-3 py-2 border border-gray-300 rounded-md" required>
                        <option value="">Pilih Dosen</option>
                        @foreach($pendidikList as $p)
                            <option value="{{ $p->id_pendidik }}">{{ $p->nama_pendidik }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Program Studi</label>
                    <select id="filter-program-studi" class="w-full px-3 py-2 border border-gray-300 rounded-md">
                        <option value="">Pilih Program Studi</option>
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
                    <span class="font-bold text-gray-700">Pilih Semua Materi Ajar</span>
                </label>
            </div>

            <div id="batch-matkul-list" class="space-y-2 mb-6 min-h-[200px]">
                <div class="text-center py-8 text-gray-500">
                    Pilih Program Studi dan Semester untuk melihat daftar Materi Ajar
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
        loadProgramStudi();
    });

    $('#close-batch-modal, #btn-cancel-batch').click(function() {
        $('#batch-add-modal').addClass('hidden');
    });

    // Toggle Check All
    $('#check-all').change(function() {
        $('.matkul-checkbox').prop('checked', $(this).is(':checked'));
    });

    // Load Program Studi
    function loadProgramStudi() {
        $.ajax({
            url: "{{ route('admin.api.krs.program_studi') }}",
            method: 'GET',
            success: function(data) {
                const select = $('#filter-program-studi');
                select.find('option:not(:first)').remove();
                data.forEach(ps => {
                    select.append(`<option value="${ps.id_program_studi}">${ps.kode_program_studi} - ${ps.nama_program_studi}</option>`);
                });
            },
            error: function() {
                Swal.fire({ icon: 'error', title: 'Gagal!', text: 'Gagal memuat program studi', confirmButtonColor: '#004269' });
            }
        });
    }

    // Cascading: Load Materi Ajar when filters change
    $('#filter-program-studi, #filter-semester-modal').change(function() {
        const id_program_studi = $('#filter-program-studi').val();
        const semester = $('#filter-semester-modal').val();

        if (id_program_studi && semester) {
            loadMataKuliah(id_program_studi, semester);
        } else {
            $('#batch-matkul-list').html('<div class="text-center py-8 text-gray-500">Pilih Program Studi dan Semester untuk melihat daftar Materi Ajar</div>');
        }
    });

    function loadMataKuliah(id_program_studi, semester) {
        $('#batch-matkul-list').html('<div class="text-center py-8 text-gray-500"><svg class="animate-spin h-8 w-8 text-gray-500 mx-auto mb-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path></svg>Memuat Materi Ajar...</div>');

        $.ajax({
            url: "{{ route('admin.api.krs.matkul_filtered') }}",
            method: 'GET',
            data: {
                id_program_studi: id_program_studi,
                semester: semester,
                id_kelas: id_kelas,
                tahun_akademik: tahun_akademik,
                nipd: 'dummy'
            },
            success: function(mataKuliah) {
                renderMataKuliahList(mataKuliah);
            },
            error: function() {
                $('#batch-matkul-list').html('<p class="text-red-500 text-center">Gagal memuat Materi Ajar.</p>');
            }
        });
    }

    function renderMataKuliahList(mataKuliah) {
        const container = $('#batch-matkul-list');
        container.empty();

        if (mataKuliah.length === 0) {
            container.html('<p class="text-gray-500 text-center py-4">Tidak ada Materi Ajar tersedia untuk kriteria filter ini.</p>');
            return;
        }

        mataKuliah.forEach(mk => {
            const row = $(`
                <label class="flex items-center p-3 border rounded hover:bg-gray-50 cursor-pointer transition">
                    <input type="checkbox" name="matkul_ids[]" value="${mk.id_mk}" class="matkul-checkbox mr-3 h-5 w-5 text-[#004269] rounded focus:ring-[#009DA5]">
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
    $('#form-batch-krs').submit(function(e) {
        e.preventDefault();
        
        if ($('.matkul-checkbox:checked').length === 0) {
            Swal.fire({ icon: 'warning', title: 'Perhatian!', text: 'Pilih minimal satu Materi Ajar!', confirmButtonColor: '#004269' });
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
