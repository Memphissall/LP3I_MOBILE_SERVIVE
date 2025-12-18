<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Mahasiswa;
use App\Models\Kelas;
use Illuminate\Support\Facades\Validator;

class MahasiswaController extends Controller
{
    /**
     * Get student data for editing
     */
    public function edit($id)
    {
        $mahasiswa = Mahasiswa::with('dataKelas')->findOrFail($id);
        return response()->json($mahasiswa);
    }

    /**
     * Update student data
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'nipd' => 'required|string|unique:mahasiswa,nipd,' . $id,
            'nama' => 'required|string|max:255',
            'jenis_kelamin' => 'required|in:Laki-laki,Perempuan',
            'tempat_lahir' => 'required|string',
            'tgl_lahir' => 'required|date',
            'jurusan' => 'required|string',
            'email' => 'required|email',
            'alamat' => 'required|string',
            'agama' => 'required|string',
            'no_tlp' => 'required|string',
            'status' => 'required|in:Aktif,Tidak Aktif',
            'angkatan' => 'nullable|string',
            'periode' => 'nullable|string',
            'id_kelas' => 'nullable|exists:kelas,id_kelas',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        try {
            $mahasiswa = Mahasiswa::findOrFail($id);
            $mahasiswa->update($request->all());

            return response()->json([
                'message' => 'Data mahasiswa berhasil diupdate',
                'data' => $mahasiswa
            ]);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Terjadi kesalahan: ' . $e->getMessage()], 500);
        }
    }

    /**
     * Delete student
     */
    public function destroy($id)
    {
        try {
            $mahasiswa = Mahasiswa::findOrFail($id);
            $mahasiswa->delete();

            return response()->json([
                'message' => 'Data mahasiswa berhasil dihapus'
            ]);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Terjadi kesalahan: ' . $e->getMessage()], 500);
        }
    }
}
