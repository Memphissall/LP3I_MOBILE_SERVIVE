@extends('layouts.app')

@section('title', 'Dashboard Akademik')

@section('content')
    {{-- Welcome Header --}}
    <div class="mb-8">
        <h2 class="text-3xl font-bold text-gray-900">Dashboard Akademik</h2>
        <p class="text-gray-600 mt-2">Selamat datang kembali di sistem E-Academic LP3I</p>
    </div>

    {{-- Statistics Cards --}}
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
        {{-- Card Mahasiswa --}}
        <div class="bg-white rounded-xl shadow-sm p-6 border-l-4 border-[#009DA5]">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-500 text-sm font-medium">Total Mahasiswa</p>
                    <h3 class="text-3xl font-bold text-gray-900 mt-2">{{ $stats['total_mahasiswa'] }}</h3>
                    <p class="text-xs text-[#009DA5] mt-1">{{ $stats['mahasiswa_aktif'] }} Aktif</p>
                </div>
                <div class="bg-[#009DA5]/10 p-4 rounded-full">
                    <x-heroicon-o-users class="w-8 h-8 text-[#009DA5]" />
                </div>
            </div>
        </div>

        {{-- Card Dosen --}}
        <div class="bg-white rounded-xl shadow-sm p-6 border-l-4 border-[#004269]">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-500 text-sm font-medium">Total Dosen</p>
                    <h3 class="text-3xl font-bold text-gray-900 mt-2">{{ $stats['total_dosen'] }}</h3>
                    <p class="text-xs text-[#004269] mt-1">{{ $stats['dosen_aktif'] }} Aktif</p>
                </div>
                <div class="bg-[#004269]/10 p-4 rounded-full">
                    <x-heroicon-o-academic-cap class="w-8 h-8 text-[#004269]" />
                </div>
            </div>
        </div>

        {{-- Card Mata Kuliah --}}
        <div class="bg-white rounded-xl shadow-sm p-6 border-l-4 border-[#F15B67]">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-500 text-sm font-medium">Mata Kuliah</p>
                    <h3 class="text-3xl font-bold text-gray-900 mt-2">{{ $stats['total_matkul'] }}</h3>
                    <p class="text-xs text-[#F15B67] mt-1">Terdaftar</p>
                </div>
                <div class="bg-[#F15B67]/10 p-4 rounded-full">
                    <x-heroicon-o-book-open class="w-8 h-8 text-[#F15B67]" />
                </div>
            </div>
        </div>

        {{-- Card Kelas --}}
        <div class="bg-white rounded-xl shadow-sm p-6 border-l-4 border-[#009DA5]">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-500 text-sm font-medium">Total Kelas</p>
                    <h3 class="text-3xl font-bold text-gray-900 mt-2">{{ $stats['total_kelas'] }}</h3>
                    <p class="text-xs text-[#009DA5] mt-1">Tersedia</p>
                </div>
                <div class="bg-[#009DA5]/10 p-4 rounded-full">
                    <x-heroicon-o-building-library class="w-8 h-8 text-[#009DA5]" />
                </div>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        {{-- Recent Mahasiswa --}}
        <div class="bg-white rounded-xl shadow-sm p-6">
            <div class="flex items-center justify-between mb-6">
                <h3 class="text-lg font-semibold text-gray-900">Mahasiswa Terbaru</h3>
                <a href="{{ route('admin.mahasiswa.index') }}" class="text-sm text-[#009DA5] hover:text-[#007a81] font-medium">
                    Lihat Semua →
                </a>
            </div>
            <div class="space-y-4">
                @forelse($stats['recent_mahasiswa'] as $mhs)
                    <div class="flex items-center space-x-4 p-3 hover:bg-gray-50 rounded-lg transition">
                        <div class="w-10 h-10 rounded-full bg-gradient-to-br from-[#004269] to-[#009DA5] flex items-center justify-center text-white font-bold">
                            {{ strtoupper(substr($mhs->nama, 0, 1)) }}
                        </div>
                        <div class="flex-1">
                            <p class="font-medium text-gray-900">{{ $mhs->nama }}</p>
                            <p class="text-sm text-gray-500">{{ $mhs->nipd }} • {{ $mhs->data_kelas->nama_kelas ?? 'Belum ada kelas' }}</p>
                        </div>
                        <span class="text-xs px-2 py-1 rounded-full {{ $mhs->status == 'Aktif' ? 'bg-[#009DA5]/10 text-[#009DA5]' : 'bg-gray-100 text-gray-600' }}">
                            {{ $mhs->status }}
                        </span>
                    </div>
                @empty
                    <p class="text-gray-500 text-center py-4">Belum ada data mahasiswa</p>
                @endforelse
            </div>
        </div>

        {{-- Recent Dosen --}}
        <div class="bg-white rounded-xl shadow-sm p-6">
            <div class="flex items-center justify-between mb-6">
                <h3 class="text-lg font-semibold text-gray-900">Dosen Terbaru</h3>
                <a href="{{ route('admin.dosen.index') }}" class="text-sm text-[#009DA5] hover:text-[#007a81] font-medium">
                    Lihat Semua →
                </a>
            </div>
            <div class="space-y-4">
                @forelse($stats['recent_dosen'] as $dosen)
                    <div class="flex items-center space-x-4 p-3 hover:bg-gray-50 rounded-lg transition">
                        <div class="w-10 h-10 rounded-full bg-gradient-to-br from-[#004269] to-[#009DA5] flex items-center justify-center text-white font-bold">
                            {{ strtoupper(substr($dosen->nama_dosen, 0, 1)) }}
                        </div>
                        <div class="flex-1">
                            <p class="font-medium text-gray-900">{{ $dosen->nama_dosen }}</p>
                            <p class="text-sm text-gray-500">NIDN: {{ $dosen->nidn }} • {{ $dosen->pendidikan }}</p>
                        </div>
                        <span class="text-xs px-2 py-1 rounded-full {{ strtolower($dosen->status) == 'aktif' ? 'bg-[#009DA5]/10 text-[#009DA5]' : 'bg-gray-100 text-gray-600' }}">
                            {{ ucfirst($dosen->status) }}
                        </span>
                    </div>
                @empty
                    <p class="text-gray-500 text-center py-4">Belum ada data dosen</p>
                @endforelse
            </div>
        </div>
    </div>

    {{-- Additional Stats --}}
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mt-6">
        <div class="bg-gradient-to-br from-[#004269] to-[#009DA5] rounded-xl shadow-sm p-6 text-white">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-white/80 text-sm font-medium">Total KRS</p>
                    <h3 class="text-3xl font-bold mt-2">{{ $stats['total_krs'] }}</h3>
                    <p class="text-xs text-white/70 mt-1">Registrasi</p>
                </div>
                <x-heroicon-o-document-text class="w-12 h-12 text-white/30" />
            </div>
        </div>

        <div class="bg-gradient-to-br from-[#F15B67] to-[#ff7682] rounded-xl shadow-sm p-6 text-white">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-white/80 text-sm font-medium">Total Nilai</p>
                    <h3 class="text-3xl font-bold mt-2">{{ $stats['total_nilai'] }}</h3>
                    <p class="text-xs text-white/70 mt-1">Terdata</p>
                </div>
                <x-heroicon-o-clipboard-document-check class="w-12 h-12 text-white/30" />
            </div>
        </div>

        <div class="bg-white rounded-xl shadow-sm p-6 border-2 border-dashed border-gray-300">
            <div class="text-center">
                <x-heroicon-o-chart-bar class="w-12 h-12 text-gray-400 mx-auto mb-2" />
                <p class="text-sm text-gray-600">Sistem Akademik</p>
                <p class="text-2xl font-bold text-gray-900 mt-2">LP3I</p>
                <p class="text-xs text-gray-500 mt-1">E-Academic Platform</p>
            </div>
        </div>
    </div>
@endsection