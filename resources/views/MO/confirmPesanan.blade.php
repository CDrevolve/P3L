@extends('dashboard.sidebarKaryawan')
@section('content')

<div class="card-body">
    <h1>Terima Pesanan</h1>

    <hr>

    <table id="tableFilter" class="table table-bordered">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Pemesanan</th>
                <th>Isi</th>
                <th>Harga</th>
                <th>Total Harga</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
        </thead>
        <tfoot>
            <tr>
                <th>No</th>
                <th>Nama Pemesanan</th>
                <th>Isi</th>
                <th>Harga</th>
                <th>Total Harga</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
        </tfoot>
        <tbody>
            @foreach($pesanans as $p)
            <tr>
                <td>{{ $loop->iteration }}</td> <!-- Add an iteration for No column -->
                <td>{{$p->nama}}</td>
                <td>{{$p->isi}}</td>
                <td>{{$p->harga}}</td>
                <td>{{$p->jumlah_pembayaran}}</td>
                <td>{{$p->status}}</td>
                <td>
                    <a class="btn btn-success" href="{{ route('confirmMo.terima', $p->id)}}">
                        Terima
                    </a>
                    <a class="btn btn-danger" href="{{ route('confirmMo.tolak', $p->id)}}">
                        Tolak
                    </a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <!-- Error display section -->
    @if(session('error'))
    <div style="color: red; margin-top: 20px;">
        <ul>
            @foreach(session('error') as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    @if(session('success'))
    <div style="color: green; margin-top: 20px;">
        {{ session('success') }}
    </div>
    @endif
</div>

@endsection