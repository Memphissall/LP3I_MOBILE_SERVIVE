<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cetak Jadwal Kuliah</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 11px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th, td {
            border: 1px solid black;
            padding: 6px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
        h2 {
            text-align: center;
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

    <h2>Laporan Jadwal Kuliah</h2>
    <p>Tanggal Cetak: {{ date('d-m-Y') }}</p>

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Hari</th>
                <th>Waktu</th>
                <th>Mata Kuliah</th>
                <th>Kelas</th>
                <th>Ruangan</th>
            </tr>
        </thead>
        <tbody>
            @foreach($jadwal as $index => $j)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $j->hari }}</td>
                <td>{{ $j->waktu }}</td>
                <td>{{ $j->mataKuliah->nama_mk ?? '-' }}</td>
                <td>{{ $j->kelas->nama_kelas ?? '-' }}</td>
                <td>{{ $j->ruangan->nama_ruangan ?? '-' }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

</body>
</html>
