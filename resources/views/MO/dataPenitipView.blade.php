<head>
    <title>Data Penitip</title>
</head>


@extends('dashboard/sidebarKaryawan')
@section('content')

<div class="card-body">
    <h1>
        Data Penitip
    </h1>

    <hr>

    <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#tambahPenitipModal">Tambah</button>

    <table id="tableFilter" class="table table-bordered">

        <thead>
            <tr>
                <th>Nama</th>
                <th>Alamat</th>
                <th>Nomor Telepon</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tfoot>
            <tr>
                <th>Nama</th>
                <th>Alamat</th>
                <th>Nomor Telepon</th>
                <th>Aksi</th>
            </tr>
        </tfoot>
        <tbody>
            @forelse($dataPenitips as $dp)
            <tr>
                <td>{{$dp->nama}}</td>
                <td>{{$dp->alamat}}</td>
                <td>{{$dp->notelp}}</td>
                <td>
                    <!-- Edit button -->
                    <button class="btn btn-primary edit-btn" data-bs-toggle="modal" data-bs-target="#editPenitipModal{{$dp->id}}" data-item-id="{{ $dp->id }}">Edit</button>

                    <!-- Delete button -->
                    <button class="btn btn-danger delete-btn" data-bs-toggle="modal" data-bs-target="#deleteModal{{$dp->id}}" data-item-id="{{ $dp->id }}">Delete</button>

                </td>
            </tr>

            <!-- Modal edit-->
            <div class="modal fade" id="editPenitipModal{{$dp->id}}" tabindex="-1" role="dialog" aria-labelledby="editPenitipLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="editModalLabel">Edit Item</h5>
                        </div>
                        <div class="modal-body">
                            <!-- Form fields for editing item -->
                            <!-- Replace this with your form fields -->
                            <form id="editForm" method="POST" action="{{route('datapenitip.update', $dp->id)}}">
                                @csrf
                                @method('PUT')
                                <label for="nama">Nama:</label>
                                <input required type="text" class="form-control" id="nama" name="nama" value="{{$dp->nama}}">
                                <label for="alamat">Alamat:</label>
                                <input required type="text" class="form-control" id="alamat" name="alamat" value="{{$dp->alamat}}">
                                <label for="notelp">Nomor Telepon:</label>
                                <input required type="text" class="form-control" id="notelp" name="notelp" value="{{$dp->notelp}}">
                                <!-- Add more form fields as needed -->

                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary" id="saveChangesBtn">Save changes</button>
                                </div>
                            </form>
                        </div>

                    </div>
                </div>
            </div>

            <!-- Modal Hapus-->
            <div class="modal fade" id="deleteModal{{$dp->id}}" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="deleteModalLabel">Delete Item</h5>
                        </div>
                        <div class="modal-body">
                            <p>Are you sure you want to delete this item?</p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                            <form action="{{ route('datapenitip.destroy', $dp->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Hapus</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            @empty
            <tr>
                <td colspan="4">Belum ada data</td>
            </tr>
            @endforelse
        </tbody>

    </table>


</div>







<!-- Modal add -->
<div class="modal fade" id="tambahPenitipModal" tabindex="-1" role="dialog" aria-labelledby="tambahPenitipLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="tambahModalLabel">Tambah Item</h5>
            </div>
            <div class="modal-body">
                <!-- Form fields for add item -->
                <!-- Replace this with your form fields -->

                <form id="addForm" action="{{route('datapenitip.store')}}" method="POST">
                    @csrf
                    @method('POST')
                    <label for="namaPenitip">Name:</label>
                    <input required type="text" class="form-control" id="nama" name="nama">
                    <label for="id_produk">Produk Titipan</label>
                    <label for="itemName">Alamat:</label>
                    <input required type="text" class="form-control" id="alamat" name="alamat">
                    <label for="itemName">Nomor telepon:</label>
                    <input required type="text" class="form-control" id="notelp" name="notelp">
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-success" id="addBtn">Add Penitip</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>



@endsection