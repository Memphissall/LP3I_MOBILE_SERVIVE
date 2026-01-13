@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto p-6">

    <h1 class="text-3xl font-bold mb-6">📘 Rekap LKM Dosen</h1>

    {{-- FILTER --}}
    <form method="GET" class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-6">
        <select name="nidn" class="border rounded-lg p-2">
            <option value="">Semua Dosen</option>
            @foreach($dosen as $d)
                <option value="{{ $d->nidn }}" @selected(request('nidn')==$d->nidn)>
                    {{ $d->nama_dosen }}
                </option>
            @endforeach
        </select>

        <select name="kode_mk" class="border rounded-lg p-2">
            <option value="">Semua Matkul</option>
            @foreach($matkul as $mk)
                <option value="{{ $mk->kode_mk }}" @selected(request('kode_mk')==$mk->kode_mk)>
                    {{ $mk->nama_mk }}
                </option>
            @endforeach
        </select>

        <select name="id_kelas" class="border rounded-lg p-2">
            <option value="">Semua Kelas</option>
            @foreach($kelas as $k)
                <option value="{{ $k->id_kelas }}" @selected(request('id_kelas')==$k->id_kelas)>
                    {{ $k->nama_kelas }}
                </option>
            @endforeach
        </select>

        <button class="bg-teal-600 hover:bg-teal-700 text-white rounded-lg">
            Filter
        </button>
    </form>

    {{-- TABLE --}}
    <div class="bg-white rounded-xl shadow overflow-x-auto">
        <table class="w-full text-sm">
            <thead class="bg-gray-100">
                <tr>
                    <th class="p-3 text-left">Tanggal</th>
                    <th class="p-3">Dosen</th>
                    <th class="p-3">Matakuliah</th>
                    <th class="p-3">Kelas</th>
                    <th class="p-3">Pertemuan</th>
                    <th class="p-3">Materi</th>
                    <th class="p-3">Metode</th>
                </tr>
            </thead>
            <tbody>
                @forelse($data as $row)
                <tr class="border-b">
                    <td class="p-3">{{ \Carbon\Carbon::parse($row->tanggal)->format('d M Y') }}</td>
                    <td class="p-3">{{ $row->nama_dosen }}</td>
                    <td class="p-3">{{ $row->nama_mk }}</td>
                    <td class="p-3">{{ $row->nama_kelas }}</td>
                    <td class="p-3 text-center">Ke-{{ $row->id_pertemuan }}</td>
                    <td class="p-3">{{ $row->materi ?? '-' }}</td>
                    <td class="p-3">{{ $row->metode_mengajar ?? '-' }}</td>
                </tr>
                @empty
                <tr>
                    <td colspan="7" class="text-center p-6 text-gray-500">
                        Belum ada data LKM
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

</div>
@endsection
