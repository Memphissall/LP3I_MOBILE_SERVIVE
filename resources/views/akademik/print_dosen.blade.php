<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cetak Laporan Dosen - LP3I</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap');

        * {
            box-sizing: border-box;
        }

        body {
            font-family: 'Poppins', sans-serif;
            margin: 0;
            padding: 0;
            color: #333;
            background-color: white;
            line-height: 1.2;
        }

        @page {
            margin: 10mm;
            size: landscape;
        }

        .print-container {
            padding: 0;
            width: 100%;
        }

        /* --- KOP SURAT --- */
        .kop-surat {
            text-align: center;
            padding-bottom: 5px;
            margin-bottom: 0;
        }

        /* --- TRICK GARIS GANDA PISAH (TEBAL ATAS, TIPIS BAWAH) --- */
        .line-bold {
            border-bottom: 4px solid #000;
            width: 100%;
            margin-bottom: 2px;
            /* Jarak celah putih antar garis */
        }

        .line-thin {
            border-bottom: 1.5px solid #000;
            width: 100%;
            margin-bottom: 15px;
            /* Jarak ke judul laporan */
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
            top: 35px;
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
            text-align: center;
            font-size: 9px;
            margin-bottom: 5px;
            color: #666;
        }

        /* Updated CSS for Compactness and Pagination */
        table {
            width: 100%;
            /* Changed from 99% to 100% to match */
            margin: 0 auto;
            border-collapse: collapse;
            table-layout: fixed;
            border-bottom: 1px solid #444;
            /* Changed to 1px to match */
        }

        th,
        td {
            border: 1px solid #444;
            padding: 3px 4px;
            /* Reduced padding */
            font-size: 10px;
            /* Reduced font */
            text-align: center;
            word-wrap: break-word;
            overflow-wrap: break-word;
        }

        th {
            background-color: #E6F0FF !important;
            color: #000066 !important;
            -webkit-print-color-adjust: exact;
        }

        /* --- LOGIKA 5 DATA IKUT TTD --- */
        /* REMOVED split logic, just flow naturally */

        .signature-container {
            margin-top: 25px;
            float: right;
            width: 250px;
            text-align: center;
            page-break-inside: avoid;
            /* Keep signature block together */
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

        .signature-role {
            font-size: 11px;
            font-weight: bold;
        }

        @media print {
            @page {
                margin: 10mm;
                /* Increased margin for safety on page 2 */
                size: landscape;
            }

            thead {
                display: table-row-group;
            }

            /* PREVENT header repetition (treat as normal row) */
            tr {
                page-break-inside: avoid;
            }
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

        <h3 class="judul-laporan">LAPORAN DATA PENDIDIK</h3>

        @php
            $perPage = 12;
            $chunks = $dosens->chunk($perPage);
            $totalChunks = $chunks->count();
        @endphp

        @foreach($chunks as $chunkIndex => $chunk)
            @if($chunkIndex > 0)
                <div style="page-break-before: always;"></div>
            @endif

            <table>
                {{-- Column widths definition for consistent layout --}}
                <colgroup>
                    <col style="width: 3%;">
                    <col style="width: 10%;">
                    <col style="width: 18%;">
                    <col style="width: 12%;">
                    <col style="width: 10%;">
                    <col style="width: 16%;">
                    <col style="width: 12%;">
                    <col style="width: 10%;">
                    <col style="width: 10%;">
                </colgroup>

                @if($chunkIndex === 0)
                    {{-- Header only on first page --}}
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>ID Pendidik</th>
                            <th>Nama Pendidik</th>
                            <th>Tempat Lahir</th>
                            <th>Tgl Lahir</th>
                            <th>Alamat</th>
                            <th>Pendidikan</th>
                            <th>No. Telp</th>
                            <th>Email</th>
                        </tr>
                    </thead>
                @endif
                <tbody>
                    @foreach($chunk->values() as $index => $d)
                        <tr>
                            <td>{{ ($chunkIndex * $perPage) + $index + 1 }}</td>
                            <td style="font-size: 9px;"><b>{{ $d->nidn }}</b></td>
                            <td style="text-align: left; padding-left: 5px;">{{ $d->nama_dosen }}</td>
                            <td style="text-align: left; font-size: 9px;">{{ $d->tempat ?? '-' }}</td>
                            <td style="text-align: center; font-size: 9px;">{{ $d->tanggal_lahir ? date('d/m/Y', strtotime($d->tanggal_lahir)) : '-' }}</td>
                            <td style="text-align: left; font-size: 9px;">{{ $d->alamat ?? '-' }}</td>
                            <td style="text-align: left;">{{ $d->pendidikan }}</td>
                            <td>{{ $d->no_telp }}</td>
                            <td style="text-align: left; font-size: 9px;">{{ $d->email }}</td>
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
                        <span>(</span>
                        <div class="line-inside"></div><span>)</span>
                    </div>
                    <p class="signature-role">LP3I College Karawang</p>
                </div>
                <div style="clear: both;"></div>
            @endif
        @endforeach
    </div>

    <script type="text/javascript">
        function updateTime() {
            const now = new Date();
            const optionsDate = { day: '2-digit', month: 'long', year: 'numeric' };
            const optionsTime = { hour: '2-digit', minute: '2-digit' };
            document.getElementById('waktu-cetak').innerHTML = `Dicetak pada: ${now.toLocaleDateString('id-ID', optionsDate)}, ${now.toLocaleTimeString('id-ID', optionsTime)} WIB`;
            document.getElementById('tanggal-ttd').innerHTML = `Karawang, ${now.toLocaleDateString('id-ID', optionsDate)}`;
        }
        window.onload = function () { updateTime(); setTimeout(() => window.print(), 800); }
    </script>
</body>

</html>