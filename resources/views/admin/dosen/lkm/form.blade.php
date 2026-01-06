@extends('layouts.app')

@section('content')
<div class="p-6 max-w-4xl mx-auto">
    <div class="bg-white rounded-lg shadow border p-6">
        <h2 class="text-xl font-bold mb-4">Isi Materi LKM (Laporan Kegiatan Mengajar)</h2>

        <form action="{{ route('dosen.lkm.store', [$id_kelas, $kode_mk]) }}" method="POST">
            @csrf
            {{-- Tambahkan semester agar tidak hilang saat redirect --}}
            <input type="hidden" name="semester" value="{{ $semester }}">
            <input type="hidden" name="id_pertemuan" value="{{ $pertemuanSkrg }}">

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6">
                {{-- FITUR DROPDOWN PERTEMUAN DI LKM --}}
                <div>
    <label class="block text-xs font-bold text-gray-500 uppercase mb-1">Pertemuan</label>
    <div class="mt-2 text-sm font-semibold text-indigo-600">
        Pertemuan Ke-{{ $pertemuanSkrg }}
    </div>
</div>

                <div>
                    <label class="block text-xs font-bold text-gray-500 uppercase mb-1">Tanggal</label>
                    <div class="mt-2 text-sm font-semibold text-gray-700">{{ date('d/m/Y') }}</div>
                </div>
            </div>

            {{-- Input Materi --}}
            <div class="mb-4">
                <label class="block text-xs font-bold text-gray-500 uppercase mb-1">Pokok Pembahasan</label>
                <textarea name="materi" rows="3" class="w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500" placeholder="Contoh: Pengenalan Dasar PHP" required></textarea>
            </div>

            {{--: METODE PEMBELAJARAN (DI TENAH) --}}
            <div class="mb-4">
                <label class="block text-xs font-bold text-gray-500 uppercase mb-1">Metode Pembelajaran</label>
                <select name="metode_mengajar" class="w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 bg-white">
                    <option value="Offline">Offline</option>
                    <option value="Online">Online</option>
                </select>
            </div>

            {{-- Input Catatan --}}
            <div class="mb-6">
                <label class="block text-xs font-bold text-gray-500 uppercase mb-1">Catatan/Evaluasi (Opsional)</label>
                <textarea name="catatan" rows="2" class="w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500" placeholder="Contoh: Mahasiswa cukup antusias"></textarea>
            </div>
               <div class="mt-6 flex justify-between items-center">
    {{-- Tombol Kembali --}}
            <button type="button"
                onclick="history.back()"
                class="bg-gray-200 text-gray-700 px-6 py-2.5 rounded font-semibold hover:bg-gray-300 transition-all">
                ← Kembali
            </button>

            {{-- Tombol Simpan --}}
            <button type="submit"
                class="bg-green-600 text-white px-8 py-2.5 rounded shadow font-bold hover:bg-green-700 transition-all">
                Simpan & Posting LKM
            </button>
        </div>

        </form>
    </div>
</div>
@endsection