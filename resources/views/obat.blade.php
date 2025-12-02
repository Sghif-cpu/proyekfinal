@extends('layouts.app')

@section('content')
<div class="container">
    <h3>Data Obat</h3>

    <a href="{{ route('obat.create') }}" class="btn btn-primary mb-3">Tambah Obat</a>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Kode Obat</th>
                <th>Nama Obat</th>
                <th>Kategori</th>
                <th>Aturan Pakai</th>
                <th>Keterangan</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($obat as $o)
            <tr>
                <td>{{ $o->kode_obat }}</td>
                <td>{{ $o->nama_obat }}</td>
                <td>{{ $o->kategori_obat }}</td>
                <td>{{ $o->aturan_pakai }}</td>
                <td>{{ $o->keterangan }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
