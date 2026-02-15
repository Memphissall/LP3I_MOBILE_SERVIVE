@extends('layouts.app')

@section('content')
<div class="p-6">
    <div class="max-w-7xl mx-auto bg-white rounded-2xl shadow-lg border border-gray-100 overflow-hidden">

        {{-- HEADER --}}
        <div class="bg-gradient-to-r from-[#004269] to-[#009DA5] px-6 py-5 flex justify-between items-center">
            <h2 class="text-xl font-bold text-white tracking-wide">
                Riwayat LKM Pendidik
            </h2>

            <div class="flex gap-3">
                <a href="{{ url('/pendidik/absen') }}"
                   class="bg-white text-[#004269] px-4 py-2 rounded-lg text-xs font-bold hover:scale-105 transition shadow-sm">
                    ← KEMBALI
                </a>

                <a href="{{ url('/pendidik/absensi/create/'.$id_kelas.'/'.$id_mk.'/1') }}"
                   class="bg-[#002F4B] text-white px-4 py-2 rounded-lg text-xs font-bold hover:bg-[#001f32] transition shadow-sm">
                    + INPUT BARU
                </a>
            </div>
        </div>

        {{-- INFO MATA KULIAH --}}
        <div class="m-6 bg-[#E6F7F8] border border-[#009DA5] rounded-xl p-5 text-sm shadow-sm">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                <div>
                    <p class="text-gray-500 text-xs uppercase">Mata Kuliah</p>
                    <p class="font-semibold text-[#004269]">
                        {{ $matkul->nama_mk }}
                    </p>
                </div>

                <div>
                    <p class="text-gray-500 text-xs uppercase">SKS</p>
                    <p class="font-semibold text-[#004269]">
                        {{ $matkul->sks }} SKS
                    </p>
                </div>

                <div>
                    <p class="text-gray-500 text-xs uppercase">Durasi / Pertemuan</p>
                    <p class="font-semibold text-[#004269]">
                        {{ $matkul->sks }} Jam ({{ $matkul->sks * 50 }} Menit)
                    </p>
                </div>

                <div>
                    <p class="text-gray-500 text-xs uppercase">Total Pertemuan</p>
                    <p class="font-semibold text-[#004269]">
                        14 Pertemuan
                    </p>
                </div>
            </div>
        </div>

        {{-- CONTENT --}}
        <div class="px-6 pb-6">

            @if(session('success'))
                <div class="mb-6 p-4 text-[#004269] bg-[#E6F7F8] border border-[#009DA5] rounded-lg text-sm">
                    {{ session('success') }}
                </div>
            @endif

            <div class="overflow-x-auto rounded-xl border border-gray-100 shadow-sm">
                <table class="w-full text-sm text-left">
                    <thead class="bg-gray-100 text-gray-600 uppercase text-[11px] tracking-wider">
                        <tr>
                            <th class="px-6 py-4">Tanggal</th>
                            <th class="px-6 py-4">Pertemuan</th>
                            <th class="px-6 py-4">Materi Pokok</th>
                            <th class="px-6 py-4">Sub Pembahasan</th>
                            <th class="px-6 py-4 text-center">Metode</th>
                            <th class="px-6 py-4 text-center">Status</th>
                            <th class="px-6 py-4 text-center">Aksi</th>
                        </tr>
                    </thead>

                    <tbody class="divide-y divide-gray-100 bg-white">

                    @forelse($riwayatLkm as $lkm)
                        <tr class="hover:bg-[#F8FAFC] transition duration-200">

                            {{-- TANGGAL --}}
                            <td class="px-6 py-5 whitespace-nowrap text-gray-700">
                                <div class="font-semibold">
                                    {{ \Carbon\Carbon::parse($lkm->tanggal)->format('d/m/Y') }}
                                </div>
                            </td>

                            {{-- PERTEMUAN --}}
                            <td class="px-6 py-5 whitespace-nowrap">
                                <span class="px-3 py-1 bg-[#004269] text-white text-xs rounded-full font-bold shadow-sm">
                                    Ke-{{ $lkm->pertemuan }}
                                </span>
                            </td>

                            {{-- MATERI --}}
                            <td class="px-6 py-5 max-w-xs">
                                <div class="font-semibold text-gray-800 line-clamp-2">
                                    {{ $lkm->materi ?? '-' }}
                                </div>
                            </td>

                            {{-- SUB PEMBAHASAN --}}
                            <td class="px-6 py-5 max-w-sm">
                                <div class="text-gray-600 text-xs leading-relaxed line-clamp-3">
                                    {{ $lkm->sub_pembahasan ?? '-' }}
                                </div>
                            </td>

                            {{-- METODE --}}
                            <td class="px-6 py-5 text-center">
                                @if($lkm->metode_mengajar === 'Online')
                                    <span class="px-3 py-1 bg-[#E6F7F8] text-[#009DA5] rounded-full text-[11px] font-bold border border-[#009DA5]">
                                        ONLINE
                                    </span>
                                @else
                                    <span class="px-3 py-1 bg-[#EAF0F4] text-[#004269] rounded-full text-[11px] font-bold border border-[#004269]">
                                        OFFLINE
                                    </span>
                                @endif
                            </td>

                            {{-- STATUS --}}
                            <td class="px-6 py-5 text-center">
                                @if($lkm->materi)
                                    <span class="px-3 py-1 bg-green-100 text-green-700 rounded-full text-[11px] font-bold">
                                        TERPOSTING
                                    </span>
                                @else
                                    <span class="px-3 py-1 bg-gray-200 text-gray-600 rounded-full text-[11px] font-bold">
                                        BELUM DIISI
                                    </span>
                                @endif
                            </td>

                            {{-- AKSI --}}
                            <td class="px-6 py-5">
                                <div class="flex justify-center gap-2">

                                    <a href="{{ url('/pendidik/lkm/edit/'.$id_kelas.'/'.$id_mk.'/'.$lkm->pertemuan) }}"
                                       class="bg-[#009DA5] hover:bg-[#007C82] text-white px-3 py-1.5 rounded text-xs font-semibold transition shadow-sm">
                                        EDIT
                                    </a>

                                    <a href="{{ route('pendidik.lkm.detail', [$id_kelas, $id_mk, $lkm->pertemuan]) }}"
                                       class="bg-[#004269] hover:bg-[#00304B] text-white px-3 py-1.5 rounded text-xs font-semibold transition shadow-sm">
                                        DETAIL
                                    </a>

                                    <form action="{{ url('/pendidik/lkm/delete/'.$id_kelas.'/'.$id_mk.'/'.$lkm->pertemuan) }}"
                                          method="POST"
                                          onsubmit="return confirm('Yakin ingin menghapus LKM ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button
                                            class="bg-red-500 hover:bg-red-600 text-white px-3 py-1.5 rounded text-xs font-semibold transition shadow-sm">
                                            HAPUS
                                        </button>
                                    </form>

                                </div>
                            </td>
                        </tr>

                    @empty
                        <tr>
                            <td colspan="7" class="px-6 py-14 text-center text-gray-400 italic">
                                Belum ada riwayat LKM.
                            </td>
                        </tr>
                    @endforelse

                    </tbody>
                </table>
            </div>

        </div>
    </div>
</div>
@endsection
