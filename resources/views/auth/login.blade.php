<x-guest-layout>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <div class="min-h-screen w-full flex items-center justify-center p-4 lg:p-8 font-poppins relative overflow-hidden">
        
        <div class="absolute inset-0 z-0">
            <div class="absolute inset-0 bg-black/40 z-10"></div>
            <img src="{{ asset('/img/gedung-lp3i.jpeg') }}" class="w-full h-full object-cover" alt="Background Gedung">
        </div>

        <div x-data="{ step: 1 }" class="relative z-20 w-full max-w-4xl bg-white rounded-3xl shadow-2xl overflow-hidden flex flex-col lg:flex-row min-h-[500px] border border-white/20 transition-all duration-300">

            <div class="w-full lg:w-[45%] bg-white p-8 lg:p-10 flex-col justify-center relative lg:!flex"
                 :class="step === 1 ? 'flex' : 'hidden'">
                
                <div class="text-center mb-6"> 
                   
                    
                    <div class="inline-flex items-center gap-1 border-b-2 border-yellow-400 pb-1">
                        <span class="text-xl lg:text-2xl font-black text-red-600">E | </span><span class="text-xl lg:text-2xl font-black text-[#004269]">STUDENT</span>
                    </div>
                    <p class="text-[9px] font-bold tracking-[0.3em] text-gray-400 uppercase mt-1">Information System</p>
                </div>

                <form method="POST" action="{{ route('login') }}" class="space-y-4"> 
                    @csrf
                    
                    <div class="space-y-1">
                        <label class="text-[10px] lg:text-xs font-bold text-[#004269] uppercase ml-1">NIPD</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <svg class="h-4 w-4 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" /></svg>
                            </div>
                            <input id="nipd" class="w-full pl-9 pr-4 py-2.5 bg-gray-50 border border-gray-200 rounded-lg focus:bg-white focus:border-[#004269] focus:ring-4 focus:ring-[#004269]/10 transition-all font-medium text-sm text-gray-800 placeholder-gray-400" type="tel" name="nipd" required autofocus placeholder="Nomor Induk" />
                        </div>
                    </div>

                    <div class="space-y-1">
                        <label class="text-[10px] lg:text-xs font-bold text-[#004269] uppercase ml-1">Password</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <svg class="h-4 w-4 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" /></svg>
                            </div>
                            <input id="password" class="w-full pl-9 pr-4 py-2.5 bg-gray-50 border border-gray-200 rounded-lg focus:bg-white focus:border-[#004269] focus:ring-4 focus:ring-[#004269]/10 transition-all font-medium text-sm text-gray-800 placeholder-gray-400" type="password" name="password" required placeholder="Kata Sandi" />
                        </div>
                    </div>

                    <button type="submit" class="w-full bg-[#004269] hover:bg-[#002e4d] text-white font-bold py-3 rounded-lg shadow-lg shadow-blue-900/20 transition-all transform active:scale-[0.98] mt-2 text-sm lg:text-base">
                        Login
                    </button>

                    @if ($errors->any())
                        <div class="alert alert-danger" style="color: red; background: #ffcccc; padding: 10px; margin-bottom: 10px;">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <div class="text-center mt-3">
                        @if (Route::has('password.request'))
                            <a href="{{ route('password.request') }}" class="text-xs font-semibold text-gray-500 hover:text-[#004269]">Lupa Password?</a>
                        @endif
                    </div>
                </form>

                {{-- Tombol Lanjut ke Info (Hanya tampil di Mobile) --}}
                <div class="mt-6 pt-4 border-t border-gray-100 lg:hidden">
                    <button @click="step = 2" class="w-full flex items-center justify-center gap-2 text-[#004269] font-bold text-xs bg-blue-50 py-2.5 rounded-lg hover:bg-blue-100 transition-colors">
                        <span>Lihat Informasi Layanan</span>
                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                    </button>
                </div>

                <div class="mt-6 lg:absolute lg:bottom-4 lg:left-0 w-full text-center">
                    <span class="text-[9px] text-gray-300 font-medium">© {{ date('Y') }} LP3I College</span>
                </div>
            </div>

            {{-- ================= BAGIAN 2: INFORMASI LAYANAN ================= --}}
            {{-- Default mobile disembunyikan (hidden), tampil saat step 2 (!flex), di desktop selalu tampil (lg:!flex) --}}
            <div class="flex-1 w-full lg:w-[55%] bg-[#F1F8FF] p-8 lg:p-10 relative flex-col justify-center overflow-hidden hidden lg:!flex"
                :class="step === 2 ? '!flex' : 'hidden'">
                
                {{-- DEKORASI --}}
                <div class="absolute top-0 right-0 -mt-20 -mr-20 w-56 h-56 bg-[#009DA5] rounded-full opacity-10 blur-2xl"></div>
                <div class="absolute bottom-0 left-0 -mb-20 -ml-20 w-56 h-56 bg-[#004269] rounded-full opacity-10 blur-2xl"></div>
                <div class="absolute top-8 right-8 opacity-20" style="background-image: radial-gradient(#004269 2px, transparent 2px); background-size: 20px 20px; width: 80px; height: 80px;"></div>

                <div class="relative z-10">
                    
                    {{-- Navigasi Back Mobile (Hanya tampil di Mobile) --}}
                    <div class="mb-6 lg:hidden">
                        <button @click="step = 1" class="flex items-center gap-2 text-gray-500 font-semibold text-xs hover:text-[#004269] transition-colors">
                            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path></svg>
                            <span>Kembali ke Login</span>
                        </button>
                    </div>

                    {{-- Header Logo --}}
                    <div class="flex items-center gap-4 mb-6">
                        <img src="{{ asset('img/global.png') }}" class="h-10 lg:h-12 w-auto object-contain drop-shadow-sm">
                        <div class="w-[2px] h-8 bg-gray-300 rounded-full"></div>
                        <img src="{{ asset('/img/2.webp') }}" class="h-8 lg:h-10 w-auto object-contain drop-shadow-sm">
                    </div>

                    <h2 class="text-xl lg:text-2xl font-bold text-[#004269] mb-3">Informasi Layanan</h2>
                    <p class="text-gray-600 mb-6 leading-relaxed text-xs lg:text-sm text-justify">
                        Platform akademik terintegrasi untuk mahasiswa LP3I. Akses data perkuliahan, nilai, dan administrasi dengan mudah.
                    </p>

                    {{-- GRID FITUR --}}
                    <div class="grid grid-cols-2 gap-3">
                        {{-- Item 1 --}}
                        <div class="bg-white p-3 rounded-lg shadow-sm border border-blue-50 flex flex-col items-center text-center gap-2 hover:shadow-md transition-shadow group">
                            <div class="w-8 h-8 rounded-full bg-blue-100 flex items-center justify-center text-[#004269] group-hover:bg-[#004269] group-hover:text-white transition-colors">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                            </div>
                            <span class="text-xs font-bold text-gray-700">Biodata</span>
                        </div>

                        {{-- Item 2 --}}
                        <div class="bg-white p-3 rounded-lg shadow-sm border border-blue-50 flex flex-col items-center text-center gap-2 hover:shadow-md transition-shadow group">
                            <div class="w-8 h-8 rounded-full bg-teal-100 flex items-center justify-center text-teal-700 group-hover:bg-teal-700 group-hover:text-white transition-colors">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path></svg>
                            </div>
                            <span class="text-xs font-bold text-gray-700">Nilai</span>
                        </div>

                        {{-- Item 3 --}}
                        <div class="bg-white p-3 rounded-lg shadow-sm border border-blue-50 flex flex-col items-center text-center gap-2 hover:shadow-md transition-shadow group">
                            <div class="w-8 h-8 rounded-full bg-orange-100 flex items-center justify-center text-orange-700 group-hover:bg-orange-700 group-hover:text-white transition-colors">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"></path></svg>
                            </div>
                            <span class="text-xs font-bold text-gray-700">Info</span>
                        </div>

                        {{-- Item 4 --}}
                        <div class="bg-white p-3 rounded-lg shadow-sm border border-blue-50 flex flex-col items-center text-center gap-2 hover:shadow-md transition-shadow group">
                            <div class="w-8 h-8 rounded-full bg-green-100 flex items-center justify-center text-green-700 group-hover:bg-green-700 group-hover:text-white transition-colors">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"></path></svg>
                            </div>
                            <span class="text-xs font-bold text-gray-700">Keuangan</span>
                        </div>
                    </div>

                </div>
            </div>

        </div>
    </div>
    
    @push('styles')
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800;900&display=swap');
        .font-poppins, * { font-family: 'Poppins', sans-serif !important; }
    </style>
    @endpush
</x-guest-layout>