@extends('dashboard/sidebarKaryawan')

@section('content')
    <div class="container">
        <h1>Riwayat Pemakaian Bahan Baku</h1>

        <table class="table">
            <thead>
                <tr>
                    <th>Tanggal</th>
                    <th>Bahan Baku</th>
                    <th>Jumlah</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($riwayatPemakaian as $pemakaian)
                    <tr>

                        <td>{{ \Carbon\Carbon::parse($pemakaian->created_at)->format('d-m-Y') }}</td>

                        <td>{{ $pemakaian->bahan_baku->nama }}</td>
                        <td>{{ $pemakaian->jumlah }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

@endsection
