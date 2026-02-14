<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>KRS Batch Print</title>
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
            font-size: 11pt;
            line-height: 1.4;
            color: #000;
        }
        
        @media print {
            .page-break {
                page-break-after: always;
                break-after: page;
            }
            
            .container {
                page-break-inside: avoid;
                break-inside: avoid;
            }
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
            width: 40px;
            height: 60px;
            margin-right: 15px;
        }
        
        .college-info {
            flex: 1;
        }
        
        .college-info h2 {
            font-size: 16pt;
            font-weight: bold;
            margin-bottom: 3px;
        }
        
        .college-info p {
            font-size: 9pt;
            margin: 2px 0;
        }
        
        .academic-year {
            font-weight: bold;
            font-size: 10pt;
            margin-top: 5px;
        }
        
        /* Title */
        .title {
            text-align: center;
            font-size: 14pt;
            font-weight: bold;
            margin: 20px 0;
            text-transform: uppercase;
        }
        
        /* Student Info */
        .student-info {
            margin-bottom: 20px;
        }
        
        .student-info table {
            width: 100%;
            border-collapse: collapse;
        }
        
        .student-info td {
            padding: 3px 0;
            font-size: 10pt;
        }
        
        .student-info td:first-child {
            width: 150px;
            font-weight: bold;
        }
        
        .student-info td:nth-child(2) {
            width: 10px;
        }
        
        /* KRS Table */
        .krs-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 10px;
        }
        
        .krs-table thead {
            background-color: #808080;
            color: white;
        }
        
        .krs-table th,
        .krs-table td {
            border: 1px solid #000;
            padding: 4px;
            text-align: left;
        }
        
        .krs-table th {
            font-weight: bold;
            text-align: center;
            font-size: 9pt;
        }
        
        .krs-table td {
            font-size: 9pt;
        }
        
        .krs-table tbody tr:nth-child(even) {
            background-color: #d3d3d3;
        }
        
        .krs-table tbody tr:nth-child(odd) {
            background-color: #ffffff;
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
        
        .col-bk {
            width: 50px;
            text-align: center !important;
        }
        
        .total-row {
            font-weight: bold;
            background-color: #808080 !important;
            color: white;
        }
        
        .total-row td {
            text-align: right;
            padding-right: 10px;
        }
        
        /* Note */
        .note {
            font-size: 8pt;
            font-style: italic;
            margin: 10px 0;
        }
        
        /* Signature Section */
        .signature-section {
            margin-top: 20px;
            display: flex;
            justify-content: space-between;
            page-break-inside: avoid;
            break-inside: avoid;
        }
        
        .signature-box {
            width: 45%;
            text-align: center;
        }
        
        .signature-box p {
            margin: 2px 0;
            font-size: 9pt;
        }
        
        .signature-space {
            height: 50px;
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
            <img src="{{ asset('images/lp3i_krw.png') }}" alt="LP3I Logo" class="logo">
            <div class="college-info">
                <h2>LP3I COLLEGE</h2>
                <p>Gedung Karawang Hijau, Ruko Karawang Hijau, Jl. Tarumanagara No.4-6, Desa Purwadana</p>
                <p>Kecamatan Telukjambe Timur, Kabupaten Karawang, Jawa Barat 41361</p>
                <p>Telp: (0267) 411286 | Website: www.lp3i.ac.id | Email: info@lp3i.id</p>
                <p class="academic-year">TAHUN AKADEMIK {{ $tahun_akademik ?? '2024/2025' }}</p>
            </div>
        </div>
        
        <!-- Title -->
        <div class="title">
            KARTU RENCANA STUDI (KRS)
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
                    <td>{{ $data['mahasiswa']->nama_mhs }}</td>
                </tr>
                <tr>
                    <td>SEMESTER</td>
                    <td>:</td>
                    <td>
                        @if($semester)
                            {{ ($semester % 2 == 1 ? 'Ganjil' : 'Genap') . ' ( ' . $semester . ' )' }}
                        @else
                            @php
                                // Get unique semesters from KRS data
                                $semesters = $data['krsList']->pluck('semester')->unique()->sort();
                                if ($semesters->count() == 1) {
                                    $sem = $semesters->first();
                                    echo ($sem % 2 == 1 ? 'Ganjil' : 'Genap') . ' ( ' . $sem . ' )';
                                } elseif ($semesters->count() > 1) {
                                    echo 'Semester ' . $semesters->first() . ' - ' . $semesters->last();
                                } else {
                                    echo '-';
                                }
                            @endphp
                        @endif
                    </td>
                </tr>
                <tr>
                    <td>PROGRAM STUDI</td>
                    <td>:</td>
                    <td>{{ $data['mahasiswa']->data_kelas->programStudi->nama_program_studi ?? '-' }}</td>
                </tr>
            </table>
        </div>
        
        <!-- KRS Table -->
        <table class="krs-table">
            <thead>
                <tr>
                    <th class="col-no">NO</th>
                    <th class="col-kode">KODE</th>
                    <th class="col-matkul">MATERI AJAR</th>
                    <th class="col-bk">BK</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $no = 1;
                @endphp
                @forelse($data['krsList'] as $krs)
                    <tr>
                        <td class="col-no">{{ $no++ }}</td>
                        <td class="col-kode">{{ $krs->mataKuliah->kode_mk ?? '-' }}</td>
                        <td class="col-matkul">{{ $krs->mataKuliah->nama_mk ?? '-' }}</td>
                        <td class="col-bk">{{ $krs->mataKuliah->sks ?? 0 }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" style="text-align: center; padding: 20px;">Tidak ada data KRS</td>
                    </tr>
                @endforelse
                
                <!-- Total Row -->
                <tr class="total-row">
                    <td colspan="3">TOTAL JUMLAH BK</td>
                    <td class="col-bk">{{ $data['totalSKS'] ?? 0 }}</td>
                </tr>
            </tbody>
        </table>
        
        <!-- Note -->
        <div class="note">
            Note : Waktu dan Tempat lihat jadwal di Sistem Informasi Akademik (e-student)
        </div>
        
        <!-- Signature Section -->
        <div class="signature-section">
            <div class="signature-box">
                <p>Pembimbing Akademik (PA)</p>
                <div class="signature-space"></div>
                <p class="signature-name">{{ $data['mahasiswa']->data_kelas->pendidik->nama_pendidik ?? '...................................' }}</p>
            </div>
            <div class="signature-box" style="text-align: right;">
                <p>Karawang, {{ date('d-M-Y') }}</p>
                <p>PD yang bersangkutan,</p>
                <div class="signature-space"></div>
                <p class="signature-name">{{ $data['mahasiswa']->nama_mhs }}</p>
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
