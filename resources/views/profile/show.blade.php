<!DOCTYPE html>
<html lang="en">

<head>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #FEFAF6;
        }

        .container {
            max-width: 800px;
            margin: 50px auto;
            padding: 20px;
            background-color:#FFD9C0;
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
        <div class="title">
        <a href="{{route('actionLogout')}}">logout</a>

            <h5>User Information</h5>
        </div>
        <div class="row">
            <div class="col-md-3">
                <div class="photo-profile">
                    <img src="{{ $customer->foto }}" class="card-img-top rounded-circle" alt="Avatar">
                </div>
            </div>

            <div class="col-md-3">
                <div class="user-box">
                    <h5>Username</h5>
                    <p>{{ $user->username }}</p>
                    <h5>Email</h5>
                    <p>{{ $user->email }}</p>
                    <h5>Nama</h5>
                    <p>{{ $customer->nama }}</p>
                    <h5>Tanggal Lahir</h5>
                    <p>{{ $customer->tanggal_lahir }}</p>
                    <h5>No Telp</h5>
                    <p>{{ $customer->no_telp }}</p>
                </div>
                <a href="{{ route('profile.edit') }}">Edit Profil</a>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="title">
            <h5>Order History</h5>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="order-history-btn">
                    <a href="{{ route('profile.history') }}" class="btn">Order History</a>
                </div>
            </div>
        </div>
    </div>
</body>

</html>