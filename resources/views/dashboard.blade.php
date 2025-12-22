@extends('layouts.app')

@section('content')

<!-- HEADER + WELCOME BOX -->
<div class="mb-8">
    <div class="bg-gradient-to-r from-blue-500 to-indigo-600 text-white rounded-2xl p-6 shadow-lg">
        <h1 class="text-3xl font-bold mb-1">
            👋 Selamat Datang, {{ Auth::user()->name }}
        </h1>

        <p class="text-sm opacity-90 mb-3">
            Dashboard Dosen
        </p>

        <p class="text-base italic">
            “Mengajar bukan hanya menyampaikan ilmu,
            tetapi membentuk masa depan generasi penerus.”
        </p>
    </div>
</div>

<!-- CARD UTAMA -->
<div class="grid grid-cols-1 md:grid-cols-3 gap-6">

    <!-- CARD 1 -->
    <div class="p-6 rounded-2xl shadow-lg bg-gradient-to-br from-blue-500 to-blue-700 text-white hover:scale-105 transition">
        <div class="flex items-center justify-between">
            <h3 class="text-lg font-semibold">Jadwal Mengajar</h3>
            <i class="fa-solid fa-calendar-days text-3xl opacity-80"></i>
        </div>
        <p class="mt-2 opacity-90">Lihat jadwal Anda minggu ini.</p>
        <a href="{{ route('dosen.jadwal.index') }}" class="mt-4 inline-block underline font-semibold">
            Lihat Jadwal →
        </a>
    </div>

    <!-- CARD 2 -->
    <div class="p-6 rounded-2xl shadow-lg bg-gradient-to-br from-emerald-500 to-emerald-700 text-white hover:scale-105 transition">
        <div class="flex items-center justify-between">
            <h3 class="text-lg font-semibold">Tugas Mahasiswa</h3>
            <i class="fa-solid fa-file-lines text-3xl opacity-80"></i>
        </div>
        <p class="mt-2 opacity-90">Pantau tugas yang telah dikumpulkan.</p>
        <a href="{{ route('tugas.pilih') }}" class="mt-4 inline-block underline font-semibold">
            Kelola Tugas →
        </a>
    </div>

    <!-- CARD 3 -->
    <div class="p-6 rounded-2xl shadow-lg bg-gradient-to-br from-indigo-500 to-indigo-700 text-white hover:scale-105 transition">
        <div class="flex items-center justify-between">
            <h3 class="text-lg font-semibold">Materi Kuliah</h3>
            <i class="fa-solid fa-book text-3xl opacity-80"></i>
        </div>
        <p class="mt-2 opacity-90">Upload / update materi pembelajaran.</p>
        <a href="#" class="mt-4 inline-block underline font-semibold">
            Kelola Materi →
        </a>
    </div>

</div>

<!-- SHORTCUT FUNGSI PENTING -->
<div class="mt-10 grid grid-cols-2 md:grid-cols-4 gap-6">

    @php
        $menus = [
            ['icon'=>'fa-user-check', 'text'=>'Absensi', 'color'=>'from-blue-400 to-blue-600', 'link'=>'#'],
            ['icon'=>'fa-money-bill-wave', 'text'=>'Gaji', 'color'=>'from-green-400 to-green-600', 'link'=>'#'],
            ['icon'=>'fa-file-arrow-down', 'text'=>'Download SAP', 'color'=>'from-purple-400 to-purple-600', 'link'=>'#'],
            ['icon'=>'fa-star', 'text'=>'Nilai', 'color'=>'from-pink-400 to-rose-500', 'link'=>'#'],
        ];
    @endphp

    @foreach($menus as $menu)
        <a href="{{ $menu['link'] }}"
           class="p-6 rounded-2xl shadow bg-gradient-to-br {{ $menu['color'] }} text-white text-center hover:scale-105 transition">
            <i class="fa-solid {{ $menu['icon'] }} text-4xl mb-3"></i>
            <h4 class="text-lg font-semibold">{{ $menu['text'] }}</h4>
        </a>
    @endforeach

</div>

@endsection
