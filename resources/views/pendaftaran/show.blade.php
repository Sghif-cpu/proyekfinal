@extends('layouts.app')

@section('content')

<h4 class="mb-4">Detail Pendaftaran</h4>

<div class="card">
    <div class="card-body">

        <table class="table table-bordered">
            <tr>
                <th width="200">No Antrian</th>
                <td>{{ $pendaftaran->no_antrian }}</td>
            </tr>
            <tr>
                <th>Pasien</th>
                <td>{{ $pendaftaran->pasien->nama }}</td>
            </tr>
            <tr>
                <th>Dokter</th>
                <td>{{ $pendaftaran->dokter->nama }}</td>
            </tr>
            <tr>
                <th>Penjamin</th>
                <td>{{ $pendaftaran->penjamin->nama_penjamin }}</td>
            </tr>
            <tr>
                <th>Tanggal</th>
                <td>{{ $pendaftaran->tanggal_daftar->format('d-m-Y') }}</td>
            </tr>
        </table>

        <a href="{{ route('pendaftaran.cetak',$pendaftaran->id) }}" target="_blank" class="btn btn-warning">
            <i class="fa fa-print"></i> Cetak Antrian
        </a>

        <a href="{{ route('pendaftaran.index') }}" class="btn btn-secondary">
            Kembali
        </a>

    </div>
</div>

@endsection
