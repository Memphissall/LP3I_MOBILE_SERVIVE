@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto px-6 py-6">

    {{-- FLASH MESSAGE LAMA (Optional, bisa dihapus) --}}
    @if (session('success'))
        <div class="mb-4 px-4 py-3 rounded-lg bg-green-100 border border-green-300 text-green-800">
            {{ session('success') }}
        </div>
    @endif

    @if (session('error'))
        <div class="mb-4 px-4 py-3 rounded-lg bg-red-100 border border-red-300 text-red-800">
            {{ session('error') }}
        </div>
    @endif

    <div class="bg-white rounded-xl shadow-md">

        {{-- HEADER --}}
        <div class="border-b px-6 py-4">
            <h2 class="text-lg font-semibold text-gray-800">
                💼 Input Honor Tambahan Pendidik
            </h2>
            <p class="text-sm text-gray-500">
                Honor pembuatan soal & koreksi jawaban
            </p>
        </div>

        {{-- FORM --}}
        <form action="{{ route('admin.akademik.tambahan-honor.store') }}" method="POST">
            @csrf

            <div class="p-6 space-y-5">
                {{-- Pendidik --}}
                <div>
                    <label class="block text-sm font-medium mb-1">Pendidik</label>
                    <select name="id_pendidik" required class="w-full rounded-lg border-gray-300">
                        <option value="">-- Pilih Pendidik --</option>
                        @foreach ($pendidik as $d)
                            <option value="{{ $d->id_pendidik }}">
                                {{ $d->id_pendidik }} - {{ $d->nama_pendidik }}
                            </option>
                        @endforeach
                    </select>
                </div>

                {{-- SEMESTER --}}
                <div>
                    <label class="block text-sm font-medium mb-1">Semester</label>
                    <select name="semester" required class="w-full rounded-lg border-gray-300">
                        <option value="">-- Pilih Semester --</option>
                        <option value="1">Ganjil</option>
                        <option value="2">Genap</option>
                    </select>
                </div>

                {{-- TANGGAL --}}
                <div>
                    <label class="block text-sm font-medium mb-1">Tanggal</label>
                    <input type="date"
                           name="tanggal"
                           value="{{ old('tanggal', date('Y-m-d')) }}"
                           required
                           class="w-full rounded-lg border-gray-300">
                </div>

                {{-- KELAS --}}
                <div>
                    <label class="block text-sm font-medium mb-1">Kelas (Opsional)</label>
                    <select name="id_kelas" class="w-full rounded-lg border-gray-300">
                        <option value="">-- Tidak terkait Kelas --</option>
                        @foreach ($kelas as $k)
                            <option value="{{ $k->id_kelas }}">
                                {{ $k->nama_kelas }}
                            </option>
                        @endforeach
                    </select>
                </div>

                {{-- MATA KULIAH --}}
                <div>
                    <label class="block text-sm font-medium mb-1">Mata Kuliah (Opsional)</label>
                    <select name="id_mk" class="w-full rounded-lg border-gray-300">
                        <option value="">-- Tidak terkait MK --</option>
                        @foreach ($matakuliah as $mk)
                            <option value="{{ $mk->id_mk }}">
                                {{ $mk->kode_mk }} - {{ $mk->nama_mk }}
                            </option>
                        @endforeach
                    </select>
                </div>

                {{-- JENIS HONOR --}}
                <div>
                    <label class="block text-sm font-medium mb-1">Jenis Honor</label>
                    <select name="jenis_honor" id="jenis_honor" required
                        class="w-full rounded-lg border-gray-300">
                        <option value="">-- Pilih Jenis Honor --</option>
                        <option value="pembuatan_soal">Pembuatan Soal</option>
                        <option value="koreksi">Koreksi Jawaban</option>
                    </select>
                </div>

                {{-- BULAN --}}
                <div>
                    <label class="block text-sm font-medium mb-1">Bulan</label>
                    <select name="bulan" required class="w-full rounded-lg border-gray-300">
                        <option value="">-- Pilih Bulan --</option>
                        @for ($i = 1; $i <= 12; $i++)
                            <option value="{{ $i }}">
                                {{ \Carbon\Carbon::create()->month($i)->translatedFormat('F') }}
                            </option>
                        @endfor
                    </select>
                </div>

                {{-- UANG PEMBUATAN SOAL --}}
                <div id="box-pembuatan" class="hidden">
                    <label class="block text-sm font-medium mb-1">Biaya Pembuatan Soal</label>
                    <input type="number"
                           name="uang_pembuatan_soal"
                           id="uang_pembuatan_soal"
                           value="0"
                           disabled
                           class="w-full rounded-lg border-gray-300">
                </div>

                {{-- UANG KOREKSI --}}
                <div id="box-koreksi" class="hidden">
                    <label class="block text-sm font-medium mb-1">Biaya Koreksi Jawaban</label>
                    <input type="number"
                           name="uang_koreksi_jawaban"
                           id="uang_koreksi_jawaban"
                           value="0"
                           disabled
                           class="w-full rounded-lg border-gray-300">
                </div>

            </div>

            {{-- FOOTER --}}
            <div class="border-t px-6 py-4 flex justify-end gap-2">
                <a href="{{ url()->previous() }}"
                   class="px-4 py-2 rounded-lg border">
                    Batal
                </a>

                <button type="submit"
                        class="px-5 py-2 bg-blue-600 text-white rounded-lg">
                    💾 Simpan Honor
                </button>
            </div>
        </form>

    </div>
</div>

{{-- JAVASCRIPT INTERAKTIF --}}
<script>
document.addEventListener('DOMContentLoaded', function () {
    const jenisHonor = document.getElementById('jenis_honor');
    const boxPembuatan = document.getElementById('box-pembuatan');
    const boxKoreksi = document.getElementById('box-koreksi');
    const inputPembuatan = document.getElementById('uang_pembuatan_soal');
    const inputKoreksi = document.getElementById('uang_koreksi_jawaban');

    jenisHonor.addEventListener('change', function () {
        boxPembuatan.classList.add('hidden');
        boxKoreksi.classList.add('hidden');

        inputPembuatan.disabled = true;
        inputKoreksi.disabled = true;

        inputPembuatan.value = 0;
        inputKoreksi.value = 0;

        if (this.value === 'pembuatan_soal') {
            boxPembuatan.classList.remove('hidden');
            inputPembuatan.disabled = false;
        }

        if (this.value === 'koreksi') {
            boxKoreksi.classList.remove('hidden');
            inputKoreksi.disabled = false;
        }
    });
});
</script>

{{-- ========== POPUP SWEETALERT2 ========== --}}
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@if (session('success'))
<script>
Swal.fire({
    icon: 'success',
    title: 'Berhasil',
    text: "{{ session('success') }}",
    timer: 2000,
    showConfirmButton: false
});
</script>
@endif

@if (session('error'))
<script>
Swal.fire({
    icon: 'error',
    title: 'Gagal',
    text: "{{ session('error') }}"
});
</script>
@endif

@endsection
