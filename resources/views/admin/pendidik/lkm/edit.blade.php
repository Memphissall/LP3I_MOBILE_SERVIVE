@extends('layouts.app')

@section('content')
<div class="p-6 max-w-4xl mx-auto">
    <div class="bg-white rounded-xl shadow-lg border border-gray-100 p-8">

        {{-- HEADER --}}
        <div class="flex items-center justify-between mb-6">
            <div class="flex items-center gap-2">
                <h2 class="text-xl font-bold text-gray-800">Edit Riwayat LKM</h2>
                <span class="px-3 py-1 bg-amber-100 text-amber-700 rounded-full text-[10px] font-bold uppercase border border-amber-200">
                    Mode Edit
                </span>
            </div>
        </div>

        {{-- ERROR MESSAGE --}}
        @if ($errors->any())
            <div class="mb-5 bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-lg text-sm">
                <ul class="list-disc ml-5 space-y-1">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('pendidik.lkm.store', [$id_kelas, $id_mk]) }}" method="POST">
            @csrf
            
            {{-- GRID HEADER --}}
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">

                {{-- Dropdown Pertemuan --}}
                <div>
                    <label class="block text-xs font-bold text-gray-500 uppercase mb-2">
                        Pertemuan Ke-
                    </label>
                    <select name="pertemuan"
                        class="block w-full border-gray-300 rounded-lg shadow-sm font-bold text-indigo-600 focus:ring-indigo-500 focus:border-indigo-500">
                        @for ($i = 1; $i <= 14; $i++)
                            <option value="{{ $i }}" {{ $lkm->pertemuan == $i ? 'selected' : '' }}>
                                Pertemuan Ke-{{ $i }}
                            </option>
                        @endfor
                    </select>
                </div>

                {{-- Tanggal --}}
                <div>
                    <label class="block text-xs font-bold text-gray-500 uppercase mb-2">
                        Tanggal
                    </label>
                    <div class="bg-gray-50 border border-gray-200 rounded-lg px-4 py-2 text-sm font-semibold text-gray-700">
                        {{ \Carbon\Carbon::parse($lkm->tanggal)->format('d/m/Y') }}
                    </div>
                </div>
            </div>

            {{-- Materi --}}
            <div class="mb-5">
                <label class="block text-xs font-bold text-gray-500 uppercase mb-2">
                    Materi yang Diajarkan
                </label>
                <textarea name="materi" rows="3"
                    class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500"
                    required>{{ old('materi', $lkm->materi) }}</textarea>
            </div>

            {{-- Sub Pembahasan --}}
            <div class="mb-5">
                <label class="block text-xs font-bold text-gray-500 uppercase mb-2">
                    Sub Pembahasan
                </label>
                <textarea name="sub_pembahasan" rows="3"
                    class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500"
                    placeholder="Contoh:
- Pengertian Variabel
- Struktur Kontrol
- Function PHP">{{ old('sub_pembahasan', $lkm->sub_pembahasan) }}</textarea>
            </div>

            {{-- Metode Pembelajaran --}}
            <div class="mb-5">
                <label class="block text-xs font-bold text-gray-500 uppercase mb-2">
                    Metode Pembelajaran
                </label>
                <select name="metode_mengajar"
                    class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500 bg-white">
                    <option value="Offline" {{ $lkm->metode_mengajar == 'Offline' ? 'selected' : '' }}>
                        Offline
                    </option>
                    <option value="Online" {{ $lkm->metode_mengajar == 'Online' ? 'selected' : '' }}>
                        Online
                    </option>
                </select>
            </div>

            {{-- Catatan --}}
            <div class="mb-8">
                <label class="block text-xs font-bold text-gray-500 uppercase mb-2">
                    Motivation (Max 5 Minutes)
                </label>
                <textarea name="catatan" rows="3"
                    class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500"
                    placeholder="Isi motivasi atau catatan tambahan...">{{ old('catatan', $lkm->catatan) }}</textarea>
            </div>

            {{-- BUTTON --}}
            <div class="flex justify-end gap-3">
                <a href="{{ url('/pendidik/absensi/list/'.$id_kelas.'/'.$id_mk) }}"
                   class="bg-gray-100 text-gray-600 px-6 py-2.5 rounded-lg font-bold hover:bg-gray-200 transition text-sm">
                    BATAL
                </a>

                <button type="submit"
                    class="bg-amber-500 text-white px-8 py-2.5 rounded-lg shadow-lg font-bold hover:bg-amber-600 active:scale-95 transition-all text-sm">
                    SIMPAN PERUBAHAN
                </button>
            </div>

        </form>
    </div>
</div>
@endsection
