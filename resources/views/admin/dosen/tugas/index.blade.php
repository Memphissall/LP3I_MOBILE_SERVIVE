@extends('layouts.app')

@section('content')
<div class="p-6 max-w-4xl mx-auto">

    <h1 class="text-xl mb-4 font-bold">Daftar Tugas</h1>

    <p><strong>Kelas:</strong> {{ $kelas->nama_kelas }}</p>
    <p><strong>Mata Kuliah:</strong> {{ $matkul->nama_mk }}</p>

    {{-- Tombol Kembali --}}
    <a href="{{ route('tugas.pilih') }}"
       class="bg-gray-600 text-white px-4 py-2 rounded inline-block my-3">
       Kembali
    </a>

    {{-- Tombol Tambah --}}
    <a href="{{ route('tugas.tambah', [$id_kelas, $kode_mk]) }}"
       class="bg-blue-600 text-white px-4 py-2 rounded my-2 inline-block">
       Tambah Tugas
    </a>

    <table class="w-full border mt-4">
        <thead>
            <tr class="bg-gray-200">
                <th class="border px-2 py-1">#</th>
                <th class="border px-2 py-1">Judul</th>
                <th class="border px-2 py-1">Deadline</th>
                <th class="border px-2 py-1">Status</th>
                <th class="border px-2 py-1">Aksi</th>
            </tr>
        </thead>

        <tbody>
            @forelse($tugas as $index => $t)
            <tr>
                <td class="border px-2 py-1">{{ $index + 1 }}</td>
                <td class="border px-2 py-1">{{ $t->judul }}</td>
                <td class="border px-2 py-1">{{ $t->deadline }}</td>
                <td class="border px-2 py-1">{{ $t->status }}</td>

                <td class="border px-2 py-1">

                    {{-- BUTTON EDIT --}}
                    <a href="{{ route('tugas.edit', [$id_kelas, $kode_mk, $t->id]) }}"
                       class="px-3 py-1 bg-green-600 text-white rounded text-sm">
                       Edit
                    </a>

                    {{-- BUTTON DELETE --}}
                    <form action="{{ route('tugas.destroy', [$id_kelas, $kode_mk, $t->id]) }}"
                          method="POST"
                          class="inline ml-2"> {{-- Jarak tombol --}}
                        @csrf
                        @method('DELETE')
                        <button type="submit"
                                onclick="return confirm('Yakin ingin menghapus?')"
                                class="px-3 py-1 bg-red-600 text-white rounded text-sm">
                            Hapus
                        </button>
                    </form>

                </td>

            </tr>
            @empty
            <tr>
                <td colspan="5" class="border text-center py-3">Belum ada tugas.</td>
            </tr>
            @endforelse
        </tbody>
    </table>

</div>
@endsection
