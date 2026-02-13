<?php

namespace App\Http\Controllers;

use App\Models\Krs;
use App\Models\Mahasiswa;
use App\Models\Kelas;
use App\Models\MataKuliah;
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

            $mahasiswaList = $query->with('data_kelas.programStudi')->get();

            // For each mahasiswa, get their KRS count for the selected semester
            foreach ($mahasiswaList as $mhs) {
                $krsQuery = Krs::where('id_mahasiswa', $mhs->id_mahasiswa);
                
                // Only filter by tahun akademik if specified
                if ($tahun_akademik) {
                    $krsQuery->where('tahun_akademik', $tahun_akademik);
                }
                
                if ($semester) {
                    $krsQuery->where('semester', $semester);
                }
                
                // Get KRS list with mataKuliah - execute query only ONCE
                $krsList = $krsQuery->with('mataKuliah')->get();
                
                // Calculate count and Total BK from the same result set
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
        $kelasList = Kelas::with('programStudi')
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

        // Get all pendidik for dropdown
        $pendidikList = \App\Models\Pendidik::orderBy('nama_pendidik')->get();


        return view('akademik.krs', compact(
            'mahasiswaList',
            'id_kelas',
            'semester',
            'tahun_akademik',
            'kelasList',
            'tahunAkademikList',
            'pendidikList'
        ));
    }

    /**
     * Get Program Studi list for cascading select
     */
    public function getProgramStudiList()
    {
        $programStudi = \App\Models\ProgramStudi::select('id_program_studi', 'kode_program_studi', 'nama_program_studi')->get();
        return response()->json($programStudi);
    }

    /**
     * Get Materi Ajar filtered by Bidang Keahlian and Semester
     */
    // API for modal
    public function getMatakuliah(Request $request)
    {
        $id_program_studi = $request->input('id_program_studi');
        $semester = $request->input('semester');
        $id_kelas = $request->input('id_kelas');
        $nipd = $request->input('nipd', 'dummy');
        $tahun_akademik = $request->input('tahun_akademik', '2023/2024');

        // Get id_mahasiswa from nipd
        $mahasiswa = \App\Models\Mahasiswa::where('nipd', $nipd)->first();
        
        $query = MataKuliah::query();

        if ($id_program_studi) {
            $query->where('id_program_studi', $id_program_studi);
        }

        if ($semester) {
            $query->where('semester', $semester);
        }

        $mataKuliah = $query->get();

        // Filter out already registered courses using id_mahasiswa and id_mk
        $registeredMatkulIds = [];
        if ($mahasiswa) {
            $registeredMatkulIds = Krs::where('id_mahasiswa', $mahasiswa->id_mahasiswa)
                ->where('tahun_akademik', $tahun_akademik)
                ->pluck('id_mk')
                ->toArray();
        }

        $availableMatkul = $mataKuliah->filter(function($mk) use ($registeredMatkulIds) {
            return !in_array($mk->id_mk, $registeredMatkulIds);
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
            'id_pendidik' => 'required|exists:pendidik,id_pendidik',
            'matkul_ids' => 'required|array',
            'matkul_ids.*' => 'exists:matakuliah,id_mk'
        ]);

        $id_kelas = $validated['id_kelas'];
        $semester = $validated['semester'];
        $tahun_akademik = $validated['tahun_akademik'];
        $id_pendidik = $validated['id_pendidik'];
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
                    $exists = Krs::where('id_mahasiswa', $student->id_mahasiswa)
                        ->where('id_mk', $id_matkul)
                        ->where('tahun_akademik', $tahun_akademik)
                        ->exists();

                    if (!$exists) {
                    Krs::create([
                        'id_mahasiswa' => $student->id_mahasiswa,
                        'id_pendidik' => $id_pendidik,
                        'id_kelas' => $id_kelas,
                        'id_mk' => $id_matkul,
                        'semester' => $semester,
                        'tahun_akademik' => $tahun_akademik
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

        $mahasiswa = Mahasiswa::where('nipd', $nipd)->with('data_kelas.programStudi')->firstOrFail();
        
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
            ->with('data_kelas.programStudi')
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
        $mahasiswaList = Mahasiswa::with('data_kelas.programStudi')
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
