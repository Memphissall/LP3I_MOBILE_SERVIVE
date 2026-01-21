@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto">

    <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-8">

        {{-- HEADER --}}
        <div class="border-b border-gray-200 pb-6 mb-8">
            <h2 class="text-2xl font-semibold text-[#004269]">
                Rekapitulasi Gaji Pendidik
            </h2>
            <p class="text-sm text-gray-500 mt-1">
                Total gaji bersih yang diterima
            </p>
        </div>

        {{-- TOTAL GAJI --}}
        <div class="bg-gray-50 rounded-lg p-6 mb-10 border-l-4 border-[#009DA5]">
            <p class="text-sm text-gray-500 mb-1">
                Total Gaji Bersih
            </p>
            <p class="text-3xl font-semibold text-[#004269]">
                Rp {{ number_format($total,0,',','.') }}
            </p>
        </div>

        {{-- TABLE --}}
        <div class="overflow-x-auto">
            <table class="w-full text-sm text-gray-700">
                <thead>
                    <tr class="border-b border-gray-300 text-gray-600">
                        <th class="py-3 text-left font-medium">Tanggal</th>
                        <th class="py-3 text-left font-medium">Keterangan</th>
                        <th class="py-3 text-right font-semibold text-[#004269]">
                            Gaji Bersih
                        </th>
                    </tr>
                </thead>

                <tbody class="divide-y divide-gray-200">
                    @forelse($honor as $h)
                    <tr class="hover:bg-gray-50 transition">

                        {{-- TANGGAL --}}
                        <td class="py-4">
                            {{ \Carbon\Carbon::parse($h->tanggal)->format('d M Y') }}
                        </td>

                        {{-- KETERANGAN --}}
                        <td class="py-4 text-gray-700">
                            @if($h->honor_mengajar > 0)
                                Honor Mengajar
                                <span class="text-xs text-gray-500 block">
                                    {{ $h->kode_mk }} • Pertemuan {{ $h->id_pertemuan }}
                                </span>

                            @elseif($h->jenis_honor === 'pembuatan_soal')
                                Honor Pembuatan Soal
                                <span class="text-xs text-gray-500 block">
                                    Bulan {{ \Carbon\Carbon::create()->month($h->bulan)->translatedFormat('F') }}
                                </span>

                            @elseif($h->jenis_honor === 'koreksi')
                                Honor Koreksi Jawaban
                                <span class="text-xs text-gray-500 block">
                                    Bulan {{ \Carbon\Carbon::create()->month($h->bulan)->translatedFormat('F') }}
                                </span>

                            @else
                                Honor Pendidik
                            @endif
                        </td>

                        {{-- GAJI --}}
                        <td class="py-4 text-right font-semibold text-[#009DA5]">
                            Rp {{ number_format($h->gaji_bersih,0,',','.') }}
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="3" class="py-8 text-center text-gray-500">
                            Belum terdapat data gaji
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

    </div>
</div>
@endsection
