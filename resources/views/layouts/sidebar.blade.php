{{-- resources/views/layouts/_sidebar.blade.php --}}

<nav class="sidebar-menu-list flex flex-col gap-1 pb-20"> 

    {{-- USER PROFILE WIDGET --}}
    <div class="px-4 pb-6 pt-2 mb-2 border-b border-white/10">
        <div class="flex items-center gap-3 p-3 bg-white/5 rounded-xl border border-white/5 backdrop-blur-sm group hover:bg-white/10 transition-all cursor-pointer">
            <div class="w-10 h-10 rounded-full bg-gradient-to-br from-[#009DA5] to-[#004269] flex items-center justify-center text-white font-bold shadow-lg border border-white/20 group-hover:scale-105 transition-transform">
                {{ strtoupper(substr(session('user_name', 'A'), 0, 1)) }}
            </div>
            <div class="overflow-hidden">
                <h3 class="text-sm font-bold text-white truncate">{{ session('user_name', 'Admin Staff') }}</h3>
                <div class="flex items-center mt-0.5">
                    <span class="relative flex h-2 w-2 mr-1.5">
                      <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-green-400 opacity-75"></span>
                      <span class="relative inline-flex rounded-full h-2 w-2 bg-green-500"></span>
                    </span>
                    <p class="text-[10px] text-gray-300 uppercase tracking-wider">Online</p>
                </div>
            </div>
        </div>
    </div>

    {{-- LABEL: MAIN --}}
    <div class="px-6 mb-2 mt-4">
        <p class="text-[10px] font-extrabold text-gray-500 uppercase tracking-widest">Main Menu</p>
    </div>

    {{-- 1. Dashboard --}}
    <a href="{{ route('admin.dashboard') ?? '#' }}" 
       class="mx-3 px-4 py-3 rounded-xl flex items-center transition-all duration-300 group
       {{ request()->routeIs('admin.dashboard') 
          ? 'bg-gradient-to-r from-[#009DA5] to-[#004269] text-white shadow-lg shadow-[#004269]/40' 
          : 'text-gray-400 hover:text-white hover:bg-white/5' }}">
        <x-heroicon-o-squares-2x2 class="w-5 h-5 mr-3 {{ request()->routeIs('admin.dashboard') ? 'text-white' : 'group-hover:text-[#009DA5] transition-colors' }}" />
        <span class="font-medium text-sm">Dashboard</span>
    </a>

    {{-- LABEL: DATA MASTER --}}
    <div class="px-6 mb-2 mt-6">
        <p class="text-[10px] font-extrabold text-gray-500 uppercase tracking-widest">Database</p>
    </div>
    
    {{-- 2. Data Master (Parent) --}}
    <div class="menu-group px-3">
        <a href="#" 
           class="nav-link submenu-toggle px-4 py-3 rounded-xl flex items-center justify-between transition-all duration-300 group
           {{ request()->routeIs(['admin.mahasiswa.*', 'admin.dosen.*', 'admin.kelola_matkul']) 
              ? 'bg-white/10 text-white' 
              : 'text-gray-400 hover:text-white hover:bg-white/5' }}" 
           data-target="data-master-submenu">
            <div class="flex items-center">
                <x-heroicon-o-folder class="w-5 h-5 mr-3 {{ request()->routeIs(['admin.mahasiswa.*', 'admin.dosen.*', 'admin.kelola_matkul']) ? 'text-[#009DA5]' : 'group-hover:text-[#009DA5] transition-colors' }}" />
                <span class="font-medium text-sm">Data Master</span>
            </div>
            <x-heroicon-o-chevron-right class="w-4 h-4 arrow-icon transition-transform duration-200" />
        </a>
        
        <div id="data-master-submenu" class="submenu space-y-1 mt-1 ml-4 border-l border-white/10 pl-3 hidden">
            {{-- 2.1 Mahasiswa --}}
            <a href="{{ route('admin.mahasiswa.index') ?? '#' }}" 
               class="flex items-center px-4 py-2 text-sm rounded-lg transition-all duration-200 group
               {{ request()->routeIs('admin.mahasiswa.*') ? 'text-white bg-white/10 font-semibold' : 'text-gray-400 hover:text-white hover:bg-white/5' }}">
               <span class="w-1.5 h-1.5 rounded-full mr-3 {{ request()->routeIs('admin.mahasiswa.*') ? 'bg-[#009DA5]' : 'bg-gray-500 group-hover:bg-[#009DA5]' }}"></span>
               Mahasiswa
            </a>
            
            {{-- 2.2 Dosen --}}
            <a href="{{ route('admin.dosen.index') ?? '#' }}" 
               class="flex items-center px-4 py-2 text-sm rounded-lg transition-all duration-200 group
               {{ request()->routeIs('admin.dosen.*') ? 'text-white bg-white/10 font-semibold' : 'text-gray-400 hover:text-white hover:bg-white/5' }}">
               <span class="w-1.5 h-1.5 rounded-full mr-3 {{ request()->routeIs('admin.dosen.*') ? 'bg-[#009DA5]' : 'bg-gray-500 group-hover:bg-[#009DA5]' }}"></span>
               Dosen
            </a>

            {{-- 2.3 Mata Kuliah --}}
            <a href="{{ route('admin.kelola_matkul') ?? '#' }}" 
               class="flex items-center px-4 py-2 text-sm rounded-lg transition-all duration-200 group
               {{ request()->routeIs('admin.kelola_matkul') ? 'text-white bg-white/10 font-semibold' : 'text-gray-400 hover:text-white hover:bg-white/5' }}">
               <span class="w-1.5 h-1.5 rounded-full mr-3 {{ request()->routeIs('admin.kelola_matkul') ? 'bg-[#009DA5]' : 'bg-gray-500 group-hover:bg-[#009DA5]' }}"></span>
               Mata Kuliah
            </a>
        </div>
    </div>

    {{-- LABEL: AKADEMIK --}}
    <div class="px-6 mb-2 mt-6">
        <p class="text-[10px] font-extrabold text-gray-500 uppercase tracking-widest">Akademik</p>
    </div>

    {{-- 3. Akademik (Parent) --}}
    <div class="menu-group px-3">
        <a href="#" 
           class="nav-link submenu-toggle px-4 py-3 rounded-xl flex items-center justify-between transition-all duration-300 group
           {{ request()->routeIs(['admin.krs.*', 'admin.khs.*', 'admin.kelola_jadwal', 'admin.transkrip.*']) 
              ? 'bg-white/10 text-white' 
              : 'text-gray-400 hover:text-white hover:bg-white/5' }}" 
           data-target="akademik-submenu">
            <div class="flex items-center">
                <x-heroicon-o-academic-cap class="w-5 h-5 mr-3 {{ request()->routeIs(['admin.krs.*', 'admin.khs.*', 'admin.kelola_jadwal', 'admin.transkrip.*']) ? 'text-[#009DA5]' : 'group-hover:text-[#009DA5] transition-colors' }}" />
                <span class="font-medium text-sm">Administrasi</span>
            </div>
            <x-heroicon-o-chevron-right class="w-4 h-4 arrow-icon transition-transform duration-200" />
        </a>
        
        <div id="akademik-submenu" class="submenu space-y-1 mt-1 ml-4 border-l border-white/10 pl-3 hidden">
            {{-- 3.1 Jadwal --}}
            <a href="{{ route('admin.kelola_jadwal') ?? '#' }}" 
               class="flex items-center px-4 py-2 text-sm rounded-lg transition-all duration-200 group
               {{ request()->routeIs('admin.kelola_jadwal') ? 'text-white bg-white/10 font-semibold' : 'text-gray-400 hover:text-white hover:bg-white/5' }}">
               <span class="w-1.5 h-1.5 rounded-full mr-3 {{ request()->routeIs('admin.kelola_jadwal') ? 'bg-[#009DA5]' : 'bg-gray-500 group-hover:bg-[#009DA5]' }}"></span>
               Jadwal Kuliah
            </a>

            {{-- 3.2 KRS --}}
            <a href="{{ route('admin.krs.index') ?? '#' }}" 
               class="flex items-center px-4 py-2 text-sm rounded-lg transition-all duration-200 group
               {{ request()->routeIs('admin.krs.*') ? 'text-white bg-white/10 font-semibold' : 'text-gray-400 hover:text-white hover:bg-white/5' }}">
               <span class="w-1.5 h-1.5 rounded-full mr-3 {{ request()->routeIs('admin.krs.*') ? 'bg-[#009DA5]' : 'bg-gray-500 group-hover:bg-[#009DA5]' }}"></span>
               KRS (Rencana)
            </a>

            {{-- 3.3 KHS --}}
            <a href="{{ route('admin.khs.index') ?? '#' }}" 
               class="flex items-center px-4 py-2 text-sm rounded-lg transition-all duration-200 group
               {{ request()->routeIs('admin.khs.*') ? 'text-white bg-white/10 font-semibold' : 'text-gray-400 hover:text-white hover:bg-white/5' }}">
               <span class="w-1.5 h-1.5 rounded-full mr-3 {{ request()->routeIs('admin.khs.*') ? 'bg-[#009DA5]' : 'bg-gray-500 group-hover:bg-[#009DA5]' }}"></span>
               KHS (Hasil)
            </a>

            {{-- 3.4 Transkrip --}}
            <a href="{{ route('admin.transkrip.index') ?? '#' }}" 
               class="flex items-center px-4 py-2 text-sm rounded-lg transition-all duration-200 group
               {{ request()->routeIs('admin.transkrip.*') ? 'text-white bg-white/10 font-semibold' : 'text-gray-400 hover:text-white hover:bg-white/5' }}">
               <span class="w-1.5 h-1.5 rounded-full mr-3 {{ request()->routeIs('admin.transkrip.*') ? 'bg-[#009DA5]' : 'bg-gray-500 group-hover:bg-[#009DA5]' }}"></span>
               Transkrip Nilai
            </a>
        </div>
    </div>

    {{-- LABEL: INFO --}}
    <div class="px-6 mb-2 mt-6">
        <p class="text-[10px] font-extrabold text-gray-500 uppercase tracking-widest">Informasi</p>
    </div>

    {{-- 4. Pengumuman --}}
    <a href="{{ route('admin.pengumuman.index') ?? '#' }}" 
       class="mx-3 px-4 py-3 rounded-xl flex items-center transition-all duration-300 group
       {{ request()->routeIs('admin.pengumuman.*') 
          ? 'bg-gradient-to-r from-[#009DA5] to-[#004269] text-white shadow-lg shadow-[#004269]/40' 
          : 'text-gray-400 hover:text-white hover:bg-white/5' }}">
        <x-heroicon-o-megaphone class="w-5 h-5 mr-3 {{ request()->routeIs('admin.pengumuman.*') ? 'text-white' : 'group-hover:text-[#009DA5] transition-colors' }}" />
        <span class="font-medium text-sm">Pengumuman</span>
    </a>

</nav>