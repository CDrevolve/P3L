<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Produk: {{ $produk->nama_produk }}</title>
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
            margin-top: 0;
            color: #333;
            text-align: center;
        }

        form {
            margin-top: 20px;
        }

        label {
            font-weight: bold;
        }

        input[type="text"],
        select {
            width: calc(100% - 16px);
            padding: 8px;
            margin-top: 5px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }

        button {
            display: block;
            width: 100%;
            background-color: #4caf50;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            margin-top: 20px;
        }

        button:hover {
            background-color: #45a049;
        }

        .back-link {
            display: block;
            text-align: left;
            margin-top: 10px;
            text-decoration: none;
            color: #007bff;
        }
    </style>
</head>
<body>
    <div class="container">
    <a href="{{ route('produk.show', $produk->id_produk) }}" class="back-link">Kembali</a>
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

    </div>
</body>
</html>
