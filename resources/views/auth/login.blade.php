<x-guest-layout>
    <div class="min-h-screen flex">
        <!-- BAGIAN KIRI: Background foto + overlay putih transparan -->
        <div class="hidden lg:flex w-1/2 bg-cover bg-center relative"
             style="background-image: url('{{ asset('images/dosen.jpg') }}');">
            <div class="absolute inset-0 bg-white bg-opacity-50 backdrop-blur-sm"></div>
            <div class="relative z-10 flex flex-col justify-center items-center w-full px-10 text-center">
                <h1 class="text-4xl font-bold text-blue-800 mb-4">E-Lecturer System</h1>
                <p class="text-gray-700 max-w-md text-lg">
                    Platform untuk dosen mengelola data akademik, nilai, dan presensi secara efisien.
                </p>
            </div>
        </div>

        <!-- BAGIAN KANAN: background biru + card login -->
        <div class="flex w-full lg:w-1/2 justify-center items-center bg-gradient-to-b from-blue-800 to-blue-600">
            <div class="w-full max-w-md bg-white bg-opacity-10 backdrop-blur-lg p-8 rounded-2xl shadow-2xl text-white">
                <div class="text-center mb-6">
                   <img src="{{ asset('images/logo_white.png') }}" alt="Logo" 
     class="mx-auto mb-3 max-h-20 w-auto object-contain drop-shadow-lg">
                    <h2 class="text-3xl font-bold">E-Lecturer System</h2>
                    <p class="text-blue-200 text-sm mt-1">Masuk ke akun dosen Anda</p>
                </div>

                <!-- FORM LOGIN -->
                <form method="POST" action="{{ route('login') }}">
                    @csrf

                    <!-- Email -->
                    <div class="mb-4">
                        <label for="email" class="block text-sm font-medium text-blue-100 mb-1">Email</label>
                        <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus
                               class="w-full px-4 py-2 rounded-lg bg-white text-gray-800 focus:outline-none focus:ring-2 focus:ring-blue-300 border-0">
                        <x-input-error :messages="$errors->get('email')" class="mt-2 text-red-200" />
                    </div>

                    <!-- Password -->
                    <div class="mb-4">
                        <label for="password" class="block text-sm font-medium text-blue-100 mb-1">Password</label>
                        <input id="password" type="password" name="password" required
                               class="w-full px-4 py-2 rounded-lg bg-white text-gray-800 focus:outline-none focus:ring-2 focus:ring-blue-300 border-0">
                        <x-input-error :messages="$errors->get('password')" class="mt-2 text-red-200" />
                    </div>

                    <!-- Remember Me -->
                    <div class="flex items-center mb-4">
                        <input id="remember_me" type="checkbox" name="remember"
                               class="rounded border-gray-300 text-blue-700 focus:ring-blue-500">
                        <label for="remember_me" class="ms-2 text-sm text-blue-100">Ingat saya</label>
                    </div>

                    <!-- Tombol Login -->
                    <x-primary-button class="w-full justify-center bg-gradient-to-r from-blue-500 to-blue-400 text-white font-semibold py-2 rounded-lg hover:from-blue-600 hover:to-blue-500 transition duration-300">
                        {{ __('Masuk') }}
                    </x-primary-button>
                </form>
                <!-- @auth
    @if (Auth::user()->role === 'admin')
        <p class="text-sm text-gray-600 mt-3">
            <a href="{{ route('register') }}" class="text-yellow-400 hover:text-yellow-300 font-semibold">Tambah Dosen Baru</a>
        </p>
    @endif
@endauth -->


                <div class="mt-6 text-center text-sm">
                    Belum punya akun? 
                     <a href="{{ route('register') }}" class="text-white underline font-medium hover:text-blue-200">
                        Daftar di sini
                    </a> 
                </div>
            </div>
        </div>
    </div>
</x-guest-layout>
