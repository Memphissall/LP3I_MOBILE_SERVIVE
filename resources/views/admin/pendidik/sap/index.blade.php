@extends('layouts.app')

@section('content')

<style>
/* Tombol Unduh SAP custom */
.btn-unduh {
    background: linear-gradient(90deg, #0f3057, #145374);
    color: white;
    border-radius: 8px;
    border: none;
    padding: 10px 25px;
    font-weight: 600;
    font-size: 16px;
    transition: 0.3s ease;
    box-shadow: 0 4px 6px rgba(0,0,0,0.1);
}

.btn-unduh:hover {
    background: linear-gradient(90deg, #145374, #1b6ca8);
    transform: translateY(-2px);
    box-shadow: 0 6px 10px rgba(0,0,0,0.15);
}
</style>

<div class="container mt-4 d-flex justify-content-center">

    <div class="card border-0 shadow-sm"
         style="border-radius:20px; overflow:hidden; max-width:800px; width:100%;">

        <!-- Header Card -->
        <div style="
            background: linear-gradient(90deg, #0f3057, #145374);
            padding:18px 25px;
            color:white;
            font-weight:600;
            font-size:18px;
        ">
            SAP Mata Kuliah
        </div>

        <!-- Body Card -->
        <div class="p-4" style="background-color:#f4f6f9;">

            <div class="mb-3">
                <strong>Kelas :</strong> {{ $kelas->nama_kelas }} <br>
                <strong>Mata Kuliah :</strong> {{ $matkul->nama_mk }}
            </div>

            @if(session('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
            @endif

            <div class="text-center mt-4">
                <!-- Tombol Unduh SAP -->
                <a href="{{ route('pendidik.sap.download', $matkul->id_mk) }}"
                   class="btn btn-unduh">
                    Unduh SAP
                </a>
            </div>

        </div>

    </div>

</div>

@endsection
