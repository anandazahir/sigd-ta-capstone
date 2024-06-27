<!DOCTYPE html>
<html>

<head>
    <title>SURAT IZIN {{$user->nama}}</title>
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
    <p>Nama: {{ $user->nama }}</p>
    <p>NIP: {{ $user->nip }}</p>
    <p>Jabatan: {{ $user->jabatan }}</p>
    <p>Alamat ketika cuti: {{ $alamat_cuti }}</p>
    <p>Mulai Cuti: {{ $mulai_cuti }}</p>
    <p>Selesai Cuti: {{ $selesai_cuti }}</p>
    @if($jenis_cuti === 'lainnya')
    <p>Alasan Cuti: {{ $alasan_cuti }}</p>
    @else
    <p>Jenis Cuti: {{ $jenis_cuti }}</p>
    @endif
</body>

</html>