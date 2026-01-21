@extends('layouts.app')

@section('content')
<div class="max-w-3xl mx-auto mt-12">
    <div class="bg-white rounded-2xl shadow-md p-8">

        <h2 class="text-xl font-semibold mb-8">
            Pilih Materi Ajar
        </h2>

        <div class="space-y-5">

            {{-- SEMESTER --}}
            <div class="flex items-center gap-6">
                <label class="w-32 font-medium">Periode Akademik</label>
                <select id="semester" class="w-80 border rounded-lg px-4 py-2">
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
            <div class="flex items-center gap-6">
                <label class="w-32 font-medium">Kelas</label>
                <select id="kelas" class="w-80 border rounded-lg px-4 py-2">
                    <option value="">-- Pilih Kelas --</option>
                    @foreach($kelas as $k)
                        <option value="{{ $k->id_kelas }}">
                            {{ $k->nama_kelas }}
                        </option>
                    @endforeach
                </select>
            </div>

            {{-- MATERI AJAR --}}
            <div class="flex items-center gap-6">
                <label class="w-32 font-medium">Materi Ajar</label>
                <select id="materi" disabled
                        class="w-80 border rounded-lg px-4 py-2">
                    <option value="">-- Pilih Materi Ajar --</option>
                </select>
            </div>

        </div>

        {{-- BUTTON --}}
        <div class="mt-10 flex justify-center gap-6">
            <button id="btnKelola" disabled
                class="px-6 py-2 rounded-lg font-semibold text-white
                       bg-blue-500 opacity-50 cursor-not-allowed">
                Kelola Materi
            </button>

            <button id="btnLihat" disabled
                class="px-6 py-2 rounded-lg font-semibold text-white
                       bg-green-600 opacity-50 cursor-not-allowed">
                Lihat Materi
            </button>
        </div>

    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
$(function () {

    function loadMateri() {
        let semester = $('#semester').val();
        let id_kelas = $('#kelas').val();

        $('#materi')
            .prop('disabled', true)
            .html('<option value="">-- Pilih Materi Ajar --</option>');

        $('#btnKelola, #btnLihat')
            .prop('disabled', true)
            .addClass('opacity-50 cursor-not-allowed');

        if (!semester || !id_kelas) return;

        $.get("{{ route('materi.getBySemester') }}", {
            semester: semester,
            id_kelas: id_kelas
        }, function (res) {

            $('#materi').prop('disabled', false);

            res.forEach(m => {
                $('#materi').append(`
                    <option value="${m.id_materi}">
                        ${m.judul_materi}
                    </option>
                `);
            });
        });
    }

    $('#semester, #kelas').change(loadMateri);

    $('#materi').change(function () {
        let aktif = $(this).val() !== '';
        $('#btnKelola, #btnLihat')
            .prop('disabled', !aktif)
            .toggleClass('opacity-50 cursor-not-allowed', !aktif);
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
