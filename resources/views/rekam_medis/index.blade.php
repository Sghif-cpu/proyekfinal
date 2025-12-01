@extends('layouts.app')

@section('content')
<h4 class="mb-3">Data Rekam Medis</h4>

<div class="card">
    <div class="card-body table-responsive">

        <table class="table table-bordered table-hover text-center align-middle">
            <thead class="table-light">
                <tr>
                    <th>No</th>
                    <th>Pasien</th>
                    <th>Dokter</th>
                    <th>Tanggal</th>
                    <th>Diagnosa</th>
                    <th>Aksi</th>
                </tr>
            </thead>

            <tbody>
                @foreach($data as $row)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $row->pendaftaran->pasien->nama ?? '-' }}</td>
                    <td>{{ $row->pendaftaran->dokter->nama_dokter ?? '-' }}</td>
                    <td>{{ $row->created_at->format('d-m-Y') }}</td>
                    <td>{{ \Illuminate\Support\Str::limit($row->diagnosa, 30) }}</td>
                    <td>
                        <a href="{{ route('rekam_medis.show', $row->id) }}" class="btn btn-info btn-sm">Detail</a>
                        <a href="{{ route('rekam_medis.edit', $row->id) }}" class="btn btn-warning btn-sm">Edit</a>
                    </td>
                </tr>
                @endforeach

                @if($data->count() == 0)
                <tr>
                    <td colspan="6" class="text-center">Belum ada rekam medis.</td>
                </tr>
                @endif
            </tbody>
        </table>

    </div>
</div>
@endsection
