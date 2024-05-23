@extends('dashboard/navbar')
@section('content')
<style>
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


@endsection