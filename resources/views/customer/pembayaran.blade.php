<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pembayaran</title>
</head>

<body>
    <h1>Pembayaran</h1>
    <div class="container">


        <h4>Total harga yang harus dibayar</h4>
        <h3>{{$pemesanan->harga + $pemesanan->ongkir}}</h3>
        <form action="{{ route('pesananBayar.update', $pemesanan->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <label for="jumlah">Jumlah</label>
            <input type="text" name="total_bayar" id="total_bayar" required>
            <br>
            <label for="bukti_pembayaran">Bukti Pembayaran</label>
            <input type="file" name="bukti_pembayaran" id="bukti_pembayaran" required>
            <br>
            <button type="submit">Bayar</button>
        </form>

    </div>
</body>

</html>