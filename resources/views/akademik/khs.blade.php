@extends('layouts.app')

@section('content')
<div class="p-6">
    {{-- Header --}}
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold text-gray-800">Manajemen KHS</h1>
    </div>

    {{-- Container Filter Utama --}}
    <div class="bg-white p-6 rounded-xl shadow-lg mb-6 border-t-4 border-[#004269]">
        <h2 class="text-lg font-semibold text-[#004269] mb-4">Filter Pencarian</h2>
        
        <form method="GET" action="{{ route('admin.khs.index') }}">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                {{-- Filter Kelas --}}
                <div class="flex flex-col space-y-1">
                    <label class="text-sm font-medium text-gray-600">Kelas</label>
                    <select name="id_kelas" id="filter-kelas" class="p-2 border rounded-lg outline-none text-sm text-gray-700 bg-gray-50 focus:border-[#009DA5] focus:ring-1 focus:ring-[#009DA5]">
                        <option value="">Semua Kelas</option>
                        @foreach($kelasList as $kelas)
                            <option value="{{ $kelas->id_kelas }}" {{ $id_kelas == $kelas->id_kelas ? 'selected' : '' }}>
                                {{ $kelas->nama_kelas }} - {{ $kelas->bidangKeahlian->nama ?? '' }}
                            </option>
                        @endforeach
                    </select>
                </div>

                {{-- Filter Semester --}}
                <div class="flex flex-col space-y-1">
                    <label class="text-sm font-medium text-gray-600">Semester</label>
                    <select name="semester" id="filter-semester" class="p-2 border rounded-lg outline-none text-sm text-gray-700 bg-gray-50 focus:border-[#009DA5] focus:ring-1 focus:ring-[#009DA5]">
                        <option value="">Semua Semester</option>
                        @for($i = 1; $i <= 8; $i++)
                            <option value="{{ $i }}" {{ $semester == $i ? 'selected' : '' }}>Semester {{ $i }}</option>
                        @endfor
                    </select>
                </div>

                {{-- Filter Tahun Akademik --}}
                <div class="flex flex-col space-y-1">
                    <label class="text-sm font-medium text-gray-600">Tahun Akademik</label>
                    <input type="text" name="tahun_akademik" id="filter-tahun-akademik" value="{{ $tahun_akademik }}" 
                        class="p-2 border rounded-lg outline-none text-sm text-gray-700 bg-gray-50 focus:border-[#009DA5] focus:ring-1 focus:ring-[#009DA5]" 
                        placeholder="Contoh: 2023/2024">
                </div>
            </div>

            <div class="mt-6 flex justify-end">
                {{-- Tombol Filter: Indigo Dye --}}
                <button type="submit" class="bg-[#004269] hover:bg-[#003350] text-white px-6 py-2 rounded-lg font-semibold transition shadow-md flex items-center">
                    <x-heroicon-o-magnifying-glass class="w-4 h-4 mr-2" />
                    Tampilkan Data
                </button>
            </div>
        </form>
    </div>

    {{-- Actions Bar (Visible if Class is Selected) --}}
    @if($id_kelas)
        <div class="mb-4 flex justify-end">
            {{-- Tombol Print Batch: Fiery Rose --}}
            <a href="{{ route('admin.khs.print.batch', ['id_kelas' => $id_kelas, 'semester' => $semester, 'tahun_akademik' => $tahun_akademik]) }}" 
               target="_blank"
               class="bg-[#F15B67] hover:bg-[#d64551] text-white px-6 py-2 rounded-lg font-semibold transition shadow-md flex items-center gap-2">
                <x-heroicon-o-printer class="w-4 h-4" />
                Cetak Batch Kelas
            </a>
        </div>
    @endif

    {{-- Table Section --}}
    <div class="bg-white rounded-xl shadow-lg overflow-hidden border border-gray-100 mb-6">
        {{-- Header Tabel: Indigo Dye --}}
        <div class="p-4 border-b flex justify-between items-center bg-[#004269]">
            <h3 class="font-bold text-white">Daftar Mahasiswa</h3>
        </div>

        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-center text-xs font-extrabold text-[#004269] uppercase w-16">No</th>
                        <th class="px-6 py-3 text-left text-xs font-extrabold text-[#004269] uppercase">NIPD</th>
                        <th class="px-6 py-3 text-left text-xs font-extrabold text-[#004269] uppercase">Nama Mahasiswa</th>
                        <th class="px-6 py-3 text-center text-xs font-extrabold text-[#004269] uppercase">Kelas</th>
                        <th class="px-6 py-3 text-center text-xs font-extrabold text-[#004269] uppercase">Jml MK</th>
                        <th class="px-6 py-3 text-center text-xs font-extrabold text-[#004269] uppercase">Total SKS</th>
                        <th class="px-6 py-3 text-center text-xs font-extrabold text-[#004269] uppercase">IPS</th>
                        <th class="px-6 py-3 text-center text-xs font-extrabold text-[#004269] uppercase">Aksi</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200 text-sm">
                    @forelse($mahasiswaList as $index => $mhs)
                        <tr class="hover:bg-gray-50 transition border-b">
                            <td class="px-6 py-4 text-center text-gray-600 font-mono">{{ $index + 1 }}</td>
                            <td class="px-6 py-4 text-gray-900 font-mono">{{ $mhs->nipd }}</td>
                            <td class="px-6 py-4 font-bold text-gray-900">{{ $mhs->nama }}</td>
                            <td class="px-6 py-4 text-center text-gray-600">
                                @if($mhs->data_kelas)
                                    <span class="bg-[#004269]/10 text-[#004269] px-2 py-1 rounded text-xs font-semibold">{{ $mhs->data_kelas->nama_kelas }}</span>
                                @else
                                    -
                                @endif
                            </td>
                            <td class="px-6 py-4 text-center text-gray-900">{{ $mhs->nilai_count }}</td>
                            <td class="px-6 py-4 text-center text-gray-900 font-semibold">{{ $mhs->total_sks }}</td>
                            <td class="px-6 py-4 text-center">
                                @php
                                    // Logika Warna Badge IPS sesuai Brand
                                    $ipsClass = 'bg-[#F15B67]/10 text-[#F15B67]'; // Default/Low (Fiery Rose)
                                    if ($mhs->ips >= 3.50) {
                                        $ipsClass = 'bg-[#009DA5]/10 text-[#009DA5]'; // High (Viridian Green)
                                    } elseif ($mhs->ips >= 3.00) {
                                        $ipsClass = 'bg-[#004269]/10 text-[#004269]'; // Mid (Indigo Dye)
                                    }
                                @endphp
                                <span class="px-3 py-1 rounded-full text-xs font-bold {{ $ipsClass }}">
                                    {{ number_format($mhs->ips, 2) }}
                                </span>
                            </td>
                            <td class="px-6 py-4 text-center">
                                {{-- Tombol Print Individual: Style bulat Fiery Rose --}}
                                <div class="flex justify-center">
                                    <a href="{{ route('admin.khs.print.student', ['nipd' => $mhs->nipd, 'semester' => $semester, 'tahun_akademik' => $tahun_akademik]) }}" 
                                       target="_blank"
                                       class="p-2 bg-[#F15B67]/10 text-[#F15B67] rounded-full hover:bg-[#F15B67] hover:text-white transition shadow-sm" 
                                       title="Cetak KHS">
                                        <x-heroicon-o-printer class="w-4 h-4" />
                                    </a>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="px-6 py-10 text-center text-[#FF0000] italic font-medium">
                                Tidak ada data mahasiswa. Silakan pilih filter atau cek data kembali.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection