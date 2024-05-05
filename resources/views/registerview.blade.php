<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
</head>

<body>
    <form method="post" action="{{route('actionRegister')}}" enctype="multipart/form-data">
        @csrf
        <div>
            <label>Nama</label>
            <input type="username" name="username" placeholder="Username" required>
        </div>
        <div>
            <label>Email</label>
            <input type="email" name="email" placeholder="Email" required>
        </div>
        <div>
            <label>Password</label>
            <input type="password" name="password" placeholder="Password" required>
        </div>
        <div>
            <label>Tanggal Lahir</label>
            <input type="date" name="tanggal_lahir" placeholder="tanggal lahir" required>
        </div>
        <div>
            <label>Alamat</label>
            <input type="text" name="alamat" placeholder="alamat" required>
        </div>
        <div>
            <label>Nomor Telepon</label>
            <input type="text" name="no_telp" placeholder="nomor telepon" required>
        </div>
        <div>
            <label>Foto</label>
            <input type="file" name="foto" placeholder="foto" required>
        </div>

        <button>Register</button>

        <p>Sudah punya akun?<a href="{{route('login')}}">Login disini</a></p>
    </form>
</body>

</html>