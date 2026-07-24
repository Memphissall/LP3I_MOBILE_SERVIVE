@extends('layouts.app')

@section('content')
<div class="max-w-5xl mx-auto mt-6 sm:mt-10 px-4 sm:px-0">

    {{-- HEADER --}}
    <div class="bg-[#003B5C] text-white px-4 sm:px-8 py-4 sm:py-5 rounded-t-xl">
        <h2 class="text-lg sm:text-xl font-bold">
            Filter Data Nilai
        </h2>
    </div>

    {{-- CARD --}}
    <div class="bg-white shadow-md rounded-b-xl p-4 sm:p-8">

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

            {{-- SEMESTER --}}
            <div>
                <label class="block text-sm font-semibold mb-2">
                    Periode Akademik
                </label>
                <select id="semester"
                    class="w-full border rounded-md px-3 py-2">
                    <option value="">-- Pilih Periode Akademik --</option>
                    @for($s=1; $s<=8; $s++)
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
                    @foreach ($kelas as $k)
                        <option value="{{ $k->id_kelas }}">
                            {{ $k->nama_kelas }}
                        </option>
                    @endforeach
                </select>
            </div>

            {{-- MATA KULIAH --}}
            <div>
                <label class="block text-sm font-semibold mb-2">
                    Materi Ajar
                </label>
                <select id="matkul" disabled
                    class="w-full border rounded-md px-3 py-2 bg-gray-100">
                    <option value="">-- Pilih Materi Ajar --</option>
                </select>
            </div>

        </div>

        {{-- ACTION --}}
        <div class="mt-8 flex flex-wrap gap-3">
            <button id="btnInput" disabled
                class="px-5 py-2 rounded-md font-semibold text-white text-sm
                       bg-[#003B5C] opacity-50 cursor-not-allowed">
                Input Nilai
            </button>

            <button id="btnLihat" disabled
                class="px-5 py-2 rounded-md font-semibold text-white text-sm
                       bg-[#00A8B5] opacity-50 cursor-not-allowed">
                Lihat Nilai
            </button>
        </div>

    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
$(function () {

    function loadMatkul() {
        let semester = $('#semester').val();
        let id_kelas = $('#kelas').val();

        $('#matkul')
            .prop('disabled', true)
            .addClass('bg-gray-100')
            .html('<option value="">-- Pilih Materi Ajar --</option>');

        $('#btnInput, #btnLihat')
            .prop('disabled', true)
            .addClass('opacity-50 cursor-not-allowed');

        if (!semester || !id_kelas) return;

        $.get("{{ route('nilai.getMatkul') }}", { semester, id_kelas }, function(res) {

            $('#matkul')
                .prop('disabled', false)
                .removeClass('bg-gray-100');

            res.forEach(mk => {
                $('#matkul').append(`
                    <option value="${mk.id_mk}">
                        ${mk.nama_mk}
                    </option>
                `);
            });
        });
    }

    $('#semester, #kelas').change(loadMatkul);

    $('#matkul').change(function () {
        let aktif = $(this).val() !== '';
        $('#btnInput, #btnLihat')
            .prop('disabled', !aktif)
            .toggleClass('opacity-50 cursor-not-allowed', !aktif);
    });

    $('#btnInput').click(function () {
        location.href =
            "{{ url('nilai') }}/" +
            $('#kelas').val() + "/" +
            $('#matkul').val() + "/" +
            $('#semester').val() +
            "/input";
    });

    $('#btnLihat').click(function () {
        location.href =
            "{{ url('nilai') }}/" +
            $('#kelas').val() + "/" +
            $('#matkul').val() + "/" +
            $('#semester').val() +
            "/view";
    });

});
</script>
@endsection
