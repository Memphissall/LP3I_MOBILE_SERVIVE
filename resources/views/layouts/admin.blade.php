<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">

    <title>Admin Dashboard</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        body {
            font-family: 'Inter', sans-serif;
            background-color: #f5f7fb;
        }
        .sidebar {
            background: linear-gradient(to bottom, #1e3a8a, #2563eb);
            color: white;
            width: 250px;
            min-height: 100vh;
            position: fixed;
            top: 0; left: 0;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }
        .sidebar h2 {
            font-weight: 700;
            font-size: 1.25rem;
            padding: 1.5rem;
            text-align: center;
            border-bottom: 1px solid rgba(255,255,255,0.2);
        }
        .sidebar nav a {
            display: block;
            padding: 0.75rem 1.5rem;
            color: #dbeafe;
            transition: 0.2s;
        }
        .sidebar nav a:hover, .sidebar nav a.active {
            background: none;
            border-left: 4px solid white;
            padding-left: 1.25rem;
            color: white;
        }
        .main-content {
            margin-left: 250px;
        }
        .navbar {
            background: white;
            border-bottom: 1px solid #e5e7eb;
            padding: 1rem 2rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
    </style>
</head>
<body>

    <!-- SIDEBAR -->
    <aside class="sidebar">
        <div>
            <h2>ADMIN PANEL</h2>
            <nav>
                <a href="{{ route('admin.dashboard') }}" class="{{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                    Dashboard Admin
                </a>

                <a href="{{ route('admin.users.index') }}" class="{{ request()->routeIs('admin.users.*') ? 'active' : '' }}">
                    Manage Users
                </a>
            </nav>
        </div>

        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button class="m-4 w-[90%] py-2 bg-red-600 text-white rounded">Logout</button>
        </form>
    </aside>

    <!-- MAIN CONTENT -->
    <div class="main-content">
        
        <!-- NAVBAR -->
        <header class="navbar">
            <h1 class="text-xl font-semibold">Admin Dashboard</h1>

            <div>{{ Auth::user()->name }}</div>
        </header>

       <main class="p-6">
    @yield('content')
</main>

    </div>

</body>
</html>
