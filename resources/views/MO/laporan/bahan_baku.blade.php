@extends('dashboard/sidebarKaryawan')
@section('content')
    <div class="container">
        <h1>Laporan Stok Bahan Baku</h1>
        <p>Atma Kitchen</p>
        <p>Jl. Centralpark No. 10 Yogyakarta</p>
        <p>Tanggal cetak: {{ $tanggalCetak }}</p>

        <table class="table">
            <thead>
                <tr>
                    <th>Nama Bahan</th>
                    <th>Satuan</th>
                    <th>Stok</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($data as $item)
                    <tr>
                        <td>{{ $item->nama }}</td>
                        <td>{{ $item->satuan }}</td>
                        <td>{{ $item->stok }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        
        <form method="GET" action="{{ route('laporan.stokBahanBaku') }}" target="_blank">
            <input type="hidden" name="download" value="pdf">
            <button type="submit" class="btn btn-secondary mt-2">Unduh PDF</button>
        </form>
    </div>
@endsection
