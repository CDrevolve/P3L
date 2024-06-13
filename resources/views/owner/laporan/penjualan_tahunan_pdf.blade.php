<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        table {
            width: 100%;
            border-collapse: collapse;
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
    <h2>Atma Kitchen</h2>
        <p>Jl. Centralpark No. 10 Yogyakarta</p>
    <h1>LAPORAN PENJUALAN BULANAN</h1>
    <p>Tahun: {{ $tahun }}</p>
    <p>Tanggal cetak: {{ \Carbon\Carbon::now()->format('d F Y') }}</p>

    <table>
        <thead>
            <tr>
                <th>Bulan</th>
                <th>Jumlah Transaksi</th>
                <th>Jumlah Uang</th>
            </tr>
        </thead>
        <tbody>
            @php
                $months = [
                    1 => 'Januari', 2 => 'Februari', 3 => 'Maret', 4 => 'April', 5 => 'Mei', 
                    6 => 'Juni', 7 => 'Juli', 8 => 'Agustus', 9 => 'September', 10 => 'Oktober', 
                    11 => 'November', 12 => 'Desember'
                ];
                $penjualanMap = $penjualanBulanan->keyBy('bulan');
            @endphp

            @foreach ($months as $monthNumber => $monthName)
                <tr>
                    <td>{{ $monthName }}</td>
                    @if(isset($penjualanMap[$monthNumber]))
                        <td>{{ $penjualanMap[$monthNumber]->jumlah_transaksi }}</td>
                        <td>{{ number_format($penjualanMap[$monthNumber]->total_uang, 0, ',', '.') }}</td>
                    @else
                        <td>....</td>
                        <td>....</td>
                    @endif
                </tr>
            @endforeach
            <tr>
                <td><strong>Total</strong></td>
                <td></td>
                <td><strong>{{ number_format($totalKeseluruhan, 0, ',', '.') }}</strong></td>
            </tr>
        </tbody>
    </table>
</body>
</html>
