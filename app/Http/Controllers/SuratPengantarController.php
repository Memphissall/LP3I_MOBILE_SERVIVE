<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;

class SuratPengantarController extends Controller
{
    public function index()
    {
        return view('akademik.surat_pengantar');
    }

    public function print(Request $request)
    {
        $tanggalSurat = $request->tanggal_surat
            ? Carbon::parse($request->tanggal_surat)->locale('id')->isoFormat('D MMMM YYYY')
            : Carbon::now()->locale('id')->isoFormat('D MMMM YYYY');

        $hariKegiatan    = null;
        $tanggalKegiatan = null;
        if ($request->tanggal_kegiatan) {
            $dt              = Carbon::parse($request->tanggal_kegiatan)->locale('id');
            $hariKegiatan    = $dt->isoFormat('dddd');
            $tanggalKegiatan = $dt->isoFormat('D MMMM YYYY');
        }

        $data = [
            'nomor_surat'      => $request->nomor_surat ?? '-',
            'tanggal_surat'    => $tanggalSurat,
            'kepada_yth'       => $request->kepada_yth ?? 'Bapak/Ibu Pimpinan',
            'instansi_tujuan'  => $request->instansi_tujuan ?? '',
            'perihal'          => $request->perihal ?? '',
            'lampiran'         => $request->lampiran ?? '-',
            'tema_kegiatan'    => $request->tema_kegiatan ?? '',
            'hari_kegiatan'    => $hariKegiatan,
            'tanggal_kegiatan' => $tanggalKegiatan,
            'waktu'            => $request->waktu ?? '',
            'tempat'           => $request->tempat ?? '',
        ];

        return view('akademik.print_surat_pengantar', $data);
    }
}
