<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Sistem E-Academic</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100 font-sans antialiased flex items-center justify-center min-h-screen text-gray-800">

    <div class="flex max-w-5xl w-full mx-auto rounded-xl shadow-2xl overflow-hidden bg-white">
        
        {{-- Bagian Kiri (Informasi Sistem) --}}
        <div class="w-1/2 relative flex flex-col justify-between text-white p-10">
            {{-- Background Image dengan Overlay --}}
            <div class="absolute inset-0 z-0">
                <img src="{{ asset('images/gedung_lp3i.jpg') }}" alt="Gedung LP3I" class="w-full h-full object-cover">
                <div class="absolute inset-0 bg-gradient-to-br from-[#004269]/90 to-[#009DA5]/80"></div> {{-- Overlay agar teks terbaca --}}
            </div>

            {{-- Content (Z-Index agar di atas overlay) --}}
            <div class="relative z-10">
                {{-- Logo dan Nama Kampus --}}
                <div class="flex items-center mb-6">
                    <img src="{{ asset('images/logo_white.png') }}" alt="LP3I Logo" class="h-10 w-auto mr-3"> 
                </div>

                {{-- Judul Sistem --}}
                <div class="text-2xl font-bold text-gray-800">
                    <span class="text-3xl font-extrabold text-[#009DA5] mr-0.5">E</span><span class="text-3xl font-bold text-gray-400">|</span>
                    <span class="text-[#F15B67]">Academic</span>
                </div>
                
                {{-- Deskripsi Sistem --}}
                <p class="text-white/90 text-sm leading-relaxed max-w-md mt-4">
                    Sistem terintegrasi untuk operasional akademik, dosen, dan mahasiswa. Memudahkan pengelolaan data, jadwal, materi, hingga nilai dalam satu solusi.
                </p>
            </div>
            
            {{-- Footer Kiri --}}
            <div class="relative z-10 text-white/70 text-sm mt-8">
                 <p class="text-white/80 text-sm">© {{ date('Y') }} Sistem Operasional Akademik. All rights reserved.</p>
            </div>
        </div>

        {{-- Bagian Kanan (Form Login) --}}
        <div class="w-1/2 p-10 flex flex-col justify-center">
            <h2 class="text-3xl font-bold mb-8 text-center text-gray-900">Login System</h2>
            
            <form action="{{ route('login') }}" method="POST" class="space-y-6">
                @csrf {{-- Token CSRF untuk keamanan Laravel --}}

                <div>
                    <label for="username" class="block text-sm font-medium text-gray-700">Username</label>
                    <div class="mt-1">
                        <input type="text" name="username" id="username" required autofocus 
                               class="block w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm placeholder-gray-400 
                                      focus:ring-[#009DA5] focus:border-[#009DA5] sm:text-sm transition duration-150 ease-in-out">
                    </div>
                </div>

                <div>
                    <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                    <div class="mt-1">
                        <input type="password" name="password" id="password" required 
                               class="block w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm placeholder-gray-400 
                                      focus:ring-[#009DA5] focus:border-[#009DA5] sm:text-sm transition duration-150 ease-in-out">
                    </div>
                </div>

                <div class="flex items-center justify-between">
                    <div class="flex items-center">
                        <input id="remember_me" name="remember_me" type="checkbox" 
                               class="h-4 w-4 text-[#009DA5] focus:ring-[#009DA5] border-gray-300 rounded">
                        <label for="remember_me" class="ml-2 block text-sm text-gray-900">Remember me</label>
                    </div>
                    {{-- Link Lupa Password (opsional, jika ada route-nya) --}}
                    <a href="#" class="text-sm font-medium text-[#004269] hover:text-[#009DA5]">Forgot password?</a>
                </div>

                <div>
                    <button type="submit" 
                            class="w-full flex justify-center py-3 px-4 border border-transparent rounded-lg 
                                   shadow-md text-base font-semibold text-white bg-gradient-to-r from-[#004269] to-[#009DA5] 
                                   hover:from-[#003350] hover:to-[#00888f] focus:outline-none focus:ring-2 focus:ring-offset-2 
                                   focus:ring-[#009DA5] transition duration-300 ease-in-out">
                        Login
                    </button>
                </div>
            </form>
        </div>
    </div>

</body>
</html>