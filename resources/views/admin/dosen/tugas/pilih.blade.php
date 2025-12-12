@extends('layouts.app')

@section('content')
<div class="p-6 max-w-xl mx-auto">

    <div class="bg-white shadow rounded-lg p-6">
        <h1 class="text-xl mb-4 font-bold text-gray-700">Pilih Kelas & Mata Kuliah</h1>

        <form action="{{ route('tugas.filter') }}" method="POST">
            @csrf

            {{-- PILIH KELAS --}}
            <label class="font-semibold text-gray-700">Pilih Kelas</label>
            <select name="id_kelas" id="kelasSelect" required 
                class="w-full border p-2 mb-4 rounded">
                <option value="">-- Pilih Kelas --</option>
                @foreach($kelas as $k)
                    <option value="{{ $k->id_kelas }}">{{ $k->nama_kelas }}</option>
                @endforeach
            </select>

            {{-- PILIH MATA KULIAH --}}
            <label class="font-semibold text-gray-700">Pilih Mata Kuliah</label>
            <select name="kode_mk" id="matkulSelect" required 
                class="w-full border p-2 mb-4 rounded">
                <option value="">-- Pilih Mata Kuliah --</option>
            </select>

            <div class="flex justify-between mt-4">
                <a href="{{ url()->previous() }}"
                    class="bg-gray-500 text-white px-4 py-2 rounded">
                    Kembali
                </a>

                <button type="submit" 
                    class="bg-blue-600 text-white px-4 py-2 rounded">
                    Submit
                </button>
            </div>

        </form>
    </div>
</div>

{{-- SCRIPT AJAX --}}
<script>
    document.getElementById('kelasSelect').addEventListener('change', function() {
        let kelasId = this.value;

        fetch('/get-matkul/' + kelasId)
            .then(response => response.json())
            .then(data => {
                let matkulSelect = document.getElementById('matkulSelect');
                matkulSelect.innerHTML = '<option value="">-- Pilih Mata Kuliah --</option>';

                data.forEach(function(mk) {
                    matkulSelect.innerHTML += 
                        `<option value="${mk.kode_mk}">${mk.nama_mk}</option>`;
                });
            });
    });
</script>
@endsection
