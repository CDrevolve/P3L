<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css'>
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
    <!-- //PENTING BANGET INI// -->
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/simple-datatables" type="text/javascript"></script>
    <script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.3.0/dist/umd/simple-datatables.min.js" crossorigin="anonymous"></script>

    <!-- sangat penting -->
    <link href="{{ asset('css/styles.css') }}" rel="stylesheet" />


    <title>Pengeluaran Lain</title>
</head>

<body>
    <h1>
        Pengeluaran Lain
    </h1>
    <a href="{{ route('mo')}}" class="btn btn-secondary"><-back </a>


            <div class="container">



                <div class="col">
                    <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#tambahPengeluaranLainModal">Tambah</button>
                </div>

                <hr>

                <div class="card">
                    <div class="card-body">
                        <table id="tableFilter" class="border 1px black">
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


            <script>
                const dataTable = new simpleDatatables.DataTable("#tableFilter", {
                    searchable: true,
                    fixedHeight: true
                });
            </script>
</body>

</html>