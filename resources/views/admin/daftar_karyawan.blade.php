<!-- resources/views/admin/daftar_karyawan.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Karyawan</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #FEFAF6;
            color: #333;
        }

        .container {
            width: 80%;
            margin: 20px auto;
            padding: 20px;
            background-color: #FFD9C0;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h1 {
            text-align: center;
            margin-bottom: 20px;
        }

        a.button {
            display: inline-block;
            padding: 10px 20px;
            background-color: #007bff;
            color: #fff;
            text-decoration: none;
            border-radius: 5px;
            margin-bottom: 20px;
        }

        form {
            margin-bottom: 20px;
        }

        input[type="text"] {
            padding: 10px;
            width: 200px;
            border-radius: 5px;
            border: 1px solid #ccc;
            margin-right: 10px;
        }

        button[type="submit"] {
            padding: 10px 20px;
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        ul {
            list-style-type: none;
            padding: 0;
        }

        li {
            background-color: #f9f9f9;
            margin-bottom: 10px;
            padding: 10px;
            border-radius: 5px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        li a {
            text-decoration: none;
            color: #007bff;
        }

        li a:hover {
            text-decoration: underline;
        }

        .button-group {
            display: flex;
            align-items: center;
        }

        .button-group button {
            padding: 8px 16px;
            background-color: #dc3545;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            margin-left: 10px;
        }

        .button-group button:hover {
            background-color: #c82333;
        }
    </style>
</head>
<body>
    <div class="container">
        
        <a href="{{ route('admin') }}" class="text">Back</a>
        <h1>Daftar Karyawan</h1>
        
        <form action="{{ route('karyawan.index') }}" method="GET">
            <input type="text" name="keyword" placeholder="Cari karyawan...">
            <button type="submit">Cari</button>
        </form>

        <ul>
            @forelse ($karyawan as $item)
                <li>
                    <div>
                        <a href="{{ route('karyawan.show', $item->id) }}">{{ $item->nama }}</a>
                    </div>
                    <div class="button-group">
                        <a href="{{ route('karyawan.edit', $item->id) }}" class="button">Edit</a>
                        <form action="{{ route('karyawan.destroy', $item->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit">Delete</button>
                        </form>
                    </div>
                </li>
            @empty
                <li>Tidak ada karyawan yang ditemukan.</li>
            @endforelse
        </ul>

        <a href="{{ route('karyawan.create') }}" class="button">Tambah Karyawan</a>
    </div>
</body>
</html>
