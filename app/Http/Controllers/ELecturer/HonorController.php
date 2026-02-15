<?php

namespace App\Http\Controllers\ELecturer;

use App\Http\Controllers\Controller;
use App\Models\Honor;
use App\Models\Matakuliah;
use App\Models\Pendidik;
use App\Models\AbsensiLkm;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class HonorController extends Controller
{

public function index()
{
    $pendidik = Pendidik::where('id_user', Auth::id())->firstOrFail();
    $now = Carbon::now();

    if ($now->day <= 25) {
        $tgl_awal  = $now->copy()->subMonth()->day(26)->startOfDay();
        $tgl_akhir = $now->copy()->day(25)->endOfDay();
    } else {
        $tgl_awal  = $now->copy()->day(26)->startOfDay();
        $tgl_akhir = $now->copy()->addMonth()->day(25)->endOfDay();
    }

    $honor = Honor::with(['matkul', 'kelas'])
        ->where('id_pendidik', $pendidik->id_pendidik)
        ->whereBetween('tanggal', [$tgl_awal, $tgl_akhir])
        ->orderBy('tanggal', 'desc') 
        ->orderByDesc('id_honor') 
        ->get();

    // // ================= TOTAL =================
    // $totalGajiBersih = $honor->sum('gaji_bersih');
    // $totalHonorMengajar = $honor->sum('honor_mengajar');
    // $totalPPN = $honor->sum('ppn');

   // ================= TOTAL KOTOR =================
$totalKotor = $honor->sum('total_kotor');

// ================= HITUNG PAJAK SEKALI =================
$totalPPN = intval($totalKotor * 0.05);

// ================= GAJI BERSIH =================
$totalGajiBersih = $totalKotor - $totalPPN;



    return view('admin.pendidik.gaji.index', compact(
    'honor',
    'tgl_awal',
    'tgl_akhir',
    'totalKotor',
    'totalPPN',
    'totalGajiBersih'
));

}

public function rekapGaji(Request $request)
{
    $pendidikId = auth()->user()->pendidik->id_pendidik;

    $rekap = DB::table('honor')
        ->where('id_pendidik', $pendidikId)
        ->whereBetween('tanggal', [$request->start, $request->end])
        ->get();

    // 🔥 TOTAL GAJI BERSIH (570.000)
    $totalGajiBersih = $rekap->sum('gaji_bersih');

    return view('pendidik.gaji.rekap', compact(
        'rekap',
        'totalGajiBersih'
    ));
}


}
