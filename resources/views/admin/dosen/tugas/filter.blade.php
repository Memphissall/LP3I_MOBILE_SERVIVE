<form action="{{ route('tugas.filter') }}" method="POST">
    @csrf

    <label>Pilih Kelas</label>
    <select name="id_kelas" required>
        @foreach($kelas as $k)
            <option value="{{ $k->id }}">{{ $k->nama_kelas }}</option>
        @endforeach
    </select>

    <label>Pilih Mata Kuliah</label>
    <select name="kode_mk" required>
        @foreach($matkul as $mk)
            <option value="{{ $mk->kode_mk }}">{{ $mk->nama_mk }}</option>
        @endforeach
    </select>

    <button type="submit">Lihat Tugas</button>
</form>
