@extends('layouts.app')

@section('content')
<div class="max-w-5xl mx-auto mt-10">

    {{-- HEADER --}}
    <div class="bg-[#003B5C] text-white px-8 py-5 rounded-t-xl">
        <h2 class="text-xl font-bold">
            Pilih SAP Mata Kuliah
        </h2>
    </div>

    {{-- CARD --}}
    <div class="bg-white shadow-md rounded-b-xl p-8">

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

            {{-- SEMESTER --}}
            <div>
                <label class="block text-sm font-semibold mb-2">
                    Periode Akademik
                </label>
                <select id="semester"
                        class="w-full border rounded-md px-3 py-2">
                    <option value="">-- Pilih Periode Akademik --</option>

                    @for($s = 1; $s <= 8; $s++)
                        @php
                            $periode = $s % 2 == 1 ? 'Ganjil' : 'Genap';
                            $tahun = now()->year;
                            $ta = $periode == 'Ganjil'
                                ? "$tahun/".($tahun+1)
                                : ($tahun-1)."/$tahun";
                        @endphp

                        <option value="{{ $s }}">
                            Semester {{ $s }} – {{ $periode }} {{ $ta }}
                        </option>
                    @endfor
                </select>
            </div>

            {{-- KELAS --}}
            <div>
                <label class="block text-sm font-semibold mb-2">
                    Kelas
                </label>
                <select id="kelas"
                        class="w-full border rounded-md px-3 py-2">
                    <option value="">-- Pilih Kelas --</option>

                    @foreach($kelas as $k)
                        <option value="{{ $k->id_kelas }}">
                            {{ $k->nama_kelas }}
                        </option>
                    @endforeach
                </select>
            </div>

            {{-- MATA KULIAH --}}
            <div>
                <label class="block text-sm font-semibold mb-2">
                    Mata Kuliah
                </label>
                <select id="matkul"
                        disabled
                        class="w-full border rounded-md px-3 py-2 bg-gray-100">
                    <option value="">-- Pilih Mata Kuliah --</option>
                </select>
            </div>

        </div>

        {{-- ACTION --}}
        <div class="mt-8">
            <button id="btnKelola"
                disabled
                class="px-6 py-2 rounded-md font-semibold text-white
                       bg-[#003B5C] opacity-50 cursor-not-allowed">
                Lihat SAP
            </button>
        </div>

    </div>
</div>

{{-- SCRIPT --}}
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
$(function () {

    function resetMatkul() {
        $('#matkul')
            .prop('disabled', true)
            .addClass('bg-gray-100')
            .html('<option value="">-- Pilih Mata Kuliah --</option>');

        $('#btnKelola')
            .prop('disabled', true)
            .addClass('opacity-50 cursor-not-allowed');
    }

    function loadMatkul() {

        let semester = $('#semester').val();
        let id_kelas = $('#kelas').val();

        resetMatkul();

        if (!semester || !id_kelas) return;

        $.get("{{ route('sap.getMatkulBySemester') }}", {
            semester: semester,
            id_kelas: id_kelas
        }, function (res) {

            if (res.length === 0) {
                $('#matkul').html('<option value="">SAP tidak tersedia</option>');
                return;
            }

            $('#matkul')
                .prop('disabled', false)
                .removeClass('bg-gray-100');

            res.forEach(function (mk) {
                $('#matkul').append(`
                    <option value="${mk.id_mk}">
                        ${mk.kode_mk} - ${mk.nama_mk}
                    </option>
                `);
            });
        });
    }

    $('#semester, #kelas').change(loadMatkul);

    $('#matkul').change(function () {
        let aktif = $(this).val() !== '';

        $('#btnKelola')
            .prop('disabled', !aktif)
            .toggleClass('opacity-50 cursor-not-allowed', !aktif);
    });

    $('#btnKelola').click(function () {

        let id_kelas = $('#kelas').val();
        let id_mk = $('#matkul').val();

        window.location.href =
            "{{ url('pendidik/sap') }}/" +
            id_kelas + "/" + id_mk;
    });

});
</script>

@endsection
