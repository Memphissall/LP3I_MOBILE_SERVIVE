<?php

namespace App\Http\Controllers;

use App\Models\Krs;
use App\Models\Mahasiswa;
use App\Models\Kelas;
use App\Models\MataKuliah;
use App\Models\BidangKeahlian;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class KrsController extends Controller
{
    /**
     * Display student list for KRS management
     */
    public function index(Request $request)
    {
        $id_kelas = $request->input('id_kelas', null);
        $semester = $request->input('semester', null);
        
        // Default tahun_akademik to null if not specified (allows "All Years" option)
        $tahun_akademik = $request->input('tahun_akademik', null);

        // Check if user clicked the button (not just page load)
        $hasFilters = $request->has('show_data') || $request->has('id_kelas') || $request->has('semester') || $request->has('tahun_akademik');

        // Only load data if filters are applied
        if ($hasFilters) {
            // Get mahasiswa list with KRS count
            $query = Mahasiswa::query();

            if ($id_kelas) {
                $query->where('id_kelas', $id_kelas);
            }

            $mahasiswaList = $query->with('data_kelas.bidangKeahlian')->get();

            // For each mahasiswa, get their KRS count for the selected semester
            foreach ($mahasiswaList as $mhs) {
                $krsQuery = Krs::where('nipd', $mhs->nipd);
                
                // Only filter by tahun akademik if specified
                if ($tahun_akademik) {
                    $krsQuery->where('tahun_akademik', $tahun_akademik);
                }
                
                if ($semester) {
                    $krsQuery->where('semester', $semester);
                }
                
                // Get KRS list with mataKuliah - execute query only ONCE
                $krsList = $krsQuery->with('mataKuliah')->get();
                
                // Calculate count and total SKS from the same result set
                $mhs->krs_count = $krsList->count();
                $mhs->total_sks = $krsList->sum(function($krs) {
                    return $krs->mataKuliah->sks ?? 0;
                });
            }
        } else {
            // Initial page load - no data
            $mahasiswaList = collect();
        }

        // Get kelas list for filter (deduplicated by name)
        $kelasList = Kelas::with('bidangKeahlian')
            ->get()
            ->unique('nama_kelas')
            ->sortBy('nama_kelas');
        
        // Get distinct tahun akademik from krs table
        $tahunAkademikList = Krs::select('tahun_akademik')
            ->distinct()
            ->orderBy('tahun_akademik', 'desc')
            ->pluck('tahun_akademik');
            
        // Fallback if empty (e.g. fresh database)
        if ($tahunAkademikList->isEmpty()) {
            $tahunAkademikList = collect(['2025/2026', '2024/2025', '2023/2024']);
        }

        return view('akademik.krs', compact(
            'mahasiswaList',
            'id_kelas',
            'semester',
            'tahun_akademik',
            'kelasList',
            'tahunAkademikList'
        ));
    }

    /**
     * Get Bidang Keahlian list for cascading select
     */
    public function getBidangKeahlianList()
    {
        $bidangKeahlian = BidangKeahlian::select('id_bidang_keahlian', 'kode', 'nama')->get();
        return response()->json($bidangKeahlian);
    }

    /**
     * Get Mata Kuliah filtered by Bidang Keahlian and Semester
     */
    public function getMataKuliahFiltered(Request $request)
    {
        $id_bidang_keahlian = $request->input('id_bidang_keahlian');
        $semester = $request->input('semester');
        $id_kelas = $request->input('id_kelas');
        $nipd = $request->input('nipd', 'dummy');
        $tahun_akademik = $request->input('tahun_akademik', '2023/2024');

        $query = MataKuliah::query();

        if ($id_bidang_keahlian) {
            $query->where('id_bidang_keahlian', $id_bidang_keahlian);
        }

        if ($semester) {
            $query->where('semester', $semester);
        }

        $mataKuliah = $query->get();

        // Filter out already registered courses for this student
        $registeredMatkulIds = Krs::where('nipd', $nipd)
            ->where('tahun_akademik', $tahun_akademik)
            ->pluck('id_matkul')
            ->toArray();

        $availableMatkul = $mataKuliah->filter(function($mk) use ($registeredMatkulIds) {
            return !in_array($mk->id_matkul, $registeredMatkulIds);
        });

        return response()->json($availableMatkul->values());
    }

    /**
     * Store batch KRS for entire class
     */
    public function storeBatch(Request $request)
    {
        $validated = $request->validate([
            'id_kelas' => 'required|exists:kelas,id_kelas',
            'semester' => 'required|integer',
            'tahun_akademik' => 'required',
            'matkul_ids' => 'required|array',
            'matkul_ids.*' => 'exists:mata_kuliah,id_matkul'
        ]);

        $id_kelas = $validated['id_kelas'];
        $semester = $validated['semester'];
        $tahun_akademik = $validated['tahun_akademik'];
        $matkul_ids = $validated['matkul_ids'];

        DB::beginTransaction();
        try {
            // Get all students in the class
            $students = Mahasiswa::where('id_kelas', $id_kelas)->get();
            
            if ($students->isEmpty()) {
                return response()->json(['error' => 'Tidak ada mahasiswa di kelas ini'], 404);
            }

            $count = 0;
            foreach ($students as $student) {
                foreach ($matkul_ids as $id_matkul) {
                    // Check if already exists to avoid duplicates
                    $exists = Krs::where('nipd', $student->nipd)
                        ->where('id_matkul', $id_matkul)
                        ->where('tahun_akademik', $tahun_akademik)
                        ->exists();

                    if (!$exists) {
                        Krs::create([
                            'nipd' => $student->nipd,
                            'nama_mhs' => $student->nama,
                            'id_kelas' => $id_kelas,
                            'id_matkul' => $id_matkul,
                            'semester' => $semester,
                            'periode' => 'Ganjil',
                            'tahun_akademik' => $tahun_akademik,
                            'status' => 'Approved'
                        ]);
                        $count++;
                    }
                }
            }
            
            DB::commit();
            return response()->json([
                'message' => "Berhasil menambahkan KRS untuk " . $students->count() . " mahasiswa. Total entry: $count"
            ]);

        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    /**
     * Print individual student KRS
     */
    public function printStudent(Request $request, $nipd)
    {
        $semester = $request->input('semester');
        $tahun_akademik = $request->input('tahun_akademik');

        // Validation: Ensure filters are selected
        if (!$semester || !$tahun_akademik) {
            return redirect()->back()->with('error', 'Harap pilih Tahun Akademik dan Semester terlebih dahulu untuk mencetak.');
        }

        $mahasiswa = Mahasiswa::where('nipd', $nipd)->with('data_kelas.bidangKeahlian')->firstOrFail();
        
        $krsQuery = Krs::with(['mataKuliah', 'kelas'])
            ->where('nipd', $mahasiswa->nipd);
            
        // Only filter by tahun akademik if specified
        if ($tahun_akademik) {
            $krsQuery->where('tahun_akademik', $tahun_akademik);
        }

        // Allow explicit semester filter
        if ($semester) {
            $krsQuery->where('semester', $semester);
        }

        $krsList = $krsQuery->orderBy('semester')->get();

        $krsList = $krsQuery->orderBy('semester')->get();

        // Calculate SKS (0 if list is empty)
        $totalSKS = $krsList->sum(function($krs) {
            return $krs->mataKuliah->sks ?? 0;
        });

        // Always populate batchData so view can render header/identity
        $batchData = [[
            'mahasiswa' => $mahasiswa,
            'krsList' => $krsList,
            'totalSKS' => $totalSKS
        ]];

        return view('akademik.krs_print_batch', compact(
            'batchData',
            'semester',
            'tahun_akademik'
        ));
    }

    /**
     * Batch print KRS for entire class
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
            
            $krsList = Krs::with(['mataKuliah', 'kelas'])
                ->where('nipd', $mahasiswa->nipd);
                
            // Only filter by tahun akademik if specified
            if ($tahun_akademik) {
                $krsList->where('tahun_akademik', $tahun_akademik);
            }

            if ($semesterToFilter) {
                $krsList->where('semester', $semesterToFilter);
            }

            $krsList = $krsList->orderBy('semester')->get();

            if ($krsList->count() > 0) {
                $totalSKS = $krsList->sum(function($krs) {
                    return $krs->mataKuliah->sks ?? 0;
                });

                $batchData[] = [
                    'mahasiswa' => $mahasiswa,
                    'krsList' => $krsList,
                    'totalSKS' => $totalSKS
                ];
            }
        }

        return view('akademik.krs_print_batch', compact(
            'batchData',
            'semester',
            'tahun_akademik'
        ));
    }

    /**
     * Print KRS for all students across all classes
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
            $krsList = Krs::with(['mataKuliah', 'kelas'])
                ->where('nipd', $mahasiswa->nipd);
                
            // Only filter by tahun akademik if specified
            if ($tahun_akademik) {
                $krsList->where('tahun_akademik', $tahun_akademik);
            }

            if ($semester) {
                $krsList->where('semester', $semester);
            }

            $krsList = $krsList->orderBy('semester')->get();

            if ($krsList->count() > 0) {
                $totalSKS = $krsList->sum(function($krs) {
                    return $krs->mataKuliah->sks ?? 0;
                });

                $batchData[] = [
                    'mahasiswa' => $mahasiswa,
                    'krsList' => $krsList,
                    'totalSKS' => $totalSKS
                ];
            }
        }

        return view('akademik.krs_print_batch', compact(
            'batchData',
            'semester',
            'tahun_akademik'
        ));
    }
}
