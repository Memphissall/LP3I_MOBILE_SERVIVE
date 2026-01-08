<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cetak Laporan Mahasiswa - LP3I</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap');

        body {
            font-family: 'Poppins', sans-serif;
            margin:0px;
            padding: 0;
            color: #333;
            background-color: white;
        }

        .print-container {
            padding: 0.4cm 1.5cm;
        }

        .kop-surat {
            text-align: center;
            padding-bottom: 3px;
            border-bottom: 1px solid #000; 
            margin-bottom: 8px;
            position: relative;
            min-height: 70px;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        .kop-surat::after {
            content: "";
            display: block;
            position: absolute;
            bottom: 2px;
            left: 0;
            right: 0;
            border-bottom: 3px solid #000;
        }

        .kop-text h1 { margin: 0; font-size: 24px; text-transform: uppercase; color: #000066; }
        .kop-text p { margin: 1.5px 0 0; font-size: 11px; font-style: italic; color: #555; padding-bottom: 2px; }
        
        /* REVISI: Logo sekarang mengunci ke pojok kiri kop-surat */
        .kop-text img { 
            position: absolute; 
            left: 0; 
            top: 48px; 
            transform: translateY(-50%); 
            width: 48px; 
            height: auto; 
            padding: 0; 
            margin: 0;
        }

        .judul-laporan {
            text-align: center;
            text-transform: uppercase;
            margin-top: 5px; 
            margin-bottom: 3px;
            font-size: 15px;
            font-weight: bold;
        }

        .info-cetak {
            text-align: right;
            font-size: 10px;
            margin-bottom: 4px;
            color: #666;
        }

        /* Updated CSS for Compactness and Pagination */
        table {
            width: 100%;
            border-collapse: collapse;
            table-layout: fixed;
            border-bottom: 1px solid #444; /* Changed to 1px to match */
        }
        
        th, td {
            border: 1px solid #444;
            padding: 2px 3px;
            font-size: 9pt;
            line-height: 1.15;
            text-align: center;
            word-wrap: break-word;
        }

        th {
            background-color: #E6F0FF !important; 
            color: #000066 !important;
            text-transform: uppercase;
            font-weight: bold;
            -webkit-print-color-adjust: exact; 
        }

        /* Repeating Header on New Pages - DISABLED STRICTLY */
        @media print {
            @page { margin: 10mm; size: landscape; }
            thead { display: table-row-group; } /* FORCE it to be a normal row, preventing repeat */
            tr { page-break-inside: avoid; }
        }

        .signature-container {
            margin-top: 8px; 
            float: right; 
            width: 280px; 
            text-align: center;
            page-break-inside: avoid;
        }

        .signature-wrapper {
            display: flex;
            align-items: flex-end;
            justify-content: center;
            margin-top: 30px; 
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

        .signature-role { font-size: 11px; font-weight: bold; margin-top: 0; }
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

        <div class="info-cetak" id="waktu-cetak">Dicetak pada: Memuat waktu...</div>

        <h3 class="judul-laporan">LAPORAN DATA MAHASISWA</h3>

        @php
            $perPage = 12;
            $chunks = $mahasiswa->chunk($perPage);
            $totalChunks = $chunks->count();
        @endphp

        @foreach($chunks as $chunkIndex => $chunk)
            @if($chunkIndex > 0)
                <div style="page-break-before: always;"></div>
            @endif

            <table>
                {{-- Column widths definition for consistent layout --}}
                <colgroup>
                    <col style="width: 35px;">
                    <col style="width: 85px;">
                    <col style="width: 140px;">
                    <col style="width: 120px;">
                    <col style="width: 100px;">
                    <col style="width: 150px;">
                    <col style="width: 90px;">
                    <col style="width: 170px;">
                </colgroup>
                
                @if($chunkIndex === 0)
                {{-- Header only on first page --}}
                <thead>
                    <tr>
                        <th>NO</th>
                        <th>NIPD</th>
                        <th>NAMA MAHASISWA</th>
                        <th>TEMPAT LAHIR</th>
                        <th>TANGGAL LAHIR</th>
                        <th>ALAMAT</th>
                        <th>NO TELP</th>
                        <th>EMAIL</th>
                    </tr>
                </thead>
                @endif
                <tbody>
                    @foreach($chunk->values() as $index => $mhs)
                    <tr>
                        <td>{{ ($chunkIndex * $perPage) + $index + 1 }}</td>
                        <td><b>{{ $mhs->nipd }}</b></td>
                        <td style="text-align: left;">{{ $mhs->nama }}</td>
                        <td>{{ $mhs->tempat_lahir }}</td>
                        <td>{{ $mhs->tgl_lahir }}</td>
                        <td>{{ $mhs->alamat }}</td>
                        <td>{{ $mhs->no_tlp }}</td>
                        <td>{{ $mhs->email }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>

            @if($chunkIndex === $totalChunks - 1)
                {{-- Signature only on last page --}}
                <div class="signature-container">
                    <p id="tanggal-ttd">Karawang, ...</p>
                    <p>Staf Akademik,</p>
                    <div class="signature-wrapper">
                        <span>(</span><div class="line-inside"></div><span>)</span>
                    </div>
                    <p class="signature-role">LP3I College Karawang</p>
                </div>
                <div style="clear: both;"></div>
            @endif
        @endforeach

        @if(count($mahasiswa) == 0)
            <table>
                <thead>
                    <tr>
                        <th width="35">NO</th>
                        <th width="85">NIPD</th>
                        <th width="140">NAMA MAHASISWA</th>
                        <th width="120">TEMPAT LAHIR</th>
                        <th width="100">TANGGAL LAHIR</th>
                        <th width="150">ALAMAT</th>
                        <th width="90">NO TELP</th>
                        <th width="170">EMAIL</th>
                    </tr>
                </thead>
                <tbody>
                    <tr><td colspan="8" style="padding: 15px;">Data tidak ditemukan.</td></tr>
                </tbody>
            </table>
        @endif
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