<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Batch Print KRS</title>
    <style>
        @page {
            size: A4;
            margin: 15mm;
        }
        
        body {
            font-family: Arial, sans-serif;
            font-size: 11pt;
            margin: 0;
            padding: 20px;
        }
        
        .krs-page {
            page-break-after: always;
            margin-bottom: 40px;
        }
        
        .krs-page:last-child {
            page-break-after: auto;
        }
        
        .header {
            text-align: center;
            margin-bottom: 20px;
            border-bottom: 2px solid #000;
            padding-bottom: 10px;
        }
        
        .logo {
            font-size: 36px;
            font-weight: bold;
            margin-bottom: 5px;
        }
        
        .title {
            font-size: 16px;
            font-weight: bold;
            margin-top: 5px;
        }
        
        .student-info {
            margin: 20px 0;
        }
        
        .student-info table {
            width: 100%;
        }
        
        .student-info td {
            padding: 3px 0;
        }
        
        .student-info .label {
            width: 150px;
            font-weight: normal;
        }
        
        .schedule-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }
        
        .schedule-table th,
        .schedule-table td {
            border: 1px solid #000;
            padding: 8px;
            text-align: left;
        }
        
        .schedule-table th {
            background-color: #f0f0f0;
            font-weight: bold;
            text-align: center;
            font-size: 10pt;
        }
        
        .schedule-table td {
            font-size: 10pt;
        }
        
        .semester-header {
            background-color: #e0e0e0;
            font-weight: bold;
            padding: 8px;
        }
        
        .text-center {
            text-align: center;
        }
        
        .footer {
            margin-top: 30px;
            text-align: center;
            font-size: 9pt;
            font-style: italic;
        }
        
        @media print {
            button {
                display: none !important;
            }
            
            .no-print {
                display: none !important;
            }
        }
    </style>
</head>
<body>
    <button onclick="window.print()" class="no-print" style="position: fixed; top: 10px; right: 10px; padding: 10px 20px; background: #3b82f6; color: white; border: none; border-radius: 5px; cursor: pointer; z-index: 1000;">
        Print All
    </button>

    @foreach($batchData as $data)
        <div class="krs-page">
            <div class="header">
                <div class="logo">[LP3I]</div>
                <div style="font-size: 18px; font-weight: bold;">LP3I COLLEGE</div>
                <div class="title">TEMPORARY STUDY PLAN CARD</div>
            </div>

            <div class="student-info">
                <table>
                    <tr>
                        <td class="label">NIM :</td>
                        <td style="font-weight: bold;">{{ $data['mahasiswa']->nipd }}</td>
                        <td style="width: 100px;">Class :</td>
                        <td style="font-weight: bold;">{{ $data['mahasiswa']->data_kelas->nama_kelas ?? '-' }}-{{ $data['mahasiswa']->data_kelas->bidangKeahlian->kode ?? '' }}</td>
                    </tr>
                    <tr>
                        <td class="label">Full Name :</td>
                        <td style="font-weight: bold;">{{ $data['mahasiswa']->nama }}</td>
                        <td>Academic Counselors :</td>
                        <td style="font-weight: bold;">-</td>
                    </tr>
                </table>
            </div>

            <table class="schedule-table">
                <thead>
                    <tr>
                        <th rowspan="2">NO</th>
                        <th rowspan="2">COURSES CODE</th>
                        <th rowspan="2">COURSES</th>
                        <th rowspan="2">SKS</th>
                        <th colspan="4">SCHEDULE</th>
                    </tr>
                    <tr>
                        <th>DAY</th>
                        <th>TIME</th>
                        <th>CLASS</th>
                        <th>ROOM</th>
                    </tr>
                </thead>
                <tbody>
                    @if($semester)
                        <tr>
                            <td colspan="8" class="semester-header">Semesters : {{ $semester }}</td>
                        </tr>
                    @endif
                    @foreach($data['krsList'] as $index => $krs)
                        @if(!$semester && ($index == 0 || $krs->semester != $data['krsList'][$index-1]->semester))
                            <tr>
                                <td colspan="8" class="semester-header">Semesters : {{ $krs->semester }}</td>
                            </tr>
                        @endif
                        <tr>
                            <td class="text-center">{{ $loop->iteration }}</td>
                            <td>{{ $krs->mataKuliah->kode_mk ?? '-' }}</td>
                            <td>{{ $krs->mataKuliah->nama_mk ?? '-' }}</td>
                            <td class="text-center">{{ $krs->mataKuliah->sks ?? '-' }}</td>
                            <td class="text-center" colspan="4">-</td>
                        </tr>
                    @endforeach
                    <tr>
                        <td colspan="3" style="text-align: right; font-weight: bold;">TOTAL SKS:</td>
                        <td class="text-center" style="font-weight: bold;">{{ $data['totalSKS'] }}</td>
                        <td colspan="4"></td>
                    </tr>
                </tbody>
            </table>

            <div class="footer">
                This Page is only temporary and for theyself (the student)
            </div>
        </div>
    @endforeach
</body>
</html>
