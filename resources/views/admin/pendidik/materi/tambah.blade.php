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

    <form action="{{ route('materi.store', [$id_kelas, $id_mk]) }}"
          method="POST"
          enctype="multipart/form-data"
          class="bg-white p-6 rounded shadow">
        @csrf

        {{-- PERTEMUAN --}}
        <div class="mb-4">
            <label class="block font-semibold mb-1">Pertemuan</label>
            <select name="pertemuan"
                    class="w-full border rounded px-3 py-2" required>
                <option value="">-- Pilih Pertemuan --</option>
                @for($i=1; $i<=14; $i++)
                    <option value="{{ $i }}">Pertemuan {{ $i }}</option>
                @endfor
            </select>
        </div>

        {{-- JUDUL --}}
        <div class="mb-4">
            <label class="block font-semibold mb-1">Judul Materi</label>
            <input type="text" name="judul_materi"
                   class="w-full border rounded px-3 py-2" required>
        </div>

        {{-- DESKRIPSI --}}
        <div class="mb-4">
            <label class="block font-semibold mb-1">Deskripsi</label>
            <textarea name="deskripsi"
                      rows="4"
                      class="w-full border rounded px-3 py-2"></textarea>
        </div>

        {{-- TIPE MATERI --}}
        <div class="mb-4">
            <label class="block font-semibold mb-2">Tipe Materi</label>
            <div class="flex gap-6">
                <label>
                    <input type="radio" name="tipe_materi" value="file" checked>
                    File
                </label>
                <label>
                    <input type="radio" name="tipe_materi" value="link">
                    Link
                </label>
            </div>
        </div>

        {{-- FILE --}}
        <div id="input-file" class="mb-4">
            <label class="block font-semibold mb-1">Upload File</label>
            <input type="file" name="file_materi" class="w-full">
            <small class="text-gray-500">PDF, DOC, PPT</small>
        </div>

        {{-- LINK --}}
        <div id="input-link" class="mb-4 hidden">
            <label class="block font-semibold mb-1">Link Materi</label>
            <input type="url"
                   name="link_materi"
                   placeholder="https://..."
                   class="w-full border rounded px-3 py-2">
        </div>

        {{-- BUTTON --}}
        <div class="mt-6 flex flex-wrap gap-3">
            <button type="submit"
                    class="bg-blue-600 text-white px-4 py-2 rounded text-sm font-semibold">
                Simpan
            </button>

            <a href="{{ route('materi.index', [$id_kelas, $id_mk]) }}"
               class="bg-gray-400 text-white px-4 py-2 rounded text-sm font-semibold text-center">
                Batal
            </a>
        </div>
    </form>
</div>

<script>
document.querySelectorAll('input[name="tipe_materi"]').forEach(el => {
    el.addEventListener('change', function () {
        document.getElementById('input-file').classList.toggle('hidden', this.value !== 'file');
        document.getElementById('input-link').classList.toggle('hidden', this.value !== 'link');
    });
});
</script>
@endsection
