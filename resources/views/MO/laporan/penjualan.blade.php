<!-- resources/views/mo/laporan/penjualan.blade.php -->

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
        max-width: 800px;
        margin: 20px auto;
        padding: 20px;
        background-color: #FFD9C0;
        border-radius: 5px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    h1, h2, h3 {
        color: #333;
    }

    table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 20px;
    }

    table, th, td {
        border: 1px solid #ddd;
    }

    th, td {
        padding: 8px;
        text-align: left;
    }

    th {
        background-color: #f2f2f2;
    }

    .alert-success {
        background-color: #B0A3C1;
        color: white;
        padding: 10px;
        border-radius: 5px;
        margin-bottom: 20px;
    }
</style>

<div class="container">
    <h1>Laporan Penjualan Bulanan</h1>
    <p>Bulan: {{ $bulan }}</p>
    <p>Tahun: {{ $tahun }}</p>

    <h2>Total Penjualan Keseluruhan: {{ $totalPenjualan }}</h2>

    <h3>Penjualan Per Produk:</h3>
    <table>
        <thead>
            <tr>
                <th>ID Produk</th>
                <th>Total Terjual</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($penjualanPerProduk as $penjualan)
            <tr>
                <td>{{ $penjualan->id_produk }}</td>
                <td>{{ $penjualan->total_terjual }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
