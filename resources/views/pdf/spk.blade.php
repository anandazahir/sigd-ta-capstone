<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>SPK</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }

        .receipt {
            margin: 0 auto;

            padding: 10px;
        }

        .header {
            text-align: center;
            margin-bottom: 20px;
        }

        .details,
        .items,
        .total {
            margin-bottom: 10px;
        }

        .items table {
            width: 100%;
            border-collapse: collapse;
        }

        .items table,
        .items th,
        .items td {
            border: 1px solid #000;
        }

        .items th,
        .items td {
            padding: 5px;
            text-align: left;
        }

        .total {
            text-align: right;
        }
    </style>
</head>

<body>
    <div class="receipt">
        <div class="header">
            <h2>PT GARBANTARA DEPO</h2>
            <p>
            Kawasan Industri Cipta Guna Centra Buana Kav. 9 Jl. Arteri Utara,<br />
            Phone (024) 3586300 (Hunting) Fax. 3586205,<br />
                Kota Semarang Jawa Tengah 50268
            </p>
        </div>
        <hr style="border: dashed 1px; margin: 1.2px" />
        <hr style="border: dashed 1px; margin: 1.2px;" />
        <div class="details">
            <p>No SPK: {{$no_spk}} </p>
            <p>Waktu: {{now()->format('d M y H:i')}}</p>
            <p>No.Do: {{$transaksi->no_do}}</p>
            <p>Inventory: {{auth()->user()->username}}</p>
            <p>Jenis Transaksi: {{$transaksi->jenis_kegiatan}}</p>
        </div>
        <hr style="border: dashed 1px; margin: 1.2px" />
        <hr style="border: dashed 1px; margin: 1.2px;" />
        <div class="items" style="margin-top: 10px">
            <table>
                <thead>
                    <tr>
                        <th>Peti Kemas</th>
                        <th>Pelayaran</th>
                        <th>Jenis & Ukuran</th>
                    </tr>
                </thead>
                <tbody>

                    <tr>
                        <td>{{$penghubung->petikemas->no_petikemas}}</td>
                        <td>{{$penghubung->petikemas->pelayaran}}</td>
                        <td>{{$penghubung->petikemas->jenis_ukuran}}</td>
                    </tr>

                </tbody>
            </table>
        </div>

    </div>
</body>

</html>