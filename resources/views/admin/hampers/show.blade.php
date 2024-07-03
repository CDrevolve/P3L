@extends('dashboard.sidebarKaryawan')
@section('content')
<div class="container">
    <h1>Detail Hampers</h1>
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Nama Hampers: {{ $hampers->nama }}</h5>
            <p class="card-text">Harga: Rp {{ number_format($hampers->harga, 0, ',', '.') }}</p>
            <h6 class="card-subtitle mb-2 text-muted">Daftar Produk:</h6>
            <ul>
                @foreach ($hampers->detailHampers as $detail)
                <li>{{ $detail->produk->nama }}</li>
                @endforeach
            </ul>
        </div>
    </div>
</div>
@endsection
