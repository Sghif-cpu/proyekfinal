@extends('layouts.app')

@section('content')

<h4 class="mb-3">Tambah Pemeriksaan Lab</h4>

<div class="mb-3">
    <b>Pasien :</b> {{ $rekamMedis->pendaftaran->pasien->nama }} <br>
    <b>Dokter :</b> {{ $rekamMedis->pendaftaran->dokter->nama }}
</div>

<form action="{{ route('lab.store') }}" method="POST">
@csrf
<input type="hidden" name="rekam_medis_id" value="{{ $rekamMedis->id }}">

<div class="mb-3">
    <label>Nama Pemeriksaan</label>
    <input type="text" name="jenis_pemeriksaan" class="form-control" required>
</div>

<div class="mb-3">
    <label>Hasil</label>
    <input type="text" name="hasil" class="form-control">
</div>

<button class="btn btn-success">Simpan</button>
<a href="{{ route('lab.index', $rekamMedis->id) }}" class="btn btn-secondary">Kembali</a>
</form>

@endsection
