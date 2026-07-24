@extends('layouts.app')

@section('content')
<div class="px-4 sm:px-8 py-6 sm:py-10">

    <div class="bg-white rounded-2xl shadow-lg overflow-hidden">

        {{-- HEADER --}}
        <div class="bg-[#083c5a] px-4 sm:px-8 py-4 sm:py-5">
            <h2 class="text-lg sm:text-xl text-white font-semibold">
                Filter Materi Ajar
            </h2>
        </div>

        {{-- BODY --}}
        <div class="px-4 sm:px-8 py-6 sm:py-8">

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">

                {{-- PERIODE AKADEMIK --}}
                <div>
                    <label class="block font-semibold mb-2">
                        Periode Akademik
                    </label>
                    <select id="semester"
                        class="w-full border rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-400">
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
                    <label class="block font-semibold mb-2">
                        Kelas
                    </label>
                    <select id="kelas"
                        class="w-full border rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-400">
                        <option value="">-- Pilih Kelas --</option>
                        @foreach($kelas as $k)
                            <option value="{{ $k->id_kelas }}">
                                {{ $k->nama_kelas }}
                            </option>
                        @endforeach
                    </select>
                </div>

                {{-- MATERI AJAR --}}
                <div>
                    <label class="block font-semibold mb-2">
                        Materi Ajar
                    </label>
                    <select id="materi" disabled
                        class="w-full border rounded-lg px-4 py-2 bg-gray-100
                               focus:outline-none focus:ring-2 focus:ring-blue-400">
                        <option value="">-- Pilih Materi Ajar --</option>
                    </select>
                </div>

            </div>

            {{-- BUTTON --}}
            <div class="mt-10 flex flex-wrap gap-3">
                <button id="btnKelola" disabled
                    class="px-5 py-2 rounded-lg font-semibold text-white text-sm
                           bg-gray-400 cursor-not-allowed text-center">
                    Kelola Materi
                </button>
            </div>

        </div>
    </div>
</div>

{{-- SCRIPT --}}
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
$(function () {

    function loadMateri() {
        let semester = $('#semester').val();
        let id_kelas = $('#kelas').val();

        $('#materi')
            .prop('disabled', true)
            .addClass('bg-gray-100')
            .html('<option value="">-- Pilih Materi Ajar --</option>');

        $('#btnKelola, #btnLihat')
            .prop('disabled', true)
            .removeClass('bg-blue-500 bg-teal-500')
            .addClass('bg-gray-400 cursor-not-allowed');

        if (!semester || !id_kelas) return;

        $.get("{{ route('materi.getMatkulBySemester') }}", {
            semester: semester,
            id_kelas: id_kelas
        }, function (res) {

            $('#materi')
                .prop('disabled', false)
                .removeClass('bg-gray-100');

            res.forEach(m => {
                $('#materi').append(`
                    <option value="${m.id_mk}">
                        ${m.nama_mk}
                    </option>
                `);
            });
        });
    }

    $('#semester, #kelas').change(loadMateri);

    $('#materi').change(function () {
        let aktif = $(this).val() !== '';

        $('#btnKelola')
            .prop('disabled', !aktif)
            .toggleClass('bg-gray-400 cursor-not-allowed', !aktif)
            .toggleClass('bg-blue-500', aktif);

        $('#btnLihat')
            .prop('disabled', !aktif)
            .toggleClass('bg-gray-400 cursor-not-allowed', !aktif)
            .toggleClass('bg-teal-500', aktif);
    });

    $('#btnKelola').click(function () {
        window.location.href =
            "{{ url('materi') }}/" +
            $('#kelas').val() + "/" +
            $('#materi').val();
    });

    $('#btnLihat').click(function () {
        window.location.href =
            "{{ url('materi-view') }}/" +
            $('#kelas').val() + "/" +
            $('#materi').val();
    });

});
</script>
@endsection
