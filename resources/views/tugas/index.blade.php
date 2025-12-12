@extends('layouts.app')

@section('content')
<div class="max-w-6xl mx-auto p-6">

    {{-- Header --}}
    <div class="flex justify-between items-center mb-8">
        <div>
            <h1 class="text-4xl font-bold bg-gradient-to-r from-blue-600 to-indigo-600 text-transparent bg-clip-text">
                📋 Daftar Tugas
            </h1>
            <p class="text-gray-600">Kelola tugas kuliah dengan mudah dan cepat.</p>
        </div>

        <a href="{{ route('tugas.create') }}" 
           class="px-6 py-3 bg-gradient-to-r from-blue-500 to-blue-700 hover:from-blue-600 hover:to-blue-800 
                  text-white rounded-xl shadow-lg hover:scale-105 transition">
            + Tambah Tugas
        </a>
    </div>

    {{-- Card --}}
    <div class="bg-white shadow-xl rounded-2xl overflow-hidden border border-gray-200">

        <table class="w-full table-auto">
            <thead>
                <tr class="bg-gradient-to-r from-blue-50 to-indigo-100 text-gray-700 text-left">
                    <th class="p-4 border">#</th>
                    <th class="p-4 border">📘 Judul Tugas</th>
                    <th class="p-4 border">⏰ Deadline</th>
                    <th class="p-4 border text-center">Status</th>
                    <th class="p-4 border text-center">⚙️ Aksi</th>
                </tr>
            </thead>

            <tbody>
                @forelse ($tugas as $item)
                <tr class="border-b hover:bg-gradient-to-r hover:from-gray-50 hover:to-gray-100 transition">

                    <td class="p-4 border text-gray-700 font-semibold">
                        {{ $loop->iteration }}
                    </td>

                    <td class="p-4 border font-medium text-gray-900">
                        <div class="flex items-center gap-2">
                            <i class="fa-solid fa-book text-blue-600"></i>
                            {{ $item->judul }}
                        </div>
                    </td>

                    <td class="p-4 border text-gray-700">
                        <i class="fa-solid fa-calendar-day text-rose-500"></i> 
                        {{ $item->deadline }}
                    </td>

                    {{-- Status badge --}}
                    <td class="p-4 border text-center">
                        @if ($item->status == 'pending')
                            <span class="px-4 py-1.5 bg-yellow-200 text-yellow-900 rounded-full text-sm font-semibold shadow">
                                ⏳ Menunggu
                            </span>
                        @else
                            <span class="px-4 py-1.5 bg-green-200 text-green-900 rounded-full text-sm font-semibold shadow">
                                ✅ Selesai
                            </span>
                        @endif
                    </td>

                    {{-- Aksi --}}
                    <td class="p-4 border text-center space-x-2">

                        {{-- View --}}
                        <a href="{{ route('tugas.show', $item->id) }}"
                           class="inline-flex items-center px-4 py-2 bg-emerald-500 hover:bg-emerald-600 
                                  text-white rounded-lg shadow hover:scale-105 transition">
                            <i class="fa-solid fa-eye mr-1"></i> View
                        </a>

                        {{-- Edit --}}
                        <a href="{{ route('tugas.edit', $item->id) }}"
                           class="inline-flex items-center px-4 py-2 bg-yellow-500 hover:bg-yellow-600 
                                  text-white rounded-lg shadow hover:scale-105 transition">
                            <i class="fa-solid fa-pen-to-square mr-1"></i> Edit
                        </a>

                        {{-- Delete --}}
                        <form action="{{ route('tugas.destroy', $item->id) }}" 
                              method="POST" 
                              class="inline">
                            @csrf
                            @method('DELETE')

                            <button onclick="return confirm('Yakin ingin menghapus tugas ini?')"
                                class="inline-flex items-center px-4 py-2 bg-red-600 hover:bg-red-700 
                                        text-white rounded-lg shadow hover:scale-105 transition">
                                <i class="fa-solid fa-trash mr-1"></i> Hapus
                            </button>
                        </form>

                    </td>
                </tr>

                @empty

                <tr>
                    <td colspan="5" class="p-6 text-center text-gray-600 text-lg">
                        😕 Belum ada tugas yang ditambahkan
                    </td>
                </tr>

                @endforelse
            </tbody>
        </table>
    </div>

</div>
@endsection
