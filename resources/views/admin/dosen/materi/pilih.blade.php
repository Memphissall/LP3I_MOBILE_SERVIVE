@extends('layouts.app')

@section('content')
<div class="max-w-3xl mx-auto bg-white p-6 rounded-xl shadow mt-10">

    <h2 class="text-xl font-semibold mb-6">
        Pilih Kelas & Mata Kuliah
    </h2>

    <div class="mb-4">
        <label class="block mb-1 font-medium">Kelas</label>
        <select id="kelas" class="w-full border rounded p-2">
            <option value="">-- Pilih Kelas --</option>
            @foreach($kelas as $k)
                <option value="{{ $k->id_kelas }}">
                    {{ $k->nama_kelas }}
                </option>
            @endforeach
        </select>
    </div>

    <div class="mb-6">
        <label class="block mb-1 font-medium">Materi Ajar</label>
        <select id="matkul" class="w-full border rounded p-2">
            <option value="">-- Pilih Materi Ajar --</option>
        </select>
    </div>

    <button id="btnLihat"
        class="bg-indigo-600 text-white px-4 py-2 rounded hover:bg-indigo-700">
        Lihat Materi
    </button>
</div>

<script>
document.getElementById('kelas').addEventListener('change', function () {
    fetch("{{ route('materi.getMatkul') }}", {
        method: "POST",
        headers: {
            "Content-Type": "application/json",
            "X-CSRF-TOKEN": "{{ csrf_token() }}"
        },
        body: JSON.stringify({
            id_kelas: this.value
        })
    })
    .then(res => res.json())
    .then(data => {
        let matkul = document.getElementById('matkul');
        matkul.innerHTML = '<option value="">-- Pilih Mata Kuliah --</option>';

        data.forEach(m => {
            matkul.innerHTML += `
                <option value="${m.kode_mk}">
                    ${m.nama_mk}
                </option>`;
        });
    });
});

document.getElementById('btnLihat').addEventListener('click', function () {
    let kelas = document.getElementById('kelas').value;
    let mk    = document.getElementById('matkul').value;

    if (!kelas || !mk) {
        alert('Pilih kelas dan mata kuliah dulu!');
        return;
    }

    window.location.href = `/materi/${kelas}/${mk}`;
});
</script>
@endsection
