<!-- resources/views/admin/daftar_karyawan.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Karyawan</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .container {
            margin-top: 50px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Daftar Karyawan</h1>
        <a href="{{ route('karyawan.create') }}" class="btn btn-primary mb-3">Tambah Karyawan</a>
        <form action="{{ route('karyawan.index') }}" method="GET" class="form-inline mb-3">
            <input type="text" name="keyword" class="form-control mr-2" placeholder="Cari karyawan...">
            <button type="submit" class="btn btn-primary">Cari</button>
        </form>
        <table class="table table-bordered table-striped">
            <thead class="thead-dark">
                <tr>
                    <th>Nama</th>
                    <th>Email</th>
                    <th>Posisi</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($karyawan as $item)
                <tr>
                    <td><a href="{{ route('karyawan.show', $item->id) }}">{{ $item->nama }}</a></td>
                    <td>{{ $item->email }}</td>
                    <td>{{ $item->posisi }}</td>
                    <td>
                        <a href="{{ route('karyawan.edit', $item->id) }}" class="btn btn-primary">Edit</a>
                        <form action="{{ route('karyawan.destroy', $item->id) }}" method="POST" style="display: inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Hapus</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="4" class="text-center">Tidak ada karyawan yang ditemukan.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</body>
</html>
