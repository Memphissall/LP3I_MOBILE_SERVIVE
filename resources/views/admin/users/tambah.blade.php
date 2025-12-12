@extends('layouts.app')

@section('content')
<div class="max-w-3xl mx-auto p-6">

    <h2 class="text-2xl font-bold mb-4">Tambah User Dosen</h2>

    @if (session('success'))
        <div class="bg-green-200 p-3 rounded mb-3">
            {{ session('success') }}
        </div>
    @endif

    <form action="{{ route('admin.user.store') }}" method="POST">
        @csrf

        <h3 class="font-semibold text-lg mt-4">Akun Login</h3>

        <label>Email Login</label>
        <input type="email" name="email" class="border w-full p-2 mb-3">

        <label>Password Login</label>
        <input type="password" name="password" class="border w-full p-2 mb-3">

        <h3 class="font-semibold text-lg mt-4">Data Dosen</h3>

        <label>NIDN</label>
        <input type="text" name="nidn" class="border w-full p-2 mb-3">

        <label>Nama Dosen</label>
        <input type="text" name="nama_dosen" class="border w-full p-2 mb-3">

        <label>Pendidikan</label>
        <input type="text" name="pendidikan" class="border w-full p-2 mb-3">

        <label>Bidang</label>
        <input type="text" name="bidang" class="border w-full p-2 mb-3">

        <label>Tempat Lahir</label>
        <input type="text" name="tempat" class="border w-full p-2 mb-3">

        <label>Tanggal Lahir</label>
        <input type="date" name="tanggal_lahir" class="border w-full p-2 mb-3">

        <label>Jenis Kelamin</label>
        <select name="jenis_kelamin" class="border w-full p-2 mb-3">
            <option value="Laki-laki">Laki-laki</option>
            <option value="Perempuan">Perempuan</option>
        </select>

        <label>Agama</label>
        <input type="text" name="agama" class="border w-full p-2 mb-3">

        <label>Email Dosen</label>
        <input type="email" name="email_dosen" class="border w-full p-2 mb-3">

        <label>No Telp</label>
        <input type="text" name="no_telp" class="border w-full p-2 mb-3">

        <label>Honor per SKS</label>
        <input type="number" name="honor_per_sks" class="border w-full p-2 mb-3">

        <button class="bg-blue-600 text-white px-4 py-2 rounded">Simpan</button>
        
    </form>
</div>
@endsection
