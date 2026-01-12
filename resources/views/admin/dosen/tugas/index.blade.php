@extends('layouts.app')

@section('content')
<div class="p-6">
    <div class="max-w-6xl mx-auto bg-white rounded-xl shadow-md border border-gray-100 overflow-hidden">

        {{-- HEADER --}}
        <div class="bg-[#004269] px-6 py-4 flex justify-between items-center">
            <h2 class="text-xl font-bold text-white">Daftar Tugas</h2>

            <div class="flex gap-2">
                <a href="{{ route('tugas.pilih') }}"
                   class="bg-gray-200 text-[#004269] px-4 py-2 rounded-lg text-xs font-bold hover:bg-gray-300 transition shadow-sm">
                    ← KEMBALI
                </a>

                <a href="{{ route('tugas.tambah', [$id_kelas, $kode_mk]) }}"
                   class="bg-white text-[#009DA5] px-4 py-2 rounded-lg text-xs font-bold hover:bg-gray-100 transition shadow-sm">
                    + TAMBAH TUGAS
                </a>
            </div>
        </div>

        {{-- INFO --}}
        <div class="m-6 bg-[#E6F7F8] border border-[#009DA5] rounded-lg p-4 text-sm">
            <div class="flex flex-wrap gap-6">
                <span><strong>Kelas:</strong> {{ $kelas->nama_kelas }}</span>
                <span><strong>Mata Kuliah:</strong> {{ $matkul->nama_mk }}</span>
            </div>
        </div>

        {{-- CONTENT --}}
        <div class="p-6">

            <table class="w-full text-sm text-left table-fixed">
                <thead class="bg-gray-50 border-b text-gray-700 uppercase text-xs">
                    <tr>
                        <th class="px-6 py-4 w-[60px]">#</th>
                        <th class="px-6 py-4">Judul</th>
                        <th class="px-6 py-4">Deskripsi</th>
                        <th class="px-6 py-4 w-[160px]">Deadline</th>
                        <th class="px-6 py-4 w-[120px] text-center">Status</th>
                        <th class="px-6 py-4 w-[220px] text-center">Aksi</th>
                    </tr>
                </thead>

                <tbody class="divide-y divide-gray-100">

                @forelse($tugas as $index => $t)
                    <tr class="hover:bg-gray-50 transition">

                        <td class="px-6 py-4 font-medium">
                            {{ $index + 1 }}
                        </td>

                        <td class="px-6 py-4 font-bold text-[#004269]">
                            {{ $t->judul }}
                        </td>

                        <td class="px-6 py-4 text-gray-600">
                            {{ \Illuminate\Support\Str::limit($t->deskripsi, 70, '...') }}
                        </td>

                        <td class="px-6 py-4 whitespace-nowrap">
                            {{ $t->deadline->timezone('Asia/Jakarta')->format('d/m/Y H:i') }} WIB
                        </td>

                        {{-- STATUS --}}
                        <td class="px-6 py-4 text-center">
                            @if($t->isAktif())
                                <span class="px-2 py-1 bg-[#E6F7F8] text-[#009DA5] rounded-full text-[10px] font-bold border border-[#009DA5]">
                                    AKTIF
                                </span>
                            @else
                                <span class="px-2 py-1 bg-gray-100 text-gray-600 rounded-full text-[10px] font-bold">
                                    NONAKTIF
                                </span>
                            @endif
                        </td>

                        {{-- AKSI --}}
                        <td class="px-6 py-4">
                            <div class="flex justify-center gap-1 flex-nowrap">

                                {{-- EDIT --}}
                                <a href="{{ route('tugas.edit', $t->id_tugas) }}"
                                   class="bg-[#009DA5] hover:bg-[#007C82] text-white px-3 py-1.5 rounded text-[10px] font-bold transition shadow-sm">
                                    EDIT
                                </a>

                                {{-- JAWABAN --}}
                                <a href="{{ route('submissi.index', [$t->id_kelas, $t->kode_mk, $t->id_tugas]) }}"
                                   class="bg-[#004269] hover:bg-[#00304B] text-white px-3 py-1.5 rounded text-[10px] font-bold transition shadow-sm">
                                    JAWABAN
                                </a>

                                {{-- HAPUS --}}
                                <form action="{{ route('tugas.destroy', $t->id_tugas) }}"
                                      method="POST"
                                      onsubmit="return confirm('Yakin ingin menghapus tugas ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button
                                        class="bg-gray-600 hover:bg-gray-700 text-white px-3 py-1.5 rounded text-[10px] font-bold transition shadow-sm">
                                        HAPUS
                                    </button>
                                </form>

                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="px-6 py-10 text-center text-gray-400 italic">
                            Belum ada tugas.
                        </td>
                    </tr>
                @endforelse

                </tbody>
            </table>

        </div>
    </div>
</div>
@endsection
