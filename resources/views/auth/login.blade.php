<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Sistem E-Management</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
{{-- PERUBAHAN UTAMA DI SINI: MENGHILANGKAN CLASS TAILWIND DAN MENGGUNAKAN INLINE STYLE UNTUK BACKGROUND IMAGE --}}
<body class="font-sans antialiased flex items-center justify-center min-h-screen text-gray-800 backdrop-blur-sm" 
      style="
        background-image: url('{{ asset('images/akademik-lp3i.webp') }}'); 
        background-size: cover; 
        background-position: center;
        background-repeat: no-repeat;
        /* Opsional: Efek blur atau darken tipis pada BG Body */
      ">

    {{-- Overlay gelap tipis di belakang form untuk kontras (Opsional, tergantung seberapa gelap gambarnya) --}}
    <div class="absolute inset-0 bg-black opacity-30"></div> 

    {{-- Kontainer Utama Login (dibuat relative agar overlay di body tidak menutupi konten) --}}
    <div class="relative z-10 flex max-w-5xl w-full mx-auto rounded-xl shadow-2xl overflow-hidden bg-white/80 backdrop-blur-sm">
        
        {{-- Bagian Kiri (Informasi Sistem) - Dibuat FULL WHITE / DIBAYANGKAN --}}
        <div class="w-1/2 bg-gradient-to-br from-blue-700 to-blue-900 p-10 flex flex-col justify-between text-white">
            <div>
                {{-- Logo dan Nama Kampus --}}
                <div class="flex items-center mb-6">
                    {{-- Ganti dengan path logo LP3I-mu (sekarang harus logo berwarna jika BG putih) --}}
                    <img src="{{ asset('images/logo_white.png') }}" alt="LP3I Logo" class="h-10 w-auto mr-3"> 
                </div>

                {{-- Judul Sistem --}}
                <div class="text-2xl font-bold text-gray-800">
                    <span class="text-3xl font-extrabold text-blue-600 mr-0.5">E</span><span class="text-3xl font-bold text-gray-500">|</span>
                    <span class="text-red-700">Management</span>
                </div>
                
                {{-- Deskripsi Sistem --}}
                <p class="text-gray-200 text-sm leading-relaxed max-w-md mt-4">
                    Sistem terintegrasi untuk operasional akademik, dosen, dan mahasiswa. Memudahkan pengelolaan data, jadwal, materi, hingga nilai dalam satu solusi.
                </p>
            </div>
            
            {{-- Footer Kiri --}}
            <div class="text-sm mt-8">
                <p class="text-gray-400 text-sm">© {{ date('Y') }} Sistem Operasional Akademik. All rights reserved.</p>
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
                                     focus:ring-blue-500 focus:border-blue-500 sm:text-sm transition duration-150 ease-in-out">
                    </div>
                </div>

                <div>
                    <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                    <div class="mt-1">
                        <input type="password" name="password" id="password" required 
                                class="block w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm placeholder-gray-400 
                                     focus:ring-blue-500 focus:border-blue-500 sm:text-sm transition duration-150 ease-in-out">
                    </div>
                </div>

                <div class="flex items-center justify-between">
                    <div class="flex items-center">
                        <input id="remember_me" name="remember_me" type="checkbox" 
                                class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded">
                        <label for="remember_me" class="ml-2 block text-sm text-gray-900">Remember me</label>
                    </div>
                    {{-- Link Lupa Password (opsional, jika ada route-nya) --}}
                    <a href="#" class="text-sm font-medium text-blue-600 hover:text-blue-500">Forgot password?</a>
                </div>

                <div>
                    <button type="submit" 
                            class="w-full flex justify-center py-3 px-4 border border-transparent rounded-lg 
                                   shadow-md text-base font-semibold text-white bg-blue-600 
                                   hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 
                                   focus:ring-blue-500 transition duration-300 ease-in-out">
                        Proses Login
                    </button>
                </div>
            </form>
        </div>
    </div>

</body>
</html>