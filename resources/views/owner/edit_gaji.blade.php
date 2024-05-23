<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Gaji Karyawan</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #FEFAF6;
        }

        .container {
            max-width: 400px;
            margin: 20px auto;
            padding: 20px;
            background-color: #FFD9C0;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h2 {
            color: #333;
            text-align: center;
            margin-bottom: 20px;
        }

        form {
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        label {
            font-weight: bold;
            margin-bottom: 5px;
        }

        input[type="number"] {
            padding: 8px;
            border-radius: 4px;
            border: 1px solid #ccc;
            width: 100%;
            margin-bottom: 15px;
        }

        input[type="submit"] {
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

        input[type="submit"]:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Edit Gaji Karyawan</h2>
        <form method="POST" action="{{ route('owner.update_gaji', $karyawann) }}">
            @csrf
            @method('PUT')

            <label for="gaji">Gaji:</label>
            <input type="number" id="gaji" name="gaji" value="{{ $karyawann->gaji }}" required>

            <input type="submit" value="Update Gaji">
        </form>
    </div>
</body>
</html>
