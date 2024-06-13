<!DOCTYPE html>
<html>
<head>
    <title>Laporan Penggunaan Bahan Baku</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        .container {
            width: 80%;
            margin: auto;
            padding: 20px;
        }
        h1, h3{
            text-align: center;
            margin: 0;
        }
        h2 {
            margin-bottom: 5px;
        }
        h3 {
            margin-top: 0;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        table, th, td {
            border: 1px solid black;
        }
        th, td {
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Atma Kitchen</h2>
        <p>Jl. Centralpark No. 10 Yogyakarta</p>
        <h1>Laporan Penggunaan Bahan Baku</h1>
        <p>Periode: {{ \Carbon\Carbon::parse($startDate)->format('d F Y') }} - {{ \Carbon\Carbon::parse($endDate)->format('d F Y') }}</p>
        <p>Tanggal Cetak: {{ \Carbon\Carbon::now()->format('d F Y') }}</p>
        <table>
            <thead>
                <tr>
                    <th>Nama Bahan</th>
                    <th>Satuan</th>
                    <th>Digunakan</th>
                </tr>
            </thead>
            <tbody>
                @foreach($penggunaanBahanBaku as $item)
                    <tr>
                        <td>{{ $item->bahan_baku->nama }}</td>
                        <td>{{ $item->bahan_baku->satuan }}</td>
                        <td>{{ $item->jumlah }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</body>
</html>
