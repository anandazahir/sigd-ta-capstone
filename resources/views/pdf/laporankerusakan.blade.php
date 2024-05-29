<!DOCTYPE html>
<html>

<head>
    <title>laporan_petikemas_</title>
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
    <h2>Laporan Kerusakan</h2>
   
    <table border="1">
    <thead>
        <tr>
            <th>No</th>
            <th>Lokasi</th>
            <th>Component</th>
            <th>Metode</th>
            <th>Biaya</th>
            <th>Status</th>
            <th>Foto Pengecekan</th>
            <th>Foto Perbaikan</th>
        </tr>
    </thead>
    <tbody>
        @foreach($kerusakan as $index => $item)
            @php
            $fotoLink = asset('storage') . '/' . $item['foto_pengecekan'];
            $statusClass = $item['status'] === 'damage' ? 'bg-danger' : 'bg-success';
            $fotoperbaikan = asset('storage') . '/' . $item['foto_perbaikan'];
            @endphp
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $item['lokasi_kerusakan'] }}</td>
                <td>{{ $item['komponen'] }}</td>
                <td>{{ $item['metode'] }}</td>
                <td>{{ $item['harga'] }}</td>
                <td>
                    <div class="{{ $statusClass }}" style="padding: 5px; border-radius: 5px; color: white;">
                        <span>{{ $item['status'] }}</span>
                    </div>
                </td>
                <td>
                    <div style="height: fit-content;">
                        <img src="{{ $fotoLink }}" alt="Foto Pengecekan" style="max-height: 100px;">
                    </div>
                </td>
                <td>
                    <div style="height: fit-content;">
                        <img src="{{ $fotoperbaikan }}" alt="Foto Perbaikan" style="max-height: 100px;">
                    </div>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>

</body>

</html>