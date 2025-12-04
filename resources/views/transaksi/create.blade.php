@extends('layouts.app')

@section('content')
<div class="container">
    <h3>Buat Transaksi</h3>
    <a href="{{ route('transaksi.index') }}" class="btn btn-secondary btn-sm mb-3">⬅ Kembali</a>

    <form action="{{ route('transaksi.store') }}" method="POST">
        @csrf

        <label>Pendaftaran</label>
        <select name="pendaftaran_id" class="form-control" required>
            <option value="">-- Pilih Pasien --</option>
            @foreach($pendaftaran as $p)
                <option value="{{ $p->id }}">{{ $p->pasien->nama }}</option>
            @endforeach
        </select>

        <hr>

        <div id="item-container">
            <div class="row mb-2">
                <div class="col">
                    <input type="number" name="harga[]" class="form-control harga" required placeholder="Harga">
                </div>
            </div>
        </div>

        <button type="button" id="add" class="btn btn-info btn-sm">+ Tambah Item</button>

        <hr>

        <h4>Total: <span id="totalDisplay">Rp 0</span></h4>
        <input type="hidden" name="total" id="totalInput" value="0">

        <button class="btn btn-primary">Simpan</button>
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
                <div class="col"><input type="number" name="harga[]" class="form-control harga" required></div>
            </div>
        `);
        updateListener();
    });

    function updateListener() {
        document.querySelectorAll('.harga').forEach(input => {
            input.addEventListener('input', hitungTotal);
        });
    }

    updateListener();
</script>
@endsection
