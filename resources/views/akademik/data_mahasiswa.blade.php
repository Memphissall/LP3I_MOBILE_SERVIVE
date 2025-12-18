{{-- resources/views/akademik/data_mahasiswa.blade.php --}}

@extends('layouts.app') 

@section('content')

<div class="min-h-screen bg-gray-50 p-4 md:p-8 font-sans">
    <h1 class="text-3xl font-extrabold text-gray-800 mb-6 border-b pb-2">
        Kelola Data Mahasiswa
        <button id="add-student-btn"
            class="float-right text-sm flex items-center space-x-2 px-4 py-2 bg-green-600 text-white font-semibold rounded-lg shadow-md hover:bg-green-700 transition duration-150 transform hover:scale-[1.02] active:scale-100"
        >
            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="12" y1="5" x2="12" y2="19"></line><line x1="5" y1="12" x2="19" y2="12"></line></svg>
            <span>Tambah Mahasiswa</span>
        </button>
    </h1>

    {{-- --- BAGIAN FILTER DAN TOMBOL TAMBAH --- --}}
    <div class="bg-white p-6 rounded-xl shadow-lg mb-6">
        <h2 class="text-lg font-semibold text-gray-700 mb-4">Pencarian Data</h2>
        
        <div class="grid grid-cols-2 md:grid-cols-4 gap-4" id="filter-container">
            {{-- Dropdown Jurusan --}}
            <div class="flex flex-col space-y-1">
                <label for="filter-jurusan" class="text-sm font-medium text-gray-700">Jurusan</label>
                <select id="filter-jurusan" class="p-2 border border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500 transition duration-150">
                    <option value="Semua Jurusan">Semua Jurusan</option>
                    <option value="Teknik Informatika">Teknik Informatika</option>
                    <option value="Sistem Informasi">Sistem Informasi</option>
                    <option value="Akuntansi">Akuntansi</option>
                </select>
            </div>
            
            {{-- Dropdown Tahun Masuk --}}
            <div class="flex flex-col space-y-1">
                <label for="filter-tahun" class="text-sm font-medium text-gray-700">Tahun Masuk</label>
                <select id="filter-tahun" class="p-2 border border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500 transition duration-150">
                    <option value="Semua Tahun">Semua Tahun</option>
                    <option value="2023">2023</option>
                    <option value="2022">2022</option>
                    <option value="2021">2021</option>
                </select>
            </div>
            
            {{-- Dropdown Periode --}}
            <div class="flex flex-col space-y-1">
                <label for="filter-periode" class="text-sm font-medium text-gray-700">Periode</label>
                <select id="filter-periode" class="p-2 border border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500 transition duration-150">
                    <option value="Semua Periode">Semua Periode</option>
                    <option value="Ganjil">Ganjil</option>
                    <option value="Genap">Genap</option>
                </select>
            </div>

            {{-- Dropdown Kelas --}}
            <div class="flex flex-col space-y-1">
                <label for="filter-kelas" class="text-sm font-medium text-gray-700">Kelas</label>
                <select id="filter-kelas" class="p-2 border border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500 transition duration-150">
                    <option value="Semua Kelas">Semua Kelas</option>
                    <option value="A">A</option>
                    <option value="B">B</option>
                    <option value="C">C</option>
                </select>
            </div>
        </div>
        
        <div class="mt-6 flex justify-end">
            <button id="show-data-btn"
                class="flex items-center space-x-2 px-4 py-2 bg-blue-600 text-white font-semibold rounded-lg shadow-md hover:bg-blue-700 transition duration-150 transform hover:scale-[1.02] active:scale-100"
            >
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>
                <span>Tampilkan Data</span>
            </button>
            <button id="print-btn"
                class="ml-3 flex items-center space-x-2 px-4 py-2 bg-gray-600 text-white font-semibold rounded-lg shadow-md hover:bg-gray-700 transition duration-150 transform hover:scale-[1.02] active:scale-100"
            >
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="6 9 6 2 18 2 18 9"></polyline><path d="M6 18H4a2 2 0 0 1-2-2v-5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v5a2 2 0 0 1-2 2h-2"></path><rect x="6" y="14" width="12" height="8"></rect></svg>
                <span>Print</span>
            </button>
        </div>
    </div>

    {{-- --- BAGIAN TABEL DATA MAHASISWA --- --}}
    <div class="bg-white p-6 rounded-xl shadow-lg">
        <h2 class="text-lg font-semibold text-gray-700 mb-4">Daftar Mahasiswa (<span id="student-count">0</span> data)</h2>
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">NIM</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Jurusan</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Thn Masuk</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Periode</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Kelas</th>
                        <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200" id="student-table-body">
                    {{-- Data akan diisi oleh JavaScript --}}
                </tbody>
            </table>
            <div id="no-data-message" class="text-center py-10 text-gray-500 hidden">
                <p>Tidak ada data mahasiswa yang sesuai dengan filter saat ini.</p>
                <p class="mt-2 text-sm">Coba ubah filter atau tambahkan data mahasiswa baru.</p>
            </div>
        </div>
    </div>
</div>

{{-- MODAL COMPONENTS --}}
@include('components.tambah_mahasiswa_modal')
@include('components.edit_mahasiswa_modal')

@endsection

@push('scripts')
<script>
$(document).ready(function() {
    // --- VARIABLES & STATE ---
    let currentStep = 1;
    let selectedStudents = [];
    
    // API Endpoints
    const apiMahasiswaList = "{{ route('admin.api.mahasiswa.list') }}";
    const apiKelasList = "{{ route('admin.api.kelas.list') }}";
    const apiAddStudents = "{{ route('admin.api.kelas.add_students') }}";

    // --- MAIN TABLE RENDERING (Mockup for now, replace with real data handling later if needed) ---
    // Note: The main table logic from existing code is kept simple for now or can be connected to real DB
    // For this task, we focus on the MODAL logic.
    // ... (Existing main table logic if any, currently using mock data in previous version) ...
    // Re-implementing simplified mockup render for main view for context:
    // --- MAIN TABLE RENDERING ---
    function renderMainTable() {
        const filters = {
            jurusan: $('#filter-jurusan').val(),
            angkatan: $('#filter-tahun').val(), // Changed from 'tahun' to 'angkatan' to match API
            periode: $('#filter-periode').val(),
            kelas: $('#filter-kelas').val(),
        };

        $('#student-table-body').html('<tr><td colspan="7" class="px-6 py-4 text-center">Memuat data...</td></tr>');

        $.ajax({
            url: apiMahasiswaList,
            method: 'GET',
            data: filters, 
            success: function(data) {
                const $tbody = $('#student-table-body');
                $tbody.empty();

                if (data.length === 0) {
                     $('#no-data-message').removeClass('hidden');
                     $tbody.closest('table').addClass('hidden');
                } else {
                     $('#no-data-message').addClass('hidden');
                     $tbody.closest('table').removeClass('hidden');
                     
                     data.forEach(student => {
                        const kelasDisplay = student.id_kelas ? `<span class="bg-blue-100 text-blue-800 text-xs font-semibold px-2.5 py-0.5 rounded">ID: ${student.id_kelas}</span>` : '<span class="text-red-500 text-xs">Belum Ada</span>';
                        
                        const row = `
                            <tr data-id="${student.id}" class="hover:bg-gray-50 transition duration-100">
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">${student.nim || '-'}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">${student.nama}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">${student.jurusan || '-'}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">${student.angkatan || '-'}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">${student.periode || '-'}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">${kelasDisplay}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium flex justify-center space-x-2">
                                    <button data-id="${student.id}" class="btn-edit-student text-blue-600 hover:text-blue-900 bg-blue-100 p-2 rounded-full cursor-pointer"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M17 3a2.85 2.85 0 0 1 4 4L7.5 20.5 2 22l1.5-5.5L17 3z"></path></svg></button>
                                    <button data-id="${student.id}" class="btn-delete-student text-red-600 hover:text-red-900 bg-red-100 p-2 rounded-full cursor-pointer"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M3 6h18"></path><path d="M19 6v14c0 1-1 2-2 2H7c-1 0-2-1-2-2V6"></path><path d="M8 6V4c0-1 1-2 2-2h4c1 0 2 1 2 2v2"></path></svg></button>
                                </td>
                            </tr>
                        `;
                        $tbody.append(row);
                    });
                     $('#student-count').text(data.length);
                }
            },
            error: function(err) {
                console.error('Error fetching main table:', err);
                $('#student-table-body').html('<tr><td colspan="7" class="px-6 py-4 text-center text-red-500">Gagal memuat data.</td></tr>');
            }
        });
    }

    // --- EVENT LISTENERS JQUERY ---
    
    // Manual Load using Button
    $('#show-data-btn').click(function() {
        renderMainTable();
    });

    // Remove auto-load on filter change (User requested manual load)
    // $('#filter-container select').on('change', renderMainTable); 

    // Initial load - REMOVED per user request
    // renderMainTable();

    // =========================================================================
    // MODAL LOGIC
    // =========================================================================

    // --- OPEN/CLOSE MODAL ---
    $('#add-student-btn').click(function() {
        $('#tambah-mahasiswa-modal').removeClass('hidden');
        resetModal();
        loadStudentsForModal();
    });

    $('.close-modal').click(function() {
        $('#tambah-mahasiswa-modal').addClass('hidden');
    });

    function resetModal() {
        currentStep = 1;
        selectedStudents = [];
        $('#add-student-form')[0].reset();
        $('#select-all-students').prop('checked', false);
        updateStepUI();
    }

    // --- STEP NAVIGATION ---
    function updateStepUI() {
        if (currentStep === 1) {
            $('#step-content-1').removeClass('hidden');
            $('#step-content-2').addClass('hidden');
            
            $('#step-indicator-1').addClass('bg-blue-600 text-white').removeClass('bg-gray-200 text-gray-500');
            $('#step-indicator-2').removeClass('bg-blue-600 text-white').addClass('bg-gray-200 text-gray-500');
            $('#step-line-1').removeClass('border-blue-600').addClass('border-gray-300');
            
            $('#step-label-1').addClass('text-blue-600').removeClass('text-gray-500');
            $('#step-label-2').removeClass('text-blue-600').addClass('text-gray-500');

            $('#btn-prev').addClass('hidden');
            $('#btn-next').removeClass('hidden');
            $('#btn-submit').addClass('hidden');
            
            // Adjust modal size for step 1 if needed
            $('#modal-panel').removeClass('max-w-2xl').addClass('max-w-4xl');
        } else {
            $('#step-content-1').addClass('hidden');
            $('#step-content-2').removeClass('hidden');
            
            $('#step-indicator-1').removeClass('bg-blue-600 text-white').addClass('bg-green-600 text-white'); // Finished step
            $('#step-indicator-2').addClass('bg-blue-600 text-white').removeClass('bg-gray-200 text-gray-500');
            $('#step-line-1').addClass('border-blue-600').removeClass('border-gray-300');

            $('#step-label-1').addClass('text-green-600').removeClass('text-blue-600');
            $('#step-label-2').addClass('text-blue-600').removeClass('text-gray-500');

            $('#btn-prev').removeClass('hidden');
            $('#btn-next').addClass('hidden');
            $('#btn-submit').removeClass('hidden');
            
            // Adjust modal size for step 2 if needed (forms are smaller)
            $('#modal-panel').removeClass('max-w-4xl').addClass('max-w-2xl');

            loadKelasForModal(); // Load class data when entering step 2
        }
    }

    $('#btn-next').click(function() {
        if (selectedStudents.length === 0) {
            alert('Pilih minimal satu mahasiswa terlebih dahulu.');
            return;
        }
        currentStep = 2;
        updateStepUI();
    });

    $('#btn-prev').click(function() {
        currentStep = 1;
        updateStepUI();
    });

    // --- STEP 1: LOAD & FILTER MAHASISWA ---
    function loadStudentsForModal() {
        const filters = {
            jurusan: $('#modal-filter-jurusan').val(),
            angkatan: $('#modal-filter-angkatan').val(),
            periode: $('#modal-filter-periode').val()
        };

        $('#modal-student-list').html('<tr><td colspan="5" class="px-6 py-4 text-center">Memuat data...</td></tr>');

        $.ajax({
            url: apiMahasiswaList,
            method: 'GET',
            data: filters,
            success: function(data) {
                renderModalStudentTable(data);
            },
            error: function(err) {
                console.error('Error fetching students:', err);
                $('#modal-student-list').html('<tr><td colspan="5" class="px-6 py-4 text-center text-red-500">Gagal memuat data.</td></tr>');
            }
        });
    }

    function renderModalStudentTable(data) {
        const $tbody = $('#modal-student-list');
        $tbody.empty();

        if (data.length === 0) {
            $tbody.html('<tr><td colspan="5" class="px-6 py-4 text-center text-gray-500">Tidak ada data mahasiswa ditemukan.</td></tr>');
            return;
        }

        data.forEach(mhs => {
            const isChecked = selectedStudents.includes(mhs.id) ? 'checked' : '';
            const row = `
                <tr class="hover:bg-gray-50">
                    <td class="px-6 py-4 whitespace-nowrap">
                        <input type="checkbox" class="student-checkbox rounded border-gray-300 text-blue-600 focus:ring-blue-500" 
                            value="${mhs.id}" ${isChecked}>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">${mhs.nim || '-'}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">${mhs.nama}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">${mhs.jurusan || '-'}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">${mhs.id_kelas ? 'Sudah Ada' : '<span class="text-green-600 font-bold">Belum Ada</span>'}</td>
                </tr>
            `;
            $tbody.append(row);
        });

        updateSelectedCount();
    }

    // Modal Filters Event
    $('#modal-filter-jurusan, #modal-filter-angkatan, #modal-filter-periode').change(function() {
        loadStudentsForModal();
    });

    // Checkbox Events
    $(document).on('change', '.student-checkbox', function() {
        const id = parseInt($(this).val());
        if ($(this).is(':checked')) {
            if (!selectedStudents.includes(id)) selectedStudents.push(id);
        } else {
            selectedStudents = selectedStudents.filter(sId => sId !== id);
        }
        updateSelectedCount();
        
        // Update select all state
        const allChecked = $('.student-checkbox').length > 0 && $('.student-checkbox:not(:checked)').length === 0;
        $('#select-all-students').prop('checked', allChecked);
    });

    $('#select-all-students').change(function() {
        const isChecked = $(this).is(':checked');
        $('.student-checkbox').prop('checked', isChecked).trigger('change');
    });

    function updateSelectedCount() {
        $('#selected-count').text(selectedStudents.length);
    }

    // --- STEP 2: CLASS SELECTION/CREATION ---
    $('input[name="mode_kelas"]').change(function() {
        if ($(this).val() === 'existing') {
            $('#form-existing-class').removeClass('hidden');
            $('#form-new-class').addClass('hidden');
        } else {
            $('#form-existing-class').addClass('hidden');
            $('#form-new-class').removeClass('hidden');
        }
    });

    function loadKelasForModal() {
        const jurusan = $('#class-filter-jurusan').val();
        
        $.ajax({
            url: apiKelasList,
            method: 'GET',
            data: { jurusan: jurusan },
            success: function(data) {
                const $select = $('#select-kelas-existing');
                $select.empty();
                $select.append('<option value="">-- Pilih Kelas --</option>');
                
                data.forEach(kelas => {
                    $select.append(`<option value="${kelas.id_kelas}">${kelas.nama_kelas} (${kelas.kode_mk})</option>`);
                });
            },
            error: function(err) {
                console.error("Error fetching classes", err);
            }
        });
    }

    $('#class-filter-jurusan').change(loadKelasForModal);

    // --- SUBMIT ---
    $('#add-student-form').submit(function(e) {
        e.preventDefault();
        
        const mode = $('input[name="mode_kelas"]:checked').val();
        const formData = {
            student_ids: selectedStudents,
            mode_kelas: mode,
            _token: "{{ csrf_token() }}" // Laravel CSRF
        };

        if (mode === 'existing') {
            formData.id_kelas = $('#select-kelas-existing').val();
        } else {
            formData.kode_mk = $('#new-kode-mk').val();
            formData.nama_kelas = $('#new-nama-kelas').val();
            formData.jurusan = $('#new-jurusan').val();
            formData.tahun_ajaran = $('#new-tahun-ajaran').val();
            formData.nama_pa = $('#new-nama-pa').val();
        }

        // Simple validation
        if (mode === 'existing' && !formData.id_kelas) {
            alert('Silakan pilih kelas terlebih dahulu.');
            return;
        }

        $('#btn-submit').text('Menyimpan...').prop('disabled', true);

        $.ajax({
            url: apiAddStudents,
            method: 'POST',
            data: formData,
            success: function(response) {
                alert(response.message);
                $('#tambah-mahasiswa-modal').addClass('hidden');
                // Reload main table manually or reload page
                location.reload(); 
            },
            error: function(xhr) {
                const res = xhr.responseJSON;
                alert('Gagal menyimpan: ' + (res.message || 'Terjadi kesalahan'));
                $('#btn-submit').text('Simpan Perubahan').prop('disabled', false);
            }
        });
    });

    // --- PRINT FUNCTIONALITY (PDF) ---
    // User requested filter-based PDF print, not checkbox selection
    
    // Print Button Logic
    $('#print-btn').click(function() {
        const jurusan = $('#filter-jurusan').val();
        const angkatan = $('#filter-tahun').val();
        const periode = $('#filter-periode').val();
        const kelas = $('#filter-kelas').val();

        // Construct URL with query parameters
        let printUrl = "{{ route('admin.mahasiswa.print') }}";
        printUrl += `?jurusan=${encodeURIComponent(jurusan)}`;
        printUrl += `&angkatan=${encodeURIComponent(angkatan)}`;
        printUrl += `&periode=${encodeURIComponent(periode)}`;
        printUrl += `&kelas=${encodeURIComponent(kelas)}`;

        // Open in new tab (browser handles file download/view)
        window.open(printUrl, '_blank');
    });

    // =========================================================================
    // EDIT MAHASISWA FUNCTIONALITY
    // =========================================================================

    // Open Edit Modal
    $(document).on('click', '.btn-edit-student', function() {
        const studentId = $(this).data('id');
        const editUrl = "{{ route('admin.mahasiswa.edit', ':id') }}".replace(':id', studentId);

        $.ajax({
            url: editUrl,
            method: 'GET',
            success: function(data) {
                // Populate form fields
                $('#edit-student-id').val(data.id);
                $('#edit-nipd').val(data.nipd);
                $('#edit-nama').val(data.nama);
                $('#edit-jenis-kelamin').val(data.jenis_kelamin);
                $('#edit-tempat-lahir').val(data.tempat_lahir);
                $('#edit-tgl-lahir').val(data.tgl_lahir);
                $('#edit-jurusan').val(data.jurusan);
                $('#edit-email').val(data.email);
                $('#edit-no-tlp').val(data.no_tlp);
                $('#edit-agama').val(data.agama);
                $('#edit-angkatan').val(data.angkatan);
                $('#edit-periode').val(data.periode);
                $('#edit-status').val(data.status);
                $('#edit-alamat').val(data.alamat);

                // Open modal
                $('#edit-mahasiswa-modal').removeClass('hidden');
            },
            error: function(xhr) {
                alert('Gagal mengambil data mahasiswa');
                console.error(xhr);
            }
        });
    });

    // Close Edit Modal
    $('.close-edit-modal').click(function() {
        $('#edit-mahasiswa-modal').addClass('hidden');
    });

    // Submit Edit Form
    $('#edit-student-form').submit(function(e) {
        e.preventDefault();
        
        const studentId = $('#edit-student-id').val();
        const updateUrl = "{{ route('admin.mahasiswa.update', ':id') }}".replace(':id', studentId);
        const formData = $(this).serialize();

        $('#btn-update-student').text('Menyimpan...').prop('disabled', true);

        $.ajax({
            url: updateUrl,
            method: 'PUT',
            data: formData,
            success: function(response) {
                alert(response.message);
                $('#edit-mahasiswa-modal').addClass('hidden');
                renderMainTable(); // Refresh table
                $('#btn-update-student').text('Simpan Perubahan').prop('disabled', false);
            },
            error: function(xhr) {
                const res = xhr.responseJSON;
                alert('Gagal update: ' + (res.message || 'Terjadi kesalahan'));
                $('#btn-update-student').text('Simpan Perubahan').prop('disabled', false);
            }
        });
    });

    // =========================================================================
    // DELETE MAHASISWA FUNCTIONALITY
    // =========================================================================

    $(document).on('click', '.btn-delete-student', function() {
        const studentId = $(this).data('id');
        const studentRow = $(this).closest('tr');
        const studentName = studentRow.find('td:eq(1)').text(); // Nama ada di kolom kedua

        if (!confirm(`Apakah Anda yakin ingin menghapus mahasiswa "${studentName}"?\n\nData yang sudah dihapus tidak dapat dikembalikan!`)) {
            return;
        }

        const deleteUrl = "{{ route('admin.mahasiswa.destroy', ':id') }}".replace(':id', studentId);

        $.ajax({
            url: deleteUrl,
            method: 'DELETE',
            data: {
                _token: "{{ csrf_token() }}"
            },
            success: function(response) {
                alert(response.message);
                renderMainTable(); // Refresh table
            },
            error: function(xhr) {
                const res = xhr.responseJSON;
                alert('Gagal menghapus: ' + (res.message || 'Terjadi kesalahan'));
            }
        });
    });

});
</script>
@endpush