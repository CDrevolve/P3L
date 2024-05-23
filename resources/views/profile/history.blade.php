<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order History</title>
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

        h1 {
            color: #333;
            text-align: center;
        }

        .title {
            margin-bottom: 20px;
        }

        h3 {
            margin: 0;
            color: #555;
        }

        .search-form {
            margin-top: 10px;
            text-align: center;
        }

        .search-input {
            padding: 8px;
            border-radius: 4px;
            border: 1px solid #ccc;
            margin-right: 5px;
        }

        .search-btn {
            padding: 8px 15px;
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        .search-btn:hover {
            background-color: #0056b3;
        }

        .order-list {
            margin-top: 20px;
            border-collapse: collapse;
            width: 100%;
        }

        .order-list th,
        .order-list td {
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
            <form action="{{ route('profile.history') }}" method="GET" class="search-form">
                <input type="text" name="keyword" class="search-input" placeholder="Search by product name">
                <button type="submit" class="search-btn">Search</button>
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
                        <td>{{ $order->nama }}</td>
                        <td>{{ $order->isi }}</td>
                        <td>{{ $order->harga }}</td>
                        <td>{{ $order->pickup }}</td>
                        <td>{{ $order->tanggal }}</td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="empty-data">Belum ada Data</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
            <a href="{{ route('profile.show') }}" class="btn">back</a>
        </div>
    </div>
</body>

</html>
