@extends('layouts.app')

@section('content')
<h1 class="text-2xl font-bold mb-4">Input Nilai</h1>

<form method="POST" action="{{ route('nilai.filter') }}" id="form-nilai">
    @csrf

    {{-- PILIH KELAS --}}
    <div class="mb-4">
        <label class="block mb-1 font-semibold">Kelas</label>
        <select name="id_kelas" id="kelas"
                class="border p-2 rounded w-full" required>
            <option value="">-- Pilih Kelas --</option>
            @foreach($kelas as $k)
                <option value="{{ $k->id_kelas }}">
                    {{ $k->nama_kelas }}
                </option>
            @endforeach
        </select>
    </div>

    {{-- PILIH MATA KULIAH --}}
    <div class="mb-4">
        <label class="block mb-1 font-semibold">Mata Kuliah</label>
        <select name="kode_mk" id="matakuliah"
                class="border p-2 rounded w-full" required>
            <option value="">-- Pilih Mata Kuliah --</option>
        </select>
    </div>

    {{-- BUTTON --}}
    <div class="flex gap-2">
        <button type="submit"
                class="bg-blue-600 text-white px-4 py-2 rounded">
            Lanjut
        </button>

        <button type="button" id="btn-lihat"
                class="bg-red-600 text-white px-4 py-2 rounded">
            Lihat
        </button>
    </div>
</form>

{{-- HASIL AJAX --}}
<div id="hasil-nilai" class="mt-6"></div>

{{-- SCRIPT --}}
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
$(document).ready(function() {

    // LOAD MATAKULIAH
    $('#kelas').change(function() {
        let id_kelas = $(this).val();
        let mkSelect = $('#matakuliah');

        mkSelect.html('<option>Loading...</option>');

        if (id_kelas) {
            $.get('/get-matkul/' + id_kelas, function(data) {
                let options = '<option value="">-- Pilih Mata Kuliah --</option>';
                $.each(data, function(i, mk) {
                    options += `<option value="${mk.kode_mk}">
                                    ${mk.nama_mk}
                                </option>`;
                });
                mkSelect.html(options);
            });
        } else {
            mkSelect.html('<option value="">-- Pilih Mata Kuliah --</option>');
        }
    });

    // BUTTON LIHAT (AJAX)
    $('#btn-lihat').click(function () {
        let id_kelas = $('#kelas').val();
        let kode_mk  = $('#matakuliah').val();

        if (!id_kelas || !kode_mk) {
            alert('Pilih kelas dan mata kuliah dulu!');
            return;
        }

        $('#hasil-nilai').html('<p class="text-gray-500">Loading data...</p>');

        $.get("{{ route('nilai.ajax.view') }}", {
            id_kelas: id_kelas,
            kode_mk: kode_mk
        }, function (data) {
            $('#hasil-nilai').html(data);
        });
    });

});
</script>
@endsection
