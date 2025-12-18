<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cetak Data Mahasiswa</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th, td {
            border: 1px solid black;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
        h2 {
            text-align: center;
        }
        .header-info {
            margin-bottom: 20px;
        }
        @media print {
            .no-print {
                display: none;
            }
        }
    </style>
    <script type="text/javascript">
        window.onload = function() {
            window.print();
        }
    </script>
</head>
<body>

    <h2>Laporan Data Mahasiswa</h2>
    
    <div class="header-info">
        <p>Tanggal Cetak: {{ date('d-m-Y') }}</p>
    </div>

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>NIM</th>
                <th>Nama Mahasiswa</th>
                <th>Jurusan</th>
                <th>Angkatan</th>
                <th>Kelas</th>
                <th>Pembimbing Akademik</th>
            </tr>
        </thead>
        <tbody>
            @foreach($students as $index => $student)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $student->nipd }}</td>
                <td>{{ $student->nama }}</td>
                <td>{{ $student->jurusan }}</td>
                <td>{{ $student->angkatan }}</td>
                <td>
                    @if($student->dataKelas)
                        {{ $student->dataKelas->nama_kelas }} ({{ $student->dataKelas->kode_mk }})
                    @else
                        -
                    @endif
                </td>
                <td>
                    @if($student->dataKelas)
                        {{ $student->dataKelas->nama_pa }}
                    @else
                        -
                    @endif
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

</body>
</html>
