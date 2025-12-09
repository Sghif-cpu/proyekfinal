@extends('layouts.app')

@section('content')
<div class="container">
    <h3>Edit Data Obat</h3>

    <form action="{{ route('obat.update', $obat->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="nama_obat" class="form-label">Nama Obat</label>
            <input type="text" id="nama_obat" name="nama_obat" class="form-control" 
                   value="{{ $obat->nama_obat }}" required>
        </div>

        <div class="mb-3">
            <label for="satuan" class="form-label">Satuan</label>
            <input type="text" id="satuan" name="satuan" class="form-control" 
                   value="{{ $obat->satuan }}" required>
        </div>

        <div class="mb-3">
            <label for="stok" class="form-label">Stok</label>
            <input type="number" id="stok" name="stok" class="form-control" 
                   value="{{ $obat->stok }}" required>
        </div>

        <div class="mb-3">
            <label for="harga" class="form-label">Harga</label>
            <input type="number" step="0.01" id="harga" name="harga" class="form-control" 
                   value="{{ $obat->harga }}" required>
        </div>

        <button class="btn btn-primary">Update</button>
        <a href="{{ route('obat.index') }}" class="btn btn-secondary">Kembali</a>
    </form>
</div>
@endsection
