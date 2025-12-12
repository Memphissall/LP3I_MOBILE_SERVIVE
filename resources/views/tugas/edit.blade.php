@extends('layouts.app')

@section('content')
<div class="max-w-2xl mx-auto p-6 bg-white shadow-md rounded-lg">

    <h1 class="text-3xl font-semibold mb-6 text-gray-800">✏️ Edit Tugas</h1>

    <form action="{{ route('tugas.update', $tugas->id) }}" method="POST" class="space-y-4">
        @csrf
        @method('PUT')

        {{-- Judul --}}
        <div>
            <label class="block text-gray-700 font-semibold mb-1">Judul Tugas</label>
            <input 
                type="text" 
                name="judul" 
                value="{{ $tugas->judul }}" 
                class="w-full border border-gray-300 p-3 rounded-lg focus:ring focus:ring-blue-300"
                required>
        </div>

        {{-- Deskripsi --}}
        <div>
            <label class="block text-gray-700 font-semibold mb-1">Deskripsi</label>
            <textarea
                name="deskripsi"
                rows="4"
                class="w-full border border-gray-300 p-3 rounded-lg focus:ring focus:ring-blue-300"
            >{{ $tugas->deskripsi }}</textarea>
        </div>

        {{-- Deadline --}}
        <div>
            <label class="block text-gray-700 font-semibold mb-1">Deadline</label>
            <input 
                type="date" 
                name="deadline" 
                value="{{ $tugas->deadline }}" 
                class="w-full border border-gray-300 p-3 rounded-lg focus:ring focus:ring-blue-300">
        </div>

        {{-- Status --}}
        <div>
            <label class="block text-gray-700 font-semibold mb-1">Status</label>
            <select 
                name="status" 
                class="w-full border border-gray-300 p-3 rounded-lg focus:ring focus:ring-blue-300">

                <option value="pending" {{ $tugas->status == 'pending' ? 'selected' : '' }}>
                    ⏳ Pending
                </option>

                <option value="selesai" {{ $tugas->status == 'selesai' ? 'selected' : '' }}>
                    ✅ Selesai
                </option>

            </select>
        </div>

        {{-- Tombol --}}
        <div class="flex space-x-3 pt-4">

            <button 
                type="submit"
                class="flex items-center gap-2 px-10 py-2 bg-yellow-500 hover:bg-yellow-600 text-white rounded-lg shadow">
                💾 <span>Update</span>
            </button>

            <a href="{{ route('tugas.index') }}" 
                class="flex items-center gap-2 px-10 py-2 bg-gray-500 hover:bg-gray-600 text-white rounded-lg shadow">
                ❌ <span>Batal</span>
            </a>

        </div>

    </form>

</div>
@endsection
