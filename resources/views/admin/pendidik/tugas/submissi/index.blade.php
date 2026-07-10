@extends('layouts.app')

@section('content')

<div class="max-w-7xl mx-auto px-6 py-8">

    {{-- Header --}}
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-2xl font-bold text-gray-800">
            Daftar Submission - {{ $tugas->judul_tugas }}
        </h2>

        <a href="{{ route('tugas.index', ['id_kelas' => $id_kelas, 'id_mk' => $id_mk]) }}"
           class="bg-gray-600 text-white px-4 py-2 rounded-lg hover:bg-gray-700 transition">
            ← Kembali
        </a>
    </div>

    {{-- Alert Success --}}
    @if(session('success'))
        <div class="bg-green-100 border border-green-300 text-green-800 px-4 py-3 rounded mb-5">
            {{ session('success') }}
        </div>
    @endif

    {{-- Table --}}
    <div class="bg-white shadow rounded-lg overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-sm text-gray-700">
                <thead class="bg-gray-100 text-gray-700 uppercase text-xs tracking-wider">
                    <tr>
                        <th class="px-4 py-3 text-center">No</th>
                        <th class="px-4 py-3">Mahasiswa</th>
                        <th class="px-4 py-3 text-center">File</th>
                        <th class="px-4 py-3 text-center">Nilai</th>
                        <th class="px-4 py-3">Catatan</th>
                        <th class="px-4 py-3 text-center">Status</th>
                        <th class="px-4 py-3 text-center">Aksi</th>
                    </tr>
                </thead>

                <tbody class="divide-y">

                @forelse($submissions as $index => $s)
                    <tr class="hover:bg-gray-50">

                        <form action="{{ route('submission.beriNilai', $s->id_submission) }}" method="POST">
                            @csrf

                            {{-- No --}}
                            <td class="px-4 py-3 text-center">
                                {{ $index + 1 }}
                            </td>

                            {{-- Nama --}}
                            <td class="px-4 py-3 font-medium text-gray-800">
                                {{ $s->mahasiswa->nama_mhs }}
                            </td>

                            {{-- File --}}
                            <td class="px-4 py-3 text-center">
                                @if($s->file_tugas)
                                    <a href="{{ asset('storage/jawaban/'.$s->file_tugas) }}"
                                       target="_blank"
                                       class="text-blue-600 hover:underline font-medium">
                                        Download
                                    </a>
                                @else
                                    <span class="text-gray-400 italic">
                                        Tidak ada file
                                    </span>
                                @endif
                            </td>

                            {{-- Nilai --}}
                            <td class="px-4 py-3 text-center">
                                <input type="number"
                                       name="nilai"
                                       value="{{ $s->nilai }}"
                                       min="0"
                                       max="100"
                                       class="border rounded-md px-2 py-1 w-20 text-center focus:outline-none focus:ring-2 focus:ring-blue-400"
                                       {{ !$s->file_tugas ? 'disabled' : '' }}
                                       required>
                            </td>

                            {{-- Catatan --}}
                            <td class="px-4 py-3">
                                <input type="text"
                                       name="catatan"
                                       value="{{ $s->catatan }}"
                                       placeholder="Tambahkan catatan..."
                                       class="border rounded-md px-3 py-1 w-full focus:outline-none focus:ring-2 focus:ring-blue-400"
                                       {{ !$s->file_tugas ? 'disabled' : '' }}>
                            </td>

                            {{-- Status --}}
                            <td class="px-4 py-3 text-center">
                                @if($s->status == 'Terlambat')
                                    <span class="px-3 py-1 text-xs font-semibold rounded-full bg-red-100 text-red-700">
                                        Terlambat
                                    </span>

                                @elseif($s->status == 'Sudah Dinilai')
                                    <span class="px-3 py-1 text-xs font-semibold rounded-full bg-green-100 text-green-700">
                                        Sudah Dinilai
                                    </span>

                                @elseif($s->status == 'Dikumpulkan')
                                    <span class="px-3 py-1 text-xs font-semibold rounded-full bg-blue-100 text-blue-700">
                                        Dikumpulkan
                                    </span>

                                @else
                                    <span class="px-3 py-1 text-xs font-semibold rounded-full bg-yellow-100 text-yellow-700">
                                        Belum Mengumpulkan
                                    </span>
                                @endif
                            </td>

                            {{-- Aksi --}}
                            <td class="px-4 py-3 text-center">
                                @if($s->file_tugas)
                                    <button type="submit"
                                        class="bg-green-600 text-white px-3 py-1 rounded-md hover:bg-green-700 transition">
                                        Simpan
                                    </button>
                                @else
                                    <span class="text-gray-400 text-sm">
                                        -
                                    </span>
                                @endif
                            </td>

                        </form>

                    </tr>

                @empty

                    <tr>
                        <td colspan="7" class="px-4 py-6 text-center text-gray-500">
                            Belum ada submission mahasiswa.
                        </td>
                    </tr>

                @endforelse

                </tbody>
            </table>
        </div>
    </div>

</div>

@endsection