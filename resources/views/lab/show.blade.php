@extends('layouts.app')

@section('content')

<h4 class="mb-3">Detail Pemeriksaan</h4>

<table class="table table-bordered">
<tr><th>Pasien</th><td>{{ $data->rekamMedis->pendaftaran->pasien->nama }}</td></tr>
<tr><th>Dokter</th><td>{{ $data->rekamMedis->pendaftaran->dokter->nama }}</td></tr>
<tr><th>Pemeriksaan</th><td>{{ $data->nama_pemeriksaan }}</td></tr>
<tr><th>Hasil</th><td>{{ $data->hasil }}</td></tr>
<tr><th>Satuan</th><td>{{ $data->satuan }}</td></tr>
<tr><th>Tanggal</th><td>{{ $data->created_at->format('d-m-Y H:i') }}</td></tr>
</table>

<a href="{{ route('lab.index', $data->rekam_medis_id) }}" class="btn btn-secondary">Kembali</a>

@endsection
