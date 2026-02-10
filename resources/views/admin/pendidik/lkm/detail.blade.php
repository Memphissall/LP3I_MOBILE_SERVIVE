@extends('layouts.app')

@section('content')

<div class="max-w-6xl mx-auto p-6 space-y-6">

    {{-- HEADER --}}
    <div class="bg-white rounded-xl shadow border p-6">
        <h2 class="text-2xl font-bold text-gray-800">
            📋 Detail Absensi
        </h2>
        <p class="text-sm text-gray-500 mt-1">
            {{ $matkul->nama_mk }} • Pertemuan Ke-{{ $pertemuan }}
        </p>
    </div>

    <!-- {{-- REKAP --}}
    <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
        <div class="bg-green-50 border border-green-200 p-5 rounded-xl shadow-sm">
            <p class="text-xs font-semibold text-green-600 uppercase">Hadir</p>
            <p class="text-3xl font-bold text-green-800 mt-1">
                {{ $rekap->hadir }}
            </p>
        </div>

        <div class="bg-yellow-50 border border-yellow-200 p-5 rounded-xl shadow-sm">
            <p class="text-xs font-semibold text-yellow-600 uppercase">Izin</p>
            <p class="text-3xl font-bold text-yellow-800 mt-1">
                {{ $rekap->izin }}
            </p>
        </div>

        <div class="bg-blue-50 border border-blue-200 p-5 rounded-xl shadow-sm">
            <p class="text-xs font-semibold text-blue-600 uppercase">Sakit</p>
            <p class="text-3xl font-bold text-blue-800 mt-1">
                {{ $rekap->sakit }}
            </p>
        </div>

        <div class="bg-red-50 border border-red-200 p-5 rounded-xl shadow-sm">
            <p class="text-xs font-semibold text-red-600 uppercase">Alpha</p>
            <p class="text-3xl font-bold text-red-800 mt-1">
                {{ $rekap->alpha }}
            </p>
        </div>
    </div> -->

    {{-- TABEL --}}
    <div class="bg-white rounded-xl shadow border overflow-hidden">
        <table class="w-full text-sm">
            <thead class="bg-gray-100 text-gray-600 uppercase text-xs">
                <tr>
                    <th class="px-6 py-4 text-left">NIPD</th>
                    <th class="px-6 py-4 text-left">Nama Mahasiswa</th>
                    <th class="px-6 py-4 text-center">Status</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
                @forelse($absensi as $a)
                <tr class="hover:bg-gray-50 transition">
                    <td class="px-6 py-4">
                        {{ $a->nama_mhs }}
                    </td>
                    <td class="px-6 py-4 font-medium text-gray-800">
                        {{ $a->nama_mhs}}
                    </td>
                    <td class="px-6 py-4 text-center">
                <span class="
                    inline-flex px-3 py-1 rounded-full text-xs font-semibold
                    @if($a->status == 'hadir')
                        bg-green-100 text-green-700
                    @elseif($a->status == 'izin')
                        bg-yellow-100 text-yellow-700
                    @elseif($a->status == 'sakit')
                        bg-blue-100 text-blue-700
                    @else
                        bg-red-100 text-red-700
                    @endif
                ">
                    {{ ucfirst($a->status) }}
                </span>
            </td>

                </tr>
                @empty
                <tr>
                    <td colspan="3" class="text-center py-8 text-gray-400 italic">
                        Data absensi kosong
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{-- BUTTON --}}
    <button onclick="history.back()"
    class="bg-gray-200 hover:bg-gray-300 text-gray-700 px-6 py-2 rounded-lg text-sm font-semibold transition">
    ← Kembali
</button>


</div>

@endsection
