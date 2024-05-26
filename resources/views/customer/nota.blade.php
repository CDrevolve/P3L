<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nota Pemesanan</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        .nota {
            border: 1px solid #000;
            padding: 20px;
            width: 600px;
            margin: auto;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    <div class="nota">
        <h2>Nota Pemesanan</h2>
        <p>Atma Kitchen<br>
        Jl. Centralpark No. 10 Yogyakarta</p>
        <p>No Nota: {{ $order->no_nota }}<br>
        Tanggal pesan: {{ \Carbon\Carbon::parse($order->tanggal)->format('d/m/Y H:i') }}<br>
        Lunas pada: {{ \Carbon\Carbon::now()->format('d/m/Y H:i') }}<br>
        Tanggal ambil: {{ \Carbon\Carbon::parse($order->tanggal)->addDays(3)->format('d/m/Y H:i') }}</p>

        <p>Customer: {{ $user->email }} / {{ $order->customer->nama }}<br>
        {{ optional($order->alamat)->nama }}<br>
        Delivery: Kurir Yummy Kitchen</p>

        <table class="table">
            <thead>
                <tr>
                    <th>Nama Produk</th>
                    <th>Jumlah</th>
                    <th>Harga</th>
                </tr>
            </thead>
            <tbody>
                @foreach($details as $index => $detail)
                <tr>
                    <td>{{ optional($produks[$index])->nama }}</td>
                    <td>{{ $detail->jumlah }}</td>
                    <td>Rp {{ number_format(optional($produks[$index])->harga * $detail->jumlah, 0, ',', '.') }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <p>Total: Rp {{ number_format($order->harga, 0, ',', '.') }}<br>
        Ongkos Kirim: Rp {{ number_format($order->ongkir, 0, ',', '.') }}<br>
        Total Pembayaran: Rp {{ number_format($order->jumlah_pembayaran, 0, ',', '.') }}</p>
        <p>Poin dari pesanan ini: {{ $order->poin_diperoleh }}<br>
        Total poin customer: {{ optional($order->customer)->poin + $order->poin_diperoleh }} </p>
    </div>
</body>
</html>
