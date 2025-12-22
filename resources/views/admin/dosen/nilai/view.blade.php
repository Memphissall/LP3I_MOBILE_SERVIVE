@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto px-4">

    <div class="flex items-center justify-between mb-6">
        <h1 class="text-2xl font-bold text-gray-800">
            📊 Daftar Nilai Mahasiswa
        </h1>

        <a href="{{ route('nilai.index') }}"
           class="bg-gray-600 text-white px-4 py-2 rounded hover:bg-gray-700 transition">
            ⬅ Kembali
        </a>
    </div>

    <div class="overflow-x-auto bg-white shadow rounded-lg">
        <table class="min-w-full border border-gray-200">
            <thead class="bg-gray-100 text-gray-700">
                <tr>
                    <th class="px-4 py-3 border">No</th>
                    <th class="px-4 py-3 border text-left">Nama Mahasiswa</th>
                    <th class="px-4 py-3 border">Kehadiran</th>
                    <th class="px-4 py-3 border">Sikap</th>
                    <th class="px-4 py-3 border">Formatif</th>
                    <th class="px-4 py-3 border">Tugas</th>
                    <th class="px-4 py-3 border">UTS</th>
                    <th class="px-4 py-3 border">UAS</th>
                    <th class="px-4 py-3 border">Total</th>
                    <th class="px-4 py-3 border">Mutu</th>
                    <th class="px-4 py-3 border">Aksi</th>
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
                    <td class="px-4 py-2 border text-center">
                        {{ $n->nilai_akhir ?? '-' }}
                    </td>
                    <td class="px-4 py-2 border text-center">
                        {{ $n->mutu ?? '-' }}
                    </td>
                    <td class="px-4 py-2 border text-center">
                        <a href="{{ route('nilai.edit', $n->id_nilai) }}"
                           class="inline-block bg-blue-600 text-white text-sm px-3 py-1 rounded hover:bg-blue-700 transition">
                            ✏ Edit
                        </a>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="9" class="text-center py-6 text-gray-500">
                        Data nilai belum tersedia
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

</div>
@endsection
