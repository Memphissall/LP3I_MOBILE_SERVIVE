@extends('layouts.app')

@section('content')
<div class="max-w-2xl mx-auto p-6 bg-white rounded shadow">

    <h1 class="text-xl font-bold mb-4">Edit Tugas</h1>

    <form action="{{ route('tugas.update', $tugas->id_tugas) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <label class="block mb-2">Judul</label>
        <input type="text" name="judul" value="{{ old('judul', $tugas->judul) }}" class="border p-2 w-full mb-4">

        <label class="block mb-2">Deskripsi</label>
        <textarea name="deskripsi" class="border p-2 w-full mb-4">{{ old('deskripsi', $tugas->deskripsi) }}</textarea>

        <label class="block mb-2">Deadline</label>
        <input type="date" name="deadline" 
               value="{{ old('deadline', \Carbon\Carbon::parse($tugas->deadline)->format('Y-m-d')) }}" 
               class="border p-2 w-full mb-4">

        <label class="block mb-2">File Tugas (Opsional)</label>
        <input type="file" name="file_tugas" class="border p-2 w-full mb-4">

        <label class="block mb-2">Status</label>
        <select name="status" class="border p-2 w-full mb-4">
            <option value="Aktif"   {{ old('status', $tugas->status) == 'Aktif' ? 'selected' : '' }}>Aktif</option>
            <option value="Nonaktif" {{ old('status', $tugas->status) == 'Nonaktif' ? 'selected' : '' }}>Nonaktif</option>
        </select>

        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">Update</button>
        <a href="{{ route('tugas.index', [$tugas->id_kelas, $tugas->kode_mk]) }}"
           class="bg-gray-600 text-white px-4 py-2 rounded ml-2">Kembali</a>
    </form>
</div>
@endsection
