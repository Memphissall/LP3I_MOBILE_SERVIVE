<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Jadwal;
use App\Models\MataKuliah;
use App\Models\Kelas;
use App\Models\Ruangan;
use Illuminate\Support\Facades\Validator;

class JadwalController extends Controller
{
    /**
     * Get list of schedules with filters and relationships
     */
    public function index(Request $request)
    {
        $query = Jadwal::with(['mataKuliah', 'kelas', 'ruangan']);

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
     * Get dropdown data for create/edit forms
     */
    public function getDropdownData()
    {
        return response()->json([
            'mata_kuliah' => MataKuliah::select('kode_mk', 'nama_mk', 'sks')->get(),
            'kelas' => Kelas::select('id_kelas', 'nama_kelas')->get(),
            'ruangan' => Ruangan::select('id_ruangan', 'nama_ruangan')->get()
        ]);
    }

    /**
     * Store new schedule
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'kode_mk' => 'required|exists:mata_kuliah,kode_mk',
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
            $jadwal->load(['mataKuliah', 'kelas', 'ruangan']);
            
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
        $jadwal = Jadwal::with(['mataKuliah', 'kelas', 'ruangan'])->findOrFail($id);
        return response()->json($jadwal);
    }

    /**
     * Update schedule data
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'kode_mk' => 'required|exists:mata_kuliah,kode_mk',
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
            $jadwal->load(['mataKuliah', 'kelas', 'ruangan']);

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
     * Get available times for a given course
     */

    public function getWaktu($id)
{
    // Sesuaikan dengan nama tabel atau relasi di database kamu
    $waktu = Jadwal::where('matkul_id', $id)->get(); 
    return response()->json($waktu);
}

    /**
     * Print schedules based on filters
     */
    public function printJadwal(Request $request)
    {
        $id_kelas = $request->input('id_kelas');
        $hari = $request->input('hari');
        $id_ruangan = $request->input('id_ruangan');

        $query = Jadwal::with(['mataKuliah', 'kelas', 'ruangan']);

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
