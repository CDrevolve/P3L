<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Produk</title>
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
        }

        h2 {
            margin-top: 0;
        }

        a {
            color: #007bff;
            text-decoration: none;
        }

        .btn {
            display: inline-block;
            padding: 8px 16px;
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            text-align: center;
            text-decoration: none;
            transition: background-color 0.3s;
        }

        .btn:hover {
            background-color: #0056b3;
        }

        .search-container {
            margin-bottom: 20px;
        }

        .search-container input[type=text] {
            padding: 10px;
            border-radius: 5px;
            border: 1px solid #ccc;
            width: 300px;
        }

        .search-container button {
            padding: 10px 20px;
            border-radius: 5px;
            border: none;
            background-color: #007bff;
            color: #fff;
            cursor: pointer;
        }
    </style>
</head>

<body>
    <div class="container">
        <a href="{{ route('admin') }}" class="button">Back</a>

        <!-- Form pencarian -->
        <div class="search-container">
            <input type="text" id="searchInput" placeholder="Cari produk...">
            <button onclick="search()">Search</button>
        </div>
        <a href="{{route('actionLogout')}}">logout</a>

        <!-- Daftar produk -->
        <div id="productList" class="row">
            @foreach ($produk as $produk)
            <div class="card">
                <h2><a href="{{ route('produk.show', $produk->id) }}">{{ $produk->nama }}</a></h2>
                <!-- Tambahkan informasi produk lainnya di sini -->
            </div>
            @endforeach
        </div>

        <!-- Tombol untuk menambah produk -->
        <a href="{{ route('produk.create') }}" class="btn">Tambah Produk</a>
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
</body>

</html>