<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Kwitansi</title>
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
                Jl. Tirto Agung No.50,<br />
                Pedalangan, Kec. Banyumanik,<br />
                Kota Semarang Jawa Tengah 50268
            </p>
        </div>
        <hr style="border: dashed 1px; margin: 1.2px" />
        <hr style="border: dashed 1px; margin: 1.2px;" />
        <div class="details">
            <p>No Kwitansi: {{$no_kwitansi}} </p>
            <p>Waktu: {{now()->format('d M y H:i')}}</p>
            <p>No.Do: {{$transaksi->no_do}}</p>
            <p>Kasir: {{auth()->user()->username}}</p>
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
                        <th>Harga</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($penghubung as $item)
                    <tr>
                        <td>{{$item->petikemas->no_petikemas}}</td>
                        <td>{{$item->petikemas->pelayaran}}</td>
                        <td>{{$item->petikemas->jenis_ukuran}}</td>
                        <td>{{$item->petikemas->harga}}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <hr style="border: dashed 1px; margin: 1.2px" />
        <hr style="border: dashed 1px; margin: 1.2px;" />
        <div class="total">
            @php
            $total = 0;
            if (count($penghubung) > 1) {
            foreach ($penghubung as $item) {
            $total += $item->petikemas->harga;
            }
            } else {
            $item = $penghubung[0];
            $total = $item->petikemas->harga;
            }
            @endphp
            <p>Subtotal {{count($penghubung)}} Peti kemas: {{$total}}</p>
            <p>Total Tagihan: {{$total}}</p>
            @foreach ($penghubung as $item)
            <p>Metode Pembayaran: {{$item->pembayaran-> metode}}</p>
            @break
            @endforeach
        </div>
        <div class="footer">
            <p style="text-align : center">
                Terbayar<br />
                {{now()->format('d M y H:i')}}
            </p>
        </div>
    </div>
</body>

</html>