<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>KHS - {{ $mahasiswa->nipd }}</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700;900&display=swap" rel="stylesheet">
    
    <style>
        @page { size: A4; margin: 0; }
        
        *, *::before, *::after { box-sizing: border-box; }
        
        body { 
            font-family: 'Roboto', Arial, sans-serif; 
            font-size: 9pt; 
            margin: 0; 
            padding: 0;
            background: #e0e0e0; /* Background luar abu-abu biar keliatan kertasnya */
            color: #333;
            -webkit-print-color-adjust: exact !important;
            print-color-adjust: exact !important;
        }

        /* === KERTAS A4 === */
        .paper-a4 {
            width: 210mm;
            min-height: 297mm;
            background: white;
            margin: 20px auto;
            padding: 10mm 15mm; 
            position: relative;
            overflow: hidden;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }

        /* HEADER / KOP */
        .kop-container {
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 5px;
            position: relative;
        }
        .kop-logo {
            width: 65px;
            position: absolute;
            left: 0;
            top: -20px;
        }
        .kop-text {
            text-align: center;
            width: 100%;
        }
        .kop-text h1 {
            font-size: 18pt;
            font-weight: 900;
            color: #004269; /* Warna Biru LP3I */
            margin: 0;
            text-transform: uppercase;
            letter-spacing: 1px;
        }
        .kop-text p {
            font-size: 8pt;
            margin: 2px 0 0 0;
            line-height: 1.3;
            color: #444;
        }

        /* GARIS TEBAL & TIPIS - SINGLE BOX TECHNIQUE (GUARANTEED ALIGNMENT) */
        .separator-container {
            width: 100%;
            display: block;
            margin-bottom: 20px;
            border-top: 3px solid #000;     /* Garis Tebal (Atas) */
            border-bottom: 1px solid #000;  /* Garis Tipis (Bawah) */
            height: 5px;                    /* Jarak antar garis */
            padding: 0;
            box-sizing: border-box;
        }

        /* BIODATA */
        .judul-dokumen {
            text-align: center;
            font-weight: 700;
            font-size: 12pt;
            text-transform: uppercase;
            margin-bottom: 20px;
            color: #000;
        }

        .table-biodata { 
            width: 100%; 
            border-collapse: collapse; 
            font-size: 9pt; 
            margin-bottom: 15px; 
        }
        .table-biodata td { 
            padding: 2px 0;
            vertical-align: top;
        }
        .label-bio { width: 150px; }
        .sep-bio { width: 15px; text-align: center; }
        .val-bio { font-weight: 500; }

        /* TABLE NILAI */
        .table-nilai {
            width: 100%;
            border-collapse: collapse;
            font-size: 9pt;
            margin-bottom: 0; /* Ubah jadi 0 biar nempel sama footer IPS */
        }
        
        .table-nilai thead th {
            background-color: #555555; /* Header Gelap sesuai gambar */
            color: white;
            padding: 8px 5px;
            border: 1px solid #999;
            font-weight: 700;
            text-transform: uppercase;
            font-size: 8pt;
        }

        .table-nilai tbody td {
            border: 1px solid #999;
            padding: 4px 6px;
            vertical-align: middle;
        }

        /* Semester Row */
        .row-semester td {
            background-color: #e0e0e0;
            font-weight: bold;
            padding: 5px 10px;
            border: 1px solid #999;
        }

        /* FOOTER IPS/IPK (Kotak bawah tabel) */
        .summary-box {
            border: 1px solid #999;
            border-top: none; /* Nyatu sama tabel */
            padding: 8px 10px;
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            background-color: #f9f9f9;
            margin-bottom: 30px;
        }
        
        .ips-group {
            font-size: 9pt;
            line-height: 1.5;
        }

        /* TANDA TANGAN */
        .signature-section {
            display: flex;
            justify-content: flex-end;
            margin-top: 10px;
            padding-right: 20px;
        }
        .ttd-container {
            text-align: center;
            width: 250px;
            position: relative;
        }
        .ttd-img {
            height: 60px;
            width: auto;
            margin: 5px auto;
            display: block;
        }
        .stempel-img {
            position: absolute;
            left: 20px;
            top: 30px;
            width: 70px;
            opacity: 0.7;
            transform: rotate(-10deg);
        }



        @media print {
            body { background: white; }
            .paper-a4 { width: 100%; margin: 0; box-shadow: none; padding: 10mm 15mm; }
            .btn-print { display: none; }
        }
    </style>
</head>
<body>

    <div class="paper-a4">
        
        {{-- WATERMARK BACKGROUND --}}
        <div style="position: absolute; inset: 0; display: flex; align-items: center; justify-content: center; z-index: 0; pointer-events: none;">
            <img src="{{ asset('/images/lp3i_krw.png') }}" style="width: 60%; opacity: 0.08;">
        </div>

        <div style="position: relative; z-index: 10;">
            
            {{-- KOP SURAT --}}
            <div class="kop-container">
                <div class="kop-logo">
                    <img src="{{ asset('/images/lp3i_krw.png') }}" style="width: 40px; height: 55px;">
                </div>
                <div class="kop-text">
                    <h1>LP3I COLLEGE</h1>
                    <p>
                        Gedung Karawang Hijau, Jl. Tarumanegara No. 4-6, Desa Purwadana,<br>
                        Kecamatan Telukjambe Timur, Kabupaten Karawang, Jawa Barat 41361<br>
                        Telp (0267) 411286
                    </p>
                </div>
            </div>
            
            <div class="separator-container"></div>

            {{-- JUDUL --}}
            <div class="judul-dokumen">KARTU HASIL STUDI</div>

            {{-- BIODATA --}}
            <table class="table-biodata">
                <tr>
                    <td class="label-bio">Nama</td>
                    <td class="sep-bio">:</td>
                    <td class="val-bio">{{ ucfirst($mahasiswa->nama_mhs ?? $mahasiswa->nama) }}</td>
                </tr>
                <tr>
                    <td class="label-bio">NIPD</td>
                    <td class="sep-bio">:</td>
                    <td class="val-bio">{{ $mahasiswa->nipd }}</td>
                </tr>
                <tr>
                    <td class="label-bio">Tempat / Tanggal Lahir</td>
                    <td class="sep-bio">:</td>
                    <td class="val-bio">{{ $mahasiswa->tempat_lahir ?? 'Karawang' }} / {{ $mahasiswa->tgl_lahir ? \Carbon\Carbon::parse($mahasiswa->tgl_lahir)->translatedFormat('d F Y') : '-' }}</td>
                </tr>
                <tr>
                    <td class="label-bio">Bidang Keahlian</td>
                    <td class="sep-bio">:</td>
                    <td class="val-bio">{{ ucfirst($mahasiswa->data_kelas->programStudi->nama_program_studi ?? '-') }}</td>
                </tr>
            </table>

            {{-- LOOP SEMESTER --}}
            @foreach($semesterData as $sem => $data)
            <table class="table-nilai">
                <thead>
                    <tr>
                        <th rowspan="2" style="width: 40px;">NO</th>
                        <th rowspan="2">MATERI AJAR</th>
                        <th rowspan="2" style="width: 40px;">BK</th> <th colspan="3">Nilai</th>
                    </tr>
                    <tr>
                        <th style="width: 50px;">Angka</th>
                        <th style="width: 50px;">Huruf</th>
                        <th style="width: 60px;">Kumulatif</th>
                    </tr>
                </thead>
                <tbody>
                    <tr class="row-semester">
                        <td colspan="6">Semester {{ $sem }}</td>
                    </tr>

                    @php 
                        $no = 1; 
                        $totalSks = $data['total_sks'] ?? 0; 
                        $totalMutu = 0; 
                    @endphp
                    
                    @foreach($data['nilai'] as $nilai)
                    @php
                        $sks = $nilai->mataKuliah->sks ?? $nilai->materiAjar->sks ?? 0;
                        $huruf = ucfirst($nilai->mutu ?? $nilai->grade ?? '-');
                        $angka = match($huruf) {
                            'A' => 4.0, 'A-' => 3.7, 'B+' => 3.3, 'B' => 3.0, 'B-' => 2.7,
                            'C+' => 2.3, 'C' => 2.0, 'D' => 1.0, default => 0
                        };
                        $mutu = $nilai->bobot_ip ?? ($sks * $angka);
                        $totalMutu += $mutu;
                    @endphp
                    <tr>
                        <td style="text-align: center;">{{ $no++ }}</td>
                        <td>{{ $nilai->mataKuliah->nama_mk ?? $nilai->materiAjar->nama_mk ?? $nilai->kode_mk }}</td>
                        <td style="text-align: center;">{{ $sks }}</td>
                        <td style="text-align: center;">{{ number_format($angka, 1) }}</td>
                        <td style="text-align: center;">{{ $huruf }}</td>
                        <td style="text-align: center;">{{ number_format($mutu, 1) }}</td>
                    </tr>
                    @endforeach

                    <tr style="font-weight: bold; background: #fff;">
                        <td colspan="2" style="text-align: left; padding-left: 10px;">JUMLAH</td>
                        <td style="text-align: center;">{{ $totalSks }}</td>
                        <td colspan="2"></td>
                        <td style="text-align: center;">{{ number_format($totalMutu, 1) }}</td>
                    </tr>
                </tbody>
            </table>

            {{-- BOX RINGKASAN IPS/IPK (Sesuai Gambar) --}}
            <div class="summary-box">
                <div class="ips-group">
                    @php
                        $ips = $data['ips'] ?? ($totalSks > 0 ? $totalMutu / $totalSks : 0);
                        // Logika IPK sederhana (jika data ipk tidak ada, samakan dgn IPS utk smstr 1)
                        $ipk = $ips; 
                    @endphp
                    <div>Index Prestasi Semester (IPS) : <strong>{{ number_format($ips, 2) }}</strong></div>
                    <div>Index Prestasi Kumulatif (IPK) : <strong>{{ number_format($ipk, 2) }}</strong></div>
                </div>
                <div class="ips-group">
                    Predikat : 
                    <strong>
                        @if($ips >= 3.51) Dengan Pujian
                        @elseif($ips >= 3.00) Sangat Memuaskan
                        @elseif($ips >= 2.50) Memuaskan
                        @elseif($ips >= 2.00) Cukup
                        @else Kurang
                        @endif
                    </strong>
                </div>
            </div>
            @endforeach

            {{-- TANDA TANGAN --}}
            <div class="signature-section">
                <div class="ttd-container">
                    <p style="margin-bottom: 5px;">Karawang, {{ now()->translatedFormat('d F Y') }}</p>
                    
                    {{-- Area Tanda Tangan & Stempel --}}
                    <div style="height: 80px; position: relative; display: flex; align-items: center; justify-content: center;">
                        <!-- Space for manual signature -->
                    </div>

                    <p style="font-weight: bold; margin: 0; text-decoration: underline;">
                        {{ $mahasiswa->data_kelas->pendidik->nama_pendidik ?? 'Eko Marmanto P.U, S.Kom.,M.Kom.,MOS.' }}
                    </p>
                    <p style="margin: 2px 0 0 0; font-size: 8pt;">Head of Education</p>
                </div>
            </div>

        </div>
    </div>

    <script>
        window.onload = function() {
            window.print();
        }
    </script>
</body>
</html>