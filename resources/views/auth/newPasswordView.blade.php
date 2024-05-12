<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Change Password</title>
</head>

<body>

    <form method="post" action="{{route('newPassPost')}}">
        @csrf
        <input type="text" hidden name="token" value="{{$token}}">
        <div>
            <label>Password</label>
            <input class="password" type="password" name="password" placeholder="Password" required>
        </div>
        <div>
            <label>Confirm Password</label>
            <input class="password" type="password" name="password_confirmation" placeholder="Confirm Password" required>
        </div>
        <button type="submit">Reset Password</button>
    </form>

</body>

</html>