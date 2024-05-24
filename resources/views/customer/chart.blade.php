@extends('dashboard.navbar')

@section('content')
<div class="container">
    <h2>Chart</h2>
    <table class="table">
        <thead>
            <tr>
                <th>Nama Produk</th>
                <th>Deskripsi</th>
                <th>Harga</th>
                <th>Jumlah</th>
            </tr>
        </thead>
        <tbody>
            @php
                $total = 0; // Inisialisasi total harga
            @endphp
            @foreach($chart as $item)
            <tr>
                <td>{{ $item->produk->nama }}</td>
                <td>{{ $item->produk->deskripsi }}</td>
                <td>Rp {{ $item->produk->harga }}</td>
                <td>{{ $item->jumlah }}</td>
            </tr>
            @php
                $subtotal = $item->produk->harga * $item->jumlah; // Hitung subtotal untuk setiap item
                $total += $subtotal; // Tambahkan subtotal ke total harga
            @endphp
            @endforeach
        </tbody>
    </table>
    <!-- Tampilkan total harga -->
    <div class="text-end">
        <h4>Total Harga: Rp {{ number_format($total, 0, ',', '.') }}</h4>
    </div>

    <!-- Form untuk checkout -->
    <form action="{{ route('checkout') }}" method="POST">
        @csrf
        <!-- Hidden input untuk menyimpan total harga -->
        <input type="hidden" name="total_harga" value="{{ $total }}">
        <!-- Tombol Checkout -->
        <button type="submit" class="btn btn-primary">Checkout</button>
    </form>
</div>
@endsection
