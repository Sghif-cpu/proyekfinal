@extends('layouts.app')

@section('title', 'Detail Rekam Medis')

@section('content')
<div class="container-fluid">
    <div class="row">
        <!-- REKAM MEDIS DETAIL CARD -->

        <div class="col-md-9">
            <div class="card">

                <div class="card-header bg-info text-white">
                    <div class="d-flex justify-content-between align-items-center">
                        <h3 class="card-title mb-0">
                            <i class="fas fa-file-medical mr-2"></i> Detail Rekam Medis
                        </h3>

                        <div>
                            <a href="{{ route('rekam-medis.edit', $data->id) }}" class="btn btn-warning btn-sm">
                                <i class="fas fa-edit mr-1"></i> Edit
                            </a>

                            <a href="{{ route('rekam-medis.print', $data->id) }}" 
                               class="btn btn-success btn-sm" target="_blank">
                                <i class="fas fa-print mr-1"></i> PDF
                            </a>

                            <a href="{{ route('rekam-medis.index') }}" class="btn btn-secondary btn-sm">
                                <i class="fas fa-arrow-left mr-1"></i> Kembali
                            </a>
                        </div>
                    </div>
                </div>

                <div class="card-body">

                    <div class="row">
                        <!-- Informasi Pasien -->
                        <div class="col-md-6">
                            <div class="card mb-3">
                                <div class="card-header bg-light">
                                    <h5 class="mb-0">
                                        <i class="fas fa-user-injured mr-2"></i> Informasi Pasien
                                    </h5>
                                </div>
                                <div class="card-body">
                                    <table class="table table-borderless">
                                        <tr>
                                            <th width="30%">Nama Pasien</th>
                                            <td>{{ $data->pendaftaran->pasien->nama ?? '-' }}</td>
                                        </tr>
                                        <tr>
                                            <th>Alamat</th>
                                            <td>{{ $data->pendaftaran->pasien->alamat ?? '-' }}</td>
                                        </tr>
                                        <tr>
                                            <th>No. KTP</th>
                                            <td>{{ $data->pendaftaran->pasien->no_ktp ?? '-' }}</td>
                                        </tr>
                                        <tr>
                                            <th>No. HP</th>
                                            <td>{{ $data->pendaftaran->pasien->no_hp ?? '-' }}</td>
                                        </tr>
                                        <tr>
                                            <th>Tanggal Lahir</th>
                                            <td>
                                                @if($data->pendaftaran->pasien->tanggal_lahir)
                                                    {{ \Carbon\Carbon::parse($data->pendaftaran->pasien->tanggal_lahir)->format('d/m/Y') }}
                                                    ({{ \Carbon\Carbon::parse($data->pendaftaran->pasien->tanggal_lahir)->age }} tahun)
                                                @else
                                                    -
                                                @endif
                                            </td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        </div>

                        <!-- Informasi Dokter -->
                        <div class="col-md-6">
                            <div class="card mb-3">
                                <div class="card-header bg-light">
                                    <h5 class="mb-0">
                                        <i class="fas fa-user-md mr-2"></i> Informasi Dokter
                                    </h5>
                                </div>
                                <div class="card-body">
                                    <table class="table table-borderless">
                                        <tr>
                                            <th width="30%">Nama Dokter</th>
                                            <td>{{ $data->pendaftaran->dokter->nama ?? $data->pendaftaran->dokter->nama_dokter }}</td>
                                        </tr>
                                        <tr>
                                            <th>Poli</th>
                                            <td>{{ $data->pendaftaran->dokter->poli->nama ?? '-' }}</td>
                                        </tr>
                                        <tr>
                                            <th>SIP</th>
                                            <td>{{ $data->pendaftaran->dokter->sip ?? '-' }}</td>
                                        </tr>
                                        <tr>
                                            <th>No. HP</th>
                                            <td>{{ $data->pendaftaran->dokter->no_hp ?? '-' }}</td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Data Pemeriksaan -->
                    <div class="card">
                        <div class="card-header bg-light">
                            <h5 class="mb-0">
                                <i class="fas fa-stethoscope mr-2"></i> Data Pemeriksaan
                            </h5>
                        </div>
                        <div class="card-body">

                            <div class="row mb-3">
                                <div class="col-md-4">
                                    <strong>Tanggal Periksa:</strong><br>
                                    {{ $data->created_at->format('d/m/Y') }}
                                </div>
                                <div class="col-md-4">
                                    <strong>Waktu:</strong><br>
                                    {{ $data->created_at->format('H:i') }}
                                </div>
                                <div class="col-md-4">
                                    <strong>Status Pendaftaran:</strong><br>
                                    <span class="badge badge-success">
                                        {{ $data->pendaftaran->status ?? 'Selesai' }}
                                    </span>
                                </div>
                            </div>

                            <div class="form-group">
                                <label><strong>Diagnosa:</strong></label>
                                <div class="border p-3 bg-white rounded">
                                    {!! nl2br(e($data->diagnosa)) !!}
                                </div>
                            </div>

                            @if($data->tindakan)
                            <div class="form-group">
                                <label><strong>Tindakan:</strong></label>
                                <div class="border p-3 bg-white rounded">
                                    {!! nl2br(e($data->tindakan)) !!}
                                </div>
                            </div>
                            @endif

                            @if($data->catatan)
                            <div class="form-group">
                                <label><strong>Catatan Tambahan:</strong></label>
                                <div class="border p-3 bg-white rounded">
                                    {!! nl2br(e($data->catatan)) !!}
                                </div>
                            </div>
                            @endif
                        </div>
                    </div>

                    <!-- Timestamp -->
                    <div class="card mt-3">
                        <div class="card-body text-center">
                            <div class="row">
                                <div class="col-md-6">
                                    <small class="text-muted">Dibuat Pada</small><br>
                                    <strong>{{ $data->created_at->format('d/m/Y H:i') }}</strong>
                                </div>
                                <div class="col-md-6">
                                    <small class="text-muted">Diupdate Pada</small><br>
                                    <strong>{{ $data->updated_at->format('d/m/Y H:i') }}</strong>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>

                <div class="card-footer">
                    <a href="{{ route('rekam-medis.index') }}" class="btn btn-secondary">
                        <i class="fas fa-arrow-left mr-1"></i> Kembali ke Daftar
                    </a>

                    <a href="{{ route('rekam-medis.print', $data->id) }}" 
                       class="btn btn-success" target="_blank">
                        <i class="fas fa-file-pdf mr-1"></i> Cetak PDF
                    </a>
                </div>

            </div>
        </div>

    </div>
</div>
@endsection
