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
            line-height: 1.2;
        }

        .print-container {
            padding: 0.2cm 1cm;
        }

        /* --- KOP SURAT --- */
        .kop-surat {
            text-align: center;
            padding-bottom: 5px; 
            margin-bottom: 0; /* Kita atur jarak lewat garis pemisah */
        }

        /* --- TRICK GARIS GANDA PISAH (TEBAL ATAS, TIPIS BAWAH) --- */
        .line-bold {
            border-bottom: 4px solid #000;
            width: 100%;
            margin-bottom: 2px; /* Jarak celah putih antar garis */
        }

        .line-thin {
            border-bottom: 1.5px solid #000;
            width: 100%;
            margin-bottom: 15px; /* Jarak ke judul laporan */
        }

        .kop-text h1 { 
            margin: 0; 
            font-size: 24px; 
            text-transform: uppercase; 
            color: #000066; 
            line-height: 1.1;
        }

        .kop-text p { 
            margin: 2px 0 0; 
            font-size: 11px; 
            font-style: italic; 
            color: #555;
        }

         /* REVISI: Logo sekarang mengunci ke pojok kiri kop-surat */
        .kop-text img { 
            position: absolute; 
            left: 40px; 
            top: 55px; 
            transform: translateY(-50%); 
            width: 50px; 
            height: auto; 
            padding: 0; 
            margin: 0;
        }

        /* --- JUDUL & INFO --- */
        .judul-laporan {
            text-align: center;
            text-transform: uppercase;
            margin: 10px 0 5px 0; 
            font-size: 16px;
            font-weight: bold;
        }

        .info-cetak {
            text-align: right;
            font-size: 9px;
            margin-bottom: 5px;
            color: #666;
        }

        /* --- TABEL --- */
        table {
            width: 100%;
            border-collapse: collapse;
            table-layout: fixed;
        }
        
        th, td {
            border: 1px solid #444;
            padding: 6px 8px;
            font-size: 11px;
            text-align: center;
        }

        th { 
            background-color: #E6F0FF !important; 
            color: #000066 !important; 
            -webkit-print-color-adjust: exact;
        }

        /* --- LOGIKA 5 DATA IKUT TTD --- */
        .keep-together {
            page-break-inside: avoid !important;
            break-inside: avoid !important;
            display: block;
            width: 100%;
        }

        .signature-container {
            margin-top: 25px;
            float: right; 
            width: 250px; 
            text-align: center;
        }

        .signature-wrapper {
            display: flex;
            align-items: flex-end;
            justify-content: center;
            margin-top: 45px; 
            margin-bottom: 2px;
            font-weight: bold;
            font-size: 14px;
        }

        .line-inside {
            border-bottom: 1.5px solid #000;
            width: 200px; 
            margin: 0 5px;
            height: 12px;
        }

        .signature-role { font-size: 11px; font-weight: bold; }

        @media print {
            @page { 
                margin: 0.5cm 0.8cm; 
                size: landscape; 
            }
            thead { display: table-header-group; }
        }
    </style>
</head>
<body>

    <div class="print-container">
        <div class="kop-surat">
            <div class="kop-text">
                <img src="{{ asset('images/lp3i_krw.png') }}" alt="logo LP3I"> 
                <h1>LP3I COLLEGE KARAWANG</h1>
                <p>Gedung Karawang Hijau, Ruko Karawang Hijau, Jl. Tarumanagara No.4-6, Desa Purwadana</p>
                <p>Kecamatan Telukjambe Timur, Kabupaten Karawang, Jawa Barat 41361</p>
                <p>Telp: (0267) 411286 | Website: www.lp3i.ac.id | Email: info@lp3i.id</p>
            </div>
        </div>
        
        <div class="line-bold"></div>
        <div class="line-thin"></div>

        <div class="info-cetak" id="waktu-cetak">Memuat waktu...</div>

        <h3 class="judul-laporan">LAPORAN DATA DOSEN</h3>

        @php
            $totalData = count($dosens);
            $limitAwal = $totalData - 5; 
        @endphp

        <table>
            <thead>
                <tr>
                    <th width="35">No</th>
                    <th width="120">NIDN / NIP</th>
                    <th width="180">Nama Dosen</th>
                    <th width="150">Pendidikan</th>
                    <th width="120">No. Telepon</th>
                    <th width="100">Status</th>
                </tr>
            </thead>
            <tbody>
                @foreach($dosens as $index => $d)
                    @if($index < $limitAwal)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td><b>{{ $d->nidn }}</b></td>
                        <td style="text-align: left; padding-left: 10px;">{{ $d->nama_dosen }}</td>
                        <td style="text-align: left;">{{ $d->pendidikan }}</td>
                        <td>{{ $d->no_telp }}</td>
                        <td style="text-transform: capitalize;">{{ $d->status }}</td>
                    </tr>
                    @endif
                @endforeach
            </tbody>
        </table>

        <div class="keep-together">
            <table style="margin-top: -1px;">
                <tbody>
                    @foreach($dosens as $index => $d)
                        @if($index >= $limitAwal)
                        <tr>
                            <td width="35">{{ $index + 1 }}</td>
                            <td width="120"><b>{{ $d->nidn }}</b></td>
                            <td width="180" style="text-align: left; padding-left: 10px;">{{ $d->nama_dosen }}</td>
                            <td width="150" style="text-align: left;">{{ $d->pendidikan }}</td>
                            <td width="120">{{ $d->no_telp }}</td>
                            <td width="100" style="text-transform: capitalize;">{{ $d->status }}</td>
                        </tr>
                        @endif
                    @endforeach
                </tbody>
            </table>

            <div class="signature-container">
                <p id="tanggal-ttd">Karawang, ...</p>
                <p>Staf Akademik,</p>
                <div class="signature-wrapper">
                    <span>(</span><div class="line-inside"></div><span>)</span>
                </div>
                <p class="signature-role">LP3I College Karawang</p>
            </div>
            <div style="clear: both;"></div>
        </div>
    </div>

    <script type="text/javascript">
        function updateTime() {
            const now = new Date();
            const optionsDate = { day: '2-digit', month: 'long', year: 'numeric' };
            const optionsTime = { hour: '2-digit', minute: '2-digit' };
            document.getElementById('waktu-cetak').innerHTML = `Dicetak pada: ${now.toLocaleDateString('id-ID', optionsDate)}, ${now.toLocaleTimeString('id-ID', optionsTime)} WIB`;
            document.getElementById('tanggal-ttd').innerHTML = `Karawang, ${now.toLocaleDateString('id-ID', optionsDate)}`;
        }
        window.onload = function() { updateTime(); setTimeout(() => window.print(), 800); }
    </script>
</body>
</html>