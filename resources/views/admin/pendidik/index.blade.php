@extends('layouts.app')

@section('content')
<div class="max-w-6xl mx-auto py-10">

    <div class="flex justify-between mb-4">
        <h1 class="text-3xl font-bold">Data Pendidik</h1>
        <a href="{{ route('admin.pendidik.create') }}" class="px-4 py-2 bg-blue-600 text-white rounded">+ Tambah Pendidik</a>
    </div>

    <div class="bg-white shadow p-4 rounded">
        <table class="w-full">
            <thead>
                <tr class="bg-gray-100">
                    <th class="p-3 border">Id_Pendidik</th>
                    <th class="p-3 border">Nama</th>
                    <th class="p-3 border">Email</th>
                    <th class="p-3 border">Bidang</th>
                    <th class="p-3 border">Aksi</th>
                </tr>
            </thead>

            <tbody>
                @foreach ($pendidik as $d)
                <tr class="border">
                    <td class="p-3 border">{{ $d->id_pendidik }}</td>
                    <td class="p-3 border">{{ $d->nama_pendidik }}</td>
                    <td class="p-3 border">{{ $d->email }}</td>
                    <td class="p-3 border">{{ $d->bidang }}</td>

                    <td class="p-3 border">
                        <a href="{{ route('admin.pendidik.edit', $d->id) }}" class="px-3 py-1 bg-yellow-500 text-white rounded">Edit</a>

                        <form action="{{ route('admin.pendidik.destroy', $d->id) }}" method="POST" class="inline-block"
                              onsubmit="return confirm('Hapus data?');">
                            @csrf
                            @method('DELETE')
                            <button class="px-3 py-1 bg-red-600 text-white rounded">Hapus</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>

        </table>
    </div>

</div>
@endsection
