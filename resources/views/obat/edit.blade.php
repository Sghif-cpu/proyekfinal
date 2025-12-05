@extends('layouts.app')

@section('content')
<div class="container">
    <h3>Edit Data Obat</h3>

    <form action="{{ route('obat.update', $obat->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label>Nama Obat</label>
            <input type="text" name="nama_obat" class="form-control" value="{{ $obat->nama_obat }}" required>
        </div>

        <div class="mb-3">
            <label>Bentuk</label>
            <input type="text" name="satuan" class="form-control" value="{{ $obat->satuan }}" required>
        </div>

        <div class="mb-3">
            <label>Stok</label>
            <input type="number" name="stok" class="form-control" value="{{ $obat->stok }}" required>
        </div>

        <div class="mb-3">
            <label>Harga</label>
            <input type="number" step="0.01" name="harga" class="form-control" value="{{ $obat->harga }}" required>
        </div>

        <button class="btn btn-primary">Update</button>
        <a href="{{ route('obat.index') }}" class="btn btn-secondary">Kembali</a>
    </form>
</div>
@endsection
