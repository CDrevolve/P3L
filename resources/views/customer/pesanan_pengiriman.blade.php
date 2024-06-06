@extends('dashboard.navbar')

@section('content')
<div class="container">
    <div class="card-header">
        <h3>Pesanan Dalam Pengiriman / Sudah Dipick-up</h3>
    </div>
    <div class="card-body">
        <table id="tableFilter2" class="table table-bordered">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Pesanan</th>
                    <th>Total Harga</th>
                    <th>Status</th>
                    <th>Aksi</th> <!-- New column for action button -->
                </tr>
            </thead>
            <tbody>
                @forelse ($pengirimanPesanans as $p)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $p->nama }}</td>
                    <td>{{ $p->harga }}</td>
                    <td>{{ $p->status }}</td>
                    <td> <!-- New column for action button -->
                        @if ($p->status == 'sedang dikirim' || $p->status == 'sudah di-pickup')
                            <form action="{{ route('pesananPengiriman.update', $p->id) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <button type="submit" class="btn btn-primary">Pesanan Diterima</button>
                            </form>
                        @endif
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5">Tidak ada pesanan yang sedang dikirim atau sudah dipick-up</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<script>
    window.addEventListener('DOMContentLoaded', event => {
        // Simple-DataTables initialization
        const datatablesSimple2 = document.getElementById('tableFilter2');
        if (datatablesSimple2) {
            new simpleDatatables.DataTable(datatablesSimple2);
        }
    });
</script>
@endsection
