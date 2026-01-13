@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto p-6">

    {{-- Header --}}
    <div class="mb-8">
        <h1 class="text-4xl font-extrabold text-gray-800">
            Super Admin Dashboard
        </h1>
        <p class="text-gray-600 mt-2">
            Kelola sistem akademik & honor dosen
        </p>
    </div>

    {{-- GRID MENU --}}
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">

        {{-- Kelola Akun --}}
        <a href="{{ route('admin.users.index') }}"
           class="group bg-gradient-to-br from-blue-600 to-blue-800 text-white p-7 rounded-2xl shadow-xl
                  hover:shadow-2xl transform hover:-translate-y-1 transition duration-300">
            <div class="flex items-center justify-between">
                <div>
                    <h2 class="text-2xl font-semibold">Kelola Akun</h2>
                    <p class="mt-1 text-sm opacity-90">
                        Manajemen user, dosen, dan admin
                    </p>
                </div>
                <div class="text-5xl opacity-70 group-hover:opacity-100">👥</div>
            </div>
        </a>

        {{-- Rekap LKM Dosen --}}
        <a href="{{ route('admin.rekap.lkm') }}"
           class="group bg-gradient-to-br from-indigo-600 to-indigo-800 text-white p-7 rounded-2xl shadow-xl
                  hover:shadow-2xl transform hover:-translate-y-1 transition duration-300">
            <div class="flex items-center justify-between">
                <div>
                    <h2 class="text-2xl font-semibold">Rekap LKM Dosen</h2>
                    <p class="text-sm opacity-90">
                        Monitoring aktivitas mengajar
                    </p>
                </div>
                <div class="text-5xl">📚</div>
            </div>
        </a>

        {{-- Honor Tambahan --}}
        <a href="{{ route('admin.akademik.tambahan-honor') }}"
           class="group bg-gradient-to-br from-blue-500 to-indigo-700 text-white p-7 rounded-2xl shadow-xl
                  hover:shadow-2xl transform hover:-translate-y-1 transition duration-300">
            <div class="flex items-center justify-between">
                <div>
                    <h2 class="text-2xl font-semibold">
                        Honor Tambahan Dosen
                    </h2>
                    <p class="mt-1 text-sm opacity-90">
                        Input honor soal & koreksi
                    </p>
                </div>
                <div class="text-5xl opacity-70 group-hover:opacity-100">💰</div>
            </div>
        </a>

        {{-- Monitoring Gaji Dosen --}}
        <a href="{{ route('admin.rekap.gaji-dosen') }}"
           class="group bg-gradient-to-br from-emerald-600 to-emerald-800 text-white p-7 rounded-2xl shadow-xl
                  hover:shadow-2xl transform hover:-translate-y-1 transition duration-300">
            <div class="flex items-center justify-between">
                <div>
                    <h2 class="text-2xl font-semibold">
                        Monitoring Gaji Dosen
                    </h2>
                    <p class="mt-1 text-sm opacity-90">
                        Total honor & gaji bersih dosen
                    </p>
                </div>
                <div class="text-5xl opacity-70 group-hover:opacity-100">📊</div>
            </div>
        </a>

    </div>
</div>
@endsection
