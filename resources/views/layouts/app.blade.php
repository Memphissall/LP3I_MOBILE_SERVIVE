<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Sistem E-Dosen') }}</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    <style>
        :root{
            --navy:#0f3a5f;
            --teal:#00a7a7;
            --white:#ffffff;
            --bg:#f5f7fb;
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
            background:var(--navy);
            position:fixed;
            color:#fff;
            display:flex;
            flex-direction:column;
            justify-content:space-between;
        }

        .sidebar h2{
            padding:24px;
            text-align:center;
            border-bottom:1px solid rgba(255,255,255,.2);
        }

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
            color:#e5e7eb;
            border-radius:8px;
            transition:.2s;
        }

        .sidebar nav a:hover,
        .sidebar nav a.active{
            background:var(--teal);
            color:#fff;
        }

        .logout-btn{
            margin:16px;
            padding:12px;
            background:#ff0000;
            border:none;
            border-radius:10px;
            color:#fff;
            cursor:pointer;
        }

        /* ===== MAIN ===== */
        .main-content{
            margin-left:260px;
            min-height:100vh;
            display:flex;
            flex-direction:column;
        }

        .navbar{
            background:var(--white);
            padding:16px 24px;
            display:flex;
            justify-content:space-between;
            align-items:center;
            border-bottom:1px solid #e5e7eb;
        }

        .profile-link{
            color:var(--teal);
            font-weight:600;
            margin-left:10px;
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
        }

        /* ===== CARD DASHBOARD ===== */
        .welcome{
            background:#fff;
            padding:20px;
            border-radius:12px;
            border-left:6px solid var(--teal);
            margin-bottom:24px;
        }

        .grid{
            display:grid;
            grid-template-columns:repeat(auto-fit,minmax(280px,1fr));
            gap:20px;
        }

        .card{
            background:#fff;
            padding:20px;
            border-radius:14px;
            border-left:5px solid var(--teal);
        }

        .card a{
            color:var(--teal);
            font-weight:600;
        }

        .icon-grid{
            margin-top:30px;
            display:grid;
            grid-template-columns:repeat(auto-fit,minmax(180px,1fr));
            gap:20px;
        }

        .icon-card{
            background:#fff;
            padding:26px;
            text-align:center;
            border-radius:16px;
            box-shadow:0 4px 10px rgba(0,0,0,.04);
            color:#000;
        }

        .icon-card i{
            font-size:28px;
            color:var(--teal);
            margin-bottom:10px;
        }
    </style>
</head>

<body>

<aside class="sidebar">
    <div>
        <h2>📘 Sistem E-Lecturer</h2>

        <nav>
            @if(Auth::user()->role === 'admin')
                <a href="{{ route('admin.dashboard') }}">
                    <i class="fa-solid fa-screwdriver-wrench"></i> Dashboard Admin
                </a>
            @endif

            @if(Auth::user()->role === 'dosen')
                <a href="{{ route('user.dashboard') }}" class="{{ request()->routeIs('user.dashboard') ? 'active' : '' }}">
                    <i class="fa-solid fa-chart-line"></i> Dashboard
                </a>

                <a href="{{ route('dosen.jadwal.index') }}">
                    <i class="fa-solid fa-calendar-days"></i> Jadwal Mengajar
                </a>

                <a href="{{ route('dosen.absen') }}" class="{{ request()->routeIs('dosen.absen') ? 'active' : '' }}">
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

                <a href="#">
                    <i class="fa-solid fa-money-bill-wave"></i> Lihat Gaji
                </a>

                <a href="#">
                    <i class="fa-solid fa-file-arrow-down"></i> Unduh SAP
                </a>
            @endif
        </nav>
    </div>

    <form method="POST" action="{{ route('logout') }}">
        @csrf
        <button class="logout-btn">
            <i class="fa-solid fa-right-from-bracket"></i> Keluar
        </button>
    </form>
</aside>

<div class="main-content">

    <header class="navbar">
        <div></div>
        <div>
            👋 {{ Auth::user()->name }}
            <a href="{{ route('profile.edit') }}" class="profile-link">Profil</a>
        </div>
    </header>

    <main>
        {{-- ISI DASHBOARD --}}
        @yield('content')
    </main>

    <footer>
        © {{ date('Y') }} ASE10 V0.1 | LP3I Karawang
    </footer>

</div>

<script>
    document.addEventListener('contextmenu', function (e) {
        e.preventDefault();
        alert('Klik kanan dinonaktifkan demi keamanan sistem!');
    });
</script>

</body>
</html>
