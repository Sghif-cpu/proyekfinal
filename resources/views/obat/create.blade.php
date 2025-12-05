@extends('layouts.app')

@section('content')
<div class="container">
    <h3>Tambah Data Obat</h3>

    <form action="{{ route('obat.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label>Nama Obat</label>
            <input type="text" name="nama_obat" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Bentuk</label>
            <input type="text" name="satuan" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Stok</label>
            <input type="number" name="stok" class="form-control" required value="0">
        </div>

        <div class="mb-3">
            <label>Harga</label>
            <input type="number" step="0.01" name="harga" class="form-control" required>
        </div>

        <button class="btn btn-success">Simpan</button>
        <a href="{{ route('obat.index') }}" class="btn btn-secondary">Kembali</a>
    </form>
</div>
@endsection
