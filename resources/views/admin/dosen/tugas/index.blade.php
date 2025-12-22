@extends('layouts.app')

@section('content')
<div class="p-6 max-w-6xl mx-auto">

    <h1 class="text-2xl mb-4 font-bold text-gray-800">Daftar Tugas</h1>

    <div class="mb-4 space-y-1 text-gray-700">
        <p><strong>Kelas:</strong> {{ $kelas->nama_kelas }}</p>
        <p><strong>Mata Kuliah:</strong> {{ $matkul->nama_mk }}</p>
    </div>

    <div class="flex flex-wrap gap-2 mb-4">
        {{-- Kembali --}}
        <a href="{{ route('tugas.pilih') }}"
           class="bg-gray-600 text-white px-4 py-2 rounded hover:bg-gray-700 transition">
           Kembali
        </a>

        {{-- Tambah --}}
        <a href="{{ route('tugas.tambah', [$id_kelas, $kode_mk]) }}"
           class="bg-indigo-600 text-white px-4 py-2 rounded hover:bg-indigo-700 transition">
           Tambah Tugas
        </a>
    </div>

    <div class="overflow-x-auto bg-white rounded-lg shadow-md">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-indigo-50">
                <tr>
                    <th class="px-4 py-2 text-left text-sm font-semibold text-indigo-700">#</th>
                    <th class="px-4 py-2 text-left text-sm font-semibold text-indigo-700">Judul</th>
                    <th class="px-4 py-2 text-left text-sm font-semibold text-indigo-700">Deskripsi</th>
                    <th class="px-4 py-2 text-left text-sm font-semibold text-indigo-700">Deadline</th>
                    <th class="px-4 py-2 text-left text-sm font-semibold text-indigo-700">Status</th>
                    <th class="px-4 py-2 text-left text-sm font-semibold text-indigo-700">Aksi</th>
                </tr>
            </thead>

            <tbody class="divide-y divide-gray-200">
                @forelse($tugas as $index => $t)
                <tr class="hover:bg-indigo-50 transition-colors duration-200">

                    <td class="px-4 py-2 text-gray-700">
                        {{ $index + 1 }}
                    </td>

                    <td class="px-4 py-2 text-gray-700 font-semibold">
                        {{ $t->judul }}
                    </td>

                    {{-- DESKRIPSI --}}
                    <td class="px-4 py-2 text-gray-700 max-w-md">
                        <span title="{{ $t->deskripsi }}">
                            {{ \Illuminate\Support\Str::limit($t->deskripsi, 70, '...') }}
                        </span>
                    </td>

                    <td class="px-4 py-2 text-gray-700">
                        {{ $t->deadline->timezone('Asia/Jakarta')->format('d-m-Y H:i') }} WIB
                    </td>

                    <td class="px-4 py-2">
                            <span class="px-3 py-1 rounded-full text-white text-sm font-semibold
                         {{ $t->isAktif() ? 'bg-green-600' : 'bg-red-600' }}">
                                 {{ $t->isAktif() ? 'aktif' : 'nonaktif' }}
                             </span>
                            </td>


                    <td class="px-4 py-2 space-x-2 flex flex-wrap">

                        {{-- EDIT --}}
                        <a href="{{ route('tugas.edit', $t->id_tugas) }}"
                           class="px-3 py-1 bg-green-600 text-white rounded text-sm hover:bg-green-700 transition">
                           Edit
                        </a>

                        {{-- HAPUS --}}
                        <form action="{{ route('tugas.destroy', $t->id_tugas) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                    onclick="return confirm('Yakin ingin menghapus tugas ini?')"
                                    class="px-3 py-1 bg-red-600 text-white rounded text-sm hover:bg-red-700 transition">
                                Hapus
                            </button>
                        </form>

                        {{-- LIHAT JAWABAN --}}
                        <a href="{{ route('submissi.index', [$t->id_kelas, $t->kode_mk]) }}"
                           class="px-3 py-1 bg-indigo-600 text-white rounded text-sm hover:bg-indigo-700 transition">
                           Lihat Jawaban
                        </a>

                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="text-center py-6 text-gray-500">
                        Belum ada tugas.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

</div>
@endsection
