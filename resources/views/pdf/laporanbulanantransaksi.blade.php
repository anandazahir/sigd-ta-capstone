<!DOCTYPE html>
<html>

<head>
    <title>Laporan Bulanan Transaksi</title>
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
    <h1>Laporan Harian Transaksi</h1>
    <h2>PT. GARBANTARA DEPO
Kawasan Industri Cipta Guna Kav. 9
Jl. Arteri Utara Semarang</h2>
<h3>PERIODE: {{now()}}</h3>


    @foreach($transaksis as $transaksi)
    <table border="1" >
        <thead>
            <tr>
                <th>No Transaksi</th>
                <th>Tanggal Transaksi</th>
                <th>Jenis Kegiatan</th>
                <th>Perusahaan</th>
                <th>Jumlah Petikemas</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>{{ $transaksi->no_transaksi }}</td>
                <td>{{ $transaksi->tanggal_transaksi}}</td>
                <td>{{ $transaksi->jenis_kegiatan }}</td>
                <td>{{ $transaksi->perusahaan }}</td>
                <td>{{ $transaksi->jumlah_petikemas }}</td>
            </tr>
        </tbody>
    </table>

    <h2 class="m-0">Detail Transaksi</h2>
    <table border="1">
        <thead>
            <tr>
                <th>No Peti Kemas</th>
                <th>Jenis & Ukuran</th>
                <th>Pelayaran</th>
                <th>Harga</th>
             
            </tr>
        </thead>
        <tbody>
            @foreach($transaksi->penghubungs as $item)
            @php
            $total = 0;
            $petikemas = $item->petikemas;
            $pembayaran = $item->pembayaran;
           $total += $item->petikemas->harga;
            @endphp
            <tr>
                <td>{{ $petikemas->no_petikemas }}</td>
                <td>{{ $petikemas->jenis_ukuran }}</td>
                <td>{{ $petikemas->pelayaran }}</td>
                <td >{{ $petikemas->harga}}</td>
            </tr>
            @endforeach
            
            <tr>
                <td colspan="3">TOTAL: </td>
                <td>{{ $total}}</td>
            </tr>
        </tbody>
    </table>
    <br/>
    <br/>
    @endforeach
</body>

</html>