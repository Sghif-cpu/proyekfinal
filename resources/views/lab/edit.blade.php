@extends('layouts.app')

@section('content')

<h4 class="mb-3">Edit Pemeriksaan Lab</h4>

<div class="mb-3">
    <b>Pasien :</b> {{ $lab->rekamMedis->pendaftaran->pasien->nama }} <br>
    <b>Dokter :</b> {{ $lab->rekamMedis->pendaftaran->dokter->nama }}
</div>

<form action="{{ route('lab.update', $lab->id) }}" method="POST">
@csrf
@method('PUT')

<div class="mb-3">
    <label>Nama Pemeriksaan</label>
    <input type="text" name="jenis_pemeriksaan" 
           class="form-control" value="{{ $lab->jenis_pemeriksaan }}" required>
</div>

<div class="mb-3">
    <label>Hasil</label>
    <input type="text" name="hasil" 
           class="form-control" value="{{ $lab->hasil }}">
</div>

<button class="btn btn-success">Update</button>
<a href="{{ route('lab.index', $lab->rekam_medis_id) }}" class="btn btn-secondary">Kembali</a>

</form>
@endsection
