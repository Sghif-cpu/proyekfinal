@extends('layouts.app')

@section('content')
<div class="container">
    <h3>Form Kasir</h3>

    <form action="{{ route('transaksi.store') }}" method="POST">
        @csrf
        
        <label>Pilih Pendaftaran</label>
        <select name="pendaftaran_id" class="form-control" required>
            @foreach($pendaftaran as $p)
                <option value="{{ $p->id }}">{{ $p->nama_pasien }}</option>
            @endforeach
        </select>

        <hr>

        <div id="item-container">
            <div class="row mb-2">
                <div class="col"><input type="text" name="keterangan[]" class="form-control" placeholder="Keterangan"></div>
                <div class="col"><input type="number" name="harga[]" class="form-control harga" placeholder="Harga"></div>
            </div>
        </div>

        <button type="button" id="add" class="btn btn-info btn-sm">+ Tambah Item</button>

        <hr>
        <button class="btn btn-primary">Simpan Transaksi</button>
    </form>

</div>

<script>
document.getElementById('add').addEventListener('click', function() {
    document.getElementById('item-container').insertAdjacentHTML('beforeend', `
        <div class="row mb-2">
            <div class="col"><input type="text" name="keterangan[]" class="form-control"></div>
            <div class="col"><input type="number" name="harga[]" class="form-control harga"></div>
        </div>
    `);
});
</script>
@endsection
