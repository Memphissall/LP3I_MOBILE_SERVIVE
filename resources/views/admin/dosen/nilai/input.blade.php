@extends('layouts.app')

@section('content')
<div class="container my-5">

{{-- POPUP SUCCESS --}}
@if(session('success'))
<script>
    Swal.fire({
        icon: 'success',
        title: 'Berhasil!',
        text: '{{ session('success') }}',
        timer: 2000,
        showConfirmButton: false
    });
</script>
@endif

{{-- JIKA SEMUA MAHASISWA SUDAH DINILAI --}}
@if($mahasiswa->isEmpty())
    <div class="alert alert-success text-center shadow-sm rounded-4 py-4">
        <h5 class="mb-0">✅ Semua mahasiswa pada kelas ini sudah memiliki nilai</h5>
    </div>

    <div class="text-center mt-4">
        <a href="{{ route('nilai.index') }}" class="btn-back">
            ⬅ Kembali ke Daftar Nilai
        </a>
    </div>
@endif

{{-- FORM --}}
@if(!$mahasiswa->isEmpty())
<form method="POST" action="{{ route('nilai.store') }}">
@csrf

<input type="hidden" name="id_kelas" value="{{ $id_kelas }}">
<input type="hidden" name="kode_mk" value="{{ $kode_mk }}">
<input type="hidden" name="semester" value="{{ $semester }}">

<div class="card nilai-card border-0 shadow-sm">

    {{-- HEADER --}}
    <div class="nilai-header">
        <h5 class="fw-bold mb-1">📝 Input Nilai Mahasiswa</h5>
        <p class="mb-0 opacity-75">Silakan isi nilai untuk mahasiswa yang belum terdata</p>
    </div>

    {{-- TABLE --}}
    <div class="table-responsive">
        <table class="table nilai-table align-middle mb-0">
            <thead>
                <tr>
                    <th class="text-start ps-4">Nama Mahasiswa</th>
                    <th width="10%">Kehadiran</th>
                    <th width="10%">Sikap</th>
                    <th width="10%">Formatif</th>
                    <th width="10%">Tugas</th>
                    <th width="10%">UTS</th>
                    <th width="10%">UAS</th>
                </tr>
            </thead>
            <tbody>
            @foreach($mahasiswa as $mhs)
                <tr>
                    <td class="text-start ps-4 fw-medium text-dark">
                        {{ $mhs->nama }}
                        <input type="hidden" name="nipd[]" value="{{ $mhs->nipd }}">
                        <input type="hidden" name="nama_mhs[]" value="{{ $mhs->nama }}">
                    </td>

                    <td><input type="number" name="nilai_kehadiran[]" class="nilai-input" min="0" max="100" placeholder="0"></td>
                    <td><input type="number" name="nilai_sikap[]" class="nilai-input" min="0" max="100" placeholder="0"></td>
                    <td><input type="number" name="nilai_formatif[]" class="nilai-input" min="0" max="100" placeholder="0"></td>
                    <td><input type="number" name="nilai_tugas[]" class="nilai-input" min="0" max="100" placeholder="0"></td>
                    <td><input type="number" name="nilai_uts[]" class="nilai-input" min="0" max="100" placeholder="0"></td>
                    <td><input type="number" name="nilai_uas[]" class="nilai-input" min="0" max="100" placeholder="0"></td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>

    {{-- FOOTER --}}
    <div class="nilai-footer border-top">
        <a href="{{ route('nilai.index') }}" class="btn-back">
            ← Kembali
        </a>

        <button type="submit" class="btn-save">
            💾 Simpan Nilai
        </button>
    </div>

</div>
</form>
@endif

</div>

<style>
/* CARD & CONTAINER */
.nilai-card {
    border-radius: 15px;
    overflow: hidden;
}

/* HEADER */
.nilai-header {
    background: #2a5298; /* Biru solid sesuai gambar */
    color: #fff;
    padding: 25px 30px;
}

/* TABLE STYLING */
.nilai-table thead th {
    background-color: #fcfcfc;
    color: #495057;
    font-size: 0.85rem;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    padding: 15px 10px;
    border-bottom: 2px solid #f1f3f5;
    text-align: center;
}

.nilai-table tbody td {
    padding: 12px 10px;
    border-bottom: 1px solid #f8f9fa;
    text-align: center;
}

.nilai-table tbody tr:hover {
    background-color: #f8faff;
}

/* INPUT STYLING */
.nilai-input {
    width: 100%;
    max-width: 70px;
    height: 40px;
    border-radius: 10px;
    border: 1px solid #dee2e6;
    text-align: center;
    font-size: 0.9rem;
    transition: all 0.2s;
    background-color: #fff;
    display: inline-block;
}

.nilai-input:focus {
    outline: none;
    border-color: #2a5298;
    box-shadow: 0 0 0 3px rgba(42, 82, 152, 0.1);
    background-color: #fff;
}

/* Chrome, Safari, Edge, Opera: Hapus arrow spinner */
.nilai-input::-webkit-outer-spin-button,
.nilai-input::-webkit-inner-spin-button {
  -webkit-appearance: none;
  margin: 0;
}

/* FOOTER */
.nilai-footer {
    background: #ffffff;
    padding: 20px 30px;
    display: flex;
    justify-content: space-between;
    align-items: center;
}

/* BUTTONS */
.btn-back {
    padding: 10px 25px;
    border-radius: 30px;
    border: 1px solid #dee2e6;
    background: #fff;
    color: #6c757d;
    font-weight: 500;
    text-decoration: none;
    transition: all 0.2s;
    font-size: 0.9rem;
}

.btn-back:hover {
    background: #f8f9fa;
    color: #343a40;
}

.btn-save {
    padding: 10px 35px;
    border-radius: 30px;
    background: #4671ea; /* Biru cerah sesuai tombol gambar */
    color: #fff;
    font-weight: 600;
    border: none;
    box-shadow: 0 4px 12px rgba(70, 113, 234, 0.2);
    transition: all 0.2s;
}

.btn-save:hover {
    background: #365bc7;
    transform: translateY(-1px);
    box-shadow: 0 6px 15px rgba(70, 113, 234, 0.3);
}
</style>
@endsection