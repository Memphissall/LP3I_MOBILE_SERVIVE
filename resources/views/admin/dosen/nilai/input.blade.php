@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto px-4 py-6">

<form action="{{ route('nilai.store') }}" method="POST">
@csrf

<input type="hidden" name="id_kelas" value="{{ $id_kelas }}">
<input type="hidden" name="kode_mk" value="{{ $kode_mk }}">
<input type="hidden" name="semester" value="{{ $semester }}">

<div class="bg-white rounded-xl shadow-lg overflow-hidden">

    {{-- HEADER --}}
    <div class="bg-blue-600 text-white px-6 py-4">
        <h2 class="text-lg font-semibold flex items-center gap-2">
            📝 Input Score Mahasiswa
        </h2>
        <p class="text-sm text-blue-100">
            Default kehadiran 100, Alpha -5
        </p>
    </div>

    {{-- TABLE --}}
    <div class="overflow-x-auto">
        <table class="min-w-full text-sm text-center border-separate border-spacing-y-2 px-4 py-3">
            <thead>
                <tr class="text-gray-600">
                    <th class="text-left px-3 py-2">Nama Mahasiswa</th>
                    <th>Kehadiran</th>
                    <th>Sikap</th>
                    <th>Formatif</th>
                    <th>Tugas</th>
                    <th>UTS</th>
                    <th>UAS</th>
                </tr>
            </thead>

            <tbody>
            @foreach($mahasiswa as $mhs)
                <tr class="bg-gray-50 hover:bg-blue-50 transition rounded-lg">

                    {{-- NAMA --}}
                    <td class="text-left px-3 py-2 font-medium text-gray-700 whitespace-nowrap">
                        {{ $mhs->nama_mhs }}
                        <input type="hidden" name="nipd[]" value="{{ $mhs->nipd }}">
                        <input type="hidden" name="nama_mhs[]" value="{{ $mhs->nama_mhs }}">

                    </td>

                    {{-- KEHADIRAN --}}
                    <td>
                        <input type="number"
                        name="nilai_kehadiran[]"
                        value="{{ $nilaiKehadiran[$mhs->nipd] }}"
                        readonly
                        class="w-28 mx-auto text-center rounded-md border-gray-300 bg-gray-100 focus:ring-0">

                    </td>

                    {{-- INPUT NILAI --}}
                    @foreach(['nilai_sikap','nilai_formatif','nilai_tugas','nilai_uts','nilai_uas'] as $field)
                    <td>
                        <input type="number"
                            name="{{ $field }}[]"
                            min="0" max="100" required
                            class="w-20 mx-auto text-center rounded-md border-gray-300 focus:border-blue-500 focus:ring-blue-500">
                    </td>
                    @endforeach

                </tr>
            @endforeach
            </tbody>
        </table>
    </div>

    {{-- FOOTER --}}
    <div class="flex justify-between items-center px-6 py-4 bg-gray-50">
        <a href="{{ route('nilai.index') }}"
           class="px-4 py-2 rounded-lg bg-gray-200 hover:bg-gray-300 text-gray-700 text-sm">
            ← Back
        </a>

        <button type="submit"
            class="px-5 py-2 rounded-lg bg-blue-600 hover:bg-blue-700 text-white text-sm font-semibold">
            💾 Submit
        </button>
    </div>

</div>
</form>
</div>
@endsection
