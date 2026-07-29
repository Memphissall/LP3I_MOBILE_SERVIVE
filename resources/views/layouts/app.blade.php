<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>E-Student | LP3I Karawang</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        [x-cloak] { display: none !important; }
    </style>
    @livewireStyles
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="text-slate-600 antialiased bg-surface">

<div id="loader">
    <div class="spinner"></div>
</div>

<script>
    document.addEventListener("livewire:navigating", () => {
        const loader = document.getElementById("loader");
        loader.style.display = "flex";
        loader.classList.remove("fade-out");
    });

    document.addEventListener("livewire:navigated", () => {
        const loader = document.getElementById("loader");
        loader.classList.add("fade-out");

        setTimeout(() => {
            loader.style.display = "none";
        }, 300);
    });
</script>

    <div x-data="{ isMobileSidebarOpen: false, activeDropdown: null }" class="min-h-screen flex flex-col lg:flex-row">
        <div 
            x-show="isMobileSidebarOpen" 
            @click="isMobileSidebarOpen = false" 
            x-transition:enter="transition-opacity ease-linear duration-300"
            x-transition:enter-start="opacity-0"
            x-transition:enter-end="opacity-100"
            x-transition:leave="transition-opacity ease-linear duration-300"
            x-transition:leave-start="opacity-100"
            x-transition:leave-end="opacity-0"
            class="fixed inset-0 bg-slate-900/60 backdrop-blur-sm z-40 lg:hidden"
            style="display: none;"
        ></div>

        <aside 
            class="fixed inset-y-0 left-0 z-50 w-72 bg-gradient-to-br from-primary to-primary-light text-white transform transition-transform duration-300 ease-in-out lg:translate-x-0 lg:static lg:h-screen flex flex-col shadow-2xl"
            :class="isMobileSidebarOpen ? 'translate-x-0' : '-translate-x-full'">
            {{-- Logo Section --}}
            <div class="h-24 flex items-center px-6 border-b border-white/10 bg-white/5">
                <a href="https://www.lp3i.ac.id" class="flex items-center gap-3 group w-full" target="_blank">
                    {{-- Logo Box Putih agar kontras dengan gradasi biru --}}
                    <div class="w-20 h-20  rounded-xl flex items-center justify-center text-primary shadow-lg transition-transform group-hover:scale-105">
                        <img src="{{ asset('/img/lp3i-biru.png') }}" alt="Logo" class="h-full w-full object-contain">
                    </div>
                <div class="flex flex-col">
                        <div class="text-lg font-bold tracking-tight drop-shadow-sm text-white">
                            <span class="text-white">E |</span> Student
                        </div>
                        
                        <span class="text-[10px] font-semibold text-sky-200 uppercase tracking-wider -mt-1">
                            Information System
                        </span>
                    </div>
                </a>
            </div>

            {{-- Navigation --}}
            <nav class="flex-1 overflow-y-auto sidebar-scroll px-4 py-6 space-y-1">
                
                @php
                    $currentRoute = Route::currentRouteName() ?? 'dashboard';
                    
                    $linkBase = "group flex items-center w-full px-4 py-3 text-sm font-medium rounded-xl transition-all duration-200 ease-in-out border border-transparent";
                    
                    $linkInactive = "text-slate-200 hover:text-white hover:bg-white/10 hover:shadow-inner hover:border-white/5";
                    
                    $linkActive = "bg-white text-primary shadow-lg font-bold ring-1 ring-white/50";
                    
                    $linkDropdownActive = "bg-secondary/40 text-white shadow-inner border-white/10"; 

                    $academicRoutes = ['krs.menu', 'score.index', 'krs.index', 'nilai'];
                    $isAcademicActive = in_array($currentRoute, $academicRoutes);

                    $learningRoutes = ['tugas.index', 'materi', 'ebook.search', 'tugas', 'material.index'];
                    $isLearningActive = in_array($currentRoute, $learningRoutes);
                @endphp

                <div class="px-4 mb-3 mt-1 text-[10px] font-bold text-sky-200/70 uppercase tracking-widest">Menu Utama</div>

                {{-- Dashboard Link --}}
                <a href="{{ route('dashboard') }}" wire:navigate.hover wire:current="bg-white text-primary font-bold"
                class="{{ $linkBase }} {{ $currentRoute == 'dashboard' ? $linkActive : $linkInactive }}">
                    <i class="fas fa-th-large w-5 text-center mr-3 text-lg {{ $currentRoute == 'dashboard' ? 'text-primary' : 'text-sky-200 group-hover:text-white' }}" ></i>
                    Dashboard
                </a>

                <div class="relative mt-1">
                    <button 
                        @click="activeDropdown = (activeDropdown === 'academicDropdown' ? null : 'academicDropdown')"
                        class="{{ $linkBase }} {{ $isAcademicActive ? $linkDropdownActive : $linkInactive }} justify-between">
                        <div class="flex items-center">
                            <i class="fas fa-graduation-cap w-5 text-center mr-3 text-lg {{ $isAcademicActive ? 'text-accent' : 'text-sky-200 group-hover:text-white' }}"></i>
                            Akademik
                        </div>
                        <i class="fas fa-chevron-down text-xs transition-transform duration-200 opacity-70" 
                           :class="activeDropdown === 'academicDropdown' ? 'rotate-180' : ''"></i>
                    </button>
                    
                    <div x-show="activeDropdown === 'academicDropdown'" x-collapse class="pl-4 pr-2 space-y-1 mt-1 bg-black/20 rounded-xl py-2 mx-2 border border-white/5">
                        <a href="{{ route('krs.index') }}" class="block px-4 py-2 text-sm rounded-lg hover:text-white hover:bg-white/5 transition-colors {{ request()->routeIs('krs.*') ? 'text-accent font-bold' : 'text-slate-300' }}" wire:navigate>
                            Kartu Rencana Studi (KRS)
                        </a>
                        <a href="{{ route('nilai') }}" wire:navigate class="block px-4 py-2 text-sm rounded-lg hover:text-white hover:bg-white/5 transition-colors {{ request()->routeIs('nilai') ? 'text-accent font-bold' : 'text-slate-300' }}" wire:navigate>
                            Nilai dan Kartu Hasil Studi (KHS)
                        </a>
                    </div>
                </div>

                <div class="relative mt-1">
                    <button 
                        @click="activeDropdown = (activeDropdown === 'learningDropdown' ? null : 'learningDropdown')"
                        class="{{ $linkBase }} {{ $isLearningActive ? $linkDropdownActive : $linkInactive }} justify-between">
                        <div class="flex items-center">
                            <i class="fas fa-book-open w-5 text-center mr-3 text-lg {{ $isLearningActive ? 'text-accent' : 'text-sky-200 group-hover:text-white' }}"></i>
                            Pembelajaran
                        </div>
                        <i class="fas fa-chevron-down text-xs transition-transform duration-200 opacity-70" 
                           :class="activeDropdown === 'learningDropdown' ? 'rotate-180' : ''"></i>
                    </button>
                    
                    <div x-show="activeDropdown === 'learningDropdown'" x-collapse class="pl-4 pr-2 space-y-1 mt-1 bg-black/20 rounded-xl py-2 mx-2 border border-white/5">
                        <a href="{{ route('tugas') }}" wire:navigate class="block px-4 py-2 text-sm rounded-lg hover:text-white hover:bg-white/5 transition-colors {{ request()->routeIs('tugas') ? 'text-accent font-bold' : 'text-slate-300' }}" wire:navigate>
                            Tugas
                        </a>
                        <a href="{{ route('material.index') }}" wire:navigate class="block px-4 py-2 text-sm rounded-lg hover:text-white hover:bg-white/5 transition-colors {{ request()->routeIs('material.*') ? 'text-accent font-bold' : 'text-slate-300' }}" wire:navigate>
                            Materi Perkuliahan
                        </a>
                    </div>
                </div>

                <div class="px-4 mb-3 mt-8 text-[10px] font-bold text-sky-200/70 uppercase tracking-widest">Keuangan & Info</div>

                {{-- Finance --}}
                <!-- <a href="{{ route('infopembayaran.index') }}"  wire:navigate
                   class="{{ $linkBase }} {{ $currentRoute == 'infopembayaran.index' ? $linkActive : $linkInactive }}" wire:navigate>
                    <i class="fas fa-wallet w-5 text-center mr-3 text-lg {{ $currentRoute == 'infopembayaran.index' ? 'text-primary' : 'text-sky-200 group-hover:text-white' }}"></i>
                    Pembayaran
                </a> -->

                {{-- Announcement --}}
                <a href="{{ route('pengumuman.index') }}" wire:navigate
                class="{{ $linkBase }} {{ $currentRoute == 'pengumuman.index' ? $linkActive : $linkInactive }}" wire:navigate>
                    <i class="fas fa-bullhorn w-5 text-center mr-3 text-lg {{ $currentRoute == 'pengumuman.index' ? 'text-primary' : 'text-sky-200 group-hover:text-white' }}"></i>
                    Pengumuman
                </a>

            </nav>

            {{-- Sidebar Footer (Logout) --}}
            <div class="p-4 border-t border-white/10 bg-black/10">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    {{-- Tombol Logout dengan Gradasi Merah --}}
                    <button type="submit" class="flex items-center justify-center w-full gap-2 px-4 py-3 text-sm font-bold text-white bg-gradient-to-r from-red-600 to-red-700 hover:from-red-500 hover:to-red-600 rounded-xl transition-all duration-200 shadow-lg hover:shadow-red-900/30 ring-1 ring-red-400/30">
                        <i class="fas fa-sign-out-alt"></i>
                        <span>LogOut</span>
                    </button>
                </form>
            </div>
        </aside>

        {{-- MAIN CONTENT --}}
        <main class="flex-1 flex flex-col min-w-0 h-screen overflow-hidden bg-surface">
            
            <header class="h-20 bg-white border-b border-slate-200 sticky top-0 z-30 px-4 lg:px-8 flex items-center justify-between shadow-sm relative">

                {{-- BAGIAN KIRI: Toggle Menu + Logo --}}
                <div class="flex items-center gap-4 z-20">
                    <button @click="isMobileSidebarOpen = true" class="lg:hidden p-2 text-slate-500 hover:bg-slate-100 rounded-lg transition-colors focus:outline-none">
                        <i class="fas fa-bars text-xl"></i>
                    </button>

                    <img src="{{ asset('/img/global.png') }}" alt="Logo" class="h-10 w-auto object-contain hidden lg:block">
                </div>

                {{-- BAGIAN TENGAH: Judul Halaman --}}
                <div class="absolute left-1/2 top-1/2 transform -translate-x-1/2 -translate-y-1/2 w-max text-center pointer-events-none">
                    <h2 class="hidden sm:block text-lg md:text-xl font-bold text-primary tracking-tight whitespace-nowrap">
                        @if(request()->routeIs('dashboard')) Dashboard
                        @elseif(request()->routeIs('krs.*')) Kartu Rencana Studi
                        @elseif(request()->routeIs('nilai')) Informasi Nilai
                        @elseif(request()->routeIs('tugas')) Tugas
                        @elseif(request()->routeIs('profile.mahasiswa')) Profile Mahasiswa
                        @elseif(request()->routeIs('tugas.show')) Detail Tugas
                        @elseif(request()->routeIs('material.index')) Materi Pembelajaran
                        @elseif(request()->routeIs('infopembayaran.index')) Informasi Keuangan
                        @elseif(request()->routeIs('pengumuman.index')) Informasi Perkuliahan
                        @else Halaman Akademik
                        @endif
                    </h2>
                </div>

                {{-- BAGIAN KANAN: Profile --}}
                <div class="flex items-center gap-3 sm:gap-5 z-20" x-data="{ profileOpen: false }">
                    @livewire('notification')
                    <div class="h-8 w-px bg-slate-200 hidden sm:block"></div>
                    <div class="relative">
                        <button @click="profileOpen = !profileOpen" class="flex items-center gap-3 focus:outline-none group">
                            <div class="text-right hidden md:block">
                                <p class="text-sm font-bold text-slate-700 group-hover:text-primary transition-colors">
                                    {{ auth()->user()?->mahasiswa?->nama_mhs ?? 'Guest User' }}
                                </p>
                                <p class="text-[10px] font-bold text-accent uppercase">
                                    {{ auth()->user()?->mahasiswa?->nipd ?? 'Student' }}
                                </p>
                            </div>
                            
                            <div class="relative">
                                <div class="w-9 h-9 sm:w-10 sm:h-10 rounded-full bg-gradient-to-br from-slate-100 to-slate-200 overflow-hidden ring-2 ring-white shadow-md group-hover:ring-primary/20 transition-all">
                                    <img src="{{ auth()->user()?->mahasiswa?->foto
                                            ? asset('storage/image/' . auth()->user()->mahasiswa->foto)
                                            : 'https://ui-avatars.com/api/?name=' . (auth()->user()?->mahasiswa?->nama_mhs ?? 'Guest') . '&background=004269&color=fff' }}" 
                                        class="w-full h-full object-cover" 
                                        alt="Profile">
                                </div>
                            </div>
                            
                            <i class="fas fa-chevron-down text-slate-400 text-xs hidden md:block transition-transform duration-200" :class="{ 'rotate-180': profileOpen }"></i>
                        </button>

                        {{-- Dropdown Profile --}}
                        <div 
                            x-show="profileOpen" 
                            @click.outside="profileOpen = false"
                            x-transition:enter="transition ease-out duration-200"
                            x-transition:enter-start="opacity-0 translate-y-2"
                            x-transition:enter-end="opacity-100 translate-y-0"
                            x-transition:leave="transition ease-in duration-150"
                            x-transition:leave-start="opacity-100 translate-y-0"
                            x-transition:leave-end="opacity-0 translate-y-2"
                            class="absolute right-0 top-full mt-4 w-60 bg-white rounded-xl shadow-2xl border border-slate-100 py-2 z-50 origin-top-right"
                            style="display: none;"
                        >
                            <div class="px-5 py-4 border-b border-slate-50 bg-slate-50/50 block md:hidden">
                                <p class="text-xs text-slate-400 font-bold uppercase mb-1">Login sebagai</p>
                                <p class="text-sm font-bold text-primary truncate">{{ auth()->user()?->mahasiswa->nama_mhs ?? 'Guest' }}</p>
                            </div>

                            <div class="p-2 space-y-1">
                                <a href="{{ route('profile.mahasiswa') }}" wire:navigate class="flex items-center px-3 py-2 text-sm font-medium text-slate-600 hover:text-primary hover:bg-slate-50 rounded-lg transition-colors">
                                    <i class="far fa-user w-5 mr-2 text-slate-400"></i> Profil Saya
                                </a>
                                <!-- <a href="{{ route('profile.edit') }}" class="flex items-center px-3 py-2 text-sm font-medium text-slate-600 hover:text-primary hover:bg-slate-50 rounded-lg transition-colors">
                                    <i data-lucide="settings" class="w-4 h-4 mr-3 text-slate-400"></i> Pengaturan
                                </a> -->
                            </div>
                        </div>
                    </div>
                </div>
            </header>
            
            <div class="flex-1 overflow-y-auto bg-surface relative flex flex-col">
                
                <div class="flex-1 flex flex-col justify-between">

                    <div class="flex-1 p-4 lg:p-8">
                        <div class="max-w-7xl mx-auto space-y-6">
                            {{ $slot ?? '' }}
                            @yield('content')
                        </div>
                    </div>
                    
                    <div class="mt-auto"> 
                        <x-app-footer /> 
                    </div>

                </div>
            </div>

        </main>
    </div>
    
    @livewireScripts
</body>
</html>