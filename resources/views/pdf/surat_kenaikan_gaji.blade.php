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
            margin-right: 35rem;
        }

        .semi-title {
            margin: 0;
            font-size: 14px;
            margin-right: 28rem;
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
            <svg viewBox="0 0 90 70" fill="none" xmlns="http://www.w3.org/2000/svg" class="d-inline-block align-text-top" style="width:100px;height:100px;">
                <path d="M25.6822 28.6547L72.6269 29.5504L73.0407 49.4314L25.6013 48.561L25.6822 28.6547ZM25.6822 28.6547L17.8866 22.3725L66.3629 22.8014L72.6269 29.5504" stroke="black" stroke-miterlimit="10" />
                <path d="M25.6013 48.4474L16.8972 42.5563L17.33 22.6815L25.3634 28.4024L25.6013 48.4474Z" fill="black" stroke="black" stroke-miterlimit="10" />
                <path d="M69.4307 42.4491H64.9788V49.4251H69.4307V42.4491Z" fill="black" />
                <path d="M45.0213 65.692C40.2086 65.394 35.4128 64.7306 30.6573 63.7052C24.8641 62.3238 14.0673 56.0164 12.3408 54.2062C8.67365 50.4217 3.90308 43.9376 3.90308 35.9146C3.94113 20.5118 17.4871 8.2312 30.4147 5.89745C34.4243 5.17209 41.0403 4.04306 43.8941 3.78445L44.0796 17.7113C41.7728 17.7113 35.152 17.7113 31.5705 18.8403C24.2315 21.1678 16.512 20.3289 16.512 33.2717C16.512 46.366 25.2066 50.0495 32.0557 52.2761C35.4612 53.3799 38.4814 54.2818 39.9511 54.2881V42.1779L29.8678 42.3797L36.9118 37.6996L44.4506 33.1456L45.0213 65.692Z" style="fill:rgb(var(--bs-primary-rgb))" stroke="black" />
                <path d="M25.6013 48.4474L16.8972 42.5563L17.33 22.6815L25.3634 28.4024L25.6013 48.4474Z" fill="black" stroke="black" stroke-miterlimit="10" />
                <path d="M17.8866 22.3725L25.9248 28.1186L45.8489 29.0395L45.7966 22.3725H17.8866Z" stroke="black" stroke-miterlimit="10" />
                <path d="M43.9417 3.78445C47.8894 3.78445 50.7289 4.34582 55.8324 5.15317C64.8979 6.57865 71.5282 10.0919 76.7602 14.4125C81.7971 18.5502 86.0397 23.6024 85.9874 33.8016C85.9351 44.0007 81.2311 49.4756 76.5176 55.2469C71.7898 61.1002 64.5555 63.1375 55.6945 65.0739C51.1284 66.0641 48.132 65.856 44.9928 65.7046L43.9417 3.78445ZM48.4887 53.7268C52.8883 53.2537 53.4257 53.6637 55.9228 53.096C61.4496 51.8346 75.0812 50.6866 75.1525 36.3372C75.2144 24.5801 67.3237 20.4613 58.1678 17.9131C55.9275 17.2824 52.2366 16.0209 48.3317 15.9767L48.4887 53.7268Z" fill="black" stroke="black" />
            </svg>
        </div>

        <div class="right">
            <h1>PT. GARBANTARA DEPO</h1>
            <p class="semi-title">CONTAINER DEPOT & WAREHOUSING</p>
            <p class="alamat">Kawasan Industri Cipta Guna Centra Buana Kav. 9 Jl. Arteri Utara, Phone (024) 3586300 (Hunting) Fax. 3586205 Semarang</p>
        </div>

    </div>
    <div class="line"></div>
    <div class="content">
        <p style="text-align: end;">Semarang, {{now()}}</p>
        <p>Nomor: 023.050/GD /Doc/PN/IV/2024</p>
        <p>Lampiran: -</p>
        <p>Perihal: Kenaikan Gaji</p>
        <br>
        <p>Kepada Yth. Direktur PT Garbantara Depo</p>
        <p>Di tempat</p>
        <br>
        <p>Dengan Hormat,</p>
        <p>Yang bertanda tangan di bawah ini:</p>
        <p class="title">Nama: {{$user->nama}}</p>
        <p class="title">NIP: {{$user->nip}}</p>
        <p class="title">Jabatan: {{$user->jabatan}}</p>
        <br>
        <p>Bermaksud mengajukan kenaikan gaji dengan nominal awal {{$gaji_sekarang}} berganti dengan nominal {{$gaji_diajukan}} dengan alasan {{$alasan_kenaikan_gaji}}.</p>
        <br>
        <p>Demikian surat permohonan cuti ini saya ajukan, Terima kasih atas perhatian Bapak/Ibu.</p>
        <br>
    </div>

    <div class="signature">
        <div class="left">
            <p style="text-align: center;">Menyetujui</p>
            <br><br><br>
            <p style="text-align: center;">{{$direktur->nama}}</p>
        </div>
        <div class="right">
            <p>Semarang, {{now()}}</p>
            <p style="text-align: center;">Hormat Saya</p>
            <br><br><br>
            <p style="text-align: center;">{{auth()->user()->nama}}</p>
        </div>
    </div>
</body>

</html>