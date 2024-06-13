<!-- resources/views/admin/pesanan_telat_bayar.blade.php -->

@extends('dashboard.sidebarKaryawan')

@section('content')
<style>
    h1 {
        color: #fff;
        text-align: center;
    }

    .btn-primary {
        background-color: #B0A3C1;
    }

    .btn-primary:hover {
        background-color: #FFD9C0;
        color: white;
    }

    .alert-success {
        background-color: #B0A3C1;
        color: white;
    }

    .container {
        margin: 20px auto;
        padding: 20px;
        background-color: #FEFAF6;
        border-radius: 5px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 20px;
    }

    th, td {
        border: 1px solid #ddd;
        padding: 8px;
        text-align: left;
    }

    th {
        background-color: #f2f2f2;
        color: #333;
    }

    .no-data {
        text-align: center;
        padding: 20px;
    }
</style>

<h1>Daftar Pesanan Telat Bayar</h1>
<div class="container">

    
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if($pesanans->isEmpty())
        <p>Tidak ada pesanan yang telat bayar.</p>
    @else
        <table class="table">
            <thead>
                <tr>
                    <th>ID Pesanan</th>
                    <th>Nama</th>
                    <th>Harga</th>
                    <th>Status</th>
                    <th>Tanggal Pemesanan</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($pesanans as $pesanan)
                    <tr>
                        <td>{{ $pesanan->id }}</td>
                        <td>{{ $pesanan->nama }}</td>
                        <td>{{ $pesanan->harga }}</td>
                        <td>{{ $pesanan->status }}</td>
                        <td>{{ $pesanan->created_at }}</td>
                        <td>
                            <form action="{{ route('pesanan.batalkan', $pesanan->id) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <button type="submit" class="btn btn-danger">Batalkan Pesanan</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>
@endsection
