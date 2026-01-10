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
        // 1. Get Filter Options First
        // Get kelas list for filter (deduplicated by name)
        $kelasList = Kelas::with('bidangKeahlian')
            ->get()
            ->unique('nama_kelas')
            ->sortBy('nama_kelas');
        
        // Get distinct tahun akademik from Nilai table
        $tahunAkademikList = Nilai::select('tahun_akademik')
            ->distinct()
            ->orderBy('tahun_akademik', 'desc')
            ->pluck('tahun_akademik');
            
        // Fallback if empty
        if ($tahunAkademikList->isEmpty()) {
            $tahunAkademikList = collect(['2025/2026', '2024/2025', '2023/2024']);
        }

        // Get distinct semester from Nilai table
        $semesterList = Nilai::select('semester')
            ->distinct()
            ->orderBy('semester')
            ->pluck('semester');
            
        if ($semesterList->isEmpty()) {
            $semesterList = collect(range(1, 8));
        }

        // 2. Set Defaults based on available options
        $id_kelas = $request->input('id_kelas', null);
        $semester = $request->input('semester', null);
        
        // Default tahun_akademik to null if not specified (allows "All Years" option)
        $tahun_akademik = $request->input('tahun_akademik', null);

        // Check if user clicked the button (not just page load)
        $hasFilters = $request->has('show_data') || $request->has('id_kelas') || $request->has('semester') || $request->has('tahun_akademik');

        // 3. Get Data with Filters - Only if filters are applied
        if ($hasFilters) {
            $query = Mahasiswa::query();

            if ($id_kelas) {
                $query->where('id_kelas', $id_kelas);
            }

            $mahasiswaList = $query->with('data_kelas.bidangKeahlian')->get();

            // For each mahasiswa, calculate KHS stats
            foreach ($mahasiswaList as $mhs) {
                $nilaiQuery = Nilai::where('nipd', $mhs->nipd);
                
                // Only filter by tahun akademik if specified
                if ($tahun_akademik) {
                    $nilaiQuery->where('tahun_akademik', $tahun_akademik);
                }
                
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
        } else {
            // Initial page load - no data
            $mahasiswaList = collect();
        }

        return view('akademik.khs', compact(
            'mahasiswaList',
            'id_kelas',
            'semester',
            'tahun_akademik',
            'kelasList',
            'tahunAkademikList',
            'semesterList'
        ));
    }

    /**
     * Print individual student KHS
     * Print KHS for single student
     */
    public function printStudent($id)
    {
        $semester = request('semester');
        $tahun_akademik = request('tahun_akademik');

        // Validation: Ensure filters are selected
        if (!$semester || !$tahun_akademik) {
            return redirect()->back()->with('error', 'Harap pilih Tahun Akademik dan Semester terlebih dahulu untuk mencetak.');
        }

        $mahasiswa = Mahasiswa::with('data_kelas.bidangKeahlian')->where('nipd', $id)->firstOrFail();
        
        // For individual print, if no semester provided, Show ALL semesters (don't limit to current class semester)
        
        $nilaiQuery = Nilai::with(['mataKuliah', 'kelas'])
            ->where('nipd', $mahasiswa->nipd);
            
        // Only filter by tahun akademik if specified
        if ($tahun_akademik) {
            $nilaiQuery->where('tahun_akademik', $tahun_akademik);
        }

        if ($semester) {
            $nilaiQuery->where('semester', $semester);
        }

        $nilaiList = $nilaiQuery->orderBy('semester')->get();

        // Initialize semesterData always
        $semesterData = [];

        if ($nilaiList->count() > 0) {
            // Group by semester
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
        }

        // Always populate batchData so view can render header/identity
        $batchData = [[
            'mahasiswa' => $mahasiswa,
            'semesterData' => $semesterData
        ]];

        // Reuse the batch print view for consistency
        return view('akademik.khs_print_batch', compact('batchData', 'semester', 'tahun_akademik'));
    }

    /**
     * Batch print KHS for entire class
     */
    public function printBatch(Request $request)
    {
        $id_kelas = $request->input('id_kelas');
        $semester = $request->input('semester');
        $tahun_akademik = $request->input('tahun_akademik');

        // Validation: Ensure filters are selected
        if (!$semester || !$tahun_akademik) {
            return redirect()->back()->with('error', 'Harap pilih Tahun Akademik dan Semester terlebih dahulu untuk mencetak.');
        }

        if (!$id_kelas) {
            return redirect()->back()->with('error', 'Pilih kelas terlebih dahulu');
        }

        $mahasiswaList = Mahasiswa::where('id_kelas', $id_kelas)
            ->with('data_kelas.bidangKeahlian')
            ->get();

        $batchData = [];

        foreach ($mahasiswaList as $mahasiswa) {
            // Smart semester detection: use filter if provided, otherwise use student's class semester
            $semesterToFilter = $semester ?? ($mahasiswa->data_kelas->semester ?? null);
            
            $nilaiQuery = Nilai::with(['mataKuliah', 'kelas'])
                ->where('nipd', $mahasiswa->nipd);
                
            // Only filter by tahun akademik if specified
            if ($tahun_akademik) {
                $nilaiQuery->where('tahun_akademik', $tahun_akademik);
            }

            if ($semesterToFilter) {
                $nilaiQuery->where('semester', $semesterToFilter);
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

    /**
     * Print KHS for all students across all classes
     */
    public function printAll(Request $request)
    {
        $semester = $request->input('semester');
        $tahun_akademik = $request->input('tahun_akademik');

        // Validation: Ensure filters are selected
        if (!$semester || !$tahun_akademik) {
            return redirect()->back()->with('error', 'Harap pilih Tahun Akademik dan Semester terlebih dahulu untuk mencetak.');
        }

        // Get all mahasiswa with their class data
        $mahasiswaList = Mahasiswa::with('data_kelas.bidangKeahlian')
            ->whereNotNull('id_kelas')
            ->get();

        $batchData = [];

        foreach ($mahasiswaList as $mahasiswa) {
            $nilaiQuery = Nilai::with(['mataKuliah', 'kelas'])
                ->where('nipd', $mahasiswa->nipd);
                
            // Only filter by tahun akademik if specified
            if ($tahun_akademik) {
                $nilaiQuery->where('tahun_akademik', $tahun_akademik);
            }

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
