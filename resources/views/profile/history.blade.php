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
                <tfoot>
                    <tr>
                        <th>No.</th>
                        <th>Nama Pesanan</th>
                        <th>Isi Pesanan</th>
                        <th>Harga Pesanan</th>
                        <th>Pickup</th>
                        <th>Tanggal Pesanan</th>
                    </tr>
                </tfoot>
                <tbody>
                    @forelse($orders as $order)
                    <tr>
                        <td>{{ $order->id_customer}}</td>
                        <td>{{ $order->nama }}</td>
                        <td>{{ $order->isi }}</td>
                        <td>{{ $order->harga }}</td>
                        <td>{{ $order->pickup }}</td>
                        <td>{{ $order->tanggal }}</td>
                    </tr>
                    @empty
                    <tr>
                        <td>
                            <span>
                                Belum ada Data
                            </span>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</body>

</html>