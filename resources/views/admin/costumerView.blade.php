<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Costumer View</title>
</head>

<body>
    <table>
        <thead>
            <tr>
                <th>Id</th>
                <th>Nama</th>
                <th>Alamat</th>
                <th>Saldo</th>
                <th>Nomor Telepon</th>
                <th>Poin</th>
            </tr>
        </thead>
        <tfoot>
            <tr>
                <th>Id</th>
                <th>Nama</th>
                <th>Alamat</th>
                <th>Saldo</th>
                <th>Nomor Telepon</th>
                <th>Poin</th>
                <th>History</th>
            </tr>
        </tfoot>

        @foreach($costumers as $costumer)
        <tr>
            <td>{{ $costumer->id }}</td>
            <td>{{ $costumer->nama }}</td>
            <td>{{ $costumer->alamat }}</td>
            <td>{{ $costumer->saldo }}</td>
            <td>{{ $costumer->no_telp }}</td>
            <td>{{ $costumer->poin }}</td>
            <td><a href="{{ route('costumer.history', $costumer->id) }}">History</a></td>
        </tr>
        @endforeach
    </table>



</body>

</html>