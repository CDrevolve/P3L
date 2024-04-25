<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Produk: {{ $produk->nama_produk }}</title>
</head>
<body>
<h1>Edit Produk: {{ $produk->nama_produk }}</h1>
<form action="{{ route('produk.update', $produk->id_produk) }}" method="POST">
    @csrf
    @method('PUT')
    <div>
        <label for="nama_produk">Nama Produk:</label>
        <input type="text" name="nama_produk" id="nama_produk" value="{{ $produk->nama_produk }}" required>
    </div>
    <div>
        <label for="stok_produk">Stok Produk:</label>
        <input type="text" name="stok_produk" id="stok_produk" value="{{ $produk->stok_produk }}" required>
    </div>
    <div>
        <label for="harga_produk">Harga:</label>
        <input type="text" name="harga_produk" id="harga_produk" value="{{ $produk->harga_produk }}" required>
    </div>
    <div>
        <label for="kuota_harian">Kuota Harian:</label>
        <input type="text" name="kuota_harian" id="kuota_harian" value="{{ $produk->kuota_harian }}" required>
    </div>
    <button type="submit">Simpan Perubahan</button>
</form>
<a href="{{ route('produk.show', $produk->id_produk) }}">Kembali</a>
</body>
</html>
