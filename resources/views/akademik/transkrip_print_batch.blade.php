<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Transkrip Nilai - Batch Print</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap');

        @page {
            size: A4;
            margin: 5mm 10mm;
        }
        
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'Poppins', Arial, sans-serif;
            font-size: 9pt; /* Reduced font size */
            line-height: 1.3;
            color: #000;
            -webkit-print-color-adjust: exact !important;
            print-color-adjust: exact !important;
        }
        
        .page-break {
            page-break-after: always;
        }
        
        .container {
            width: 100%;
            max-width: 100%;
            margin: 0 auto;
            padding: 0 5px;
        }
        
        /* HEADER STYLE - Garis Ganda (Tebal & Tipis) */
        .header { 
            text-align: center; 
            padding-bottom: 5px;
            border-bottom: 1px solid #000; /* Garis tipis */
            margin-bottom: 5px; /* Reduced */
            position: relative; 
            min-height: 80px; /* Reduced */
        }

        /* Styling Logo di Pojok Kiri */
        .header-logo {
            position: absolute;
            left: 0;
            width: 50px; /* Reduced */
            height: auto;
        }

        /* Membuat garis tebal tambahan */
        .header::after {
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
            font-size: 14pt; /* Reduced */
            color: #000066; 
            letter-spacing: 1px;
            margin: 0;
            text-transform: uppercase;
        }
        
        .campus-address {
            font-size: 7pt; /* Reduced */
            color: #333;
            margin: 2px 0;
            padding-bottom: 2px;
        }
        
        /* Title */
        .title {
            text-align: center;
            font-size: 12pt; /* Reduced */
            font-weight: bold;
            margin: 5px 0; /* Reduced */
            text-decoration: underline;
            text-transform: uppercase;
        }
        
        /* Student Info */
        .student-info {
            margin-bottom: 5px; /* Reduced */
        }
        
        .student-info table {
            width: 100%;
            border-collapse: collapse;
        }
        
        .student-info td {
            padding: 1px 0; /* Reduced */
            font-size: 8pt; /* Reduced */
        }
        
        .student-info td:first-child {
            width: 120px;
            font-weight: bold;
        }
        
        .student-info td:nth-child(2) {
            width: 10px;
        }
        
        /* Transcript Table */
        .transkrip-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 5px; /* Reduced */
        }
        
        .transkrip-table thead {
            background-color: #808080;
            color: white;
        }
        
        .transkrip-table th,
        .transkrip-table td {
            border: 1px solid #000;
            padding: 3px; /* Reduced padding */
            text-align: left;
        }
        
        .transkrip-table th {
            font-weight: bold;
            text-align: center;
            font-size: 8pt; /* Reduced */
        }
        
        .transkrip-table td {
            font-size: 8pt; /* Reduced */
        }
        
        .semester-header {
            background-color: #d3d3d3;
            font-weight: bold;
            font-size: 8pt;
        }
        
        .col-no {
            width: 25px;
            text-align: center !important;
        }
        
        .col-kode {
            width: 70px;
        }
        
        .col-matkul {
            width: auto;
        }
        
        .col-sks {
            width: 30px;
            text-align: center !important;
        }
        
        .col-nilai {
            width: 40px;
            text-align: center !important;
        }
        
        .col-mutu {
            width: 30px;
            text-align: center !important;
        }
        
        .semester-summary {
            font-weight: bold;
            background-color: #e8e8e8;
        }
        
        .grand-total {
            font-weight: bold;
            background-color: #808080;
            color: white;
        }
        
        /* Note */
        .note {
            font-size: 7pt;
            font-style: italic;
            margin: 5px 0;
        }
        
        /* Signature Section */
        .signature-section {
            margin-top: 15px; /* Reduced */
            display: flex;
            justify-content: space-between;
        }
        
        .signature-box {
            width: 45%;
        }
        
        .signature-box p {
            margin: 2px 0;
            font-size: 8pt;
        }
        
        .signature-space {
            height: 30px; /* Reduced */
            margin: 5px 0;
        }
        
        .signature-name {
            font-weight: bold;
            border-bottom: 1px solid #000;
            display: inline-block;
            min-width: 180px;
            text-align: center;
        }
        
        @media print {
            body {
                print-color-adjust: exact;
                -webkit-print-color-adjust: exact;
            }
            
            .no-print {
                display: none;
            }
        }
    </style>
</head>
<body>
    @foreach($batchData as $data)
    <div class="container {{ !$loop->last ? 'page-break' : '' }}">
        <!-- Header -->
        <div class="header">
            <img src="{{ asset('images/lp3i_krw.png') }}" class="header-logo" alt="logo LP3I">
            
            <div class="campus-name">LP3I COLLEGE KARAWANG</div>
            <div class="campus-address">
                Gedung Karawang Hijau, Ruko Karawang Hijau, Jl. Tarumanagara No.4-6, Desa Purwadana,<br>
                Kecamatan Telukjambe Timur, Kab. Karawang, Jawa Barat.
            </div>
        </div>
        
        <!-- Title -->
        <div class="title">
            TRANSKRIP NILAI
        </div>
        
        <!-- Student Info -->
        <div class="student-info">
            <table>
                <tr>
                    <td>NIPD</td>
                    <td>:</td>
                    <td>{{ $data['mahasiswa']->nipd }}</td>
                </tr>
                <tr>
                    <td>NAMA LENGKAP</td>
                    <td>:</td>
                    <td>{{ $data['mahasiswa']->nama }}</td>
                </tr>
                <tr>
                    <td>BIDANG KEAHLIAN</td>
                    <td>:</td>
                    <td>{{ $data['mahasiswa']->data_kelas->programStudi->nama ?? '-' }}</td>
                </tr>
            </table>
        </div>
        
        <!-- Transcript Table -->
        <table class="transkrip-table">
            <thead>
                <tr>
                    <th class="col-no">NO</th>
                    <th class="col-kode">KODE MK</th>
                    <th class="col-matkul">Materi Ajar</th>
                    <th class="col-sks">SKS</th>
                    <th class="col-nilai">NILAI</th>
                    <th class="col-mutu">MUTU</th>
                </tr>
            </thead>
            <tbody>
                @php $globalNo = 1; @endphp
                @foreach($data['semesterData'] as $semester => $nilaiList)
                    <tr class="semester-header">
                        <td colspan="6">SEMESTER {{ $semester }}</td>
                    </tr>
                    @foreach($nilaiList as $nilai)
                        <tr>
                            <td class="col-no">{{ $globalNo++ }}</td>
                            <td class="col-kode">{{ $nilai->mataKuliah->kode_mk ?? '-' }}</td>
                            <td class="col-matkul">{{ $nilai->mataKuliah->nama_mk ?? '-' }}</td>
                            <td class="col-sks">{{ $nilai->mataKuliah->sks ?? 0 }}</td>
                            <td class="col-nilai">{{ number_format($nilai->nilai_akhir ?? 0, 0) }}</td>
                            <td class="col-mutu">{{ $nilai->mutu ?? '-' }}</td>
                        </tr>
                    @endforeach
                    <tr class="semester-summary">
                        <td colspan="3" style="text-align: right; padding-right: 10px;">Total BK Semester {{ $semester }}</td>
                        <td class="col-sks">{{ $data['ipsPerSemester'][$semester]['sks'] }}</td>
                        <td colspan="2">IPS: {{ number_format($data['ipsPerSemester'][$semester]['value'], 2) }}</td>
                    </tr>
                @endforeach
                
                <!-- Grand Total -->
                <tr class="grand-total">
                    <td colspan="3" style="text-align: right; padding-right: 10px;">Total BK KUMULATIF</td>
                    <td class="col-sks">{{ $data['totalSksKumulatif'] }}</td>
                    <td colspan="2">IPK: {{ number_format($data['ipk'], 2) }}</td>
                </tr>
            </tbody>
        </table>
        
        <!-- Note -->
        <div class="note">
            Note : Transkrip nilai ini adalah dokumen resmi akademik mahasiswa
        </div>
        
        <!-- Signature Section -->
        <div class="signature-section">
            <div class="signature-box">
                <p>Karawang, {{ date('d-M-Y') }}</p>
                <p>Direktur LP3I Karawang,</p>
                <div class="signature-space"></div>
                <p class="signature-name">...................................</p>
            </div>
            <div class="signature-box" style="text-align: right;">
                <p>&nbsp;</p>
                <p>Mahasiswa,</p>
                <div class="signature-space"></div>
                <p class="signature-name">{{ $data['mahasiswa']->nama }}</p>
            </div>
        </div>
    </div>
    @endforeach
    
    <script>
        window.onload = function() {
            window.print();
        }
    </script>
</body>
</html>
