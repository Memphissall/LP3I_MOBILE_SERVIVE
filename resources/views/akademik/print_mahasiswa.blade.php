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
            margin: 0;
            padding: 0;
            color: #333;
            background-color: white;
        }

        .print-container {
            padding: 0.4cm 1.5cm; /* DIET TOTAL: Margin atas sangat tipis */
        }

        /* KOP SURAT */
        .kop-surat {
            display: flex;
            align-items: center;
            justify-content: center;
            border-bottom: 3px solid #000080; 
            padding-bottom: 6px; 
            margin-bottom: 6px;
        }
        .kop-text { text-align: center; }
        .kop-text h1 { margin: 0; font-size: 24px; text-transform: uppercase; color: #000066; letter-spacing: 1px; }
        .kop-text p { margin: 1px 0 0; font-size: 11px; font-style: italic; color: #555; }

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

        /* TABEL SETTINGS */
        table {
            width: 100%;
            border-collapse: collapse;
            table-layout: fixed;
        }
        
        th, td {
            border: 1px solid #444;
            padding: 3px 5px; /* DIET EKSTRIM: Padding sangat tipis agar muat banyak baris */
            font-size: 10.5px; /* Sedikit lebih kecil agar teks tidak sesak */
            text-align: center;
            word-wrap: break-word;
        }

        th {
            background-color: #E6F0FF !important; 
            color: #000066 !important;
            text-transform: uppercase;
            font-weight: bold;
            -webkit-print-color-adjust: exact; 
            print-color-adjust: exact;
        }

        /* TANDA TANGAN */
        .signature-container {
            margin-top: 10px; /* Sangat rapat dengan tabel */
            float: right; 
            width: 300px; 
            text-align: center;
            page-break-inside: avoid;
        }

        .signature-wrapper {
            display: flex;
            align-items: flex-end;
            justify-content: center;
            margin-top: 40px; /* DIET: Ruang tanda tangan dibuat minimalis */
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

        .signature-role {
            font-size: 11px;
            font-weight: bold;
            margin-top: 0;
        }

        @media print {
            @page {
                margin: 0.3cm 0.8cm; 
                size: landscape;
            }

            thead {
                display: table-header-group; 
            }

            th {
                background-color: #E6F0FF !important;
                -webkit-print-color-adjust: exact;
                print-color-adjust: exact;
            }
        }
    </style>
</head>
<body>

    <div class="print-container">
        <div class="kop-surat">
            <div class="kop-text">
                <h1>LP3I COLLEGE KARAWANG</h1>
                <p>Jl. Arteri Galuh Mas, Telukjambe Timur, Karawang, Jawa Barat</p>
                <p>Telp: (0267) 840xxxx | Website: www.lp3i.ac.id | Email: info@karawang.lp3i.ac.id</p>
            </div>
        </div>

        <div class="info-cetak" id="waktu-cetak">
            Dicetak pada: Memuat waktu...
        </div>

    <h3 class="judul-laporan">
        LAPORAN DATA MAHASISWA
        @php
            $filters = [];
            if(request('jurusan') && request('jurusan') !== '' && !str_contains(request('jurusan'), 'Semua')) {
                $filters[] = 'Jurusan: ' . request('jurusan');
            }
            if(request('angkatan') && request('angkatan') !== '' && !str_contains(request('angkatan'), 'Semua')) {
                $filters[] = 'Angkatan: ' . request('angkatan');
            }
            if(request('periode') && request('periode') !== '' && !str_contains(request('periode'), 'Semua')) {
                $filters[] = 'Periode: ' . request('periode');
            }
            if(request('kelas') && request('kelas') !== '' && !str_contains(request('kelas'), 'Semua')) {
                $kelasName = \App\Models\Kelas::find(request('kelas'))?->nama_kelas ?? 'Kelas ' . request('kelas');
                $filters[] = 'Kelas: ' . $kelasName;
            }
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
                @forelse($mahasiswa as $index => $mhs)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td><b>{{ $mhs->nipd }}</b></td>
                    <td style="text-align: left;">{{ $mhs->nama }}</td>
                    <td>{{ $mhs->jurusan }}</td>
                    <td>{{ $mhs->angkatan }}</td>
                    <td>{{ $mhs->data_kelas->nama_kelas ?? '-' }}</td>
                    <td>{{ $mhs->data_kelas->nama_pa ?? '-' }}</td>
                </tr>
                @empty
                <tr>
                    <td colspan="7" style="padding: 15px;">Data tidak ditemukan.</td>
                </tr>
                @endforelse
            </tbody>
        </table>

        <div class="signature-container">
            <p id="tanggal-ttd">Karawang, ...</p>
            <p>Staf Akademik,</p>
            
            <div class="signature-wrapper">
                <span>(</span>
                <div class="line-inside"></div>
                <span>)</span>
            </div>
            
            <p class="signature-role">LP3I College Karawang</p>
        </div>

        <div style="clear: both;"></div>
    </div>

    <script type="text/javascript">
        function updateTime() {
            const now = new Date();
            const optionsDate = { day: '2-digit', month: 'long', year: 'numeric' };
            const optionsTime = { hour: '2-digit', minute: '2-digit' };
            
            const tanggalIndo = now.toLocaleDateString('id-ID', optionsDate);
            const waktuIndo = now.toLocaleTimeString('id-ID', optionsTime);

            document.getElementById('waktu-cetak').innerHTML = `Dicetak pada: ${tanggalIndo}, ${waktuIndo} WIB`;
            document.getElementById('tanggal-ttd').innerHTML = `Karawang, ${tanggalIndo}`;
        }

        window.onload = function() {
            updateTime();
            setTimeout(function() {
                window.print();
            }, 800); 
        }
    </script>
</body>
</html>