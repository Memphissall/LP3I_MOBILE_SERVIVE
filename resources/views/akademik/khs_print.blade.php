<!DOCTYPE html>
<html>
<head>
    <title>KHS - {{ $mahasiswa->nama }}</title>
    <style>
        @page { size: A4; margin: 15mm; }
        body { font-family: Arial, sans-serif; font-size: 9pt; margin: 0; padding: 15px; }
        
        /* Header with logo */
        .header-container { display: table; width: 100%; margin-bottom: 20px; }
        .logo-section { display: table-cell; width: 80px; vertical-align: top; }
        .logo { width: 70px; height: 70px; border: 2px solid #000; }
        .title-section { display: table-cell; vertical-align: middle; text-align: center; padding-left: 10px; }
        .title-section h1 { margin: 0; font-size: 16pt; font-weight: bold; }
        .title-section .address { font-size: 7pt; margin: 3px 0; line-height: 1.3; }
        
        .document-title { text-align: center; font-weight: bold; font-size: 11pt; margin: 15px 0; padding: 5px; }
        
        /* Student Info */
        .student-info { margin-bottom: 15px; font-size: 9pt; }
        .student-info table { width: 100%; border-collapse: collapse; }
        .student-info td { padding: 2px 0; }
        .student-info .label { width: 150px; }
        
        /* Grades Table */
        table.grades { width: 100%; border-collapse: collapse; margin: 15px 0; font-size: 8pt; }
        table.grades th, table.grades td { border: 1px solid #000; padding: 4px; }
        table.grades th { background: #d0d0d0; font-weight: bold; text-align: center; }
        table.grades td { text-align: center; }
        table.grades td.left { text-align: left; }
        table.grades.summary { margin-top: 5px; }
        table.grades.summary th, table.grades.summary td { background: #f0f0f0; font-weight: bold; }
        
        /* Footer */
        .footer { margin-top: 30px; }
        .signature-section { text-align: right; }
        .signature-section p { margin: 5px 0; }
        .signature-line { margin-top: 50px; border-top: 1px solid #000; width: 200px; display: inline-block; }
        
        .page-footer { position: fixed; bottom: 0; left: 0; right: 0; text-align: center; font-size: 7pt; padding: 10px; background: #003366; color: white; }
    </style>
</head>
<body>
    <!-- Header -->
    <div class="header-container">
        <div class="logo-section">
            <div class="logo" style="background: #003366; color: white; display: flex; align-items: center; justify-content: center; font-size: 20pt; font-weight: bold;">
                LP3I
            </div>
        </div>
        <div class="title-section">
            <h1>LP3I COLLEGE</h1>
            <div class="address">
                Gedung Karyajaya MH Thamrin No.8, Desa Panunggangan,<br>
                Kecamatan PH Lagaligo, Pinangsia, Kabupaten Karawang, Jawa Barat, 41361<br>
                Telepon: 021 2620 9090 - Email: lp3icollege@lp3i.ac.id
            </div>
        </div>
    </div>

    <div class="document-title">
        KARTU HASIL STUDI
    </div>

    <!-- Student Info -->
    <div class="student-info">
        <table>
            <tr>
                <td class="label">Nama</td>
                <td>: {{ $mahasiswa->nama }}</td>
            </tr>
            <tr>
                <td class="label">NIPD</td>
                <td>: {{ $mahasiswa->nipd }}</td>
            </tr>
            <tr>
                <td class="label">Tempat / Tanggal Lahir</td>
                <td>: {{ $mahasiswa->tempat_lahir ?? '- ' }} / {{ $mahasiswa->tanggal_lahir ? \Carbon\Carbon::parse($mahasiswa->tanggal_lahir)->format('d F Y') : '-' }}</td>
            </tr>
            <tr>
                <td class="label">Bidang Keahlian</td>
                <td>: {{ $mahasiswa->data_kelas->bidangKeahlian->nama ?? '-' }}</td>
            </tr>
        </table>
    </div>

    <!-- Grades by Semester -->
    @foreach($semesterData as $sem => $data)
        <div style="margin-top: 20px;">
            <strong>Semester {{ $sem }}</strong>
        </div>

        <table class="grades">
            <thead>
                <tr>
                    <th style="width: 40px;">NO</th>
                    <th>MATERI AJAR</th>
                    <th style="width: 50px;">SKS</th>
                    <th style="width: 80px;">Nilai<br>Angka</th>
                    <th style="width: 80px;">Nilai<br>Huruf</th>
                    <th style="width: 80px;">Kumulatif</th>
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
            </tbody>
        </table>

        <!-- Summary Table -->
        <table class="grades summary">
            <tr>
                <th style="width: 40%; text-align: left; padding-left: 10px;">JUMLAH</th>
                <th style="width: 15%;">{{ $data['total_sks'] }}</th>
                <th style="width: 45%; text-align: left;">Predikat: 
                    @if($data['ips'] >= 3.5) Memuaskan
                    @elseif($data['ips'] >= 3.0) Baik
                    @else Cukup
                    @endif
                </th>
            </tr>
            <tr>
                <td style="text-align: left; padding-left: 10px;">Nilai Prestasi Semester (IPS): <strong>{{ number_format($data['ips'], 2) }}</strong></td>
                <td colspan="2" style="text-align: left;">Indeks Prestasi Kumulatif (IPK): <strong>{{ number_format($data['ips'], 2) }}</strong></td>
            </tr>
        </table>
    @endforeach

    <!-- Footer -->
    <div class="footer">
        <div class="signature-section">
            <p>Karawang, {{ date('d F Y') }}</p>
            <p style="margin-top: 70px;">
                <span style="border-top: 1px solid #000; padding-top: 5px; display: inline-block; min-width: 200px;">
                    <strong>{{ $mahasiswa->data_kelas->nama_pa ?? 'Eko Marmanto P,U.B.Kom.,M.Kom.,MOS.' }}</strong><br>
                    <small>Head of Education</small>
                </span>
            </p>
        </div>
    </div>

    <div class="page-footer">
        #beranijournakilmu
    </div>

    <script>
        window.onload = function() { window.print(); }
    </script>
</body>
</html>
