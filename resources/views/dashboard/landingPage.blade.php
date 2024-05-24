<title>ATMA KITCHEN - Produk</title>
@extends('dashboard.navbar')
@section('content')
<style>

    .hero-section {
        padding: 4rem 0;
        text-align: left;
    }

    .hero-section h1 {
        font-family: 'Playfair Display', serif;
        font-size: 2.5rem;
        color: #5f4b8b;
        margin-bottom: 1rem;
    }

    .hero-section p {
        font-size: 1.25rem;
        color: #333;
        margin-bottom: 2rem;
    }

    .hero-section .btn {
        margin-right: 1rem;
    }

    .card {
        height: 100%;
        background-color: #fff;
        border: none;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        border-radius: 15px;
        overflow: hidden;
        text-align: center;
        transition: transform 0.2s;
    }

    .card:hover {
        transform: translateY(-5px);
    }

    .card img {
        max-height: 200px;
        object-fit: cover;
    }

    .card-title {
        font-family: 'Playfair Display', serif;
        font-size: 1.25rem;
        color: #333;
    }

    .card-text {
        font-size: 0.9rem;
        color: #6c757d;
    }

    .product-price {
        font-weight: bold;
        color: #333;
    }
</style>

    

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
    <section class="products-section py-5">
        <div class="container">
            <div class="row">
                @foreach ($produk as $product)
                <div class="col-md-4 mb-4">
                    <div class="card" onclick="window.location.href='{{route('pesanan.show',$product->id)}}'">
                        <img src="{{ asset($product->foto) }}" class="card-img-top" alt="{{ $product->nama }}">
                        <div class="card-body">
                            <h5 class="card-title">{{ $product->nama }}</h5>
                            <p class="card-text product-price">Rp {{ number_format($product->harga, 0, ',', '.') }}</p>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
@endsection

