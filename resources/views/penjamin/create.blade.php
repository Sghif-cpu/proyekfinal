@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Tambah Penjamin</h2>

    <form action="{{ route('penjamin.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label>Nama Penjamin</label>
            <input type="text" name="nama_penjamin" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Tipe</label>
            <input type="text" name="tipe" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Keterangan</label>
            <textarea name="keterangan" class="form-control"></textarea>
        </div>

        <button class="btn btn-primary">Simpan</button>
        <a href="{{ route('penjamin.index') }}" class="btn btn-secondary">Kembali</a>
    </form>
</div>
@endsection
