@extends('layouts.app')

@section('content')
<div class="max-w-6xl mx-auto mt-10">
    <div class="flex flex-col gap-3 mb-6">
        <h2 class="text-xl sm:text-2xl font-bold text-gray-800">
            Materi {{ $matkul->nama_mk }} - {{ $kelas->nama_kelas }}
        </h2>

        <div class="flex justify-between items-center gap-2 w-full">
            <a href="{{ route('materi.pilih') }}"
               class="bg-gray-500 hover:bg-gray-600 text-white px-3 py-1.5 rounded-lg text-xs font-bold transition shadow-sm text-center">
                ← KEMBALI
            </a>

            <a href="{{ route('materi.tambah', [$id_kelas, $id_mk]) }}"
               class="bg-blue-600 hover:bg-blue-700 text-white px-3 py-1.5 rounded-lg text-xs font-bold transition shadow-sm text-center">
                <i class="fa-solid fa-plus"></i> Upload Materi
            </a>
        </div>
    </div>

    <div class="overflow-x-auto bg-white rounded-lg border border-gray-200 shadow-sm">
        <table class="w-full min-w-[600px]">
            <thead class="bg-gray-100">
                <tr>
                    <th class="p-2 text-center w-12">No</th>
                    <th class="p-2 text-left">Judul</th>
                    <th class="p-2 text-center">Pertemuan</th>
                    <th class="p-2 text-left">Pendidik</th>
                    <th class="p-2 text-center">File</th>
                    <th class="p-2 text-center">Aksi</th>
                </tr>
            </thead>

            <tbody>
            @forelse($materi as $m)
                <tr class="border-t hover:bg-gray-50">

                    {{-- NO --}}
                    <td class="p-2 text-center font-semibold">
                        {{ $loop->iteration }}
                    </td>

                    <td class="p-2">{{ $m->judul_materi }}</td>

                    <td class="p-2 text-center">
                        Pertemuan {{ $m->pertemuan }}
                    </td>

                    <td class="p-2">{{ $m->pendidik->nama_pendidik }}</td>

                    <td class="p-2 text-center">
        @if($m->tipe_materi === 'file')
            <a href="{{ asset('storage/'.$m->file_materi) }}"
               target="_blank"
               class="text-blue-600 hover:underline">
                ⬇️ Download
            </a>
        @else
            <a href="{{ $m->link_materi }}"
               target="_blank"
               class="text-green-600 hover:underline">
                🔗 Buka Link
            </a>
        @endif
    </td>

                    <td class="p-2 text-center">
                        <div class="flex justify-center gap-2">

                            {{-- EDIT --}}
                            <a href="{{ route('materi.edit', $m->id_materi) }}"
                               class="bg-yellow-500 hover:bg-yellow-600 text-white px-3 py-1 rounded text-sm">
                                <i class="fa-solid fa-pen"></i>
                            </a>

                            {{-- DELETE --}}
                            <form action="{{ route('materi.destroy', $m->id_materi) }}"
                                  method="POST"
                                  onsubmit="return confirm('Yakin hapus materi ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                        class="bg-red-600 hover:bg-red-700 text-white px-3 py-1 rounded text-sm">
                                    <i class="fa-solid fa-trash"></i>
                                </button>
                            </form>

                        </div>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" class="text-center p-4 text-gray-500">
                        Belum ada materi
                    </td>
                </tr>
            @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
