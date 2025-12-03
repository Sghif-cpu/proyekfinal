@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Data Penjamin</h2>

    <a href="{{ route('penjamin.create') }}" class="btn btn-primary mb-3">Tambah Penjamin</a>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Penjamin</th>
                <th>Tipe</th>
                <th>Keterangan</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($penjamin as $p)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $p->nama_penjamin }}</td>
                    <td>{{ $p->tipe }}</td>
                    <td>{{ $p->keterangan }}</td>
                    <td>
                        <a href="{{ route('penjamin.show', $p->id) }}" class="btn btn-info btn-sm">Detail</a>
                        <a href="{{ route('penjamin.edit', $p->id) }}" class="btn btn-warning btn-sm">Edit</a>

                        <form action="{{ route('penjamin.destroy', $p->id) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')

                            <button onclick="return confirm('Yakin hapus?')" class="btn btn-danger btn-sm">
                                Hapus
                            </button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
