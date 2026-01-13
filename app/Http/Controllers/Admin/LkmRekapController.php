<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\AbsensiLkm;
use App\Models\Dosen;
use App\Models\Kelas;
use App\Models\Matakuliah;

class LkmRekapController extends Controller
{
    public function index(Request $request)
    {
        $tahun     = $request->tahun ?? date('Y');
        $nidn      = $request->nidn;
        $kode_mk   = $request->kode_mk;
        $id_kelas  = $request->id_kelas;

        $query = AbsensiLkm::join('dosen','dosen.nidn','=','absensi_lkm.nidn')
            ->join('kelas','kelas.id_kelas','=','absensi_lkm.id_kelas')
            ->join('matakuliah','matakuliah.kode_mk','=','absensi_lkm.kode_mk')
            ->select(
                'absensi_lkm.nidn',
                'dosen.nama_dosen',
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
                'absensi_lkm.nidn',
                'dosen.nama_dosen',
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

        if ($nidn)     $query->where('absensi_lkm.nidn', $nidn);
        if ($kode_mk)  $query->where('absensi_lkm.kode_mk', $kode_mk);
        if ($id_kelas) $query->where('absensi_lkm.id_kelas', $id_kelas);

        $data = $query->get();

        return view('admin.akademik.rekap_lkm', [
            'data'   => $data,
            'dosen'  => Dosen::orderBy('nama_dosen')->get(),
            'kelas'  => Kelas::orderBy('nama_kelas')->get(),
            'matkul' => Matakuliah::orderBy('nama_mk')->get(),
        ]);
    }
}
