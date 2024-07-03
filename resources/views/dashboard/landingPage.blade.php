
@extends('dashboard.navbar')
@section('content')
    <style>
        .hero-section {
            padding: 4rem 0;
            text-align: left;
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
    </style>
</head>

<body>

    <!-- Hero Section -->
    <section class="hero-section">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-6 text-section">
                    <h1>Celebrate Life's Sweet Moments with the Perfect Cake</h1>
                    <p>Choose from our lovingly curated selection or pour your heart into designing a cake that's as special as your occasion. Let's make every slice resonate with joy and connection.</p>
                </div>
                <div class="col-md-6 image-section">
                    <img src="https://cdn.idntimes.com/content-images/community/2022/07/fromandroid-e51521742121f6c85d23df07c7fc3d95_600x400.jpg" alt="Cake Image" class="img-fluid">
                </div>

            </div>
        </div>
    </div>
</section>


    <!-- Shop Now Button -->
    <div class="container mt-4">
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#tanggalModal">
            Shop Now
        </button>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="tanggalModal" tabindex="-1" aria-labelledby="tanggalModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="{{ route('select.tanggal') }}" method="POST">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title" id="tanggalModalLabel">Pilih Tanggal Pesanan</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="tanggal" class="form-label">Tanggal</label>
                            <input type="date" class="form-control" id="tanggal" name="tanggal" required>

                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Pilih</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    @if(isset($tanggal) && isset($produk) && isset($hampers))
<section class="products-section py-5">
    <div class="container">
        <div class="row">
            @foreach ($produk as $product)
            <div class="col-md-4 mb-4">
                <div class="card" onclick="window.location.href='{{ route('pesanan.show', $product->id) }}'">
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

@endif

<!-- Hampers Section -->
@if(isset($tanggal) && isset($produk) && isset($hampers))
<section class="hampers-section py-5">
    <div class="container">
        <div class="row">
            @foreach ($hampers as $hamper)
            <div class="col-md-4 mb-4">
                <div class="card" onclick="window.location.href='{{ route('pesanan.showHampers', $hamper->id) }}'">
                    <img src="{{ asset($hamper->foto) }}" class="card-img-top" alt="{{ $hamper->nama }}">
                    <div class="card-body">
                        <h5 class="card-title">{{ $hamper->nama }}</h5>
                        <p class="card-text product-price">Rp {{ number_format($hamper->harga, 0, ',', '.') }}</p>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
@endif

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz
@endsection

