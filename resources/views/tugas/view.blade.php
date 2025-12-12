@extends('layouts.app')

@section('content')
<div class="p-6 max-w-2xl mx-auto">

    <div class="flex justify-between mb-6">
        <h1 class="text-2xl font-bold">Detail Tugas</h1>
        <a href="{{ route('tugas.index') }}" 
           class="px-4 py-2 bg-gray-600 hover:bg-gray-700 text-white rounded">
            Kembali
        </a>
    </div>

    <div class="bg-white shadow rounded-lg p-6 space-y-4">

        <div>
            <h2 class="font-semibold text-gray-700">Judul</h2>
            <p class="text-lg">{{ $tugas->judul }}</p>
        </div>

        <div>
            <h2 class="font-semibold text-gray-700">Deskripsi</h2>
            <p class="text-gray-900 leading-relaxed">
                {{ $tugas->deskripsi ?? 'Tidak ada deskripsi.' }}
            </p>
        </div>

        <div>
            <h2 class="font-semibold text-gray-700">Deadline</h2>
            <p class="text-gray-900">{{ $tugas->deadline ?? '-' }}</p>
        </div>

        <div>
            <h2 class="font-semibold text-gray-700">Status</h2>
            <span class="px-3 py-1 rounded text-white 
                {{ $tugas->status == 'selesai' ? 'bg-green-600' : 'bg-yellow-500' }}">
                {{ ucfirst($tugas->status) }}
            </span>
        </div>

        <div class="flex justify-end space-x-3 pt-4">
            <a href="{{ route('tugas.edit', $tugas->id) }}" 
               class="px-4 py-2 bg-yellow-500 hover:bg-yellow-600 text-white rounded">
                Edit
            </a>

            <form action="{{ route('tugas.destroy', $tugas->id) }}" method="POST">
                @csrf
                @method('DELETE')
                <button onclick="return confirm('Yakin hapus?')" 
                        class="px-4 py-2 bg-red-600 hover:bg-red-700 text-white rounded">
                    Hapus
                </button>
            </form>
        </div>

    </div>
</div>
@endsection
