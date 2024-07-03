@extends('dashboard.sidebarKaryawan')
@section('content')
<div class="container">
    <h1>Edit Hampers</h1>
    <form action="{{ route('hampers.update', $hampers->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="nama">Nama Hampers</label>
            <input type="text" class="form-control" id="nama" name="nama" value="{{ $hampers->nama }}" required>
        </div>
        <div class="form-group">
            <label for="harga">Harga</label>
            <input type="number" class="form-control" id="harga" name="harga" value="{{ $hampers->harga }}" required>
        </div>
        <div class="form-group">
            <label for="produk_id">Produk</label>
            <select class="form-control" id="produk_id" name="produk_id[]" multiple required>
                @foreach($produks as $produk)
                <option value="{{ $produk->id }}" {{ in_array($produk->id, $selectedProduks) ? 'selected' : '' }}>{{ $produk->nama }}</option>
                @endforeach
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Update</button>
    </form>
</div>
@endsection
