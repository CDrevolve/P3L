<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Pembelian</title>

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


</head>

<body>
    <h2>Edit Pembelian</h2>

    @if ($errors->any())
    <div class="error">
        <strong>Error:</strong>
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <form action="{{ route('pembelian.update', $pembelian->id) }}" method="POST">
        @csrf
        @method('PUT')

        <label for="id_bahanbaku">ID Bahan Baku:</label>
            <select name="id_bahanbaku" id="id_bahanbaku" class="form-control">
                @foreach ($bahanbakus as $bahanbaku )
                <option value="{{$bahanbaku->id}}">{{$bahanbaku->nama}}</option>
                @endforeach
            </select>

        <label for="nama">Nama:</label>
        <input type="text" name="nama" id="nama" value="{{ $pembelian->nama }}"  class="form-control" required><br>

        <label for="jenis">Jenis:</label>
        <input type="text" name="jenis" id="jenis" value="{{ $pembelian->jenis }}" class="form-control" required><br>

        <label for="harga">Harga:</label>
        <input type="number" name="harga" id="harga" value="{{ $pembelian->harga }}" class="form-control" required><br>

        <label for="jumlah">Jumlah:</label>
        <input type="number" name="jumlah" id="jumlah" value="{{ $pembelian->jumlah }}" class="form-control" required><br>

        <label for="tanggal">Tanggal:</label>
        <input type="date" name="tanggal" id="tanggal" value="{{ $pembelian->tanggal }}" class="form-control" required><br>

        <button type="submit">Submit</button>
    </form>
</body>

</html>