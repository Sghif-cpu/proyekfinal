@extends('layouts.app')

@section('content')
<h4 class="mb-3">Data Rekam Medis / Pemeriksaan</h4>

<div class="card">
    <div class="card-body table-responsive">

        <div class="d-flex justify-content-end mb-3">
            <a href="{{ route('rekam-medis.create') }}" class="btn btn-success">
                + Pemeriksaan Baru
            </a>
        </div>

        <table class="table table-bordered table-hover text-center align-middle">
            <thead class="table-light">
                <tr>
                    <th>No</th>
                    <th>Nama Pasien</th>
                    <th>Dokter</th>
                    <th>No RM</th>
                    <th>Tanggal</th>
                    <th>Diagnosa</th>
                    <th>Aksi</th>
                </tr>
            </thead>

            <tbody>
                @forelse($data as $row)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $row->pendaftaran->pasien->nama }}</td>
                    <td>{{ $row->pendaftaran->dokter->nama }}</td>
                    <td>{{ $row->pendaftaran->no_rm }}</td>
                    <td>{{ $row->created_at->format('d-m-Y') }}</td>
                    <td>{{ $row->diagnosa }}</td>
                    <td>
                        <a href="{{ route('rekam-medis.show', $row->id) }}" 
                           class="btn btn-info btn-sm">Detail</a>
                        <a href="{{ route('rekam-medis.edit', $row->id) }}" 
                           class="btn btn-warning btn-sm">Edit</a>
                        <form action="{{ route('rekam-medis.destroy', $row->id) }}" 
                              method="POST" style="display:inline">
                            @csrf
                            @method('DELETE')
                            <button onclick="return confirm('Hapus data?')" 
                                    class="btn btn-danger btn-sm">
                                    Hapus
                            </button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="7" class="text-muted text-center">
                        Belum ada rekam medis.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
