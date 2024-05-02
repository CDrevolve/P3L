<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Produk: {{ $produk->nama_produk }}</title>
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

        h2 {
            margin-bottom: 10px;
        }

        ul {
            list-style-type: none;
            padding: 0;
        }

        li {
            margin-bottom: 10px;
        }
        .btn {
            padding: 8px 16px;
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            text-align: center;
            text-decoration: none;
            transition: background-color 0.3s;
        }

        .btn:hover {
            background-color: #0056b3;
        }

        .btn-edit {
            background-color: #4caf50;
        }

        .btn-delete {
            background-color: #f44336;
        }
    </style>
</head>
<body>
    <div class="container">
    <a href="{{ route('produk.index') }}" style="display: block; margin-top: 20px;">Kembali</a>
        <h1>Detail Produk: {{ $produk->nama_produk }}</h1>
        @if($produk)
            <ul>
                <li><strong>Stok:</strong> {{ $produk->stok_produk }}</li>
                <li><strong>Harga:</strong> {{ $produk->harga_produk }}</li>
                <li><strong>Stok Harian:</strong> {{ $produk->kuota_harian }}</li>
            </ul>
            <a href="{{ route('produk.edit', $produk->id_produk) }}" class="btn">Edit</a>

            <form action="{{ route('produk.destroy', $produk->id_produk) }}" method="POST">
                
                @csrf

                @method('DELETE')

                <button type="submit" class="btn btn-danger">Delete</button>

            </form>
        @else
            <p>Produk tidak ditemukan.</p>
        @endif
    </div>
</body>
</html>
