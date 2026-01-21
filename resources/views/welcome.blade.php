<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>e-Lecturer System</title>
    @vite('resources/css/app.css') {{-- gunakan Tailwind CSS --}}
</head>
<body class="bg-gradient-to-r from-blue-900 via-blue-700 to-blue-500 min-h-screen flex items-center justify-center">

    <div class="bg-white shadow-2xl rounded-2xl p-10 max-w-lg text-center transform transition duration-500 hover:scale-105">
        <div class="mb-6">
            <h1 class="text-4xl font-extrabold text-blue-900 mb-2">E-Lecturer System</h1>
            <p class="text-gray-600">Sistem Manajemen Pendidik Digital</p>
        </div>

        <div class="my-8 border-t border-gray-300"></div>

        @if (Route::has('login'))
            <div class="flex justify-center space-x-4">
                @auth
                    <a href="{{ url('/register') }}" 
                       class="px-6 py-2 bg-yellow-500 text-white font-medium rounded-lg shadow hover:bg-yellow-600 transition">
                       Dashboard
                    </a>
                @else
                    <a href="{{ route('login') }}" 
                       class="px-6 py-2 bg-blue-600 text-white font-medium rounded-lg shadow hover:bg-blue-700 transition">
                       Log in
                    </a>
<!-- 
                    @if (Route::has('register'))
                        <a href="{{ route('register') }}" 
                           class="px-6 py-2 bg-gray-700 text-white font-medium rounded-lg shadow hover:bg-gray-800 transition">
                           Register
                        </a> -->
                    @endif
                @endauth
            </div>
        @endif

        <div class="mt-10 text-sm text-gray-500">
            <p>&copy; {{ date('Y') }} e-Lecturer System. Dibuat dengan oleh Tim IT Kampus LP3I KARAWANG.</p>
        </div>
    </div>

</body>
</html>
