@extends('layouts.app')

@section('content')
<div class="max-w-3xl mx-auto mt-10 bg-white p-6 rounded shadow">

    <h2 class="text-2xl font-bold mb-6">
        Edit Materi
    </h2>

    {{-- ALERT ERROR --}}
    @if ($errors->any())
        <div class="bg-red-100 text-red-700 p-3 rounded mb-4">
            <ul class="list-disc ml-4">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('materi.update', $materi->id) }}"
          method="POST"
          enctype="multipart/form-data">
        @csrf
        @method('PUT')

        {{-- JUDUL --}}
        <div class="mb-4">
            <label class="block font-semibold mb-1">Judul Materi</label>
            <input type="text"
                   name="judul_materi"
                   value="{{ old('judul_materi', $materi->judul_materi) }}"
                   class="w-full border rounded px-3 py-2"
                   required>
        </div>

        {{-- DESKRIPSI --}}
        <div class="mb-4">
            <label class="block font-semibold mb-1">Deskripsi</label>
            <textarea name="deskripsi"
                      rows="3"
                      class="w-full border rounded px-3 py-2">{{ old('deskripsi', $materi->deskripsi) }}</textarea>
        </div>

        {{-- PERTEMUAN --}}
        <div class="mb-4">
            <label class="block font-semibold mb-1">Pertemuan</label>
            <select name="pertemuan"
                    class="w-full border rounded px-3 py-2"
                    required>
                <option value="">-- Pilih Pertemuan --</option>
                @for ($i = 1; $i <= 16; $i++)
                    <option value="{{ $i }}"
                        {{ old('pertemuan', $materi->pertemuan) == $i ? 'selected' : '' }}>
                        Pertemuan {{ $i }}
                    </option>
                @endfor
            </select>
        </div>

        {{-- TIPE MATERI --}}
        <div class="mb-4">
            <label class="block font-semibold mb-2">Tipe Materi</label>
            <div class="flex gap-6">
                <label>
                    <input type="radio"
                           name="tipe_materi"
                           value="file"
                           {{ old('tipe_materi', $materi->tipe_materi) === 'file' ? 'checked' : '' }}>
                    File
                </label>
                <label>
                    <input type="radio"
                           name="tipe_materi"
                           value="link"
                           {{ old('tipe_materi', $materi->tipe_materi) === 'link' ? 'checked' : '' }}>
                    Link
                </label>
            </div>
        </div>

        {{-- FILE --}}
        <div id="input-file"
             class="mb-4 {{ old('tipe_materi', $materi->tipe_materi) !== 'file' ? 'hidden' : '' }}">
            <label class="block font-semibold mb-1">
                File Materi (kosongkan jika tidak diganti)
            </label>

            <input type="file"
                   name="file_materi"
                   class="w-full border rounded px-3 py-2">

            @if ($materi->file_materi)
                <p class="text-sm text-gray-600 mt-1">
                    File saat ini:
                    <a href="{{ asset('storage/'.$materi->file_materi) }}"
                       target="_blank"
                       class="text-blue-600 underline">
                        Download
                    </a>
                </p>
            @endif
        </div>

        {{-- LINK --}}
        <div id="input-link"
             class="mb-4 {{ old('tipe_materi', $materi->tipe_materi) !== 'link' ? 'hidden' : '' }}">
            <label class="block font-semibold mb-1">Link Materi</label>
            <input type="url"
                   name="link_materi"
                   value="{{ old('link_materi', $materi->link_materi) }}"
                   placeholder="https://..."
                   class="w-full border rounded px-3 py-2">
        </div>

        {{-- BUTTON --}}
        <div class="flex justify-between">
            <a href="{{ route('materi.index', [$materi->id_kelas, $materi->kode_mk]) }}"
               class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded">
                Kembali
            </a>

            <button type="submit"
                    class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded">
                Simpan Perubahan
            </button>
        </div>
    </form>
</div>

{{-- SCRIPT --}}
<script>
document.querySelectorAll('input[name="tipe_materi"]').forEach(el => {
    el.addEventListener('change', function () {
        document.getElementById('input-file')
            .classList.toggle('hidden', this.value !== 'file');
        document.getElementById('input-link')
            .classList.toggle('hidden', this.value !== 'link');
    });
});
</script>
@endsection
