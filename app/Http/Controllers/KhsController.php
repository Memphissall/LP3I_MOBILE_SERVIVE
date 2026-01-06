<?php

namespace App\Http\Controllers;

use App\Models\Nilai;
use App\Models\Mahasiswa;
use App\Models\Kelas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class KhsController extends Controller
{
    /**
     * Display student list for KHS management
     */
    public function index(Request $request)
    {
        $id_kelas = $request->input('id_kelas', null);
        $semester = $request->input('semester', null);
        $tahun_akademik = $request->input('tahun_akademik', '2023/2024');

        // Get mahasiswa list
        $query = Mahasiswa::query();

        if ($id_kelas) {
            $query->where('id_kelas', $id_kelas);
        }

        $mahasiswaList = $query->with('data_kelas.bidangKeahlian')->get();

        // For each mahasiswa, calculate KHS stats
        foreach ($mahasiswaList as $mhs) {
            $nilaiQuery = Nilai::where('nipd', $mhs->nipd)
                ->where('tahun_akademik', $tahun_akademik);
            
            if ($semester) {
                $nilaiQuery->where('semester', $semester);
            }
            
            $nilaiList = $nilaiQuery->with('mataKuliah')->get();
            
            $mhs->nilai_count = $nilaiList->count();
            
            // Calculate Total SKS
            $mhs->total_sks = $nilaiList->sum(function($nilai) {
                return $nilai->mataKuliah->sks ?? 0;
            });
            
            // Calculate IPS (Indeks Prestasi Semester)
            $totalBobot = $nilaiList->sum('bobot_ip');
            $mhs->ips = $mhs->total_sks > 0 ? round($totalBobot / $mhs->total_sks, 2) : 0;
        }

        // Get kelas list for filter
        $kelasList = Kelas::with('bidangKeahlian')->get();
        
        // Get distinct tahun akademik from mahasiswa periode (same as angkatan logic)
        $tahunAkademikList = Mahasiswa::select('periode')
            ->whereNotNull('periode')
            ->distinct()
            ->orderBy('periode', 'desc')
            ->pluck('periode');

        return view('akademik.khs', compact(
            'mahasiswaList',
            'id_kelas',
            'semester',
            'tahun_akademik',
            'kelasList',
            'tahunAkademikList'
        ));
    }

    /**
     * Print individual student KHS
     */
    public function printStudent(Request $request, $nipd)
    {
        $semester = $request->input('semester');
        $tahun_akademik = $request->input('tahun_akademik', '2023/2024');

        $mahasiswa = Mahasiswa::where('nipd', $nipd)->with('data_kelas.bidangKeahlian')->first();
        
        if (!$mahasiswa) {
            abort(404, 'Mahasiswa tidak ditemukan');
        }

        $nilaiQuery = Nilai::with(['mataKuliah', 'kelas'])
            ->where('nipd', $nipd)
            ->where('tahun_akademik', $tahun_akademik);

        if ($semester) {
            $nilaiQuery->where('semester', $semester);
        }

        $nilaiList = $nilaiQuery->orderBy('semester')->get();

        // Group by semester
        $semesterData = [];
        foreach ($nilaiList as $nilai) {
            $sem = $nilai->semester;
            if (!isset($semesterData[$sem])) {
                $semesterData[$sem] = [
                    'nilai' => [],
                    'total_sks' => 0,
                    'total_bobot' => 0,
                    'ips' => 0
                ];
            }
            
            $semesterData[$sem]['nilai'][] = $nilai;
            $semesterData[$sem]['total_sks'] += $nilai->mataKuliah->sks ?? 0;
            $semesterData[$sem]['total_bobot'] += $nilai->bobot_ip ?? 0;
        }

        // Calculate IPS for each semester
        foreach ($semesterData as $sem => &$data) {
            $data['ips'] = $data['total_sks'] > 0 ? round($data['total_bobot'] / $data['total_sks'], 2) : 0;
        }

        return view('akademik.khs_print', compact(
            'mahasiswa',
            'semesterData',
            'semester',
            'tahun_akademik'
        ));
    }

    /**
     * Batch print KHS for entire class
     */
    public function printBatch(Request $request)
    {
        $id_kelas = $request->input('id_kelas');
        $semester = $request->input('semester');
        $tahun_akademik = $request->input('tahun_akademik', '2023/2024');

        if (!$id_kelas) {
            return redirect()->back()->with('error', 'Pilih kelas terlebih dahulu');
        }

        $mahasiswaList = Mahasiswa::where('id_kelas', $id_kelas)
            ->with('data_kelas.bidangKeahlian')
            ->get();

        $batchData = [];

        foreach ($mahasiswaList as $mahasiswa) {
            $nilaiQuery = Nilai::with(['mataKuliah', 'kelas'])
                ->where('nipd', $mahasiswa->nipd)
                ->where('tahun_akademik', $tahun_akademik);

            if ($semester) {
                $nilaiQuery->where('semester', $semester);
            }

            $nilaiList = $nilaiQuery->orderBy('semester')->get();

            if ($nilaiList->count() > 0) {
                // Group by semester
                $semesterData = [];
                foreach ($nilaiList as $nilai) {
                    $sem = $nilai->semester;
                    if (!isset($semesterData[$sem])) {
                        $semesterData[$sem] = [
                            'nilai' => [],
                            'total_sks' => 0,
                            'total_bobot' => 0,
                            'ips' => 0
                        ];
                    }
                    
                    $semesterData[$sem]['nilai'][] = $nilai;
                    $semesterData[$sem]['total_sks'] += $nilai->mataKuliah->sks ?? 0;
                    $semesterData[$sem]['total_bobot'] += $nilai->bobot_ip ?? 0;
                }

                // Calculate IPS
                foreach ($semesterData as $sem => &$data) {
                    $data['ips'] = $data['total_sks'] > 0 ? round($data['total_bobot'] / $data['total_sks'], 2) : 0;
                }

                $batchData[] = [
                    'mahasiswa' => $mahasiswa,
                    'semesterData' => $semesterData
                ];
            }
        }

        return view('akademik.khs_print_batch', compact(
            'batchData',
            'semester',
            'tahun_akademik'
        ));
    }
}
