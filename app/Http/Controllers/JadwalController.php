<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Jadwal;
use App\Models\MataKuliah;
use App\Models\Kelas;
use App\Models\Ruangan;
use App\Models\BidangKeahlian;
use Illuminate\Support\Facades\Validator;

class JadwalController extends Controller
{
    /**
     * Get list of schedules with filters and relationships
     */
    public function index(Request $request)
    {
        $query = Jadwal::with(['mataKuliah.bidangKeahlian', 'kelas.bidangKeahlian', 'ruangan', 'dosen']);

        // Filter by bidang keahlian (through mata kuliah)
        if ($request->filled('id_bidang_keahlian') && $request->id_bidang_keahlian !== 'all') {
            $query->whereHas('mataKuliah', function($q) use ($request) {
                $q->where('id_bidang_keahlian', $request->id_bidang_keahlian);
            });
        }

        // Filter by semester (through mata kuliah)
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

        $jadwal = $query->orderBy('hari')->orderBy('waktu')->get();
        return response()->json($jadwal);
    }

    /**
     * Get bidang keahlian list
     */
    public function getBidangKeahlianList()
    {
        $bidangKeahlian = BidangKeahlian::orderBy('nama')->get();
        return response()->json($bidangKeahlian);
    }

    /**
     * Get mata kuliah filtered by bidang keahlian and semester
     */
    public function getMataKuliahByFilter(Request $request)
    {
        $query = MataKuliah::with('bidangKeahlian')->select('id_matkul', 'kode_mk', 'nama_mk', 'sks', 'semester', 'id_bidang_keahlian');

        if ($request->filled('id_bidang_keahlian') && $request->id_bidang_keahlian !== 'all') {
            $query->where('id_bidang_keahlian', $request->id_bidang_keahlian);
        }

        if ($request->filled('semester') && $request->semester !== 'all') {
            $query->where('semester', $request->semester);
        }

        $mataKuliah = $query->orderBy('semester')->orderBy('kode_mk')->get();
        return response()->json($mataKuliah);
    }

    /**
     * Get kelas filtered by bidang keahlian and semester
     */
    public function getKelasByBidangKeahlian(Request $request)
    {
        $query = Kelas::with('bidangKeahlian')->select('id_kelas', 'nama_kelas', 'id_bidang_keahlian', 'semester', 'tahun_ajaran');

        if ($request->filled('id_bidang_keahlian') && $request->id_bidang_keahlian !== 'all') {
            $query->where('id_bidang_keahlian', $request->id_bidang_keahlian);
        }

        if ($request->filled('semester') && $request->semester !== 'all') {
            $query->where('semester', $request->semester);
        }

        $kelas = $query->orderBy('nama_kelas')->get();
        return response()->json($kelas);
    }

    /**
     * Get dosen filtered by mata kuliah
     */
    public function getDosenByMataKuliah(Request $request)
    {
        $query = \App\Models\Dosen::select('id_dosen', 'nama_dosen', 'nidn', 'id_matkul');

        if ($request->filled('id_matkul') && $request->id_matkul !== 'all') {
            $query->where('id_matkul', $request->id_matkul);
        }

        $dosen = $query->orderBy('nama_dosen')->get();
        return response()->json($dosen);
    }

    /**
     * Get dropdown data for create/edit forms
     */
    public function getDropdownData()
    {
        return response()->json([
            'bidang_keahlian' => BidangKeahlian::select('id_bidang_keahlian', 'kode', 'nama')->get(),
            'ruangan' => Ruangan::select('id_ruangan', 'nama_ruangan')->get()
        ]);
    }

    /**
     * Store new schedule
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id_matkul' => 'required|exists:mata_kuliah,id_matkul',
            'id_dosen' => 'required|exists:dosen,id_dosen',
            'id_kelas' => 'required|exists:kelas,id_kelas',
            'id_ruangan' => 'required|exists:ruangan,id_ruangan',
            'hari' => 'required|in:Senin,Selasa,Rabu,Kamis,Jumat,Sabtu',
            'waktu' => 'required',
            'status' => 'required|in:Offline,Online,Libur,Kelas Tunjangan,Belum Ada Konfirmasi'
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        try {
            $jadwal = Jadwal::create($request->all());
            $jadwal->load(['mataKuliah.bidangKeahlian', 'kelas.bidangKeahlian', 'ruangan', 'dosen']);
            
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
        $jadwal = Jadwal::with(['mataKuliah.bidangKeahlian', 'kelas.bidangKeahlian', 'ruangan', 'dosen'])->findOrFail($id);
        return response()->json($jadwal);
    }

    /**
     * Update schedule data
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'id_matkul' => 'required|exists:mata_kuliah,id_matkul',
            'id_dosen' => 'required|exists:dosen,id_dosen',
            'id_kelas' => 'required|exists:kelas,id_kelas',
            'id_ruangan' => 'required|exists:ruangan,id_ruangan',
            'hari' => 'required|in:Senin,Selasa,Rabu,Kamis,Jumat,Sabtu',
            'waktu' => 'required',
            'status' => 'required|in:Offline,Online,Libur,Kelas Tunjangan,Belum Ada Konfirmasi'
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        try {
            $jadwal = Jadwal::findOrFail($id);
            $jadwal->update($request->all());
            $jadwal->load(['mataKuliah.bidangKeahlian', 'kelas.bidangKeahlian', 'ruangan', 'dosen']);

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
        $id_bidang_keahlian = $request->input('id_bidang_keahlian');
        $semester = $request->input('semester');
        $id_kelas = $request->input('id_kelas');
        $hari = $request->input('hari');
        $id_ruangan = $request->input('id_ruangan');

        $query = Jadwal::with(['mataKuliah.bidangKeahlian', 'kelas.bidangKeahlian', 'ruangan', 'dosen']);

        if ($id_bidang_keahlian && $id_bidang_keahlian !== 'all') {
            $query->whereHas('mataKuliah', function($q) use ($id_bidang_keahlian) {
                $q->where('id_bidang_keahlian', $id_bidang_keahlian);
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

        $jadwal = $query->orderBy('hari')->orderBy('waktu')->get();

        return view('akademik.print_jadwal', compact('jadwal'));
    }
}
