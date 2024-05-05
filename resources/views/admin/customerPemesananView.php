<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=t, initial-scale=1.0">
    <title>History</title>
</head>

<body>
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Produk</th>
                <th>Jumlah</th>
                <th>Total Harga</th>
                <th>Status</th>
            </tr>
        </thead>
        <tfoot>
            <tr>
                <th>No</th>
                <th>Nama Produk</th>
                <th>Jumlah</th>
                <th>Total Harga</th>
                <th>Status</th>
            </tr>
        </tfoot>

        <?php $no = 1; ?>
        @foreach ($pemesanan as $pemesanan)
        <tr>
            <td>{{ $no++ }}</td>
            <td>{{ $pemesanan->nama_produk }}</td>
            <td>{{ $pemesanan->jumlah }}</td>
            <td>{{ $pemesanan->total_harga }}</td>
            <td>{{ $pemesanan->status }}</td>
        </tr>
        @endforeach
    </table>
</body>

</html>