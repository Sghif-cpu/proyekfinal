@extends('layouts.app')

@section('content')

<div class="d-flex justify-content-between align-items-center mb-3">
    <h4>Data Pasien</h4>
    <a href="{{ route('pasien.create') }}" class="btn btn-primary">
        <i class="fas fa-plus"></i> Tambah Pasien
    </a>
</div>

@if(session('success'))
<div class="alert alert-success">
    {{ session('success') }}
</div>
@endif

<div class="card">
    <div class="table-responsive">
        <table class="table table-bordered table-hover mb-0">
            <thead class="table-dark">
                <tr>
                    <th>No RM</th>
                    <th>Nama</th>
                    <th>L/P</th>
                    <th>Tgl Lahir</th>
                    <th>No HP</th>
                    <th>Penjamin</th>
                    <th width="150">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($pasien as $p)
                <tr>
                    <td>{{ $p->no_rm }}</td>
                    <td>{{ $p->nama }}</td>
                    <td>{{ $p->jenis_kelamin }}</td>
                    <td>{{ $p->tanggal_lahir }}</td>
                    <td>{{ $p->no_hp }}</td>
                    <td>{{ $p->penjamin->nama_penjamin ?? '-' }}</td>
                    <td>
                        <a href="{{ route('pasien.show',$p->id) }}" class="btn btn-sm btn-info">Lihat</a>
                        <a href="{{ route('pasien.edit',$p->id) }}" class="btn btn-sm btn-warning">Edit</a>

                        <form action="{{ route('pasien.destroy',$p->id) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button onclick="return confirm('Hapus data ini?')" class="btn btn-sm btn-danger">
                                Hapus
                            </button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="7" class="text-center">Belum ada data pasien</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<div class="mt-3">
    {{ $pasien->links() }}
</div>

@endsection
