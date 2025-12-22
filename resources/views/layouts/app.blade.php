<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'e-Lecturer System') }}</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    <style>
        body {
            font-family: 'Inter', sans-serif;
            background: #f8fafc;
            color: #1f2937;
            margin: 0;
        }

        a { text-decoration: none; }

        /* SIDEBAR */
        .sidebar {
            background: #1e3a8a;
            width: 260px;
            min-height: 100vh;
            color: #f3f4f6;
            position: fixed;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            box-shadow: 4px 0 15px rgba(0,0,0,0.15);
            z-index: 20;
        }

        .sidebar h2 {
            padding: 2rem 1rem;
            font-size: 1.6rem;
            font-weight: 700;
            text-align: center;
            border-bottom: 1px solid rgba(255,255,255,.25);
        }

        .sidebar nav a {
            padding: .85rem 1.5rem;
            display: flex;
            align-items: center;
            gap: .75rem;
            color: #d1d5db;
            font-size: .95rem;
            border-radius: .5rem;
            transition: .3s;
        }

        .sidebar nav a:hover,
        .sidebar nav a.active {
            background: rgba(255,255,255,.1);
            color: #fff;
            font-weight: 600;
            border-left: 4px solid #6366f1;
        }

        .logout-btn {
            width: 90%;
            margin: 1.5rem auto;
            padding: .9rem;
            background: #dc2626;
            color: #fff;
            font-weight: 600;
            border-radius: .6rem;
            display: flex;
            justify-content: center;
            gap: .5rem;
        }

        .logout-btn:hover {
            background: #ef4444;
        }

        /* MAIN */
        .main-content {
            margin-left: 260px;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        /* NAVBAR */
        .navbar {
            background: #fff;
            padding: 1rem 2rem;
            border-bottom: 1px solid #e5e7eb;
            display: flex;
            justify-content: space-between;
            align-items: center;
            position: sticky;
            top: 0;
            z-index: 10;
        }

        .profile-link {
            color: #4f46e5;
            font-weight: 500;
        }

        main {
            flex: 1;
            padding: 2rem;
        }

        footer {
            text-align: center;
            padding: 1rem 0;
            font-size: .875rem;
            color: #6b7280;
            border-top: 1px solid #e5e7eb;
        }
    </style>
</head>

<body>

<!-- SIDEBAR -->
<aside class="sidebar">
    <div>
        <h2>📘 E-Lecturer</h2>
        <nav>
            @if(Auth::user()->role === 'admin')
                <a href="{{ route('admin.dashboard') }}">
                    <i class="fa-solid fa-screwdriver-wrench"></i> Admin Dashboard
                </a>
            @endif

            @if(Auth::user()->role === 'dosen')
                <a href="{{ route('user.dashboard') }}" class="{{ request()->routeIs('dashboard') ? 'active' : '' }}">
                    <i class="fa-solid fa-chart-line"></i> Dashboard
                </a>
                <a href="{{ route('dosen.jadwal.index') }}"><i class="fa-solid fa-calendar-days"></i> View Jadwal</a>
                <a href="#"><i class="fa-solid fa-user-check"></i> Absen</a>
                <a href="#"><i class="fa-solid fa-book"></i> Materi</a>
                <a href="{{ route('nilai.index') }}"><i class="fa-solid fa-star"></i> Nilai</a>
                <a href="{{ route('tugas.pilih') }}"><i class="fa-solid fa-list-check"></i> Tugas</a>
                <a href="#"><i class="fa-solid fa-money-bill-wave"></i> View Gaji</a>
                <a href="#"><i class="fa-solid fa-file-arrow-down"></i> Download SAP</a>
            @endif
        </nav>
    </div>

    <form method="POST" action="{{ route('logout') }}">
        @csrf
        <button class="logout-btn">
            <i class="fa-solid fa-right-from-bracket"></i> Logout
        </button>
    </form>
</aside>

<!-- MAIN -->
<div class="main-content">

    <!-- NAVBAR -->
    <header class="navbar">
        {{-- ❌ JUDUL DASHBOARD DOSEN DIHILANGKAN --}}
        @if(Auth::user()->role === 'admin')
            <h1 class="text-lg font-semibold text-gray-700">Admin Dashboard</h1>
        @else
            <div></div>
        @endif

        <div class="flex items-center gap-3">
            <span>👋 {{ Auth::user()->name }}</span>
            <a href="{{ route('profile.edit') }}" class="profile-link">
                <i class="fa-solid fa-user"></i> Profile
            </a>
        </div>
    </header>

    <main>
        @yield('content')
    </main>

    <footer>
        © {{ date('Y') }} ASE10 V.0.1 | LP3I KARAWANG COLLEGE
    </footer>

</div>

</body>
</html>
