<?php

namespace App\Http\Controllers\ELecturer;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\AbsensiLkm;
use App\Models\Jadwal;

class DashboardController extends Controller
{
    public function index()
    {
        $nidn = Auth::user()->nidn ?? Auth::id();

        $jadwal = Jadwal::with('matakuliah')
            ->where('nidn', $nidn)
            ->get();

        $progressMengajar = $jadwal->map(function ($j) use ($nidn) {

            $pertemuan = AbsensiLkm::where('nidn', $nidn)
                ->where('kode_mk', $j->kode_mk)
                ->distinct('id_pertemuan')
                ->count('id_pertemuan');

            $totalPertemuan = 16;

            return [
                'nama_mk' => $j->matakuliah->nama_mk ?? $j->kode_mk,
                'berjalan' => $pertemuan,
                'total' => $totalPertemuan,
                'persen' => round(($pertemuan / $totalPertemuan) * 100)
            ];
        });

        return view('dashboard', compact('progressMengajar'));
    }
}
