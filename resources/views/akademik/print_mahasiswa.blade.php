<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cetak Laporan Mahasiswa - LP3I</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap');

        body {
            font-family: 'Poppins', sans-serif;
            margin:0px;
            padding: 0;
            color: #333;
            background-color: white;
        }

        .print-container {
            padding: 0.4cm 1.5cm;
        }

        .kop-surat {
            text-align: center;
            padding-bottom: 3px;
            border-bottom: 1px solid #000; 
            margin-bottom: 8px;
            position: relative;
            min-height: 70px;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        .kop-surat::after {
            content: "";
            display: block;
            position: absolute;
            bottom: 2px;
            left: 0;
            right: 0;
            border-bottom: 3px solid #000;
        }

        .kop-text h1 { margin: 0; font-size: 24px; text-transform: uppercase; color: #000066; }
        .kop-text p { margin: 1.5px 0 0; font-size: 11px; color: #555; padding-bottom: 2px; }
        
        .kop-text img { 
            position: absolute; 
            left: 0; 
            top: 48px; 
            transform: translateY(-50%); 
            width: 48px; 
            height: auto; 
            padding: 0; 
            margin: 0;
        }

        .judul-laporan {
            text-align: center;
            text-transform: uppercase;
            margin-top: 5px; 
            margin-bottom: 3px;
            font-size: 15px;
            font-weight: bold;
        }

        .info-cetak {
            text-align: right;
            font-size: 10px;
            margin-bottom: 4px;
            color: #666;
        }

        /* Updated CSS for Compactness and Pagination */
        table {
            width: 100%;
            border-collapse: collapse;
            table-layout: fixed;
            border-bottom: 1px solid #444; /* Changed to 1px to match */
        }
        
        th, td {
            border: 1px solid #444;
            padding: 2px 3px;
            font-size: 9pt;
            line-height: 1.15;
            text-align: center;
            word-wrap: break-word;
        }

        th {
            background-color: #E6F0FF !important; 
            color: #000066 !important;
            text-transform: uppercase;
            font-weight: bold;
            -webkit-print-color-adjust: exact; 
        }

        /* Repeating Header on New Pages */
        @media print {
            @page { margin: 5mm; size: landscape; }
            thead { display: table-header-group; } /* allows browser to repeat header automatically */
            tr { page-break-inside: avoid; }
        }

        .signature-container {
            margin-top: 8px; 
            float: right; 
            width: 280px; 
            text-align: center;
            page-break-inside: avoid;
        }

        .signature-wrapper {
            display: flex;
            align-items: flex-end;
            justify-content: center;
            margin-top: 30px; 
            margin-bottom: 2px;
            font-weight: bold;
            font-size: 14px;
        }

        .line-inside {
            border-bottom: 1.5px solid #000;
            width: 200px; 
            margin: 0 5px;
            height: 12px;
        }

        .signature-role { font-size: 11px; font-weight: bold; margin-top: 0; }
    </style>
</head>
<body>

    <div class="print-container">

        @php
            // Sort by Nama Kelas first for ordered output
            $sortedMahasiswa = $mahasiswa->sortBy(function($m) {
                return $m->data_kelas?->nama_kelas ?? 'Z-Unassigned';
            });
            
            // Group by Class ID
            $groupedMahasiswa = $sortedMahasiswa->groupBy(function($m) {
                return $m->data_kelas?->id_kelas ?? 'Unassigned';
            });
            
            $perPage = 15; // Increased to 15 to fit more rows and prevent single-row orphans
        @endphp

        @if(count($mahasiswa) > 0)
            @foreach($groupedMahasiswa as $classId => $studentsInClass)
                @php
                    $firstStudent = $studentsInClass->first();
                    
                    // Safe access to Class Info using optional chaining
                    $namaKelas = $firstStudent->data_kelas?->nama_kelas ?? 'Tidak Diketahui';
                    $namaJurusan = $firstStudent->data_kelas?->programStudi?->nama_program_studi ?? '-';
                    $namaPA = $firstStudent->data_kelas?->pendidik?->nama_pendidik ?? '-';
                @endphp

                <div class="page-container" style="page-break-after: {{ $loop->last ? 'auto' : 'always' }}; position: relative;">
                    <table>
                        {{-- Column widths --}}
                        <colgroup>
                            <col style="width: 40px;">
                            <col style="width: 90px;">
                            <col style="width: 150px;">
                            <col style="width: 130px;">
                            <col style="width: 110px;">
                            <col style="width: 170px;">
                            <col style="width: 100px;">
                            <col style="width: 160px;">
                        </colgroup>
                        
                        <thead>
                            <!-- TABLE HEADER GROUP ensures these repeat on new pages -->
                            <tr>
                                <th colspan="8" style="border: none; padding: 0; background: white !important;">
                                    <!-- Kop Surat -->
                                    <div class="kop-surat">
                                        <div class="kop-text">
                                            <img src="{{ asset('images/lp3i_krw.png') }}" alt="logo LP3I"> 
                                            <h1>LP3I COLLEGE KARAWANG</h1>
                                            <p>Gedung Karawang Hijau, Ruko Karawang Hijau, Jl. Tarumanagara No.4-6, Desa Purwadana</p>
                                            <p>Kecamatan Telukjambe Timur, Kabupaten Karawang, Jawa Barat 41361</p>
                                            <p>Telp: (0267) 411286 | Website: www.lp3i.ac.id | Email: info@lp3i.id</p>
                                        </div>
                                    </div>

                                    <div class="info-cetak" style="text-align: right; font-size: 10px; color: #666; margin-bottom: 4px; font-weight: normal;">
                                        <span id="waktu-cetak-{{ $loop->index }}">Dicetak pada: Memuat waktu...</span>
                                    </div>

                                    <h3 class="judul-laporan" style="color: black !important;">LAPORAN DATA MAHASISWA AKTIF</h3>

                                    <!-- Class Info Header -->
                                    <div style="font-size: 10pt; margin-top: 5px; margin-bottom: 5px; font-weight: bold; border-bottom: 1px dashed #ccc; padding-bottom: 5px; overflow: hidden; color: black !important;">
                                        <div style="float: left;">
                                            <table style="width: auto; border: none;">
                                                <tr>
                                                    <td style="border: none; padding: 1px 5px 1px 0; white-space: nowrap; min-width: 80px; text-align: left;">KELAS</td>
                                                    <td style="border: none; padding: 1px 5px; text-align: center;">:</td>
                                                    <td style="border: none; padding: 1px 0; text-align: left; white-space: nowrap;">{{ $namaKelas }}</td>
                                                </tr>
                                                <tr>
                                                    <td style="border: none; padding: 1px 5px 1px 0; white-space: nowrap; text-align: left;">DOSEN PA</td>
                                                    <td style="border: none; padding: 1px 5px; text-align: center;">:</td>
                                                    <td style="border: none; padding: 1px 0; text-align: left; white-space: nowrap;">{{ $namaPA }}</td>
                                                </tr>
                                            </table>
                                        </div>
                                        <div style="float: right;">
                                            <table style="width: auto; border: none;">
                                                <tr>
                                                    <td style="border: none; padding: 1px 5px 1px 0; white-space: nowrap; text-align: left;">PROGRAM STUDI</td>
                                                    <td style="border: none; padding: 1px 5px; text-align: center;">:</td>
                                                    <td style="border: none; padding: 1px 0; text-align: left; white-space: nowrap;">{{ $namaJurusan }}</td>
                                                </tr>
                                            </table>
                                        </div>
                                    </div>
                                </th>
                            </tr>
                            <tr>
                                <th>NO</th>
                                <th>NIPD</th>
                                <th>NAMA MAHASISWA</th>
                                <th>TEMPAT LAHIR</th>
                                <th>TANGGAL LAHIR</th>
                                <th>ALAMAT</th>
                                <th>NO TELP</th>
                                <th>EMAIL</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($studentsInClass as $index => $mhs)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td><b>{{ $mhs->nipd }}</b></td>
                                <td style="text-align: left;">{{ $mhs->nama_mhs }}</td>
                                <td>{{ $mhs->tempat_lahir }}</td>
                                <td>{{ $mhs->tgl_lahir ? \Carbon\Carbon::parse($mhs->tgl_lahir)->format('d-m-Y') : '-' }}</td>
                                <td>{{ $mhs->alamat }}</td>
                                <td>{{ $mhs->no_tlp }}</td>
                                <td>{{ $mhs->email }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>

                    {{-- Signature only on last page of the class --}}
                    <div class="signature-container" style="page-break-inside: avoid;">
                        <p class="tanggal-ttd">Karawang, ...</p>
                        <p>Staf Akademik,</p>
                        <div class="signature-wrapper">
                            <span>(</span><div class="line-inside"></div><span>)</span>
                        </div>
                        <p class="signature-role">LP3I College Karawang</p>
                    </div>
                    <div style="clear: both;"></div>

                </div>
            @endforeach
        @endif

        @if(count($mahasiswa) == 0)
            <table>
                <thead>
                    <tr>
                        <th width="35">NO</th>
                        <th width="85">NIPD</th>
                        <th width="140">NAMA MAHASISWA</th>
                        <th width="120">TEMPAT LAHIR</th>
                        <th width="100">TANGGAL LAHIR</th>
                        <th width="150">ALAMAT</th>
                        <th width="90">NO TELP</th>
                        <th width="150">EMAIL</th>
                        <th width="70">STATUS</th>
                    </tr>
                </thead>
                <tbody>
                    <tr><td colspan="8" style="padding: 15px;">Data tidak ditemukan.</td></tr>
                </tbody>
            </table>
        @endif
    </div>

    <script type="text/javascript">
        function updateTime() {
            const now = new Date();
            const optionsDate = { day: '2-digit', month: 'long', year: 'numeric' };
            const optionsTime = { hour: '2-digit', minute: '2-digit' };
            const dateStr = now.toLocaleDateString('id-ID', optionsDate);
            const timeStr = now.toLocaleTimeString('id-ID', optionsTime);
            
            // Update all print time elements
            document.querySelectorAll('[id^="waktu-cetak-"]').forEach(el => {
                el.innerHTML = `Dicetak pada: ${dateStr}, ${timeStr} WIB`;
            });
            
            // Update all signature dates
            document.querySelectorAll('.tanggal-ttd').forEach(el => {
                el.innerHTML = `Karawang, ${dateStr}`;
            });
        }
        window.onload = function() { updateTime(); setTimeout(() => window.print(), 800); }
    </script>
</body>
</html>