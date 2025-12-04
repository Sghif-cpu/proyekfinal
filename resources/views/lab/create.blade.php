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
                <input type="text"
                       name="nama_pemeriksaan"
                       class="form-control @error('nama_pemeriksaan') is-invalid @enderror"
                       value="{{ old('nama_pemeriksaan') }}"
                       maxlength="255"
                       required>
                @error('nama_pemeriksaan')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label class="fw-bold">Hasil</label>
                <input type="text"
                       name="hasil"
                       class="form-control @error('hasil') is-invalid @enderror"
                       value="{{ old('hasil') }}"
                       maxlength="1000">
                @error('hasil')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label class="fw-bold">Satuan</label>
                <input type="text"
                       name="satuan"
                       class="form-control @error('satuan') is-invalid @enderror"
                       value="{{ old('satuan') }}"
                       maxlength="50"
                       placeholder="mg/dL, %, g/dL, dll">
                @error('satuan')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <button class="btn btn-success">Simpan</button>
            <a href="{{ route('lab.index', $rekam->id) }}" class="btn btn-secondary">Batal</a>
        </form>

    </div>
</div>
@endsection
