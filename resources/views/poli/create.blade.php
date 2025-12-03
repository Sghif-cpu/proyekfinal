@extends('layouts.app')
@section('title','Tambah Poli')
@section('content')
<div class="container py-4">
    <div class="card shadow-sm">
        <div class="card-header"><h5>Tambah Poli</h5></div>
        <div class="card-body">
            <form action="{{ route('poli.store') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label>Nama Poli</label>
                    <input type="text" name="nama_poli" class="form-control" value="{{ old('nama_poli') }}">
                </div>

                <div class="mb-3">
                    <label>Deskripsi</label>
                    <textarea name="deskripsi" class="form-control">{{ old('deskripsi') }}</textarea>
                </div>

                <a href="{{ route('poli.index') }}" class="btn btn-secondary">Kembali</a>
                <button class="btn btn-primary">Simpan</button>
            </form>
        </div>
    </div>
</div>
@endsection
