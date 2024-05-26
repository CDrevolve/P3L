@extends('dashboard.sidebarKaryawan')

@section('content')
<style>

    h1 {
        color: #fff;
        text-align: center;
    }

    .btn-primary{
        background-color:#B0A3C1;
    }
    .btn-primary:hover {
    background-color: #FFD9C0;
    color: white;
    }

    .alert-success{
        background-color: #B0A3C1;
        color: white;
    }

</style>
<div class="container my-5">
    <h1>Daftar Pesanan Perlu Konfirmasi</h1>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <table id="tableFilter" class="table table-bordered">
        <thead>
            <tr>
                <th>Customer</th>
                <th>Nama</th>
                <th>Isi</th>
                <th>Harga</th>
                <th>Tanggal</th>
                <th>Status</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($pesanans as $pesanan)
            <tr>
                <td>{{ $pesanan->customer->nama }}</td>
                <td>{{ $pesanan->nama }}</td>
                <td>{{ $pesanan->isi }}</td>
                <td>{{ $pesanan->harga }}</td>
                <td>{{ $pesanan->tanggal }}</td>
                <td>{{ $pesanan->status }}</td>
                <td>
                    <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#konfirmasiModal{{ $pesanan->id }}">Konfirmasi</button>
                </td>
            </tr>

            <!-- Modal Konfirmasi Pembayaran -->
            <div class="modal fade" id="konfirmasiModal{{ $pesanan->id }}" tabindex="-1" role="dialog" aria-labelledby="konfirmasiModalLabel{{ $pesanan->id }}" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="konfirmasiModalLabel{{ $pesanan->id }}">Konfirmasi Pembayaran</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <p>Bukti Pembayaran:</p>
                            <img src="{{ asset($pesanan->bukti_pembayaran) }}" alt="Bukti Pembayaran" style="max-width: 50%; height: auto;">
                            <form method="POST" action="{{ route('pesanan.konfirmasi', $pesanan->id) }}">
                                @csrf
                                <div class="mb-3">
                                    <label for="jumlah_pembayaran{{ $pesanan->id }}" class="form-label">Jumlah Pembayaran</label>
                                    <input type="number" class="form-control" id="jumlah_pembayaran{{ $pesanan->id }}" name="jumlah_pembayaran" required>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary">Konfirmasi</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </tbody>
    </table>
</div>

<script>
    window.addEventListener('DOMContentLoaded', event => {
        const datatablesSimple = document.getElementById('tableFilter');
        if (datatablesSimple) {
            new simpleDatatables.DataTable(datatablesSimple);
        }
    });
</script>
@endsection
