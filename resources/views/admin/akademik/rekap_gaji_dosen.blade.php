@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto px-6 py-6">

    {{-- ================= HEADER ================= --}}
    <div class="mb-6">
        <h2 class="text-2xl font-semibold text-gray-800">
            Data Honor Mengajar & Honor Tambahan
        </h2>
        <p class="text-sm text-gray-500 mt-1">
            Rekap gaji bersih pendidik berdasarkan filter
        </p>
    </div>

    {{-- ================= FILTER ================= --}}
    <form method="GET" class="bg-white rounded-xl shadow-sm border p-6 mb-6">
        <div class="grid grid-cols-1 md:grid-cols-4 gap-4">

            {{-- PENDIDIK --}}
            <select name="id_pendidik" class="rounded-lg border-gray-300">
                <option value="">Semua Pendidik</option>
                @foreach($data->unique('id_pendidik') as $row)
                    <option value="{{ $row->id_pendidik }}"
                        {{ request('id_pendidik') == $row->id_pendidik ? 'selected' : '' }}>
                        {{ $row->nama_pendidik }}
                    </option>
                @endforeach
            </select>

            {{-- BULAN --}}
            <select name="bulan" class="rounded-lg border-gray-300">
                <option value="">Semua Bulan</option>
                @for($i = 1; $i <= 12; $i++)
                    <option value="{{ $i }}"
                        {{ request('bulan') == $i ? 'selected' : '' }}>
                        {{ \Carbon\Carbon::create()->month($i)->translatedFormat('F') }}
                    </option>
                @endfor
            </select>

            {{-- TAHUN --}}
            <input type="number"
                   name="tahun"
                   value="{{ request('tahun', date('Y')) }}"
                   class="rounded-lg border-gray-300"
                   placeholder="Tahun">

            {{-- BUTTON --}}
            <button class="bg-teal-600 hover:bg-teal-700 text-white rounded-lg font-semibold">
                Filter
            </button>
        </div>
    </form>

    {{-- ================= TOTAL GAJI (BERSYARAT) ================= --}}
    @if($totalGaji !== null)
    <div class="bg-white rounded-xl border-l-4 border-teal-500 p-6 mb-6">
        <p class="text-sm text-gray-500">
            Total Gaji Bersih (Hasil Filter)
        </p>
        <h3 class="text-2xl font-bold text-gray-800 mt-1">
            Rp {{ number_format($totalGaji, 0, ',', '.') }}
        </h3>
    </div>
    @endif

    {{-- ================= TABLE ================= --}}
    <div class="bg-white rounded-xl shadow-sm border overflow-x-auto">
        <table class="min-w-full text-sm">
            <thead class="bg-gray-50 border-b">
                <tr class="text-left text-gray-600">
                    <th class="px-6 py-4">Tanggal</th>
                    <th class="px-6 py-4">Pendidik</th>
                    <th class="px-6 py-4">Keterangan</th>
                    <th class="px-6 py-4 text-right">Gaji Bersih</th>
                </tr>
            </thead>
            <tbody class="divide-y">
                @forelse($data as $row)
                <tr class="hover:bg-gray-50">
                    <td class="px-6 py-4">
                        {{ \Carbon\Carbon::parse($row->created_at)->translatedFormat('d M Y') }}
                    </td>
                    <td class="px-6 py-4 font-medium">
                        {{ $row->nama_pendidik }}
                    </td>
                    <td class="px-6 py-4">
                        <div class="font-semibold">
                            {{ ucfirst($row->jenis_honor) }}
                        </div>
                        <div class="text-gray-500 text-xs">
                            Bulan {{ \Carbon\Carbon::create()->month($row->bulan)->translatedFormat('F') }}
                        </div>
                    </td>
                    <td class="px-6 py-4 text-right font-semibold text-teal-600">
                        Rp {{ number_format($row->gaji_bersih, 0, ',', '.') }}
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="4" class="px-6 py-6 text-center text-gray-500">
                        Data tidak ditemukan
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

</div>
@endsection
