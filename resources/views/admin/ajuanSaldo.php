@extends(dashboard/sidebarKaryawan)
@section('content')

<div class="card-body">

    <h1>Pengajuan Penarikan Saldo</h1>
    <table>
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
                foreach($ajuanSaldo as $ajuan)
                <td>{{ $ajuan->id_customer->nama }}</td>
                <td>{{ $ajuan->saldo }}</td>
                <td>{{ $ajuan->bank }}</td>
                <td>{{ $ajuan->no_rekening }}</td>
                <td>{{ $ajuan->status }}</td>
                <td> <a href="">Konfirmasi</a> </td>
            </tr>
        </tbody>
    </table>
</div>

@endsection