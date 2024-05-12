<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password</title>
</head>

<body>
    <div>
        <p>We will send a link to you email, use that link to reset password</p>
        <form method="post" action="{{route('sendEmail')}}">
            @csrf
            <div>
                <label>Email</label>
                <input class="email" type="email" name="email" placeholder="Email" required>
            </div>
            <button type="submit">Reset Password</button>
        </form>
    </div>

    <div>
        <a class="nav-link" href="{{route('login')}}">Login</a>
    </div>

</body>

</html>