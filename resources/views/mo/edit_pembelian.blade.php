<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Pembelian</title>

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- jQuery UI -->
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>

    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
        }

        h2 {
            margin-bottom: 20px;
        }

        form {
            width: 300px;
            margin: 0 auto;
        }

        label {
            display: block;
            margin-bottom: 5px;
        }

        input[type="text"],
        input[type="number"] {
            width: calc(100% - 10px);
            padding: 5px;
            margin-bottom: 10px;
        }

        button[type="submit"] {
            background-color: #4CAF50;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        button[type="submit"]:hover {
            background-color: #45a049;
        }

        .error {
            color: red;
        }
    </style>

</head>
<body>
    <h2>Edit Pembelian</h2>

    @if ($errors->any())
        <div class="error">
            <strong>Error:</strong>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('pembelian.update', $pembelian->id_pengeluaran) }}" method="POST">
        @csrf
        @method('PUT')

        <label for="id_bahanbaku">ID Bahan Baku:</label>
        <input type="number" name="id_bahanbaku" id="id_bahanbaku" value="{{ $pembelian->id_bahanbaku }}" required><br>

        <label for="nama">Nama:</label>
        <input type="text" name="nama" id="nama" value="{{ $pembelian->nama }}" required><br>

        <label for="jenis">Jenis:</label>
        <input type="text" name="jenis" id="jenis" value="{{ $pembelian->jenis }}" required><br>

        <label for="harga">Harga:</label>
        <input type="number" name="harga" id="harga" value="{{ $pembelian->harga }}" required><br>

        <label for="jumlah">Jumlah:</label>
        <input type="number" name="jumlah" id="jumlah" value="{{ $pembelian->jumlah }}" required><br>

        <label for="tanggal">Tanggal:</label>
        <input type="text" name="tanggal" id="tanggal" value="{{ $pembelian->tanggal }}" required><br>

        <button type="submit">Submit</button>
    </form>

    <script>
        // Datepicker initialization
        $(function() {
            $("#tanggal").datepicker({
                dateFormat: "yy-mm-dd"
            });
        });
    </script>
</body>
</html>
