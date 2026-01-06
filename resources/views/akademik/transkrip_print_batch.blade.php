<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Transkrip Nilai - Batch Print</title>
    <style>
        @page {
            size: A4;
            margin: 20mm;
        }
        
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: Arial, sans-serif;
            font-size: 10pt;
            line-height: 1.4;
            color: #000;
        }
        
        .page-break {
            page-break-after: always;
        }
        
        .container {
            width: 100%;
            max-width: 210mm;
            margin: 0 auto;
        }
        
        /* Header Section */
        .header {
            display: flex;
            align-items: flex-start;
            margin-bottom: 20px;
            border-bottom: 2px solid #000;
            padding-bottom: 10px;
        }
        
        .logo {
            width: 70px;
            height: 70px;
            margin-right: 15px;
        }
        
        .college-info {
            flex: 1;
        }
        
        .college-info h2 {
            font-size: 14pt;
            font-weight: bold;
            margin-bottom: 3px;
        }
        
        .college-info p {
            font-size: 8pt;
            margin: 2px 0;
        }
        
        .academic-year {
            font-weight: bold;
            font-size: 9pt;
            margin-top: 5px;
        }
        
        /* Title */
        .title {
            text-align: center;
            font-size: 12pt;
            font-weight: bold;
            margin: 15px 0;
            text-transform: uppercase;
        }
        
        /* Student Info */
        .student-info {
            margin-bottom: 15px;
        }
        
        .student-info table {
            width: 100%;
            border-collapse: collapse;
        }
        
        .student-info td {
            padding: 2px 0;
            font-size: 9pt;
        }
        
        .student-info td:first-child {
            width: 130px;
            font-weight: bold;
        }
        
        .student-info td:nth-child(2) {
            width: 10px;
        }
        
        /* Transcript Table */
        .transkrip-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 8px;
        }
        
        .transkrip-table thead {
            background-color: #808080;
            color: white;
        }
        
        .transkrip-table th,
        .transkrip-table td {
            border: 1px solid #000;
            padding: 6px;
            text-align: left;
        }
        
        .transkrip-table th {
            font-weight: bold;
            text-align: center;
            font-size: 9pt;
        }
        
        .transkrip-table td {
            font-size: 9pt;
        }
        
        .semester-header {
            background-color: #d3d3d3;
            font-weight: bold;
            font-size: 9pt;
        }
        
        .col-no {
            width: 30px;
            text-align: center !important;
        }
        
        .col-kode {
            width: 80px;
        }
        
        .col-matkul {
            width: auto;
        }
        
        .col-sks {
            width: 40px;
            text-align: center !important;
        }
        
        .col-nilai {
            width: 50px;
            text-align: center !important;
        }
        
        .col-mutu {
            width: 40px;
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
            font-size: 8pt;
            font-style: italic;
            margin: 10px 0;
        }
        
        /* Signature Section */
        .signature-section {
            margin-top: 30px;
            display: flex;
            justify-content: space-between;
        }
        
        .signature-box {
            width: 45%;
        }
        
        .signature-box p {
            margin: 3px 0;
            font-size: 9pt;
        }
        
        .signature-space {
            height: 50px;
            margin: 10px 0;
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
            <svg class="logo" viewBox="0 0 100 100" xmlns="http://www.w3.org/2000/svg">
                <rect x="10" y="10" width="80" height="80" fill="none" stroke="#000" stroke-width="3"/>
                <text x="50" y="60" font-size="40" font-weight="bold" text-anchor="middle" fill="#000">LP3I</text>
            </svg>
            <div class="college-info">
                <h2>LP3I COLLEGE</h2>
                <p>Cabang Karawang : Jl. Tarumanegara, Komplek Karawang Hijau Blok B. 4-6, Kab. Karawang</p>
                <p class="academic-year">TRANSKRIP NILAI AKADEMIK</p>
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
                    <td>{{ $data['mahasiswa']->data_kelas->bidangKeahlian->nama ?? '-' }}</td>
                </tr>
            </table>
        </div>
        
        <!-- Transcript Table -->
        <table class="transkrip-table">
            <thead>
                <tr>
                    <th class="col-no">NO</th>
                    <th class="col-kode">KODE MK</th>
                    <th class="col-matkul">MATA KULIAH</th>
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
                        <td colspan="3" style="text-align: right; padding-right: 10px;">Total SKS Semester {{ $semester }}</td>
                        <td class="col-sks">{{ $data['ipsPerSemester'][$semester]['sks'] }}</td>
                        <td colspan="2">IPS: {{ number_format($data['ipsPerSemester'][$semester]['value'], 2) }}</td>
                    </tr>
                @endforeach
                
                <!-- Grand Total -->
                <tr class="grand-total">
                    <td colspan="3" style="text-align: right; padding-right: 10px;">TOTAL SKS KUMULATIF</td>
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
