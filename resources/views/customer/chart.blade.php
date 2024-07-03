@extends('dashboard.navbar')

@section('content')
<div class="container">
    <h2>Chart</h2>
    <table class="table">
        <thead>
            <tr>
                <th>Nama Produk</th>
                <th>Deskripsi</th>
                <th>Harga</th>
                <th>Jumlah</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @php
                $total = 0;
            @endphp
            @foreach($chart as $item)
            <tr>
                <td>{{ $item->produk->nama }}</td>
                <td>{{ $item->produk->deskripsi }}</td>
                <td>Rp {{ number_format($item->produk->harga, 0, ',', '.') }}</td>
                <td>{{ $item->jumlah }}</td>
                <td>
                    <form action="{{ route('chart.remove', $item->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Hapus</button>
                    </form>
                </td>
            </tr>
            @php
                $subtotal = $item->produk->harga * $item->jumlah;
                $total += $subtotal;
            @endphp
            @endforeach
        </tbody>
    </table>
    <div class="text-end">
        <h4>Total Harga: Rp {{ number_format($total, 0, ',', '.') }}</h4>
        <h6>Total Point yang diPeroleh: {{$poin}}</h6>
    </div>

    <form action="{{ route('checkout') }}" method="POST">
        @csrf
        <input type="hidden" name="total_harga" value="{{ $total }}">


        <div class="mb-3">
            <label for="metode" class="form-label">Metode Pengambilan:</label>
            <select name="metode" id="metode" class="form-control" required>
                <option value="">Pilih Metode</option>
                <option value="pickup">Pickup</option>
                <option value="delivery">Delivery</option>
            </select>
        </div>

        <div class="mb-3" id="alamat-container" style="display: none;">
            <label for="alamat" class="form-label">Pilih Alamat:</label>
            <select name="alamat" id="alamat" class="form-control">
                @foreach($alamats as $alamat)
                <option value="{{ $alamat->id }}">{{ $alamat->nama }}</option>
                @endforeach
                <option value="new">Tambah Alamat Baru</option>
            </select>
        </div>

        <div class="mb-3" id="alamat-baru-container" style="display: none;">
            <label for="alamat_baru" class="form-label">Alamat Baru:</label>
            <input type="text" name="alamat_baru" id="alamat_baru" class="form-control">
        </div>

        <div class="mb-3">
            <label for="poin" class="form-label">Gunakan Poin (1 poin = Rp 100):</label>
            <input type="number" name="poin" id="poin" class="form-control" min="0" max="{{ $customer->poin }}" placeholder="Masukkan jumlah poin">
            <p>Jumlah Poin yang dimiliki: {{ $customer->poin }}</p>
        </div>
    <input type="hidden" name="date" id="date" value="{{ session('selected_date') }}">
        <button type="submit" class="btn btn-primary">Checkout</button>
    </form>
</div>

<script>
    document.getElementById('metode').addEventListener('change', function() {
        const alamatContainer = document.getElementById('alamat-container');
        const alamatBaruContainer = document.getElementById('alamat-baru-container');
        if (this.value === 'delivery') {
            alamatContainer.style.display = 'block';
        } else {
            alamatContainer.style.display = 'none';
            alamatBaruContainer.style.display = 'none';
        }
    });

    document.getElementById('alamat').addEventListener('change', function() {
        const alamatBaruContainer = document.getElementById('alamat-baru-container');
        if (this.value === 'new') {
            alamatBaruContainer.style.display = 'block';
        } else {
            alamatBaruContainer.style.display = 'none';
        }
    });
</script>
@endsection
