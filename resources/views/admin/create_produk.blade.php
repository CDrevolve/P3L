<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>tambahProduk</title>
</head>
<body>
<h1>Tambah Produk</h1>
    <form action="{{ route('produk.store') }}" method="POST">
        @csrf
        <div>
            <label for="nama_produk">Nama Produk:</label>
            <input type="text" name="nama_produk" id="nama_produk" required>
        </div>
        <div>
            <label for="id_jenis">ID jenis:</label>
            <input type="text" name="id_jenis" id="id_jenis" required>
        </div>
        <div>
            <label for="id_resep">ID resep:</label>
            <input type="text" name="id_resep" id="id_resep" required>
        </div>
        <div>
            <label for="stok_produk">Stok Produk:</label>
            <input type="text" name="stok_produk" id="stok_produk" required>
        </div>
        <div>
            <label for="harga_produk">Harga:</label>
            <input type="text" name="harga_produk" id="harga_produk" required>
        </div>
        <div>
            <label for="kuota_harian">Kuota Harian:</label>
            <input type="text" name="kuota_harian" id="kuota_harian" required>
        </div>
        <button>Tambah Produk</button>
    </form>
</body>
</html>