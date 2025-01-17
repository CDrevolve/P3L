<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>

    <!-- //PENTING BANGET INI// -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/simple-datatables" type="text/javascript"></script>
    <script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.3.0/dist/umd/simple-datatables.min.js" crossorigin="anonymous"></script>

    <!-- sangat penting -->


    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css'>
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
    <style>
        body {
            min-height: 150vh;
        }

        .sidebar {

            height: 200vh;
            background-color: #B0A3C1;
            padding: 15px;
            color: #fff;
            font-family: 'Arial', sans-serif;
            font-weight: bold;
        }

        .profile img {
            width: 100px;
            border-radius: 50%;
            margin-bottom: 10px;
        }

        .nav-link {
            color: #FDC4CB;
            padding: 10px;
            border-radius: 10px;
        }

        .nav-link:hover {
            background-color: #FFD9C0;
            color: #fff;
        }

        .content {
            padding: 20px;
            background-color: #FFD9C0;
        }
    </style>
</head>

<body>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-2 sidebar">
                <div class="profile text-center">
                    <img src="http://via.placeholder.com/100x100" alt="Profile Photo">
                    <h3>{{Auth::user()->username}}</h3>

                    <a class="btn btn-danger" href="{{route('actionLogout')}}">Log Out</a>

                </div>
                <ul class="nav flex-column">
                    <li class="nav-item"> <a href="{{route('landingPageKaryawan')}}" class="nav-link"><i class="fa fa-files-o"></i> <span class="nav-label">Home</span></a> </li>
                    @if(Auth::user()->role->id == '2')
                    <li class="nav-item"> <a href="{{ route('produk.index') }}" class="nav-link">Products</a> </a></li>
                    <li class="nav-item"> <a href="{{ route('resep.index') }}" class="nav-link">Recipes</a> </li>
                    <li class="nav-item"> <a href="{{ route('bahanbaku.index') }}" class="nav-link">Bahan Baku</a> </li>
                    <li class="nav-item"> <a href="{{ route('customer.index')}}" class="nav-link">Customers</a> </li>
                    <li class="nav-item"> <a href="{{ route('pesanan.index') }}" class="nav-link">Input Jarak</a> </li>
                    <li class="nav-item"> <a href="{{ route('pesanan.sudahDibayar') }}" class="nav-link">Konfirmasi Pesanan</a> </li>
                    <li class="nav-item"> <a href="{{ route('ajuanSaldo.index') }}" class="nav-link">Penarikan Saldo</a> </li>
                    <li class="nav-item"> <a href="{{ route('profile.editPassword') }}" class="nav-link">Edit Password</a> </li>
                    <li class="nav-item"> <a href="{{ route('pesanan.sedangDiproses') }}" class="nav-link">Pesanan diproses</a> </li>
                    <li class="nav-item"> <a href="{{ route('pesanan.sudahDipickup') }}" class="nav-link">Pesanan dipickup</a> </li>
                    <li class="nav-item"> <a href="{{ route('pesanan.telatBayar') }}" class="nav-link">Pesanan Telat Bayar</a> </li>

                    <li class="nav-item"> <a href="#" class="nav-link">Other Pages</a> </li>


                    @elseif(Auth::user()->role->id == '3')
                    <li class="nav-item"> <a href="{{ route('karyawan.index') }}" class="nav-link">Employee</a> </li>
                    <li class="nav-item"> <a href="{{ route('datapenitip.index') }}" class="nav-link">Penitip</a> </li>
                    <li class="nav-item"> <a href="{{ route('pengeluaranlain.index') }}" class="nav-link">Pengeluaran Lain</a> </li>
                    <li class="nav-item"> <a href="{{ route('mo.profile.editPassword') }}" class="nav-link">Edit Password</a> </li>
                    <li class="nav-item"> <a href="{{ route('confirmMo.index') }}" class="nav-link">Confirm Pesanan</a> </li>

                    <li class="nav-item"> <a href="{{ route('laporanPresensi.index') }}" class="nav-link">Laporan Presensi & Gaji</a> </li>
                    <li class="nav-item"> <a href="{{ route('laporanTransaksiPenitip.index') }}" class="nav-link">Laporan Rekap Transaksi Penitip</a> </li>
                    <li class="nav-item"> <a href="{{ route('laporanPemasukandanPengeluaran.index') }}" class="nav-link">Laporan Pemasukan dan Pengeluaran Bulanan</a> </li>

                    <li class="nav-item"> <a href="{{ route('laporan-penjualan-tahunan') }}" class="nav-link">Laporan penjualan tahunan</a> </li>
                    <li class="nav-item"> <a href="{{ route('pemesanans.riwayatIndex') }}" class="nav-link">Riwayat</a></li>
                    <li class="nav-item"> <a href="{{ route('laporan.penggunaan_bahan_baku') }}" class="nav-link">Laporan Penggunaan Bahan Baku</a></li>
                    <li class="nav-item"> <a href="{{ route('pesanan.prosesIndex') }}" class="nav-link">Pemesanan</a> </li>
                    <li class="nav-item"> <a href="{{ route('pemesanans.riwayatIndex') }}" class="nav-link">Riwayat</a></li>
                    
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Laporan
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item" href="{{ route('laporan.penjualanBulanan') }}">Laporan Penjualan Bulanan</a></li>
                        <li><a class="dropdown-item" href="{{ route('laporan.stokBahanBaku') }}">Laporan Stok Bahan Baku</a></li>
                        </ul>
                    </li>

                    @elseif(Auth::user()->role->id == '1')
                    <li class="nav-item"> <a href="{{ route('owner.profile.editPassword') }}" class="nav-link">Edit Password</a> </li>
                    <li class="nav-item"> <a href="{{ route('owner.karyawann') }}" class="nav-link">Kelola Gaji Karyawan</a> </li>
                    
                    
                    <li class="nav-item"> <a href="{{ route('laporanPresensi.index') }}" class="nav-link">Laporan Presensi & Gaji</a> </li>
                    <li class="nav-item"> <a href="{{ route('laporanTransaksiPenitip.index') }}" class="nav-link">Laporan Rekap Transaksi Penitip</a> </li>
                    <li class="nav-item"> <a href="{{ route('laporanPemasukandanPengeluaran.index') }}" class="nav-link">Laporan Pemasukan dan Pengeluaran Bulanan</a> </li>
                    
                    <li class="nav-item"> <a href="{{ route('laporan-penjualan-tahunanOwner') }}" class="nav-link">Laporan penjualan tahunan</a> </li>
                    <li class="nav-item"> <a href="{{ route('laporan.penggunaan_bahan_bakuOwner') }}" class="nav-link">Laporan Penggunaan Bahan Baku</a></li>

                    @endif


                </ul>
            </div>
            <div class="col-md-10 content">
                @yield('content')
            </div>
        </div>
    </div>


    <script>
        window.addEventListener('DOMContentLoaded', event => {
            // Simple-DataTables
            // https://github.com/fiduswriter/Simple-DataTables/wiki

            const datatablesSimple = document.getElementById('tableFilter');
            if (datatablesSimple) {
                new simpleDatatables.DataTable(datatablesSimple);
            }
        });
    </script>
</body>

</html>