@extends('dashboard.sidebarKaryawan')
@section('content')
<div class="container">
    <h1>Tambah Hampers</h1>
    <form action="{{ route('hampers.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="nama">Nama Hampers</label>
            <input type="text" class="form-control" id="nama" name="nama" required>
        </div>
        <div class="form-group">
            <label for="harga">Harga</label>
            <input type="number" class="form-control" id="harga" name="harga" required>
        </div>
        <div class="form-group">
            <label for="produk_id">Produk</label>
            <select class="form-control" id="produk_id" name="produk_id[]" multiple required>
    @foreach($produks as $produk)
    <option value="{{ $produk->id }}">{{ $produk->nama }}</option>
    @endforeach
</select>
        </div>
        <button type="submit" class="btn btn-primary">Simpan</button>
    </form>
</div>
@endsection
