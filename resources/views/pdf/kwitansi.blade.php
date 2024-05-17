<!DOCTYPE html>
<html>

<head>
    <title>kwitansi_{{$transaksi->no_transaksi}}</title>
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
    <h2>Kwitansi</h2>
    <h3>NO Transaksi: {{$transaksi->no_transaksi}}</h3>
    <h3>NO DO: {{$transaksi->no_do}}</h3>
    <table border="1">
        <thead>
            <tr>
                <th>No Peti Kemas</th>
                <th>Jenis & Ukuran</th>
                <th>Pelayaran</th>
                <th>Metode Pembayaran</th>
                <th>Tanggal Pembayaran</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>{{ $penghubung->petikemas->no_petikemas }}</td>
                <td>{{ $penghubung->petikemas->jenis_ukuran }}</td>
                <td>{{ $penghubung->petikemas-> harga}}</td>
                <td>{{ $penghubung->pembayaran-> metode}}</td>
                <td>{{ $penghubung->petikemas->tanggal_pembayaran }}</td>
            </tr>
        </tbody>
    </table>
</body>

</html>