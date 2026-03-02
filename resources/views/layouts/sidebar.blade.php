{{-- resources/views/layouts/_sidebar.blade.php --}}

<nav class="sidebar-menu-list flex flex-col gap-1 pb-20"> 

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
               Pendidik
            </a>

            {{-- 2.3 Materi Ajar --}}
            <a href="{{ route('admin.kelola_matkul') ?? '#' }}" 
               class="flex items-center px-4 py-2 text-sm rounded-lg transition-all duration-200 group
               {{ request()->routeIs('admin.kelola_matkul') ? 'text-white bg-white/10 font-semibold' : 'text-gray-400 hover:text-white hover:bg-white/5' }}">
               <span class="w-1.5 h-1.5 rounded-full mr-3 {{ request()->routeIs('admin.kelola_matkul') ? 'bg-[#009DA5]' : 'bg-gray-500 group-hover:bg-[#009DA5]' }}"></span>
               Materi Ajar
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
           {{ request()->routeIs(['admin.krs.*', 'admin.khs.*', 'admin.kelola_jadwal', 'admin.transkrip.*', 'admin.rekap_absensi.*']) 
              ? 'bg-white/10 text-white' 
              : 'text-gray-400 hover:text-white hover:bg-white/5' }}" 
           data-target="akademik-submenu">
            <div class="flex items-center">
                <x-heroicon-o-academic-cap class="w-5 h-5 mr-3 {{ request()->routeIs(['admin.krs.*', 'admin.khs.*', 'admin.kelola_jadwal', 'admin.transkrip.*', 'admin.rekap_absensi.*']) ? 'text-[#009DA5]' : 'group-hover:text-[#009DA5] transition-colors' }}" />
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

            {{-- 3.5 Rekap Absensi --}}
            <a href="{{ route('admin.rekap_absensi.index') ?? '#' }}" 
               class="flex items-center px-4 py-2 text-sm rounded-lg transition-all duration-200 group
               {{ request()->routeIs('admin.rekap_absensi.*') ? 'text-white bg-white/10 font-semibold' : 'text-gray-400 hover:text-white hover:bg-white/5' }}">
               <span class="w-1.5 h-1.5 rounded-full mr-3 {{ request()->routeIs('admin.rekap_absensi.*') ? 'bg-[#009DA5]' : 'bg-gray-500 group-hover:bg-[#009DA5]' }}"></span>
               Rekap Absensi
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