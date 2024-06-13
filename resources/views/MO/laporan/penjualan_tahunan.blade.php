@extends('dashboard.sidebarKaryawan')

@section('content')
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
        background-color: white;
        border-radius: 5px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    h1, p {
        color: #333;
    }

    table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 20px;
    }

    table, th, td {
        border: 1px solid #ddd;
    }

    th, td {
        padding: 8px;
        text-align: left;
    }

    th {
        background-color: #f2f2f2;
    }

    .btn-download {
        background-color: #4CAF50;
        color: white;
        padding: 10px 20px;
        text-align: center;
        text-decoration: none;
        display: inline-block;
        margin-top: 20px;
        border-radius: 5px;
        border: none;
        cursor: pointer;
    }


    .chart-container {
        width: 80%; 
        margin: 20px auto;
    }
</style>

<div class="container">
    <h1>LAPORAN PENJUALAN BULANAN</h1>
    <p>Tahun: {{ $tahun }}</p>
    <p>Tanggal cetak: {{ \Carbon\Carbon::now()->format('d F Y') }}</p>

    <form id="pdfForm" action="{{ route('laporan-penjualan-tahunan.download-pdf') }}" method="POST">
        @csrf
        <input type="hidden" name="tahun" value="{{ $tahun }}">
        <input type="hidden" id="chartImage" name="chartImage">
        
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

        <div class="chart-container">
            <canvas id="salesChart" width="100" height="60"></canvas>
        </div>
        
        <button type="submit" class="btn-download" id="downloadPdfButton">Download PDF</button>
    </form>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        var ctx = document.getElementById('salesChart').getContext('2d');

        var dataPenjualan = Array(12).fill(0);
        
     
        @foreach ($penjualanBulanan as $penjualan)
            dataPenjualan[{{ $penjualan->bulan - 1 }}] = {{ $penjualan->total_uang }};
        @endforeach
        
        var salesChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: @json(array_values($months)),
                datasets: [{
                    label: 'Total Uang (Rp)',
                    data: dataPenjualan,
                    backgroundColor: 'rgba(54, 162, 235, 0.2)',
                    borderColor: 'rgba(54, 162, 235, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                },
                layout: {
                    padding: {
                        left:35,
                        right: 35,
                        top: 35,
                        bottom: 35
                    }
                }
            }
        });

        document.getElementById('downloadPdfButton').addEventListener('click', function(event) {
            event.preventDefault();
            var chartImage = salesChart.toBase64Image();
            document.getElementById('chartImage').value = chartImage;
            document.getElementById('pdfForm').submit();
        });
    });
</script>
@endsection
