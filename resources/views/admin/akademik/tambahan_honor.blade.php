@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto px-6 py-6">

    <div class="bg-white rounded-xl shadow-md">

        {{-- HEADER --}}
        <div class="border-b px-6 py-4">
            <h2 class="text-lg font-semibold text-gray-800">
                💼 Input Honor Tambahan Dosen
            </h2>
            <p class="text-sm text-gray-500">
                Honor pembuatan soal & koreksi jawaban
            </p>
        </div>

        {{-- FORM --}}
        <form action="{{ route('admin.akademik.tambahan-honor.store') }}" method="POST">
            @csrf

            <div class="p-6 space-y-5">

                {{-- DOSEN --}}
                <div>
                    <label class="block text-sm font-medium mb-1">Dosen</label>
                    <select name="nidn" required
                        class="w-full rounded-lg border-gray-300 focus:ring focus:ring-blue-200">
                        <option value="">-- Pilih Dosen --</option>
                        @foreach ($dosen as $d)
                            <option value="{{ $d->nidn }}">
                                {{ $d->nidn }} - {{ $d->nama_dosen }}
                            </option>
                        @endforeach
                    </select>
                </div>

                {{-- SEMESTER --}}
                <div>
                    <label class="block text-sm font-medium mb-1">Periode</label>
                    <select name="semester" required
                        class="w-full rounded-lg border-gray-300 focus:ring focus:ring-blue-200">
                        <option value="">-- Pilih Periode --</option>
                        <option value="Ganjil">Ganjil</option>
                        <option value="Genap">Genap</option>
                    </select>
                </div>

                {{-- JENIS HONOR --}}
                <div>
                    <label class="block text-sm font-medium mb-1">Jenis Honor</label>
                    <select name="jenis_honor" id="jenis_honor" required
                        class="w-full rounded-lg border-gray-300 focus:ring focus:ring-blue-200">
                        <option value="">-- Pilih Jenis Honor --</option>
                        <option value="pembuatan_soal">Pembuatan Soal</option>
                        <option value="koreksi">Koreksi Jawaban</option>
                    </select>
                </div>

                {{-- BULAN --}}
                <div>
                    <label class="block text-sm font-medium mb-1">Bulan</label>
                    <select name="bulan" required
                        class="w-full rounded-lg border-gray-300 focus:ring focus:ring-blue-200">
                        <option value="">-- Pilih Bulan --</option>
                        @for ($i = 1; $i <= 12; $i++)
                            <option value="{{ $i }}">
                                {{ \Carbon\Carbon::create()->month($i)->translatedFormat('F') }}
                            </option>
                        @endfor
                    </select>
                </div>

                {{-- NOMINAL PEMBUATAN SOAL --}}
                <div id="box-pembuatan" class="hidden">
                    <label class="block text-sm font-medium mb-1">
                        Uang Pembuatan Soal
                    </label>
                    <input type="number"
                           name="uang_pembuatan_soal"
                           id="uang_pembuatan_soal"
                           value="0"
                           disabled
                           class="w-full rounded-lg border-gray-300 focus:ring focus:ring-blue-200">
                </div>

                {{-- NOMINAL KOREKSI --}}
                <div id="box-koreksi" class="hidden">
                    <label class="block text-sm font-medium mb-1">
                        Uang Koreksi Jawaban
                    </label>
                    <input type="number"
                           name="uang_koreksi_jawaban"
                           id="uang_koreksi_jawaban"
                           value="0"
                           disabled
                           class="w-full rounded-lg border-gray-300 focus:ring focus:ring-blue-200">
                </div>

            </div>

            {{-- FOOTER --}}
            <div class="border-t px-6 py-4 flex justify-end gap-2">
                <a href="{{ url()->previous() }}"
                   class="px-4 py-2 rounded-lg border text-gray-600 hover:bg-gray-100">
                    Batal
                </a>

                <button type="submit"
                    class="px-5 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">
                    💾 Simpan Honor
                </button>
            </div>
        </form>

    </div>
</div>

{{-- ================= JAVASCRIPT ================= --}}
<script>
document.addEventListener('DOMContentLoaded', function () {
    const jenisHonor = document.getElementById('jenis_honor');

    const boxPembuatan = document.getElementById('box-pembuatan');
    const boxKoreksi = document.getElementById('box-koreksi');

    const inputPembuatan = document.getElementById('uang_pembuatan_soal');
    const inputKoreksi = document.getElementById('uang_koreksi_jawaban');

    jenisHonor.addEventListener('change', function () {
        // RESET
        boxPembuatan.classList.add('hidden');
        boxKoreksi.classList.add('hidden');

        inputPembuatan.disabled = true;
        inputKoreksi.disabled = true;

        inputPembuatan.value = 0;
        inputKoreksi.value = 0;

        // SHOW BASED ON OPTION
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

{{-- ========== POPUP SUCCESS ========== --}}
@if (session('success'))
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
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

{{-- ========== POPUP ERROR ========== --}}
@if (session('error'))
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
Swal.fire({
    icon: 'error',
    title: 'Gagal',
    text: "{{ session('error') }}"
});
</script>
@endif

@endsection
