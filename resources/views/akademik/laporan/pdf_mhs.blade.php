<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>{{ $title }}</title>
    <style>
        @page { margin: 1cm; }
        body { font-family: 'Helvetica', sans-serif; font-size: 12px; color: #333; margin: 0; padding: 0; width: 100%; }
        
        /* Kop Surat Center Total */
        .kop-surat { 
            border-bottom: 3px double #000; 
            padding-bottom: 10px; 
            margin-bottom: 20px; 
            text-align: center; 
            width: 100%;
        }
        .kop-surat h1 { margin: 0; font-size: 20px; text-transform: uppercase; color: #1e3a8a; }
        .kop-surat p { margin: 2px 0; font-size: 10px; color: #666; }

        /* Judul Laporan */
        .judul-container { text-align: center; margin-bottom: 25px; width: 100%; }
        .judul-container h2 { 
            margin: 0; 
            text-decoration: underline; 
            font-size: 16px; 
            text-transform: uppercase;
            display: inline-block; 
        }

        .info-cetak { font-size: 10px; color: #555; margin-bottom: 10px; text-align: right; }

        /* Tabel Data */
        table { width: 100%; border-collapse: collapse; margin-bottom: 30px; }
        table th { background-color: #f3f4f6; padding: 10px; border: 1px solid #d1d5db; text-transform: uppercase; font-size: 10px; }
        table td { padding: 8px; border: 1px solid #d1d5db; text-align: center; }
        .text-left { text-align: left; }

        /* Tanda Tangan */
        .footer-laporan { width: 100%; margin-top: 20px; }
        .ttd-box { float: right; width: 200px; text-align: center; }
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

    <div class="info-cetak">
        Dicetak pada: {{ $date }} <br>
        Oleh: Admin Akademik
    </div>

    <table>
        <thead>
            <tr>
                <th width="5%">No</th>
                <th width="15%">NIM</th>
                <th>Nama Mahasiswa</th>
                <th width="15%">Prodi</th>
                <th width="15%">Angkatan</th>
                <th width="10%">Status</th>
            </tr>
        </thead>
        <tbody>
            @forelse($items as $index => $mhs)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $mhs['nim'] }}</td>
                <td class="text-center">{{ $mhs['nama'] }}</td>
                <td>{{ $mhs['prodi'] }}</td>
                <td>{{ $mhs['angkatan'] }}</td>
                <td>{{ $mhs['status'] }}</td>
            </tr>
            @empty
            <tr>
                <td colspan="6">Data tidak ditemukan sesuai filter.</td>
            </tr>
            @endforelse
        </tbody>
    </table>

    <div class="footer-laporan">
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