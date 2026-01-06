@extends('layouts.app')

@section('content')
<div class="p-6">
    <div class="max-w-6xl mx-auto bg-white rounded-xl shadow-md border border-gray-100 overflow-hidden">

        {{-- HEADER --}}
        <div class="bg-gradient-to-r from-green-600 to-green-700 px-6 py-4 flex justify-between items-center">
            <h2 class="text-xl font-bold text-white">Riwayat LKM Dosen</h2>

            <div class="flex gap-2">
                <a href="{{ url('/dosen/absen') }}"
                   class="bg-gray-200 text-gray-700 px-4 py-2 rounded-lg text-xs font-bold hover:bg-gray-300 transition shadow-sm">
                    ← KEMBALI
                </a>

                <a href="{{ url('/dosen/absensi/create/'.$id_kelas.'/'.$kode_mk.'/1') }}"
                   class="bg-white text-green-700 px-4 py-2 rounded-lg text-xs font-bold hover:bg-gray-100 transition shadow-sm">
                    + INPUT BARU
                </a>
            </div>
        </div>

        {{-- INFO MATA KULIAH --}}
        <div class="m-6 bg-green-50 border border-green-200 rounded-lg p-4 text-sm">
            <div class="flex flex-wrap gap-6">
                <span><strong>Mata Kuliah:</strong> {{ $matkul->nama_mk }}</span>
                <span><strong>SKS:</strong> {{ $matkul->sks }}</span>
                <span><strong>Durasi / Pertemuan:</strong> {{ $matkul->sks }} Jam ({{ $matkul->sks * 50 }} Menit)</span>
                <span><strong>Total Pertemuan:</strong> 14</span>
            </div>
        </div>

        {{-- CONTENT --}}
        <div class="p-6">

            @if(session('success'))
                <div class="mb-4 p-3 text-green-700 bg-green-100 rounded-md text-sm">
                    {{ session('success') }}
                </div>
            @endif

            <table class="w-full text-sm text-left">
                <thead class="bg-gray-50 border-b text-gray-700 uppercase text-xs">
                    <tr>
                        <th class="px-6 py-4">Tanggal</th>
                        <th class="px-6 py-4">Pertemuan</th>
                        <th class="px-6 py-4">Mata Kuliah</th>
                        <th class="px-6 py-4 text-center">Materi Pokok</th>
                        <th class="px-6 py-4 text-center">Metode</th>
                        <th class="px-6 py-4 text-center">Status</th>
                        <th class="px-6 py-4 text-center">Aksi</th>
                    </tr>
                </thead>

                <tbody class="divide-y divide-gray-100">

                @forelse($riwayatLkm as $lkm)
                    <tr class="hover:bg-gray-50 transition">

                        <td class="px-6 py-4 font-medium">
                            {{ \Carbon\Carbon::parse($lkm->tanggal)->format('d/m/Y') }}
                        </td>

                        <td class="px-6 py-4 font-bold text-indigo-600">
                            Pertemuan Ke-{{ $lkm->id_pertemuan }}
                        </td>

                        <td class="px-6 py-4">
                            {{ $matkul->nama_mk }}
                        </td>

                        <td class="px-6 py-4 italic text-gray-600 text-center">
                            {{ $lkm->materi ? '"'.$lkm->materi.'"' : '-' }}
                        </td>

                        {{-- METODE --}}
                        <td class="px-6 py-4 text-center">
                            @if($lkm->metode_mengajar === 'Online')
                                <span class="px-2 py-1 bg-blue-100 text-blue-700 rounded-full text-[10px] font-bold border border-blue-200">
                                    ONLINE
                                </span>
                            @else
                                <span class="px-2 py-1 bg-purple-100 text-purple-700 rounded-full text-[10px] font-bold border border-purple-200">
                                    OFFLINE
                                </span>
                            @endif
                        </td>

                        {{-- STATUS --}}
                        <td class="px-6 py-4 text-center">
                            @if($lkm->materi)
                                <span class="px-2 py-1 bg-green-100 text-green-700 rounded-full text-[10px] font-bold">
                                    TERPOSTING
                                </span>
                            @else
                                <span class="px-2 py-1 bg-yellow-100 text-yellow-700 rounded-full text-[10px] font-bold">
                                    BELUM DIISI
                                </span>
                            @endif
                        </td>

                        {{-- AKSI --}}
                        <td class="px-6 py-4 text-center space-x-1">

                            <a href="{{ url('/dosen/lkm/edit/'.$id_kelas.'/'.$kode_mk.'/'.$lkm->id_pertemuan) }}"
                               class="bg-amber-500 hover:bg-amber-600 text-white px-3 py-1.5 rounded text-[10px] font-bold transition shadow-sm inline-block">
                                EDIT
                            </a>

                            <a href="{{ route('dosen.lkm.detail', [$id_kelas, $kode_mk, $lkm->id_pertemuan]) }}"
                               class="bg-blue-600 hover:bg-blue-700 text-white px-3 py-1.5 rounded text-[10px] font-bold transition shadow-sm inline-block">
                                DETAIL
                            </a>

                            <form action="{{ url('/dosen/lkm/delete/'.$id_kelas.'/'.$kode_mk.'/'.$lkm->id_pertemuan) }}"
                                  method="POST"
                                  class="inline"
                                  onsubmit="return confirm('Yakin ingin menghapus LKM ini?')">
                                @csrf
                                @method('DELETE')
                                <button
                                    class="bg-red-500 hover:bg-red-600 text-white px-3 py-1.5 rounded text-[10px] font-bold transition shadow-sm">
                                    HAPUS
                                </button>
                            </form>

                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="px-6 py-10 text-center text-gray-400 italic">
                            Belum ada riwayat LKM.
                        </td>
                    </tr>
                @endforelse

                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
