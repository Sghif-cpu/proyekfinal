@extends('layouts.app')
@section('title','Data Poli')
@section('content')
<div class="container py-4">

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <a href="{{ route('poli.create') }}" class="btn btn-primary mb-3">Tambah Poli</a>

    <div class="card shadow-sm">
        <div class="card-body table-responsive">
            <table class="table table-bordered table-striped">
                <thead class="table-light">
                    <tr>
                        <th>#</th>
                        <th>Nama Poli</th>
                        <th>Deskripsi</th>
                        <th width="20%">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($data as $d)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $d->nama_poli }}</td>
                            <td>{{ $d->deskripsi ?? '-' }}</td>
                            <td>
                                <a href="{{ route('poli.show',$d->id) }}" class="btn btn-info btn-sm">Detail</a>
                                <a href="{{ route('poli.edit',$d->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                <form action="{{ route('poli.destroy',$d->id) }}" method="POST" class="d-inline"
                                      onsubmit="return confirm('Hapus poli ini?')">
                                    @csrf
                                    @method('DELETE')
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
