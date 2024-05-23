<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Resep: {{ $resep->nama_resep }}</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #FEFAF6;
        }

        .container {
            max-width: 800px;
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
</head>
<body>
    <div class="container">
        <a href="{{ route('resep.index') }}" class="btn btn-secondary mb-3">Back</a>
        <h1 class="mb-4">Detail Resep: {{ $resep->nama }}</h1>
        <h2>Bahan-bahan:</h2>
        <button class="btn btn-success mb-3" data-bs-toggle="modal" data-bs-target="#tambahDetailModal">Tambah</button>
        <table class="table">
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
                        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#editDetailModal{{$detail->id}}">Edit</button>
                        <form action="{{ route('detailProduk.destroy', ['id'=> $detail->id, 'id_resep'=>$resep->id] )}}" method="POST" style="display: inline;">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger">Delete</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Modal Tambah Detail -->
    <div class="modal fade" id="tambahDetailModal" tabindex="-1" aria-labelledby="tambahDetailModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="tambahDetailModalLabel">Tambah Detail</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- Form tambah detail -->
                    <form action="{{ route('detailProduk.store', $resep->id) }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="id_bahan_baku" class="form-label">Nama Bahan</label>
                            <select class="form-select" name="id_bahan_baku" id="id_bahan_baku">
                                @foreach ($bahanBakus as $bb)
                                <option value="{{$bb->id}}">{{$bb->nama}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="jumlah" class="form-label">Jumlah</label>
                            <input type="number" class="form-control" id="jumlah" name="jumlah" required>
                        </div>
                        <button type="submit" class="btn btn-success">Tambah</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
