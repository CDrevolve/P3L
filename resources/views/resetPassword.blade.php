<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password</title>
</head>

<body>
    <h1>
        RESET PASSWORD
    </h1>

    <div>
        <h2>
            <form action="resetPassword.blade.php" method="post">
                <label for="email">Email:</label>
                <input type="email" name="email" id="email" required>
                <button type="submit">Reset Password</button>
            </form>
        </h2>
    </div>

    <h3>--------------OR-------------</h3>
    <h3>
        <a href="register.php">Register</a>
    </h3>

    <h3>
        <a href="login.php">Login</a>
    </h3>


</body>

</html>