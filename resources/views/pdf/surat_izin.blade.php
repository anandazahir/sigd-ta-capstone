<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Template Surat Cuti</title>
    <style>
        @page {
            size: A4;
            margin: 1cm;
            /* Set margin to 1cm */
        }

        body {
            font-family: Arial, sans-serif;
            margin: 40px;
        }

        .header {
            text-align: center;
            margin-bottom: 20px;
            clear: both;
        }

        .header img {
            vertical-align: middle;
            margin-right: 10px;
            float: left;
        }

        .header h1 {
            margin: 0;
            padding: 0;
            font-size: 24px;
            
        }

        .semi-title {
            margin: 0;
            font-size: 14px;
            
        }

        .alamat {
            margin: 0;
            font-size: 14px;
            margin-left: 4rem;
        }

        .line {
            border-top: 2px solid black;
            margin: 20px 0;
        }

        .content {
            margin-bottom: 50px;
        }

        .content p {
            margin: 0 0 10px 0;
        }

        .content .title {
            font-weight: bold;
        }

        .signature {
            margin-top: 50px;
            clear: both;
        }

        .signature .left {
            float: left;
        }

        .signature .right {
            float: right;
            text-align: right;
        }
    </style>
</head>

<body>

    <div class="header">
        <div class="left">
            
        </div>

        <div class="right">
            <h1>PT. GARBANTARA DEPO</h1>
            <p class="semi-title">CONTAINER DEPOT & WAREHOUSING</p>
            <p class="alamat">Kawasan Industri Cipta Guna Centra Buana Kav. 9 Jl. Arteri Utara, Phone (024) 3586300 (Hunting) Fax. 3586205 Semarang</p>
        </div>

    </div>
    <div class="line"></div>
    <div class="content">
        <p style="text-align: end;">Semarang, {{ \Carbon\Carbon::now()->translatedFormat('d F Y') }}
        </p>
        <p>Nomor: 023.050/GD /Doc/PN/IV/2024</p>
        <p>Lampiran: -</p>
        <p>Perihal: Permohonan Cuti</p>
        <br>
        <p>Kepada Yth. Direktur PT Garbantara Depo</p>
        <p>Di tempat</p>
        <br>
        <p>Dengan Hormat,</p>
        <p>Yang bertanda tangan di bawah ini:</p>
        <p class="title">Nama: {{auth()->user()->nama}}</p>
        <p class="title">NIP: {{auth()->user()->nip}}</p>
        <p class="title">Jabatan: {{auth()->user()->jabatan}}</p>
        <br>
        <p>
            Bermaksud mengajukan
            {{$pengajuan->jenis_cuti == 'cuti tahunan' ? 'cuti tahunan dengan alasan ' . $pengajuan->alasan_cuti : $pengajuan->jenis_cuti }}
            selama lima hari, terhitung mulai tanggal {{ \Carbon\Carbon::parse($pengajuan->mulai_cuti)->translatedFormat('d F Y') }}
            sampai dengan tanggal {{ \Carbon\Carbon::parse($pengajuan->selesai_cuti)->translatedFormat('d F Y') }}
            .
        </p>

        <br>
        <p>Demikian surat permohonan cuti ini saya ajukan, Terima kasih atas perhatian Bapak/Ibu.</p>
        <br>
    </div>

    <div class="signature">

        <div class="left" style="margin-top: 40px;">
            <p style="text-align: center;">Menyetujui</p>
            <br><br><br>
           
            <img src="{{URL::asset($pengajuan->sign_acc )}}" alt="" srcset="">
            
            <p style="text-align: center;">{{$direktur->username}}</p>
        </div>
        <div class="right">
            <p>Semarang, {{ \Carbon\Carbon::now()->translatedFormat('d F Y') }}
            </p>
            <p style="text-align: center;">Hormat Saya</p>
            <br><br><br>
            <p style="text-align: center;">{{auth()->user()->nama}}</p>
        </div>
    </div>
</body>

</html>