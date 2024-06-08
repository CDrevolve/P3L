@extends('dashboard/sidebarKaryawan')
@section('content')
@section('content')
    <div class="container">
        <h1>Laporan Stok Bahan Baku</h1>

        <table class="table">
            <thead>
                <tr>
                    <th>Bahan Baku</th>
                    <th>Stok</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($bahanBaku as $bahan)
                    <tr>
                        <td>{{ $bahan->nama }}</td>
                        <td>{{ $bahan->stok }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection