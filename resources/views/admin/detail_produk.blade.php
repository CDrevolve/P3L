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
    <h1>Detail Resep: {{ $resep->nama }}</h1>
    <a href="{{ route('resep.index') }}" class="btn btn-secondary mb-3">Back</a>

    <h2>Bahan-bahan:</h2>
    <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#tambahDetailModal">Tambah</button>

    <table class="table table-bordered mt-3">
        <thead>
            <tr>
                <th>Nama Bahan</th>
                <th>Jumlah</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($detailProduks as $detail)
            <tr>
                <td>{{ $detail->bahanBaku->nama }}</td>
                <td>{{ $detail->jumlah }}</td>
                <td>
                    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#editDetailModal{{ $detail->id }}">Edit</button>

                    <form action="{{ route('detailProduk.destroy', ['id'=> $detail->id, 'id_resep'=>$resep->id]) }}" method="POST" style="display: inline;">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger">Delete</button>
                    </form>
                </td>
            </tr>

            <!-- Modal Edit Detail -->
            <div class="modal fade" id="editDetailModal{{ $detail->id }}" tabindex="-1" role="dialog" aria-labelledby="editDetailLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="editModalLabel">Edit Item</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form action="{{ route('detailProduk.update', ['id'=> $detail->id, 'id_resep'=>$resep->id]) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <label for="id_bahan_baku">Name:</label>
                                <select name="id_bahan_baku" id="id_bahan_baku" class="form-control">
                                    @foreach ($bahanBakus as $bb)
                                    <option value="{{ $bb->id }}" {{ $bb->id == $detail->bahan_baku_id ? 'selected' : '' }}>{{ $bb->nama }}</option>
                                    @endforeach
                                </select>
                                <label for="jumlah">Jumlah:</label>
                                <input type="number" class="form-control" id="jumlah" name="jumlah" value="{{ $detail->jumlah }}" required>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-success">Save changes</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </tbody>
    </table>

    <!-- Modal Tambah Detail -->
    <div class="modal fade" id="tambahDetailModal" tabindex="-1" role="dialog" aria-labelledby="tambahDetailLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="tambahModalLabel">Tambah Item</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('detailProduk.store', $resep->id) }}" method="POST">
                        @csrf
                        <label for="id_bahan_baku">Name:</label>
                        <select name="id_bahan_baku" id="id_bahan_baku" class="form-control">
                            @foreach ($bahanBakus as $bb)
                            <option value="{{ $bb->id }}">{{ $bb->nama }}</option>
                            @endforeach
                        </select>
                        <label for="jumlah">Jumlah:</label>
                        <input type="number" class="form-control" id="jumlah" name="jumlah" required>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-success">Add Bahan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
