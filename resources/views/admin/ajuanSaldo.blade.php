@extends('dashboard/sidebarKaryawan')
@section('content')
<div class="card-body">

    <h1>Pengajuan Penarikan Saldo</h1>

    <hr>

    <table id="tableFilter" class="table table-bordered">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama</th>
                <th>Saldo</th>
                <th>Bank</th>
                <th>No Rekening</th>
                <th>Status</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tfoot>
            <tr>
                <th>No</th>
                <th>Nama</th>
                <th>Saldo</th>
                <th>Bank</th>
                <th>No Rekening</th>
                <th>Status</th>
                <th>Aksi</th>
            </tr>
        </tfoot>
        <tbody>
            <tr>
                @php $no = 1; @endphp
                @forelse($ajuanSaldo as $ajuan)
                <td>{{ $no++}}</td>
                <td>{{ $ajuan->customer->nama }}</td>
                <td>{{ $ajuan->saldo }}</td>
                <td>{{ $ajuan->bank }}</td>

                <td>{{ $ajuan->no_rekening }}</td>
                <td>{{ $ajuan->status }}</td>

                <td> <button class="btn btn-success">
                        Konfirmasi
                    </button><a class="btn btn-success" href="">Konfirmasi</a>
                </td>

                <div>
                    <!-- Modal edit-->
                    <div class="modal fade">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="editModalLabel">Edit Item</h5>
                                </div>
                                <div class="modal-body  ">
                                    <form action="{{ route('ajuanSaldo.update', $ajuan->id) }}" method="POST">
                                        @csrf
                                        @method('PUT')
                                        <div class="form-group">
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </tr>
            @empty
            <td>Data tidak ditemukan</td>
            @endforelse
            </tr>
        </tbody>
    </table>
</div>

@endsection