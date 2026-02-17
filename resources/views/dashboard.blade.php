@extends('layouts.app')

@section('title', 'Dashboard - Sistem Informasi Akademik LP3I')

@section('content')
<div class="bg-gray-50 min-h-screen p-6">
    
    {{-- MAIN LAYOUT --}}
    <div class="space-y-6">

        {{-- A. STATISTIK REAL-TIME (Cards Minimalis) --}}
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            {{-- Mahasiswa --}}
            <div class="bg-gradient-to-br from-[#004269] to-[#003051] p-6 rounded-lg shadow-lg flex justify-between items-center text-white">
                <div>
                    <p class="text-xs font-bold text-white/80 uppercase">Mahasiswa Aktif</p>
                    <h3 class="text-3xl font-bold mt-2">{{ $stats['mahasiswa_aktif'] ?? 0 }}</h3>
                    <p class="text-xs text-white/70 mt-1">dari {{ $stats['total_mahasiswa'] ?? 0 }} Total Mahasiswa</p>
                </div>
                <div class="bg-white/20 p-3 rounded-lg backdrop-blur-sm">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/></svg>
                </div>
            </div>

            {{-- Pendidik --}}
            <div class="bg-gradient-to-br from-[#009DA5] to-[#007a81] p-6 rounded-lg shadow-lg flex justify-between items-center text-white">
                <div>
                    <p class="text-xs font-bold text-white/80 uppercase">Pendidik Aktif</p>
                    <h3 class="text-3xl font-bold mt-2">{{ $stats['pendidik_aktif'] ?? 0 }}</h3>
                    <p class="text-xs text-white/70 mt-1">dari {{ $stats['total_pendidik'] ?? 0 }} Total Pendidik</p>
                </div>
                <div class="bg-white/20 p-3 rounded-lg backdrop-blur-sm">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                </div>
            </div>
        </div>

        {{-- SUPER ADMIN LINK --}}
        <div class="bg-gradient-to-r from-[#F15B67] to-[#ff7682] rounded-lg shadow-lg p-6 flex items-center justify-between text-white">
            <div class="flex items-center space-x-4">
                <div class="bg-white/20 p-4 rounded-lg backdrop-blur-sm">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                    </svg>
                </div>
                <div>
                    <h3 class="text-lg font-bold">Portal Super Admin</h3>
                    <p class="text-white/80 text-sm">Akses ke sistem super administrator LP3I</p>
                </div>
            </div>
            <a href="https://superadmin.lp3i.ac.id" target="_blank" class="bg-white text-[#F15B67] px-6 py-3 rounded-lg font-semibold hover:bg-white/90 hover:shadow-lg transition-all duration-300 transform hover:scale-105 flex items-center space-x-2">
                <span>Buka Portal</span>
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/>
                </svg>
            </a>
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