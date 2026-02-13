<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Jadwal;
use App\Models\MataKuliah;
use App\Models\Kelas;
use App\Models\Ruangan;
use App\Models\ProgramStudi;
use Illuminate\Support\Facades\Validator;

class JadwalController extends Controller
{
    /**
     * Get list of schedules with filters and relationships
     */
    public function index(Request $request)
    {
        $query = Jadwal::with(['mataKuliah.programStudi', 'kelas.programStudi', 'ruangan', 'pendidik']);

        // Filter by bidang keahlian (through Materi Ajar)
        if ($request->filled('id_program_studi') && $request->id_program_studi !== 'all') {
            $query->whereHas('mataKuliah', function($q) use ($request) {
                $q->where('id_program_studi', $request->id_program_studi);
            });
        }

        // Filter by semester (through Materi Ajar)
        if ($request->filled('semester') && $request->semester !== 'all') {
            $query->whereHas('mataKuliah', function($q) use ($request) {
                $q->where('semester', $request->semester);
            });
        }

        // Filter by kelas
        if ($request->filled('id_kelas') && $request->id_kelas !== 'Semua Kelas') {
            $query->where('id_kelas', $request->id_kelas);
        }

        // Filter by hari
        if ($request->filled('hari') && $request->hari !== 'Semua Hari') {
            $query->where('hari', $request->hari);
        }

        // Filter by ruangan
        if ($request->filled('id_ruangan') && $request->id_ruangan !== 'Semua Ruangan') {
            $query->where('id_ruangan', $request->id_ruangan);
        }

        $jadwal = $query->orderBy('hari')->orderBy('jam_mulai')->get();
        return response()->json($jadwal);
    }

    /**
     * Get program studi list
     */
    public function getProgramStudiList()
    {
        $programStudi = ProgramStudi::orderBy('nama_program_studi')->get();
        return response()->json($programStudi);
    }

    /**
     * Get Materi Ajar filtered by bidang keahlian and semester
     */
    public function getMataKuliahByFilter(Request $request)
    {
        $query = MataKuliah::with('programStudi')->select('id_mk', 'kode_mk', 'nama_mk', 'sks', 'semester', 'id_program_studi');

        if ($request->filled('id_program_studi') && $request->id_program_studi !== 'all') {
            $query->where('id_program_studi', $request->id_program_studi);
        }

        if ($request->filled('semester') && $request->semester !== 'all') {
            $query->where('semester', $request->semester);
        }

        // Deduplicate by nama_mk
        $mataKuliah = $query->orderBy('semester')->orderBy('kode_mk')->get()->unique('nama_mk')->values();
        return response()->json($mataKuliah);
    }

    /**
     * Get kelas filtered by program studi
     */
    public function getKelasByProgramStudi(Request $request)
    {
        $query = Kelas::with('programStudi')->select('id_kelas', 'nama_kelas', 'id_program_studi');

        if ($request->filled('id_program_studi') && $request->id_program_studi !== 'all') {
            $query->where('id_program_studi', $request->id_program_studi);
        }

        if ($request->filled('semester') && $request->semester !== 'all') {
            $query->where('semester', $request->semester);
        }

        // Deduplicate by nama_kelas
        $kelas = $query->orderBy('nama_kelas')->get()->unique('nama_kelas')->values();
        return response()->json($kelas);
    }

    /**
     * Get pendidik list
     */
    public function getPendidikList(Request $request)
    {
        $query = \App\Models\Pendidik::select('id_pendidik', 'nama_pendidik', 'nidn');

        // Deduplicate by nama_pendidik
        $pendidik = $query->orderBy('nama_pendidik')->get()->unique('nama_pendidik')->values();
        return response()->json($pendidik);
    }

    /**
     * Get dropdown data for create/edit forms
     */
    public function getDropdownData()
    {
        return response()->json([
            'program_studi' => ProgramStudi::select('id_program_studi', 'kode_program_studi', 'nama_program_studi')->orderBy('nama_program_studi')->get(),
            'ruangan' => Ruangan::select('id_ruangan', 'nama_ruangan')->orderBy('nama_ruangan')->get(),
            'hari' => ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'],
            'status' => ['Offline', 'Online', 'Libur', 'Kelas Tunjangan', 'Belum Ada Konfirmasi'],
            'semester' => MataKuliah::select('semester')->distinct()->orderBy('semester')->pluck('semester')
        ]);
    }

    /**
     * Get filter options from database (for dynamic dropdowns)
     */
    public function getFilterOptions()
    {
        $hari = Jadwal::distinct()->pluck('hari')->filter();
        
        // Fallback to standard days if database is empty
        if ($hari->isEmpty()) {
            $hari = collect(['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu']);
        }
        
        return response()->json([
            'hari' => $hari->values()
        ]);
    }


    /**
     * Store new schedule
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id_mk' => 'required|exists:matakuliah,id_mk',
            'id_pendidik' => 'required|exists:pendidik,id_pendidik',
            'id_kelas' => 'required|exists:kelas,id_kelas',
            'id_ruangan' => 'required|exists:ruangan,id_ruangan',
            'hari' => 'required|in:Senin,Selasa,Rabu,Kamis,Jumat,Sabtu',
            'waktu' => 'required|string',
            'semester' => 'required|integer|min:1|max:4'
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        try {
            $data = $request->except(['waktu', 'program_studi_filter']);
            
            // Parse waktu "08:00 - 09:40" into jam_mulai and jam_selesai
            if ($request->filled('waktu')) {
                $waktuParts = explode(' - ', $request->waktu);
                if (count($waktuParts) === 2) {
                    $data['jam_mulai'] = trim($waktuParts[0]);
                    $data['jam_selesai'] = trim($waktuParts[1]);
                }
            }
            
            $jadwal = Jadwal::create($data);
            $jadwal->load(['mataKuliah.programStudi', 'kelas.programStudi', 'ruangan', 'pendidik']);
            
            return response()->json([
                'message' => 'Jadwal berhasil ditambahkan',
                'data' => $jadwal
            ]);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Terjadi kesalahan: ' . $e->getMessage()], 500);
        }
    }

    /**
     * Get schedule data for editing
     */
    public function edit($id)
    {
        $jadwal = Jadwal::with(['mataKuliah.programStudi', 'kelas.programStudi', 'ruangan', 'pendidik'])->findOrFail($id);
        return response()->json($jadwal);
    }

    /**
     * Update schedule data
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'id_mk' => 'required|exists:matakuliah,id_mk',
            'id_pendidik' => 'required|exists:pendidik,id_pendidik',
            'id_kelas' => 'required|exists:kelas,id_kelas',
            'id_ruangan' => 'required|exists:ruangan,id_ruangan',
            'hari' => 'required|in:Senin,Selasa,Rabu,Kamis,Jumat,Sabtu',
            'waktu' => 'required|string',
            'semester' => 'required|integer|min:1|max:4'
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        try {
            $jadwal = Jadwal::findOrFail($id);
            $data = $request->except(['waktu', 'program_studi_filter', '_token']);
            
            // Parse waktu "08:00 - 09:40" into jam_mulai and jam_selesai
            if ($request->filled('waktu')) {
                $waktuParts = explode(' - ', $request->waktu);
                if (count($waktuParts) === 2) {
                    $data['jam_mulai'] = trim($waktuParts[0]);
                    $data['jam_selesai'] = trim($waktuParts[1]);
                }
            }
            
            $jadwal->update($data);
            $jadwal->load(['mataKuliah.programStudi', 'kelas.programStudi', 'ruangan', 'pendidik']);

            return response()->json([
                'message' => 'Jadwal berhasil diupdate',
                'data' => $jadwal
            ]);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Terjadi kesalahan: ' . $e->getMessage()], 500);
        }
    }

    /**
     * Delete schedule
     */
    public function destroy($id)
    {
        try {
            $jadwal = Jadwal::findOrFail($id);
            $jadwal->delete();

            return response()->json([
                'message' => 'Jadwal berhasil dihapus'
            ]);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Terjadi kesalahan: ' . $e->getMessage()], 500);
        }
    }

    /**
     * Print schedules based on filters
     */
    public function printJadwal(Request $request)
    {
        $id_program_studi = $request->input('id_program_studi');
        $semester = $request->input('semester');
        $id_kelas = $request->input('id_kelas');
        $hari = $request->input('hari');
        $id_ruangan = $request->input('id_ruangan');

        $query = Jadwal::with(['mataKuliah.programStudi', 'kelas.programStudi', 'ruangan', 'pendidik']);

        if ($id_program_studi && $id_program_studi !== 'all') {
            $query->whereHas('mataKuliah', function($q) use ($id_program_studi) {
                $q->where('id_program_studi', $id_program_studi);
            });
        }

        if ($semester && $semester !== 'all') {
            $query->whereHas('mataKuliah', function($q) use ($semester) {
                $q->where('semester', $semester);
            });
        }

        if ($id_kelas && $id_kelas !== 'Semua Kelas') {
            $query->where('id_kelas', $id_kelas);
        }

        if ($hari && $hari !== 'Semua Hari') {
            $query->where('hari', $hari);
        }

        if ($id_ruangan && $id_ruangan !== 'Semua Ruangan') {
            $query->where('id_ruangan', $id_ruangan);
        }

        $jadwal = $query->orderBy('hari')->orderBy('jam_mulai')->get();

        return view('akademik.print_jadwal', compact('jadwal'));
    }
}
