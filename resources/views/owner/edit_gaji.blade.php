<!-- resources/views/owner/edit_gaji.blade.php -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Gaji Karyawan</title>
</head>
<body>
    <div class="container">
        <h2>Edit Gaji Karyawan</h2>
        <form method="POST" action="{{ route('owner.update_gaji', $karyawann) }}">
            @csrf
            @method('PUT')

            <label for="gaji">Gaji:</label><br>
            <input type="number" id="gaji" name="gaji" value="{{ $karyawann->gaji }}" required><br><br>

            <input type="submit" value="Update Gaji">
        </form>
    </div>
</body>
</html>
