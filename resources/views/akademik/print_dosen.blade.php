<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cetak Data Dosen</title>
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

    <h2>Laporan Data Dosen</h2>
    
    <div class="header-info">
        <p>Tanggal Cetak: {{ date('d-m-Y') }}</p>
    </div>

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>NIDN</th>
                <th>Nama Dosen</th>
                <th>Pendidikan</th>
                <th>Bidang Keahlian</th>
                <th>Email</th>
                <th>No. Telepon</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach($dosens as $index => $dosen)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $dosen->nidn }}</td>
                <td>{{ $dosen->nama_dosen }}</td>
                <td>{{ $dosen->pendidikan }}</td>
                <td>{{ $dosen->bidang }}</td>
                <td>{{ $dosen->email }}</td>
                <td>{{ $dosen->no_telp }}</td>
                <td>{{ ucfirst($dosen->status) }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

</body>
</html>
