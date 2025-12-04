@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Edit Penjamin</h2>

    <form action="{{ route('penjamin.update', $penjamin->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label>Nama Penjamin</label>
            <input type="text" name="nama_penjamin" class="form-control" value="{{ $penjamin->nama_penjamin }}" required>
        </div>

        <div class="mb-3">
            <label>Tipe</label>
            <input type="text" name="tipe" class="form-control" value="{{ $penjamin->tipe }}" required>
        </div>

        <div class="mb-3">
            <label>Keterangan</label>
            <textarea name="keterangan" class="form-control">{{ $penjamin->keterangan }}</textarea>
        </div>

        <button class="btn btn-primary">Update</button>
        <a href="{{ route('penjamin.index') }}" class="btn btn-secondary">Kembali</a>
    </form>
</div>
@endsection
