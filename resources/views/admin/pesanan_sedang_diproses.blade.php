@extends('dashboard.sidebarKaryawan')

@section('content')
<style>
    h1 {
        color: #fff;
        text-align: center;
    }

    .btn-primary{
        background-color:#B0A3C1;
    }
    .btn-primary:hover {
        background-color: #FFD9C0;
        color: white;
    }

    .alert-success{
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

<h1>Pesanan Sedang Diproses</h1>
<div class="container">

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    @if($pesanans->isEmpty())
        <p class="no-data">Tidak ada pesanan yang sedang diproses.</p>
    @else
        <table id="tableFilter" class="table table-bordered">
            <thead>
                <tr>
                    <th>Customer</th>
                    <th>Alamat</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($pesanans as $pesanan)
                    <tr>
                        <td>{{ $pesanan->customer->nama }}</td>
                        <td>{{ $pesanan->alamat->nama }}</td>
                        <td>{{ $pesanan->status }}</td>
                        <td>
                            <form method="POST" action="{{ route('pesanan.updateStatus', $pesanan->id) }}">
                                @csrf
                                <button type="submit" class="btn btn-primary btn-sm">Diproses</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>

<script>
    window.addEventListener('DOMContentLoaded', event => {
        const datatablesSimple = document.getElementById('tableFilter');
        if (datatablesSimple) {
            new simpleDatatables.DataTable(datatablesSimple);
        }
    });
</script>
@endsection
