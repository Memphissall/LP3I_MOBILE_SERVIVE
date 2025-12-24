<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cetak Laporan Mahasiswa - LP3I</title>
    <style>
        body {
            font-family: 'Poppins';
            margin: 1.5cm;
            padding: 40px;
            color: #333;
        }

        .kop-surat {
            display: flex;
            align-items: center;
            justify-content: center;
            border-bottom: 3px solid #000080; 
            padding-bottom: 15px;
            margin-bottom: 20px;
        }
        .kop-text {
            text-align: center;
        }
        .kop-text h1 {
            margin: 0;
            font-size: 26px;
            text-transform: uppercase;
            color: #000066; 
            letter-spacing: 1px;
        }
        .kop-text p {
            margin: 5px 0 0;
            font-size: 13px;
            font-style: italic;
            color: #555;
        }

        .judul-laporan {
            text-align: center;
            text-transform: uppercase;
            margin-top: 25px;
            margin-bottom: 10px;
            font-size: 18px;
            font-weight: bold;
            color: #333;
        }

        .info-cetak {
            text-align: right;
            font-size: 11px;
            margin-bottom: 10px;
            color: #666;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }
        th, td {
            border: 1px solid #444;
            padding: 10px 8px;
            font-size: 12px;
            text-align: center;
        }
        th {
            background-color: #E6F0FF; 
            color: #000066;
            text-transform: uppercase;
            text-align: center;
            font-weight: bold;
        }
        .text-center { text-align: center; }
        
        tbody tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        @media print {
            @page {
                margin: 0;
            }
            th {
                background-color: #E6F0FF !important; 
                -webkit-print-color-adjust: exact;
                print-color-adjust: exact;
            }
            .no-print { display: none; }
        }
    </style>
</head>
<body>

    <div class="kop-surat">
        <div class="kop-text">
            <h1>LP3I COLLEGE KARAWANG</h1>
            <p>Jl. Arteri Galuh Mas, Telukjambe Timur, Karawang, Jawa Barat</p>
            <p>Telp: (0267) 840xxxx | Website: www.lp3i.ac.id | Email: info@karawang.lp3i.ac.id</p>
        </div>
    </div>

    <div class="info-cetak" id="waktu-cetak">
        Dicetak pada: Memuat waktu...
    </div>

    <h3 class="judul-laporan">LAPORAN DATA MAHASISWA</h3>

    <table>
        <thead>
            <tr>
                <th width="20">No</th>
                <th width="90">NIM / NIPD</th>
                <th width="100">Nama Mahasiswa</th>
                <th width="100">Jurusan</th>
                <th width="70">Angkatan</th>
                <th width="70">Kelas</th>
                <th width="100">Pembimbing Akademik</th>
            </tr>
        </thead>
        <tbody>
            @forelse($mahasiswa as $index => $student)
            <tr>
                <td class="text-center">{{ $index + 1 }}</td>
                <td class="text-center"><b>{{ $student->nipd }}</b></td>
                <td>{{ $student->nama }}</td>
                <td>{{ $student->jurusan }}</td>
                <td class="text-center">{{ $student->angkatan }}</td>
                <td class="text-center">
                    {{ $student->data_kelas->nama_kelas ?? '-' }}
                </td>
                <td>
                    {{ $student->data_kelas->nama_pa ?? '-' }}
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="7" class="text-center" style="padding: 20px;">Data tidak ditemukan.</td>
            </tr>
            @endforelse
        </tbody>
    </table>

    <div style="margin-top: 40px; float: right; text-align: center; width: 250px;">
        <p id="tanggal-ttd">Karawang, ...</p>
        <p style="margin-bottom: 60px;">Staf Akademik,</p>
        
        <p><b>( ____________________ )</b></p>
        <p style="font-size: 11px;">LP3I College Karawang</p>
    </div>

    <script type="text/javascript">
        function updateTime() {
            const now = new Date();
            const optionsDate = { day: '2-digit', month: 'long', year: 'numeric' };
            const optionsTime = { hour: '2-digit', minute: '2-digit', second: '2-digit' };
            
            const tanggalIndo = now.toLocaleDateString('id-ID', optionsDate);
            const waktuIndo = now.toLocaleTimeString('id-ID', optionsTime);

            // Update Info Cetak (Atas)
            document.getElementById('waktu-cetak').innerHTML = `Dicetak pada: ${tanggalIndo}, ${waktuIndo} WIB`;
            
            // Update Tanggal Tanda Tangan (Bawah)
            document.getElementById('tanggal-ttd').innerHTML = `Karawang, ${tanggalIndo}`;
        }

        window.onload = function() {
            updateTime(); // Jalankan fungsi waktu tepat sebelum jendela print muncul
            
            setTimeout(function() {
                window.print();
            }, 800); 
        }
    </script>
</body>
</html>