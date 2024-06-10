<!DOCTYPE html>
<html>

<head>
    <title>Laporan Harian Petikemas</title>
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
    @php
    $currentMonth = date('m');
    $currentYear = date('Y');

    // Generate the start and end dates of the current month
    $startDate = date('d-m-y', mktime(0, 0, 0, $currentMonth, 1, $currentYear));
    @endphp
    <h1>Laporan Harian Petikemas {{$selectedValue}} Tanggal {{$startDate}}</h1>
    @foreach($petikemas as $item)
    <table border="1">
        <thead>
            <tr>
                <th>ID</th>
                <th>No. Petikemas</th>
                <th>Tanggal Keluar</th>
                <th>Tanggal Masuk</th>
                <th>Jenis Ukuran</th>
                <th>Pelayaran</th>
                <th>Harga</th>
                <th>Status Ketersediaan</th>
                <th>Status Kondisi</th>
                <th>Lokasi</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>{{ $item->id }}</td>
                <td>{{ $item->no_petikemas }}</td>
                <td>{{ $item->tanggal_keluar }}</td>
                <td>{{ $item->tanggal_masuk }}</td>
                <td>{{ $item->jenis_ukuran }}</td>
                <td>{{ $item->pelayaran }}</td>
                <td>{{ $item->harga }}</td>
                <td>{{ $item->status_ketersediaan }}</td>
                <td>{{ $item->status_kondisi }}</td>
                <td>{{ $item->lokasi }}</td>
            </tr>
        </tbody>
    </table>
    @endforeach
</body>

</html>