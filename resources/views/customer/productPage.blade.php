<!-- resources/views/customer/productDetail.blade.php -->

<title>{{ $produk->nama }} - ATMA KITCHEN</title>
@extends('dashboard.navbar')

@section('content')
<style>
    .product-detail {
        display: flex;
        padding: 2rem;
        gap: 2rem;
    }

    .product-image {
        flex: 1;
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .product-image img {
        max-width: 100%;
        height: auto;
        border-radius: 10px;
    }

    .product-info {
        flex: 1;
        padding: 2rem;
        background-color: #fff;
        border-radius: 10px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    .product-info h1 {
        font-size: 2rem;
        color: #5f4b8b;
        font-family: 'Playfair Display', serif;
        margin-bottom: 1rem;
    }

    .product-info p {
        font-size: 1rem;
        color: #6c757d;
        margin-bottom: 0.5rem;
    }

    .product-info .product-price {
        font-size: 1.5rem;
        color: #333;
        font-weight: bold;
        margin-bottom: 1rem;
    }

    .add-to-cart {
        display: flex;
        flex-direction: column;
        align-items: flex-start;
        padding: 2rem;
        border: 1px solid #e0e0e0;
        border-radius: 10px;
        background-color: #fff;
    }

    .quantity-control {
        display: flex;
        align-items: center;
        margin-bottom: 1rem;
    }

    .quantity-control button {
        width: 30px;
        height: 30px;
        background-color: #e0e0e0;
        border: none;
        color: #333;
        font-size: 1.2rem;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 5px;
    }

    .quantity-control input {
        width: 50px;
        height: 30px;
        text-align: center;
        border: 1px solid #e0e0e0;
        border-radius: 5px;
        margin: 0 5px;
    }

    .add-to-cart button {
        width: 100%;
        padding: 0.5rem;
        font-size: 1rem;
        border-radius: 5px;
        margin-top: 0.5rem;
    }

    .add-to-cart .btn-primary {
        background-color: #f8f9fa;
        border: none;
        color: #333;
    }

    .add-to-cart .btn-secondary {
        background-color: #5f4b8b;
        border: none;
        color: #fff;
    }
</style>

<div class="container mt-4 product-detail">
    <div class="product-image">
        <img src="{{ asset($produk->foto) }}" alt="{{ $produk->nama }}">
    </div>
    <div class="product-info">
        <h1>{{ $produk->nama }}</h1>
        <p class="product-price">Rp {{ number_format($produk->harga, 0, ',', '.') }}</p>
        <p>{{ $produk->deskripsi }}</p>
        <p class="card-text">Stok: {{ $produk->stok }}</p>
        <p class="card-text">Kuota Harian: {{ $produk->kuota_harian }}</p>
    </div>
    <div class="add-to-cart">
        <div class="quantity-control">
            <button type="button" id="decreaseQuantity">-</button>
            <input type="text" id="jumlah" value="1">
            <button type="button" id="increaseQuantity">+</button>
        </div>
        <!-- Form untuk menambahkan produk ke keranjang -->
        <form action="{{ route('chart.add_to_chart', ['id' => $produk->id]) }}" method="POST">
            @csrf
            <input type="hidden" name="jumlah" id="hiddenJumlah" value="1"> <!-- Input hidden untuk jumlah -->
            <button type="submit" class="btn btn-primary">Add to Cart</button>
        </form>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
<script>
    document.getElementById('decreaseQuantity').addEventListener('click', function() {
        var quantity = document.getElementById('jumlah');
        var hiddenQuantity = document.getElementById('hiddenJumlah');
        var value = parseInt(quantity.value);
        if (value > 1) {
            quantity.value = value - 1;
            hiddenQuantity.value = quantity.value; // Update hidden input
        }
    });

    document.getElementById('increaseQuantity').addEventListener('click', function() {
        var quantity = document.getElementById('jumlah');
        var hiddenQuantity = document.getElementById('hiddenJumlah');
        var value = parseInt(quantity.value);
        quantity.value = value + 1;
        hiddenQuantity.value = quantity.value; // Update hidden input
    });

    // Ensure hidden input is updated if user manually changes the quantity
    document.getElementById('jumlah').addEventListener('input', function() {
        var quantity = document.getElementById('jumlah');
        var hiddenQuantity = document.getElementById('hiddenJumlah');
        hiddenQuantity.value = quantity.value;
    });
</script>
@endsection
