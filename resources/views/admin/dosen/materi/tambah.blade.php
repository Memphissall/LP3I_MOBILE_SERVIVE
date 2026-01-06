@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto mt-10">
    <h2 class="text-2xl font-bold mb-6">
        Upload Materi  
        <span class="text-gray-500">
            {{ $matkul->nama_mk }} - {{ $kelas->nama_kelas }}
        </span>
    </h2>


    @if ($errors->any())
    <div class="bg-red-100 text-red-700 p-3 mb-4 rounded">
        <ul>
            @foreach ($errors->all() as $error)
                <li>• {{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

    <form action="{{ route('materi.store', [$id_kelas, $kode_mk]) }}"
          method="POST"
          enctype="multipart/form-data"
          class="bg-white p-6 rounded shadow">

        @csrf

        {{-- JUDUL --}}
        <div class="mb-4">
            <label class="block font-semibold mb-1">Judul Materi</label>
            <input type="text"
                   name="judul_materi"
                   class="w-full border rounded px-3 py-2"
                   required>
        </div>

        {{-- DESKRIPSI --}}
        <div class="mb-4">
            <label class="block font-semibold mb-1">Deskripsi</label>
            <textarea name="deskripsi"
                      rows="4"
                      class="w-full border rounded px-3 py-2"></textarea>
        </div>

        {{-- PERTEMUAN (DROPDOWN) --}}
        <div class="mb-4">
            <label class="block font-semibold mb-1">Pertemuan</label>
            <select name="pertemuan"
                    class="w-full border rounded px-3 py-2"
                    required>
                <option value="">-- Pilih Pertemuan --</option>
                @for ($i = 1; $i <= 14  ; $i++)
                    <option value="{{ $i }}">
                        Pertemuan {{ $i }}
                    </option>
                @endfor
            </select>
        </div>

        {{-- FILE --}}
        <div class="mb-6">
            <label class="block font-semibold mb-1">File Materi</label>
            <input type="file"
                   name="file_materi"
                   class="w-full"
                   required>
            <small class="text-gray-500">
                Format: PDF, DOC, PPT
            </small>
        </div>

        {{-- BUTTON --}}
        <div class="flex gap-3">
            <button type="submit"
                    class="bg-blue-600 text-white px-5 py-2 rounded">
                Simpan
            </button>

            <a href="{{ route('materi.index', [$id_kelas, $kode_mk]) }}"
               class="bg-gray-400 text-white px-5 py-2 rounded">
                Batal
            </a>
        </div>

    </form>
</div>
@endsection
