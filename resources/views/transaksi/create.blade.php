@extends('layouts.app')

@section('content')
<div class="container">
    <h3>Edit Transaksi</h3>
    <a href="{{ route('transaksi.index') }}" class="btn btn-secondary btn-sm mb-3">⬅ Kembali</a>

    <form action="{{ route('transaksi.update', $transaksi->id) }}" method="POST">
        @csrf
        @method('PUT')

        <label>Pendaftaran</label>
        <select name="pendaftaran_id" class="form-control" required>
            @foreach($pendaftaran as $p)
                <option value="{{ $p->id }}" {{ $p->id == $transaksi->pendaftaran_id ? 'selected' : '' }}>
                    {{ $p->pasien->nama }}
                </option>
            @endforeach
        </select>

        <hr>

        <div id="item-container">
            @foreach($transaksi->detail as $item)
            <div class="row mb-2">
                <div class="col">
                    <input type="text" name="keterangan[]" class="form-control"
                           value="{{ $item->keterangan }}" required>
                </div>
                <div class="col">
                    <input type="number" name="harga[]" class="form-control harga"
                           value="{{ $item->harga }}" required>
                </div>
            </div>
            @endforeach
        </div>

        <button type="button" id="add" class="btn btn-info btn-sm">+ Tambah Item</button>

        <hr>

        <h4>Total: <span id="totalDisplay">Rp {{ number_format($transaksi->total, 0, ',', '.') }}</span></h4>
        <input type="hidden" name="total" id="totalInput" value="{{ $transaksi->total }}">

        <button class="btn btn-success">Perbarui</button>
    </form>
</div>

<script>
    function hitungTotal() {
        let total = 0;
        document.querySelectorAll('.harga').forEach(input => {
            total += Number(input.value);
        });

        document.getElementById('totalDisplay').innerText = formatRupiah(total);
        document.getElementById('totalInput').value = total;
    }

    function formatRupiah(angka) {
        return 'Rp ' + angka.toString().replace(/\B(?=(\d{3})+(?!\d))/g, '.');
    }

    document.getElementById('add').addEventListener('click', function () {
        document.getElementById('item-container').insertAdjacentHTML('beforeend', `
            <div class="row mb-2">
                <div class="col"><input type="text" name="keterangan[]" class="form-control" required></div>
                <div class="col"><input type="number" name="harga[]" class="form-control harga" required></div>
            </div>
        `);
        updateListener();
    });

    function updateListener() {
        document.querySelectorAll('.harga').forEach(input => {
            input.removeEventListener('input', hitungTotal);
            input.addEventListener('input', hitungTotal);
        });
    }

    updateListener();
</script>
@endsection
