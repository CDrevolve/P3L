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

                <td>
                    <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#terimaModal{{$ajuan->id}}" data-item-id="{{ $ajuan->id }}">
                        Konfirmasi
                    </button>

                    <div>
                        <!-- Modal edit-->
                        <div class="modal fade" id="terimaModal{{$ajuan->id}}" tabindex="-1" role="dialog" aria-labelledby="terimaModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="editModalLabel">Konfirmasi</h5>
                                    </div>
                                    <div class="modal-body  ">
                                        <form action="{{ route('ajuanSaldo.update', $ajuan->id) }}" method="POST">
                                            @csrf
                                            @method('PUT')
                                            <p>
                                                Nama Customer: {{ $ajuan->customer->nama }} <br>
                                                Tarik Saldo : {{ $ajuan->saldo }} <br>
                                                Bank : {{ $ajuan->bank }} <br>

                                                Nomor Rekening : {{ $ajuan->no_rekening }}

                                            </p>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                <button type="submit" class="btn btn-primary" id="saveChangesBtn">Save changes</button>
                                            </div>
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