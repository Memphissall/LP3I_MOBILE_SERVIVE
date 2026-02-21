<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Sistem E-Academic</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-gray-100 font-sans antialiased text-gray-800">

    <div class="flex min-h-screen w-full bg-white">

        {{-- Bagian Kiri (Informasi Sistem) --}}
        <div class="w-1/2 relative flex flex-col justify-between text-white p-12 hidden lg:flex">
            {{-- Background Image dengan Overlay --}}
            <div class="absolute inset-0 z-0">
                <img src="{{ asset('images/gedung_lp3i.jpg') }}" alt="Gedung LP3I" class="w-full h-full object-cover">
                <div class="absolute inset-0 bg-gradient-to-br from-[#004269]/90 to-[#009DA5]/80"></div> {{-- Overlay
                agar teks terbaca --}}
            </div>

            {{-- Content (Z-Index agar di atas overlay) --}}
            <div class="relative z-10">
                {{-- Judul Sistem --}}
                <div class="text-3xl font-bold text-gray-800">
                    <span class="text-4xl font-extrabold text-[#009DA5] mr-0.5">E</span><span
                        class="text-4xl font-bold text-gray-400">|</span>
                    <span class="text-[#F15B67]">Academic</span>
                </div>

                {{-- Deskripsi Sistem --}}
                <p class="text-white/90 text-lg leading-relaxed max-w-lg mt-6">
                    Sistem terintegrasi untuk operasional akademik, dosen, dan mahasiswa. Memudahkan pengelolaan data,
                    jadwal, materi, hingga nilai dalam satu solusi.
                </p>
            </div>

            {{-- Footer Kiri --}}
            <div class="relative z-10 text-white/70 text-sm mt-8">
                <p class="text-white/80 text-sm">© {{ date('Y') }} Sistem Operasional Akademik. All rights reserved.</p>
            </div>
        </div>

        {{-- Bagian Kanan (Form Login) --}}
        <div class="w-full lg:w-1/2 flex flex-col justify-start items-center p-12 bg-white">
            {{-- Logo LP3I & Global Mandiri di Atas --}}
            <div class="flex items-center justify-center mb-12">
                <img src="{{ asset('images/logo_blue.png') }}" alt="LP3I Logo" class="h-16 w-auto mr-3">
                <img src="{{ asset('images/global_mandiri.png') }}" alt="Global Mandiri Logo" class="h-16 w-auto">
            </div>
            
            <div class="w-full max-w-md space-y-8">
                <div>
                    <h2 class="text-center text-4xl font-extrabold text-gray-900">Login System</h2>
                    <p class="mt-2 text-center text-sm text-gray-600">
                        Silahkan masuk ke akun anda
                    </p>
                </div>

                <form action="{{ route('login') }}" method="POST" class="mt-8 space-y-6">
                    @csrf {{-- Token CSRF untuk keamanan Laravel --}}

                    {{-- Error Messages --}}
                    @if ($errors->has('login_fail'))
                        <div class="bg-red-50 border-l-4 border-red-500 p-4 rounded-lg">
                            <div class="flex items-center">
                                <svg class="w-5 h-5 text-red-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                                <p class="text-sm text-red-700 font-medium">{{ $errors->first('login_fail') }}</p>
                            </div>
                        </div>
                    @endif

                    <div class="space-y-5">
                        <div>
                            <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                            <div class="mt-1">
                                <input type="email" name="email" id="email" required autofocus
                                    placeholder="contoh@kampus.test"
                                    class="appearance-none block w-full px-3 py-3 border border-gray-300 rounded-lg shadow-sm placeholder-gray-400 
                                              focus:outline-none focus:ring-[#009DA5] focus:border-[#009DA5] sm:text-sm transition duration-150 ease-in-out">
                            </div>
                        </div>

                        <div>
                            <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                            <div class="mt-1">
                                <input type="password" name="password" id="password" required
                                    class="appearance-none block w-full px-3 py-3 border border-gray-300 rounded-lg shadow-sm placeholder-gray-400 
                                              focus:outline-none focus:ring-[#009DA5] focus:border-[#009DA5] sm:text-sm transition duration-150 ease-in-out">
                            </div>
                        </div>
                    </div>

                    <div class="flex items-center justify-between">
                        <div class="flex items-center">
                            <input id="remember" name="remember" type="checkbox"
                                class="h-4 w-4 text-[#009DA5] focus:ring-[#009DA5] border-gray-300 rounded">
                            <label for="remember" class="ml-2 block text-sm text-gray-900">Remember me</label>
                        </div>
                        <a href="#" onclick="alert('Fitur Reset Password membutuhkan konfigurasi Email Server (SMTP).')"
                            class="text-sm font-medium text-[#004269] hover:text-[#009DA5]">Forgot password?</a>
                    </div>

                    <div>
                        <button type="submit"
                            class="w-full flex justify-center py-3 px-4 border border-transparent rounded-lg 
                                       shadow-md text-base font-semibold text-white bg-gradient-to-r from-[#004269] to-[#009DA5] 
                                       hover:from-[#003350] hover:to-[#00888f] focus:outline-none focus:ring-2 focus:ring-offset-2 
                                       focus:ring-[#009DA5] transition duration-300 ease-in-out transform hover:-translate-y-0.5">
                            Login
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

</body>

</html>