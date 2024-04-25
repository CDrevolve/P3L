<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Resep</title>
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

        h1 {
            color: #333;
            text-align: center;
        }

        ul {
            list-style-type: none;
            padding: 0;
        }

        li {
            margin-bottom: 10px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        a {
            color: #007bff;
            text-decoration: none;
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

        .search-form {
            margin-bottom: 20px;
        }

        .search-input {
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 4px;
            margin-right: 10px;
            width: 300px;
        }

        .search-btn {
            padding: 8px 16px;
            background-color: #4caf50;
            color: #fff;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            text-align: center;
            text-decoration: none;
            transition: background-color 0.3s;
        }

        .search-btn:hover {
            background-color: #45a049;
        }
    </style>
</head>

<body>
    <div class="container">
        <h1>Daftar Resep</h1>

        <!-- Form pencarian -->
        <form action="{{ route('resep.index') }}" method="GET" class="search-form">
            <input type="text" name="keyword" class="search-input" placeholder="Cari resep..." value="{{ $keyword }}">
            <button type="submit" class="search-btn">Cari</button>
        </form>

        <ul>
            @foreach ($reseps as $resep)
            <li>
                <a href="{{ route('resep.show', $resep->id_resep) }}">{{ $resep->nama_resep }}</a>
                <div>
                    <a href="{{ route('resep.edit', $resep->id_resep) }}" class="btn btn-edit">Edit</a>
                    <form action="{{ route('resep.destroy', $resep->id_resep) }}" method="POST" style="display: inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-delete">Hapus</button>
                    </form>
                </div>
            </li>
            @endforeach
        </ul>
        <a href="{{ route('resep.create') }}" class="btn">Tambah Resep</a>
    </div>
</body>

</html>
