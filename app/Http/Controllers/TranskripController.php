<?php

namespace App\Http\Controllers;

use App\Models\Mahasiswa;
use App\Models\Nilai;
use App\Models\Kelas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TranskripController extends Controller
{
    public function index(Request $request)
    {
        $id_kelas = $request->input('id_kelas', null);
        $tahun_akademik = $request->input('tahun_akademik', '2023/2024');

        // Only load mahasiswa data if kelas is selected
        $mahasiswaList = [];
        
        if ($id_kelas) {
            // Query mahasiswa with their nilai data
            $mahasiswaList = Mahasiswa::with('data_kelas.programStudi')
                ->where('id_kelas', $id_kelas)
                ->get();

            // Calculate IPK for each mahasiswa
            foreach ($mahasiswaList as $mhs) {
                // Get all nilai across all semesters
                $allNilai = Nilai::where('id_mahasiswa', $mhs->id_mahasiswa)
                    ->with('mataKuliah')
                    ->get();
                
                // Group by semester
                $semesterData = $allNilai->groupBy('semester');
                
                $totalSksKumulatif = 0;
                $totalBobotKumulatif = 0;
                $ipsPerSemester = [];
                
                foreach ($semesterData as $semester => $nilaiList) {
                    $totalSksSemester = 0;
                    $totalBobotSemester = 0;
                    
                    foreach ($nilaiList as $nilai) {
                        $sks = $nilai->mataKuliah->sks ?? 0;
                        $totalSksSemester += $sks;
                        $totalBobotSemester += ($nilai->bobot_ip ?? 0) * $sks;
                    }
                    
                    $ips = $totalSksSemester > 0 ? round($totalBobotSemester / $totalSksSemester, 2) : 0;
                    $ipsPerSemester[$semester] = [
                        'ips' => $ips,
                        'sks' => $totalSksSemester
                    ];
                    
                    $totalSksKumulatif += $totalSksSemester;
                    $totalBobotKumulatif += $totalBobotSemester;
                }
                
                // Calculate IPK
                $mhs->total_sks = $totalSksKumulatif;
                $mhs->ipk = $totalSksKumulatif > 0 ? round($totalBobotKumulatif / $totalSksKumulatif, 2) : 0;
                $mhs->jml_semester = $semesterData->count();
            }
        }

        // Get kelas list for filter (deduplicated)
        $kelasList = Kelas::with('programStudi')
            ->get()
            ->unique('nama_kelas')
            ->sortBy('nama_kelas');
        
        // Get distinct tahun akademik from nilai table
        // Get distinct tahun akademik from Nilai table
        $tahunAkademikList = Nilai::select('tahun_akademik')
            ->distinct()
            ->orderBy('tahun_akademik', 'desc')
            ->pluck('tahun_akademik');
            
        // Fallback if empty
        if ($tahunAkademikList->isEmpty()) {
            $tahunAkademikList = collect(['2025/2026', '2024/2025', '2023/2024']);
        }

        return view('akademik.transkrip', compact(
            'mahasiswaList',
            'id_kelas',
            'tahun_akademik',
            'kelasList',
            'tahunAkademikList'
        ));
    }

    public function printStudent($nipd)
    {
        $mahasiswa = Mahasiswa::with('data_kelas.programStudi')
            ->where('nipd', $nipd)
            ->firstOrFail();

        // Get all nilai grouped by semester
        $nilaiList = Nilai::where('id_mahasiswa', $mahasiswa->id_mahasiswa)
            ->with('mataKuliah')
            ->orderBy('semester')
            ->orderBy('id_mk')
            ->get();

        $semesterData = $nilaiList->groupBy('semester');
        
        $totalSksKumulatif = 0;
        $totalBobotKumulatif = 0;
        $ipsPerSemester = [];
        
        foreach ($semesterData as $semester => $nilaiSemester) {
            $totalSksSemester = 0;
            $totalBobotSemester = 0;
            
            foreach ($nilaiSemester as $nilai) {
                $sks = $nilai->mataKuliah->sks ?? 0;
                $totalSksSemester += $sks;
                $totalBobotSemester += ($nilai->bobot_ip ?? 0) * $sks;
            }
            
            $ips = $totalSksSemester > 0 ? round($totalBobotSemester / $totalSksSemester, 2) : 0;
            $ipsPerSemester[$semester] = [
                'value' => $ips,
                'sks' => $totalSksSemester
            ];
            
            $totalSksKumulatif += $totalSksSemester;
            $totalBobotKumulatif += $totalBobotSemester;
        }
        
        $ipk = $totalSksKumulatif > 0 ? round($totalBobotKumulatif / $totalSksKumulatif, 2) : 0;

        return view('akademik.transkrip_print', compact(
            'mahasiswa',
            'semesterData',
            'ipsPerSemester',
            'totalSksKumulatif',
            'ipk'
        ));
    }

    public function printBatch(Request $request)
    {
        $id_kelas = $request->input('id_kelas');
        
        $mahasiswaList = Mahasiswa::with('data_kelas.programStudi')
            ->where('id_kelas', $id_kelas)
            ->get();

        $batchData = [];
        
        foreach ($mahasiswaList as $mahasiswa) {
            $nilaiList = Nilai::where('id_mahasiswa', $mahasiswa->id_mahasiswa)
                ->with('mataKuliah')
                ->orderBy('semester')
                ->orderBy('id_mk')
                ->get();

            $semesterData = $nilaiList->groupBy('semester');
            
            $totalSksKumulatif = 0;
            $totalBobotKumulatif = 0;
            $ipsPerSemester = [];
            
            foreach ($semesterData as $semester => $nilaiSemester) {
                $totalSksSemester = 0;
                $totalBobotSemester = 0;
                
                foreach ($nilaiSemester as $nilai) {
                    $sks = $nilai->mataKuliah->sks ?? 0;
                    $totalSksSemester += $sks;
                    $totalBobotSemester += ($nilai->bobot_ip ?? 0) * $sks;
                }
                
                $ips = $totalSksSemester > 0 ? round($totalBobotSemester / $totalSksSemester, 2) : 0;
                $ipsPerSemester[$semester] = [
                    'value' => $ips,
                    'sks' => $totalSksSemester
                ];
                
                $totalSksKumulatif += $totalSksSemester;
                $totalBobotKumulatif += $totalBobotSemester;
            }
            
            $ipk = $totalSksKumulatif > 0 ? round($totalBobotKumulatif / $totalSksKumulatif, 2) : 0;

            $batchData[] = [
                'mahasiswa' => $mahasiswa,
                'semesterData' => $semesterData,
                'ipsPerSemester' => $ipsPerSemester,
                'totalSksKumulatif' => $totalSksKumulatif,
                'ipk' => $ipk
            ];
        }

        return view('akademik.transkrip_print_batch', compact('batchData'));
    }
}
