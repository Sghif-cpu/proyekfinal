@extends('layouts.app')

@section('content')
<div class="container">

    <h3 class="mb-3">Edit Pemeriksaan Lab</h3>

    <div class="card mb-3">
        <div class="card-body">
            <b>Nama Pasien :</b> {{ $rekam->pendaftaran->pasien->nama }} <br>
            <b>Dokter :</b> {{ $rekam->pendaftaran->dokter->nama }} <br>
            <b>ID Rekam Medis :</b> {{ $rekam->id }}
        </div>
    </div>

    <form method="POST" action="{{ route('lab.update', $data->id) }}">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label>Nama Pemeriksaan</label>
            <input type="text" name="nama_pemeriksaan"
                   class="form-control"
                   value="{{ $data->nama_pemeriksaan }}"
                   required>
        </div>

        <div class="mb-3">
            <label>Hasil</label>
            <input type="text" name="hasil"
                   class="form-control"
                   value="{{ $data->hasil }}">
        </div>

        <div class="mb-3">
            <label>Satuan</label>
            <input type="text" name="satuan"
                   class="form-control"
                   value="{{ $data->satuan }}">
        </div>

        <button class="btn btn-primary">Update</button>

        <a href="{{ route('lab.index', $rekam->id) }}"
           class="btn btn-secondary">
           Kembali
        </a>
    </form>
</div>
@endsection
