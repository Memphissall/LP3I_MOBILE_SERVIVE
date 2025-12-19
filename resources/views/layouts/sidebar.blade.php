{{-- resources/views/layouts/sidebar.blade.php --}}

<nav class="sidebar-menu-list flex flex-col gap-1 overflow-y-auto pb-4"> 
    
    {{-- 1. Dashboard --}}
    <a href="{{ route('admin.dashboard') ?? '#' }}" 
        class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
        <i data-lucide="layout-dashboard" class="w-5 h-5 mr-3"></i>
        <span class="font-medium">Dashboard</span>
    </a>
    
    {{-- 2. Kelola Mahasiswa (Tunggal) --}}
    <a href="{{ route('admin.mahasiswa.index') ?? '#' }}" 
        class="nav-link {{ request()->routeIs('admin.mahasiswa.index') ? 'active' : '' }}">
        <i data-lucide="users" class="w-5 h-5 mr-3"></i>
        <span class="font-medium">Kelola Mahasiswa</span>
    </a>
    
    {{-- 3. Kelola Dosen (Tunggal) --}}
    <a href="{{ route('admin.dosen.index') ?? '#' }}" 
        class="nav-link {{ request()->routeIs('admin.dosen.index') ? 'active' : '' }}">
        <i data-lucide="graduation-cap" class="w-5 h-5 mr-3"></i>
        <span class="font-medium">Kelola Dosen</span>
    </a>

    {{-- 4. Kelola Mata Kuliah (Tunggal) --}}
    <a href="{{ route('admin.matakuliah.index') ?? '#' }}" 
        class="nav-link {{ request()->routeIs('admin.matakuliah.index') ? 'active' : '' }}">
        <i data-lucide="book-open-text" class="w-5 h-5 mr-3"></i>
        <span class="font-medium">Kelola Mata Kuliah</span>
    </a>

    {{-- 5. Kelola Jadwal (Tunggal) --}}
    <a href="{{ route('admin.jadwal.index') ?? '#' }}" 
        class="nav-link {{ request()->routeIs('admin.jadwal.index') ? 'active' : '' }}">
        <i data-lucide="calendar-check" class="w-5 h-5 mr-3"></i>
        <span class="font-medium">Kelola Jadwal</span>
    </a>

    {{-- 6. Validasi Absensi (Tunggal) --}}
    <a href="{{ route('admin.validasiAbsensi.index') ?? '#' }}" 
        class="nav-link {{ request()->routeIs('admin.validasiAbsensi.index') ? 'active' : '' }}">
        <i data-lucide="file-check-2" class="w-5 h-5 mr-3"></i>
        <span class="font-medium">Validasi Absensi</span>
    </a>

    {{-- 7. Menu Kelola Laporan (Submenu) --}}
    @php
        $laporanRoutes = ['laporan.mhs.index', 'laporan.dosen.index'];
        $isLaporanGroupActive = request()->routeIs($laporanRoutes);
    @endphp
    <div class="menu-group">
        <a href="javascript:void(0);" class="nav-link submenu-toggle 
            {{ $isLaporanGroupActive ? 'expanded active' : '' }}" 
            data-target="submenu-laporan">
            <i data-lucide="file-text" class="w-5 h-5 mr-3"></i>
            <span class="font-medium">Kelola Laporan</span>
            <i data-lucide="chevron-right" class="w-4 h-4 ml-auto transition-transform duration-300 arrow-icon"></i> 
        </a>
        
        <div id="submenu-laporan" class="submenu {{ $isLaporanGroupActive ? 'show' : '' }} flex flex-col gap-1 mt-1">
            <a href="{{ route('laporan.mhs.index') }}" 
                class="nav-link py-2 pl-9 pr-3 {{ request()->routeIs('laporan.mhs.index') ? 'active' : '' }}">
                <i data-lucide="users" class="w-4 h-4 mr-3"></i> 
                <span class="text-sm">Laporan Mahasiswa</span>
            </a>

            <a href="{{ route('laporan.dosen.index') }}" 
                class="nav-link py-2 pl-9 pr-3 {{ request()->routeIs('laporan.dosen.index') ? 'active' : '' }}">
                <i data-lucide="user-check" class="w-4 h-4 mr-3"></i> 
                <span class="text-sm">Laporan Dosen</span>
            </a>
        </div>
    </div>
</nav>

{{-- SECTION LOGOUT - Jangan sampai ketinggalan lagi --}}
<div class="mt-auto pt-4 border-t border-gray-700"> 
    <form method="POST" action="{{ route('logout') }}"> 
        @csrf
        <button type="submit" class="nav-link text-red-400 hover:bg-red-600 hover:text-white w-full transition-colors duration-200">
            <i data-lucide="log-out" class="w-5 h-5 mr-3"></i>
            <span class="font-medium">Logout</span>
        </button>
    </form>
</div>