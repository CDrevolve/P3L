@extends ('dashboard/sidebarKaryawan')

@section('content')

<style>
    table {
        border-collapse: collapse;
        width: 100%;
    }

    th,
    td {
        padding: 10px;
        border: 1px solid black;
        text-align: left;
    }

    p {
        text-align: left;
        margin-top: -10px;
    }

    h1 {
        text-align: left;
    }

    h2 {
        font-size: 1.5em;
        margin-top: 20px;
        text-align: left;
        text-decoration: underline;
    }

    .total {
        font-weight: bold;
    }

    .header {
        background-color: #f1f1f1;
        padding: 10px;
    }

    .footer {
        text-align: right;
    }

    .content {
        background-color: white;
    }
</style>
@if(session('error'))
<div class="alert alert-danger">
    {{ session('error') }}
</div>
@endif
<div class="row">
    <form action="{{ route('laporanPemasukandanPengeluaran.laporan') }}" method="GET" id="formgaji">
        @csrf
        @method('GET')
        <div class="col-md-4">
            <label for="dates">Pilih Bulan dan Tahun</label>
            <div class="input-group form-group">
                <input type="month" name="dates" id="dates" class="form-control" placeholder="Bulan dan Tahun">
            </div>
        </div>
        <div class="col-md-4">
            <label for="submit"></label>
            <div class="input-group form-group">
                <input type="submit" class="btn btn-primary" value="Submit" id="submitgaji">
            </div>
        </div>
    </form>
</div>

@if(isset($tahun))
<div class="card-body content" id="reportContent">
    <h1>Atma Kitchen</h1>
    <p class="alamat">Jl. Centralpark No. 10 Yogyakarta</p>
    <h2>LAPORAN PEMASUKAN DAN PENGELUARAN</h2>
    <p>Bulan: {{ $bulanFormatted }}<br>Tahun: {{ $tahun }}</p>
    <p>Tanggal cetak: {{ date('d F Y') }}</p>

    <table>
        <thead>
            <tr class="header">
                <th class="center">Deskripsi</th>
                <th class="center">Pemasukan</th>
                <th class="center">Pengeluaran</th>
            </tr>
        </thead>

        <tbody>
            <tr>
                <td>Penjualan</td>
                <td>{{ number_format($pemasukan->sum('jumlah_pembayaran'), 0, ',', '.') }}</td>
                <td></td>
            </tr>
            <tr>
                <td>Tip</td>
                <td>{{ number_format($pemasukan->sum('tips'), 0, ',', '.') }}</td>
                <td></td>
            </tr>
            <tr>
                <td>Gaji Karyawan</td>
                <td></td>
                <td>{{ number_format($gaji, 0, ',', '.') }}</td>
            </tr>
            @foreach($pengeluaran as $keluar)
            <tr>
                <td>{{ $keluar->nama }}</td>
                <td></td>
                <td>{{ number_format($keluar->total, 0, ',', '.') }}</td>
            </tr>
            @endforeach
        </tbody>

        <tfoot>
            <tr class="footer">
                <td class="total">Total</td>
                <td class="total">{{ number_format($totalPemasukan, 0, ',', '.') }}</td>
                <td class="total">{{ number_format($totalPengeluaran, 0, ',', '.') }}</td>
            </tr>
        </tfoot>
    </table>
</div>
<button id="printBtn" class="btn btn-secondary">Print</button>
@endif

<script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.9.2/html2pdf.bundle.min.js"></script>
<script>
    const submitgaji = document.getElementById('submitgaji');
    const formgaji = document.getElementById('formgaji');
    const dates = document.getElementById('dates');

    submitgaji.addEventListener('click', (event) => {
        if (dates.value == '') {
            alert('Tanggal tidak boleh kosong');
            event.preventDefault();
        }
    });
</script>

<script>
    const printBtn = document.getElementById('printBtn');

    printBtn.addEventListener('click', () => {
        const reportContent = document.getElementById('reportContent');
        const opt = {
            margin: 1,
            filename: 'laporan-Pemasukan-Pengeluaran.pdf',
            image: {
                type: 'jpeg',
                quality: 0.98
            },
            html2canvas: {
                scale: 2
            },
            jsPDF: {
                unit: 'in',
                format: 'letter',
                orientation: 'portrait'
            }
        };

        html2pdf().from(reportContent).set(opt).save();
    });
</script>

@endsection