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

    .btn-edit {
        background-color: #4caf50;
    }

    .btn-delete {
        background-color: #f44336;
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

<div class="container">
    <h1>Daftar Resep</h1>

    <!-- Form pencarian -->
    <div class="search-container">
        <input type="text" id="searchInput" placeholder="Cari resep...">
        <button onclick="search()" class="btn btn-primary">Cari</button>
    </div>

    <!-- Daftar resep -->
    <div id="recipeList" class="row">
        @foreach ($reseps as $resep)
        <div class="card">
            <h2><a href="{{ route('resep.show', $resep->id) }}">{{ $resep->nama }}</a></h2>
            <div>
                <a href="{{ route('resep.edit', $resep->id) }}" class="btn btn-edit">Edit</a>
                <a href="{{route('detail.resep', $resep->id) }}" class="btn btn-success">Detail</a>
                <form action="{{ route('resep.destroy', $resep->id) }}" method="POST" style="display: inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-delete">Hapus</button>
                </form>
            </div>
        </div>
        @endforeach
    </div>

    <!-- Tombol untuk menambah resep -->
    <a href="{{ route('resep.create') }}" class="btn btn-success">Tambah Resep</a>
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
