<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Resep: {{ $resep->nama_resep }}</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #FEFAF6;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 600px;
            margin: 50px auto;
            padding: 20px;
            background-color: #FFD9C0;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h1 {
            text-align: center;
            margin-bottom: 20px;
        }

        h2 {
            margin-bottom: 10px;
        }

        ul {
            list-style-type: none;
            padding: 0;
        }

        li {
            margin-bottom: 10px;
        }
    </style>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

</head>

<body>
    <div class="container">
        <h1>Detail Resep: {{ $resep->nama }}</h1>
        <h2>Bahan-bahan:</h2>
        <button>
            <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#tambahDetailModal">Tambah</button>
        </button>
        <table>
            <thead>
                <tr>
                    <th>Nama Bahan</th>
                    <th>Jumlah</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tfoot>
                <tr>
                    <th>Nama Bahan</th>
                    <th>Jumlah</th>
                    <th>Aksi</th>
                </tr>
            </tfoot>
            <tbody>
                @foreach ($detailProduks as $detail)
                <tr>
                    <td>{{ $detail->bahanBaku->nama }}</td>
                    <td>{{ $detail->jumlah }}</td>

                    <td>
                        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#editDetailModal{{$detail->id}}">Edit</button>

                        <form action="{{ route('detailProduk.destroy', ['id'=> $detail->id, 'id_resep'=>$resep->id] )}}" method="POST" style="display: inline;">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger">Delete</button>
                        </form>
                    </td>
                </tr>

                <div class="modal fade" id="editDetailModal{{$detail->id}}" tabindex="-1" role="dialog" aria-labelledby="editDetailLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="tambahModalLabel">Tambah Item</h5>
                            </div>
                            <div class="modal-body">
                                <!-- Form fields for add item -->
                                <!-- Replace this with your form fields -->
                                <form id="addForm" action="{{route('detailProduk.update', ['id'=> $detail->id, 'id_resep'=>$resep->id])}}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <label for="namaBahan">Name:</label>
                                    <select name="id_bahan_baku" id="id_bahan_baku" class="form-control">
                                        @foreach ($bahanBakus as $bb)
                                        <option value="{{$bb->id}}">{{$bb->nama}}</option>
                                        @endforeach
                                        <option value="null" hidden selected>Nama Bahan</option>
                                    </select>
                                    <label for="itemName">Jumlah:</label>
                                    <input required type="number" class="form-control" id="jumlah" name="jumlah">
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-success" id="addBtn">Add Bahan</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>


                @endforeach
        </table>

    </div>





    <div class="modal fade" id="tambahDetailModal" tabindex="-1" role="dialog" aria-labelledby="tambahDetailLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="tambahModalLabel">Tambah Item</h5>
                </div>
                <div class="modal-body">
                    <!-- Form fields for add item -->
                    <!-- Replace this with your form fields -->

                    <form id="addForm" action="{{route('detailProduk.store', $resep->id)}}" method="POST">
                        @csrf
                        @method('POST')
                        <label for="namaBahan">Name:</label>
                        <select name="id_bahan_baku" id="id_bahan_baku" class="form-control">
                            @foreach ($bahanBakus as $bb)
                            <option value="{{$bb->id}}">{{$bb->nama}}</option>
                            @endforeach
                            <option value="null" hidden selected>Nama Bahan</option>
                        </select>
                        <label for="itemName">Jumlah:</label>
                        <input required type="number" class="form-control" id="jumlah" name="jumlah">
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-success" id="addBtn">Add Bahan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>

</html>