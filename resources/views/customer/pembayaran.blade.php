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
        <form action="/pembayaran" method="POST">
            @csrf
            <label for="nama">Nama</label>
            <input type="text" name="nama" id="nama" required>
            <br>
            <label for="nomor">Nomor</label>
            <input type="text" name="nomor" id="nomor" required>
            <br>
            <label for="jumlah">Jumlah</label>
            <input type="text" name="jumlah" id="jumlah" required>
            <br>
            <button type="submit">Bayar</button>
        </form>
    </div>
</body>

</html>