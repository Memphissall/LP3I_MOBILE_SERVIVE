
@extends('layouts.app')

@section('content')

<div class="max-w-3xl mx-auto bg-white p-6 rounded shadow">
    <h2 class="text-2xl font-semibold mb-4">Tambah User</h2>

    {{-- Error --}}
    @if ($errors->any())
        <div class="mb-4 bg-red-100 text-red-700 px-4 py-2 rounded">
            <ul class="list-disc ml-5">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.user.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        {{-- USER LOGIN --}}
        <div class="mb-3">
            <label class="font-medium">Nama User</label>
            <input type="text" name="name" class="w-full border px-3 py-2 rounded" required>
        </div>

        <div class="mb-3">
            <label class="font-medium">Email Login</label>
            <input type="email" name="email" class="w-full border px-3 py-2 rounded" required>
        </div>

        <div class="mb-3">
            <label class="font-medium">Password</label>
            <input type="password" name="password" class="w-full border px-3 py-2 rounded" required>
        </div>

        <div class="mb-3">
            <label class="font-medium">Role</label>
            <select name="role" id="role" class="w-full border px-3 py-2 rounded" required>
                <option value="">- Pilih Role -</option>
                <option value="pendidik">Pendidik</option>
                <option value="mahasiswa">Mahasiswa</option>
                <option value="admin">Admin</option>
            </select>
        </div>

        <div class="mb-4">
            <label class="font-medium">Foto (opsional, hanya untuk pendidik)</label>
            <input type="file" name="foto" class="w-full border px-3 py-2 rounded">
        </div>

        {{-- FORM PENDIDIK --}}
        <div id="form-pendidik" class="hidden">
            <h3 class="text-xl font-semibold mb-2">Data Pendidik</h3>
            <div class="grid grid-cols-2 gap-4">
                <div class="mb-3">
                    <label class="font-medium">Id_Pendidik</label>
                    <input type="text" name="id_pendidik" class="w-full border px-3 py-2 rounded">
                </div>
                <div class="mb-3">
                    <label class="font-medium">Nama Pendidik</label>
                    <input type="text" name="nama_pendidik" class="w-full border px-3 py-2 rounded">
                </div>
                <div class="mb-3">
                    <label class="font-medium">Pendidikan</label>
                    <input type="text" name="pendidikan" class="w-full border px-3 py-2 rounded">
                </div>
                <div class="mb-3">
                    <label class="font-medium">Bidang</label>
                    <input type="text" name="bidang" class="w-full border px-3 py-2 rounded">
                </div>
                <div class="mb-3">
                    <label class="font-medium">Tempat Lahir</label>
                    <input type="text" name="tempat" class="w-full border px-3 py-2 rounded">
                </div>
                <div class="mb-3">
                    <label class="font-medium">Tanggal Lahir</label>
                    <input type="date" name="tanggal_lahir" class="w-full border px-3 py-2 rounded">
                </div>
                <div class="mb-3">
                    <label class="font-medium">Jenis Kelamin</label>
                    <select name="jenis_kelamin" class="w-full border px-3 py-2 rounded">
                        <option value="">- Pilih -</option>
                        <option value="Laki-laki">Laki-laki</option>
                        <option value="Perempuan">Perempuan</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label class="font-medium">Agama</label>
                    <input type="text" name="agama" class="w-full border px-3 py-2 rounded">
                </div>
                <div class="mb-3">
                    <label class="font-medium">Email Pendidik</label>
                    <input type="email" name="email_pendidik" class="w-full border px-3 py-2 rounded">
                </div>
                <div class="mb-3">
                    <label class="font-medium">No. Telepon</label>
                    <input type="text" name="no_telp" class="w-full border px-3 py-2 rounded">
                </div>
                <div class="mb-3">
                    <label class="font-medium">Honor per SKS</label>
                    <input type="number" name="honor_per_sks" class="w-full border px-3 py-2 rounded">
                </div>
            </div>
        </div>

        <button class="mt-3 bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Simpan Data</button>
        <a href="{{ route('admin.users.index') }}" class="inline-block mb-4 bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600">Kembali</a>
    </form>
</div>

<script>
    const roleSelect = document.getElementById('role');
    const formPendidik = document.getElementById('form-pendidik');

    roleSelect.addEventListener('change', function() {
        formPendidik.classList.toggle('hidden', this.value !== 'pendidik');
    });
</script>

@endsection
