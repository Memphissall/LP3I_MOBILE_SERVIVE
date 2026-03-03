<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Surat Pengantar - LP3I College Karawang</title>
    <style>
        * { box-sizing: border-box; margin: 0; padding: 0; }

        body {
            font-family: 'Times New Roman', Times, serif;
            font-size: 12pt;
            color: #1a1a1a;
            background: #e0e0e0;
            line-height: 1.6;
        }

        @page {
            size: A4 portrait;
            margin: 0;
        }

        @media print {
            body { background: white; }
            .no-print { display: none !important; }
            .page { box-shadow: none; margin: 0; }
        }

        /* ============================
           PAGE
        ============================ */
        .page {
            width: 210mm;
            min-height: 297mm;
            margin: 10mm auto;
            position: relative;
            background: white;
            display: flex;
            flex-direction: column;
            overflow: hidden;
            box-shadow: 0 4px 20px rgba(0,0,0,0.15);
        }

        /* ============================
           LEFT DECORATION (geometric)
        ============================ */
        .left-deco {
            position: absolute;
            left: 0;
            top: 0;
            width: 20mm;
            height: 100%;
            z-index: 0;
            overflow: hidden;
        }
        .left-deco .bg-dark {
            position: absolute;
            left: 0; top: 0;
            width: 100%; height: 100%;
            background: #004269;
        }
        /* Teal swoosh top */
        .left-deco .swoosh-1 {
            position: absolute;
            left: 0; top: 0;
            width: 100%;
            height: 45%;
            background: #009DA5;
            clip-path: polygon(0 0, 100% 0, 100% 60%, 0 85%);
            z-index: 1;
        }
        /* Lighter teal accent */
        .left-deco .swoosh-2 {
            position: absolute;
            left: 0; top: 8%;
            width: 100%;
            height: 35%;
            background: #33b5bc;
            clip-path: polygon(0 30%, 100% 10%, 100% 55%, 0 75%);
            opacity: 0.5;
            z-index: 2;
        }
        /* Subtle white circles */
        .left-deco .circle-1 {
            position: absolute;
            width: 50px; height: 50px;
            border-radius: 50%;
            background: rgba(255,255,255,0.06);
            top: 5%; left: -10px;
            z-index: 3;
        }
        .left-deco .circle-2 {
            position: absolute;
            width: 80px; height: 80px;
            border-radius: 50%;
            background: rgba(255,255,255,0.04);
            top: 15%; left: 5px;
            z-index: 3;
        }

        /* ============================
           CONTENT AREA
        ============================ */
        .content-area {
            position: relative;
            z-index: 1;
            padding: 12mm 18mm 8mm 28mm;
            flex: 1;
        }

        /* ============================
           KOP SURAT
        ============================ */
        .kop-surat {
            display: flex;
            align-items: flex-start;
            justify-content: space-between;
            padding-bottom: 3mm;
            border-bottom: 2.5px solid #004269;
            margin-bottom: 5mm;
        }
        .kop-surat .logo {
            flex-shrink: 0;
            margin-left: 10px;
        }
        .kop-surat .logo img {
            height: 50px;
            width: auto;
        }

        /* ============================
           SURAT BODY
        ============================ */

        /* Tanggal & Nomor */
        .tanggal-nomor {
            margin-bottom: 5mm;
            font-size: 11pt;
        }
        .tanggal-nomor .nomor {
            color: #004269;
            font-weight: bold;
        }

        /* Tujuan Surat */
        .tujuan {
            margin-bottom: 5mm;
            font-size: 11pt;
        }
        .tujuan p {
            margin: 0;
            line-height: 1.5;
        }
        .tujuan .bold { font-weight: bold; }

        /* Perihal / Lampiran */
        .info-table {
            margin-bottom: 5mm;
            font-size: 11pt;
        }
        .info-table table { border-collapse: collapse; }
        .info-table td {
            padding: 0.5mm 0;
            vertical-align: top;
        }
        .info-table .lbl { width: 75px; }
        .info-table .sep { width: 15px; text-align: center; }

        /* Salam */
        .salam {
            font-style: italic;
            font-size: 11pt;
        }
        .salam-buka { margin-bottom: 4mm; }
        .salam-tutup { margin-top: 4mm; margin-bottom: 3mm; }

        /* Hormat */
        .hormat-line {
            font-size: 11pt;
            margin-bottom: 3mm;
        }

        /* Isi Surat */
        .isi-surat {
            text-align: justify;
            font-size: 11pt;
            line-height: 1.7;
            margin-bottom: 4mm;
        }

        /* Detail Kegiatan */
        .kegiatan-table {
            margin-bottom: 5mm;
            font-size: 11pt;
        }
        .kegiatan-table table { border-collapse: collapse; }
        .kegiatan-table td {
            padding: 1mm 0;
            vertical-align: top;
        }
        .kegiatan-table .lbl { width: 120px; }
        .kegiatan-table .sep { width: 18px; text-align: center; }

        /* Penutup */
        .penutup {
            text-align: justify;
            font-size: 11pt;
            line-height: 1.7;
            margin-bottom: 4mm;
        }

        /* TTD */
        .ttd-block {
            margin-top: 2mm;
            font-size: 11pt;
        }
        .ttd-block p { margin: 0; line-height: 1.5; }
        .ttd-nama {
            margin-top: 50px;
            font-weight: bold;
            text-decoration: underline;
            color: #004269;
        }
        .ttd-jabatan {
            font-style: italic;
        }

        /* ============================
           FOOTER
        ============================ */
        .footer {
            background: #004269;
            padding: 5mm 15mm 5mm 28mm;
            display: flex;
            align-items: flex-start;
            gap: 10mm;
            margin-top: auto;
            border-top: 3px solid #009DA5;
        }
        .footer-col { flex: 1; }
        .footer-col h4 {
            color: #009DA5;
            font-size: 7pt;
            font-weight: bold;
            font-family: Arial, Helvetica, sans-serif;
            margin-bottom: 2px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }
        .footer-col p {
            color: #ffffff;
            font-size: 6.5pt;
            line-height: 1.6;
            font-family: Arial, Helvetica, sans-serif;
            margin: 0;
        }

        /* Social Icons */
        .social-row {
            display: flex;
            gap: 3px;
            margin-bottom: 3px;
        }
        .s-icon {
            width: 14px; height: 14px;
            border-radius: 2px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-size: 7px;
            font-weight: bold;
            color: white;
            font-family: Arial, sans-serif;
        }
        .s-ig { background: #e1306c; }
        .s-fb { background: #1877f2; }
        .s-tw { background: #1da1f2; }
        .s-li { background: #0a66c2; }
        .s-yt { background: #ff0000; }

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
            background: linear-gradient(135deg, #004269, #009DA5);
            color: white;
            border: none;
            padding: 14px 28px;
            border-radius: 12px;
            font-size: 14px;
            font-family: Arial, sans-serif;
            font-weight: bold;
            cursor: pointer;
            box-shadow: 0 6px 20px rgba(0,66,105,0.4);
            display: flex;
            align-items: center;
            gap: 10px;
            transition: all 0.2s ease;
        }
        .btn-cetak:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(0,66,105,0.5);
        }
        .btn-cetak:active { transform: translateY(0); }
    </style>
</head>
<body>

<div class="page">

    <!-- ======= LEFT DECORATION ======= -->
    <div class="left-deco">
        <div class="bg-dark"></div>
        <div class="swoosh-1"></div>
        <div class="swoosh-2"></div>
        <div class="circle-1"></div>
        <div class="circle-2"></div>
    </div>

    <!-- ======= CONTENT ======= -->
    <div class="content-area">

        <!-- KOP SURAT -->
        <div class="kop-surat">
            <div></div>
            <div class="logo">
                <img src="{{ asset('images/lp3i_krw.png') }}" alt="Logo LP3I College">
            </div>
        </div>

        <!-- TANGGAL & NOMOR -->
        <div class="tanggal-nomor">
            <p>Karawang, {{ $tanggal_surat }}</p>
            <p class="nomor">No: {{ $nomor_surat }}</p>
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
            <em>Assalamualaikum Wr. Wb.</em>
        </div>

        <!-- DENGAN HORMAT -->
        <p class="hormat-line">Dengan Hormat,</p>

        <!-- ISI SURAT -->
        <div class="isi-surat">
            Dalam rangka meningkatkan kepedulian Mahasiswa/i LP3I <em>College</em> Karawang ebagai bagian dari
            upaya memperkuat dan memajukan sektor Usaha Mikro Kecil dan Menengah terhadap pemahaman
            dan keterampilan dalam memanfaatkan potensi Aplikasi TikTok dalam mengembangkan bisnis UMKM,
            kami berencana untuk mengadakan kegiatan Seminar dengan tema
            @if($tema_kegiatan)
                &ldquo;{{ $tema_kegiatan }}&rdquo;
            @endif
            yang <em>InsyaAllah</em> akan di laksanakan pada:
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
            Demikian surat permohonan ini kami sampaikan, atas perhatian dan kerjasamanya kami ucapkan
            terima kasih.
        </div>

        <!-- SALAM PENUTUP -->
        <div class="salam salam-tutup">
            <em>Wassalamualaikum Wr. Wb.</em>
        </div>

        <!-- TANDA TANGAN -->
        <div class="ttd-block">
            <p>Hormat Kami,</p>
            <p>LP3I <em>College</em> Karawang</p>
            <p class="ttd-nama">Eko Marmanto P. U., S.Kom., M.Kom., MOS.</p>
            <p class="ttd-jabatan">Head of Academic &amp; Job Placement</p>
        </div>

    </div>

    <!-- ======= FOOTER ======= -->
    <div class="footer">
        <div class="footer-col">
            <h4>Branch Office Karawang</h4>
            <p>
                Gedung Karawang Hijau 4-6, Jl.<br>
                Tarumanagara-Desa Purwadana, Kec.<br>
                Telukjambe Timur, Kab. Karawang,<br>
                Jawa Barat &ndash; Indonesia 41361<br>
                Phone (0267) 411286
            </p>
        </div>
        <div class="footer-col">
            <h4>Head Office</h4>
            <p>
                Jl. Kramat Raya No.7-9 RW.2, Kramat,<br>
                Kec. Senen, Kota Jakarta Pusat,<br>
                Daerah Khusus Ibukota Jakarta 10450<br>
                Phone (021) 3146636
            </p>
        </div>
        <div class="footer-col" style="text-align: right;">
            <div class="social-row" style="justify-content: flex-end;">
                <span class="s-icon s-ig">ig</span>
                <span class="s-icon s-fb">f</span>
                <span class="s-icon s-tw">t</span>
                <span class="s-icon s-li">in</span>
                <span class="s-icon s-yt">&#9654;</span>
            </div>
            <p style="margin-bottom: 2px;">lp3i.karawang</p>
            <p><strong>www.lp3i.ac.id</strong></p>
        </div>
    </div>

</div>

<!-- TOMBOL CETAK (tidak ikut tercetak) -->
<div class="no-print">
    <button class="btn-cetak" onclick="window.print()">
        <svg width="20" height="20" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"/>
        </svg>
        Cetak Surat
    </button>
</div>

</body>
</html>
