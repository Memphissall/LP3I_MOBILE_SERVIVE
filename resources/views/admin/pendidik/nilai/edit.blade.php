@extends('layouts.app')

@section('content')
<h1 class="text-2xl font-bold mb-4">Edit Nilai</h1>

<form method="POST" action="{{ route('nilai.update', $nilai->id_nilai) }}">
@csrf
@method('PUT')

<table class="w-full border">
<tr>
    <th class="border p-2">Nama Mahasiswa</th>
    <th class="border p-2">Kehadiran</th>
    <th class="border p-2">Sikap</th>
    <th class="border p-2">Formatif</th>
    <th class="border p-2">Tugas</th>
    <th class="border p-2">UTS</th>
    <th class="border p-2">UAS</th>
</tr>
<tr>
    <td class="border p-2">{{ $nilai->mahasiswa->nama_mhs ?? '-' }}</td>
    <td class="border p-2">
        <input type="number" name="nilai_kehadiran"
               value="{{ $nilai->nilai_kehadiran }}"
               class="w-full border p-1">
    </td>
    <td class="border p-2">
        <input type="number" name="nilai_sikap"
               value="{{ $nilai->nilai_sikap }}"
               class="w-full border p-1">
    </td>
    <td class="border p-2">
        <input type="number" name="nilai_formative"
               value="{{ $nilai->nilai_formative}}"
               class="w-full border p-1">
    </td>
    <td class="border p-2">
        <input type="number" name="nilai_tugas"
               value="{{ $nilai->nilai_tugas }}"
               class="w-full border p-1">
    </td>
    <td class="border p-2">
        <input type="number" name="nilai_uts"
               value="{{ $nilai->nilai_uts }}"
               class="w-full border p-1">
    </td>
    <td class="border p-2">
        <input type="number" name="nilai_uas"
               value="{{ $nilai->nilai_uas }}"
               class="w-full border p-1">
    </td>
</tr>
</table>

<div class="mt-4 flex gap-2">
    <button type="submit"
            class="bg-yellow-600 text-white px-4 py-2 rounded">
        Update Nilai
    </button>

   <a href="{{ route('nilai.view', [
    'id_program_studi' => $nilai->mahasiswa->kelas->id_program_studi,
    'id_mk' => $nilai->id_mk,
    'semester' => $nilai->semester
]) }}"
class="bg-gray-600 text-white px-4 py-2 rounded">
    Kembali
</a>

</div>

</form>
@endsection
