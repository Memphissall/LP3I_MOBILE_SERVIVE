<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>{{ $title }}</title>
    <style>
        /* Reset dasar agar tidak ada margin tak terduga */
        @page { margin: 1cm; }
        body { 
            font-family: 'Helvetica', sans-serif; 
            font-size: 12px; 
            color: #333; 
            margin: 0; 
            padding: 0; 
            width: 100%;
        }
        
        /* Kop Surat - Dipastikan Center Total */
        .kop-surat { 
            border-bottom: 3px double #000; 
            padding-bottom: 0px; 
            margin-bottom: 20px; 
            width: 100%;
            text-align: center; /* Menengahkan semua konten di dalamnya */
        }

        .kop-surat h1 { 
            margin: 0; 
            padding: 0;
            font-size: 22px; 
            text-transform: uppercase; 
            color: #1e3a8a; 
            width: 100%;
        }

        .kop-surat p { 
            margin: 2px 0; 
            padding: 0;
            font-size: 11px; 
            color: #444; 
            width: 100%;
        }

        /* Judul Laporan */
        .judul-container {
            text-align: center;
            width: 100%;
            margin-bottom: 30px;
        }

        .judul-container h2 { 
            margin: 0; 
            padding: 0;
            text-decoration: underline; 
            font-size: 16px; 
            text-transform: uppercase;
            display: inline-block;
        }

        /* Tabel - Ditengahkan dengan margin auto */
        table { 
            width: 100%; 
            border-collapse: collapse; 
            margin: 0 auto 30px auto; 
        }
        
        table th { 
            background-color: #f3f4f6; 
            padding: 10px; 
            border: 1px solid #d1d5db; 
            font-size: 10px; 
            text-transform: uppercase;
        }

        table td { 
            padding: 8px; 
            border: 1px solid #d1d5db; 
            text-align: center; 
        }
        
        .text-left { text-align: left; }

        /* Tanda Tangan */
        .footer-container {
            width: 100%;
            margin-top: 30px;
        }

        .ttd-box { 
            float: right; 
            width: 200px; 
            text-align: center; 
        }

        .ttd-space { height: 70px; }
        
        .clear { clear: both; }
    </style>
</head>
<body>
    <div class="kop-surat">
        <h1>LP3I COLLEGE KARAWANG</h1>
        <p>Kampus Utama: Jl. Kramat Raya No. 7-9, Jakarta Pusat</p>
        <p>Telp: (021) 31904150 | Email: info@lp3i.ac.id | Web: www.lp3i.ac.id</p>
    </div>

    <div class="judul-container">
        <h2>{{ $title }}</h2>
    </div>

    <table>
        <thead>
            <tr>
                <th width="5%">No</th>
                <th width="15%">NIDN</th>
                <th>Nama Dosen</th>
                <th width="15%">Jabatan</th>
                <th width="15%">Prodi</th>
                <th width="10%">Pend.</th>
            </tr>
        </thead>
        <tbody>
            @forelse($items as $index => $dsn)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $dsn['nidn'] }}</td>
                <td class="text-left">{{ $dsn['nama'] }}</td>
                <td>{{ $dsn['jabatan'] }}</td>
                <td>{{ $dsn['prodi'] }}</td>
                <td>{{ $dsn['pendidikan'] }}</td>
            </tr>
            @empty
            <tr>
                <td colspan="6">Data tidak ditemukan sesuai filter.</td>
            </tr>
            @endforelse
        </tbody>
    </table>

    <div class="footer-container">
        <div class="ttd-box">
            <p>Jakarta, {{ $date }}</p>
            <p><strong>Kepala Bagian Akademik</strong></p>
            <div class="ttd-space"></div>
            <p><u>( Nama Pejabat )</u><br>NIP. 198001012005011001</p>
        </div>
        <div class="clear"></div>
    </div>
</body>
</html>