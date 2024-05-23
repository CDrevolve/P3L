<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #FEFAF6;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        .container {
            display: flex;
            background-color: #FEFAF6;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
            overflow: hidden;
            max-width: 900px;
            width: 100%;
        }

        .left {
            background-color: #FEFAF6;
            padding: 40px;
            flex: 1;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            text-align: center;
        }

        .left h1 {
            font-size: 32px;
            margin-bottom: 10px;
        }

        .left p {
            font-size: 16px;
            color: #666;
        }

        .right {
            background-color: #FFD9C0;
            padding: 40px;
            flex: 1;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-control {
            border-radius: 4px;
            border: 1px solid #ccc;
            padding: 10px;
        }

        .btn-primary {
            background-color: #007bff;
            border: none;
            padding: 12px;
            border-radius: 4px;
            width: 100%;
            font-size: 16px;
        }

        .btn-primary:hover {
            background-color: #0056b3;
        }

        .form-footer {
            text-align: center;
            margin-top: 20px;
        }

        .form-footer a {
            color: #007bff;
            text-decoration: none;
        }

        .form-footer a:hover {
            text-decoration: underline;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="left">
            <h1>Atma Kitchen</h1>
            <p>Every Bite, Every Sip, a Celebration of Taste!</p>
        </div>
        <div class="right">
            <h2 class="text-center mb-4">Sign up now</h2>
            <form method="post" action="{{ route('actionRegister') }}" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label for="username">Nama</label>
                    <input type="text" class="form-control" id="username" name="username" placeholder="Username" required>
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" class="form-control" id="email" name="email" placeholder="Email" required>
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" class="form-control" id="password" name="password" placeholder="Password" required>
                </div>
                <div class="form-group">
                    <label for="tanggal_lahir">Tanggal Lahir</label>
                    <input type="date" class="form-control" id="tanggal_lahir" name="tanggal_lahir" placeholder="Tanggal Lahir" required>
                </div>
                <div class="form-group">
                    <label for="alamat">Alamat</label>
                    <input type="text" class="form-control" id="alamat" name="alamat" placeholder="Alamat" required>
                </div>
                <div class="form-group">
                    <label for="no_telp">Nomor Telepon</label>
                    <input type="text" class="form-control" id="no_telp" name="no_telp" placeholder="Nomor Telepon" required>
                </div>
                <div class="form-group">
                    <label for="foto">Foto</label>
                    <input type="file" class="form-control" id="foto" name="foto" required>
                </div>
                <button type="submit" class="btn btn-primary">Sign up</button>
                <div class="form-footer mt-3">
                    <p>Sudah punya akun? <a href="{{ route('login') }}">Login disini</a></p>
                </div>
            </form>
        </div>
    </div>
</body>

</html>
