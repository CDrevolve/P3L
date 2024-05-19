<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>login</title>

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

</head>

<body>
    @if(Session::has('Error'))
    <div class="alert alert-danger">
        {{ Session::get('Error') }}
    </div>
    @endif

    <div class="container" style="background-color: #FFD9C0;">


        <form method="post" action="{{route('actionLogin')}}">
            @csrf
            <div>
                <label>Email</label>
                <input class="email form-control" type="email" name="email" placeholder="Email" required>
            </div>
            <div>
                <label>Password</label>
                <input class="password form-control" type="password" name="password" placeholder="Password" required>
            </div>
            <hr>

            <button type="submit" class="btn btn-primary">Login</button>
            <hr>
            <p class="register"> Belum Punya Akun? <a href="{{route('register')}}">Sign Up</a></p>

            <p class="forgot"> Lupa Password? <a href="{{route('forgetPassword')}}">Reset Password</a></p>
        </form>

    </div>
</body>

</html>