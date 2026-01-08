<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SIAKAD Politeknik LP3I - @yield('title')</title>
    
    {{-- FONT POPPINS --}}
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">

    {{-- LINK JQUERY --}}
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" ></script>
    
    {{-- SWEETALERT2 --}}
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    
    {{-- VITE ASSETS --}}
    @vite(['resources/css/app.css', 'resources/js/app.jsx'])

    @stack('scripts')
    
    <style>
        :root {
            --primary-dark: #004269;  /* Indigo Dye */
            --primary-light: #009DA5; /* Viridian Green */
            --bg-color: #f3f4f6;
            --sidebar-width: 280px;
        }
        body {
            font-family: 'Poppins', sans-serif;
            background-color: var(--bg-color);
            margin: 0;
            font-size: 14px;
        }
        
        /* Sidebar Transition */
        #sidebar-menu { transition: transform 0.3s ease-in-out; }
        #main-content-wrapper { transition: margin-left 0.3s ease-in-out; }

        /* Desktop Collapsed */
        @media (min-width: 1025px) {
            #sidebar-menu.collapsed { transform: translateX(calc(0px - var(--sidebar-width))); }
            #main-content-wrapper.expanded-content { margin-left: 0 !important; }
            #main-content-wrapper { margin-left: var(--sidebar-width); }
        }

        /* Mobile Responsive */
        @media (max-width: 1024px) {
            #sidebar-menu { transform: translateX(calc(0px - var(--sidebar-width))); }
            #sidebar-menu.active { transform: translateX(0); }
            #main-content-wrapper { margin-left: 0 !important; }
        }

        /* Dropdown Animation */
        .dropdown-menu {
            opacity: 0;
            visibility: hidden;
            transform: translateY(-10px);
            transition: all 0.2s ease;
        }
        .dropdown-menu.show {
            opacity: 1;
            visibility: visible;
            transform: translateY(0);
        }
    </style>
</head>
<body class="text-gray-800 bg-gray-50">

<div id="dashboard-container" class="flex min-h-screen">
    
    {{-- 1. SIDEBAR --}}
    <aside id="sidebar-menu" class="w-[var(--sidebar-width)] h-screen fixed top-0 left-0 z-50 bg-gradient-to-b from-[#004269] to-[#002840] text-white flex flex-col shadow-2xl">
        
        {{-- Sidebar Header (Logo) --}}
        <div class="h-20 flex items-center px-8 border-b border-white/10">
            <div class="flex items-center gap-3">
                {{-- Logo LP3I Kecil (Ganti src dengan logo asli jika ada) --}}
                <div class="w-8 h-8 bg-white rounded-full flex items-center justify-center text-[#004269] font-bold text-xs shadow-lg">
                    <img src="{{ asset('/images/lp3i_krw.png') }}" alt="LP3I College Karawang" class="w-5 h-5 object-contain-center">
                </div>
                <div>
                    <h1 class="text-lg font-extrabold tracking-wide">E-Academic</h1>
                    <p class="text-[10px] text-gray-300 uppercase tracking-wider">LP3I College Karawang</p>
                </div>
            </div>
            <button id="close-sidebar-btn" class="lg:hidden ml-auto text-gray-400 hover:text-white">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
            </button>
        </div>
        
        {{-- Menu Scroll Area --}}
        <div class="flex-1 overflow-y-auto py-6 px-4 space-y-1 custom-scrollbar">
             @include('layouts.sidebar')
        </div>

        {{-- Sidebar Footer (Version) --}}
        <div class="p-4 text-center text-xs text-gray-500 border-t border-white/10 bg-[#002033]">
            <p>E-Academic v1.0</p>
            <p class="mt-1">&copy; {{ date('Y') }} LP3I College Karawang</p>
        </div>
    </aside>

    {{-- 2. MAIN CONTENT WRAPPER --}}
    <div id="main-content-wrapper" class="flex-1 flex flex-col min-h-screen">
        
        {{-- TOP NAVBAR (Sticky & Clean) --}}
        <header class="h-20 bg-white shadow-sm flex justify-between items-center px-6 sticky top-0 z-40">
            
            {{-- Left: Toggle & Page Title --}}
            <div class="flex items-center gap-4">
                <button id="toggle-sidebar-btn" class="p-2 rounded-lg text-gray-500 hover:bg-gray-100 hover:text-[#004269] transition">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h7"/></svg>
                </button>
                <div class="hidden md:block">
                    <h2 class="text-lg font-bold text-gray-800">@yield('title', 'Dashboard')</h2>
                    <p class="text-xs text-gray-500">{{ \Carbon\Carbon::now()->isoFormat('dddd, D MMMM Y') }}</p>
                </div>
            </div>

            {{-- Right: User Profile Dropdown (TEMPAT LOGOUT TERBAIK) --}}
            <div class="relative" id="user-menu-container">
                <button id="user-menu-btn" class="flex items-center gap-3 p-2 rounded-xl hover:bg-gray-50 transition focus:outline-none">
                    <div class="text-right hidden md:block">
                        <p class="text-sm font-bold text-gray-800 leading-tight">{{ Auth::user()->name ?? 'Guest' }}</p>
                        <p class="text-xs text-[#009DA5] font-medium">Administrator</p>
                    </div>
                    {{-- Avatar --}}
                    <div class="w-10 h-10 rounded-full bg-gradient-to-br from-[#004269] to-[#009DA5] flex items-center justify-center text-white font-bold shadow-md border-2 border-white ring-2 ring-gray-100">
                        {{ strtoupper(substr(Auth::user()->name ?? 'G', 0, 1)) }}
                    </div>
                    <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                </button>

                {{-- Dropdown Content --}}
                <div id="user-dropdown" class="dropdown-menu absolute right-0 mt-2 w-56 bg-white rounded-xl shadow-xl border border-gray-100 py-2 z-50 origin-top-right">
                    <div class="px-4 py-3 border-b border-gray-100 md:hidden">
                        <p class="text-sm font-bold text-gray-800">{{ Auth::user()->name ?? 'Guest' }}</p>
                        <p class="text-xs text-gray-500">Administrator</p>
                    </div>
                    
                    <a href="{{ route('admin.dashboard') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-blue-50 hover:text-[#004269] transition flex items-center">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                        Profil Saya
                    </a>
                    <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-blue-50 hover:text-[#004269] transition flex items-center">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                        Pengaturan
                    </a>
                    
                    <div class="border-t border-gray-100 my-1"></div>
                    
                    {{-- Logout Form Link --}}
                    <form action="{{ route('logout') }}" method="POST" id="logout-form">
                        @csrf
                        <button type="submit" class="w-full text-left px-4 py-2 text-sm text-red-600 hover:bg-red-50 hover:text-red-700 transition flex items-center font-semibold">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/></svg>
                            Keluar / Logout
                        </button>
                    </form>
                </div>
            </div>
        </header>

        {{-- CONTENT AREA --}}
        <main class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-50/50">
            @yield('content')
        </main>

        {{-- GLOBAL FOOTER --}}
        <footer class="bg-white py-4 px-8 border-t border-gray-200 text-center md:text-right">
            <p class="text-xs text-gray-500">
                &copy; {{ date('Y') }} <strong>LP3I College Karawang</strong>. All rights reserved.
                <span class="mx-1">|</span>
                Developed by ASE-10
            </p>
        </footer>

    </div>
</div>

{{-- SCRIPT --}}
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const sidebar = document.getElementById('sidebar-menu');
        const toggleBtn = document.getElementById('toggle-sidebar-btn');
        const closeBtn = document.getElementById('close-sidebar-btn');
        const mainContent = document.getElementById('main-content-wrapper');
        const userMenuBtn = document.getElementById('user-menu-btn');
        const userDropdown = document.getElementById('user-dropdown');

        // 1. Sidebar Toggle Logic
        function toggleSidebar() {
            if (window.innerWidth <= 1024) {
                // Mobile
                sidebar.classList.toggle('active');
                if (sidebar.classList.contains('active')) {
                    // Create Overlay
                    let overlay = document.createElement('div');
                    overlay.id = 'sidebar-overlay';
                    overlay.className = 'fixed inset-0 bg-black/50 z-40 lg:hidden backdrop-blur-sm transition-opacity';
                    document.body.appendChild(overlay);
                    overlay.onclick = toggleSidebar;
                    document.body.style.overflow = 'hidden';
                } else {
                    document.getElementById('sidebar-overlay')?.remove();
                    document.body.style.overflow = '';
                }
            } else {
                // Desktop
                sidebar.classList.toggle('collapsed');
                mainContent.classList.toggle('expanded-content');
            }
        }

        if(toggleBtn) toggleBtn.addEventListener('click', toggleSidebar);
        if(closeBtn) closeBtn.addEventListener('click', toggleSidebar);

        // 2. Handle Resize
        window.addEventListener('resize', () => {
            if (window.innerWidth > 1024) {
                sidebar.classList.remove('active');
                document.getElementById('sidebar-overlay')?.remove();
                document.body.style.overflow = '';
            } else {
                sidebar.classList.remove('collapsed');
                mainContent.classList.remove('expanded-content');
            }
        });

        // 3. User Dropdown Toggle
        if(userMenuBtn && userDropdown) {
            userMenuBtn.addEventListener('click', (e) => {
                e.stopPropagation();
                userDropdown.classList.toggle('show');
            });

            // Close dropdown when clicking outside
            document.addEventListener('click', (e) => {
                if (!userMenuBtn.contains(e.target) && !userDropdown.contains(e.target)) {
                    userDropdown.classList.remove('show');
                }
            });
        }

        // 4. Sidebar Submenu Toggle (for Data Master, Akademik, etc.)
        const submenuToggles = document.querySelectorAll('.submenu-toggle');
        
        submenuToggles.forEach(toggle => {
            toggle.addEventListener('click', function(e) {
                e.preventDefault();
                
                const targetId = this.getAttribute('data-target');
                const submenu = document.getElementById(targetId);
                const arrowIcon = this.querySelector('.arrow-icon');
                
                if (submenu) {
                    // Toggle submenu visibility
                    submenu.classList.toggle('hidden');
                    
                    // Rotate arrow icon
                    if (arrowIcon) {
                        if (submenu.classList.contains('hidden')) {
                            arrowIcon.style.transform = 'rotate(0deg)';
                        } else {
                            arrowIcon.style.transform = 'rotate(90deg)';
                        }
                    }
                }
            });
        });

        // Auto-expand submenu if a child item is active
        document.querySelectorAll('.submenu a').forEach(link => {
            // Check for active state (updated to match new styling)
            if (link.classList.contains('text-white') && 
                link.classList.contains('bg-white/10') && 
                link.classList.contains('font-semibold')) {
                const submenu = link.closest('.submenu');
                if (submenu) {
                    submenu.classList.remove('hidden');
                    const parentToggle = document.querySelector(`[data-target="${submenu.id}"]`);
                    if (parentToggle) {
                        const arrowIcon = parentToggle.querySelector('.arrow-icon');
                        if (arrowIcon) {
                            arrowIcon.style.transform = 'rotate(90deg)';
                        }
                    }
                }
            }
        });
    });
</script>

</body>
</html>