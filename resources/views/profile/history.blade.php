<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order History</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }

        th,
        td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }
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
                                <button type="submit" class="btn btn-secondary">Cetak Nota</button>
                            </form>                    
                            @endif
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="10">
                            <span>Belum ada Data</span>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</body>

</html>