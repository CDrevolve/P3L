<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>login</title>
</head>

<body>
    @if(Session::has('Error'))
    <div class="alert alert-danger">
        {{ Session::get('Error') }}
    </div>
    @endif

    <form method="post" action="{{route('actionLogin')}}">
        @csrf
        <div>
            <label>Email</label>
            <input class="email" type="email" name="email" placeholder="Email" required>
        </div>
        <div>
            <label>Password</label>
            <input class="password" type="password" name="password" placeholder="Password" required>
        </div>

        <button type="submit">Login</button>
        <hr>
        <p class="register"> Belum Punya Akun? <a href="{{route('register')}}">Sign Up</a></p>
        
        <p class="forgot"> Lupa Password? <a href="{{route('resetPassword')}}">Reset Password</a></p>
    </form>
</body>

</html>