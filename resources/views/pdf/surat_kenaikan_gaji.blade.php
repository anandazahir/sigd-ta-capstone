<!DOCTYPE html>
<html>

<head>
    <title>spk_{{$transaksi->no_transaksi}}</title>
    <style>
        /* Define A4 page size */
        @page {
            size: A4;
            margin: 1cm;
            /* Set margin to 1cm */
        }

        /* Set font styles */
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
            /* Adjust font size as needed */
        }

        /* Adjust table styles */
        table {
            width: 100%;
            border-collapse: collapse;
            border: 1px solid #000;
            /* Add border to tables */
        }

        th,
        td {
            border: 1px solid #000;
            /* Add border to table cells */
            padding: 8px;
            /* Add padding to table cells */
            text-align: left;
            /* Align text to the left */
        }

        /* Center table headings */
        th {
            text-align: center;
        }
    </style>
</head>

<body>
    <h2>SURAT IZIN PENGAJUAN</h2>
    <p>Gaji Pokok Saat Ini: Rp {{ number_format($gaji_sekarang, 2, ',', '.') }}</p>
    <p>Gaji Pokok Diajukan: Rp {{ number_format($gaji_diajukan, 2, ',', '.') }}</p>
    <p>Alasan Kenaikan Gaji: {{ $alasan_kenaikan_gaji }}</p>
</body>

</html>