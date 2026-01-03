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
            padding-bottom: 5px;
            border-bottom: 1px solid #000; 
            margin-bottom: 15px;
            position: relative; /* Patokan untuk logo absolute */
            min-height: 80px;   /* Menjaga tinggi kop agar tidak tertutup logo */
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
        .kop-text p { margin: 1.5px 0 0; font-size: 11px; font-style: italic; color: #555; padding-bottom: 2px; }
        
        /* REVISI: Logo sekarang mengunci ke pojok kiri kop-surat */
        .kop-text img { 
            position: absolute; 
            left: 0; 
            top: 55px; 
            transform: translateY(-50%); 
            width: 50px; 
            height: auto; 
            padding: 0; 
            margin: 0;
        }

        .judul-laporan {
            text-align: center;
            text-transform: uppercase;
            margin-top: 8px; 
            margin-bottom: 4px;
            font-size: 16px;
            font-weight: bold;
        }

        .info-cetak {
            text-align: right;
            font-size: 10px;
            margin-bottom: 4px;
            color: #666;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            table-layout: fixed;
        }
        
        th, td {
            border: 1px solid #444;
            padding: 4px 5px; 
            font-size: 10.5px; 
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

        .keep-together {
            page-break-inside: avoid !important;
            break-inside: avoid !important;
            display: block;
            width: 100%;
        }

        .signature-container {
            margin-top: 20px; 
            float: right; 
            width: 300px; 
            text-align: center;
        }

        .signature-wrapper {
            display: flex;
            align-items: flex-end;
            justify-content: center;
            margin-top: 40px; 
            margin-bottom: 2px;
            font-weight: bold;
            font-size: 15px;
        }

        .line-inside {
            border-bottom: 1.5px solid #000;
            width: 200px; 
            margin: 0 5px;
            height: 12px;
        }

        .signature-role { font-size: 11px; font-weight: bold; margin-top: 0; }

        @media print {
            @page { margin: 0.5cm 0.8cm; size: landscape; }
            thead { display: table-row-group; }
        }
    </style>
</head>
<body>

    <div class="print-container">
        <div class="kop-surat">
            <div class="kop-text">
                <img src="{{ asset('images/lp3i_krw.png') }}" alt="logo LP3I"> 
                <h1>LP3I COLLEGE KARAWANG</h1>
                <p>Gedung Karawang Hijau, Ruko Karawang Hijau, Jl. Tarumanagara No.4-6, Desa Purwadana</p>
                <p>Kecamatan Telukjambe Timur, Kabupaten Karawang, Jawa Barat 41361</p>
                <p>Telp: (0267) 411286 | Website: www.lp3i.ac.id | Email: info@lp3i.id</p>
            </div>
        </div>

        <div class="info-cetak" id="waktu-cetak">Dicetak pada: Memuat waktu...</div>

        <h3 class="judul-laporan">
            LAPORAN DATA MAHASISWA
            @php
                $filters = [];
                if(request('jurusan') && request('jurusan') !== '' && !str_contains(request('jurusan'), 'Semua')) $filters[] = 'Jurusan: ' . request('jurusan');
                if(request('angkatan') && request('angkatan') !== '' && !str_contains(request('angkatan'), 'Semua')) $filters[] = 'Angkatan: ' . request('angkatan');
                if(request('periode') && request('periode') !== '' && !str_contains(request('periode'), 'Semua')) $filters[] = 'Periode: ' . request('periode');
                if(request('kelas') && request('kelas') !== '' && !str_contains(request('kelas'), 'Semua')) {
                    $kelasName = \App\Models\Kelas::find(request('kelas'))?->nama_kelas ?? 'Kelas ' . request('kelas');
                    $filters[] = 'Kelas: ' . $kelasName;
                }
                $totalData = count($mahasiswa);
                $limitAwal = $totalData - 5; 
            @endphp
            @if(count($filters) > 0)
                <br><small style="font-size: 14px; font-weight: normal;">{{ implode(' | ', $filters) }}</small>
            @endif
        </h3>

        <table>
            <thead>
                <tr>
                    <th width="35">NO</th>
                    <th width="90">NIM / NIPD</th>
                    <th width="150">NAMA MAHASISWA</th>
                    <th width="130">JURUSAN</th>
                    <th width="70">ANGKATAN</th>
                    <th width="80">KELAS</th>
                    <th width="150">PEMBIMBING AKADEMIK</th>
                </tr>
            </thead>
            <tbody>
                @foreach($mahasiswa as $index => $mhs)
                    @if($index < $limitAwal)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td><b>{{ $mhs->nipd }}</b></td>
                        <td style="text-align: left;">{{ $mhs->nama }}</td>
                        <td>{{ $mhs->bidang_keahlian }}</td>
                        <td>{{ $mhs->angkatan }}</td>
                        <td>{{ $mhs->data_kelas->nama_kelas ?? '-' }}</td>
                        <td>{{ $mhs->data_kelas->nama_pa ?? '-' }}</td>
                    </tr>
                    @endif
                @endforeach
            </tbody>
        </table>

        <div class="keep-together">
            <table style="margin-top: -1px;"> <tbody>
                    @foreach($mahasiswa as $index => $mhs)
                        @if($index >= $limitAwal)
                        <tr>
                            <td width="35">{{ $index + 1 }}</td>
                            <td width="90"><b>{{ $mhs->nipd }}</b></td>
                            <td width="150" style="text-align: left;">{{ $mhs->nama }}</td>
                            <td width="130">{{ $mhs->bidangKeahlian->nama }}</td>
                            <td width="70">{{ $mhs->angkatan }}</td>
                            <td width="80">{{ $mhs->data_kelas->nama_kelas ?? '-' }}</td>
                            <td width="150">{{ $mhs->data_kelas->nama_pa ?? '-' }}</td>
                        </tr>
                        @endif
                    @endforeach
                    @if($totalData == 0)
                    <tr><td colspan="7" style="padding: 15px;">Data tidak ditemukan.</td></tr>
                    @endif
                </tbody>
            </table>

            <div class="signature-container">
                <p id="tanggal-ttd">Karawang, ...</p>
                <p>Staf Akademik,</p>
                <div class="signature-wrapper">
                    <span>(</span><div class="line-inside"></div><span>)</span>
                </div>
                <p class="signature-role">LP3I College Karawang</p>
            </div>
            <div style="clear: both;"></div>
        </div>
    </div>

    <script type="text/javascript">
        function updateTime() {
            const now = new Date();
            const optionsDate = { day: '2-digit', month: 'long', year: 'numeric' };
            const optionsTime = { hour: '2-digit', minute: '2-digit' };
            document.getElementById('waktu-cetak').innerHTML = `Dicetak pada: ${now.toLocaleDateString('id-ID', optionsDate)}, ${now.toLocaleTimeString('id-ID', optionsTime)} WIB`;
            document.getElementById('tanggal-ttd').innerHTML = `Karawang, ${now.toLocaleDateString('id-ID', optionsDate)}`;
        }
        window.onload = function() { updateTime(); setTimeout(() => window.print(), 800); }
    </script>
</body>
</html>