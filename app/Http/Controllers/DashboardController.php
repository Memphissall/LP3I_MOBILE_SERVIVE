<?php

namespace App\Http\Controllers;

use Illuminate\Routing\Controller; 
use Illuminate\Http\Request;
use App\Models\Mahasiswa;
use App\Models\Dosen;
use App\Models\MataKuliah;
use App\Models\Kelas;
use App\Models\Krs;
use App\Models\Nilai;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        // Greeting based on time of day
        $hour = now()->format('H');
        $greeting = 'Selamat Malam';
        
        if ($hour >= 5 && $hour < 11) {
            $greeting = 'Selamat Pagi';
        } elseif ($hour >= 11 && $hour < 15) {
            $greeting = 'Selamat Siang';
        } elseif ($hour >= 15 && $hour < 18) {
            $greeting = 'Selamat Sore';
        }
        
        // Motivational quotes array
        $quotes = [
            'Pendidikan adalah senjata paling ampuh yang bisa Anda gunakan untuk mengubah dunia. - Nelson Mandela',
            'Investasi terbaik adalah investasi dalam diri sendiri melalui pendidikan. - Benjamin Franklin',
            'Kesuksesan adalah hasil dari persiapan, kerja keras, dan belajar dari kegagalan. - Colin Powell',
            'Tujuan pendidikan adalah untuk mengganti pikiran kosong dengan yang terbuka. - Malcolm Forbes',
            'Pendidikan bukan mengisi ember, tetapi menyalakan api. - William Butler Yeats',
            'Belajar tanpa berpikir adalah sia-sia. Berpikir tanpa belajar adalah berbahaya. - Confucius',
            'Kualitas pendidikan sama pentingnya dengan makanan dan tempat tinggal. - Kailash Satyarthi',
            'Ilmu tanpa amalan bagaikan pohon tanpa buah. - Pepatah Arab',
            'Masa depan milik mereka yang percaya pada keindahan impian mereka. - Eleanor Roosevelt',
            'Pendidikan adalah paspor untuk masa depan, karena hari esok adalah milik mereka yang mempersiapkannya hari ini. - Malcolm X'
        ];
        
        // Get random quote
        $randomQuote = $quotes[array_rand($quotes)];
        
        // Quick statistics for mini cards
        $stats = [
            'total_mahasiswa' => Mahasiswa::count(),
            'total_dosen' => Dosen::count(),
            'total_matkul' => MataKuliah::count(),
            'mahasiswa_aktif' => Mahasiswa::where('status', 'Aktif')->count(),
        ];
        
        return view('dashboard', compact('greeting', 'randomQuote', 'stats')); 
    }
}