<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Surat Pengantar - LP3I College</title>
    <style>
        * { box-sizing: border-box; margin: 0; padding: 0; }

        body {
            font-family: Arial, Helvetica, sans-serif;
            font-size: 11pt;
            color: #1a1a1a;
            background: #e0e0e0;
            line-height: 1.4;
        }

        @page {
            size: A4 portrait;
            margin: 0;
        }

        @media print {
            body { background: white; margin: 0; padding: 0; -webkit-print-color-adjust: exact; print-color-adjust: exact; }
            .no-print { display: none !important; }
            .page { box-shadow: none; margin: 0; }
        }

        .page {
            width: 210mm;
            min-height: 297mm;
            margin: 0 auto; /* Hilangkan margin atas layar */
            background: white;
            display: flex;
            flex-direction: column;
            overflow: hidden;
            position: relative;
            box-shadow: 0 4px 20px rgba(0,0,0,0.15);
        }

        /* ============================
           LEFT DECORATION (SVG)
        ============================ */
        .left-deco {
            position: absolute;
            top: 0;
            left: 0;
            z-index: 0;
        }

        /* ============================
           CONTENT AREA
        ============================ */
        .content-area {
            position: relative;
            z-index: 1;
            padding: 15mm 20mm 10mm 25mm; /* Kiri agak lebar untuk spasi */
            flex: 1;
            display: flex;
            flex-direction: column;
        }

        /* ============================
           KOP SURAT (LOGOS)
        ============================ */
        .kop-surat {
            display: flex;
            justify-content: flex-end; /* Logo di kanan */
            align-items: center;
            margin-bottom: 5mm; /* DIKURANGI SIGNIFIKAN BIAR MUAT 1 HALAMAN */
            padding-right: 5mm;
        }
        .kop-surat img {
            height: 65px; /* Sesuaikan ukuran logo */
            width: auto;
            object-fit: contain;
        }

        /* ============================
           SURAT BODY
        ============================ */
        .surat-body {
            font-family: Arial, Helvetica, sans-serif;
            font-size: 11pt;
            line-height: 1.6;
        }

        /* Tanggal & Nomor */
        .tanggal-nomor { margin-bottom: 5mm; }
        .tanggal-nomor p { margin: 0; }

        /* Tujuan Surat */
        .tujuan { margin-bottom: 5mm; }
        .tujuan p { margin: 0; }
        .tujuan .bold { font-weight: bold; }

        /* Perihal / Lampiran */
        .info-table { margin-bottom: 5mm; }
        .info-table table { border-collapse: collapse; }
        .info-table td { padding: 1px 0; vertical-align: top; }
        .info-table .lbl { width: 85px; }
        .info-table .sep { width: 15px; text-align: center; }

        /* Salam */
        .salam { font-style: italic; }
        .salam-buka { margin-bottom: 3mm; }
        .salam-tutup { margin-top: 3mm; margin-bottom: 3mm; }

        .hormat-line { margin-bottom: 3mm; }

        /* Isi Surat */
        .isi-surat { text-align: justify; margin-bottom: 3mm; }

        /* Detail Kegiatan */
        .kegiatan-table { margin-bottom: 4mm; margin-left: 0; }
        .kegiatan-table table { border-collapse: collapse; }
        .kegiatan-table td { padding: 2px 0; vertical-align: top; }
        .kegiatan-table .lbl { width: 110px; }
        .kegiatan-table .sep { width: 15px; text-align: center; }

        /* Penutup */
        .penutup { text-align: justify; margin-bottom: 3mm; }

        /* Tanda Tangan */
        .ttd-block { margin-top: 3mm; }
        .ttd-block p { margin: 0; }
        .ttd-nama {
            margin-top: 45px;
            font-weight: bold;
            text-decoration: underline;
        }
        .ttd-jabatan { font-style: italic; }

        /* ============================
           FOOTER
        ============================ */
        .footer-wrapper {
            padding: 0 15mm 8mm 15mm;
            margin-top: auto;
        }
        
        .footer-line {
            border-top: 2.5px solid #A2D6D3; /* Gunakan border agar pasti tercetak */
            margin-bottom: 4mm;
            width: 100%;
        }

        .footer-content {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            font-family: Arial, sans-serif;
            color: #666666; /* Abu-abu teks footer */
        }

        .footer-col {
            flex: 1;
            font-size: 7pt;
            line-height: 1.4;
            border-right: 1.5px solid #A2D6D3; /* Pemisah vertikal */
            padding-right: 15px;
            margin-right: 15px;
        }
        
        .footer-col:last-child {
            border-right: none;
            padding-right: 0;
            margin-right: 0;
        }
        
        .footer-col h4 {
            color: #4a4a4a;
            font-size: 7.5pt;
            font-weight: bold;
            margin-bottom: 6px;
            letter-spacing: 0.2px;
        }

        .footer-col.media-col {
            flex: 1.5;
            display: flex;
            justify-content: flex-end;
            align-items: center;
            gap: 15px;
        }

        /* Social Media Icons Box Styling */
        .social-group {
            display: flex;
            flex-direction: column;
            align-items: center;
        }
        .social-icons {
            display: flex;
            gap: 6px;
            margin-bottom: 4px;
        }
        .icon-box {
            width: 18px; height: 18px;
            border: 1.5px solid #FF5A5F;
            border-radius: 4px;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .icon-box.teal { border-color: #A2D6D3; }
        
        /* Simulating the SVG icons visually */
        .icon-ig { border-color: #FF5A5F; color: #FF5A5F; font-size: 10px; font-weight: bold; }
        .icon-fb { border-color: #A2D6D3; color: #A2D6D3; font-size: 11px; font-weight: bold; }
        .icon-in { border-color: #A2D6D3; color: #A2D6D3; font-size: 9px; font-weight: bold; }
        .icon-yt { border-color: #FF5A5F; color: #FF5A5F; font-size: 8px; }

        .social-text {
            font-size: 7pt;
            color: #666;
        }

        .divider {
            border-left: 1.5px solid #A2D6D3;
            height: 25px;
            margin: 0 10px;
        }

        .wa-group {
            display: flex;
            flex-direction: column;
            align-items: center;
        }
        .wa-icon {
            width: 18px; height: 18px;
            border: 1.5px solid #FF5A5F;
            border-radius: 4px;
            color: #FF5A5F;
            display: flex; align-items: center; justify-content: center;
            margin-bottom: 4px;
        }
        .wa-icon svg {
            width: 12px; height: 12px;
            fill: currentColor;
        }

        /* ============================
           PRINT BUTTON
        ============================ */
        .no-print {
            position: fixed;
            bottom: 25px;
            right: 25px;
            z-index: 9999;
        }
        .btn-cetak {
            background: #2B2E5C;
            color: white;
            border: none;
            padding: 14px 28px;
            border-radius: 12px;
            font-size: 14px;
            font-weight: bold;
            cursor: pointer;
            box-shadow: 0 6px 20px rgba(0,0,0,0.2);
            transition: 0.2s;
        }
        .btn-cetak:hover { opacity: 0.9; transform: translateY(-2px); }
    </style>
</head>
<body>

<div class="page">

    <!-- ======= LEFT DECORATION (SVG CURVES) ======= -->
    <!-- Elemen garis melengkung ini di-generate dari SVG murni supaya tidak butuh file gambar -->
    <div class="left-deco">
        <svg width="230" height="230" viewBox="0 0 230 230" fill="none" xmlns="http://www.w3.org/2000/svg">
            <!-- Outer Blue Line -->
            <circle cx="-30" cy="-30" r="190" stroke="#2B2E5C" stroke-width="10" />
            
            <!-- Middle Orange/Yellow Line -->
            <circle cx="-30" cy="-30" r="150" stroke="#F6A828" stroke-width="35" />
            
            <!-- Inner Blue Line -->
            <circle cx="-30" cy="-30" r="85" stroke="#2B2E5C" stroke-width="50" />
        </svg>
    </div>

    <!-- ======= CONTENT ======= -->
    <div class="content-area">

        <!-- KOP SURAT (LOGOS) -->
        <div class="kop-surat">
            <!-- Logo LP3I saja -->
            <img src="{{ asset('images/lp3i_krw.png') }}" alt="Logo LP3I">
        </div>

        <div class="surat-body">
            <!-- TANGGAL & NOMOR -->
            <div class="tanggal-nomor">
                <p>Karawang, {{ $tanggal_surat }}</p>
                <p>No: {{ $nomor_surat }}</p>
            </div>

            <!-- TUJUAN -->
            <div class="tujuan">
                <p>Kepada Yth,</p>
                <p>{{ $kepada_yth }}</p>
                @if($instansi_tujuan)
                    <p class="bold">{{ $instansi_tujuan }}</p>
                @endif
                <p>Di Tempat</p>
            </div>

            <!-- PERIHAL & LAMPIRAN -->
            <div class="info-table">
                <table>
                    <tr>
                        <td class="lbl">Perihal</td>
                        <td class="sep">:</td>
                        <td>{{ $perihal ?: '-' }}</td>
                    </tr>
                    <tr>
                        <td class="lbl">Lampiran</td>
                        <td class="sep">:</td>
                        <td>{{ $lampiran }}</td>
                    </tr>
                </table>
            </div>

            <!-- SALAM PEMBUKA -->
            <div class="salam salam-buka">
                Assalamualaikum Wr. Wb.
            </div>

            <p class="hormat-line">Dengan Hormat,</p>

            <!-- ISI SURAT -->
            <div class="isi-surat">
                {!! nl2br(e($isi_surat)) !!} 
                @if($tema_kegiatan)
                    "{{ $tema_kegiatan }}"
                @endif
                yang <em>InsyaAllah</em> akan dilaksanakan pada:
            </div>

            <!-- DETAIL KEGIATAN -->
            <div class="kegiatan-table">
                <table>
                    <tr>
                        <td class="lbl">Hari &amp; Tanggal</td>
                        <td class="sep">:</td>
                        <td>
                            @if($hari_kegiatan && $tanggal_kegiatan)
                                {{ $hari_kegiatan }}, {{ $tanggal_kegiatan }}
                            @else
                                -
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <td class="lbl">Waktu</td>
                        <td class="sep">:</td>
                        <td>{{ $waktu ?: '-' }}</td>
                    </tr>
                    <tr>
                        <td class="lbl">Tempat</td>
                        <td class="sep">:</td>
                        <td>{{ $tempat ?: '-' }}</td>
                    </tr>
                </table>
            </div>

            <!-- PENUTUP -->
            <div class="penutup">
                Demikian surat permohonan ini kami sampaikan, atas perhatian dan kerjasamanya kami ucapkan terima kasih.
            </div>

            <!-- SALAM PENUTUP -->
            <div class="salam salam-tutup">
                Wassalamualaikum Wr. Wb.
            </div>

            <!-- TANDA TANGAN -->
            <div class="ttd-block">
                <p>Hormat Kami,</p>
                <p><strong>LP3I College Karawang</strong></p>
                
                <p class="ttd-nama">Eko Marmanto P. U., S.Kom., M.Kom., MOS.</p>
                <p class="ttd-jabatan">Head of Academic &amp; Job Placement</p>
            </div>
        </div>

    </div>

    <!-- ======= FOOTER ======= -->
    <div class="footer-wrapper">
        <div class="footer-line"></div>
        
        <div class="footer-content">
            <!-- Branch Office -->
            <div class="footer-col">
                <h4>Branch Office Karawang</h4>
                <p>Gedung Karawang Hijau 6, Jl.<br>
                   Tarumanagara Desa Purwadana, Kec.<br>
                   Telukjambe Timur, Kab. Karawang,<br>
                   Jawa Barat 41361</p>
            </div>

            <!-- Head Office -->
            <div class="footer-col">
                <h4>Head Office Yayasan GMU</h4>
                <p>Jl. Aria Santika No.43, Margasari,<br>
                   Kec. Karawaci, Kota Tangerang,<br>
                   Banten 15113</p>
            </div>

            <!-- Social Media & Contact -->
            <div class="footer-col media-col">
                <div class="social-group">
                    <div class="social-icons">
                        <div class="icon-box icon-ig">IG</div>
                        <div class="icon-box icon-fb">f</div>
                        <div class="icon-box icon-in">in</div>
                        <div class="icon-box icon-yt">▶</div>
                    </div>
                    <div class="social-text">lp3i.karawang</div>
                </div>

                <div class="divider"></div>

                <div class="wa-group">
                    <div class="wa-icon">
                        <svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path d="M20.52 3.44A11.94 11.94 0 0 0 12 0a12 12 0 0 0-10.4 17.9L0 24l6.23-1.63A11.95 11.95 0 0 0 12 24a12 12 0 0 0 12-12 11.9 11.9 0 0 0-3.48-8.56zm-8.52 18.6a9.98 9.98 0 0 1-5.1-1.4l-.36-.21-3.8 1 .01-3.7-.24-.37A9.97 9.97 0 0 1 2.05 12 10.02 10.02 0 0 1 12 2.02a10.02 10.02 0 0 1 9.96 10A10.03 10.03 0 0 1 12 22.04zm5.48-7.5c-.3-.15-1.77-.88-2.04-.98-.27-.1-.47-.15-.67.15-.2.3-.77.98-.95 1.18-.17.2-.35.23-.65.08A8.15 8.15 0 0 1 9.4 12.2a8.88 8.88 0 0 1-1.18-1.47c-.17-.3 0-.46.15-.6.13-.14.3-.35.45-.53.15-.17.2-.3.3-.5.1-.2.05-.38-.03-.53-.08-.15-.67-1.62-.92-2.22-.24-.58-.48-.5-.67-.5h-.58c-.2 0-.52.07-.79.37s-1.05 1.03-1.05 2.5 1.08 2.9 1.23 3.1 2.12 3.23 5.14 4.54c.72.3 1.28.5 1.72.63.72.23 1.38.2 1.9.12.58-.08 1.77-.73 2.02-1.43.25-.7.25-1.3.17-1.43-.07-.13-.27-.2-.57-.35z"/>
                        </svg>
                    </div>
                    <div class="social-text">+62 851 1770 4112</div>
                </div>
            </div>
        </div>
    </div>

</div>

<!-- TOMBOL CETAK -->
<div class="no-print">
    <button class="btn-cetak" onclick="window.print()">Cetak Surat</button>
</div>

</body>
</html>
