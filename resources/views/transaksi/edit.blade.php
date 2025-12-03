@extends('layouts.app')

@section('content')
<div class="container">
    <h3>Edit Transaksi</h3>

    <form action="{{ route('transaksi.update', $transaksi->id) }}" method="POST">
        @csrf
        @method('PUT')

        <label>Pendaftaran</label>
        <input type="text" class="form-control" value="{{ $transaksi->pendaftaran->pasien->nama }}" disabled>

        <hr>

        <div id="item-container">
            @foreach($transaksi->detail as $item)
            <div class="row mb-2">
                <div class="col">
                    <input type="text" name="keterangan[]" class="form-control"
                           value="{{ $item->keterangan }}" required>
                </div>
                <div class="col">
                    <input type="number" name="harga[]" class="form-control"
                           value="{{ $item->harga }}" required>
                </div>
            </div>
            @endforeach
        </div>

        <button type="button" id="add" class="btn btn-info btn-sm">+ Tambah Item</button>

        <hr>
        <button class="btn btn-success">Perbarui</button>
    </form>
</div>

<script>
document.getElementById('add').addEventListener('click', function () {
    document.getElementById('item-container').insertAdjacentHTML('beforeend', `
        <div class="row mb-2">
            <div class="col">
                <input type="text" name="keterangan[]" class="form-control" placeholder="Keterangan">
            </div>
            <div class="col">
                <input type="number" name="harga[]" class="form-control" placeholder="Harga">
            </div>
        </div>
    `);
});
</script>
@endsection
