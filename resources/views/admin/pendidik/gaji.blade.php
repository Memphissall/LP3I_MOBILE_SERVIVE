@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto mt-10">

    <div class="bg-white rounded-xl shadow border border-gray-200 p-8">

        {{-- HEADER --}}
        <div class="border-b border-gray-200 pb-6 mb-8">
            <h2 class="text-2xl font-semibold text-[#004269]">
                Rekapitulasi Gaji Pendidik
            </h2>
            <p class="text-sm text-gray-500 mt-1">
                Detail honor mengajar per pertemuan
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
            <table class="w-full text-sm text-gray-700 border border-gray-200 rounded-lg">
                <thead class="bg-gray-50">
                    <tr class="text-left text-gray-600 uppercase text-xs tracking-wider">
                        <th class="px-4 py-3">No</th>
                        <th class="px-4 py-3">Mata Kuliah</th>
                        <th class="px-4 py-3">Kelas</th>
                        <th class="px-4 py-3">Semester</th>
                        <th class="px-4 py-3">SKS</th>
                        <th class="px-4 py-3">Sesi</th>
                        <th class="px-4 py-3">Tanggal</th>
                        <th class="px-4 py-3 text-right">Gaji Bersih</th>
                    </tr>
                </thead>

                <tbody class="divide-y divide-gray-200">
                    @forelse($honor as $i => $h)
                    <tr class="hover:bg-gray-50 transition">

                        {{-- NO --}}
                        <td class="px-4 py-3">
                            {{ $i + 1 }}
                        </td>

                        {{-- MATA KULIAH --}}
                        <td class="px-4 py-3 font-medium text-gray-800">
                            {{ $h->matkul->nama_mk ?? '-' }}
                        </td>

                        {{-- KELAS --}}
                        <td class="px-4 py-3">
                           {{ $h->kelas->nama_kelas ?? '-' }}
                        </td>

                        {{-- SEMESTER --}}
                        <td class="px-4 py-3">
                            {{ $h->semester }}
                        </td>

                        {{-- SKS --}}
                        <td class="px-4 py-3">
                            {{ $h->sks }}
                        </td>

        

                        {{-- SESI --}}
                        <td class="px-4 py-3">
                            @php
                                $sesi = ceil($h->sks / 2);
                            @endphp
                            {{ $sesi }} sesi
                        </td>

                        {{-- TANGGAL --}}
                        <td class="px-4 py-3">
                            {{ \Carbon\Carbon::parse($h->tanggal)->format('d M Y') }}
                        </td>

                        {{-- GAJI --}}
                        <td class="px-4 py-3 text-right font-semibold text-[#009DA5]">
                            Rp {{ number_format($h->gaji_bersih,0,',','.') }}
                        </td>

                    </tr>
                    @empty
                    <tr>
                        <td colspan="9" class="px-4 py-10 text-center text-gray-500">
                            Belum ada data honor mengajar
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

    </div>

</div>
@endsection
