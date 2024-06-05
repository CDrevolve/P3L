<title>Pesanan Belum Bayar</title>

@extends('dashboard.navbar')
@section('content')

<div class="container">
    <div class="card-header">
        <h3>Pesanan Belum Bayar</h3>
    </div>
    <div class="card-body">

        <table id="tableFilter" class="table table-bordered">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Pesanan</th>
                    <th>Total Harga</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tfoot>
                <tr>
                    <th>No</th>
                    <th>Nama Pesanan</th>
                    <th>Total Harga</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </tfoot>
            <tbody>
                @forelse ($pemesanans as $p)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $p->nama }}</td>
                    <td>{{ $p->harga }}</td>
                    <td>{{ $p->status }}</td>
                    <td>
                        <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#bayarModal{{$p->id}}" data-item-id="{{ $p->id }}">Bayar</button>
                    </td>
                </tr>

                <div class="modal fade" id="bayarModal{{$p->id}}" tabindex="-1" role="dialog" aria-labelledby="bayarLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="editModalLabel">Edit Item</h5>
                            </div>
                            <div class="modal-body">
                                <!-- Form fields for editing item -->
                                <!-- Replace this with your form fields -->
                                <form action="{{ route('pesananBayar.update', $p->id) }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')
                                    <label for="jumlah">Jumlah</label>
                                    <h5>
                                        {{$p->harga + $p->ongkir}}
                                    </h5>
                                    <br>
                                    <label for="bukti_pembayaran">Bukti Pembayaran</label>
                                    <input class="form-control" type="file" name="bukti_pembayaran" id="bukti_pembayaran" required>

                                    <br>

                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-success">Bayar</button>
                                    </div>
                                </form>
                            </div>

                        </div>
                    </div>
                </div>

                @empty
                <tr>
                    <td colspan="5">Tidak ada pesanan yang belum dibayar</td>
                </tr>
                @endforelse
        </table>


    </div>
</div>



<script>
    window.addEventListener('DOMContentLoaded', event => {
        // Simple-DataTables
        // https://github.com/fiduswriter/Simple-DataTables/wiki

        const datatablesSimple = document.getElementById('tableFilter');
        if (datatablesSimple) {
            new simpleDatatables.DataTable(datatablesSimple);
        }
    });
</script>


@endsection