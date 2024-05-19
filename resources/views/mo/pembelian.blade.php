<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Pembelian</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* Tambahkan gaya kustom di sini jika diperlukan */
        .container {
            margin-top: 50px;
        }
    </style>
</head>

<body>
    <div class="container">
        <h1>Daftar Pembelian Bahan Baku</h1>
        <a href="{{ route('pembelian.create') }}" class="btn btn-primary mb-3">Tambah Pembelian</a>
        <table class="table table-bordered table-striped">
            <thead class="thead-dark">
                <tr>
                    <th>Nama</th>
                    <th>Jumlah</th>
                    <th>Harga</th>
                    <th>Tanggal</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($pembelian as $pembelian)
                <tr>
                    <td>{{ $pembelian->nama }}</td>
                    <td>{{ $pembelian->jumlah }}</td>
                    <td>{{ $pembelian->harga }}</td>
                    <td>{{ $pembelian->tanggal }}</td>
                    <td>
                        <a href="{{ route('pembelian.edit', $pembelian->id) }}" class="btn btn-primary">Edit</a>
                        <form action="{{ route('pembelian.destroy', $pembelian->id) }}" method="POST" style="display: inline;">
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
</body>

</html>