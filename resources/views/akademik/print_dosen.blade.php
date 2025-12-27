<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cetak Laporan Dosen - LP3I</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap');

        body {
            font-family: 'Poppins', sans-serif;
            margin: 0;
            padding: 0;
            color: #333;
            background-color: white;
        }

        .print-container {
            padding: 1cm 1.5cm; /* Diperkecil agar lebih efisien */
        }

        /* KOP SURAT */
        .kop-surat {
            display: flex;
            align-items: center;
            justify-content: center;
            border-bottom: 3px solid #000080; 
            padding-bottom: 10px; /* Rapat sedikit */
            margin-bottom: 10px;
        }
        .kop-text { text-align: center; }
        .kop-text h1 { margin: 0; font-size: 26px; text-transform: uppercase; color: #000066; letter-spacing: 1px; }
        .kop-text p { margin: 2px 0 0; font-size: 13px; font-style: italic; color: #555; }

        .judul-laporan {
            text-align: center;
            text-transform: uppercase;
            margin-top: 15px; /* Lebih naik */
            margin-bottom: 8px;
            font-size: 18px;
            font-weight: bold;
        }

        .info-cetak {
            text-align: right;
            font-size: 11px;
            margin-bottom: 5px;
            color: #666;
        }

        /* TABEL SETTINGS */
        table {
            width: 100%;
            border-collapse: collapse;
            table-layout: fixed;
        }
        
        th, td {
            border: 1px solid #444;
            padding: 6px 8px; /* DIET: Lebih tipis agar muat banyak */
            font-size: 12px;
            text-align: center;
            word-wrap: break-word;
        }

        th {
            background-color: #E6F0FF !important; 
            color: #000066 !important;
            text-transform: uppercase;
            font-weight: bold;
            -webkit-print-color-adjust: exact; 
            print-color-adjust: exact;
        }

        /* TANDA TANGAN */
        .signature-container {
            margin-top: 20px; /* Jarak atas dikurangi */
            float: right; 
            width: 350px; 
            text-align: center;
            page-break-inside: avoid;
        }

        .signature-wrapper {
            display: flex;
            align-items: flex-end;
            justify-content: center;
            margin-top: 60px; /* DIET: Jarak tanda tangan diperpendek */
            margin-bottom: 5px;
            font-weight: bold;
            font-size: 18px;
        }

        .line-inside {
            border-bottom: 1.5px solid #000;
            width: 250px; 
            margin: 0 5px;
            height: 14px;
        }

        .signature-role {
            font-size: 14px;
            font-weight: bold;
            margin-top: 0;
        }

        @media print {
            @page {
                margin: 0.5cm 1.5cm; 
                size: landscape;
            }

            thead {
                display: table-header-group; 
            }

            th {
                background-color: #E6F0FF !important;
                -webkit-print-color-adjust: exact;
                print-color-adjust: exact;
            }
        }
    </style>
</head>
<body>

    <div class="print-container">
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

        <h3 class="judul-laporan">LAPORAN DATA DOSEN</h3>

        <table>
            <thead>
                <tr>
                    <th width="40">No</th>
                    <th width="120">NIDN / NIP</th>
                    <th width="80">Nama Dosen</th>
                    <th width="100">Pendidikan</th>
                    <th width="150">No. Telepon</th>
                    <th width="100">Status</th>
                </tr>
            </thead>
            <tbody>
                @forelse($dosens as $index => $d)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td><b>{{ $d->nidn }}</b></td>
                    <td style="text-align: left; padding-left: 15px;">{{ $d->nama_dosen }}</td>
                    <td>{{ $d->pendidikan }}</td>
                    <td>{{ $d->no_telp }}</td>
                    <td style="text-transform: capitalize;">{{ $d->status }}</td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" style="padding: 20px;">Data dosen tidak ditemukan.</td>
                </tr>
                @endforelse
            </tbody>
        </table>

        <div class="signature-container">
            <p id="tanggal-ttd">Karawang, ...</p>
            <p>Staf Akademik,</p>
            
            <div class="signature-wrapper">
                <span>(</span>
                <div class="line-inside"></div>
                <span>)</span>
            </div>
            
            <p class="signature-role">LP3I College Karawang</p>
        </div>

        <div style="clear: both;"></div>
    </div>

    <script type="text/javascript">
        function updateTime() {
            const now = new Date();
            const optionsDate = { day: '2-digit', month: 'long', year: 'numeric' };
            const optionsTime = { hour: '2-digit', minute: '2-digit'};
            
            const tanggalIndo = now.toLocaleDateString('id-ID', optionsDate);
            const waktuIndo = now.toLocaleTimeString('id-ID', optionsTime);

            document.getElementById('waktu-cetak').innerHTML = `Dicetak pada: ${tanggalIndo}, ${waktuIndo} WIB`;
            document.getElementById('tanggal-ttd').innerHTML = `Karawang, ${tanggalIndo}`;
        }

        window.onload = function() {
            updateTime();
            setTimeout(function() {
                window.print();
            }, 800); 
        }
    </script>
</body>
</html>