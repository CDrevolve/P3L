<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Karyawan</title>
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
        .btn-edit {
            background-color: #4caf50;
        }
        .btn:hover {
            background-color: #0056b3;
        }
        .btn-delete {
            background-color: #f44336;
        }
    </style>
</head>
<body>
    <div class="container">

    <h1>Detail Karyawan</h1>
    <div>
        <h1><strong>Nama Karyawan:</strong> {{ $karyawan->nama }}</h1>
        <p><strong>Tanggal Lahir:</strong> {{ $karyawan->tanggal_lahir }}</p>
        <p><strong>Alamat Karyawan:</strong> {{ $karyawan->alamat }}</p>
        <p><strong>No. Telepon Karyawan:</strong> {{ $karyawan->no_telp }}</p>
        <p><strong>Gaji:</strong> {{ $karyawan->gaji }}</p>
        <!-- Tambahkan informasi detail lainnya sesuai kebutuhan -->
    </div>
    <a href="{{ route('karyawan.edit', $karyawan->id) }}" class="btn btn-edit">Edit</a>
    <!-- Tambahkan tombol untuk mengedit data karyawan -->
    <form action="{{ route('karyawan.destroy', $karyawan->id) }}" method="POST" style="display: inline;">
        @csrf
        @method('DELETE')
        <button type="submit">Hapus</button>
    </form>
    </div>
</body>
</html>
