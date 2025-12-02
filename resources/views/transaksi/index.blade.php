@extends('layouts.app')

@section('content')
<div class="container">
    <h3>Form Kasir</h3>

    <form action="{{ route('transaksi.store') }}" method="POST">
        @csrf
        
        <label>Pilih Pendaftaran</label>
        <select name="pendaftaran_id" class="form-control" required>
            @foreach($pendaftaran as $p)
                <option value="{{ $p->id }}">{{ $p->pasien->nama ?? 'Tidak ada nama' }}</option>
            @endforeach
        </select>

        <hr>

        <div id="item-container">
            <div class="row mb-2">
                <div class="col">
                    <input type="text" name="keterangan[]" class="form-control" placeholder="Keterangan">
                </div>
                <div class="col">
                    <input type="number" name="harga[]" class="form-control harga" placeholder="Harga">
                </div>
            </div>
        </div>

        <button type="button" id="add" class="btn btn-info btn-sm">+ Tambah Item</button>

        <hr>

        <h4>Total: <span id="totalDisplay">Rp 0</span></h4>
        <input type="hidden" name="total" id="totalInput">

        <button class="btn btn-primary">Simpan Transaksi</button>
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

    document.getElementById('add').addEventListener('click', function() {
        document.getElementById('item-container').insertAdjacentHTML('beforeend', `
            <div class="row mb-2">
                <div class="col"><input type="text" name="keterangan[]" class="form-control"></div>
                <div class="col"><input type="number" name="harga[]" class="form-control harga"></div>
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
