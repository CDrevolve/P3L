<!-- resources/views/owner/karyawan.blade.php -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Seluruh Karyawan</title>
</head>
<body>
    <div class="container">
        <h2>Seluruh Karyawan</h2>
        <table>
            <thead>
                <tr>
                    <th>Nama</th>
                    <th>Gaji</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($karyawann as $karyawan)
                    <tr>
                        <td>{{ $karyawan->nama }}</td>
                        <td>{{ $karyawan->gaji }}</td>
                        <td>
                            <a href="{{ route('owner.edit_gaji', $karyawan->id) }}">Edit</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</body>
</html>
