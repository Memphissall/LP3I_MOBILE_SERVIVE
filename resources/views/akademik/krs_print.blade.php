
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>KRS - {{ $mahasiswa->nipd }}</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap');

        /* Margin nol agar bingkai navy mepet ke tepi kertas */
        @page { size: A4; margin: 0; }
        
        body { 
            font-family: 'Poppins', sans-serif; 
            font-size: 10pt; 
            color: #333; 
            line-height: 1.4; 
            margin: 0;
            padding: 0;
            -webkit-print-color-adjust: exact !important;
            print-color-adjust: exact !important;
        }

        /* Container dengan bingkai Navy Tebal Atas & Bawah */
        .page-container { 
            padding: 15mm 15mm; 
            position: relative; 
            min-height: 297mm; 
            background: white;
            box-sizing: border-box;
            border-top: 15px solid #000066 !important; 
            border-bottom: 15px solid #000066 !important; 
        }
        
        /* HEADER STYLE - No Border here (Moved to Separator) */
        .header-container { 
            text-align: center; 
            margin-bottom: 0px;
            position: relative; /* Kunci patokan untuk logo */
            min-height: 80px;
            padding-bottom: 10px;
        }

        /* GARIS TEBAL & TIPIS - SINGLE BOX TECHNIQUE */
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

        /* REVISI: Styling Logo di Pojok Kiri */
        .header-logo {
            position: absolute;
            left: 0;
            width: 60px; /* Sesuaikan ukuran logo */
            height: auto;
        }



        .campus-name { 
            font-weight: bold; 
            font-size: 18pt; 
            color: #000066 !important; 
            letter-spacing: 1px;
            margin: 0;
            text-transform: uppercase;
        }
        
        .campus-address {
            font-size: 8.5pt;
            color: #333;
            margin: 2px 0;
            padding-bottom: 10px; /* Memberi ruang untuk garis ganda */
        }

        .document-title { 
            text-align: center; 
            font-weight: bold; 
            font-size: 13pt; 
            text-decoration: underline; 
            margin: 15px 0; 
            text-transform: uppercase;
        }

        /* Student Info */
        .info-table { width: 100%; margin-bottom: 15px; border-collapse: collapse; }
        .info-table td { padding: 3px 0; vertical-align: top; }
        .info-table .label { width: 160px; font-weight: 600; }

        /* TABLE STYLE */
        .krs-table { width: 100%; border-collapse: collapse; margin-bottom: 10px; border: 1px solid #000; }
        .krs-table th { 
            box-shadow: inset 0 0 0 1000px #a6a6a6 !important; 
            background-color: #a6a6a6 !important;
            color: #000 !important;
            border: 1px solid #000; 
            padding: 10px 8px; 
            text-align: center; 
            font-size: 9pt; 
            text-transform: uppercase;
        }
        .krs-table td { border: 1px solid #000; padding: 8px; font-size: 9pt; }
        .text-center { text-align: center; }
        .total-row { font-weight: bold; }

        /* Signature Area */
        .signature-wrapper { margin-top: 30px; width: 100%; }
        .sig-box { width: 40%; float: left; text-align: center; }
        .sig-box-right { width: 40%; float: right; text-align: center; }
        .sig-space { height: 60px; }
        
        .note { font-size: 8pt; margin-top: 10px; font-style: italic; color: #666; }

        .btn-print {
            position: fixed; top: 20px; right: 20px;
            padding: 10px 20px; background: #000066; color: white;
            border: none; border-radius: 5px; cursor: pointer; font-weight: bold;
            z-index: 9999; box-shadow: 0 4px 6px rgba(0,0,0,0.1);
        }

        @media print {
            .btn-print { display: none; }
        }
    </style>
</head>
<body>
    <button onclick="window.print()" class="btn-print">Print PDF</button>

    <div class="page-container">
        <div class="header-container">
            <img src="{{ asset('images/lp3i_krw.png') }}" class="header-logo" alt="logo LP3I">
            
            <div class="campus-name">LP3I COLLEGE KARAWANG</div>
            <div class="campus-address">
                Gedung Karawang Hijau, Ruko Karawang Hijau, Jl. Tarumanagara No.4-6, Desa Purwadana,<br>
                Kecamatan Telukjambe Timur, Kab. Karawang, Jawa Barat. <br>
                <span style="font-weight: bold;">ACADEMIC YEAR 2023/2024</span>
            </div>
        </div>
        
        <!-- Separator Line (Moved outside header) -->
        <div class="separator-container"></div>

        <div class="document-title">STUDY PLAN CARD (KRS)</div>

        <table class="info-table">
            <tr>
                <td class="label">NIM (NIPD)</td><td>: <strong>{{ $mahasiswa->nipd }}</strong></td>
            </tr>
            <tr>
                <td class="label">FULL NAME</td><td>: <strong>{{ strtoupper($mahasiswa->nama) }}</strong></td>
            </tr>
            <tr>
                <td class="label">SEMESTER</td><td>: {{ $semester ?? '-' }} @if($semester) ({{ $semester % 2 == 0 ? 'Even' : 'Odd' }}) @endif</td>
            </tr>
            <tr>
                <td class="label">MAJOR / FIELD</td><td>: {{ $mahasiswa->data_kelas->programStudi->nama ?? 'Software Engineering' }}</td>
            </tr>
        </table>

        <table class="krs-table">
            <thead>
                <tr>
                    <th width="5%">NO</th>
                    <th width="20%">CODE</th>
                    <th width="60%">COURSES SUBJECT</th>
                    <th width="15%">SKS (BK)</th>
                </tr>
            </thead>
            <tbody>
                @forelse($krsList as $krs)
                    <tr>
                        <td class="text-center">{{ $loop->iteration }}</td>
                        <td class="text-center">{{ $krs->mataKuliah->kode_mk ?? ($krs->mataKuliah->id_matkul ?? '-') }}</td>
                        <td>{{ $krs->mataKuliah->nama_mk ?? 'Subject not found' }}</td>
                        <td class="text-center">{{ $krs->mataKuliah->sks ?? 0 }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="text-center" style="padding: 20px;">No data available for this semester.</td>
                    </tr>
                @endforelse
                <tr class="total-row">
                    <td colspan="3" style="text-align: right; padding-right: 15px;">Total BK (TOTAL BK)</td>
                    <td class="text-center" style="color: #000066;">{{ $totalSKS }}</td>
                </tr>
            </tbody>
        </table>

        <p class="note">Note: Time and Venue are listed in the Academic Information System (e-student).</p>

        <div class="signature-wrapper">
            <div class="sig-box">
                <div>Academic Counselors (PA),</div>
                <div class="sig-space"></div>
                <div style="font-weight: bold; text-decoration: underline;">(...........................................)</div>
                <div>NIDN. -</div>
            </div>
            <div class="sig-box-right">
                <div>Karawang, {{ date('d F Y') }}</div>
                <div>Student,</div>
                <div class="sig-space"></div>
                <div style="font-weight: bold; text-decoration: underline;">{{ strtoupper($mahasiswa->nama) }}</div>
                <div>NIM. {{ $mahasiswa->nipd }}</div>
            </div>
            <div style="clear: both;"></div>
        </div>

        <div style="margin-top: 40px; border-top: 1px dashed #ccc; padding-top: 10px; text-align: center;">
            <small style="color: #888;">#beranipunyaskill - This Page is a temporary Study Plan Card for internal use.</small>
        </div>
    </div>
</body>
</html>
