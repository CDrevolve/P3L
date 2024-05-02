<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Karyawan</title>
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
        input[type="number"],
        input[type="date"] {
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
    </style>
</head>

<body>
    <div class="container">
        <h1>Edit Karyawan</h1>
        <form action="{{ route('karyawan.update', $karyawan->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div>
                <label for="nama">Nama Karyawan:</label>
                <input type="text" name="nama" id="nama" value="{{ $karyawan->nama }}" required>
            </div>
            <div>
                <label for="tanggal_lahir">Tanggal Lahir:</label>
                <input type="date" name="tanggal_lahir" id="tanggal_lahir" value="{{ $karyawan->tanggal_lahir }}" required>
            </div>
            <div>
                <label for="alamat">Alamat Karyawan:</label>
                <input type="text" name="alamat" id="alamat" value="{{ $karyawan->alamat }}" required>
            </div>
            <div>
                <label for="notelp">No. Telepon Karyawan:</label>
                <input type="text" name="notelp" id="notelp" value="{{ $karyawan->notelp }}" required>
            </div>
            <div>
                <label for="gaji">Gaji:</label>
                <input type="number" name="gaji" id="gaji" value="{{ $karyawan->gaji }}" required>
            </div>
            <!-- Add more inputs for other karyawan data here -->
            <button type="submit">Simpan Perubahan</button>
        </form>
    </div>
</body>

</html>