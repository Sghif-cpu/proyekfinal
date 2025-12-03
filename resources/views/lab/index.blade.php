@extends('layouts.app')

@section('content')

@if($rekam)
    <h4 class="mb-3">Pemeriksaan Lab – {{ $rekam->pendaftaran->pasien->nama }}</h4>
@else
    <h4 class="mb-3">Pemeriksaan Lab</h4>
@endif

<div class="card">
    <div class="card-body">

        @if($rekam)
        <div class="d-flex justify-content-end mb-3">
            <a href="{{ route('lab.create', $rekam->id) }}" class="btn btn-success">
                + Tambah Pemeriksaan Lab
            </a>
        </div>
        @endif

        <table class="table table-bordered text-center">
            <thead class="table-light">
                <tr>
                    <th>No</th>
                    @if(!$rekam)
                    <th>Pasien</th>
                    @endif
                    <th>Nama Pemeriksaan</th>
                    <th>Hasil</th>
                    <th>Satuan</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($data as $row)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    @if(!$rekam)
                    <td>{{ $row->rekamMedis->pendaftaran->pasien->nama ?? '-' }}</td>
                    @endif
                    <td>{{ $row->nama_pemeriksaan }}</td>
                    <td>{{ $row->hasil }}</td>
                    <td>{{ $row->satuan }}</td>
                    <td>
                        <a href="{{ route('lab.show', $row->id) }}" class="btn btn-primary btn-sm">Lihat</a>
                        <a href="{{ route('lab.edit', $row->id) }}" class="btn btn-warning btn-sm">Edit</a>

                        <form action="{{ route('lab.destroy', $row->id) }}" 
                              method="POST"
                              style="display:inline">
                            @csrf 
                            @method('DELETE')

                            <button class="btn btn-danger btn-sm"
                                    onclick="return confirm('Hapus data?')">
                                Hapus
                            </button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="text-muted text-center">
                        Belum ada data lab.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>

    </div>
</div>
@endsection
