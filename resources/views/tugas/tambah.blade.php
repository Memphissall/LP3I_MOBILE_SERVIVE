@extends('layouts.app')

@section('content')
<div class="p-6 max-w-xl mx-auto">

    <h1 class="text-2xl font-bold mb-4">Tambah Tugas</h1>

    <form action="{{ route('tugas.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label>Judul</label>
            <input type="text" name="judul" class="w-full border p-2 rounded" required>
        </div>

        <div class="mb-3">
            <label>Deskripsi</label>
            <textarea name="deskripsi" class="w-full border p-2 rounded"></textarea>
        </div>

        <div class="mb-3">
            <label>Deadline</label>
            <input type="date" name="deadline" class="w-full border p-2 rounded">
        </div>

        <button class="px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded">Simpan</button>
        <a href="{{ route('tugas.index') }}" class="px-4 py-2 bg-gray-400 text-white rounded">Kembali</a>

    </form>
</div>
@endsection
