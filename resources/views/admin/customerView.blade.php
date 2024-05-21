<head>
    <title>Customer View</title>
</head>
@extends('dashboard.sidebarKaryawan')

@section('content')


<div class="card-body">
    <h1>
        Customer
    </h1>

    <hr>

    <table id="tableFilter" class="table table-bordered">
        <thead>
            <tr>
                <th>Id</th>
                <th>Nama</th>
                <th>Saldo</th>
                <th>Nomor Telepon</th>
                <th>Poin</th>
                <th>History</th>
            </tr>
        </thead>
        <tfoot>
            <tr>
                <th>Id</th>
                <th>Nama</th>
                <th>Saldo</th>
                <th>Nomor Telepon</th>
                <th>Poin</th>
                <th>History</th>
            </tr>
        </tfoot>
        <tbody>
            @forelse($customers as $customer)
            <tr>
                <td>{{ $customer->id }}</td>
                <td>{{ $customer->nama }}</td>
                <td>{{ $customer->saldo }}</td>
                <td>{{ $customer->no_telp }}</td>
                <td>{{ $customer->poin }}</td>
                <td><a href="{{ route('customer.history', $customer->id) }}">History</a></td>
            </tr>
            @empty
            <tr>
                <td colspan="6">No data</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection