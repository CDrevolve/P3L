<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Profil</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f2f2f2;
        }

        .container {
            max-width: 800px;
            margin: 50px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .title {
            text-align: center;
            margin-bottom: 20px;
        }

        .photo-profile {
            text-align: center;
            margin-bottom: 20px;
        }

        .photo-profile img {
            width: 150px;
            height: 150px;
            border-radius: 50%;
            border: 3px solid #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            cursor: pointer;
        }

        .user-box {
            padding: 20px;
            background-color: #f9f9f9;
            border-radius: 8px;
        }

        .user-box h5 {
            margin-top: 10px;
            margin-bottom: 5px;
        }

        .form-control {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }

        .btn {
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        .btn-cancel {
            background-color: #ccc;
            color: #000;
            margin-right: 10px;
        }

        .btn-update {
            background-color: #007bff;
            color: #fff;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1 class="title">Edit Profil</h1>
        <form action="{{ route('profile.update') }}" method="POST">
            @csrf
            @method('PUT')
            <div class="user-box">
                <div>
                    <label for="username">Username:</label>
                    <input type="text" name="username" id="username" value="{{ $user->username }}" class="form-control" required>
                </div>
                <div>
                    <label for="email">Email:</label>
                    <input type="email" name="email" id="email" value="{{ $user->email }}" class="form-control" required>
                </div>
                <button type="submit" class="btn btn-update">Simpan Perubahan</button>
            </div>
        </form>
    </div>
</body>
</html>