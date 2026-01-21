@extends('layouts.app')

@section('content')
<div class="p-6">
    <div class="max-w-6xl mx-auto bg-white rounded-xl shadow-md border border-gray-100 overflow-hidden">

        {{-- HEADER --}}
        <div class="bg-[#004269] px-6 py-4 flex justify-between items-center">
            <h2 class="text-xl font-bold text-white">Riwayat LKM Pendidik</h2>

            <div class="flex gap-2">
                <a href="{{ url('/pendidik/absen') }}"
                   class="bg-gray-200 text-[#004269] px-4 py-2 rounded-lg text-xs font-bold hover:bg-gray-300 transition shadow-sm">
                    ← KEMBALI
                </a>

                <a href="{{ url('/pendidik/absensi/create/'.$id_kelas.'/'.$kode_mk.'/1') }}"
                   class="bg-white text-[#009DA5] px-4 py-2 rounded-lg text-xs font-bold hover:bg-gray-100 transition shadow-sm">
                    + INPUT BARU
                </a>
            </div>
        </div>

        {{-- INFO MATA KULIAH --}}
        <div class="m-6 bg-[#E6F7F8] border border-[#009DA5] rounded-lg p-4 text-sm">
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
                <div class="mb-4 p-3 text-[#004269] bg-[#E6F7F8] rounded-md text-sm">
                    {{ session('success') }}
                </div>
            @endif

            <table class="w-full text-sm text-left table-fixed">
                <thead class="bg-gray-50 border-b text-gray-700 uppercase text-xs">
                    <tr>
                        <th class="px-6 py-4 w-[120px]">Tanggal</th>
                        <th class="px-6 py-4 w-[160px]">Pertemuan</th>
                        <th class="px-6 py-4">Mata Kuliah</th>
                        <th class="px-6 py-4 w-[220px] text-center">Materi Pokok</th>
                        <th class="px-6 py-4 w-[120px] text-center">Metode</th>
                        <th class="px-6 py-4 w-[140px] text-center">Status</th>
                        <th class="px-6 py-4 w-[220px] text-center">Aksi</th>
                    </tr>
                </thead>

                <tbody class="divide-y divide-gray-100">

                @forelse($riwayatLkm as $lkm)
                    <tr class="hover:bg-gray-50 transition">

                        {{-- TANGGAL --}}
                        <td class="px-6 py-4 font-medium whitespace-nowrap">
                            {{ \Carbon\Carbon::parse($lkm->tanggal)->format('d/m/Y') }}
                        </td>

                        {{-- PERTEMUAN --}}
                        <td class="px-6 py-4 font-bold text-[#004269] whitespace-nowrap">
                            Pertemuan Ke-{{ $lkm->id_pertemuan }}
                        </td>

                        <td class="px-6 py-4 whitespace-normal break-words leading-relaxed">
                            {{ $matkul->nama_mk }}
                        </td>

                        {{-- MATERI POKOK --}}
                        <td class="px-6 py-4 italic text-gray-600 text-center whitespace-normal break-words leading-relaxed">
                            {{ $lkm->materi ? '"'.$lkm->materi.'"' : '-' }}
                        </td>

                        {{-- METODE --}}
                        <td class="px-6 py-4 text-center whitespace-nowrap">
                            @if($lkm->metode_mengajar === 'Online')
                                <span class="px-2 py-1 bg-[#E6F7F8] text-[#009DA5] rounded-full text-[10px] font-bold border border-[#009DA5]">
                                    ONLINE
                                </span>
                            @else
                                <span class="px-2 py-1 bg-[#EAF0F4] text-[#004269] rounded-full text-[10px] font-bold border border-[#004269]">
                                    OFFLINE
                                </span>
                            @endif
                        </td>

                        {{-- STATUS --}}
                        <td class="px-6 py-4 text-center whitespace-nowrap">
                            @if($lkm->materi)
                                <span class="px-2 py-1 bg-[#E6F7F8] text-[#009DA5] rounded-full text-[10px] font-bold">
                                    TERPOSTING
                                </span>
                            @else
                                <span class="px-2 py-1 bg-gray-100 text-gray-600 rounded-full text-[10px] font-bold">
                                    BELUM DIISI
                                </span>
                            @endif
                        </td>

                        {{-- AKSI --}}
                        <td class="px-6 py-4">
                            <div class="flex justify-center gap-1 flex-nowrap">

                                <a href="{{ url('/pendidik/lkm/edit/'.$id_kelas.'/'.$kode_mk.'/'.$lkm->id_pertemuan) }}"
                                   class="bg-[#009DA5] hover:bg-[#007C82] text-white px-3 py-1.5 rounded text-[10px] font-bold transition shadow-sm whitespace-nowrap">
                                    EDIT
                                </a>

                                <a href="{{ route('pendidik.lkm.detail', [$id_kelas, $kode_mk, $lkm->id_pertemuan]) }}"
                                   class="bg-[#004269] hover:bg-[#00304B] text-white px-3 py-1.5 rounded text-[10px] font-bold transition shadow-sm whitespace-nowrap">
                                    DETAIL
                                </a>

                                <form action="{{ url('/pendidik/lkm/delete/'.$id_kelas.'/'.$kode_mk.'/'.$lkm->id_pertemuan) }}"
                                      method="POST"
                                      onsubmit="return confirm('Yakin ingin menghapus LKM ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button
                                        class="bg-gray-600 hover:bg-gray-700 text-white px-3 py-1.5 rounded text-[10px] font-bold transition shadow-sm whitespace-nowrap">
                                        HAPUS
                                    </button>
                                </form>

                            </div>
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
