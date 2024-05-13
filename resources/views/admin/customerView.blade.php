<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css'>
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
    <!-- //PENTING BANGET INI// -->
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/simple-datatables" type="text/javascript"></script>
    <script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.3.0/dist/umd/simple-datatables.min.js" crossorigin="anonymous"></script>

    <!-- sangat penting -->
    <link href="{{ asset('css/styles.css') }}" rel="stylesheet" />

    <title>Costumer View</title>
</head>

<body>
    <div>
        <a href="{{route('actionLogout')}}">logout</a>
    </div>
    <table id="tableFilter" border="1px solid black">
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
    </table>

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