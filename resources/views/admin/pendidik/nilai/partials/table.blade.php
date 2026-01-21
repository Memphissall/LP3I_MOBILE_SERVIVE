@if($nilai->count())
<div class="card shadow mt-4">
    <div class="card-header bg-info text-white">
        <b>Daftar Nilai Mahasiswa</b>
    </div>

    <div class="card-body table-responsive">
        <table class="table table-bordered table-striped text-center align-middle">
            <thead class="table-secondary">
                <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>Kehadiran</th>
                    <th>Attitude</th>
                    <th>Formatif</th>
                    <th>Tugas</th>
                    <th>UTS</th>
                    <th>UAS</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($nilai as $i => $n)
                <tr>
                    <td>{{ $i+1 }}</td>
                    <td class="text-start">{{ $n->nama_mhs }}</td>
                    <td>{{ $n->nilai_kehadiran ?? '-' }}</td>
                    <td>{{ $n->nilai_atitude ?? '-' }}</td>
                    <td>{{ $n->nilai_formatif ?? '-' }}</td>
                    <td>{{ $n->nilai_tugas ?? '-' }}</td>
                    <td>{{ $n->nilai_uts ?? '-' }}</td>
                    <td>{{ $n->nilai_uas ?? '-' }}</td>
                    <td>
                        <a href="{{ route('nilai.edit', $n->id_nilai) }}"
                           class="btn btn-sm btn-warning">
                           Edit
                        </a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@else
<div class="alert alert-warning mt-4">
    Data nilai belum tersedia.
</div>
@endif
