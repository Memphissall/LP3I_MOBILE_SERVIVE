@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto px-4">

    {{-- HEADER --}}
    <div class="flex items-start justify-between mb-6">
        <div>
            <h1 class="text-2xl font-bold text-gray-800 flex items-center gap-2">
                📊 List Score Mahasiswa
            </h1>

            {{-- INFO MATAKULIAH --}}
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
    <div class="overflow-x-auto bg-white shadow rounded-lg">
        <table class="min-w-full border border-gray-200">
            <thead class="bg-gray-100 text-gray-700">
                <tr>
                    <th class="px-4 py-3 border">No</th>
                    <th class="px-4 py-3 border text-left">Student Name</th>
                    <th class="px-4 py-3 border">Attendance</th>
                    <th class="px-4 py-3 border">Attitude</th>
                    <th class="px-4 py-3 border">Formative</th>
                    <th class="px-4 py-3 border">Assignment</th>
                    <th class="px-4 py-3 border">Mid Exam</th>
                    <th class="px-4 py-3 border">Final Exam</th>
                    <th class="px-4 py-3 border">Total Score</th>
                    <th class="px-4 py-3 border">Grade</th>
                    <th class="px-4 py-3 border">Action</th>
                </tr>
            </thead>

            <tbody class="text-gray-700">
                @forelse ($nilai as $i => $n)
                <tr class="hover:bg-gray-50 transition">
                    <td class="px-4 py-2 border text-center">
                        {{ $i + 1 }}
                    </td>
                    <td class="px-4 py-2 border font-medium">
                        {{ $n->nama_mhs }}
                    </td>
                    <td class="px-4 py-2 border text-center">
                        {{ $n->nilai_kehadiran ?? '-' }}
                    </td>
                    <td class="px-4 py-2 border text-center">
                        {{ $n->nilai_sikap ?? '-' }}
                    </td>
                    <td class="px-4 py-2 border text-center">
                        {{ $n->nilai_formatif ?? '-' }}
                    </td>
                    <td class="px-4 py-2 border text-center">
                        {{ $n->nilai_tugas ?? '-' }}
                    </td>
                    <td class="px-4 py-2 border text-center">
                        {{ $n->nilai_uts ?? '-' }}
                    </td>
                    <td class="px-4 py-2 border text-center">
                        {{ $n->nilai_uas ?? '-' }}
                    </td>
                    <td class="px-4 py-2 border text-center font-semibold">
                        {{ $n->nilai_akhir ?? '-' }}
                    </td>
                    <td class="px-4 py-2 border text-center font-semibold">
                        {{ $n->mutu ?? '-' }}
                    </td>
                    <td class="px-4 py-2 border text-center">
                        <a href="{{ route('nilai.edit', $n->id_nilai) }}"
                           class="bg-yellow-500 hover:bg-yellow-600 text-white px-3 py-1 rounded text-sm">
                            <i class="fa-solid fa-pen"></i>
                        </a>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="11" class="text-center py-6 text-gray-500">
                        Data nilai belum tersedia
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

</div>
@endsection
