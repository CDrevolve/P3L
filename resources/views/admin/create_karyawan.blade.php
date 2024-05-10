<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Karyawan</title>
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
        input[type="number"],
        input[type="date"] {
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
        <h1>Tambah Karyawan</h1>
        <form action="{{ route('karyawan.store') }}" method="POST">
            @csrf
            <div>
                <label for="nama">Nama Karyawan:</label>
                <input type="text" name="nama" id="nama" required>
            </div>
            <div>
                <label for="tanggal_lahir">Tanggal Lahir:</label>
                <input type="date" name="tanggal_lahir" id="tanggal_lahir" required>
            </div>
            <div>
                <label for="alamat">Alamat Karyawan:</label>
                <input type="text" name="alamat" id="alamat" required>
            </div>
            <div>
                <label for="no_telp">Nomor Telepon Karyawan:</label>
                <input type="text" name="no_telp" id="no_telp" required>
            </div>
            <div>
                <label for="gaji">Gaji:</label>
                <input type="number" name="gaji" id="gaji" min="0" required>
            </div>
            <button type="submit">Tambah Karyawan</button>
        </form>
    </div>
</body>

</html>