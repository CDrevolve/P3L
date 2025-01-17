<head>
    <title>Daftar Produk</title>
</head>

@extends('dashboard.sidebarKaryawan')
@section('content')
<style>
    body {
        font-family: Arial, sans-serif;
        margin: 0;
        padding: 0;
        background-color: #FEFAF6;
    }

    .container {
        max-width: 1200px;
        margin: 20px auto;
        padding: 20px;
    }

    .row {
        display: flex;
        flex-wrap: wrap;
        justify-content: space-between;
        margin-bottom: 20px;
    }

    .card {
        background-color: #FFD9C0;
        border-radius: 5px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        padding: 20px;
        margin-bottom: 20px;
        flex-basis: calc(20% - 20px);
        /* Atur 20% untuk 5 kartu per baris atau 25% untuk 4 kartu per baris */
    }

    h1 {
        color: #333;
        text-align: center;
        margin-bottom: 20px;
    }

    h2 {
        margin-top: 0;
    }

    a {
        color: #007bff;
        text-decoration: none;
    }

    .search-container {
        margin-bottom: 20px;
        display: flex;
        align-items: center;
    }

    .search-container input[type=text] {
        padding: 10px;
        border-radius: 5px;
        border: 1px solid #ccc;
        width: 300px;
        margin-right: 10px;
    }

    .search-container button {
        padding: 10px 20px;
        border-radius: 5px;
        border: none;
        background-color: #007bff;
        color: #fff;
        cursor: pointer;
        transition: background-color 0.3s ease;
    }

    .search-container button:hover {
        background-color: #0056b3;
    }

    .action-buttons {
        display: flex;
        justify-content: space-between;
        margin-bottom: 20px;
    }

    .action-buttons a {
        padding: 10px 20px;
        border-radius: 5px;
        text-decoration: none;
        color: #fff;
        cursor: pointer;
        transition: background-color 0.3s ease;
    }

    .action-buttons a:hover {
        background-color: #28a745;
    }
</style>

<div class="container">
    <!-- Form pencarian -->
    <div class="search-container">
        <input type="text" id="searchInput" placeholder="Cari produk...">
        <button onclick="search()">Search</button>
    </div>

    <!-- Tombol untuk menambah produk dan hampers -->
    <div class="action-buttons">
        <a href="{{ route('produk.create') }}">Tambah Produk</a>
        <a href="{{ route('hampers.create') }}">Tambah Hampers</a>
    </div>

    <!-- Daftar produk -->
    <h1>Daftar Produk</h1>
    <div id="productList" class="row">
        @foreach ($produk as $produk)
        <div class="card">
            <h2><a href="{{ route('produk.show', $produk->id) }}">{{ $produk->nama }}</a></h2>
            <!-- Tambahkan informasi produk lainnya di sini -->
        </div>
        @endforeach
    </div>

    <!-- Daftar hampers -->
    <h1>Daftar Hampers</h1>
    <div id="hampersList" class="row">
        @foreach ($hampers as $hampers)
        <div class="card">
            <h2><a href="{{ route('hampers.show', $hampers->id) }}">{{ $hampers->nama }}</a></h2>
            <!-- Tambahkan informasi hampers lainnya di sini -->
        </div>
        @endforeach
    </div>
</div>

<script>
    function search() {
        var input, filter, cards, card, title, i, txtValue;
        input = document.getElementById('searchInput');
        filter = input.value.toUpperCase();
        cards = document.getElementsByClassName('card');

        for (i = 0; i < cards.length; i++) {
            card = cards[i];
            title = card.getElementsByTagName("h2")[0];
            txtValue = title.textContent || title.innerText;
            if (txtValue.toUpperCase().indexOf(filter) > -1) {
                card.style.display = "";
            } else {
                card.style.display = "none";
            }
        }
    }
</script>
@endsection
