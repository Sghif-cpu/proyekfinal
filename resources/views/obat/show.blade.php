@extends('layouts.app')

@section('content')
<div class="container">
    <h3>Detail Data Obat</h3>

    <div class="card mt-3">
        <div class="card-body">

            <div class="mb-3">
                <strong>Nama Obat:</strong>
                <p>{{ $obat->nama_obat }}</p>
            </div>

            <div class="mb-3">
                <strong>Bentuk:</strong>
                <p>{{ $obat->satuan }}</p>
            </div>

            <div class="mb-3">
                <strong>Stok:</strong>
                <p>{{ $obat->stok }}</p>
            </div>

            <div class="mb-3">
                <strong>Harga:</strong>
                <p>Rp {{ number_format($obat->harga, 0, ',', '.') }}</p>
            </div>

            <a href="{{ route('obat.index') }}" class="btn btn-secondary">Kembali</a>
            <a href="{{ route('obat.edit', $obat->id) }}" class="btn btn-warning">Edit</a>

        </div>
    </div>
</div>
@endsection
