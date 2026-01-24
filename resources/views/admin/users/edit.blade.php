@extends('layouts.app')

@section('content')
<div class="max-w-3xl mx-auto bg-white p-6 rounded shadow">

    <h2 class="text-2xl font-bold mb-6">Edit User + Data Pendidik</h2>

    {{-- ALERT ERROR --}}
    @if ($errors->any())
        <div class="mb-4 p-4 bg-red-200 text-red-800 rounded">
            <strong>Terjadi kesalahan:</strong>
            <ul class="mt-2 list-disc ml-6">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.users.update', $user->id_user) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        {{-- ============================
            SECTION USER
        ============================= --}}
        <h3 class="text-lg font-semibold mb-2">Akun User (Untuk Login)</h3>

        <div class="mb-4">
            <label class="font-medium">Nama User</label>
            <input type="text" name="name" class="w-full border p-2 rounded"
                value="{{ old('name', $user->name) }}">
        </div>

        <div class="mb-4">
            <label class="font-medium">Email Login</label>
            <input type="email" name="email" class="w-full border p-2 rounded"
                value="{{ old('email', $user->email) }}">
        </div>

        <div class="mb-4">
            <label class="font-medium">Password (Kosongkan jika tidak diganti)</label>
            <input type="password" name="password" class="w-full border p-2 rounded">
        </div>

        <div class="mb-4">
            <label class="font-medium">Role</label>
            <select name="role" class="w-full border p-2 rounded" id="roleSelect">
                <option value="">- Pilih Role -</option>
                <option value="admin" {{ $user->role == 'admin' ? 'selected' : '' }}>Admin</option>
                <option value="pendidik" {{ $user->role == 'pendidik' ? 'selected' : '' }}>Pendidik</option>
            </select>
        </div>

        <div class="mb-4">
            <label class="font-medium">Foto</label><br>
            <input type="file" name="foto">

            @if ($user->foto)
                <img src="{{ asset('storage/'.$user->foto) }}" class="h-20 mt-2 rounded">
            @endif
        </div>

        {{-- ============================
            SECTION PENDIDIK
        ============================= --}}
        <h3 class="text-lg font-semibold mt-8">Data Pendidik</h3>
        <p class="text-sm text-gray-600 mb-3">Data ini hanya dipakai jika role = pendidik.</p>

        @php
            $d = $user->pendidik; // relasi
        @endphp

        <div id="pendidikFields" class="{{ $user->role !== 'pendidik' ? 'hidden' : '' }}">

            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label>id_pendidik</label>
                    <input type="text" name="id_pendidik" class="w-full border p-2 rounded"
                        value="{{ old('id_pendidik', $d->id_pendidik ?? '') }}">
                </div>

                <div>
                    <label>Nama Pendidik</label>
                    <input type="text" name="nama_pendidik" class="w-full border p-2 rounded"
                        value="{{ old('nama_pendidik', $d->nama_pendidik ?? '') }}">
                </div>

                <div>
                    <label>Pendidikan</label>
                    <input type="text" name="pendidikan" class="w-full border p-2 rounded"
                        value="{{ old('pendidikan', $d->pendidikan ?? '') }}">
                </div>

                <div>
                    <label>Bidang</label>
                    <input type="text" name="bidang" class="w-full border p-2 rounded"
                        value="{{ old('bidang', $d->bidang ?? '') }}">
                </div>

                <div>
                    <label>Tempat Lahir</label>
                    <input type="text" name="tempat" class="w-full border p-2 rounded"
                        value="{{ old('tempat', $d->tempat ?? '') }}">
                </div>

                <div>
                    <label>Tanggal Lahir</label>
                    <input type="date" name="tanggal_lahir" class="w-full border p-2 rounded"
                        value="{{ old('tanggal_lahir', $d->tanggal_lahir ?? '') }}">
                </div>

                <div>
                    <label>Jenis Kelamin</label>
                    <select name="jenis_kelamin" class="w-full border p-2 rounded">
                        <option value="">- Pilih -</option>
                        <option value="Laki-laki" 
                            {{ (old('jenis_kelamin', $d->jenis_kelamin ?? '') == 'Laki-laki') ? 'selected' : '' }}>
                            Laki-laki
                        </option>
                        <option value="Perempuan"
                            {{ (old('jenis_kelamin', $d->jenis_kelamin ?? '') == 'Perempuan') ? 'selected' : '' }}>
                            Perempuan
                        </option>
                    </select>
                </div>

                <div>
                    <label>Agama</label>
                    <input type="text" name="agama" class="w-full border p-2 rounded"
                        value="{{ old('agama', $d->agama ?? '') }}">
                </div>

                <div>
                    <label>Email Pendidik</label>
                    <input type="email" name="email_pendidik" class="w-full border p-2 rounded"
                        value="{{ old('email_pendidik', $d->email ?? '') }}">
                </div>

                <div>
                    <label>No. Telepon</label>
                    <input type="text" name="no_telp" class="w-full border p-2 rounded"
                        value="{{ old('no_telp', $d->no_telp ?? '') }}">
                </div>

                <div>
                    <label>Honor per SKS</label>
                    <input type="number" name="honor_per_sks" class="w-full border p-2 rounded"
                        value="{{ old('honor_per_sks', $d->honor_per_sks ?? '') }}">
                </div>
            </div>
        </div>

        <button class="mt-6 bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
            Update Data
        </button>
         <a href="{{ route('admin.users.index') }}" 
       class="inline-block mb-4 bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600">
        Kembali
    </a>
    </form>
</div>

{{-- JS: Hide/Show Data Pendidik --}}
<script>
    document.getElementById('roleSelect').addEventListener('change', function(){
        let isPendidik = this.value === 'pendidik';
        document.getElementById('pendidikFields').classList.toggle('hidden', !isPendidik);
    });
</script>
@endsection
