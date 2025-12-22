@extends('layouts.app')

@section('content')
<div class="max-w-5xl mx-auto p-6">

    <h1 class="text-2xl font-bold mb-2">
        Daftar Tugas
    </h1>

    <p class="mb-1"><b>Kelas:</b> {{ $kelas->nama_kelas }}</p>
    <p class="mb-4"><b>Mata Kuliah:</b> {{ $matkul->nama_mk }}</p>

    <div class="bg-white shadow rounded-lg overflow-hidden">
        <table class="w-full border-collapse">
            <thead class="bg-gray-100">
                <tr>
                    <th class="border p-2">#</th>
                    <th class="border p-2">Judul</th>
                    <th class="border p-2">Deskripsi</th>
                    <th class="border p-2">Deadline</th>
                    <th class="border p-2">Status</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($tugas as $i => $t)
                <tr>
                    <td class="border p-2 text-center">{{ $i + 1 }}</td>
                    <td class="border p-2">{{ $t->judul }}</td>
                    <td class="border p-2">{{ $t->deskripsi ?? '-' }}</td>
                    <td class="border p-2 text-center">
                        {{ \Carbon\Carbon::parse($t->deadline)->format('d-m-Y') }}
                    </td>
                    <td class="px-4 py-2">
                            <span class="px-3 py-1 rounded-full text-white text-sm font-semibold
                         {{ $t->isAktif() ? 'bg-green-600' : 'bg-red-600' }}">
                                 {{ $t->isAktif() ? 'aktif' : 'nonaktif' }}
                             </span>
                            </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="text-center p-4 text-gray-500">
                        Belum ada tugas
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <a href="{{ route('tugas.pilih') }}"
       class="inline-block mt-4 bg-gray-600 text-white px-4 py-2 rounded">
        Kembali
    </a>

</div>
@endsection
