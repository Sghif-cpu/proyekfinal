@extends('layouts.app')
@section('title','Data Dokter')
@section('content')
<div class="container py-4">

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <a href="{{ route('dokter.create') }}" class="btn btn-primary mb-3">Tambah Dokter</a>

    <div class="card shadow-sm">
        <div class="card-body table-responsive">
            <table class="table table-bordered table-striped">
                <thead class="table-light">
                    <tr>
                        <th>#</th>
                        <th>Nama</th>
                        <th>Poli</th>
                        <th>SIP</th>
                        <th>No HP</th>
                        <th width="20%">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($data as $d)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $d->nama }}</td>
                            <td>{{ $d->poli->nama }}</td>
                            <td>{{ $d->sip ?? '-' }}</td>
                            <td>{{ $d->no_hp ?? '-' }}</td>
                            <td>
                                <a href="{{ route('dokter.show',$d->id) }}" class="btn btn-info btn-sm">Detail</a>
                                <a href="{{ route('dokter.edit',$d->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                <form action="{{ route('dokter.destroy',$d->id) }}" method="POST" class="d-inline"
                                      onsubmit="return confirm('Hapus dokter ini?')">
                                    @csrf @method('DELETE')
                                    <button class="btn btn-danger btn-sm">Hapus</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
