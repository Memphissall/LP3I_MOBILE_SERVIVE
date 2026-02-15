@extends('layouts.app')

@section('content')
<div class="max-w-5xl mx-auto px-4 py-6">

    <div class="bg-white shadow rounded-xl p-6">

        <h1 class="text-2xl font-bold text-gray-800 mb-6 flex items-center gap-2">
            ✏ Edit Nilai Mahasiswa
        </h1>

        <form method="POST" action="{{ route('nilai.update', $nilai->id_nilai) }}">
        @csrf
        @method('PUT')

        <div class="overflow-x-auto">
            <table class="min-w-full text-sm">
                <thead class="bg-gray-100 text-gray-700 uppercase text-xs tracking-wider">
                    <tr>
                        <th class="px-4 py-3 text-left w-32">NIPD</th>
                        <th class="px-4 py-3 text-left w-48">Nama Mahasiswa</th>
                        <th class="px-3 py-3 text-center w-24">Attend</th>
                        <th class="px-3 py-3 text-center w-24">Attitude</th>
                        <th class="px-3 py-3 text-center w-24">Formative</th>
                        <th class="px-3 py-3 text-center w-24">Assign</th>
                        <th class="px-3 py-3 text-center w-24">UTS</th>
                        <th class="px-3 py-3 text-center w-24">UAS</th>
                    </tr>
                </thead>

                <tbody class="divide-y divide-gray-200 text-gray-700">
                    <tr class="hover:bg-blue-50 transition">

                        <td class="px-4 py-3 font-medium text-blue-600">
                            {{ $nilai->mahasiswa->nipd ?? '-' }}
                        </td>

                        <td class="px-4 py-3 font-semibold text-gray-800">
                            {{ $nilai->mahasiswa->nama_mhs ?? '-' }}
                        </td>

                        <td class="px-3 py-3">
                            <input type="number" name="nilai_kehadiran"
                                value="{{ $nilai->nilai_kehadiran }}"
                                min="0" max="100"
                                class="w-24 text-center border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-400 focus:border-blue-400">
                        </td>

                        <td class="px-3 py-3">
                            <input type="number" name="nilai_sikap"
                                value="{{ $nilai->nilai_sikap }}"
                                min="0" max="100"
                                class="w-24 text-center border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-400 focus:border-blue-400">
                        </td>

                        <td class="px-3 py-3">
                            <input type="number" name="nilai_formative"
                                value="{{ $nilai->nilai_formative}}"
                                min="0" max="100"
                                class="w-24 text-center border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-400 focus:border-blue-400">
                        </td>

                        <td class="px-3 py-3">
                            <input type="number" name="nilai_tugas"
                                value="{{ $nilai->nilai_tugas }}"
                                min="0" max="100"
                                class="w-24 text-center border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-400 focus:border-blue-400">
                        </td>

                        <td class="px-3 py-3">
                            <input type="number" name="nilai_uts"
                                value="{{ $nilai->nilai_uts }}"
                                min="0" max="100"
                                class="w-24 text-center border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-400 focus:border-blue-400">
                        </td>

                        <td class="px-3 py-3">
                            <input type="number" name="nilai_uas"
                                value="{{ $nilai->nilai_uas }}"
                                min="0" max="100"
                                class="w-24 text-center border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-400 focus:border-blue-400">
                        </td>

                    </tr>
                </tbody>
            </table>
        </div>

        {{-- BUTTON --}}
        <div class="mt-6 flex gap-3">
            <button type="submit"
                class="bg-yellow-500 hover:bg-yellow-600 text-white px-6 py-2 rounded-lg shadow text-sm font-semibold">
                💾 Update Nilai
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

    </div>

</div>
@endsection
