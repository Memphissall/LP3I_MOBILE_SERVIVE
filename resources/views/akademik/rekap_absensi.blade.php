@extends('layouts.app')

@section('title', 'Rekap Absensi - E-Academic LP3I')
@section('page-title', 'Rekap Absensi')
@section('page-description', 'Rekap nilai kehadiran mahasiswa per mata kuliah.')

@section('content')
<div class="p-6">

    {{-- Filter Section --}}
    <div class="bg-white p-6 rounded-xl shadow-lg mb-6 border-t-4 border-[#004269]">
        <h2 class="text-lg font-semibold text-[#004269] mb-4">Filter Pencarian</h2>
        
        <form method="GET" action="{{ route('admin.rekap_absensi.index') }}">
            <div class="grid grid-cols-1 md:grid-cols-5 gap-4">

                {{-- Program Studi --}}
                <div class="flex flex-col space-y-1">
                    <label class="text-sm font-medium text-gray-600">Program Studi</label>
                    <select name="id_program_studi" class="p-2 border rounded-lg outline-none text-sm text-gray-700 bg-gray-50 focus:border-[#009DA5] focus:ring-1 focus:ring-[#009DA5]">
                        <option value="">Semua Jurusan</option>
                        @foreach($programStudiList as $ps)
                            <option value="{{ $ps->id_program_studi }}" {{ $id_program_studi == $ps->id_program_studi ? 'selected' : '' }}>
                                {{ $ps->nama_program_studi }}
                            </option>
                        @endforeach
                    </select>
                </div>

                {{-- Kelas --}}
                <div class="flex flex-col space-y-1">
                    <label class="text-sm font-medium text-gray-600">Kelas</label>
                    <select name="id_kelas" class="p-2 border rounded-lg outline-none text-sm text-gray-700 bg-gray-50 focus:border-[#009DA5] focus:ring-1 focus:ring-[#009DA5]">
                        <option value="">Semua Kelas</option>
                        @foreach($kelasList as $kelas)
                            <option value="{{ $kelas->id_kelas }}" {{ $id_kelas == $kelas->id_kelas ? 'selected' : '' }}>
                                {{ $kelas->nama_kelas }}{{ $kelas->programStudi ? ' - ' . $kelas->programStudi->nama_program_studi : '' }}
                            </option>
                        @endforeach
                    </select>
                </div>

                {{-- Angkatan --}}
                <div class="flex flex-col space-y-1">
                    <label class="text-sm font-medium text-gray-600">Tahun Angkatan</label>
                    <select name="angkatan" class="p-2 border rounded-lg outline-none text-sm text-gray-700 bg-gray-50 focus:border-[#009DA5] focus:ring-1 focus:ring-[#009DA5]">
                        <option value="">Semua Angkatan</option>
                        @foreach($angkatanList as $a)
                            <option value="{{ $a }}" {{ $angkatan == $a ? 'selected' : '' }}>{{ $a }}</option>
                        @endforeach
                    </select>
                </div>

                {{-- Semester --}}
                <div class="flex flex-col space-y-1">
                    <label class="text-sm font-medium text-gray-600">Semester</label>
                    <select name="semester" class="p-2 border rounded-lg outline-none text-sm text-gray-700 bg-gray-50 focus:border-[#009DA5] focus:ring-1 focus:ring-[#009DA5]">
                        <option value="">Semua Semester</option>
                        @foreach($semesterList as $sem)
                            <option value="{{ $sem }}" {{ $semester == $sem ? 'selected' : '' }}>Semester {{ $sem }}</option>
                        @endforeach
                    </select>
                </div>

                {{-- Button --}}
                <div class="flex items-end">
                    <button type="submit" class="w-full bg-[#004269] hover:bg-[#003350] text-white px-6 py-2 rounded-lg font-semibold transition shadow-md flex items-center justify-center">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                        </svg>
                        Filter
                    </button>
                </div>

            </div>
        </form>
    </div>

    {{-- Data Table --}}
    <div class="bg-white rounded-xl shadow-lg overflow-hidden border-t-4 border-[#004269]">
        {{-- Table Header --}}
        <div class="p-6 border-b bg-gradient-to-r from-[#004269] to-[#009DA5]">
            <div class="flex justify-between items-center">
                <div>
                    <h3 class="text-lg font-bold text-white">Rekap Nilai Kehadiran</h3>
                    @if($hasFilters)
                        <p class="text-white/70 text-xs mt-1">Total: {{ $mahasiswaRows->count() }} mahasiswa</p>
                    @endif
                </div>
                {{-- Legend --}}
                @if($hasFilters && $mahasiswaRows->count() > 0)
                    <div class="flex items-center gap-3 text-xs text-white/80">
                        <span class="flex items-center gap-1"><span class="w-3 h-3 rounded-sm bg-green-400 inline-block"></span> ≥85</span>
                        <span class="flex items-center gap-1"><span class="w-3 h-3 rounded-sm bg-yellow-400 inline-block"></span> 75–84</span>
                        <span class="flex items-center gap-1"><span class="w-3 h-3 rounded-sm bg-red-400 inline-block"></span> &lt;75</span>
                    </div>
                @endif
            </div>
        </div>

        {{-- Table --}}
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">NO</th>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider min-w-[200px]">NAMA MAHASISWA</th>
                        @foreach($matkulList as $mk)
                            <th class="px-3 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider min-w-[100px]" title="{{ $mk['nama_mk'] }}">
                                {{ strlen($mk['nama_mk']) > 16 ? substr($mk['nama_mk'], 0, 16) . '…' : $mk['nama_mk'] }}
                            </th>
                        @endforeach
                        @if(count($matkulList) > 0)
                            <th class="px-3 py-3 text-center text-xs font-medium text-white uppercase tracking-wider min-w-[90px] bg-[#004269]">RATA-RATA</th>
                        @endif
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @if(!$hasFilters)
                        <tr>
                            <td colspan="20" class="px-6 py-12 text-center text-gray-500">
                                <div class="flex flex-col items-center">
                                    <svg class="w-16 h-16 text-gray-300 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                                    </svg>
                                    <p class="text-lg font-semibold">Pilih filter untuk melihat rekap absensi</p>
                                </div>
                            </td>
                        </tr>
                    @elseif($mahasiswaRows->isEmpty())
                        <tr>
                            <td colspan="20" class="px-6 py-12 text-center text-gray-500">
                                <div class="flex flex-col items-center">
                                    <svg class="w-16 h-16 text-gray-300 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                    </svg>
                                    <p class="text-lg font-semibold">Tidak ada data ditemukan</p>
                                    <p class="text-sm text-gray-400 mt-1">Coba ubah filter pencarian</p>
                                </div>
                            </td>
                        </tr>
                    @else
                        @foreach($mahasiswaRows as $index => $mhs)
                            <tr class="hover:bg-gray-50 transition {{ $index % 2 == 1 ? 'bg-gray-50/50' : '' }}">
                                <td class="px-4 py-3 text-sm text-gray-500">{{ $loop->iteration }}</td>
                                <td class="px-4 py-3 text-sm font-semibold text-gray-800 whitespace-nowrap">{{ $mhs->nama_mhs }}</td>
                                @foreach($matkulList as $mk)
                                    @php $val = $mhs->nilai_per_matkul[$mk['id_mk']] ?? null; @endphp
                                    <td class="px-3 py-3 text-center">
                                        @if($val !== null)
                                            @php
                                                $cls = $val >= 85 ? 'bg-green-100 text-green-700' : ($val >= 75 ? 'bg-yellow-100 text-yellow-700' : 'bg-red-100 text-red-700');
                                            @endphp
                                            <span class="inline-block px-2 py-0.5 rounded text-xs font-bold {{ $cls }}">{{ $val }}</span>
                                        @else
                                            <span class="text-gray-300 text-xs">–</span>
                                        @endif
                                    </td>
                                @endforeach
                                @if(count($matkulList) > 0)
                                    <td class="px-3 py-3 text-center">
                                        @if($mhs->rata_rata !== null)
                                            @php
                                                $avgCls = $mhs->rata_rata >= 85 ? 'bg-green-500 text-white' : ($mhs->rata_rata >= 75 ? 'bg-yellow-500 text-white' : 'bg-red-500 text-white');
                                            @endphp
                                            <span class="inline-block px-3 py-1 rounded-full text-xs font-extrabold {{ $avgCls }}">{{ $mhs->rata_rata }}</span>
                                        @else
                                            <span class="text-gray-300 text-xs">–</span>
                                        @endif
                                    </td>
                                @endif
                            </tr>
                        @endforeach
                    @endif
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
