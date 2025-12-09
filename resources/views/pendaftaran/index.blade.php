@extends('layouts.app')

@section('content')
<div class="container-fluid">

    <div class="d-flex justify-content-between align-items-center mb-3">
        <h4 class="mb-0">Data Pendaftaran</h4>

        <a href="{{ route('pendaftaran.create') }}" class="btn btn-success">
            + Daftar Pasien
        </a>
    </div>

    <form method="GET" class="row g-3 mb-4">
        <div class="col-md-3">
            <label class="form-label fw-bold">Tanggal</label>
            <input type="date" name="tanggal" value="{{ $tanggal }}" class="form-control">
        </div>

        <div class="col-md-2 d-flex align-items-end">
            <button class="btn btn-primary w-100">Filter</button>
        </div>
    </form>

    {{-- ================== TABEL GABUNG ================== --}}
    <div class="card shadow-sm">
        <div class="card-body table-responsive">

            <table class="table table-bordered table-hover align-middle text-center">
                <thead class="table-light">
                    <tr>
                        <th style="width: 110px;">No Antrian</th>
                        <th>Nama Pasien</th>
                        <th>Dokter</th>
                        <th>Penjamin</th>
                        <th>Poli</th>
                        <th>Keluhan</th>
                        <th style="width: 150px;">Tanggal</th>
                        <th style="width: 180px;">Aksi</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse($pendaftaran as $row)
                    <tr>
                        <td class="fw-bold">{{ $row->no_antrian }}</td>

                        {{-- NAMA PASIEN --}}
                        <td>{{ $row->pasien->nama ?? '-' }}</td>
                        <td>{{ $row->dokter->nama_dokter ?? '-' }}</td>
                        <td>{{ $row->poli->nama_poli ?? '-' }}</td>
                        <td>{{ $row->penjamin->nama_penjamin ?? '-' }}</td>

                        {{-- POLI --}}
                        <td>{{ $row->poli->nama_poli ?? '-' }}</td>

                        {{-- KELUHAN --}}
                        <td>{{ $row->keluhan ?? '-' }}</td>

                        {{-- TANGGAL --}}
                        <td>{{ $row->tanggal_daftar->format('d-m-Y') }}</td>

                        <td>
                            <a href="{{ route('pendaftaran.show',$row->id) }}" 
                               class="btn btn-info btn-sm me-1">
                                Detail
                            </a>

                            <a href="{{ route('pendaftaran.cetak',$row->id) }}" 
                               target="_blank" 
                               class="btn btn-danger btn-sm">
                                <i class="fas fa-print"></i> Cetak
                            </a>
                        </td>
                    </tr>

                    @empty
                    <tr>
                        <td colspan="8" class="text-center py-4">Tidak ada data</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>

            <div class="mt-3">
                {{ $pendaftaran->links() }}
            </div>

        </div>
    </div>

</div>
@endsection
