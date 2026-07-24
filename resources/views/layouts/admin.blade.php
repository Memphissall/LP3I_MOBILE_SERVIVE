<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin Dashboard</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    <style>
        body {
            font-family: 'Inter', sans-serif;
            background-color: #f5f7fb;
            margin: 0;
            padding: 0;
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
            transition: left 0.3s ease;
            z-index: 1000;
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
            text-decoration: none;
        }
        .sidebar nav a:hover, .sidebar nav a.active {
            background: none;
            border-left: 4px solid white;
            padding-left: 1.25rem;
            color: white;
        }
        .main-content {
            margin-left: 250px;
            transition: margin-left 0.3s ease;
        }
        .navbar {
            background: white;
            border-bottom: 1px solid #e5e7eb;
            padding: 1rem 2rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        /* ===== RESPONSIVE MOBILE TOGGLE & BACKDROP ===== */
        .menu-toggle {
            display: none;
            background: none;
            border: none;
            color: #374151;
            font-size: 20px;
            cursor: pointer;
            outline: none;
            margin-right: 1rem;
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
                left: -250px;
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
            .navbar {
                justify-content: flex-start;
            }
            .navbar-user {
                margin-left: auto;
            }
        }
    </style>
</head>
<body>

    <div class="sidebar-backdrop" id="sidebarBackdrop"></div>

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
            <button class="menu-toggle" id="menuToggleBtn">
                <i class="fa-solid fa-bars"></i>
            </button>
            <h1 class="text-xl font-semibold m-0">Admin Dashboard</h1>

            <div class="navbar-user">{{ Auth::user()->name }}</div>
        </header>

       <main class="p-6">
    @yield('content')
</main>

    </div>

    <script>
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
</body>
</html>
