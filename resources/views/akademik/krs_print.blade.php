<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>KRS - {{ $mahasiswa->nipd }}</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    
    <style>
        @page { size: A4; margin: 0; }
        
        *, *::before, *::after { box-sizing: border-box; }
        
        body { 
            font-family: 'Poppins', sans-serif; 
            font-size: 10pt; 
            margin: 0; 
            padding: 0;
            background: white;
            color: black;
            -webkit-print-color-adjust: exact !important;
            print-color-adjust: exact !important;
        }

        /* === KERTAS A4 === */
        .paper-a4 {
            width: 210mm;
            min-height: 297mm;
            background: white;
            margin: 0 auto;
            padding: 10mm 15mm; 
            position: relative;
            overflow: hidden;
            border-top: 15px solid #004269; 
            border-bottom: 15px solid #004269;
        }

        /* === KOP SURAT STRUKTUR === */
        .kop-wrapper {
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
            margin-bottom: 5px;
            min-height: 80px;
        }

        .kop-logo-container {
            position: absolute;
            left: 0;
            top: 0;
            width: 80px;
        }

        .kop-logo-container img {
            width: 100%;
            height: auto;
            mix-blend-multiply: multiply; 
        }

        .kop-text-container {
            text-align: center;
            width: 100%;
        }

        .kop-text-container h1 {
            font-size: 19pt;
            font-weight: 800;
            color: #004269;
            margin: 0;
            line-height: 1.1;
        }

        .line-separator {
            border-top: 3px solid #000;
            border-bottom: 1px solid #000;
            height: 2px;
            margin-bottom: 20px;
            margin-left: 90px; 
            width: auto;
        }

        /* === STUDENT INFO === */
        .info-table { 
            width: 100%; 
            margin-bottom: 20px; 
            border-collapse: collapse; 
            position: relative; 
            z-index: 10;
        }
        .info-table td { padding: 4px 0; vertical-align: top; }
        .label { width: 160px; font-weight: 500; text-transform: uppercase; font-size: 9pt; }
        .sep { width: 15px; text-align: center; }
        .val { font-weight: 700; }

        /* === TABLE KRS === */
        .krs-table { 
            width: 100%; 
            border-collapse: collapse; 
            margin-bottom: 10px; 
            position: relative; 
            z-index: 10;
            background-color: transparent;
        }
        .krs-table th { 
            background-color: #f2f2f2 !important;
            border: 1px solid #000; 
            padding: 10px 8px; 
            text-align: center; 
            font-weight: 700;
            font-size: 9pt;
        }
        .krs-table td { 
            border: 1px solid #000; 
            padding: 8px; 
            font-size: 9pt; 
            vertical-align: middle;
        }

        .total-row { 
            font-weight: 800; 
            background-color: #f9f9f9 !important;
        }

        /* === SIGNATURE === */
        .signature-wrapper { 
            margin-top: 40px; 
            display: flex; 
            justify-content: space-between;
            position: relative;
            z-index: 10;
        }
        .sig-box { width: 250px; text-align: center; }
        .sig-space { height: 70px; }

        .btn-print {
            position: fixed; top: 20px; right: 20px;
            padding: 10px 20px; background: #004269; color: white;
            border: none; border-radius: 5px; cursor: pointer; font-weight: bold;
            z-index: 9999;
        }

        @media print {
            .btn-print { display: none; }
            body { background: white; }
            .paper-a4 { margin: 0; border-top: 15px solid #004269 !important; }
        }

        @media screen {
            body { background: #e0e0e0; padding: 20px; }
            .paper-a4 { box-shadow: 0 0 15px rgba(0,0,0,0.2); }
        }
    </style>
</head>
<body>

    <button onclick="window.print()" class="btn-print">Cetak KRS</button>

    <div class="paper-a4">
        
        {{-- === WATERMARK LOGO TENGAH === --}}
        <div style="position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%); width: 70%; z-index: 0; opacity: 0.08; pointer-events: none;">
            <img src="{{ asset('images/lp3i_krw.png') }}" style="width: 100%; height: auto; mix-blend-multiply: multiply;">
        </div>

        <div style="position: relative; z-index: 10;">
            
            {{-- KOP SURAT --}}
            <div class="kop-wrapper">
                <div class="kop-logo-container">
                    <img src="{{ asset('images/lp3i_krw.png') }}" alt="logo LP3I">
                </div>
                <div class="kop-text-container">
                    <h1>LP3I COLLEGE KARAWANG</h1>
                    <p style="font-size: 8.5pt; margin-top: 5px; line-height: 1.4;">
                        Gedung Karawang Hijau, Ruko Karawang Hijau, Jl. Tarumanagara No.4-6, Desa Purwadana,<br>
                        Kecamatan Telukjambe Timur, Kab. Karawang, Jawa Barat. <br>
                        <strong>TAHUN AKADEMIK {{ $tahun_akademik ?? '2023/2024' }}</strong>
                    </p>
                </div>
            </div>

            <div class="line-separator"></div>

            <div style="text-align: center; font-weight: 800; font-size: 14pt; text-decoration: underline; margin-bottom: 20px;">
                STUDY PLAN CARD (KRS)
            </div>

            {{-- BIODATA --}}
            <table class="info-table">
                <tr>
                    <td class="label">NIM (NIPD)</td>
                    <td class="sep">:</td>
                    <td class="val">{{ $mahasiswa->nipd }}</td>
                </tr>
                <tr>
                    <td class="label">FULL NAME</td>
                    <td class="sep">:</td>
                    <td class="val">{{ strtoupper($mahasiswa->nama) }}</td>
                </tr>
                <tr>
                    <td class="label">SEMESTER</td>
                    <td class="sep">:</td>
                    <td class="val">{{ $semester ?? '-' }} ({{ ($semester ?? 1) % 2 == 0 ? 'Even' : 'Odd' }})</td>
                </tr>
                <tr>
                    <td class="label">MAJOR / FIELD</td>
                    <td class="sep">:</td>
                    <td class="val">{{ $mahasiswa->data_kelas->programStudi->nama ?? 'Accounting Information Systems' }}</td>
                </tr>
            </table>

            {{-- TABLE SUBJECTS --}}
            <table class="krs-table">
                <thead>
                    <tr>
                        <th width="5%">NO</th>
                        <th width="15%">CODE</th>
                        <th width="65%">COURSES SUBJECT</th>
                        <th width="15%">SKS (BK)</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($krsList as $krs)
                        <tr>
                            <td style="text-align: center;">{{ $loop->iteration }}</td>
                            <td style="text-align: center;">{{ $krs->mataKuliah->kode_mk ?? '-' }}</td>
                            <td>{{ $krs->mataKuliah->nama_mk ?? '-' }}</td>
                            <td style="text-align: center;">{{ $krs->mataKuliah->sks ?? 0 }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" style="text-align: center; padding: 30px; font-style: italic;">No data available for this semester.</td>
                        </tr>
                    @endforelse
                    <tr class="total-row">
                        <td colspan="3" style="text-align: right; padding-right: 15px;">TOTAL BK (SKS)</td>
                        <td style="text-align: center; color: #004269;">{{ $totalSKS }}</td>
                    </tr>
                </tbody>
            </table>

            <p style="font-size: 8pt; font-style: italic; color: #555; margin-top: 10px;">
                Note: Time and Venue are listed in the Academic Information System (e-student).
            </p>

            {{-- SIGNATURE AREA --}}
            <div class="signature-wrapper">
                <div class="sig-box">
                    <div>Academic Counselors (PA),</div>
                    <div class="sig-space"></div>
                    <div style="font-weight: bold; text-decoration: underline;">( ............................................ )</div>
                    <div>NIDN. -</div>
                </div>
                <div class="sig-box">
                    <div>Karawang, {{ date('d F Y') }}</div>
                    <div>Student,</div>
                    <div class="sig-space"></div>
                    <div style="font-weight: bold; text-decoration: underline;">{{ strtoupper($mahasiswa->nama) }}</div>
                    <div>NIM. {{ $mahasiswa->nipd }}</div>
                </div>
            </div>

            {{-- FOOTER HASHTAG --}}
            <div style="margin-top: 50px; border-top: 1px dashed #bbb; padding-top: 10px; text-align: center;">
                <small style="color: #999; letter-spacing: 1px;">#BERANIPUNYASKILL - LP3I COLLEGE INTERNAL DOCUMENT</small>
            </div>
        </div>
    </div>

</body>
</html>