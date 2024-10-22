<head>
    <title>Bahan Baku</title>
</head>

@extends('dashboard/sidebarKaryawan')
@section('content')



<div class="card-body">

    <h1>
        Bahan Baku
    </h1>

    <hr>

    <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#tambahBahanModal">Tambah</button>

    <table id="tableFilter" class="table table-bordered">

        <thead>
            <tr>
                <th>Nama Bahan</th>
                <th>Stok</th>
                <th>Satuan</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tfoot>
            <tr>
                <th>Nama Bahan</th>
                <th>Stok</th>
                <th>Satuan</th>
                <th>Aksi</th>
            </tr>
        </tfoot>
        <tbody>
            @forelse($bahanBakus as $bk)
            <tr>
                <td>{{$bk->nama}}</td>
                <td>{{$bk->stok}}</td>
                <td>{{$bk->satuan}}</td>
                <td>
                    <!-- Edit button -->
                    <button class="btn btn-primary edit-btn" data-bs-toggle="modal" data-bs-target="#editBahanModal{{$bk->id}}" data-item-id="{{ $bk->id }}">Edit</button>

                    <!-- Delete button -->
                    <button class="btn btn-danger delete-btn" data-bs-toggle="modal" data-bs-target="#deleteModal{{$bk->id}}" data-item-id="{{ $bk->id }}">Delete</button>

                </td>
            </tr>

            <!-- Modal edit-->
            <div class="modal fade" id="editBahanModal{{$bk->id}}" tabindex="-1" role="dialog" aria-labelledby="editBahanLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="editModalLabel">Edit Item</h5>
                        </div>
                        <div class="modal-body">
                            <!-- Form fields for editing item -->
                            <!-- Replace this with your form fields -->
                            <form id="editForm" method="POST" action="{{route('bahanbaku.update', $bk->id)}}">
                                @csrf
                                @method('PUT')
                                <label for="namaBahan">Nama:</label>
                                <input required type="text" class="form-control" id="nama" name="nama" value="{{$bk->nama}}">
                                <label for="itemName">Stok:</label>
                                <input required type="number" step="any" class="form-control" id="stok" name="stok" value="{{$bk->stok}}">
                                <label for="itemName">Satuan:</label>
                                <input required type="text" class="form-control" id="satuan" name="satuan" value="{{$bk->satuan}}">
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
            <div class="modal fade" id="deleteModal{{$bk->id}}" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
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
                            <form action="{{ route('bahanbaku.destroy', $bk->id) }}" method="POST">
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
<div class="modal fade" id="tambahBahanModal" tabindex="-1" role="dialog" aria-labelledby="tambahBahanLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="tambahModalLabel">Tambah Item</h5>
            </div>
            <div class="modal-body">
                <!-- Form fields for add item -->
                <!-- Replace this with your form fields -->

                <form id="addForm" action="{{route('bahanbaku.store')}}" method="POST">
                    @csrf
                    @method('POST')
                    <label for="namaBahan">Name:</label>
                    <input required type="text" class="form-control" id="nama" name="nama">
                    <label for="itemName">Stok:</label>
                    <input required type="number" step="any" class="form-control" id="stok" name="stok">
                    <label for="itemName">Satuan:</label>
                    <input required type="text" class="form-control" id="satuan" name="satuan">
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-success" id="addBtn">Add Bahan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection