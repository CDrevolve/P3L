<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css'>
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
    <!-- //PENTING BANGET INI// -->
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/simple-datatables" type="text/javascript"></script>
    <script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.3.0/dist/umd/simple-datatables.min.js" crossorigin="anonymous"></script>

    <!-- sangat penting -->
    <link href="{{ asset('css/styles.css') }}" rel="stylesheet" />


    <title>Register</title>
</head>

<body>
    <div class="container" style="background-color: #FFD9C0;">


        <form method="post" action="{{route('actionRegister')}}" enctype="multipart/form-data">
            @csrf
            <div>
                <label>Nama</label>
                <input class="form-control" type="username" name="username" placeholder="Username" required>
            </div>
            <div>
                <label>Email</label>
                <input class="form-control" type="email" name="email" placeholder="Email" required>
            </div>
            <div>
                <label>Password</label>
                <input class="form-control" type="password" name="password" placeholder="Password" required>
            </div>
            <div>
                <label>Tanggal Lahir</label>
                <input class="form-control" type="date" name="tanggal_lahir" placeholder="tanggal lahir" required>
            </div>
            <div>
                <label>Alamat</label>
                <input class="form-control" type="text" name="alamat" placeholder="alamat" required>
            </div>
            <div>
                <label>Nomor Telepon</label>
                <input class="form-control" type="text" name="no_telp" placeholder="nomor telepon" required>
            </div>
            <div>
                <label>Foto</label>
                <input class="form-control" type="file" name="foto" placeholder="foto" required>
            </div>

            <hr>

            <button class="btn btn-success">Register</button>

            <hr>

            <p>Sudah punya akun?<a href="{{route('login')}}">Login disini</a></p>
        </form>
    </div>
</body>

</html>