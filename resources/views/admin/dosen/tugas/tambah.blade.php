@extends('layouts.app')

@section('content')

<div class="p-6 max-w-2xl mx-auto">
    <h1 class="text-2xl font-bold mb-4">
        Tambah Tugas – {{ $kelas->nama_kelas }} / {{ $matkul->nama_mk }}
    </h1>

    <a href="{{ route('tugas.index', [$id_kelas, $kode_mk]) }}" 
       class="bg-gray-500 text-white px-4 py-2 rounded mb-4 inline-block">
        Kembali
    </a>

    <div class="bg-white p-6 shadow rounded">
        <form action="{{ route('tugas.store', [$id_kelas, $kode_mk]) }}" 
              method="POST" enctype="multipart/form-data">

            @csrf

            <div class="mb-4">
                <label class="font-semibold">Judul Tugas</label>
                <input type="text" name="judul" class="w-full border p-2" required>
            </div>

            <div class="mb-4">
                <label class="font-semibold">Deskripsi</label>
                <textarea name="deskripsi" class="w-full border p-2" rows="4"></textarea>
            </div>

            <div class="mb-4">
                <label class="font-semibold">Deadline</label>
                <input type="datetime-local" name="deadline" class="w-full border p-2" required>
            </div>

            <div class="mb-4">
                <label class="font-semibold">File (Opsional)</label>
                <input type="file" name="file_tugas" class="w-full border p-2">
            </div>

            <button class="bg-blue-600 text-white px-4 py-2 rounded">
                Simpan Tugas
            </button>

        </form>
    </div>
</div>

@endsection
