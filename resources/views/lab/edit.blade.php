@extends('layouts.app')

@section('content')
<h4 class="mb-3">Edit Pemeriksaan Lab</h4>

<div class="card">
    <div class="card-body">

        <form action="{{ route('lab.update', $data->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label class="fw-bold">Nama Pemeriksaan</label>
                <input type="text" name="nama_pemeriksaan"
                       class="form-control"
                       value="{{ $data->nama_pemeriksaan }}" required>
            </div>

            <div class="mb-3">
                <label class="fw-bold">Hasil</label>
                <input type="text" name="hasil"
                       class="form-control"
                       value="{{ $data->hasil }}">
            </div>

            <div class="mb-3">
                <label class="fw-bold">Satuan</label>
                <input type="text" name="satuan"
                       class="form-control"
                       value="{{ $data->satuan }}">
            </div>

            <button class="btn btn-success">Update</button>
            <a href="{{ route('lab.index', $rekam->id) }}" class="btn btn-secondary">Batal</a>

        </form>

    </div>
</div>
@endsection
