@extends('dashboard.sidebarKaryawan')

@section('content')
<style>
    h1 {
        color: #fff;
        text-align: center;
    }

    .btn-primary {
        background-color: #B0A3C1;
    }

    .btn-primary:hover {
        background-color: #FFD9C0;
        color: white;
    }

    .alert-success {
        background-color: #B0A3C1;
        color: white;
    }

    .container {
        margin: 20px auto;
        padding: 20px;
        background-color: #FEFAF6;
        border-radius: 5px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 20px;
    }

    th, td {
        border: 1px solid #ddd;
        padding: 8px;
        text-align: left;
    }

    th {
        background-color: #f2f2f2;
        color: #333;
    }

    .no-data {
        text-align: center;
        padding: 20px;
    }
</style>

<h1>Pesanan Siap Dipickup</h1>
<div class="container">

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    @if($pesanans->isEmpty())
        <p class="no-data">Tidak ada pesanan yang siap dipickup.</p>
    @else
        <table id="tableFilter" class="table table-bordered">
            <thead>
                <tr>
                    <th>Customer</th>
                    <th>Alamat</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($pesanans as $pesanan)
                    <tr>
                        <td>{{ $pesanan->customer->nama }}</td>
                        <td>{{ $pesanan->alamat->nama }}</td>
                        <td>{{ $pesanan->status }}</td>
                        <td>
                            <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#pickupModal{{ $pesanan->id }}">Pickup</button>
                        </td>
                    </tr>

                    <!-- Modal Pickup -->
                    <div class="modal fade" id="pickupModal{{ $pesanan->id }}" tabindex="-1" role="dialog" aria-labelledby="pickupModalLabel{{ $pesanan->id }}" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="pickupModalLabel{{ $pesanan->id }}">Konfirmasi Pickup</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form method="POST" action="{{ route('pesanan.updatePickupStatus', $pesanan->id) }}">
                                        @csrf
                                        <div class="mb-3">
                                            <label for="pickup_option{{ $pesanan->id }}" class="form-label">Pilih Opsi Pickup</label>
                                            <select class="form-control" id="pickup_option{{ $pesanan->id }}" name="pickup_option" required>
                                                <option value="pihak_ketiga">Sudah diambil pihak ketiga</option>
                                                <option value="sendiri">Sudah diambil sendiri</option>
                                            </select>
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
    @endif
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
