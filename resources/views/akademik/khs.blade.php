@extends('layouts.app')

@section('content')
<div class="p-6">
    {{-- Header Page --}}
    <div class="flex justify-between items-center mb-8">
        <div>
            <h1 class="text-2xl font-extrabold text-[#004269] tracking-tight">Manajemen Kartu Hasil Studi (KHS)</h1>
            <p class="text-sm text-gray-500 mt-1">Pantau hasil studi, nilai IPS, dan cetak KHS mahasiswa.</p>
        </div>
    </div>

    {{-- 1. Container Filter Utama (REMASTERED) --}}
    <div class="bg-white rounded-2xl shadow-xl shadow-gray-200/50 mb-8 overflow-hidden relative border border-gray-100">
        {{-- Decorative Top Bar --}}
        <div class="h-1.5 w-full bg-gradient-to-r from-[#004269] via-[#00536e] to-[#009DA5]"></div>

        <div class="p-6 md:p-8">
            {{-- Header Filter --}}
            <div class="flex items-center space-x-3 mb-6 border-b border-gray-100 pb-4">
                <div class="bg-[#004269]/10 p-2.5 rounded-xl text-[#004269]">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
                    </svg>
                </div>
                <div>
                    <h2 class="text-lg font-bold text-gray-800">Filter Data KHS</h2>
                    <p class="text-xs text-gray-400 font-medium">Tentukan parameter pencarian data</p>
                </div>
            </div>

            <form method="GET" action="{{ route('admin.khs.index') }}">
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                    {{-- Filter Kelas --}}
                    <div class="group">
                        <label class="block text-xs font-bold text-gray-500 uppercase tracking-wider mb-2 flex items-center">
                            <svg class="w-4 h-4 mr-1.5 text-[#009DA5]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/></svg>
                            Kelas
                        </label>
                        <div class="relative">
                            <select name="id_kelas" id="filter-kelas" class="w-full p-3 pl-4 text-sm font-medium text-gray-700 bg-gray-50 border border-gray-200 rounded-xl outline-none focus:bg-white focus:border-[#009DA5] focus:ring-4 focus:ring-[#009DA5]/10 transition-all duration-200 appearance-none cursor-pointer hover:border-gray-300">
                                <option value="">Semua Kelas</option>
                                @foreach($kelasList as $kelas)
                                    <option value="{{ $kelas->id_kelas }}" {{ $id_kelas == $kelas->id_kelas ? 'selected' : '' }}>
                                        {{ $kelas->nama_kelas }} - {{ $kelas->bidangKeahlian->nama ?? '' }}
                                    </option>
                                @endforeach
                            </select>
                            <div class="absolute inset-y-0 right-0 flex items-center px-3 pointer-events-none text-gray-400 group-hover:text-[#004269] transition-colors">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                            </div>
                        </div>
                    </div>

                    {{-- Filter Semester --}}
                    <div class="group">
                        <label class="block text-xs font-bold text-gray-500 uppercase tracking-wider mb-2 flex items-center">
                            <svg class="w-4 h-4 mr-1.5 text-[#009DA5]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                            Semester
                        </label>
                        <div class="relative">
                            <select name="semester" id="filter-semester" class="w-full p-3 pl-4 text-sm font-medium text-gray-700 bg-gray-50 border border-gray-200 rounded-xl outline-none focus:bg-white focus:border-[#009DA5] focus:ring-4 focus:ring-[#009DA5]/10 transition-all duration-200 appearance-none cursor-pointer hover:border-gray-300">
                                <option value="">Semua Semester</option>
                                @for($i = 1; $i <= 8; $i++)
                                    <option value="{{ $i }}" {{ $semester == $i ? 'selected' : '' }}>Semester {{ $i }}</option>
                                @endfor
                            </select>
                            <div class="absolute inset-y-0 right-0 flex items-center px-3 pointer-events-none text-gray-400 group-hover:text-[#004269] transition-colors">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                            </div>
                        </div>
                    </div>

                    {{-- Filter Tahun Akademik --}}
                    <div class="group">
                        <label class="block text-xs font-bold text-gray-500 uppercase tracking-wider mb-2 flex items-center">
                            <svg class="w-4 h-4 mr-1.5 text-[#009DA5]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                            Tahun Akademik
                        </label>
                        <div class="relative">
                            <select name="tahun_akademik" id="filter-tahun-akademik" class="w-full p-3 pl-4 text-sm font-medium text-gray-700 bg-gray-50 border border-gray-200 rounded-xl outline-none focus:bg-white focus:border-[#009DA5] focus:ring-4 focus:ring-[#009DA5]/10 transition-all duration-200 appearance-none cursor-pointer hover:border-gray-300">
                                <option value="">Semua Tahun</option>
                                @foreach($tahunAkademikList as $ta)
                                    <option value="{{ $ta }}" {{ $tahun_akademik == $ta ? 'selected' : '' }}>{{ $ta }}</option>
                                @endforeach
                            </select>
                            <div class="absolute inset-y-0 right-0 flex items-center px-3 pointer-events-none text-gray-400 group-hover:text-[#004269] transition-colors">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                            </div>
                        </div>
                    </div>

                    {{-- Action Button --}}
                    <div class="flex items-end">
                        <button type="submit" class="w-full relative overflow-hidden group bg-[#004269] hover:bg-[#003350] text-white py-3 rounded-xl font-bold transition-all duration-300 shadow-[0_4px_14px_0_rgba(0,66,105,0.39)] hover:shadow-[0_6px_20px_rgba(0,66,105,0.23)] hover:-translate-y-1 active:translate-y-0 flex items-center justify-center">
                            <span class="absolute right-0 w-8 h-32 -mt-12 transition-all duration-1000 transform translate-x-12 bg-white opacity-10 rotate-12 group-hover:-translate-x-40 ease"></span>
                            <svg class="w-5 h-5 mr-2 animate-pulse" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                            Tampilkan Data
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    {{-- 2. Table Section (COMPACT & BOLD) --}}
    <div class="bg-white rounded-2xl shadow-xl shadow-gray-200/50 overflow-hidden mb-6 border border-gray-100">
        {{-- Header Tabel with Gradient --}}
        <div class="p-5 border-b bg-gradient-to-r from-[#004269] to-[#009DA5]">
            <div class="flex flex-col md:flex-row justify-between items-center gap-4">
                <div class="flex items-center space-x-3">
                    <div class="bg-white/20 p-2 rounded-lg backdrop-blur-sm">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                    </div>
                    <h3 class="text-xl font-bold text-white tracking-wide">Daftar Mahasiswa <span class="bg-white/20 px-2 py-0.5 rounded text-sm font-mono ml-2">{{ count($mahasiswaList) }}</span></h3>
                </div>

                {{-- BATCH ACTION --}}
                @if($id_kelas && count($mahasiswaList) > 0)
                    <div class="flex space-x-3">
                        <a href="{{ route('admin.khs.print.batch', ['id_kelas' => $id_kelas, 'semester' => $semester, 'tahun_akademik' => $tahun_akademik]) }}" target="_blank" class="bg-white text-[#004269] px-4 py-2 rounded-lg font-bold hover:bg-gray-50 transition-all duration-200 shadow-lg shadow-black/10 flex items-center transform hover:scale-105 active:scale-95 text-sm">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"/>
                            </svg>
                            Print Batch KHS
                        </a>
                    </div>
                @endif
            </div>
        </div>

        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-3 py-3 text-center text-sm font-extrabold text-[#004269] uppercase tracking-wider w-12 border-b-2 border-gray-200">No</th>
                        <th class="px-3 py-3 text-left text-sm font-extrabold text-[#004269] uppercase tracking-wider w-[120px] border-b-2 border-gray-200">NIPD</th>
                        <th class="px-3 py-3 text-left text-sm font-extrabold text-[#004269] uppercase tracking-wider min-w-[200px] border-b-2 border-gray-200">Nama Mahasiswa</th>
                        <th class="px-3 py-3 text-center text-sm font-extrabold text-[#004269] uppercase tracking-wider border-b-2 border-gray-200">Kelas</th>
                        <th class="px-3 py-3 text-center text-sm font-extrabold text-[#004269] uppercase tracking-wider w-[100px] border-b-2 border-gray-200">Jml MK</th>
                        <th class="px-3 py-3 text-center text-sm font-extrabold text-[#004269] uppercase tracking-wider w-[100px] border-b-2 border-gray-200">Total SKS</th>
                        <th class="px-3 py-3 text-center text-sm font-extrabold text-[#004269] uppercase tracking-wider w-[100px] border-b-2 border-gray-200">IPS</th>
                        <th class="px-3 py-3 text-center text-sm font-extrabold text-[#004269] uppercase tracking-wider w-[80px] border-b-2 border-gray-200">Aksi</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-100 text-sm">
                    @forelse($mahasiswaList as $index => $mhs)
                        <tr class="hover:bg-gray-50 transition-colors duration-200 group border-b border-gray-100 last:border-b-0">
                            <td class="px-3 py-3 text-center font-bold text-gray-500">
                                {{ $index + 1 }}
                            </td>
                            <td class="px-3 py-3 whitespace-nowrap">
                                <span class="font-mono text-xs text-[#004269] font-bold bg-[#004269]/5 px-1.5 py-0.5 rounded border border-[#004269]/10">{{ $mhs->nipd }}</span>
                            </td>
                            <td class="px-3 py-3">
                                <div class="text-xs font-bold text-gray-800 group-hover:text-[#004269] transition-colors">{{ $mhs->nama }}</div>
                            </td>
                            <td class="px-3 py-3 text-center">
                                @if($mhs->data_kelas)
                                    <span class="inline-flex items-center px-2 py-0.5 rounded-full text-[10px] font-bold bg-[#004269]/10 text-[#004269] uppercase tracking-wide">
                                        {{ $mhs->data_kelas->nama_kelas }}
                                    </span>
                                @else
                                    <span class="text-gray-400">-</span>
                                @endif
                            </td>
                            <td class="px-3 py-3 text-center text-xs font-bold text-gray-600">
                                {{ $mhs->nilai_count }}
                            </td>
                            <td class="px-3 py-3 text-center text-xs font-bold text-gray-600">
                                {{ $mhs->total_sks }}
                            </td>
                            <td class="px-3 py-3 text-center">
                                @php
                                    // Logika Warna Badge IPS
                                    $ipsClass = 'bg-[#F15B67]/10 text-[#F15B67] border border-[#F15B67]/20'; // Default/Low
                                    if ($mhs->ips >= 3.50) {
                                        $ipsClass = 'bg-[#009DA5]/10 text-[#009DA5] border border-[#009DA5]/20'; // High
                                    } elseif ($mhs->ips >= 3.00) {
                                        $ipsClass = 'bg-[#004269]/10 text-[#004269] border border-[#004269]/20'; // Mid
                                    }
                                @endphp
                                <span class="px-2 py-1 rounded-md text-xs font-extrabold {{ $ipsClass }}">
                                    {{ number_format($mhs->ips, 2) }}
                                </span>
                            </td>
                            <td class="px-3 py-3 text-center whitespace-nowrap">
                                <div class="flex justify-center">
                                    <a href="{{ route('admin.khs.print.student', ['nipd' => $mhs->nipd, 'semester' => $semester, 'tahun_akademik' => $tahun_akademik]) }}" 
                                       target="_blank"
                                       class="p-1.5 bg-[#F15B67]/10 text-[#F15B67] rounded-lg hover:bg-[#F15B67] hover:text-white transition-all duration-200 shadow-sm hover:shadow-md" 
                                       title="Cetak KHS Individual">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"/></svg>
                                    </a>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="px-6 py-12 text-center">
                                <div class="flex flex-col items-center justify-center">
                                    <div class="bg-gray-50 rounded-full p-6 mb-4">
                                        <svg class="w-12 h-12 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                    </div>
                                    <h3 class="text-lg font-medium text-gray-900">Data Tidak Ditemukan</h3>
                                    <p class="text-gray-500 mt-1">Silakan pilih filter kelas, semester, dan tahun akademik.</p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="bg-gray-50 px-6 py-3 border-t border-gray-100 flex justify-between items-center">
            <span class="text-xs text-gray-500 font-medium">Menampilkan data KHS mahasiswa.</span>
        </div>
    </div>
</div>
@endsection