<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Produk: {{ $produk->nama_produk }}</title>
</head>
<body>
<h1>Detail Produk: {{ $produk->nama_produk }}</h1>
@if($produk)
    <ul>
        <li>Stok        : {{ $produk->stok_produk }} </li>
        <li>Harga       : {{ $produk->harga_produk }}</li>
        <li>Stok Harian : {{ $produk->kuota_harian }}</li>
    </ul>
    <a href="{{ route('produk.edit', $produk->id_produk) }}" class="btn">Edit</a>
    <form action="{{ route('produk.destroy', $produk->id_produk) }}" method="POST">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn">Delete</button>
    </form>
@else
    <p>Produk tidak ditemukan.</p>
@endif
<a href="{{ route('produk.index') }}">Kembali</a>
</body>
</html>
