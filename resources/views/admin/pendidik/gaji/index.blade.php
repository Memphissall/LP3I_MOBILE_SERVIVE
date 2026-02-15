@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto mt-10">

    <div class="bg-white rounded-xl shadow border border-gray-200 p-8">

        {{-- HEADER --}}
        <div class="border-b border-gray-200 pb-6 mb-6">
            <h2 class="text-2xl font-semibold text-[#004269]">
                Rekapitulasi Gaji Pendidik
            </h2>

            <p class="text-sm text-gray-500 mt-1">
                Periode :
                <span class="font-semibold text-gray-700">
                    {{ $tgl_awal->format('d M Y') }}
                </span>
                s/d
                <span class="font-semibold text-gray-700">
                    {{ $tgl_akhir->format('d M Y') }}
                </span>
            </p>
        </div>

        {{-- ===================== --}}
        {{-- TOTAL REKAP GLOBAL --}}
        {{-- ===================== --}}
        <div class="bg-gray-50 rounded-lg p-6 mb-10 border-l-4 border-[#009DA5]">

            <div class="grid md:grid-cols-3 gap-6">

                <div>
                    <p class="text-sm text-gray-500 mb-1">Total Kotor</p>
                    <p class="text-xl font-semibold text-gray-800">
                        Rp {{ number_format($totalKotor,0,',','.') }}
                    </p>
                </div>

                <div>
                    <p class="text-sm text-gray-500 mb-1">PPN 5%</p>
                    <p class="text-xl font-semibold text-red-600">
                        Rp {{ number_format($totalPPN,0,',','.') }}
                    </p>
                </div>

                <div>
                    <p class="text-sm text-gray-500 mb-1">Total Gaji Bersih</p>
                    <p class="text-2xl font-bold text-[#009DA5]">
                        Rp {{ number_format($totalGajiBersih,0,',','.') }}
                    </p>
                </div>

            </div>
        </div>

        {{-- ===================== --}}
        {{-- TABLE DETAIL --}}
        {{-- ===================== --}}
        <div class="overflow-x-auto">
            <table class="w-full text-sm border border-gray-200 rounded-lg">
                <thead class="bg-gray-50 text-gray-600 uppercase text-xs tracking-wider">
                    <tr>
                        <th class="px-4 py-3 text-center w-14">No</th>
                        <th class="px-4 py-3">Mata Kuliah</th>
                        <th class="px-4 py-3">Kelas</th>
                        <th class="px-4 py-3 text-center">Smt</th>
                        <th class="px-4 py-3 text-center">SKS</th>
                        <th class="px-4 py-3 text-center">Sesi</th>
                        <th class="px-4 py-3 text-center">Tanggal</th>

                        <th class="px-4 py-3 text-right">Honor Mengajar</th>
                        <th class="px-4 py-3 text-right">Lainnya</th>
                        <th class="px-4 py-3 text-right">Total Kotor</th>
                    </tr>
                </thead>

                <tbody class="divide-y divide-gray-200">
                    @forelse($honor as $i => $h)

                        @php
                            $honorLainnya = $h->total_kotor - $h->honor_mengajar;
                        @endphp

                        <tr class="hover:bg-gray-50 transition">

                            {{-- NO --}}
                            <td class="px-4 py-3 text-center font-medium">
                                {{ $i + 1 }}
                                @if($i === 0)
                                    <div class="mt-1">
                                        <span class="text-xs bg-green-100 text-green-700 px-2 py-0.5 rounded-full">
                                            TERBARU
                                        </span>
                                    </div>
                                @endif
                            </td>

                            <td class="px-4 py-3 font-medium text-gray-800">
                                {{ $h->matkul->nama_mk ?? '-' }}
                            </td>

                            <td class="px-4 py-3">
                                {{ $h->kelas->nama_kelas ?? '-' }}
                            </td>

                            <td class="px-4 py-3 text-center">
                                {{ $h->semester }}
                            </td>

                            <td class="px-4 py-3 text-center">
                                {{ $h->sks }}
                            </td>

                            <td class="px-4 py-3 text-center">
                                {{ ceil($h->sks / 2) }}
                            </td>

                            <td class="px-4 py-3 text-center">
                                {{ \Carbon\Carbon::parse($h->tanggal)->format('d M Y') }}
                            </td>

                            <td class="px-4 py-3 text-right">
                                Rp {{ number_format($h->honor_mengajar,0,',','.') }}
                            </td>

                            <td class="px-4 py-3 text-right text-gray-600">
                                Rp {{ number_format($honorLainnya,0,',','.') }}
                            </td>

                            <td class="px-4 py-3 text-right font-medium">
                                Rp {{ number_format($h->total_kotor,0,',','.') }}
                            </td>

                        </tr>

                    @empty
                        <tr>
                            <td colspan="10" class="px-4 py-10 text-center text-gray-500">
                                Belum ada data honor di periode ini
                            </td>
                        </tr>
                    @endforelse
                </tbody>

            </table>
        </div>

    </div>
</div>
@endsection
