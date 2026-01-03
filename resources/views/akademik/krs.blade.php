@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <!-- Header -->
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-gray-800">Manajemen KRS</h1>
        <p class="text-gray-600 mt-2">Kelola Kartu Rencana Studi Mahasiswa</p>
    </div>

    <!-- Filter Section -->
    <div class="bg-white rounded-lg shadow-md p-6 mb-6 border-t-4 border-[#004269]">
        <h3 class="text-lg font-semibold text-[#004269] mb-4">Filter Data</h3>
        <form method="GET" action="{{ route('admin.krs.index') }}" class="grid grid-cols-1 md:grid-cols-4 gap-4">
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Kelas</label>
                <select name="id_kelas" id="filter-id-kelas" class="w-full px-3 py-2 border border-gray-300 rounded-md">
                    <option value="">Semua Kelas</option>
                    @foreach($kelasList as $kelas)
                        <option value="{{ $kelas->id_kelas }}" {{ $id_kelas == $kelas->id_kelas ? 'selected' : '' }}>
                            {{ $kelas->nama_kelas }} - {{ $kelas->bidangKeahlian->nama ?? '' }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Semester</label>
                <select name="semester" id="filter-semester" class="w-full px-3 py-2 border border-gray-300 rounded-md">
                    <option value="">Semua Semester</option>
                    @for($i = 1; $i <= 8; $i++)
                        <option value="{{ $i }}" {{ $semester == $i ? 'selected' : '' }}>Semester {{ $i }}</option>
                    @endfor
                </select>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Tahun Akademik</label>
                <input type="text" name="tahun_akademik" id="filter-tahun-akademik" value="{{ $tahun_akademik }}" 
                    class="w-full px-3 py-2 border border-gray-300 rounded-md" placeholder="2023/2024">
            </div>

            <div class="flex items-end gap-2">
                <button type="submit" class="flex-1 bg-[#004269] hover:bg-[#003350] text-white px-4 py-2 rounded-md transition">
                    Filter
                </button>
            </div>
        </form>
    </div>

    <!-- Actions Bar (Visible if Class is Selected) -->
    @if($id_kelas)
        <div class="flex gap-2 mb-6 justify-end">
            <button id="btn-batch-add" class="bg-[#009DA5] hover:bg-[#00888f] text-white px-4 py-2 rounded-md transition flex items-center gap-2">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                </svg>
                Tambah Paket KRS Kelas
            </button>
            <a href="{{ route('admin.krs.print.batch', ['id_kelas' => $id_kelas, 'semester' => $semester, 'tahun_akademik' => $tahun_akademik]) }}" 
               target="_blank"
               class="bg-[#F15B67] hover:bg-[#d64551] text-white px-4 py-2 rounded-md transition flex items-center gap-2">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"/>
                </svg>
                Print Batch Kelas
            </a>
        </div>
    @endif

    <!-- Mahasiswa Table -->
    <div class="bg-white rounded-lg shadow-md overflow-hidden">
        <table class="w-full">
            <thead class="bg-gray-100">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-bold text-gray-600 uppercase">No</th>
                    <th class="px-6 py-3 text-left text-xs font-bold text-gray-600 uppercase">NIPD</th>
                    <th class="px-6 py-3 text-left text-xs font-bold text-gray-600 uppercase min-w-[250px]">Nama Mahasiswa</th>
                    <th class="px-6 py-3 text-center text-xs font-bold text-gray-600 uppercase">Kelas</th>
                    <th class="px-6 py-3 text-center text-xs font-bold text-gray-600 uppercase">Bidang Keahlian</th>
                    <th class="px-6 py-3 text-center text-xs font-bold text-gray-600 uppercase">Jumlah MK</th>
                    <th class="px-6 py-3 text-center text-xs font-bold text-gray-600 uppercase">Total SKS</th>
                    <th class="px-6 py-3 text-center text-xs font-bold text-gray-600 uppercase">Aksi</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @forelse($mahasiswaList as $index => $mhs)
                    <tr class="hover:bg-gray-50">
                        <td class="px-6 py-4 text-sm text-gray-900">{{ $index + 1 }}</td>
                        <td class="px-6 py-4 text-sm font-medium text-gray-900">{{ $mhs->nipd }}</td>
                        <td class="px-6 py-4 text-sm text-gray-700">{{ $mhs->nama }}</td>
                        <td class="px-6 py-4 text-sm text-center text-gray-700">{{ $mhs->data_kelas->nama_kelas ?? '-' }}</td>
                        <td class="px-6 py-4 text-sm text-center text-gray-700">{{ $mhs->data_kelas->bidangKeahlian->nama ?? '-' }}</td>
                        <td class="px-6 py-4 text-sm text-center text-gray-900">{{ $mhs->krs_count }}</td>
                        <td class="px-6 py-4 text-sm text-center text-gray-900 font-semibold">{{ $mhs->total_sks }}</td>
                        <td class="px-6 py-4 text-sm text-center">
                            <a href="{{ route('admin.krs.print.student', ['nipd' => $mhs->nipd, 'semester' => $semester, 'tahun_akademik' => $tahun_akademik]) }}" 
                               target="_blank"
                               class="text-blue-600 hover:text-blue-800" title="Print KRS">
                                <svg class="w-5 h-5 inline" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"/>
                                </svg>
                            </a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="8" class="px-6 py-12 text-center text-gray-500">
                            Tidak ada data mahasiswa. Silakan pilih kelas atau sesuaikan filter.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

@include('akademik.krs_modal')
@endsection