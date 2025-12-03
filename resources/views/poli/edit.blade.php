@extends('layouts.app')
@section('title','Edit Poli')
@section('content')
<div class="container py-4">
    <div class="card shadow-sm">
        <div class="card-header"><h5>Edit Poli</h5></div>
        <div class="card-body">
            <form action="{{ route('poli.update',$poli->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label>Nama Poli</label>
                    <input type="text" name="nama_poli" class="form-control" value="{{ old('nama_poli',$poli->nama_poli) }}">
                </div>

                <div class="mb-3">
                    <label>Deskripsi</label>
                    <textarea name="deskripsi" class="form-control">{{ old('deskripsi',$poli->deskripsi) }}</textarea>
                </div>

                <a href="{{ route('poli.index') }}" class="btn btn-secondary">Kembali</a>
                <button class="btn btn-primary">Update</button>
            </form>
        </div>
    </div>
</div>
@endsection
