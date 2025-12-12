@extends('layouts.app')

{{-- Menentukan Title untuk halaman ini --}}
@section('title', 'Dashboard Staf Akademik') 

{{-- Bagian konten utama --}}
@section('content')
    <header class="flex justify-between items-center mb-6">
        <div>
            <p class="text-sm font-medium text-gray-500">
                Selamat datang kembali, Bu Rina! 👋
            </p>
            <h1 class="text-3xl font-bold text-gray-900 mt-1">
                Dashboard Staf Akademik
            </h1>
        </div>
        {{-- Bagian Profil dan Notifikasi --}}
        <div class="flex items-center space-x-4">
            <i data-lucide="search" class="w-6 h-6 text-gray-500 cursor-pointer hover:text-blue-500"></i>
            <i data-lucide="bell" class="w-6 h-6 text-gray-500 cursor-pointer hover:text-blue-500"></i>
            <div class="flex items-center space-x-2 p-1.5 bg-gray-100 rounded-full cursor-pointer">
                <img src="https://placehold.co/40x40/3b82f6/ffffff?text=RS" alt="Foto Profil" class="w-10 h-10 rounded-full object-cover border-2 border-white">
                <span class="font-semibold text-gray-800 hidden md:block pr-2">Bu Rina Sari (Staf)</span>
            </div>
        </div>
    </header>

    {{-- KONTEN GRID DASHBOARD --}}
    <div class="dashboard-grid">
        
        {{-- Card 1: Aktivitas Mendatang --}}
        <div class="card col-span-2 lg:col-span-1">
            <div class="flex justify-between items-center mb-4">
                <h2 class="text-lg font-semibold text-gray-700">Aktivitas Mendatang</h2>
                <a href="#" class="text-sm font-medium text-blue-500 hover:text-blue-600">Lihat Kalender</a>
            </div>
            <div class="bg-blue-50 p-4 rounded-xl flex flex-col space-y-3">
                <p class="text-sm text-blue-600 font-medium">
                    <i data-lucide="users" class="w-4 h-4 inline-block mr-1"></i> Rapat Staf Akademik
                </p>
                <p class="text-xl font-bold text-gray-800">
                    Senin, 20 Desember 2025
                </p>
                
                <div class="flex items-center justify-between pt-2 border-t border-blue-200/50">
                    <div class="flex items-center space-x-3">
                        <div class="p-2 bg-white rounded-lg shadow-sm">
                            <i data-lucide="bar-chart-3" class="w-6 h-6 text-gray-700"></i>
                        </div>
                        <div>
                            <p class="text-base font-semibold text-gray-800">Evaluasi Akhir Semester</p>
                            <p class="text-xs text-gray-500">Ruang Rapat Utama</p>
                        </div>
                    </div>
                    <div class="text-right">
                        <span class="text-lg font-bold text-gray-800">09:00 - 11:00 WIB</span>
                    </div>
                </div>
            </div>
        </div>

        {{-- Card 2: Status Penginputan Nilai Dosen --}}
        <div class="card col-span-2 lg:col-span-1">
            <div class="flex justify-between items-center mb-4">
                <h2 class="text-lg font-semibold text-gray-700">Status Penginputan Nilai Dosen</h2>
                <a href="#" class="text-sm font-medium text-blue-500 hover:text-blue-600">Lihat Semua Data</a>
            </div>
            <div class="space-y-4">
                <div class="flex justify-between font-semibold text-gray-800">
                    <span>Progres Nilai (Total 85 Mata Kuliah)</span>
                </div>
                
                <div class="grid grid-cols-3 gap-3 text-center">
                    <div class="p-3 rounded-xl bg-green-50">
                        <p class="text-2xl font-bold text-green-600">55</p>
                        <p class="text-xs text-green-500 mt-1">Selesai (Finalized)</p>
                    </div>
                    <div class="p-3 rounded-xl bg-blue-50">
                        <p class="text-2xl font-bold text-blue-600">20</p>
                        <p class="text-xs text-blue-500 mt-1">Pending (Draft)</p>
                    </div>
                    <div class="p-3 rounded-xl bg-red-50">
                        <p class="text-2xl font-bold text-red-600">10</p>
                        <p class="text-xs text-red-500 mt-1">Belum Input</p>
                    </div>
                </div>

                <div class="pt-4 space-y-2">
                    <p class="text-sm font-medium text-gray-600">Rata-rata Progres Nilai</p>
                    <div class="w-full bg-gray-200 rounded-full h-2.5">
                        <div class="bg-blue-500 h-2.5 rounded-full" style="width: 65%"></div>
                    </div>
                    <p class="text-sm text-gray-500 text-right">65% Nilai Telah Ditetapkan</p>
                </div>
            </div>
        </div>
        
        {{-- Card 3: Rekap Progres Input Nilai Dosen (Tabel) --}}
        <div class="card col-span-3 lg:col-span-2">
            <div class="flex justify-between items-center mb-4">
                <h2 class="text-lg font-semibold text-gray-700">Rekap Progres Input Nilai Dosen</h2>
                <a href="#" class="text-sm font-medium text-blue-500 hover:text-blue-600">Kirim Notifikasi Massal</a>
            </div>
            
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead>
                        <tr class="text-xs font-semibold tracking-wider text-gray-500 uppercase bg-gray-50">
                            <th class="px-3 py-3 text-left">#</th>
                            <th class="px-3 py-3 text-left">Mata Kuliah</th>
                            <th class="px-3 py-3 text-left">Dosen Pengampu</th>
                            <th class="px-3 py-3 text-center">SKS</th>
                            <th class="px-3 py-3 text-center">Tgl Deadline</th>
                            <th class="px-3 py-3 text-center">Status</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100 text-sm">
                        <tr class="hover:bg-gray-50">
                            <td class="px-3 py-3 font-medium text-gray-900">1</td>
                            <td class="px-3 py-3 font-medium text-blue-600">Pemrograman Web Dasar</td>
                            <td class="px-3 py-3 font-medium text-gray-800">Dr. Alya Zahra</td>
                            <td class="px-3 py-3 text-center">3</td>
                            <td class="px-3 py-3 text-center">15 Des</td>
                            <td class="px-3 py-3 text-center">
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">Finalized</span>
                            </td>
                        </tr>
                        <tr class="hover:bg-gray-50">
                            <td class="px-3 py-3 font-medium text-gray-900">2</td>
                            <td class="px-3 py-3 font-medium text-gray-800">Basis Data Lanjut</td>
                            <td class="px-3 py-3 font-medium text-gray-800">Prof. Bima Sakti</td>
                            <td class="px-3 py-3 text-center">4</td>
                            <td class="px-3 py-3 text-center">15 Des</td>
                            <td class="px-3 py-3 text-center">
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">Submitted</span>
                            </td>
                        </tr>
                        <tr class="hover:bg-gray-50">
                            <td class="px-3 py-3 font-medium text-gray-900">3</td>
                            <td class="px-3 py-3 font-medium text-gray-800">Struktur Data</td>
                            <td class="px-3 py-3 font-medium text-gray-800">Dr. Candra Kirana</td>
                            <td class="px-3 py-3 text-center">3</td>
                            <td class="px-3 py-3 text-center">15 Des</td>
                            <td class="px-3 py-3 text-center">
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">Pending</span>
                            </td>
                        </tr>
                        <tr class="hover:bg-gray-50">
                            <td class="px-3 py-3 font-medium text-gray-900">4</td>
                            <td class="px-3 py-3 font-medium text-gray-800">Kewirausahaan IT</td>
                            <td class="px-3 py-3 font-medium text-gray-800">Ms. Dewi Persada</td>
                            <td class="px-3 py-3 text-center">2</td>
                            <td class="px-3 py-3 text-center">15 Des</td>
                            <td class="px-3 py-3 text-center">
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800">Belum Input</span>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        
        {{-- Card 4: Ringkasan Statistik dan Reminder --}}
        <div class="col-span-3 lg:col-span-1 flex flex-col space-y-4">
            
            <div class="grid grid-cols-2 gap-4">
                <div class="card p-4 bg-white text-center">
                    <i data-lucide="alert-triangle" class="w-6 h-6 text-red-500 mx-auto mb-2"></i>
                    <h3 class="text-3xl font-bold text-gray-800">10</h3>
                    <p class="text-xs text-gray-500 mt-1">Input Nilai Tertunda (MK)</p>
                </div>

                <div class="card p-4 bg-white text-center">
                    <i data-lucide="users-2" class="w-6 h-6 text-purple-500 mx-auto mb-2"></i>
                    <h3 class="text-3xl font-bold text-gray-800">452</h3>
                    <p class="text-xs text-gray-500 mt-1">Total Mahasiswa Aktif</p>
                </div>

                <div class="card p-4 bg-white text-center">
                    <i data-lucide="file-warning" class="w-6 h-6 text-orange-500 mx-auto mb-2"></i>
                    <h3 class="text-3xl font-bold text-gray-800">5</h3>
                    <p class="text-xs text-gray-500 mt-1">Pengajuan Cuti/Pindah</p>
                </div>
                
                <div class="card p-4 bg-white text-center">
                    <i data-lucide="percent" class="w-6 h-6 text-sky-500 mx-auto mb-2"></i>
                    <h3 class="text-3xl font-bold text-gray-800">65%</h3>
                    <p class="text-xs text-gray-500 mt-1">Rata-rata Progres Nilai</p>
                </div>
            </div>

            {{-- Card Reminder --}}
            <div class="card p-6 reminder-card-bg text-white shadow-xl">
                <h3 class="text-lg font-bold text-white mb-2">
                    JANGAN LUPA!
                </h3>
                <p class="text-sm font-medium mb-4">
                    Batas akhir input nilai Mahasiswa Semester Ganjil 2025/2026.
                </p>
                <a href="#" class="inline-flex items-center justify-center px-4 py-2 text-sm font-semibold rounded-lg bg-white text-green-600 shadow-md hover:bg-gray-100 transition duration-150">
                    <i data-lucide="log-in" class="w-4 h-4 mr-2"></i>
                    Menuju Portal Nilai Dosen
                </a>
            </div>
        </div>
    </div>
@endsection