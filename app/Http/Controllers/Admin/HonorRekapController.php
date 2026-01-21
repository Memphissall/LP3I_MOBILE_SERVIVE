<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Honor;
use App\Models\Pendidik;
use Illuminate\Http\Request;

class HonorRekapController extends Controller
{
    public function index(Request $request)
{
    $query = Honor::query()
        ->join('pendidik', 'pendidik.id_pendidik', '=', 'honor.id_pendidik')
        ->select(
            'honor.*',
            'pendidik.nama_pendidik'
        );

    if ($request->id_pendidik) {
        $query->where('honor.id_pendidik', $request->id_pendidik);
    }

    if ($request->bulan) {
        $query->where('honor.bulan', $request->bulan);
    }

    if ($request->tahun) {
        $query->where('honor.tahun', $request->tahun);
    }

    $data = $query->get();

    // 👉 TOTAL HANYA DIHITUNG JIKA ADA FILTER
    $totalGaji = null;
    if ($request->id_pendidik || $request->bulan) {
        $totalGaji = $data->sum('gaji_bersih');
    }

   return view('admin.akademik.rekap_gaji_pendidik', compact(
    'data',
    'totalGaji'
));

}

}
