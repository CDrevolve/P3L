<!-- resources/views/admin/dashboard.blade.php -->

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Owner Dashboard</title>
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
            text-align: center;
        }

        h1 {
            color: #333;
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
    </style>
</head>

<body>
    <div class="container">
        <h1>Welcome to Owner Dashboard</h1>
         <a href="{{route('actionLogout')}}">logout</a>
        <a href="{{ route('owner.karyawann') }}" class="btn">Manage Gaji Karyawan</a>
        <a href="{{ route('owner.profile.editPassword') }}" class="btn">Change Password</a>
 

    </div>
</body>

</html>
