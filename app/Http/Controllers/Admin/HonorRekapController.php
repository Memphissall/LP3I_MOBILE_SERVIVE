<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Honor;
use App\Models\Dosen;
use Illuminate\Http\Request;

class HonorRekapController extends Controller
{
    public function index(Request $request)
{
    $query = Honor::query()
        ->join('dosen', 'dosen.nidn', '=', 'honor.nidn')
        ->select(
            'honor.*',
            'dosen.nama_dosen'
        );

    if ($request->nidn) {
        $query->where('honor.nidn', $request->nidn);
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
    if ($request->nidn || $request->bulan) {
        $totalGaji = $data->sum('gaji_bersih');
    }

   return view('admin.akademik.rekap_gaji_dosen', compact(
    'data',
    'totalGaji'
));

}

}
