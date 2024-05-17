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
    <h1>Laporan Bulanan Transaksi</h1>

    <p>Jenis Kegiatan: {{ $selectedValue }}</p>
    <p>Bulan Transaksi: {{ $selectedMonth }}</p>

    @foreach($filteredData as $transaksi)
    <table border="1">
        <thead>
            <tr>
                <th>ID</th>
                <th>Tanggal Transaksi</th>
                <th>Jenis Kegiatan</th>
                <th>No. DO</th>
                <th>Tanggal DO Rilis</th>
                <th>Tanggal DO Exp</th>
                <th>Perusahaan</th>
                <th>Jumlah Petikemas</th>
                <th>Kapal</th>
                <th>EMKL</th>
                <th>Tanggal Transaksi</th>
                <th>Inventory</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>{{ $transaksi->no_transaksi }}</td>
                <td>{{ $transaksi->tanggal_transaksi }}</td>
                <td>{{ $transaksi->jenis_kegiatan }}</td>
                <td>{{ $transaksi->no_do }}</td>
                <td>{{ $transaksi->tanggal_DO_rilis }}</td>
                <td>{{ $transaksi->tanggal_DO_exp }}</td>
                <td>{{ $transaksi->perusahaan }}</td>
                <td>{{ $transaksi->jumlah_petikemas }}</td>
                <td>{{ $transaksi->kapal }}</td>
                <td>{{ $transaksi->emkl }}</td>
                <td>{{ $transaksi->tanggal_transaksi }}</td>
                <td>{{ $transaksi->inventory }}</td>
            </tr>
        </tbody>
    </table>

    <h2>Detail Transaksi</h2>
    <h3>Entry Data</h3>
    <table border="1">
        <thead>
            <tr>
                <th>No Peti Kemas</th>
                <th>Jenis & Ukuran</th>
                <th>Pelayaran</th>
                <th>Status Cetak SPK</th>
            </tr>
        </thead>
        <tbody>
            @foreach($transaksi->penghubungs as $item)
            @php
            $petikemas = $item->petikemas;
            $pembayaran = $item->pembayaran;
            @endphp
            <tr>
                <td>{{ $petikemas->no_petikemas }}</td>
                <td>{{ $petikemas->jenis_ukuran }}</td>
                <td>{{ $petikemas->pelayaran }}</td>
                <td>{{ $pembayaran->status_cetak_spk }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <h3>Pembayaran</h3>
    <table border="1">
        <thead>
            <tr>
                <th>No Peti Kemas</th>
                <th>Jenis & Ukuran</th>
                <th>Metode</th>
                <th>Biaya</th>
                <th>Tanggal Pembayaran</th>
                <th>Status Pembayaran</th>
            </tr>
        </thead>
        <tbody>
            @foreach($transaksi->penghubungs as $item)
            @php
            $pembayaran = $item->pembayaran;
            $petikemas = $item->petikemas;
            @endphp
            <tr>
                <td>{{ $petikemas->no_petikemas }}</td>
                <td>{{ $petikemas->jenis_ukuran }}</td>
                <td>{{ $pembayaran->metode }}</td>
                <td>{{ $petikemas->harga }}</td>
                <td>{{ $pembayaran->tanggal_pembayaran }}</td>
                <td>{{ $pembayaran->status_pembayaran }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
    @endforeach
</body>

</html>