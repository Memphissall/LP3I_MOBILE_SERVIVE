<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Sistem E-Lecturer') }}</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    <style>
        :root{
            --indigo:#1f3a5f;        /* Indigo Dye */
            --viridian:#1b8a7a;     /* Viridian Green */
            --white:#ffffff;
            --bg:#f3f6fb;
        }

        *{margin:0;padding:0;box-sizing:border-box}

        body{
            font-family:Poppins,sans-serif;
            background:var(--bg);
        }

        a{text-decoration:none}

        /* ===== SIDEBAR ===== */
        .sidebar{
            width:260px;
            min-height:100vh;
            background:linear-gradient(180deg, var(--indigo), #162c45);
            position:fixed;
            color:#fff;
            display:flex;
            flex-direction:column;
            justify-content:space-between;
        }

        /* BRAND */
        .sidebar-brand{
            padding:20px;
            display:flex;
            align-items:center;
            gap:12px;
            border-bottom:1px solid rgba(255,255,255,.15);
        }

        .sidebar-brand img{
            width:38px;
            height:38px;
            object-fit:contain;
        }

        .sidebar-brand span{
            font-size:16px;
            font-weight:700;
            line-height:1.2;
            color:#fff;
        }

        /* MENU */
        .sidebar nav{
            padding:16px;
            display:flex;
            flex-direction:column;
            gap:6px;
        }

        .sidebar nav a{
            padding:12px 14px;
            display:flex;
            align-items:center;
            gap:12px;
            color:#dbe7f0;
            border-radius:10px;
            transition:.2s;
            font-size:15px;
        }

        .sidebar nav a:hover,
        .sidebar nav a.active{
            background:var(--viridian);
            color:#fff;
        }

        /* LOGOUT */
        .logout-btn{
            width:calc(100% - 32px);
            margin:16px;
            padding:14px;
            background:#162c45;
            border:none;
            border-radius:12px;
            color:#fff;
            cursor:pointer;
            display:flex;
            align-items:center;
            justify-content:center;
            gap:10px;
            font-size:15px;
        }

        .logout-btn:hover{
            background:var(--viridian);
        }

        /* ===== MAIN ===== */
        .main-content{
            margin-left:260px;
            min-height:100vh;
            display:flex;
            flex-direction:column;
            transition: margin-left 0.3s ease;
        }

        /* ===== NAVBAR ATAS (SEJAJAR SIDEBAR) ===== */
        .navbar{
            background:linear-gradient(90deg, var(--indigo), var(--viridian));
            padding:18px 24px;
            display:flex;
            justify-content:space-between;
            align-items:center;
            color:#fff;
            border-bottom:3px solid rgba(0,0,0,.08);
            box-shadow:0 4px 10px rgba(0,0,0,.08);
        }

        .navbar-user {
            display: flex;
            align-items: center;
            margin-left: auto;
        }

        .profile-link{
            color:#a7fff2;
            font-weight:600;
            margin-left:10px;
        }

        .profile-link:hover{
            color:#ffffff;
        }

        main{
            padding:24px;
            flex:1;
        }

        footer{
            background:#fff;
            text-align:center;
            padding:14px;
            border-top:1px solid #e5e7eb;
            font-size:14px;
            color:#64748b;
        }

        /* ===== RESPONSIVE MOBILE TOGGLE & BACKDROP ===== */
        .menu-toggle {
            display: none;
            background: none;
            border: none;
            color: #fff;
            font-size: 20px;
            cursor: pointer;
            outline: none;
        }

        .sidebar-backdrop {
            display: none;
            position: fixed;
            top: 0; left: 0;
            width: 100vw; height: 100vh;
            background: rgba(0,0,0,.4);
            z-index: 999;
        }

        .sidebar-backdrop.active {
            display: block;
        }

        @media (max-width: 768px) {
            .sidebar {
                left: -260px;
                transition: left 0.3s ease;
                z-index: 1000;
            }
            .sidebar.show {
                left: 0;
            }
            .main-content {
                margin-left: 0;
            }
            .menu-toggle {
                display: block;
            }
        }
    </style>
</head>

<body>

<div class="sidebar-backdrop" id="sidebarBackdrop"></div>

<aside class="sidebar">
    <div>
        <!-- LOGO + TITLE -->
        <div class="sidebar-brand">
            <img src="{{ asset('images/lp3i.png') }}" alt="LP3I College">
            <span>Sistem<br>E-Lecturer</span>
        </div>

        <nav>
            @if(Auth::user()->role === 'admin')
                <a href="{{ route('admin.dashboard') }}">
                    <i class="fa-solid fa-screwdriver-wrench"></i> Dashboard Admin
                </a>
            @endif

            @if(Auth::user()->role === 'pendidik')
                <a href="{{ route('user.dashboard') }}" class="{{ request()->routeIs('user.dashboard') ? 'active' : '' }}">
                    <i class="fa-solid fa-chart-line"></i> Dashboard
                </a>

                <a href="{{ route('pendidik.jadwal.index') }}">
                    <i class="fa-solid fa-calendar-days"></i> Jadwal Mengajar
                </a>

                <a href="{{ route('pendidik.absen') }}" class="{{ request()->routeIs('pendidik.absen') ? 'active' : '' }}">
                    <i class="fa-solid fa-user-check"></i> Absensi
                </a>

                <a href="{{ route('materi.pilih') }}" class="{{ request()->routeIs('materi.*') ? 'active' : '' }}">
                    <i class="fa-solid fa-book"></i> Materi Pembelajaran
                </a>

                <a href="{{ route('nilai.index') }}">
                    <i class="fa-solid fa-star"></i> Nilai Mahasiswa
                </a>

                <a href="{{ route('tugas.pilih') }}">
                    <i class="fa-solid fa-list-check"></i> Tugas
                </a>

               <a href="{{ route('pendidik.gaji.index') }}"
                    class="{{ request()->routeIs('pendidik.gaji.*') ? 'active' : '' }}">
                        <i class="fa-solid fa-money-bill-wave"></i> Lihat Gaji
                    </a>


                        <a href="{{ route('pendidik.sap.pilih') }}" 
            class="{{ request()->routeIs('pendidik.sap.*') ? 'active' : '' }}">
                <i class="fa-solid fa-file-arrow-down"></i> Unduh SAP
            </a>

            @endif
        </nav>
    </div>

    <!-- LOGOUT -->
    <form method="POST" action="{{ route('logout') }}">
        @csrf
        <button class="logout-btn">
            <i class="fa-solid fa-right-from-bracket"></i> Keluar
        </button>
    </form>
</aside>

<div class="main-content">
    <header class="navbar">
        <button class="menu-toggle" id="menuToggleBtn">
            <i class="fa-solid fa-bars"></i>
        </button>
        <div class="navbar-user">
            👋 {{ Auth::user()->name }}
            <a href="{{ route('profile.edit') }}" class="profile-link">Profil</a>
        </div>
    </header>

    <main>
        @yield('content')
    </main>

    <footer>
        © {{ date('Y') }} ASE10 V0.1 | REV0.3 | LP3I Karawang
    </footer>
</div>

<script>
    document.addEventListener('contextmenu', function (e) {
        e.preventDefault();
        alert('Klik kanan dinonaktifkan demi keamanan sistem!');
    });

    const menuToggleBtn = document.getElementById('menuToggleBtn');
    const sidebar = document.querySelector('.sidebar');
    const backdrop = document.getElementById('sidebarBackdrop');

    if (menuToggleBtn && sidebar && backdrop) {
        menuToggleBtn.addEventListener('click', function() {
            sidebar.classList.toggle('show');
            backdrop.classList.toggle('active');
        });

        backdrop.addEventListener('click', function() {
            sidebar.classList.remove('show');
            backdrop.classList.remove('active');
        });
    }
</script>

@stack('scripts')
</body>
</html>
