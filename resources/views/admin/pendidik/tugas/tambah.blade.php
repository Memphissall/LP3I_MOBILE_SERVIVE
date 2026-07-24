@extends('layouts.app')

@section('content')

<div class="p-6 max-w-2xl mx-auto">
    <h1 class="text-2xl font-bold mb-6">
        Tambah Tugas – {{ $kelas->nama_kelas }} / {{ $matkul->nama_mk }}
    </h1>

    <div class="bg-white p-6 shadow rounded">
        <form action="{{ route('tugas.store', [$id_kelas, $id_mk]) }}"
              method="POST" enctype="multipart/form-data">

            @csrf

            {{-- Judul --}}
            <div class="mb-4">
                <label class="font-semibold">Judul Tugas</label>
                <input type="text"
                       name="judul_tugas"
                       class="w-full border p-2 rounded"
                       required>
            </div>

            {{-- Deskripsi --}}
            <div class="mb-4">
                <label class="font-semibold">Deskripsi</label>
                <textarea name="deskripsi"
                          class="w-full border p-2 rounded"
                          rows="4"></textarea>
            </div>

            {{-- Deadline --}}
            <div class="mb-4">
                <label class="font-semibold">Deadline</label>
                <input type="datetime-local"
                       name="deadline"
                       class="w-full border p-2 rounded"
                       required>
            </div>

            {{-- File --}}
            <div class="mb-6">
                <label class="font-semibold">File (Opsional)</label>
                <input type="file"
                       name="file_tugas"
                       class="w-full border p-2 rounded">
            </div>

            {{-- BUTTON AREA --}}
            <div class="flex flex-wrap justify-between items-center gap-3">

                {{-- Kembali --}}
                <a href="{{ route('tugas.index', [$id_kelas, $id_mk]) }}"
                   class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600 transition text-sm">
                    Kembali
                </a>

                {{-- Simpan --}}
                <button type="submit"
                         class="bg-blue-600 text-white px-5 py-2 rounded hover:bg-blue-700 transition text-sm">
                    Simpan Tugas
                </button>

            </div>

        </form>
    </div>
</div>

@endsection
