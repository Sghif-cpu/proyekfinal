@extends('layouts.app')

@section('content')

<h4 class="mb-3">Detail Pasien</h4>

<div class="card">
<div class="card-body">

<table class="table table-bordered">
    <tr>
        <th>No RM</th>
        <td>{{ $pasien->no_rm }}</td>
    </tr>
    <tr>
        <th>Nama</th>
        <td>{{ $pasien->nama }}</td>
    </tr>
    <tr>
        <th>Tanggal Lahir</th>
        <td>{{ $pasien->tanggal_lahir }}</td>
    </tr>
    <tr>
        <th>Jenis Kelamin</th>
        <td>{{ $pasien->jenis_kelamin }}</td>
    </tr>
    <tr>
        <th>No HP</th>
        <td>{{ $pasien->no_hp }}</td>
    </tr>
    <tr>
        <th>Alamat</th>
        <td>{{ $pasien->alamat }}</td>
    </tr>
    <tr>
        <th>Penjamin</th>
        <td>{{ $pasien->penjamin->nama_penjamin ?? '-' }}</td>
    </tr>
</table>

<a href="{{ route('pasien.index') }}" class="btn btn-secondary mt-2">Kembali</a>

</div>
</div>

@endsection
