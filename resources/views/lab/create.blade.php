@extends('layouts.app')

@section('content')
<h4 class="mb-3">Tambah Pemeriksaan Lab</h4>

<div class="card">
    <div class="card-body">

        <form action="{{ route('lab.store') }}" method="POST">
            @csrf

            <input type="hidden" name="rekam_medis_id" value="{{ $rekam->id }}">

            <div class="mb-3">
                <label class="fw-bold">Nama Pemeriksaan</label>
                <input type="text" name="nama_pemeriksaan" class="form-control" required>
            </div>

            <div class="mb-3">
                <label class="fw-bold">Hasil</label>
                <input type="text" name="hasil" class="form-control">
            </div>

            <div class="mb-3">
                <label class="fw-bold">Satuan</label>
                <input type="text" name="satuan" class="form-control" placeholder="mg/dL, %, g/dL, dll">
            </div>

            <button class="btn btn-success">Simpan</button>
            <a href="{{ route('lab.index', $rekam->id) }}" class="btn btn-secondary">Batal</a>
        </form>

    </div>
</div>
@endsection
