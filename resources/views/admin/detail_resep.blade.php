<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Resep: {{ $resep->nama_resep }}</title>
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
    </style>
</head>

<body>
    <div class="container">
        <h1>Detail Resep: {{ $resep->nama_resep }}</h1>
        <h2>Bahan-bahan:</h2>
        <ul>
            @foreach ($resep->detailProduks as $detailProduk)
            <li>{{ $detailProduk->bahanBaku->nama_bahan_baku }} - {{ $detailProduk->jumlah }}</li>
            @endforeach
        </ul>
    </div>
</body>

</html>
