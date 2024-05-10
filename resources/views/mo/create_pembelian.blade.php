<!DOCTYPE html>
<html lang="en">

<head>
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- jQuery UI -->
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Pembelian</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        .container {
            width: 80%;
            margin: auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            margin-top: 50px;
        }

        h2 {
            text-align: center;
            margin-bottom: 20px;
        }

        form {
            max-width: 400px;
            margin: auto;
        }

        label {
            font-weight: bold;
        }

        input[type="text"],
        input[type="number"] {
            width: calc(100% - 10px);
            padding: 8px;
            margin-bottom: 15px;
            border: 1px solid #ddd;
            border-radius: 4px;
            box-sizing: border-box;
        }

        input[type="submit"] {
            background-color: #4CAF50;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            width: 100%;
        }

        input[type="submit"]:hover {
            background-color: #45a049;
        }
    </style>
</head>

<body>
    <div class="container">
        <h2>Create Pembelian</h2>

        @if ($errors->any())
        <div>
            <strong>Error:</strong>
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        <form action="{{ route('pembelian.store') }}" method="POST">
            @csrf
            <label for="id_bahanbaku">ID Bahan Baku:</label>
            <input type="number" name="id_bahanbaku" id="id_bahanbaku" required><br>

            <label for="nama">Nama:</label>
            <input type="text" name="nama" id="nama" required><br>

            <label for="harga">Harga:</label>
            <input type="number" name="harga" id="harga" required><br>

            <label for="jumlah">Jumlah:</label>
            <input type="number" name="jumlah" id="jumlah" required><br>

            <label for="tanggal">Tanggal:</label>
            <input type="date" name="tanggal" id="tanggal" required><br>

            <button type="submit">Submit</button>
        </form>
    </div>

</body>

</html>