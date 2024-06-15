@extends('dashboard.navbar')

@section('content')
<!DOCTYPE html>
<html lang="en">

<head>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #FFD9C0;
        }

        .container {
            max-width: 1200px;
            margin: 50px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .title {
            text-align: center;
            margin-bottom: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        th,
        td {
            border: 1px solid #ddd;
            padding: 12px;
            text-align: left;
        }

        th {
            background-color: #007bff;
            color: #fff;
        }

        tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        tr:hover {
            background-color: #e9ecef;
        }

        .btncontent {
            display: inline-block;
            padding: 10px 20px;
            font-size: 14px;
            color: #fff;
            background-color: #6c757d;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            text-align: center;
            text-decoration: none;
        }

        .btn-secondary {
            background-color: #007bff;
        }

        .btn-secondary:hover {
            background-color: #0056b3;
        }

        .empty-message {
            text-align: center;
            color: #dc3545;
            font-weight: bold;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="title">
            <h5>Order History for {{ $user->username }}</h5>
        </div>
        <div class="order-list">
            <table>
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>Nama Pesanan</th>
                        <th>Isi Pesanan</th>
                        <th>Harga Pesanan</th>
                        <th>Pickup</th>
                        <th>Status</th>
                        <th>Tanggal Pesanan</th>
                        <th>Ongkir</th>
                        <th>Jumlah Pembayaran</th>
                        <th>Cetak Nota</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($orders as $order)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $order->nama }}</td>
                        <td>{{ $order->isi }}</td>
                        <td>Rp {{ number_format($order->harga, 0, ',', '.') }}</td>
                        <td>{{ $order->pickup }}</td>
                        <td>{{ $order->status }}</td>
                        <td>{{ $order->tanggal }}</td>
                        <td>Rp {{ number_format($order->ongkir, 0, ',', '.') }}</td>
                        <td>Rp {{ number_format($order->jumlah_pembayaran, 0, ',', '.') }}</td>
                        <td>
                            @if($order->status != 'Checkout' && $order->status != 'BelumBayar')
                            <form action="{{ route('checkout.printReceipt', ['id' => $order->id]) }}" method="GET">
                                @csrf
                                <button type="submit" class="btncontent btn-secondary">Cetak Nota</button>
                            </form>
                            @endif
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="10" class="empty-message">Belum ada Data</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</body>

</html>
@endsection
