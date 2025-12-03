@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Detail Penjamin</h2>

    <div class="card">
        <div class="card-body">
            <p><strong>Nama Penjamin:</strong> {{ $penjamin->nama_penjamin }}</p>
            <p><strong>Tipe:</strong> {{ $penjamin->tipe }}</p>
            <p><strong>Keterangan:</strong> {{ $penjamin->keterangan }}</p>

            <a href="{{ route('penjamin.index') }}" class="btn btn-secondary">Kembali</a>
        </div>
    </div>
</div>
@endsection
