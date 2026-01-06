@extends('layouts.app')

@section('content')
<div class="max-w-3xl mx-auto mt-12">
    <div class="bg-white rounded-2xl shadow-md p-8">

        <h2 class="text-xl font-semibold mb-8">
            Filter Data Absensi & LKM
        </h2>

        <div class="space-y-5">

            {{-- SEMESTER --}}
            <div class="flex items-center gap-6">
                <label class="w-32 font-medium">Semester</label>
                <select id="semester" class="w-80 border rounded-lg px-4 py-2">
                    <option value="">-- Pilih Semester --</option>
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
                    @foreach ($kelas as $k)
                        <option value="{{ $k->id_kelas }}">
                            {{ $k->nama_kelas }}
                        </option>
                    @endforeach
                </select>
            </div>

            {{-- MATA KULIAH --}}
            <div class="flex items-center gap-6">
                <label class="w-32 font-medium">Materi Ajar</label>
                <select id="matkul" disabled class="w-80 border rounded-lg px-4 py-2">
                    <option value="">-- Pilih Materi Ajar --</option>
                </select>
            </div>
        </div>

        {{-- BUTTON --}}
        <div class="mt-10 flex justify-center gap-5">

            {{-- INPUT ABSENSI --}}
            <button
                type="button"
                id="btnInput"
                disabled
                class="px-7 py-2 rounded-lg font-semibold text-white
                       bg-blue-500 opacity-50 cursor-not-allowed">
                Input Absensi
            </button>

            {{-- VIEW LKM --}}
            <button
                type="button"
                id="btnLihat"
                disabled
                class="px-7 py-2 rounded-lg font-semibold text-white
                       bg-green-500 opacity-50 cursor-not-allowed">
                Lihat Riwayat LKM
            </button>
        </div>

    </div>
</div>

{{-- JQUERY --}}
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
$(document).ready(function () {

    function loadMatkul() {
        let semester = $('#semester').val();
        let id_kelas = $('#kelas').val();

        $('#matkul')
            .prop('disabled', true)
            .html('<option value="">-- Pilih Mata Kuliah --</option>');

        $('#btnInput, #btnLihat')
            .prop('disabled', true)
            .addClass('opacity-50 cursor-not-allowed');

        if (!semester || !id_kelas) return;

        $.get("{{ route('absensi.getMatkul') }}",
            { semester: semester, id_kelas: id_kelas },
            function (res) {
                $('#matkul').prop('disabled', false);
                res.forEach(mk => {
                    $('#matkul').append(`
                        <option value="${mk.kode_mk}">
                            ${mk.kode_mk} - ${mk.nama_mk}
                        </option>
                    `);
                });
            }
        );
    }

    $('#semester, #kelas').on('change', loadMatkul);

    $('#matkul').on('change', function () {
        let aktif = $(this).val() !== '';
        $('#btnInput, #btnLihat')
            .prop('disabled', !aktif)
            .toggleClass('opacity-50 cursor-not-allowed', !aktif);
    });

    // INPUT ABSENSI
    $('#btnInput').on('click', function () {
        window.location.href =
            `/dosen/absensi/create/${$('#kelas').val()}/${$('#matkul').val()}/${$('#semester').val()}`;
    });

    // VIEW LIST LKM (SESUI TUJUAN KAMU)
    $('#btnLihat').on('click', function () {
        window.location.href =
            `/dosen/absensi/list/${$('#kelas').val()}/${$('#matkul').val()}`;
    });

});
</script>
@endsection
