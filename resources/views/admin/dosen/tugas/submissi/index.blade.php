@extends('layouts.app')

@section('content')
<div class="p-6 max-w-4xl mx-auto">

    <h1 class="text-xl font-bold mb-4">Jawaban Mahasiswa - {{ $tugas->judul }}</h1>

    <a href="{{ route('tugas.index', [$tugas->id_kelas, $tugas->kode_mk]) }}"
       class="bg-gray-600 text-white px-4 py-2 rounded inline-block my-3 hover:bg-gray-700 transition">
       Kembali
    </a>

    <table class="w-full border mt-4">
        <thead>
            <tr class="bg-gray-200">
                <th class="border px-2 py-1">#</th>
                <th class="border px-2 py-1">Nama Mahasiswa</th>
                <th class="border px-2 py-1">File Jawaban</th>
                <th class="border px-2 py-1">Keterangan</th>
                <th class="border px-2 py-1">Tanggal Submit</th>
            </tr>
        </thead>
        <tbody>
            @forelse($submissi as $index => $s)
            <tr>
                <td class="border px-2 py-1">{{ $index + 1 }}</td>
                <td class="border px-2 py-1">{{ $s->nama_mahasiswa }}</td>
                <td class="border px-2 py-1">
                    @if($s->file_jawaban)
                        <a href="{{ asset('storage/jawaban/'.$s->file_jawaban) }}" target="_blank"
                           class="text-blue-600 hover:underline">Download</a>
                    @else
                        Tidak ada file
                    @endif
                </td>
                <td class="border px-2 py-1">{{ $s->keterangan ?? '-' }}</td>
                <td class="border px-2 py-1">{{ \Carbon\Carbon::parse($s->created_at)->format('d-m-Y H:i') }}</td>
            </tr>
            @empty
            <tr>
                <td colspan="5" class="border text-center py-3">Belum ada jawaban mahasiswa.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
