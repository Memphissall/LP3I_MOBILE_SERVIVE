<!DOCTYPE html>
<html>
<head>
    <title>KHS - {{ $mahasiswa->nama }}</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap');

        /* Margin nol agar border navy mepet ke tepi kertas */
        @page { size: A4; margin: 0; } 
        
        body { 
            font-family: Arial, sans-serif; 
            font-size: 9pt; 
            margin: 0; padding: 0; 
            -webkit-print-color-adjust: exact !important;
            print-color-adjust: exact !important;
        }

        /* Tombol Print yang melayang */
        .btn-print {
            position: fixed;
            top: 20px;
            right: 20px;
            padding: 10px 20px;
            background: #000066;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-weight: bold;
            z-index: 9999;
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
        }

        /* Container dengan bingkai Navy Tebal */
        .page-container { 
            padding: 15mm 15mm; 
            position: relative; 
            min-height: 297mm; 
            background: white;
            box-sizing: border-box;
            border-top: 15px solid #000066 !important; 
            border-bottom: 15px solid #000066 !important; 
        }
        
        /* Kop Surat dengan Double Line (Tebal & Tipis) */
        .header-content { 
            text-align: center; 
            padding-bottom: 5px;
            border-bottom: 1px solid #000; 
            margin-bottom: 20px;
            position: relative; /* Patokan untuk logo absolute */
            min-height: 80px; /* Memberi ruang agar header tidak menciut */
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        /* REVISI: Styling Logo Pojok Kiri */
        .header-logo {
            position: absolute;
            left: 0;
            top: 30px;
            transform: translateY(-50%);
            width: 60px;
            height: auto;
        }

        .header-content::after {
            content: "";
            display: block;
            position: absolute;
            bottom: 2px;
            left: 0;
            right: 0;
            border-bottom: 3px solid #000; 
        }

        .header-content h1 { 
            margin: 0; font-size: 16pt; color: #000066 !important; 
            font-weight: bold; text-transform: uppercase;
        }

        .header-content .address { font-size: 7.5pt; margin: 3px 0; color: #000; padding-bottom: 10px; }

        .document-title { 
            text-align: center; font-weight: bold; font-size: 11pt; 
            margin: 15px 0; text-decoration: underline; text-transform: uppercase;
        }
        
        /* Student Info */
        .student-info { margin-bottom: 15px; font-size: 9pt; }
        .student-info table { width: 100%; border-collapse: collapse; }
        .student-info td { padding: 2px 0; }
        .student-info .label { width: 150px; }
        
        /* Grades Table dengan Header Abu-abu */
        table.grades { width: 100%; border-collapse: collapse; margin: 15px 0; font-size: 8pt; border: 1px solid #000; }
        table.grades th, table.grades td { border: 1px solid #000; padding: 4px; }
        table.grades th { 
            box-shadow: inset 0 0 0 1000px #a6a6a6 !important; 
            background-color: #a6a6a6 !important; 
            font-weight: bold; text-align: center; 
        }
        table.grades td { text-align: center; }
        table.grades td.left { text-align: left; }

        /* Summary Table */
        table.grades.summary { margin-top: 5px; }
        table.grades.summary th, table.grades.summary td { background: #f0f0f0; font-weight: bold; }
        
        /* Footer & Signature */
        .footer-section { margin-top: 30px; }
        .signature-section { text-align: right; }
        .signature-section p { margin: 5px 0; }
        
        .page-footer-hashtag { 
            position: absolute; bottom: 20px; left: 0; right: 0; 
            text-align: center; font-size: 8pt; font-weight: bold; 
        }

        /* Sembunyikan tombol saat print */
        @media print {
            .btn-print { display: none; }
        }
    </style>
</head>
<body>
    <button class="btn-print" onclick="window.print()">Cetak PDF</button>

    <div class="page-container">
        <div class="header-content">
            <img src="{{ asset('images/lp3i_krw.png') }}" class="header-logo" alt="logo LP3I">
            
            <h1>LP3I COLLEGE KARAWANG</h1>
            <div class="address">
                 Gedung Karawang Hijau, Ruko Karawang Hijau, Jl. Tarumanagara No.4-6, Desa Purwadana,<br>
                Kecamatan Telukjambe Timur, Kab. Karawang, Jawa Barat. <br>
                Telepon: (0267) 411286 - Email: info@lp3i.id
            </div>
        </div>

        <div class="document-title">KARTU HASIL STUDI</div>

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

        <div class="footer-section">
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

        <div class="page-footer-hashtag">
            #beranipunyaskill
        </div>
    </div>

    <script>
        window.onload = function() { window.print(); }
    </script>
</body>
</html>