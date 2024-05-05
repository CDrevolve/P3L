<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order History</title>
    <style>
        /* Gaya CSS */
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 800px;
            margin: 20px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        h1 {
            text-align: center;
            color: #333;
        }
        .title {
            margin-bottom: 20px;
        }
        h3 {
            margin: 0;
            color: #555;
        }
        form {
            margin-top: 10px;
            display: flex;
            justify-content: center;
        }
        input[type="text"] {
            padding: 8px;
            border-radius: 4px;
            border: 1px solid #ccc;
            margin-right: 5px;
        }
        button[type="submit"] {
            padding: 8px 15px;
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        button[type="submit"]:hover {
            background-color: #0056b3;
        }
        .order-list table {
            width: 100%;
            border-collapse: collapse;
        }
        .order-list th, .order-list td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }
        .order-list th {
            background-color: #f2f2f2;
        }
        .order-list tr:nth-child(even) {
            background-color: #f9f9f9;
        }
        .order-list tr:hover {
            background-color: #f2f2f2;
        }
        .empty-data {
            text-align: center;
            color: #999;
            font-style: italic;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Order History</h1>
        <div class="title">
            <h3>Order History for {{ $user->username }}</h3>
            <form action="{{ route('profile.history') }}" method="GET">
                <input type="text" name="keyword" placeholder="Search by product name">
                <button type="submit">Search</button>
            </form>
        </div>
        <div class="order-list">
            <table>
                <thead>
                    <tr>
                        <th>Nama Pesanan</th>
                        <th>Isi Pesanan</th>
                        <th>Harga Pesanan</th>
                        <th>Pickup</th>
                        <th>Tanggal Pesanan</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($orders as $order)
                        <tr>
                            <td>{{ $order->nama_pesanan }}</td>
                            <td>{{ $order->isi_pesanan }}</td>
                            <td>{{ $order->harga_pesanan }}</td>
                            <td>{{ $order->pickup }}</td>
                            <td>{{ $order->tanggal_pesanan }}</td>
                        </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="empty-data">Belum ada Data</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>
