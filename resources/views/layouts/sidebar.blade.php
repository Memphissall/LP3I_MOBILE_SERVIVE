{{-- resources/views/layouts/_sidebar.blade.php --}}

{{-- HANYA ISI MENU. WRAPPER UTAMA DAN LOGO SUDAH ADA DI LAYOUTS/APP.BLADE.PHP --}}

{{-- Menu List --}}
{{-- Logika tinggi/overflow dipindahkan ke layouts.app.blade.php --}}
<nav class="sidebar-menu-list flex flex-col gap-1"> 
    
    {{-- 1. Dashboard --}}
    <a href="{{ route('admin.dashboard') ?? '#' }}" 
        class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
        <i data-lucide="layout-dashboard" class="w-5 h-5 mr-3"></i>
        Dashboard
    </a>
    
    {{-- 2. Menu Kelola Mahasiswa --}}
    <div class="menu-group">
        <a href="javascript:void(0);" class="nav-link submenu-toggle 
            {{ request()->routeIs('admin.mahasiswa.index') ? 'expanded active' : '' }}" 
            data-target="submenu-mahasiswa" 
            role="button" aria-expanded="{{ request()->routeIs('admin.mahasiswa.index') ? 'true' : 'false' }}">
            <i data-lucide="users" class="w-5 h-5 mr-3"></i>
            Kelola Mahasiswa
            <i data-lucide="chevron-right" class="w-4 h-4 ml-auto transition-transform duration-300 arrow-icon"></i> 
        </a>
        
        <div id="submenu-mahasiswa" class="submenu 
            {{ request()->routeIs('admin.mahasiswa.index') ? 'show' : '' }}">
            
            <a href="{{ route('admin.mahasiswa.index') ?? '#' }}" 
                class="nav-link {{ request()->routeIs('admin.mahasiswa.index') ? 'active' : '' }}">
                <i data-lucide="user-check" class="w-5 h-5 mr-3"></i> Daftar Mahasiswa
            </a>
        </div>
    </div>
    
    {{-- 3. Menu Kelola Dosen --}}
    <div class="menu-group">
        <a href="javascript:void(0);" class="nav-link submenu-toggle 
            {{ request()->routeIs('admin.dosen.index') ? 'expanded active' : '' }}" 
            data-target="submenu-dosen" 
            role="button" aria-expanded="{{ request()->routeIs('admin.dosen.index') ? 'true' : 'false' }}">
            <i data-lucide="graduation-cap" class="w-5 h-5 mr-3"></i>
            Kelola Dosen
            <i data-lucide="chevron-right" class="w-4 h-4 ml-auto transition-transform duration-300 arrow-icon"></i> 
        </a>
        
        <div id="submenu-dosen" class="submenu 
            {{ request()->routeIs('admin.dosen.index') ? 'show' : '' }}">
            
            <a href="{{ route('admin.dosen.index') ?? '#' }}" 
                class="nav-link {{ request()->routeIs('admin.dosen.index') ? 'active' : '' }}">
                <i data-lucide="user-check" class="w-5 h-5 mr-3"></i> Daftar Dosen
            </a>
        </div>
    </div>

    {{-- 4. Menu Kelola Mata Kuliah --}}
    <div class="menu-group">
        <a href="javascript:void(0);" class="nav-link submenu-toggle 
            {{ request()->routeIs('admin.kelola_matkul') ? 'expanded active' : '' }}" 
            data-target="submenu-matkul" 
            role="button" aria-expanded="{{ request()->routeIs('admin.kelola_matkul') ? 'true' : 'false' }}">
            <i data-lucide="book-open" class="w-5 h-5 mr-3"></i>
            Kelola Mata Kuliah
            <i data-lucide="chevron-right" class="w-4 h-4 ml-auto transition-transform duration-300 arrow-icon"></i> 
        </a>
        
        <div id="submenu-matkul" class="submenu 
            {{ request()->routeIs('admin.kelola_matkul') ? 'show' : '' }}">
            
            <a href="{{ route('admin.kelola_matkul') ?? '#' }}" 
                class="nav-link {{ request()->routeIs('admin.kelola_matkul') ? 'active' : '' }}">
                <i data-lucide="book" class="w-5 h-5 mr-3"></i> Daftar Mata Kuliah
            </a>
        </div>
    </div>

    {{-- 5. Menu Kelola Jadwal --}}
    <div class="menu-group">
        <a href="javascript:void(0);" class="nav-link submenu-toggle 
            {{ request()->routeIs('admin.kelola_jadwal') ? 'expanded active' : '' }}" 
            data-target="submenu-jadwal" 
            role="button" aria-expanded="{{ request()->routeIs('admin.kelola_jadwal') ? 'true' : 'false' }}">
            <i data-lucide="calendar" class="w-5 h-5 mr-3"></i>
            Kelola Jadwal
            <i data-lucide="chevron-right" class="w-4 h-4 ml-auto transition-transform duration-300 arrow-icon"></i> 
        </a>
        
        <div id="submenu-jadwal" class="submenu 
            {{ request()->routeIs('admin.kelola_jadwal') ? 'show' : '' }}">
            
            <a href="{{ route('admin.kelola_jadwal') ?? '#' }}" 
                class="nav-link {{ request()->routeIs('admin.kelola_jadwal') ? 'active' : '' }}">
                <i data-lucide="clock" class="w-5 h-5 mr-3"></i> Daftar Jadwal
            </a>
        </div>
    </div>

</nav>
{{-- END OF SIDEBAR CONTENT --}}