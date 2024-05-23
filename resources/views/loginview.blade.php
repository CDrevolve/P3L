<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <style>
        .custom-card {
            background-color: #FFD9C0;
        }
    </style>
</head>

<body>
    <div class="container mt-5">
        @if(Session::has('Error'))
        <div class="alert alert-danger" role="alert">
            {{ Session::get('Error') }}
        </div>
        @endif

        <div class="card custom-card col-md-6 mx-auto">
            <div class="card-body">
                <h5 class="card-title text-center">Login</h5>
                <form method="post" action="{{ route('actionLogin') }}">
                    @csrf
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" id="email" name="email" placeholder="Email" required>
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" class="form-control" id="password" name="password" placeholder="Password" required>
                    </div>

                    <button type="submit" class="btn btn-primary">Login</button>
                </form>
                <hr>
                <p class="text-center">Belum Punya Akun? <a href="{{ route('register') }}">Sign Up</a></p>
                
            </div>
        </div>
    </div>
</body>

</html>