<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Resep</title>
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
        }

        label {
            font-weight: bold;
        }

        input[type="text"],
        select {
            width: 100%;
            padding: 8px;
            margin-top: 5px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }

        button {
            background-color: #4caf50;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        button:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Edit Resep</h1>
        <form action="{{ route('resep.update', $resep->id) }}" method="POST">
            @csrf
            @method('PUT') <!-- Gunakan metode PUT untuk update -->
            <div>
                <label for="nama">Nama Resep:</label>
                <input type="text" name="nama" id="nama" value="{{ $resep->nama }}" required>
            </div>
            <div>
                <label for="id_bahan_baku">Bahan Baku:</label>
                <select name="id_bahan_baku" id="id_bahan_baku" required>
                    @foreach ($resep->detailProduks as $detailProduk)
                        <option value="{{ $detailProduk->bahanBaku->id_bahan_baku }}" {{ $detailProduk->bahanBaku->id_bahan_baku == $detailProduk->id_bahan_baku ? 'selected' : '' }}>
                            {{ $detailProduk->bahanBaku->id_bahan_baku }} - {{ $detailProduk->bahanBaku->nama_bahan_baku }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div>
                <label for="bahan_baru">Bahan Baku Baru:</label>
                <select name="bahan_baru" id="bahan_baru" required> <!-- Ubah nama input menjadi "bahan_baru" -->
                    @foreach ($bahanBaku as $bb)
                        <option value="{{ $bb->id_bahan_baku }}">{{ $bb->id_bahan_baku }} - {{ $bb->nama_bahan_baku }}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <label for="jumlah">Jumlah:</label>
                <input type="text" name="jumlah" id="jumlah" value="{{ $detailProduk->jumlah }}" required>
            </div>
            <button type="submit">Update Resep</button>
        </form>
    </div>
</body>
</html>
