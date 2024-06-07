@extends('dashboard.sidebarKaryawan')
@section('content')
<div class="container">
    <h1>Daftar Hampers</h1>
    <a href="{{ route('hampers.create') }}" class="btn btn-primary">Tambah Hampers</a>
    <table class="table mt-3">
        <thead>
            <tr>
                <th>Nama</th>
                <th>Harga</th>
                <th>Produk</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($hampers as $hampers)
            <tr>
                <td>{{ $hampers->nama }}</td>
                <td>{{ $hampers->harga }}</td>
                <td>
                    <ul>
                        @foreach($hampers->detailHampers as $detail)
                        <li>{{ $detail->produk->nama }}</li>
                        @endforeach
                    </ul>
                </td>
                <td>
                    <a href="{{ route('hampers.edit', $hampers->id) }}" class="btn btn-warning">Edit</a>
                    <form action="{{ route('hampers.destroy', $hampers->id) }}" method="POST" style="display:inline-block;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Hapus</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
