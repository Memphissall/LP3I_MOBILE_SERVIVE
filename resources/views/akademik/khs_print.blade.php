<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>KHS - {{ $mahasiswa->nipd }}</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap');

        * {
            box-sizing: border-box;
        }

        /* Margin 0 untuk Full Bleed Frame Navy */
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

        /* Container dengan bingkai Navy */
        .page-container { 
            padding: 10mm 15mm; /* Top/Bot 10mm, Left/Right 15mm */
            position: relative; 
            background: white;
            border-top: 15px solid #000066 !important; 
            min-height: 297mm; /* Ensure border is at bottom if content is short */
        }
        
        /* HEADER STYLE - Garis Ganda (Tebal & Tipis) */
        .header-container { 
            text-align: center; 
            padding-bottom: 5px;
            border-bottom: 1px solid #000; 
            margin-bottom: 20px;
            position: relative; 
            min-height: 80px;
        }

        /* REVISI: Styling Logo di Pojok Kiri */
        .header-logo {
            position: absolute;
            left: 0;
            width: 60px; /* Sesuaikan ukuran logo */
            height: auto;
        }

        /* Membuat garis tebal tambahan */
        .header-container::after {
            content: "";
            display: block;
            position: absolute;
            bottom: 2px;
            left: 0;
            right: 0;
            border-bottom: 3px solid #000; /* Garis tebal */
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
        .info-table { width: 100%; margin-bottom: 15px; border-collapse: collapse; font-size: 10pt; }
        .info-table td { padding: 3px 0; vertical-align: top; }
        .info-table .label { width: 160px; font-weight: 600; }

        /* Grades Table */
        table.grades { 
            width: 99%; 
            margin: 0 auto;
            border-collapse: collapse; 
            margin-bottom: 10px; 
            border: 1px solid #000; 
            font-size: 9pt; 
            table-layout: fixed;
        }
        table.grades th { 
            box-shadow: inset 0 0 0 1000px #a6a6a6 !important; 
            background-color: #a6a6a6 !important;
            color: #000 !important;
            border: 1px solid #000; 
            padding: 8px; 
            text-align: center; 
            text-transform: uppercase;
            font-weight: bold;
            word-wrap: break-word;
        }
        table.grades td { 
            border: 1px solid #000; 
            padding: 6px; 
            text-align: center; 
            word-wrap: break-word;
        }
        table.grades td.left { text-align: left; }
        
        /* Summary Table specific styles */
        table.grades.summary th { background-color: #e0e0e0 !important; }
        
        .signature-wrapper { margin-top: 30px; width: 100%; }
        .sig-box-right { width: 40%; float: right; text-align: center; }
        .sig-space { height: 60px; }
        
        .btn-print {
            position: fixed; top: 20px; right: 20px;
            padding: 10px 20px; background: #000066; color: white;
            border: none; border-radius: 5px; cursor: pointer; font-weight: bold;
            z-index: 9999; box-shadow: 0 4px 6px rgba(0,0,0,0.1);
        }

        .semester-block {
            page-break-inside: avoid;
            break-inside: avoid;
            margin-bottom: 30px;
            padding-top: 40px; /* Jarak untuk antisipasi halaman baru */
        }

        @media print {
            .btn-print { display: none; }
        }
    </style>
</head>
<body>
    <button onclick="window.print()" class="btn-print">Print PDF</button>

    <div class="page-container">
        <!-- Header -->
        <div class="header-container">
            <img src="{{ asset('images/lp3i_krw.png') }}" class="header-logo" alt="logo LP3I">
            
            <div class="campus-name">LP3I COLLEGE KARAWANG</div>
            <div class="campus-address">
                Gedung Karawang Hijau, Ruko Karawang Hijau, Jl. Tarumanagara No.4-6, Desa Purwadana,<br>
                Kecamatan Telukjambe Timur, Kab. Karawang, Jawa Barat. <br>
                <span style="font-weight: bold;">ACADEMIC YEAR {{ $tahun_akademik }}</span>
            </div>
        </div>

        <div class="document-title">STUDY RESULT CARD (KHS)</div>

        <table class="info-table">
            <tr>
                <td class="label">NIM (NIPD)</td><td>: <strong>{{ $mahasiswa->nipd }}</strong></td>
            </tr>
            <tr>
                <td class="label">FULL NAME</td><td>: <strong>{{ strtoupper($mahasiswa->nama) }}</strong></td>
            </tr>
            <tr>
                <td class="label">MAJOR / FIELD</td><td>: {{ $mahasiswa->data_kelas->bidangKeahlian->nama_bidang ?? 'Software Engineering' }}</td>
            </tr>
        </table>

        <!-- Loop Grades by Semester -->
        @foreach($semesterData as $sem => $data)
            <div class="semester-block">
                <div style="font-weight: bold; display: inline-block; padding-bottom: 2px; margin-bottom: 5px;">
                    SEMESTER {{ $sem }}
                </div>

                <table class="grades">
                    <thead>
                        <tr>
                            <th style="width: 7%;">NO</th>
                            <th style="width: 45%;">COURSES SUBJECT</th>
                            <th style="width: 10%;">SKS</th>
                            <th style="width: 15%;">SCORE</th>
                            <th style="width: 10%;">GRADE</th>
                            <th style="width: 15%;">POINT</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($data['nilai'] as $index => $nilai)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td class="left">{{ $nilai->mataKuliah->nama_mk ?? $nilai->kode_mk }}</td>
                                <td>{{ $nilai->mataKuliah->sks ?? '-' }}</td>
                                <td><strong>{{ number_format($nilai->nilai_akhir, 1) }}</strong></td>
                                <td><strong>{{ $nilai->mutu ?? '-' }}</strong></td>
                                <td>{{ number_format($nilai->bobot_ip, 1) }}</td>
                            </tr>
                        @endforeach
                        <tr style="background-color: #f9f9f9; font-weight: bold;">
                            <td colspan="2" style="text-align: right; padding-right: 10px;">TOTAL</td>
                            <td>{{ $data['total_sks'] }}</td>
                            <td colspan="2" style="text-align: right; padding-right: 10px;">IPS :</td>
                            <td>{{ number_format($data['ips'], 2) }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        @endforeach

        <div class="signature-wrapper">
            <div class="sig-box-right">
                <div>Karawang, {{ date('d F Y') }}</div>
                <div>Head of Education,</div>
                <div class="sig-space"></div>
                <div style="font-weight: bold; text-decoration: underline;">{{ $mahasiswa->data_kelas->nama_pa ?? '.........................' }}</div>
                <div>NIP. -</div>
            </div>
            <div style="clear: both;"></div>
        </div>

        <div style="margin-top: 25px; border-top: 1px dashed #ccc; padding-top: 15px; text-align: center;">
            <small style="color: #888;">#beranipunyaskill - This Page is a temporary Study Result Card for internal use.</small>
        </div>
    </div>
</body>
</html>
