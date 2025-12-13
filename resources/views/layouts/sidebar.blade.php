{{-- resources/views/layouts/sidebar.blade.php --}}

{{-- HANYA ISI MENU. WRAPPER UTAMA DAN LOGO SUDAH ADA DI LAYOUTS/APP.BLADE.PHP --}}

{{-- Menu List (Overflow-y-auto untuk scroll jika menu terlalu banyak) --}}
<nav class="sidebar-menu-list flex flex-col gap-1 overflow-y-auto pb-4"> 
    
    {{-- 1. Dashboard --}}
    <a href="{{ route('admin.dashboard') ?? '#' }}" 
        class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
        <i data-lucide="layout-dashboard" class="w-5 h-5 mr-3"></i>
        Dashboard
    </a>
    
    {{-- 2. Menu Kelola Mahasiswa (Dengan Submenu) --}}
    {{-- Tambahkan pemeriksaan route untuk semua submenu di bawah grup ini --}}
    @php
        $mahasiswaRoutes = ['admin.mahasiswa.index'];
        $isMahasiswaGroupActive = request()->routeIs($mahasiswaRoutes);
    @endphp
    <div class="menu-group">
        <a href="javascript:void(0);" class="nav-link submenu-toggle 
            {{ $isMahasiswaGroupActive ? 'expanded active' : '' }}" 
            data-target="submenu-mahasiswa" 
            role="button" aria-expanded="{{ $isMahasiswaGroupActive ? 'true' : 'false' }}">
            <i data-lucide="users" class="w-5 h-5 mr-3"></i>
            Kelola Mahasiswa
            <i data-lucide="chevron-right" class="w-4 h-4 ml-auto transition-transform duration-300 arrow-icon"></i> 
        </a>
        
        <div id="submenu-mahasiswa" class="submenu 
            {{ $isMahasiswaGroupActive ? 'show' : '' }}">
            
            <a href="{{ route('admin.mahasiswa.index') ?? '#' }}" 
                class="nav-link {{ request()->routeIs('admin.mahasiswa.index') ? 'active' : '' }}">
                <i data-lucide="user-check" class="w-5 h-5 mr-3"></i> Daftar Mahasiswa
            </a>
            {{-- Tambahkan submenu lain di sini jika ada (e.g., Import Mahasiswa) --}}
        </div>
    </div>
    
    {{-- 3. Menu Kelola Dosen (Dengan Submenu) --}}
    @php
        $dosenRoutes = ['admin.dosen.index'];
        $isDosenGroupActive = request()->routeIs($dosenRoutes);
    @endphp
    <div class="menu-group">
        <a href="javascript:void(0);" class="nav-link submenu-toggle 
            {{ $isDosenGroupActive ? 'expanded active' : '' }}" 
            data-target="submenu-dosen" 
            role="button" aria-expanded="{{ $isDosenGroupActive ? 'true' : 'false' }}">
            <i data-lucide="graduation-cap" class="w-5 h-5 mr-3"></i>
            Kelola Dosen
            <i data-lucide="chevron-right" class="w-4 h-4 ml-auto transition-transform duration-300 arrow-icon"></i> 
        </a>
        
        <div id="submenu-dosen" class="submenu 
            {{ $isDosenGroupActive ? 'show' : '' }}">
            
            <a href="{{ route('admin.dosen.index') ?? '#' }}" 
                class="nav-link {{ request()->routeIs('admin.dosen.index') ? 'active' : '' }}">
                <i data-lucide="user-check" class="w-5 h-5 mr-3"></i> Daftar Dosen
            </a>
        </div>
    </div>

    {{-- 4. Menu Kelola Mata Kuliah (Dengan Submenu) --}}
    @php
        $matkulRoutes = ['admin.matakuliah.index'];
        $isMatkulGroupActive = request()->routeIs($matkulRoutes);
    @endphp
    <div class="menu-group">
        <a href="javascript:void(0);" class="nav-link submenu-toggle 
            {{ $isMatkulGroupActive ? 'expanded active' : '' }}" 
            data-target="submenu-matkul" 
            role="button" aria-expanded="{{ $isMatkulGroupActive ? 'true' : 'false' }}">
            <i data-lucide="book-open-text" class="w-5 h-5 mr-3"></i>
            Kelola Mata Kuliah
            <i data-lucide="chevron-right" class="w-4 h-4 ml-auto transition-transform duration-300 arrow-icon"></i> 
        </a>
        
        <div id="submenu-matkul" class="submenu 
            {{ $isMatkulGroupActive ? 'show' : '' }}">
            
            <a href="{{ route('admin.matakuliah.index') ?? '#' }}" 
                class="nav-link {{ request()->routeIs('admin.matakuliah.index') ? 'active' : '' }}">
                <i data-lucide="clipboard-list" class="w-5 h-5 mr-3"></i> Daftar Mata Kuliah
            </a>
        </div>
    </div>

    {{-- 5. Menu Kelola Jadwal (Dengan Submenu) --}}
    @php
        $jadwalRoutes = ['admin.jadwal.index'];
        $isJadwalGroupActive = request()->routeIs($jadwalRoutes);
    @endphp
    <div class="menu-group">
        <a href="javascript:void(0);" class="nav-link submenu-toggle 
            {{ $isJadwalGroupActive ? 'expanded active' : '' }}" 
            data-target="submenu-jadwal" 
            role="button" aria-expanded="{{ $isJadwalGroupActive ? 'true' : 'false' }}">
            <i data-lucide="calendar-check" class="w-5 h-5 mr-3"></i>
            Kelola Jadwal
            <i data-lucide="chevron-right" class="w-4 h-4 ml-auto transition-transform duration-300 arrow-icon"></i> 
        </a>
        
        <div id="submenu-jadwal" class="submenu 
            {{ $isJadwalGroupActive ? 'show' : '' }}">
            
            <a href="{{ route('admin.jadwal.index') ?? '#' }}" 
                class="nav-link {{ request()->routeIs('admin.jadwal.index') ? 'active' : '' }}">
                <i data-lucide="table-2" class="w-5 h-5 mr-3"></i> Daftar Jadwal
            </a>
        </div>
    </div>

    {{-- 6. Validasi Absensi (Menu Tunggal, karena Anda memintanya tetap tunggal) --}}
    <a href="{{ route('admin.validasiAbsensi.index') ?? '#' }}" 
        class="nav-link {{ request()->routeIs('admin.validasiAbsensi.index') ? 'active' : '' }}">
        <i data-lucide="file-check-2" class="w-5 h-5 mr-3"></i>
        Validasi Absensi
    </a>
    
</nav>

{{-- Tombol Logout (Selalu di bawah, dipisahkan dengan garis) --}}
<div class="mt-auto pt-4 border-t border-gray-700"> 
    <form method="POST" action="{{ route('logout') }}"> 
        @csrf
        {{-- Styling khusus untuk Logout: warna merah --}}
        <button type="submit" class="nav-link text-red-400 hover:bg-red-600 hover:text-white w-full">
            <i data-lucide="log-out" class="w-5 h-5 mr-3"></i>
            Logout
        </button>
    </form>
</div>
{{-- END OF SIDEBAR CONTENT --}}