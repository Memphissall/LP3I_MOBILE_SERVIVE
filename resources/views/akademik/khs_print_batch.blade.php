<!DOCTYPE html>
<html>
<head>
    <title>KHS Batch Print</title>
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
            color: black;
            box-sizing: border-box;
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
            width: 85px;
        }

        .kop-logo-container img {
            width: 100%;
            height: auto;
            object-fit: contain;
        }

        .kop-text-container {
            text-align: center;
            width: 100%;
        }

        .line-separator {
            border-top: 3px solid #000;
            border-bottom: 1px solid #000;
            height: 2px;
            margin-bottom: 25px;
            /* Jarak agar garis tidak menabrak logo di kiri */
            /* margin-left: 95px;  */
            width: auto;
            position: relative;
            z-index: 10;
        }

        /* === TABLE BIODATA === */
        .table-biodata { width: 100%; border-collapse: collapse; font-size: 10pt; margin-bottom: 20px; position: relative; z-index: 10; }
        .table-biodata td { 
            padding: 4px 0;
            vertical-align: top;
            line-height: 1.5;
        }
        .col-label { width: 160px; font-weight: 500; }
        .col-separator { width: 15px; text-align: center; }
        .col-value { font-weight: 700; }

        /* === TABLE NILAI === */
        .table-surat { width: 100%; border-collapse: collapse; font-size: 10pt; line-height: 1.3; margin-top: 10px; position: relative; z-index: 10; background: transparent; }
        .table-surat th { background-color: rgba(240, 240, 240, 0.9) !important; font-weight: 700; text-align: center; vertical-align: middle; padding: 8px 5px; border: 1px solid #000; }
        .table-surat td { padding: 6px 8px; border: 1px solid #000; vertical-align: middle; }

        .tegak { font-style: normal !important; position: relative; z-index: 10; }

        /* === PRINT STYLES === */
        @media print {
            @page { size: A4; margin: 0; }
            body, html { width: 100%; height: 100%; background: white !important; }
            
            .paper-a4 { 
                width: 100% !important; 
                height: auto !important; 
                margin: 0 !important; 
                padding: 15mm !important; 
                box-shadow: none !important; 
                border: none !important; 
                page-break-after: always;
            }
            .paper-a4:last-child {
                page-break-after: auto;
            }

            * { 
                -webkit-print-color-adjust: exact !important; 
                print-color-adjust: exact !important; 
            }
        }

        /* === SCREEN PREVIEW === */
        @media screen {
            body { background: #1a1a2e; padding: 20px; }
            .paper-a4 { 
                box-shadow: 0 0 30px rgba(0,0,0,0.3);
                margin-bottom: 30px;
            }
        }
    </style>
</head>
<body>
    @foreach($batchData as $data)
        @php
            $mahasiswa = $data['mahasiswa'];
            $semesterData = $data['semesterData'];
        @endphp

        <div class="paper-a4">
            
            {{-- === WATERMARK BACKGROUND === --}}
            <div style="position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%); width: 70%; z-index: 0; opacity: 0.10; pointer-events: none;">
                <img src="{{ asset('/images/lp3i-college-putih.png') }}" style="width: 100%; height: auto; object-fit: contain; mix-blend-multiply: multiply;">
            </div>

            {{-- === KONTEN SURAT === --}}
            <div class="relative z-10">

                {{-- KOP SURAT --}}
                <div class="kop-wrapper">
                    <div class="kop-logo-container">
                        <img src="{{ asset('/images/lp3i-college-putih.png') }}" alt="Logo">
                    </div>
                    
                    <div class="kop-text-container">
                        <h1 style="font-size: 20pt; font-weight: 800; color: #004269; margin: 0; line-height: 1;">
                            LP3I COLLEGE KARAWANG
                        </h1>
                        <p style="font-size: 9pt; margin: 6px 0 0 0; line-height: 1.4; font-weight: 400;">
                            Gedung Karawang Hijau, Jl. Tarumanegara No. 4-6, Desa Purwadana,<br>
                            Kecamatan Telukjambe Timur, Kabupaten Karawang, Jawa Barat 41361<br>
                            Telp (0267) 411286
                        </p>
                    </div>
                </div>
                
                <div class="line-separator"></div>

                {{-- JUDUL --}}
                <div style="font-size: 14pt; font-weight: 700; text-decoration: underline; text-transform: uppercase; text-align: center; margin-bottom: 5px;" class="tegak">
                    KARTU HASIL STUDI (KHS)
                </div>
                <div style="font-size: 11pt; font-weight: 600; text-align: center; margin-bottom: 20px; text-transform: uppercase;" class="tegak">
                    TAHUN AKADEMIK {{ $tahun_akademik ?? date('Y') . '/' . (date('Y') + 1) }}
                </div>

                {{-- BIODATA --}}
                <table class="table-biodata">
                    <tr>
                        <td class="col-label">NIPD</td>
                        <td class="col-separator">:</td>
                        <td class="col-value">{{ $mahasiswa->nipd }}</td>
                    </tr>
                    <tr>
                        <td class="col-label">Nama</td>
                        <td class="col-separator">:</td>
                        <td class="col-value">{{ ucfirst($mahasiswa->nama_mhs ?? $mahasiswa->nama) }}</td>
                    </tr>
                    <tr>
                        <td class="col-label">Tempat, Tanggal Lahir</td>
                        <td class="col-separator">:</td>
                        <td class="col-value">{{ $mahasiswa->tempat_lahir ?? '-' }} / {{ $mahasiswa->tgl_lahir ? \Carbon\Carbon::parse($mahasiswa->tgl_lahir)->translatedFormat('d F Y') : '-' }}</td>
                    </tr>
                    <tr>
                        <td class="col-label">Bidang Keahlian</td>
                        <td class="col-separator">:</td>
                        <td class="col-value">{{ ucfirst($mahasiswa->data_kelas->programStudi->nama_program_studi ?? ($mahasiswa->data_kelas->programStudi->nama ?? '-')) }}</td>
                    </tr>
                </table>

                {{-- TABLE NILAI PER SEMESTER --}}
                @forelse($semesterData as $sem => $semData)
                    <table class="table-surat">
                        <thead>
                            <tr>
                                <td colspan="6" style="padding: 6px 10px; font-weight: 700; background-color: rgba(230, 230, 230, 0.8); text-transform: uppercase; font-size: 9pt; border: 1px solid #000;" class="tegak">
                                    Semester {{ $sem }}
                                </td>
                            </tr>
                            <tr>
                                <th style="width: 40px;">No</th>
                                <th style="text-align: left; padding-left: 10px;">Materi Ajar</th>
                                <th style="width: 50px;">SKS</th>
                                <th style="width: 60px;">Angka</th>
                                <th style="width: 60px;">Huruf</th>
                                <th style="width: 80px;">Mutu</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php 
                                $no = 1; 
                                $totalSks = $semData['total_sks'] ?? 0; 
                                $totalMutu = 0; 
                            @endphp
                            
                            @foreach($semData['nilai'] as $nilai)
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
                                <td style="padding-left: 10px;">
                                    <div style="font-weight: 600; font-size: 9pt;">{{ $nilai->mataKuliah->nama_mk ?? $nilai->materiAjar->nama_mk ?? $nilai->kode_mk }}</div>
                                </td>
                                <td style="text-align: center;">{{ $sks }}</td>
                                <td style="text-align: center;">{{ number_format($angka, 1) }}</td>
                                <td style="text-align: center; font-weight: 700;">{{ $huruf }}</td>
                                <td style="text-align: center;">{{ number_format($mutu, 1) }}</td>
                            </tr>
                            @endforeach

                            <tr style="background-color: rgba(245, 245, 245, 0.8); font-weight: 700;">
                                <td colspan="2" style="text-align: right; padding-right: 15px;">TOTAL</td>
                                <td style="text-align: center;">{{ $totalSks }}</td>
                                <td colspan="2" style="background-color: rgba(233, 236, 239, 0.8);"></td>
                                <td style="text-align: center;">{{ number_format($totalMutu, 1) }}</td>
                            </tr>
                        </tbody>
                    </table>

                    {{-- SUMMARY IPS --}}
                    <div style="margin-top: 20px; border: 1px solid #000; padding: 12px 20px; display: flex; justify-content: space-between; align-items: center; background-color: rgba(255, 255, 255, 0.8);">
                        <div style="font-size: 10pt;">
                            <strong>IPS (Indeks Prestasi Semester) :</strong> 
                            <span style="font-size: 12pt; font-weight: 800; margin-left: 8px;">
                                {{ number_format($semData['ips'] ?? ($totalSks > 0 ? $totalMutu / $totalSks : 0), 2) }}
                            </span>
                        </div>
                        <div style="font-size: 10pt;">
                            <strong>Predikat :</strong> 
                            <span style="font-weight: 600; margin-left: 5px;">
                                @php
                                    $ips = $semData['ips'] ?? ($totalSks > 0 ? $totalMutu / $totalSks : 0);
                                @endphp
                                @if($ips >= 3.5) Sangat Memuaskan
                                @elseif($ips >= 3.0) Memuaskan
                                @elseif($ips >= 2.5) Baik
                                @else Cukup
                                @endif
                            </span>
                        </div>
                    </div>
                @empty
                    {{-- Empty State --}}
                    <div style="text-align: center; padding: 20px; border: 1px solid #000; font-style: italic;">
                        Belum ada data nilai.
                    </div>
                @endforelse

                {{-- TANDA TANGAN --}}
                <div style="margin-top: 50px; display: flex; justify-content: flex-end;">
                    <div style="text-align: center; min-width: 250px;">
                        <p style="margin-bottom: 60px;">Karawang, {{ now()->translatedFormat('d F Y') }}</p>
                        <p style="font-weight: 700; text-decoration: underline; font-size: 10pt; margin: 0;">
                            {{ $mahasiswa->data_kelas->pendidik->nama_pendidik ?? 'Eko Marmanto P.U, S.Kom.,M.Kom.,MOS. CDMP' }}
                        </p>
                        <p style="font-size: 9pt; margin: 5px 0 0 0;">Head of Education</p>
                    </div>
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