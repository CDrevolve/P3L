<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Pesanan Antar</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/simple-datatables" type="text/javascript"></script>
    <script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.3.0/dist/umd/simple-datatables.min.js"></script>
    <link href="{{ asset('css/styles.css') }}" rel="stylesheet">
</head>
<body>
    <div class="container my-5">
        <h1>Daftar Pesanan Antar</h1>

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
                    <td>{{ $pesanan->jarak}}</td>
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
</body>
</html>
