<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Seluruh Karyawan</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #FEFAF6;
        }

        .container {
            max-width: 800px;
            margin: 20px auto;
            padding: 20px;
            background-color: #FFD9C0;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h2 {
            color: #333;
            text-align: center;
        }

        .karyawan {
            list-style: none;
            padding: 0;
            margin-top: 20px;
        }

        .karyawan-item {
            background-color: #fff;
            border-radius: 5px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            padding: 15px;
            margin-bottom: 10px;
        }

        .karyawan-item:hover {
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .karyawan-item a {
            text-decoration: none;
            color: #333;
        }

        .karyawan-item .karyawan-nama {
            font-weight: bold;
        }

        .karyawan-item .karyawan-gaji {
            color: #007bff;
            font-weight: bold;
        }

        .karyawan-item .aksi {
            text-align: right;
        }

        .btn-edit {
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 4px;
            padding: 6px 12px;
            text-decoration: none;
        }

        .btn-edit:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <div class="container">
    <a href="{{ route('owner') }}" class="button">Back</a>
        <h2>Seluruh Karyawan</h2>
        <ul class="karyawan">
            @foreach ($karyawann as $karyawan)
            <li class="karyawan-item">
                <span class="karyawan-nama">{{ $karyawan->nama }}</span> - <span class="karyawan-gaji">{{ $karyawan->gaji }}</span>
                <div class="aksi">
                    <a href="{{ route('owner.edit_gaji', $karyawan->id) }}" class="btn-edit">Edit</a>
                </div>
            </li>
            @endforeach
        </ul>
    </div>
</body>
</html>
