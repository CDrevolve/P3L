<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ATMA KITCHEN</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="styles.css">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;700&family=Open+Sans:wght@400;600&display=swap" rel="stylesheet">
</head>

<style>
    body {
        font-family: 'Open Sans', sans-serif;
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    .navbar {
        background-color: #f8f9fa;
        padding: 1rem;
    }

    .navbar-brand {
        display: flex;
        align-items: center;
        font-size: 2rem;
        font-weight: bold;
        font-family: 'Playfair Display', serif;
    }

    .navbar-logo {
        height: 70px;
        margin-right: 10px;
    }

    .hero-section {
        display: flex;
        align-items: center;
        background: linear-gradient(to right, #f8d7da 50%, #d1c4e9 50%);
        padding: 4rem 0;
    }

    .text-section {
        padding: 2rem;
    }

    .text-section h1 {
        font-size: 2.5rem;
        color: #5f4b8b;
        font-family: 'Playfair Display', serif;
    }

    .text-section p {
        font-size: 1rem;
        color: #6c757d;
        margin-bottom: 1.5rem;
    }

    .btn-primary {
        background-color: #6f42c1;
        border-color: #6f42c1;
        color: #fff;
        margin-right: 0.5rem;
    }

    .btn-secondary {
        background-color: #f8d7da;
        border-color: #f8d7da;
        color: #5f4b8b;
    }

    .image-section {
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .image-section img {
        border-radius: 10px;
        max-width: 100%;
        height: auto;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
    }

    .products-section {
        padding: 4rem 0;
    }

    .card {
        height: 100%;
    }

    .card img {
        max-height: 200px;
        object-fit: cover;
    }

    .card-title {
        font-family: 'Playfair Display', serif;
        font-size: 1.25rem;
    }

    .card-text {
        font-size: 0.9rem;
        color: #6c757d;
    }

    .btn-primary {
        background-color: #6f42c1;
        border-color: #6f42c1;
    }
</style>

<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">
                <img src="images/logo.PNG" alt="ATMA KITCHEN" class="navbar-logo">
                ATMA KITCHEN
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="#">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('login')}}">Login</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="hero-section">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-6 text-section">
                    <h1>Celebrate Life's Sweet Moments with the Perfect Cake</h1>
                    <p>Choose from our lovingly curated selection or pour your heart into designing a cake that's as special as your occasion. Let's make every slice resonate with joy and connection.</p>
                    <button class="btn btn-primary">Shop Now</button>
                    <button class="btn btn-secondary">Customize Now</button>
                </div>
                <div class="col-md-6 image-section">
                    <img src="https://cdn.idntimes.com/content-images/community/2022/07/fromandroid-e51521742121f6c85d23df07c7fc3d95_600x400.jpg" alt="Cake Image" class="img-fluid">
                </div>
            </div>
        </div>
    </section>

    <!-- Products Section -->
    <section class="products-section">
        <div class="container">
            <div class="row">
                @foreach ($produk as $product)
                <div class="col-md-4 mb-4">
                    <div class="card">
                        <img src="{{ asset($product->foto) }}" class="card-img-top" alt="{{ $product->nama }}">
                        <div class="card-body">
                            <h5 class="card-title">{{ $product->nama }}</h5>
                            <p class="card-text">Stok Ready: {{ $product->stok }}</p>
                            <p class="card-text">Stok Hari ini: {{ $product->kuota_harian}}</p>
                            <p class="card-text">Harga: {{ $product->harga }}</p>
                            <a href="#" class="btn btn-primary">Add to Cart</a>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>
