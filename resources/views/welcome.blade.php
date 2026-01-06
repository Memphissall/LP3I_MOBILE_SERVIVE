<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistem Operasional Akademik</title>
    @vite(['resources/css/app.css', 'resources/js/app.jsx'])
    {{-- Pastikan Font Awesome (atau ikon lain) diimpor jika menggunakan ikon --}}
</head>
<body class="bg-gray-50 font-sans">

    {{-- NAVIGASI: Ditambah kelas 'sticky top-0 z-30' agar selalu menempel di atas --}}
    <nav class="bg-white shadow-md p-4 sticky top-0 z-30">
        <div class="max-w-7xl mx-auto flex justify-between items-center">
            
            <div class="flex flex-col items-start leading-none">
                <div class="text-2xl font-bold text-gray-800">
                    <span class="text-3xl font-extrabold text-blue-500 mr-0.5">E</span><span class="text-3xl font-bold text-gray-400">|</span>
                    <span class="text-red-600">Management</span>
                </div>
                <div class="text-xs font-semibold text-gray-500 mt-0.5">
                    integration system in one solution
                </div>
            </div>
            <a href="{{ route('login') }}" class="bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-4 rounded-lg transition duration-300 shadow-lg">
                Login / Masuk Sistem
            </a>
        </div>
    </nav>

    <header class="relative bg-gray-800 text-white py-24 md:py-32 overflow-hidden">
        <div class="max-w-7xl mx-auto px-2 sm:px-4 lg:px-8 relative z-20">
            <h1 class="text-4xl md:text-6xl font-extrabold leading-tight mb-10">
                Sistem Terpadu untuk Operasional Akademik
            </h1>
            
            <div class="bg-blue-600/90 border-l-4 border-yellow-300 p-4 mb-8 max-w-xl rounded-lg shadow-xl">
                <h2 class="text-2xl font-bold mb-2">E-Academia</h2>
                <p class="text-sm text-gray-100">
                    E-Academia merupakan aplikasi yang saling terintegrasi antara bidang *E-Academia* di LP3I. E-Academia berfungsi untuk melayani kebutuhan yang diperlukan oleh programmer, kepala akademik, dan tidak hanya di Mahasiswa, untuk kalangan civitas akademika (manajemen).
                </p>
                <p class="text-xs font-semibold text-yellow-300 mt-2">
                    *Himbauan: Masuk untuk dapat melakukan update data user login melalui administrator cabang untuk meningkatkan keamanan akun, Terima Kasih.*
                </p>
            </div>
            <p class="text-xl md:text-2xl text-gray-300 mb-8 max-w-3xl">
                Platform E-Academia, E-Lecture, dan E-Student dalam satu kendali, mempermudah proses belajar mengajar dan administrasi kampus.
            </p>

        </div>
        
        {{-- Gambar Background --}}
        <div class="absolute inset-0 opacity-30 bg-cover bg-center z-0" style="background-image: url('{{ asset('images/akademik-lp3i.webp') }}');"></div>
    </header>

    <section class="py-16 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h2 class="text-3xl font-bold text-gray-800 mb-10">Tiga Pilar Utama Sistem</h2>
            
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div class="p-6 border border-gray-200 rounded-xl shadow-lg hover:shadow-2xl transition duration-300">
                    <div class="text-4xl text-red-500 mb-4"><i class="fas fa-desktop"></i></div>
                    <h3 class="text-xl font-semibold mb-3">E-Academia (Akademik)</h3>
                    <p class="text-gray-600">Fokus pada validasi data, kelola jadwal induk, data master (Dosen, Mahasiswa, Ruangan), dan pelaporan akhir.</p>
                </div>
                
                <div class="p-6 border border-gray-200 rounded-xl shadow-lg hover:shadow-2xl transition duration-300">
                    <div class="text-4xl text-blue-500 mb-4"><i class="fas fa-chalkboard-teacher"></i></div>
                    <h3 class="text-xl font-semibold mb-3">E-Lecture (Dosen)</h3>
                    <p class="text-gray-600">Akses jadwal mengajar, input absensi, kelola materi kuliah, dan input nilai per kelas.</p>
                </div>

                <div class="p-6 border border-gray-200 rounded-xl shadow-lg hover:shadow-2xl transition duration-300">
                    <div class="text-4xl text-green-500 mb-4"><i class="fas fa-user-graduate"></i></div>
                    <h3 class="text-xl font-semibold mb-3">E-Student (Mahasiswa)</h3>
                    <p class="text-gray-600">Pengisian KRS, cek KHS, lihat jadwal kuliah, unduh materi, dan cek Transkrip Nilai.</p>
                </div>
            </div>
        </div>
    </section>

    <footer class="bg-gray-800 text-center py-6">
        <p class="text-gray-400 text-sm">© {{ date('Y') }} Sistem Operasional Akademik. All rights reserved.</p>
    </footer>

</body>
</html>