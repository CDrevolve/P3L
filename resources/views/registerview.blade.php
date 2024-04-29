<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
</head>
<body>
    <form method="post" action="{{route('actionRegister')}}">
    @csrf
    <div>
        <label>Username</label>
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

    <button>Register</button>

    <p>Sudah punya akun?<a href="{{route('login')}}">Login disini</a></p>
    </form>
</body>
</html>