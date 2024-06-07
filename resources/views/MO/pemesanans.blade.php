@extends('dashboard/sidebarKaryawan')

@section('content')
<div class="container">
    <h1>Pesanan yang Harus Diproses Hari Ini</h1>

    @if ($pemesanans->isEmpty())
        <p>Tidak ada pesanan yang harus diproses hari ini.</p>
    @else
        <table class="table">
            <thead>
                <tr>
                    <th>ID Pemesanan</th>
                    <th>Tanggal</th>
                    <th>Status</th>
                    <th>Produk</th>
                    <th>Proses</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($pemesanans as $pemesanan)
                    @foreach ($pemesanan->detailpemesanans as $detailPemesanan)
                        <tr>
                            <td>{{ $pemesanan->id }}</td>
                            <td>{{ $pemesanan->tanggal }}</td>
                            <td>{{ $pemesanan->status }}</td>
                            <td>{{ $detailPemesanan->produk->nama }}</td>
                            <td>
                                <form action="{{ route('pemesanans.proses', $detailPemesanan->id) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="btn btn-primary">Proses Pesanan</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                @endforeach
            </tbody>
        </table>
    @endif
</div>
@endsection
