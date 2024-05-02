<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>tambahProduk</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #FEFAF6;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 600px;
            margin: 50px auto;
            padding: 20px;
            background-color: #FFD9C0;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h1 {
            text-align: center;
            margin-bottom: 20px;
        }

        form {
            max-width: 400px;
            margin: 0 auto;
        }

        label {
            font-weight: bold;
            margin-bottom: 5px;
            display: block;
        }

        input[type="text"],
        select {
            width: 100%;
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #ddd;
            border-radius: 4px;
            box-sizing: border-box;
        }

        button[type="submit"] {
            background-color: #007bff;
            color: #fff;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            display: block;
            width: 100%;
        }

        button[type="submit"]:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
<div class="container">
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
    </div>
    </form>
</body>
</html>