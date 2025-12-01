@extends('layouts.app')

@section('content')
<h4 class="mb-3">Detail Rekam Medis</h4>

<div class="card mb-3">
    <div class="card-body">

        <h5 class="fw-bold mb-3">Informasi Pasien</h5>

        <p><b>Nama:</b> {{ $data->pendaftaran->pasien->nama }}</p>
        <p><b>No RM:</b> {{ $data->pendaftaran->pasien->no_rm }}</p>
        <p><b>Dokter:</b> {{ $data->pendaftaran->dokter->nama_dokter }}</p>
        <p><b>Tanggal Pemeriksaan:</b> {{ $data->created_at->format('d-m-Y') }}</p>

    </div>
</div>

<div class="card mb-3">
    <div class="card-body">

        <h5 class="fw-bold mb-3">Diagnosa</h5>
        <p>{{ $data->diagnosa ?? '-' }}</p>

        <h5 class="fw-bold mt-4">Tindakan</h5>
        <p>{{ $data->tindakan ?? '-' }}</p>

        <h5 class="fw-bold mt-4">Catatan Tambahan</h5>
        <p>{{ $data->catatan ?? '-' }}</p>

    </div>
</div>

{{-- ===========================
      TOMBOL TAMBAHAN
=========================== --}}
<div class="mb-3">
    <a href="{{ route('lab.index', $data->id) }}" class="btn btn-info">
        Pemeriksaan Lab
    </a>

    <a href="{{ route('rekam_medis.edit', $data->id) }}" class="btn btn-warning">
        Edit Pemeriksaan
    </a>

    <a href="{{ route('rekam_medis.index') }}" class="btn btn-secondary">
        Kembali
    </a>
</div>

@endsection
