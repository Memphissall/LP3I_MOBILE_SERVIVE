<?php

namespace App\Http\Controllers;

use App\Models\Pengumuman;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PengumumanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pengumuman = Pengumuman::latest()->paginate(10);
        return view('akademik.pengumuman.index', compact('pengumuman'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('akademik.pengumuman.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->only(['judul_pengumuman', 'isi']);
        
        // Handle file upload if present
        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $filename = time() . '_' . $file->getClientOriginalName();
            $path = $file->storeAs('pengumuman', $filename, 'public');
            $data['file_path'] = $path;
        }
        
        Pengumuman::create($data);
        
        // Return JSON for AJAX
        if ($request->ajax() || $request->wantsJson()) {
            return response()->json([
                'success' => true,
                'message' => 'Pengumuman berhasil ditambahkan!'
            ]);
        }
        
        return redirect()->route('admin.pengumuman.index')
            ->with('success', 'Pengumuman berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $pengumuman = Pengumuman::findOrFail($id);
        return view('akademik.pengumuman.show', compact('pengumuman'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $pengumuman = Pengumuman::findOrFail($id);
        
        // Return JSON for AJAX
        if (request()->ajax() || request()->wantsJson()) {
            return response()->json($pengumuman);
        }
        
        return view('akademik.pengumuman.edit', compact('pengumuman'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $pengumuman = Pengumuman::findOrFail($id);
        $data = $request->only(['judul_pengumuman', 'isi']);
        
        // Handle file upload if present
        if ($request->hasFile('file')) {
            // Delete old file if exists
            if ($pengumuman->file_path && Storage::disk('public')->exists($pengumuman->file_path)) {
                Storage::disk('public')->delete($pengumuman->file_path);
            }
            
            $file = $request->file('file');
            $filename = time() . '_' . $file->getClientOriginalName();
            $path = $file->storeAs('pengumuman', $filename, 'public');
            $data['file_path'] = $path;
        }
        
        $pengumuman->update($data);
        
        // Return JSON for AJAX
        if ($request->ajax() || $request->wantsJson()) {
            return response()->json([
                'success' => true,
                'message' => 'Pengumuman berhasil diperbarui!'
            ]);
        }
        
        return redirect()->route('admin.pengumuman.index')
            ->with('success', 'Pengumuman berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $pengumuman = Pengumuman::findOrFail($id);
        
        // Delete file if exists
        if ($pengumuman->file_path && Storage::disk('public')->exists($pengumuman->file_path)) {
            Storage::disk('public')->delete($pengumuman->file_path);
        }
        
        $pengumuman->delete();
        
        // Return JSON for AJAX
        if (request()->ajax() || request()->wantsJson()) {
            return response()->json([
                'success' => true,
                'message' => 'Pengumuman berhasil dihapus!'
            ]);
        }
        
        return redirect()->route('admin.pengumuman.index')
            ->with('success', 'Pengumuman berhasil dihapus!');
    }
}
