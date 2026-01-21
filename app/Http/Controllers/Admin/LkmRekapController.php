<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\AbsensiLkm;
use App\Models\Pendidik;
use App\Models\Kelas;
use App\Models\Matakuliah;

class LkmRekapController extends Controller
{
    public function index(Request $request)
    {
        $tahun     = $request->tahun ?? date('Y');
        $id_pendidik      = $request->id_pendidik;
        $kode_mk   = $request->kode_mk;
        $id_kelas  = $request->id_kelas;

        $query = AbsensiLkm::join('pendidik','pendidik.id_pendidik','=','absensi_lkm.id_pendidik')
            ->join('kelas','kelas.id_kelas','=','absensi_lkm.id_kelas')
            ->join('matakuliah','matakuliah.kode_mk','=','absensi_lkm.kode_mk')
            ->select(
                'absensi_lkm.id_pendidik',
                'pendidik.nama_pendidik',
                'kelas.nama_kelas',
                'matakuliah.nama_mk',
                'absensi_lkm.kode_mk',
                'absensi_lkm.id_kelas',
                'absensi_lkm.id_pertemuan',
                'absensi_lkm.tanggal',
                'absensi_lkm.materi',
                'absensi_lkm.metode_mengajar'
            )
            ->groupBy(
                'absensi_lkm.id_pendidik',
                'pendidik.nama_pendidik',
                'kelas.nama_kelas',
                'matakuliah.nama_mk',
                'absensi_lkm.kode_mk',
                'absensi_lkm.id_kelas',
                'absensi_lkm.id_pertemuan',
                'absensi_lkm.tanggal',
                'absensi_lkm.materi',
                'absensi_lkm.metode_mengajar'
            )
            ->orderBy('absensi_lkm.tanggal','desc');

        if ($id_pendidik)     $query->where('absensi_lkm.id_pendidik', $id_pendidik);
        if ($kode_mk)  $query->where('absensi_lkm.kode_mk', $kode_mk);
        if ($id_kelas) $query->where('absensi_lkm.id_kelas', $id_kelas);

        $data = $query->get();

        return view('admin.akademik.rekap_lkm', [
            'data'   => $data,
            'pendidik'  => Pendidik::orderBy('nama_pendidik')->get(),
            'kelas'  => Kelas::orderBy('nama_kelas')->get(),
            'matkul' => Matakuliah::orderBy('nama_mk')->get(),
        ]);
    }
}
