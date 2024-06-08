@extends('dashboard/sidebarKaryawan')
@section('content')
    <div class="container">
        <h1>Laporan Penjualan Bulanan</h1>
        <form method="GET" action="{{ route('laporan.penjualanBulanan') }}">
            <div class="form-group">
                <label for="bulan">Bulan:</label>
                <input type="number" id="bulan" name="bulan" class="form-control" value="{{ $bulan }}" min="1" max="12">
            </div>
            <div class="form-group">
                <label for="tahun">Tahun:</label>
                <input type="number" id="tahun" name="tahun" class="form-control" value="{{ $tahun }}" min="2000" max="{{ \Carbon\Carbon::now()->year }}">
            </div>
            <button type="submit" class="btn btn-primary">Lihat Laporan</button>
        </form>

        <table class="table">
            <thead>
                <tr>
                    <th>Produk</th>
                    <th>Total Terjual</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($penjualan as $item)
                    <tr>
                        <td>{{ $item->produk->nama }}</td>
                        <td>{{ $item->total_terjual }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
