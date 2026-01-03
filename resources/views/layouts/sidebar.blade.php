{{-- resources/views/layouts/_sidebar.blade.php --}}

{{-- HANYA ISI MENU. WRAPPER UTAMA DAN LOGO SUDAH ADA DI LAYOUTS/APP.BLADE.PHP --}}

{{-- Menu List --}}
<nav class="sidebar-menu-list flex flex-col gap-1"> 
    
    {{-- 1. Dashboard --}}
    <a href="{{ route('admin.dashboard') ?? '#' }}" 
        class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
        <x-heroicon-o-squares-2x2 class="w-5 h-5 mr-3" />
        Dashboard
    </a>
    
    {{-- 2. Data Master (Parent with Submenu) --}}
    <div class="menu-group">
        <a href="#" 
            class="nav-link submenu-toggle {{ request()->routeIs(['admin.mahasiswa.index', 'admin.dosen.index', 'admin.kelola_matkul']) ? 'active' : '' }}" 
            data-target="data-master-submenu">
            <x-heroicon-o-folder class="w-5 h-5 mr-3" />
            Data Master
            <x-heroicon-o-chevron-right class="w-4 h-4 ml-auto arrow-icon transition-transform duration-200" />
        </a>
        
        <div id="data-master-submenu" class="submenu">
            {{-- 2.1 Kelola Mahasiswa --}}
            <a href="{{ route('admin.mahasiswa.index') ?? '#' }}" 
                class="nav-link {{ request()->routeIs('admin.mahasiswa.index') ? 'active' : '' }}">
                <x-heroicon-o-users class="w-5 h-5 mr-3" />
                Mahasiswa
            </a>
            
            {{-- 2.2 Kelola Dosen --}}
            <a href="{{ route('admin.dosen.index') ?? '#' }}" 
                class="nav-link {{ request()->routeIs('admin.dosen.index') ? 'active' : '' }}">
                <x-heroicon-o-academic-cap class="w-5 h-5 mr-3" />
                Dosen
            </a>

            {{-- 2.3 Kelola Mata Kuliah --}}
            <a href="{{ route('admin.kelola_matkul') ?? '#' }}" 
                class="nav-link {{ request()->routeIs('admin.kelola_matkul') ? 'active' : '' }}">
                <x-heroicon-o-book-open class="w-5 h-5 mr-3" />
                Mata Kuliah
            </a>
        </div>
    </div>

    {{-- 3. KRS --}}
    <a href="{{ route('admin.krs.index') ?? '#' }}" 
        class="nav-link {{ request()->routeIs('admin.krs.*') ? 'active' : '' }}">
        <x-heroicon-o-document-text class="w-5 h-5 mr-3" />
        KRS
    </a>

    {{-- 4. KHS --}}
    <a href="{{ route('admin.khs.index') ?? '#' }}" 
        class="nav-link {{ request()->routeIs('admin.khs.*') ? 'active' : '' }}">
        <x-heroicon-o-clipboard-document-check class="w-5 h-5 mr-3" />
        KHS
    </a>

    {{-- 5. Kelola Jadwal --}}
    <a href="{{ route('admin.kelola_jadwal') ?? '#' }}" 
        class="nav-link {{ request()->routeIs('admin.kelola_jadwal') ? 'active' : '' }}">
        <x-heroicon-o-calendar class="w-5 h-5 mr-3" />
        Jadwal
    </a>

</nav>
{{-- END OF SIDEBAR CONTENT --}}