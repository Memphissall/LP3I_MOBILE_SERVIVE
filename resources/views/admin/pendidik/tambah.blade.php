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

    <form action="{{ route('admin.users.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        {{-- USER LOGIN --}}
        <div class="mb-3">
            <label class="font-medium">Nama User</label>
            <input type="text" name="name" value="{{ old('name') }}"
                class="w-full border px-3 py-2 rounded" required>
        </div>

        <div class="mb-3">
            <label class="font-medium">Email Login</label>
            <input type="email" name="email" value="{{ old('email') }}"
                class="w-full border px-3 py-2 rounded" required>
        </div>

        <div class="mb-3">
            <label class="font-medium">Password</label>
            <input type="password" name="password"
                class="w-full border px-3 py-2 rounded" required>
        </div>

        <div class="mb-3">
            <label class="font-medium">Role</label>
            <select name="role" id="role"
                class="w-full border px-3 py-2 rounded" required>
                <option value="">- Pilih Role -</option>
                <option value="pendidik" {{ old('role') == 'pendidik' ? 'selected' : '' }}>Pendidik</option>
                <option value="mahasiswa" {{ old('role') == 'mahasiswa' ? 'selected' : '' }}>Mahasiswa</option>
                <option value="admin" {{ old('role') == 'admin' ? 'selected' : '' }}>Admin</option>
            </select>
        </div>

        <div class="mb-4">
            <label class="font-medium">Foto (opsional, hanya untuk pendidik)</label>
            <input type="file" name="foto"
                class="w-full border px-3 py-2 rounded">
        </div>

        {{-- FORM PENDIDIK --}}
        <div id="form-pendidik"
            class="{{ old('role') === 'pendidik' ? '' : 'hidden' }}">

            <h3 class="text-xl font-semibold mb-2">Data Pendidik</h3>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                    <label>ID Pendidik</label>
                    <input name="id_pendidik" value="{{ old('id_pendidik') }}"
                        class="w-full border px-3 py-2 rounded">
                </div>

                <div>
                    <label>Nama Pendidik</label>
                    <input name="nama_pendidik" value="{{ old('nama_pendidik') }}"
                        class="w-full border px-3 py-2 rounded">
                </div>

                <div>
                    <label>Pendidikan</label>
                    <input name="pendidikan" value="{{ old('pendidikan') }}"
                        class="w-full border px-3 py-2 rounded">
                </div>

                <div>
                    <label>Bidang</label>
                    <input name="bidang" value="{{ old('bidang') }}"
                        class="w-full border px-3 py-2 rounded">
                </div>

                <div>
                    <label>Tempat Lahir</label>
                    <input name="tempat_lahir" value="{{ old('tempat_lahir') }}"
                        class="w-full border px-3 py-2 rounded">
                </div>

                <div>
                    <label>Tanggal Lahir</label>
                    <input type="date" name="tgl_lahir" value="{{ old('tgl_lahir') }}"
                        class="w-full border px-3 py-2 rounded">
                </div>

                <div>
                    <label>Jenis Kelamin</label>
                    <select name="jenis_kelamin" class="w-full border px-3 py-2 rounded">
                        <option value="">- Pilih -</option>
                        <option value="Laki-laki" {{ old('jenis_kelamin')=='Laki-laki'?'selected':'' }}>Laki-laki</option>
                        <option value="Perempuan" {{ old('jenis_kelamin')=='Perempuan'?'selected':'' }}>Perempuan</option>
                    </select>
                </div>

                <div>
                    <label>Agama</label>
                    <input name="agama" value="{{ old('agama') }}"
                        class="w-full border px-3 py-2 rounded">
                </div>

                <div>
                    <label>Email Pendidik</label>
                    <input type="email" name="email_pendidik" value="{{ old('email_pendidik') }}"
                        class="w-full border px-3 py-2 rounded">
                </div>

                <div>
                    <label>No. Telepon</label>
                    <input name="no_tlp" value="{{ old('no_tlp') }}"
                        class="w-full border px-3 py-2 rounded">
                </div>

                <div>
                    <label>Honor per SKS</label>
                    <input type="number" name="rate_gaji" value="{{ old('rate_gaji') }}"
                        class="w-full border px-3 py-2 rounded">
                </div>
            </div>
        </div>

        <div class="mt-6 flex flex-wrap gap-3">
            <button class="bg-blue-600 text-white px-4 py-2 rounded text-sm font-semibold">
                Simpan Data
            </button>

            <a href="{{ route('admin.users.index') }}"
                class="bg-gray-500 text-white px-4 py-2 rounded text-sm font-semibold text-center">
                Kembali
            </a>
        </div>
    </form>
</div>

<script>
const role = document.getElementById('role');
const pendidikForm = document.getElementById('form-pendidik');

role.addEventListener('change', () => {
    pendidikForm.classList.toggle('hidden', role.value !== 'pendidik');
});
</script>

@endsection
