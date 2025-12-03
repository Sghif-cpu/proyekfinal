@extends('layouts.app')
@section('title','Detail Poli')
@section('content')
<div class="container py-4">
    <div class="card shadow-sm">
        <div class="card-header"><h5>Detail Poli</h5></div>
        <div class="card-body">
            <table class="table table-striped">
                <tr><th>Nama Poli</th><td>{{ $poli->nama_poli }}</td></tr>
                <tr><th>Deskripsi</th><td>{{ $poli->deskripsi ?? '-' }}</td></tr>
            </table>

            <a href="{{ route('poli.index') }}" class="btn btn-secondary">Kembali</a>
            <a href="{{ route('poli.edit',$poli->id) }}" class="btn btn-warning">Edit</a>
        </div>
    </div>
</div>
@endsection
