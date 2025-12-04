@extends('layouts.app')

@section('content')
<div class="container">
    <h3>Edit Transaksi</h3>
    <a href="{{ route('transaksi.index') }}" class="btn btn-secondary btn-sm mb-3">⬅ Kembali</a>

    <form action="{{ route('transaksi.update', $transaksi->id) }}" method="POST">
        @csrf
        @method('PUT')

        <label>Pendaftaran</label>
        <select name="pendaftaran_id" class="form-control mb-3" required>
            @foreach($pendaftaran as $p)
                <option value="{{ $p->id }}" {{ $p->id == $transaksi->pendaftaran_id ? 'selected' : '' }}>
                    {{ $p->pasien->nama }}
                </option>
            @endforeach
        </select>

        <hr>

        <div id="item-container">
            @foreach($transaksi->detail as $item)
            <div class="row mb-2 item-row">
                <div class="col">
                    <input type="number" name="harga[]" class="form-control harga" value="{{ $item->harga }}" required>
                </div>
                <div class="col-1">
                    <button type="button" class="btn btn-danger btn-sm remove">X</button>
                </div>
            </div>
            @endforeach
        </div>

        <button type="button" id="add" class="btn btn-info btn-sm mt-2">+ Tambah Item</button>

        <hr>

        <h4>Total:
            <span id="totalDisplay">Rp {{ number_format($transaksi->total,0,',','.') }}</span>
        </h4>
        <input type="hidden" name="total" id="totalInput" value="{{ $transaksi->total }}">

        <button class="btn btn-success mt-3">Perbarui</button>
    </form>
</div>

<script>
    function formatRupiah(angka) {
        return 'Rp ' + angka.toString().replace(/\B(?=(\d{3})+(?!\d))/g, '.');
    }

    function hitungTotal() {
        let total = 0;
        document.querySelectorAll('.harga').forEach(input => {
            total += Number(input.value);
        });

        document.getElementById('totalDisplay').innerText = formatRupiah(total);
        document.getElementById('totalInput').value = total;
    }

    document.getElementById('add').addEventListener('click', function () {
        const html = `
            <div class="row mb-2 item-row">
                <div class="col"><input type="number" name="harga[]" class="form-control harga" required></div>
                <div class="col-1"><button type="button" class="btn btn-danger btn-sm remove">X</button></div>
            </div>
        `;
        document.getElementById('item-container').insertAdjacentHTML('beforeend', html);
        updateListener();
    });

    function addRemoveListener() {
        document.querySelectorAll('.remove').forEach(btn => {
            btn.addEventListener('click', function () {
                this.closest('.item-row').remove();
                hitungTotal();
            });
        });
    }

    function updateListener() {
        document.querySelectorAll('.harga').forEach(input => {
            input.addEventListener('input', hitungTotal);
        });
        addRemoveListener();
    }

    updateListener();
</script>
@endsection
