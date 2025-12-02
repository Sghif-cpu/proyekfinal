@extends('layouts.app')
@section('title','Detail Dokter')
@section('content')
<div class="container py-4">
    <div class="card shadow-sm">
        <div class="card-header"><h5>Detail Dokter</h5></div>
        <div class="card-body">
            <table class="table table-striped">
                <tr><th>Nama</th><td>{{ $dokter->nama }}</td></tr>
                <tr><th>Poli</th><td>{{ $dokter->poli->nama }}</td></tr>
                <tr><th>SIP</th><td>{{ $dokter->sip ?? '-' }}</td></tr>
                <tr><th>No HP</th><td>{{ $dokter->no_hp ?? '-' }}</td></tr>
            </table>

            <a href="{{ route('dokter.index') }}" class="btn btn-secondary">Kembali</a>
            <a href="{{ route('dokter.edit',$dokter->id) }}" class="btn btn-warning">Edit</a>
        </div>
    </div>
</div>
@endsection
