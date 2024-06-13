<!-- resources/views/mo/laporan/penggunaan_bahan_baku.blade.php -->

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

    h1 {
        color: #333;
    }

    p {
        font-size: 1.1rem;
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
</style>

<div class="container">
    <h1>Laporan Penggunaan Bahan Baku</h1>

    <form action="{{ route('laporan.penggunaan_bahan_baku') }}" method="GET">
        <label for="start_date">Start Date:</label>
        <input type="date" id="start_date" name="start_date" required value="{{ request('start_date') }}">
        
        <label for="end_date">End Date:</label>
        <input type="date" id="end_date" name="end_date" required value="{{ request('end_date') }}">
        
        <button type="submit">Generate Report</button>
    </form>

    @if(isset($penggunaanBahanBaku))
        <p>Periode: {{ \Carbon\Carbon::parse($startDate)->format('d F Y') }} - {{ \Carbon\Carbon::parse($endDate)->format('d F Y') }}</p>
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
    @endif

    <form action="{{ route('laporan.penggunaan_bahan_baku.download') }}" method="POST">
        @csrf
        <input type="hidden" name="start_date" value="{{ request('start_date') }}">
        <input type="hidden" name="end_date" value="{{ request('end_date') }}">
        
        <button type="submit">Download PDF</button>
    </form>
</div>
@endsection
