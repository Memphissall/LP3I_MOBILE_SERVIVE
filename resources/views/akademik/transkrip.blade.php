@extends('layouts.app')

@section('page-title', 'Manajemen Transkrip Akademik')
@section('page-description', 'Rekapitulasi nilai akhir mahasiswa per semester.')

@section('content')
<div class="p-6">

    {{-- Container Filter Utama --}}
    <div class="bg-white p-6 rounded-xl shadow-lg mb-6 border-t-4 border-[#004269]">
        <h2 class="text-lg font-semibold text-[#004269] mb-4">Filter Pencarian</h2>
        
        <form method="GET" action="{{ route('admin.transkrip.index') }}">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                {{-- Filter Kelas --}}
                <div class="flex flex-col space-y-1">
                    <label class="text-sm font-medium text-gray-600">Kelas</label>
                    <select name="id_kelas" id="filter-kelas" class="p-2 border rounded-lg outline-none text-sm text-gray-700 bg-gray-50 focus:border-[#009DA5] focus:ring-1 focus:ring-[#009DA5]">
                        <option value="">Semua Kelas</option>
                        @foreach($kelasList as $kelas)
                            <option value="{{ $kelas->id_kelas }}" {{ $id_kelas == $kelas->id_kelas ? 'selected' : '' }}>
                                {{ $kelas->nama_kelas }} - {{ $kelas->programStudi->nama_program_studi ?? '' }}
                            </option>
                        @endforeach
                    </select>
                </div>

                {{-- Filter Tahun Akademik --}}
                <div class="flex flex-col space-y-1">
                    <label class="text-sm font-medium text-gray-600">Tahun Akademik</label>
                    <select name="tahun_akademik" id="filter-tahun-akademik" class="p-2 border rounded-lg outline-none text-sm text-gray-700 bg-gray-50 focus:border-[#009DA5] focus:ring-1 focus:ring-[#009DA5]">
                        <option value="">Semua Tahun Akademik</option>
                        @foreach($tahunAkademikList as $ta)
                            <option value="{{ $ta }}" {{ $tahun_akademik == $ta ? 'selected' : '' }}>{{ $ta }}</option>
                        @endforeach
                    </select>
                </div>

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
        <div class="p-6 border-b bg-gradient-to-r from-[#004269] to-[#009DA5]">
            <div class="flex justify-between items-center">
                <h3 class="text-lg font-bold text-white">Daftar Mahasiswa</h3>
                @if($id_kelas && count($mahasiswaList) > 0)
                    <a href="{{ route('admin.transkrip.print.batch', ['id_kelas' => $id_kelas]) }}" target="_blank" class="!bg-white !text-[#004269] px-4 py-2 rounded-lg font-semibold hover:!bg-gray-100 transition flex items-center">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"/>
                        </svg>
                        Print Batch
                    </a>
                @endif
            </div>
        </div>

        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">NO</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">NIPD</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama Mahasiswa</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Kelas</th>
                        <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Jml Semester</th>
                        <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Total BK</th>
                        <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">IPK</th>
                        <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse($mahasiswaList as $index => $mhs)
                        <tr class="hover:bg-gray-50 transition">
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $loop->iteration }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{ $mhs->nipd }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $mhs->nama_mhs }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">
                                {{ $mhs->data_kelas->nama_kelas ?? '-' }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-center text-gray-900">{{ $mhs->jml_semester ?? 0 }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-center font-semibold text-gray-900">{{ $mhs->total_sks }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-center">
                                <span class="px-3 py-1 rounded-full text-sm font-bold 
                                    {{ $mhs->ipk >= 3.5 ? 'bg-green-100 text-green-800' : 
                                       ($mhs->ipk >= 3.0 ? 'bg-blue-100 text-blue-800' : 
                                       ($mhs->ipk >= 2.5 ? 'bg-yellow-100 text-yellow-800' : 'bg-red-100 text-red-800')) }}">
                                    {{ number_format($mhs->ipk, 2) }}
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-center text-sm font-medium">
                                <a href="{{ route('admin.transkrip.print.student', $mhs->nipd) }}" target="_blank" class="text-[#009DA5] hover:text-[#00888f] font-semibold flex items-center justify-center">
                                    <svg class="w-5 h-5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"/>
                                    </svg>
                                    Print
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="px-6 py-12 text-center text-gray-500">
                                <div class="flex flex-col items-center">
                                    <svg class="w-16 h-16 text-gray-400 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                    </svg>
                                    <p class="text-lg font-semibold">Pilih kelas untuk melihat data transkrip nilai</p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
