@extends('layouts.app')

@section('content')
<div class="max-w-3xl mx-auto p-6 bg-white shadow rounded">

    <h2 class="text-2xl font-bold mb-4">Tambah User Pendidik</h2>

    {{-- SUCCESS --}}
    @if (session('success'))
        <div class="bg-green-200 text-green-800 p-3 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    {{-- ERROR --}}
    @if ($errors->any())
        <div class="bg-red-200 text-red-800 p-3 rounded mb-4">
            <ul class="list-disc ml-4">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.users.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        {{-- ================= AKUN LOGIN ================= --}}
        <h3 class="font-semibold text-lg mt-6 mb-2">Akun Login</h3>

        <label class="block">Nama User</label>
        <input type="text" name="name"
            value="{{ old('name') }}"
            class="border w-full p-2 mb-3 rounded" required>

        <label class="block">Email Login</label>
        <input type="email" name="email"
            value="{{ old('email') }}"
            class="border w-full p-2 mb-3 rounded" required>

        <label class="block">Password Login</label>
        <input type="password" name="password"
            class="border w-full p-2 mb-3 rounded" required>

        <label class="block">Role</label>
        <input type="text" name="role"
            value="pendidik"
            readonly
            class="border w-full p-2 mb-3 rounded bg-gray-100">

        {{-- ================= DATA PENDIDIK ================= --}}
        <h3 class="font-semibold text-lg mt-6 mb-2">Data Pendidik</h3>

        <label class="block">ID Pendidik</label>
        <input type="text" name="id_pendidik"
            value="{{ old('id_pendidik') }}"
            class="border w-full p-2 mb-3 rounded" required>

        <label class="block">Nama Pendidik</label>
        <input type="text" name="nama_pendidik"
            value="{{ old('nama_pendidik') }}"
            class="border w-full p-2 mb-3 rounded" required>

        <label class="block">Pendidikan</label>
        <input type="text" name="pendidikan"
            value="{{ old('pendidikan') }}"
            class="border w-full p-2 mb-3 rounded">

        <label class="block">Bidang</label>
        <input type="text" name="bidang"
            value="{{ old('bidang') }}"
            class="border w-full p-2 mb-3 rounded">

        <label class="block">Tempat Lahir</label>
        <input type="text" name="tempat_lahir"
            value="{{ old('tempat_lahir') }}"
            class="border w-full p-2 mb-3 rounded">

        <label class="block">Tanggal Lahir</label>
        <input type="date" name="tgl_lahir"
            value="{{ old('tgl_lahir') }}"
            class="border w-full p-2 mb-3 rounded">

        <label class="block">Jenis Kelamin</label>
        <select name="jenis_kelamin" class="border w-full p-2 mb-3 rounded">
            <option value="Laki-laki" {{ old('jenis_kelamin') == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
            <option value="Perempuan" {{ old('jenis_kelamin') == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
        </select>

        <label class="block">Agama</label>
        <input type="text" name="agama"
            value="{{ old('agama') }}"
            class="border w-full p-2 mb-3 rounded">

        <label class="block">Email Pendidik</label>
        <input type="email" name="email_pendidik"
            value="{{ old('email_pendidik') }}"
            class="border w-full p-2 mb-3 rounded" required>

        <label class="block">No Telp</label>
        <input type="text" name="no_tlp"
            value="{{ old('no_tlp') }}"
            class="border w-full p-2 mb-3 rounded">

        <label class="block">Honor per SKS</label>
        <input type="number" name="rate_gaji"
            value="{{ old('rate_gaji') }}"
            class="border w-full p-2 mb-3 rounded">

        <label class="block">Foto (opsional)</label>
        <input type="file" name="foto"
            class="border w-full p-2 mb-4 rounded">

        {{-- ================= BUTTON ================= --}}
        <button type="submit"
            class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-2 rounded">
            Simpan
        </button>

        <a href="{{ route('admin.users.index') }}"
           class="ml-3 bg-gray-500 hover:bg-gray-600 text-white px-5 py-2 rounded">
            Kembali
        </a>
    </form>
</div>
@endsection
