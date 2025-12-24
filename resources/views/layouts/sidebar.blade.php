{{-- resources/views/layouts/_sidebar.blade.php --}}

{{-- HANYA ISI MENU. WRAPPER UTAMA DAN LOGO SUDAH ADA DI LAYOUTS/APP.BLADE.PHP --}}

{{-- Menu List --}}
<nav class="sidebar-menu-list flex flex-col gap-1"> 
    
    {{-- 1. Dashboard --}}
    <a href="{{ route('admin.dashboard') ?? '#' }}" 
        class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
        <i data-lucide="layout-dashboard" class="w-5 h-5 mr-3"></i>
        Dashboard
    </a>
    
    {{-- 2. Menu Kelola Mahasiswa --}}
    <a href="{{ route('admin.mahasiswa.index') ?? '#' }}" 
        class="nav-link {{ request()->routeIs('admin.mahasiswa.index') ? 'active' : '' }}">
        <i data-lucide="users" class="w-5 h-5 mr-3"></i>
        Kelola Mahasiswa
    </a>
    
    {{-- 3. Menu Kelola Dosen --}}
    <a href="{{ route('admin.dosen.index') ?? '#' }}" 
        class="nav-link {{ request()->routeIs('admin.dosen.index') ? 'active' : '' }}">
        <i data-lucide="graduation-cap" class="w-5 h-5 mr-3"></i>
        Kelola Dosen
    </a>

    {{-- 4. Menu Kelola Mata Kuliah --}}
    <a href="{{ route('admin.kelola_matkul') ?? '#' }}" 
        class="nav-link {{ request()->routeIs('admin.kelola_matkul') ? 'active' : '' }}">
        <i data-lucide="book-open" class="w-5 h-5 mr-3"></i>
        Kelola Mata Kuliah
    </a>

    {{-- 5. Menu Kelola Jadwal --}}
    <a href="{{ route('admin.kelola_jadwal') ?? '#' }}" 
        class="nav-link {{ request()->routeIs('admin.kelola_jadwal') ? 'active' : '' }}">
        <i data-lucide="calendar" class="w-5 h-5 mr-3"></i>
        Kelola Jadwal
    </a>

</nav>
{{-- END OF SIDEBAR CONTENT --}}