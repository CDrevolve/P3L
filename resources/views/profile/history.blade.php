<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order History</title>
    <!-- Tambahkan stylesheet atau style inline sesuai kebutuhan -->
    <style>
        /* Gaya CSS */
    </style>
</head>
<body>
    <h1>Order History</h1>
    <div class="container">
        <div class="title">
            <h3>Order History for {{ $user->username }}</h3>
        </div>
        <div class="order-list">
            @if ($orders->isEmpty())
                <p>No orders found.</p>
            @else
                <table>
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Nama Pesanan</th>
                            <th>Isi Pesanan</th>
                            <th>Harga Pesanan</th>
                            <th>Pickup</th>
                            <th>Tanggal Pesanan</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($orders as $index => $order)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $order->nama_pesanan }}</td>
                                <td>{{ $order->isi_pesanan }}</td>
                                <td>{{ $order->harga_pesanan }}</td>
                                <td>{{ $order->pickup }}</td>
                                <td>{{ $order->tanggal_pesanan }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @endif
        </div>
    </div>
</body>
</html>
