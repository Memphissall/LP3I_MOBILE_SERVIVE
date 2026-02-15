@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto px-4">

    {{-- HEADER --}}
    <div class="flex items-start justify-between mb-6">
        <div>
            <h1 class="text-2xl font-bold text-gray-800 flex items-center gap-2">
                📊 List Score Mahasiswa
            </h1>

            <div class="mt-2 bg-blue-50 border border-blue-200 rounded-lg px-4 py-2">
                <p class="text-sm text-blue-800">
                    <strong>Mata Kuliah:</strong> {{ $matakuliah->nama_mk ?? '-' }} |
                    <strong>Kode:</strong> {{ $matakuliah->kode_mk ?? '-' }} |
                    <strong>Semester:</strong> {{ $semester }}
                </p>
            </div>
        </div>

        <a href="{{ route('nilai.index') }}"
           class="bg-gray-600 text-white px-4 py-2 rounded hover:bg-gray-700 transition h-fit">
            ⬅ Back
        </a>
    </div>

    {{-- TABLE --}}
    <div class="overflow-x-auto bg-white shadow rounded-xl">
        <table class="min-w-full text-sm">
            <thead class="bg-gray-100 text-gray-700 uppercase text-xs tracking-wider">
                <tr>
                    <th class="px-4 py-3 text-center w-12">No</th>
                    <th class="px-4 py-3 text-left w-32">NIPD</th>
                    <th class="px-4 py-3 text-left w-48">Student Name</th>
                    <th class="px-3 py-3 text-center w-24">Attend</th>
                    <th class="px-3 py-3 text-center w-24">Attitude</th>
                    <th class="px-3 py-3 text-center w-24">Formative</th>
                    <th class="px-3 py-3 text-center w-24">Assign</th>
                    <th class="px-3 py-3 text-center w-24">UTS</th>
                    <th class="px-3 py-3 text-center w-24">UAS</th>
                    <th class="px-3 py-3 text-center w-28">Final</th>
                    <th class="px-3 py-3 text-center w-20">Grade</th>
                    <th class="px-3 py-3 text-center w-20">Action</th>
                </tr>
            </thead>

            <tbody class="divide-y divide-gray-200 text-gray-700">
                @forelse ($nilai as $i => $n)
                <tr class="hover:bg-blue-50 transition">

                    <td class="px-4 py-3 text-center">
                        {{ $i + 1 }}
                    </td>

                    <td class="px-4 py-3 font-medium text-blue-600">
                        {{ $n->mahasiswa->nipd ?? '-' }}
                    </td>

                    <td class="px-4 py-3 font-semibold text-gray-800">
                        {{ $n->mahasiswa->nama_mhs ?? '-' }}
                    </td>

                    <td class="px-3 py-3 text-center">
                        {{ number_format($n->nilai_kehadiran, 0) ?? '-' }}
                    </td>

                    <td class="px-3 py-3 text-center">
                        {{ $n->nilai_sikap ?? '-' }}
                    </td>

                    <td class="px-3 py-3 text-center">
                        {{ $n->nilai_formative ?? '-' }}
                    </td>

                    <td class="px-3 py-3 text-center">
                        {{ $n->nilai_tugas ?? '-' }}
                    </td>

                    <td class="px-3 py-3 text-center">
                        {{ $n->nilai_uts ?? '-' }}
                    </td>

                    <td class="px-3 py-3 text-center">
                        {{ $n->nilai_uas ?? '-' }}
                    </td>

                    <td class="px-3 py-3 text-center font-bold text-indigo-600">
                        {{ number_format($n->nilai_akhir, 2) ?? '-' }}
                    </td>

                    <td class="px-3 py-3 text-center font-bold">
                        <span class="px-2 py-1 rounded bg-green-100 text-green-700 text-xs">
                            {{ $n->grade ?? '-' }}
                        </span>
                    </td>

                    <td class="px-3 py-3 text-center">
                        <a href="{{ route('nilai.edit', $n->id_nilai) }}"
                           class="bg-yellow-500 hover:bg-yellow-600 text-white px-3 py-1 rounded text-xs">
                            Edit
                        </a>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="12" class="text-center py-6 text-gray-500">
                        Data nilai belum tersedia
                    </td>
                </tr>
                @endforelse
            </tbody>

        </table>
    </div>

</div>
@endsection
