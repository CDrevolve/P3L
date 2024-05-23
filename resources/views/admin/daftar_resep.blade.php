<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Resep</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .container {
            margin-top: 50px;
        }
    </style>
</head>
<body>
    <div class="container">
        <a href="{{ route('admin') }}" class="btn btn-secondary mb-3">Back</a>
        <h1>Daftar Resep</h1>

        <!-- Form pencarian -->
        <form action="{{ route('resep.index') }}" method="GET" class="form-inline mb-3">
            <input type="text" name="keyword" class="form-control mr-2" placeholder="Cari resep..." value="{{ $keyword }}">
            <button type="submit" class="btn btn-success">Cari</button>
        </form>

        <a href="{{ route('resep.create') }}" class="btn btn-primary mb-3">Tambah Resep</a>

        <table class="table table-bordered table-striped">
            <thead class="thead-dark">
                <tr>
                    <th>Nama</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($reseps as $resep)
                <tr>
                    <td>{{ $resep->nama }}</td>
                    <td>
                        <a href="{{ route('resep.show', $resep->id) }}" class="btn btn-success">Detail</a>
                        <a href="{{ route('resep.edit', $resep->id) }}" class="btn btn-primary">Edit</a>
                        <form action="{{ route('resep.destroy', $resep->id) }}" method="POST" style="display: inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Hapus</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
