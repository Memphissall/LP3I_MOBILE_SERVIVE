<x-guest-layout>
    <div class="min-h-screen flex items-center justify-center bg-gradient-to-b from-blue-900 to-blue-700">
        <div class="w-full max-w-md bg-white/10 backdrop-blur-md rounded-2xl shadow-2xl p-8 mx-4">

            {{-- Logo & Judul --}}
            <div class="text-center mb-6">
                  <img src="{{ asset('images/logo_white.png') }}" alt="Logo" 
     class="mx-auto mb-3 max-h-20 w-auto object-contain drop-shadow-lg">
                <h2 class="text-2xl font-bold text-white mb-1">e-Lecturer System</h2>
                <p class="text-blue-100 text-sm">Buat akun pendidik baru</p>
            </div>

            {{-- Form Register --}}
            <form method="POST" action="{{ route('register') }}" class="space-y-4">
                @csrf

                {{-- Nama --}}
                <div>
                    <label for="name" class="block text-sm font-medium text-white mb-1">Nama Lengkap</label>
                    <input id="name" type="text" name="name" value="{{ old('name') }}" required autofocus
                        class="w-full px-4 py-2 rounded-lg bg-white/20 border border-white/30 text-white placeholder-blue-100 focus:ring-2 focus:ring-blue-400 focus:outline-none">
                    @error('name')
                        <p class="text-red-300 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Email --}}
                <div>
                    <label for="email" class="block text-sm font-medium text-white mb-1">Email</label>
                    <input id="email" type="email" name="email" value="{{ old('email') }}" required
                        class="w-full px-4 py-2 rounded-lg bg-white/20 border border-white/30 text-white placeholder-blue-100 focus:ring-2 focus:ring-blue-400 focus:outline-none">
                    @error('email')
                        <p class="text-red-300 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Password --}}
                <div>
                    <label for="password" class="block text-sm font-medium text-white mb-1">Password</label>
                    <input id="password" type="password" name="password" required
                        class="w-full px-4 py-2 rounded-lg bg-white/20 border border-white/30 text-white placeholder-blue-100 focus:ring-2 focus:ring-blue-400 focus:outline-none">
                    @error('password')
                        <p class="text-red-300 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Konfirmasi Password --}}
                <div>
                    <label for="password_confirmation" class="block text-sm font-medium text-white mb-1">Konfirmasi Password</label>
                    <input id="password_confirmation" type="password" name="password_confirmation" required
                        class="w-full px-4 py-2 rounded-lg bg-white/20 border border-white/30 text-white placeholder-blue-100 focus:ring-2 focus:ring-blue-400 focus:outline-none">
                </div>

                {{-- Tombol --}}
                <div class="mt-6">
                    <button type="submit"
                        class="w-full bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 rounded-lg transition duration-200">
                        Daftar Akun
                    </button>
                </div>

                {{-- Link ke Login --}}
                <p class="text-center text-blue-100 text-sm mt-4">
                    Sudah punya akun?
                    <a href="{{ route('login') }}" class="text-white font-semibold hover:underline">
                        Masuk di sini
                    </a>
                </p>
            </form>
        </div>
    </div>
</x-guest-layout>
