<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Atma Kitchen</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #F8F8F8;
        }

        .custom-card {
            background-color: #FFD9C0;
            border-radius: 15px;
            padding: 2rem;
        }

        .card-title {
            font-size: 2rem;
            font-weight: bold;
        }

        .login-container {
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
            background-color: #FFF5EB;
        }

        .left-section {
            text-align: center;
            padding: 2rem;
        }

        .left-section h1 {
            font-size: 2rem;
            font-weight: bold;
        }

        .left-section p {
            font-size: 1.2rem;
        }

        .right-section {
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
            background-color: #FFD9C0;
            border-radius: 15px;
            padding: 2rem;
            box-shadow: 0px 4px 12px rgba(0, 0, 0, 0.1);
        }

        .background-image {
            position: absolute;
            bottom: 0;
            left: 0;
            width: 100%;
            z-index: -1;
        }

        .background-image img {
            width: 100%;
            height: auto;
        }

        .btn-custom {
            background-color: #FFFFFF;
            border: none;
            color: #000;
            font-weight: bold;
            width: 100%;
        }

        .btn-custom:hover {
            background-color: #E0E0E0;
        }

        .form-control {
            background-color: #FFF5EB;
            border: none;
            border-radius: 10px;
            padding: 0.75rem 1rem;
        }

        .form-control:focus {
            background-color: #FFF5EB;
            box-shadow: none;
        }

        .form-label {
            margin-bottom: 0.5rem;
            font-weight: bold;
        }

        .or-divider {
            display: flex;
            align-items: center;
            text-align: center;
            margin: 1rem 0;
        }

        .or-divider::before,
        .or-divider::after {
            content: '';
            flex: 1;
            border-bottom: 1px solid #000;
        }

        .or-divider::before {
            margin-right: .5em;
        }

        .or-divider::after {
            margin-left: .5em;
        }
    </style>
</head>

<body>
    <div class="login-container">
        <div class="left-section col-md-5">
            <h1>Atma Kitchen</h1>
            <p>Every Bite, Every Sip, a Celebration of Taste!</p>
        </div>
        <div class="right-section col-md-5">
            <h2 class="text-center mb-4">Welcome!</h2>
            <p class="text-center">Enter your email / mobile number and password to login</p>
            @if(Session::has('Error'))
            <div class="alert alert-danger" role="alert">
                {{ Session::get('Error') }}
            </div>
            @endif
            <form method="post" action="{{ route('actionLogin') }}">
                @csrf
                <div class="mb-3">
                    <label for="email" class="form-label">Email address</label>
                    <input type="email" class="form-control" id="email" name="email" placeholder="Email" required>
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" class="form-control" id="password" name="password" placeholder="Password" required>
                </div>
                <button type="submit" class="btn btn-custom mb-3">Log In</button>
                <div class="or-divider">OR</div>
                <a href="{{ route('register') }}" class="btn btn-custom mb-3">Sign up</a>
            </form>
            <p class="text-center"><a href="{{ route('forgetPassword') }}">Forgot password</a></p>
            </form>
        </div>
    </div>
    <div class="background-image">
        <img src="path_to_your_background_image.png" alt="Background Image">
    </div>
</body>

</html>