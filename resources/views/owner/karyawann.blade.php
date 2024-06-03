@extends('dashboard.sidebarKaryawan')

@section('content')
<style>
    body {
        font-family: Arial, sans-serif;
        margin: 0;
        padding: 0;
        background-color: #FEFAF6;
    }

    h2 {
        color: #333;
        text-align: center;
    }

    .container {
        max-width: 800px;
        margin: 20px auto;
        padding: 20px;
        background-color: #FFD9C0;
        border-radius: 5px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    .btn-edit {
        background-color: #007bff;
        color: #fff;
        border: none;
        border-radius: 4px;
        padding: 6px 12px;
        text-decoration: none;
    }

    .btn-edit:hover {
        background-color: #0056b3;
    }
</style>
<div class="container">
    <h2>Seluruh Karyawan</h2>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <table id="tableFilter" class="table table-bordered">
        <thead>
            <tr>
                <th>Nama</th>
                <th>Gaji</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($karyawann as $karyawan)
            <tr>
                <td>{{ $karyawan->nama }}</td>
                <td>{{ $karyawan->gaji }}</td>
                <td>
                    <a href="{{ route('owner.edit_gaji', $karyawan->id) }}" class="btn-edit">Edit</a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

<script>
    window.addEventListener('DOMContentLoaded', event => {
        const datatablesSimple = document.getElementById('tableFilter');
        if (datatablesSimple) {
            new simpleDatatables.DataTable(datatablesSimple);
        }
    });
</script>
@endsection
