@extends('dashboard.sidebarKaryawan')

@section('content')
<div class="container my-5">
    <h1>Daftar pesanan perlu input jarak</h1>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <table id="tableFilter" class="table table-bordered">
        <thead>
            <tr>
                <th>Customer</th>
                <th>Alamat</th>
                <th>Nama</th>
                <th>Isi</th>
                <th>Harga</th>
                <th>Tanggal</th>
                <th>Jarak</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($pesanans as $pesanan)
            <tr>
                <td>{{ $pesanan->customer->nama }}</td>
                <td>{{ $pesanan->alamat->nama }}</td>
                <td>{{ $pesanan->nama }}</td>
                <td>{{ $pesanan->isi }}</td>
                <td>{{ $pesanan->harga }}</td>
                <td>{{ $pesanan->tanggal }}</td>
                <td>{{ $pesanan->jarak }}</td>
                <td>
                    <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#inputJarakModal{{ $pesanan->id }}">Input Jarak</button>
                </td>
            </tr>

            <!-- Modal Input Jarak -->
            <div class="modal fade" id="inputJarakModal{{ $pesanan->id }}" tabindex="-1" role="dialog" aria-labelledby="inputJarakModalLabel{{ $pesanan->id }}" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="inputJarakModalLabel{{ $pesanan->id }}">Input Jarak</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form method="POST" action="{{ route('pesanan.updateJarak', $pesanan->id) }}">
                                @csrf
                                @method('PUT')
                                <div class="mb-3">
                                    <label for="jarak{{ $pesanan->id }}" class="form-label">Jarak (km)</label>
                                    <input type="number" class="form-control" id="jarak{{ $pesanan->id }}" name="jarak" required>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary">Save changes</button>
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
