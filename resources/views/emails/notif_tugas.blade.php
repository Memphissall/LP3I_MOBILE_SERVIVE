<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Notifikasi Tugas Baru</title>
    <style>
        body { 
                font-family: 'Poppins', Tahoma, Geneva, Verdana, sans-serif; 
                line-height: 1.6; 
                color: #333; 
            }
        .container { 
                width: 100%; 
                max-width: 600px; 
                margin: 0 auto; 
                border: 1px solid #e0e0e0;
                border-radius: 8px; 
                overflow: hidden; 
            }
        .header { 
                background-color: #004269; 
                color: #ffffff; 
                padding: 20px; 
                text-align: center; 
            }
        .content { 
                padding: 30px; 
            }
        .footer { background-color: #f9f9f9; color: #777; padding: 15px; text-align: center; font-size: 12px; }
        .button { display: inline-block; padding: 12px 25px; background-color: #007bff; color: #ffffff; text-decoration: none; border-radius: 5px; font-weight: bold; margin-top: 20px; }
        .info-table { width: 100%; margin-top: 20px; border-collapse: collapse; }
        .info-table td { padding: 8px 0; border-bottom: 1px solid #eee; }
        .label { font-weight: bold; width: 150px; }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>LP3I COLLEGE KARAWANG</h1>
        </div>
        <div class="content">
            <h2 style="color: #004269;">Halo, {{ ucfirst($mahasiswa->nama_mhs) }}!</h2>
            <p>Ada informasi tugas baru yang baru saja diunggah oleh dosen. Berikut detailnya:</p>
            
            <table class="info-table">
                <tr>
                    <td class="label">Mata Kuliah</td>
                    <td>: {{ $tugas->nama_mk }}</td>
                </tr>
                <tr>
                    <td class="label">Deadline</td>
                    <td>: <span style="color: #d9534f; font-weight: bold;">{{ $tugas->deadline }}</span></td>
                </tr>
            </table>

            <p style="margin-top: 20px;"><strong>Catatan Dosen:</strong><br>
            {{ $tugas->keterangan ?? 'Silakan cek detail tugas di portal E-Student.' }}</p>

            <div style="text-align: center;">
                <a href="{{ url('/') }}" class="button">Buka E-Student</a>
            </div>
        </div>
        <div class="footer">
            <p>&copy; {{ date('Y') }} LP3I College Karawang<br>
            Gedung Karawang Hijau, Jl. Tarumanegara No. 4-6</p>
        </div>
    </div>
</body>
</html>