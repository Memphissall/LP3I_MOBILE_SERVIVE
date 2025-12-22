<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BobotNilai;
use App\Models\Matakuliah;
use Illuminate\Http\Request;

class BobotNilaiController extends Controller
{
    public function index()
    {
        // data bobot (untuk tabel bawah)
        $bobot = BobotNilai::with('matakuliah')->get();

        // ⬅️ INI YANG KURANG DARI KEMARIN
        // data mata kuliah (untuk dropdown)
        $matakuliah = Matakuliah::orderBy('nama_mk')->get();

        return view('admin.bobot.index', compact('bobot', 'matakuliah'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'kode_mk'   => 'required',
            'kehadiran' => 'required|integer',
            'sikap'     => 'required|integer',
            'formatif'  => 'required|integer',
            'tugas'     => 'required|integer',
            'uts'       => 'required|integer',
            'uas'       => 'required|integer',
        ]);

        $total =
            $request->kehadiran +
            $request->sikap +
            $request->formatif +
            $request->tugas +
            $request->uts +
            $request->uas;

        if ($total !== 100) {
            return back()->with('error', 'Total bobot harus 100%');
        }

        BobotNilai::updateOrCreate(
            ['kode_mk' => $request->kode_mk],
            [
                'kehadiran' => $request->kehadiran,
                'sikap'     => $request->sikap,
                'formatif'  => $request->formatif,
                'tugas'     => $request->tugas,
                'uts'       => $request->uts,
                'uas'       => $request->uas,
                'total'     => $total,
            ]
        );

        return back()->with('success', 'Bobot berhasil disimpan');
    }
}
