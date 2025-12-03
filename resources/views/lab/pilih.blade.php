@extends('layouts.app')

@section('content')
<div class="container">
    <h4 class="mb-4">Pemeriksaan LAB</h4>

    <div class="alert alert-info">
        Silakan buka dari menu <b>Rekam Medis</b> dan klik tombol <b>LAB</b> pada data pasien.
    </div>

    <a href="{{ route('rekam-medis.index') }}" class="btn btn-primary">
        Pilih Rekam Medis
    </a>
</div>
@endsection
