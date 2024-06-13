@extends('dashboard.sidebarKaryawan')
@section('content')
<div class="card-body">
    <h1>Laporan Presensi dan Gaji Karyawan Perbulan</h1>

    <table border="0" cellpadding="0" cellspacing="0">
        <tr>
            <th>Nama</th>
            <th>Jumlah<br>Hadir</th>
            <th>Jumlah<br>Bolos</th>
            <th>Honor<br>Harian</th>
            <th>Bonus<br>Rajin</th>
            <th>Total</th>
        </tr>

        <tr>
            <td>Yoongi</td>
            <td>24</td>
            <td>7</td>
            <td>2.400.000</td>
            <td>100.000</td>
            <td>2.400.000</td>
        </tr>
        <tr>
            <td>Jekey</td>
            <td>29</td>
            <td>2</td>
            <td>2.900.000</td>
            <td>3.000.000</td>
            <td>-</td>
        </tr>
        <tr>
            <td>Jimina</td>
            <td>26</td>
            <td>5</td>
            <td>2.600.000</td>
            <td>2.690.000</td>
            <td>-</td>
        </tr>

        <tr>
            <th colspan="6">Total</th>
        </tr>
    </table>
</div>

@endsection