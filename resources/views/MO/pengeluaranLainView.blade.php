<head>
    <title>Pengeluaran Lain</title>
</head>

@extends('dashboard/sidebarKaryawan')
@section('content')



<div class="card-body">
    <h1>
        Pengeluaran Lain
    </h1>

    <hr>

    <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#tambahPengeluaranLainModal">Tambah</button>

    <div class="card-body">
        <table id="tableFilter" class="table table-bordered">

            <thead>
                <tr>
                    <th>Nama Pengeluaran</th>
                    <th>Jumlah</th>
                    <th>Harga</th>
                    <th>Tanggal</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tfoot>
                <tr>
                    <th>Nama Pengeluaran</th>
                    <th>Jumlah</th>
                    <th>Harga</th>
                    <th>Tanggal</th>
                    <th>Aksi</th>
                </tr>
            </tfoot>
            <tbody>
                @forelse($pengeluaranLains as $pl)
                <tr>
                    <td>{{$pl->nama}}</td>
                    <td>{{$pl->jumlah}}</td>
                    <td>{{$pl->harga}}</td>
                    <td>{{$pl->tanggal}}</td>
                    <td>
                        <!-- Edit button -->
                        <button class="btn btn-primary edit-btn" data-bs-toggle="modal" data-bs-target="#editPengeluaranLainModal{{$pl->id}}" data-item-id="{{ $pl->id }}">Edit</button>

                        <!-- Delete button -->
                        <button class="btn btn-danger delete-btn" data-bs-toggle="modal" data-bs-target="#deleteModal{{$pl->id}}" data-item-id="{{ $pl->id }}">Delete</button>

                    </td>
                </tr>



                <!-- Modal edit-->
                <div class="modal fade" id="editPengeluaranLainModal{{$pl->id}}" tabindex="-1" role="dialog" aria-labelledby="editPengeluaranLainLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="editModalLabel">Edit Item</h5>
                            </div>
                            <div class="modal-body">
                                <!-- Form fields for editing item -->
                                <!-- Replace this with your form fields -->
                                <form id="editForm" method="POST" action="{{route('pengeluaranlain.update', $pl->id)}}">
                                    @csrf
                                    @method('PUT')
                                    <label for="nama">Nama:</label>
                                    <input required type="text" class="form-control" id="nama" name="nama" value="{{$pl->nama}}">
                                    <label for="alamat">Jumlah:</label>
                                    <input required type="text" class="form-control" id="jumlah" name="jumlah" value="{{$pl->jumlah}}">
                                    <label for="notelp">Harga:</label>
                                    <input required type="number" step="any" class="form-control" id="harga" name="harga" value="{{$pl->harga}}">
                                    <label for="tanggal">Tanggal:</label>
                                    <input required type="date" class="form-control" id="tanggal" name="tanggal" value="{{$pl->tanggal}}">
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
                <div class="modal fade" id="deleteModal{{$pl->id}}" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
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
                                <form action="{{ route('pengeluaranlain.destroy', $pl->id) }}" method="POST">
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
                    <td colspan="4">Data Pengeluaran Lain Kosong</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

</div>


<!-- Modal add -->
<div class="modal fade" id="tambahPengeluaranLainModal" tabindex="-1" role="dialog" aria-labelledby="tambahPengeluaranLainLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="tambahModalLabel">Tambah Item</h5>
            </div>
            <div class="modal-body">
                <!-- Form fields for add item -->
                <!-- Replace this with your form fields -->

                <form id="addForm" action="{{route('pengeluaranlain.store')}}" method="POST">
                    @csrf
                    @method('POST')
                    <label for="namaPengeluaran">Nama Pengeluaran:</label>
                    <input required type="text" class="form-control" id="nama" name="nama">
                    <label for="itemName">Jumlah:</label>
                    <input required type="text" class="form-control" id="jumlah" name="jumlah">
                    <label for="itemName">Harga:</label>
                    <input required type="number" step="any" class="form-control" id="harga" name="harga">
                    <label for="itemName">Tanggal:</label>
                    <input required type="date" class="form-control" id="tanggal" name="tanggal">
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-success" id="addBtn">Add Pengeluaran</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection