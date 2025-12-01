@extends('layouts.app')

@section('content')
<h4 class="mb-3">Edit Pemeriksaan</h4>

<div class="card">
<div class="card-body">

    <div class="mb-3">
        <label class="fw-bold">Data Pasien</label>
        <div class="p-3 bg-light rounded border">
            <p class="mb-1"><b>Nama:</b> {{ $data->pendaftaran->pasien->nama }}</p>
            <p class="mb-1"><b>Dokter:</b> {{ $data->pendaftaran->dokter->nama_dokter }}</p>
            <p class="mb-0"><b>No RM:</b> {{ $data->pendaftaran->pasien->no_rm }}</p>
        </div>
    </div>

    <form action="{{ route('rekam-medis.update', $data->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label>Diagnosa</label>
            <textarea name="diagnosa" class="form-control" rows="3">{{ $data->diagnosa }}</textarea>
        </div>

        <div class="mb-3">
            <label>Tindakan</label>
            <textarea name="tindakan" class="form-control" rows="3">{{ $data->tindakan }}</textarea>
        </div>

        <div class="mb-3">
            <label>Catatan Tambahan</label>
            <textarea name="catatan" class="form-control" rows="3">{{ $data->catatan }}</textarea>
        </div>

        <button class="btn btn-success">
            <i class="fas fa-save"></i> Update Pemeriksaan
        </button>

        <a href="{{ route('rekam-medis.show', $data->id) }}" class="btn btn-secondary">Kembali</a>

    </form>

</div>
</div>
@endsection
