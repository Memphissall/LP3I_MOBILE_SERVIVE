<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>AcaPro - Dashboard Staf Akademik</title>
    
    {{-- TAILWIND & LUCIDE ICONS (Tetap menggunakan CDN) --}}
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://unpkg.com/lucide@latest"></script>
    
    {{-- FONT POPPINS --}}
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">

    {{-- LINK JQUERY --}}
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" ></script>
    
    {{-- ASET VITE (Jika bundling Anda berfungsi, ini akan memuat file app.css/app.js) --}}
    @vite(['resources/css/app.css', 'resources/js/app.jsx'])

    @stack('scripts')
    
    <style>
        :root {
            --primary-blue: #3b82f6; /* Blue-500 */
            --light-bg: #f5f7fa;
            --sidebar-width: 280px; /* Variabel lebar sidebar */
        }
        body {
            font-family: 'Poppins', sans-serif; 
            background-color: var(--light-bg);
            min-height: 100vh;
            margin: 0;
        }
        
        /* ---------------------------------------------------- */
        /* GLOBAL STYLES (Navigasi & Submenu) */
        /* ---------------------------------------------------- */

        .nav-link {
            display: flex;
            align-items: center;
            padding: 0.75rem 1rem;
            color: #ffffff;
            font-weight: 500;
            transition: all 0.15s ease-in-out;
            cursor: pointer;
            border-radius: 0.75rem;
            margin: 0.25rem 1rem;
            position: relative;
        }
        .nav-link.active:not(.submenu-toggle) { 
            background-color: #ffffff;
            color: var(--primary-blue);
            font-weight: 600;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
        }
        .nav-link:hover:not(.active) {
            color: #ffffff; 
            background-color: rgba(255, 255, 255, 0.15); 
        }
        .submenu-toggle.expanded .arrow-icon {
            transform: rotate(90deg);
        }
        .submenu {
            max-height: 0;
            overflow: hidden; 
            transition: max-height 0.3s ease-in-out; 
        }
        .submenu.show {
            max-height: 500px; 
        }
        .submenu .nav-link {
            padding-left: 3rem; 
            color: #ffffff; 
        }
        .submenu .nav-link:hover:not(.active) {
            color: #f9fafb; 
            background-color: rgba(255, 255, 255, 0.05); 
        }
        .submenu .nav-link.active {
            background-color: var(--primary-blue); 
            border-left: 3px solid #f9fafb; 
            color: #ffffff;
            font-weight: 500;
            box-shadow: none;
        }

        /* ---------------------------------------------------- */
        /* COLLAPSED STATE (Desktop Hide Logic) - BARU */
        /* ---------------------------------------------------- */
        #sidebar-menu.collapsed {
            transform: translateX(calc(0px - var(--sidebar-width))) !important;
        }

        #main-content-wrapper.expanded-content {
            margin-left: 0 !important;
        }
        
        /* ---------------------------------------------------- */
        /* MOBILE STYLES */
        /* ---------------------------------------------------- */
        @media (max-width: 1024px) {
            #sidebar-menu {
                /* Default tertutup di mobile */
                transform: translateX(calc(0px - var(--sidebar-width))) !important; 
                box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.3);
            }
            #sidebar-menu.active { 
                transform: translateX(0) !important; /* Tampilkan saat active */
            }
            #main-content-wrapper {
                margin-left: 0 !important; 
            }
            /* Pastikan class desktop tidak mengganggu mobile */
            #sidebar-menu.collapsed {
                transform: translateX(calc(0px - var(--sidebar-width))) !important;
            }
            #main-content-wrapper.expanded-content {
                margin-left: 0 !important;
            }
        }
        
        /* ---------------------------------------------------- */
        /* DESKTOP STYLES (Default State & Collapsed) */
        /* ---------------------------------------------------- */
        @media (min-width: 1025px) {
            /* Default/Initial State (Terbuka) */
            #sidebar-menu {
                transform: translateX(0) !important;
            }
            #main-content-wrapper {
                margin-left: var(--sidebar-width) !important;
            }
            
            /* Collapsed State (Diterapkan oleh JS toggle) */
            #sidebar-menu.collapsed {
                transform: translateX(calc(0px - var(--sidebar-width))) !important;
            }
            #main-content-wrapper.expanded-content {
                margin-left: 0 !important;
            }
        }
    </style>
</head>
<body>

{{-- CONTAINER UTAMA --}}
<div id="dashboard-container">
    
    {{-- SIDEBAR CONTAINER --}}
    <div id="sidebar-menu" 
        class="bg-gradient-to-br from-blue-700 to-blue-900 
        w-[var(--sidebar-width)] h-screen fixed top-0 left-0 z-50 
        transition-transform duration-300">
        
        <div class="sidebar-logo-text px-8 pt-8 pb-8">
            <div class="text-2xl font-bold text-gray-800">
                <span class="text-3xl font-extrabold text-blue-500 mr-0.5">E</span><span class="text-3xl font-bold text-gray-400">|</span>
                <span class="text-red-600">Management</span>
            </div>
            {{-- Tombol close untuk mobile: Hanya terlihat di layar kecil (lg:hidden) --}}
            <button id="close-sidebar-btn" class="absolute top-4 right-4 lg:hidden text-gray-300 hover:text-white">
                <i data-lucide="x" class="w-6 h-6"></i>
            </button>
        </div>
        
        {{-- KONTEN MENU: Dibungkus dengan DIV untuk Scroll, Tinggi, dan Garansi Warna/Visibilitas --}}
        <div class="h-[calc(100vh-100px)] overflow-y-auto pb-8 relative text-white">
             @include('layouts.sidebar') 
        </div>
        
    </div>

    {{-- KONTEN UTAMA --}}
    <div id="main-content-wrapper" 
        class="p-8 min-h-screen bg-[var(--light-bg)] transition-all duration-300"> 
        
        <header class="flex justify-between items-center mb-6">
            <div class="flex items-center">
                {{-- Tombol Hamburger: SELALU ADA --}}
                <button id="toggle-sidebar-btn" class="mr-4 text-gray-500 hover:text-blue-500">
                    <i data-lucide="menu" class="w-7 h-7"></i>
                </button>
                <h1 class="text-2xl font-semibold text-gray-800 hidden md:block">@yield('title', 'Dashboard')</h1>
            </div>
            {{-- Bagian Header Kanan (Profile, Notifikasi, dll.) --}}
        </header>
        
        @yield('content') 
    </div>
</div>

{{-- SCRIPT PURE VANILLA JAVASCRIPT --}}
<script>
    lucide.createIcons();

    document.addEventListener('DOMContentLoaded', function() {
        
        // --- 1. Submenu Logic (Tidak Berubah) ---
        const submenuToggles = document.querySelectorAll('.submenu-toggle');
        submenuToggles.forEach(toggle => {
            toggle.addEventListener('click', function(e) {
                e.preventDefault();
                const targetId = this.getAttribute('data-target');
                const submenu = document.getElementById(targetId);
                if (submenu) {
                    this.classList.toggle('expanded');
                    this.classList.toggle('active'); 
                    submenu.classList.toggle('show');
                }
            });
        });
        
        // Pastikan submenu yang aktif terbuka saat dimuat
        const activeLinks = document.querySelectorAll('#sidebar-menu .submenu .nav-link.active');
        activeLinks.forEach(activeLink => {
            const parentGroup = activeLink.closest('.menu-group');
            if (parentGroup) {
                const toggle = parentGroup.querySelector('.submenu-toggle');
                const submenu = parentGroup.querySelector('.submenu');
                if (toggle) { toggle.classList.add('expanded', 'active'); }
                if (submenu) submenu.classList.add('show');
            }
        });

        // --- 2. Sidebar Toggle Logic (FINAL STABIL, CLASS-BASED UNTUK DESKTOP) ---
        const sidebar = document.getElementById('sidebar-menu');
        const toggleBtn = document.getElementById('toggle-sidebar-btn');
        const closeBtn = document.getElementById('close-sidebar-btn');
        const mainContent = document.getElementById('main-content-wrapper');
        const sidebarWidth = '280px'; 
        
        // Bersihkan margin-left inline style yang ada di HTML untuk membiarkan CSS mengambil alih
        mainContent.style.removeProperty('margin-left'); 

        function toggleSidebar() {
            const isMobile = window.innerWidth <= 1024;
            
            if (isMobile) {
                // MOBILE LOGIC: Menggunakan class 'active' + overlay
                if (sidebar.classList.contains('active')) {
                    // Tutup mobile
                    sidebar.classList.remove('active');
                    document.body.style.overflow = '';
                    const overlay = document.getElementById('sidebar-overlay');
                    if (overlay) overlay.remove();
                } else {
                    // Buka mobile
                    sidebar.classList.add('active');
                    document.body.style.overflow = 'hidden'; 
                    let overlay = document.createElement('div');
                    overlay.id = 'sidebar-overlay';
                    overlay.className = 'fixed inset-0 bg-black opacity-30 z-40 lg:hidden';
                    document.body.appendChild(overlay);
                    overlay.addEventListener('click', toggleSidebar);
                }
            } else {
                // DESKTOP LOGIC: HANYA TOGGLE CLASS 'collapsed'
                sidebar.classList.toggle('collapsed');
                mainContent.classList.toggle('expanded-content');
            }
        }

        // Event Listeners
        if(toggleBtn) { 
             toggleBtn.addEventListener('click', toggleSidebar);
        } 
        
        if(closeBtn) {
             closeBtn.addEventListener('click', () => {
                 if (window.innerWidth <= 1024) { toggleSidebar(); } 
             }); 
        }

        // Handle Resize & Inisialisasi (Membersihkan inline style saat berpindah mode)
        function handleResize() {
            if (window.innerWidth > 1024) {
                // DESKTOP: Hapus semua class/inline style mobile (biarkan CSS media query yang menangani)
                sidebar.classList.remove('active'); 
                sidebar.style.removeProperty('transform');
                mainContent.style.removeProperty('margin-left');

                document.body.style.overflow = '';
                const overlay = document.getElementById('sidebar-overlay');
                if (overlay) overlay.remove();
                
            } else {
                // MOBILE: Hapus class/inline style desktop
                sidebar.classList.remove('collapsed');
                mainContent.classList.remove('expanded-content');
                sidebar.style.removeProperty('transform');
                mainContent.style.removeProperty('margin-left');
            }
        }
        
        window.addEventListener('resize', handleResize);
        handleResize(); // Jalankan saat load pertama kali untuk membersihkan sisa-sisa style lama
    });
</script>

</body>
</html>