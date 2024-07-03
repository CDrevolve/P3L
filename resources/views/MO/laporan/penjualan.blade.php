
@extends('dashboard/sidebarKaryawan')
@section('content')
    <div class="container">
        <h1>Laporan Penjualan Bulanan</h1>
        <form method="GET" action="{{ route('laporan.penjualanBulanan') }}">
            <div class="form-group">
                <label for="bulan">Bulan:</label>
                <select id="bulan" name="bulan" class="form-control">
                    @for ($i = 1; $i <= 12; $i++)
                        <option value="{{ $i }}" {{ $bulan == $i ? 'selected' : '' }}>
                            {{ \Carbon\Carbon::create()->month($i)->translatedFormat('F') }}
                        </option>
                    @endfor
                </select>
            </div>
            <div class="form-group">
                <label for="tahun">Tahun:</label>
                <input type="number" id="tahun" name="tahun" class="form-control" value="{{ $tahun }}" min="2000" max="{{ \Carbon\Carbon::now()->year }}">
            </div>
            <button type="submit" class="btn btn-primary">Lihat Laporan</button>
        </form>

        <form method="GET" action="{{ route('laporan.penjualanBulanan') }}" target="_blank">
            <input type="hidden" name="bulan" value="{{ $bulan }}">
            <input type="hidden" name="tahun" value="{{ $tahun }}">
            <input type="hidden" name="download" value="pdf">
            <button type="submit" class="btn btn-secondary mt-2">Unduh PDF</button>
        </form>

        <table class="table">
            <thead>
                <tr>
                    <th>Produk</th>
                    <th>Kuantitas</th>
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
    </div>

@endsection
