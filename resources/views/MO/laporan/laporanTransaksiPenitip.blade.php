@extends ('dashboard/sidebarKaryawan')

@section('content')

<style>
    table {
        border-collapse: collapse;
        width: 100%;
    }
    th, td {
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

    .content{
        background-color: white;
    }

</style>
@if(session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
@endif
<div class="row">
    <form action="{{ route('laporanTransaksiPenitip.laporan') }}" method="GET" id="formgaji">
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

@if(isset($penitipData))
<div class="card-body content" id="reportContent">
    @foreach($penitipData as $penitip)
        <div class="mt-5">
            <h1>Atma Kitchen</h1>
            <p class="alamat">Jl. Centralpark No. 10 Yogyakarta</p>
            <h2>LAPORAN TRANSAKSI PENITIP</h2>
            <p>ID Penitip: {{$penitip['id_penitip']}}</p>
            <p>Nama Penitip: {{$penitip['nama_penitip']}}</p>
            <p>Bulan: {{$bulan}}<br>Tahun: {{$tahun}}</p>
            <p>Tanggal cetak: {{ date('d F Y') }}</p>

            <table>
            <tr class="header">
                <th>Nama</th>
                <th>Qty</th>
                <th>Harga Jual</th>
                <th>Total</th>
                <th>20% Komisi</th>
                <th>Yang diterima</th>
            </tr>

            @forelse($produkdata as $data)
                @if($data['id_penitip'] == $penitip['id_penitip'])
                    <tr>
                        <td>{{$data['nama_produk']}}</td>
                        <td>{{$data['qty']}}</td>
                        <td>Rp {{number_format($data['harga_jual'], 0, ',', '.')}}</td>
                        <td>Rp {{number_format($data['total'], 0, ',', '.')}}</td>
                        <td>Rp {{number_format($data['komisi'], 0, ',', '.')}}</td>
                        <td>Rp {{number_format($data['yang_diterima'], 0, ',', '.')}}</td>
                    </tr>
                @endif
                @empty
                    <tr>
                        <td colspan="2">Tidak ada data</td>
                    </tr>
            @endforelse

            <tr class="footer">
                <td colspan="5" style="text-align: right;"><strong>Total</strong></td>
                <td><strong>Rp. {{number_format($penitip['total'], 0, ',', '.')}}</strong></td>
            </tr>
            </table>
        </div>
    @endforeach
</div>
<button id="printBtn" class="btn btn-secondary">Print</button>
@endif

<script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.9.2/html2pdf.bundle.min.js"></script>
<script>
    const submitgaji = document.getElementById('submitgaji');
    const formgaji = document.getElementById('formgaji');
    const dates = document.getElementById('dates');

    submitgaji.addEventListener('click', (event) => {
        if(dates.value == ''){
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
            filename: 'laporan-Transaksi-Penitip.pdf',
            image: { type: 'jpeg', quality: 0.98 },
            html2canvas: { scale: 2 },
            jsPDF: { unit: 'in', format: 'letter', orientation: 'portrait' }
        };

        html2pdf().from(reportContent).set(opt).save();
    });
</script>

@endsection