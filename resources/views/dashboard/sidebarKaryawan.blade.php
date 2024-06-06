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
            min-height: 100vh;
        }

        .sidebar {

            height: 150vh;
            background-color: #B0A3C1;
            padding: 15px;
            color: #fff;
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
                    <li class="nav-item"> <a href="{{ route('pesanan.sudahDibayar') }}" class="nav-link">Penarikan Saldo</a> </li>

                    <li class="nav-item"> <a href="#" class="nav-link">Other Pages</a> </li>


                    @elseif(Auth::user()->role->id == '3')
                    <li class="nav-item"> <a href="{{ route('karyawan.index') }}" class="nav-link">Employee</a> </li>
                    <li class="nav-item"> <a href="{{ route('datapenitip.index') }}" class="nav-link">Penitip</a> </li>
                    <li class="nav-item"> <a href="{{ route('pengeluaranlain.index') }}" class="nav-link">Pengeluaran Lain</a> </li>
                    <li class="nav-item"> <a href="{{ route('confirmMo.index') }}" class="nav-link">Confirm Pesanan</a> </li>

                    @endif
                    <li class="nav-item"> <a href="{{ route('datapenitip.index') }}" class="nav-link">Penitip</a> </li>

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