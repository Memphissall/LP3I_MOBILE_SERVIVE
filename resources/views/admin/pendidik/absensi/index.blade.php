@extends('layouts.app')

@section('content')
<div class="p-6 max-w-5xl mx-auto">
    <div class="bg-white rounded-lg shadow border p-6">
        <h2 class="text-xl font-bold mb-2">Input Presensi: {{ $matkul->nama_mk }}</h2>
        <div class="bg-blue-50 border border-blue-200 rounded p-3 mb-4 text-sm">
    <p><strong>Pertemuan:</strong> {{ $pertemuanSkrg }} / 14</p>
    <p><strong>BK:</strong> {{ $sks }}</p>
    <p><strong>Durasi:</strong> ({{ $durasiMenit }} Menit)</p>
</div>
        {{-- Bagian Tanggal & Pertemuan --}}
        <div class="text-gray-600 mb-6 italic text-sm flex items-center gap-2">
            Kelas: {{ $kelas->nama_kelas }} | 
            
            {{-- --- AWAL FITUR DROPDOWN PERTEMUAN --- --}}
            <span class="font-bold text-indigo-600">Pertemuan Ke-</span>
            <select name="id_pertemuan" form="absenForm" class="border-gray-300 rounded-md shadow-sm font-bold text-indigo-600 p-1 text-sm focus:ring-indigo-500">
                @for ($i = 1; $i <= 14; $i++)
                    <option value="{{ $i }}" {{ $pertemuanSkrg == $i ? 'selected' : '' }}>{{ $i }}</option>
                @endfor
            </select>
            {{-- --- AKHIR FITUR DROPDOWN PERTEMUAN --- --}}

            | Tanggal: {{ date('d/m/Y') }}
        </div>

        {{-- Menambahkan id="absenForm" agar dropdown di atas bisa ikut terkirim --}}
        <form id="absenForm" action="{{ route('admin.pendidik.absen.store', [$id_kelas, $kode_mk]) }}" method="POST">
            @csrf
            {{-- Input hidden id_pertemuan dihapus karena sudah ada select di atas --}}
            <input type="hidden" name="semester" value="{{ $semester }}"> 
            
            <table class="min-w-full table-auto border-collapse border border-gray-300">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="border border-gray-300 px-4 py-2 text-left w-48">NIPD</th>
                        <th class="border border-gray-300 px-4 py-2 text-left">Nama Mahasiswa</th>
                        <th class="border border-gray-300 px-4 py-2 text-center w-64">Status Kehadiran</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($mahasiswa as $m)
                    @php 
                        // Ambil ID Unik (NIPD atau NIPD) - TETAP SESUAI KODE ASLI KAMU
                       $idMhs = $m->nipd ?? $m->id;

                    @endphp
                    <tr class="hover:bg-gray-50 border-b">
                        <td class="px-4 py-3 text-sm border-r font-mono font-bold text-gray-700">
                            {{ $idMhs }}
                        </td>
                        <td class="px-4 py-3 text-sm border-r text-gray-800">
                            {{-- Nama Mahasiswa - TETAP SESUAI KODE ASLI KAMU --}}
                            {{ $m->nama_mhs ?? $m->nama ?? $m->name ?? 'Nama Tidak Terdeteksi' }}
                        </td>
                        <td class="px-4 py-3">
                            <div class="flex justify-around items-center">
    <label class="inline-flex items-center cursor-pointer">
        <input type="radio" name="absensi[{{ $idMhs }}]" value="Hadir" checked class="h-4 w-4 text-blue-600">
        <span class="ml-1 text-xs">Hadir</span>
    </label>

    <label class="inline-flex items-center cursor-pointer">
        <input type="radio" name="absensi[{{ $idMhs }}]" value="Izin" class="h-4 w-4 text-yellow-600">
        <span class="ml-1 text-xs">Izin</span>
    </label>

    <label class="inline-flex items-center cursor-pointer">
        <input type="radio" name="absensi[{{ $idMhs }}]" value="Sakit" class="h-4 w-4 text-blue-500">
        <span class="ml-1 text-xs">Sakit</span>
    </label>

    <label class="inline-flex items-center cursor-pointer">
        <input type="radio" name="absensi[{{ $idMhs }}]" value="Alpha" class="h-4 w-4 text-red-600">
        <span class="ml-1 text-xs">Alpha</span>
    </label>
</div>

                        </td>
                    </tr>
                    @empty
                    <tr><td colspan="3" class="px-4 py-10 text-center text-gray-500 italic">Data mahasiswa kosong.</td></tr>
                    @endforelse
                </tbody>
            </table>


                           <div class="mt-6 flex justify-between items-center">
                {{-- Tombol Kembali --}}
                <button type="button"
                    onclick="history.back()"
                    class="bg-gray-200 text-gray-700 px-6 py-2.5 rounded font-semibold hover:bg-gray-300 transition-all">
                    ← Kembali
                </button>

                {{-- Tombol Simpan --}}
                <button type="submit"
                    class="bg-indigo-600 text-white px-10 py-2.5 rounded shadow-lg font-bold hover:bg-indigo-700 active:scale-95 transition-all">
                    Simpan & Lanjut LKM →
                </button>
            </div>

        </form>
    </div>
</div>
@endsection