<!DOCTYPE html>
<html>
<head>
    <title>Laporan Penjualan Bulanan</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            border: 1px solid black;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    <h1>Atma Kitchen</h1>
    <p>Jl. Centralpark No. 10 Yogyakarta</p>
    <h2>Laporan Penjualan Bulanan</h2>
    <p>Bulan: {{ \Carbon\Carbon::create()->month($bulan)->translatedFormat('F') }}</p>
    <p>Tahun: {{ $tahun }}</p>
    <p>Tanggal cetak: {{ \Carbon\Carbon::now()->format('d F Y') }}</p>

    <table>
        <thead>
            <tr>
                <th>Produk</th>
                <th>Kuantiats</th>
                <th>Harga</th>
                <th>Jumlah Uang</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($penjualan as $item)
                <tr>
                    <td>{{ $item->produk->nama }}</td>
                    <td>{{ $item->total_terjual }}</td>
                    <td>{{ number_format($item->produk->harga, 0, ',', '.') }}</td>
                    <td>{{ number_format($item->total_uang, 0, ',', '.') }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <h3>Total Penjualan: {{ number_format($totalPenjualan, 0, ',', '.') }}</h3>
</body>
</html>
