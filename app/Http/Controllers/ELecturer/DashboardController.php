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
        $id_pendidik = Auth::user()->id_pendidik ?? Auth::id();

        $jadwal = Jadwal::with('matakuliah')
            ->where('id_pendidik', $id_pendidik)
            ->get();

        $progressMengajar = $jadwal->map(function ($j) use ($id_pendidik) {

            $pertemuan = AbsensiLkm::where('id_pendidik', $id_pendidik)
                ->where('id_mk', $j->id_mk)
                ->distinct('pertemuan')
                ->count('pertemuan');

            $totalPertemuan = 16;

            return [
                'nama_mk' => $j->matakuliah->nama_mk ?? $j->id_mk,
                'berjalan' => $pertemuan,
                'total' => $totalPertemuan,
                'persen' => round(($pertemuan / $totalPertemuan) * 100)
            ];
        });

        return view('dashboard', compact('progressMengajar'));
    }
}
