@extends('layouts.app')

@section('content')
<div class="p-6 max-w-4xl mx-auto">
    <div class="bg-white rounded-lg shadow border p-6">
        <div class="flex items-center gap-2 mb-4">
            <h2 class="text-xl font-bold text-gray-800">Edit Riwayat LKM</h2>
            <span class="px-2 py-1 bg-amber-100 text-amber-700 rounded text-[10px] font-bold uppercase border border-amber-200">Mode Edit</span>
        </div>

        {{-- Route diarahkan ke storeLkm karena di controller kamu storeLkm menggunakan sistem update --}}
        <form action="{{ route('dosen.lkm.store', [$id_kelas, $kode_mk]) }}" method="POST">
            @csrf
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6">
                {{-- Dropdown Pertemuan --}}
                <div>
                    <label class="block text-xs font-bold text-gray-500 uppercase mb-1">Pertemuan Ke-</label>
                    <select name="id_pertemuan" class="block w-full border-gray-300 rounded-md shadow-sm font-bold text-indigo-600 focus:ring-indigo-500">
                        @for ($i = 1; $i <= 14; $i++)
                            <option value="{{ $i }}" {{ $lkm->id_pertemuan == $i ? 'selected' : '' }}>
                                Pertemuan Ke-{{ $i }}
                            </option>
                        @endfor
                    </select>
                </div>
                <div>
                    <label class="block text-xs font-bold text-gray-500 uppercase mb-1">Tanggal</label>
                    <div class="mt-2 text-sm font-semibold text-gray-700">
                        {{ \Carbon\Carbon::parse($lkm->tanggal)->format('d/m/Y') }}
                    </div>
                </div>
            </div>

            {{-- Input Materi --}}
            <div class="mb-4">
                <label class="block text-xs font-bold text-gray-500 uppercase mb-1">Materi yang Diajarkan</label>
                <textarea name="materi" rows="3" class="w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500" required>{{ $lkm->materi }}</textarea>
            </div>

            {{-- FITUR BARU: METODE PEMBELAJARAN (MODE EDIT) --}}
            <div class="mb-4">
                <label class="block text-xs font-bold text-gray-500 uppercase mb-1">Metode Pembelajaran</label>
                <select name="metode_mengajar" class="w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 bg-white">
                    <option value="Offline" {{ $lkm->metode_mengajar == 'Offline' ? 'selected' : '' }}>Offline</option>
                    <option value="Online" {{ $lkm->metode_mengajar == 'Online' ? 'selected' : '' }}>Online</option>
                </select>
            </div>

            {{-- Input Catatan --}}
            <div class="mb-6">
                <label class="block text-xs font-bold text-gray-500 uppercase mb-1">Catatan/Evaluasi (Opsional)</label>
                <textarea name="catatan" rows="2" class="w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500">{{ $lkm->catatan }}</textarea>
            </div>

            <div class="flex justify-end gap-3">
                <a href="{{ url('/dosen/absensi/list/'.$id_kelas.'/'.$kode_mk) }}" class="bg-gray-100 text-gray-600 px-6 py-2.5 rounded font-bold hover:bg-gray-200 transition text-sm">
                    BATAL
                </a>
                <button type="submit" class="bg-amber-500 text-white px-8 py-2.5 rounded shadow-lg font-bold hover:bg-amber-600 active:scale-95 transition-all text-sm">
                    SIMPAN PERUBAHAN
                </button>
            </div>
        </form>
    </div>
</div>
@endsection