@extends('dashboard/sidebarKaryawan')

@section('content')

<div class="container">
    <h1>Pesanan yang Harus Diproses Hari Ini</h1>

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if (session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    @if ($pemesanans->isEmpty())
        <p>Tidak ada pesanan yang harus diproses hari ini.</p>
    @else
        <form action="{{ route('pemesanans.prosesSemua') }}" method="POST">
            @csrf
            <button type="submit" class="btn btn-primary mb-2">Proses Semua Pesanan</button>
        </form>
        
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
                                @if ($pemesanan->status !== 'diproses')
                                    <form action="{{ route('pemesanans.proses', $detailPemesanan->id) }}" method="POST">
                                        @csrf
                                        <button type="submit" class="btn btn-primary">Proses Pesanan</button>
                                    </form>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                @endforeach
            </tbody>
        </table>
    @endif
</div>

@endsection
