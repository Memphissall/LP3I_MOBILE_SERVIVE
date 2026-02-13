@extends('layouts.app')

@section('title', 'Dashboard - Sistem Informasi Akademik LP3I')

@section('content')
<div class="bg-gray-50 min-h-screen p-6">
    
    {{-- 1. TOP BAR: Header --}}
    <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-8 gap-4">
        <div>
            <h1 class="text-2xl font-bold text-gray-800 tracking-tight">Dashboard Akademik</h1>
            <nav class="flex text-sm text-gray-500 mt-1">
                <span class="hover:text-[#004269]">Home</span>
                <span class="mx-2">/</span>
                <span class="text-[#004269] font-semibold">Dashboard</span>
            </nav>
        </div>
    </div>

    {{-- 2. MAIN LAYOUT --}}
    <div class="space-y-6">

        {{-- A. STATISTIK REAL-TIME (Cards Minimalis) --}}
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            {{-- Mahasiswa --}}
            <div class="bg-white p-5 rounded-lg border-l-4 border-[#004269] shadow-sm flex justify-between items-center">
                <div>
                    <p class="text-xs font-bold text-gray-400 uppercase">Mahasiswa Aktif</p>
                    <h3 class="text-2xl font-bold text-gray-800 mt-1">{{ $stats['mahasiswa_aktif'] ?? '1,240' }}</h3>
                    <p class="text-xs text-gray-500 mt-1">Total: {{ $stats['total_mahasiswa'] ?? '1,500' }}</p>
                </div>
                <div class="bg-blue-50 p-2 rounded text-[#004269]">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/></svg>
                </div>
            </div>

            {{-- Pendidik --}}
            <div class="bg-white p-5 rounded-lg border-l-4 border-[#009DA5] shadow-sm flex justify-between items-center">
                <div>
                    <p class="text-xs font-bold text-gray-400 uppercase">Total Pendidik</p>
                    <h3 class="text-2xl font-bold text-gray-800 mt-1">{{ $stats['total_pendidik'] ?? '85' }}</h3>
                    <p class="text-xs text-green-600 mt-1 flex items-center">
                        <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        Dosen & Tenaga Pengajar
                    </p>
                </div>
                <div class="bg-teal-50 p-2 rounded text-[#009DA5]">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                </div>
            </div>

            {{-- Kelas / Jadwal --}}
            <div class="bg-white p-5 rounded-lg border-l-4 border-amber-500 shadow-sm flex justify-between items-center">
                <div>
                    <p class="text-xs font-bold text-gray-400 uppercase">Kelas Hari Ini</p>
                    <h3 class="text-2xl font-bold text-gray-800 mt-1">24 <span class="text-sm font-normal text-gray-400">/ 48 Sesi</span></h3>
                    <p class="text-xs text-gray-500 mt-1">Ruangan Terpakai: 80%</p>
                </div>
                <div class="bg-amber-50 p-2 rounded text-amber-500">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                </div>
            </div>
        </div>

        {{-- B. QUICK ACCESS MENU (Gaya Grid Icon + Text) --}}
        <div class="bg-white rounded-lg shadow-sm border border-gray-200">
            <div class="px-6 py-4 border-b border-gray-100 flex justify-between items-center">
                <h3 class="font-bold text-gray-800">Menu Cepat Administrasi</h3>
            </div>
            <div class="p-6 grid grid-cols-2 md:grid-cols-4 gap-6">
                {{-- Item 1 --}}
                <a href="{{ route('admin.krs.index') }}" class="group flex flex-col items-center p-4 rounded-lg hover:bg-gray-50 transition border border-transparent hover:border-gray-200">
                    <div class="w-10 h-10 bg-blue-100 text-[#004269] rounded-lg flex items-center justify-center mb-3 group-hover:scale-110 transition-transform">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"/></svg>
                    </div>
                    <span class="text-sm font-semibold text-gray-700 text-center">Validasi KRS</span>
                </a>
                {{-- Item 2 --}}
                <a href="{{ route('admin.khs.index') }}" class="group flex flex-col items-center p-4 rounded-lg hover:bg-gray-50 transition border border-transparent hover:border-gray-200">
                    <div class="w-10 h-10 bg-teal-100 text-[#009DA5] rounded-lg flex items-center justify-center mb-3 group-hover:scale-110 transition-transform">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                    </div>
                    <span class="text-sm font-semibold text-gray-700 text-center">Cetak KHS</span>
                </a>
                {{-- Item 3 --}}
                <a href="{{ route('admin.kelola_jadwal') }}" class="group flex flex-col items-center p-4 rounded-lg hover:bg-gray-50 transition border border-transparent hover:border-gray-200">
                    <div class="w-10 h-10 bg-amber-100 text-amber-600 rounded-lg flex items-center justify-center mb-3 group-hover:scale-110 transition-transform">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                    </div>
                    <span class="text-sm font-semibold text-gray-700 text-center">Jadwal Kuliah</span>
                </a>
                {{-- Item 4 --}}
                <a href="{{ route('admin.transkrip.index') }}" class="group flex flex-col items-center p-4 rounded-lg hover:bg-gray-50 transition border border-transparent hover:border-gray-200">
                    <div class="w-10 h-10 bg-indigo-100 text-indigo-600 rounded-lg flex items-center justify-center mb-3 group-hover:scale-110 transition-transform">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.384-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z"/></svg>
                    </div>
                    <span class="text-sm font-semibold text-gray-700 text-center">Transkrip Nilai</span>
                </a>
            </div>
        </div>

        {{-- C. PENGUMUMAN (List Style like Inbox) --}}
        <div class="bg-white rounded-lg shadow-sm border border-gray-200">
            <div class="px-6 py-4 border-b border-gray-100 flex justify-between items-center">
                <h3 class="font-bold text-gray-800">Pengumuman Terbaru</h3>
                <a href="{{ route('admin.pengumuman.index') }}" class="text-xs font-bold text-[#009DA5] hover:underline">Lihat Semua</a>
            </div>
            <div class="divide-y divide-gray-100">
                @forelse($pengumuman as $item)
                {{-- Dynamic Item --}}
                <div class="p-4 hover:bg-gray-50 transition flex items-start">
                    <div class="flex-shrink-0 mt-1">
                        @php
                            $colors = ['bg-blue-100 text-blue-700', 'bg-orange-100 text-orange-700', 'bg-green-100 text-green-700', 'bg-purple-100 text-purple-700'];
                            $randomColor = $colors[$loop->index % count($colors)];
                            $initials = strtoupper(substr($item->judul, 0, 2));
                        @endphp
                        <span class="inline-flex items-center justify-center h-8 w-8 rounded-full {{ $randomColor }}">
                            <span class="text-xs font-medium leading-none">{{ $initials }}</span>
                        </span>
                    </div>
                    <div class="ml-4 flex-1">
                        <p class="text-sm font-medium text-gray-900">{{ $item->judul }}</p>
                        <p class="text-xs text-gray-500 mt-1 line-clamp-1">{{ Str::limit(strip_tags($item->isi), 80) }}</p>
                        <div class="mt-2 flex items-center text-xs text-gray-400">
                            <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                            {{ $item->created_at->diffForHumans() }}
                        </div>
                    </div>
                </div>
                @empty
                <div class="p-8 text-center text-gray-400 text-sm">
                    Belum ada pengumuman terbaru
                </div>
                @endforelse
            </div>
        </div>

    </div>
</div>
@endsection