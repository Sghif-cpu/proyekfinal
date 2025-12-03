@extends('layouts.app')

@section('content')

@if($rekam)
    <h4 class="mb-3">Pemeriksaan Lab – {{ $rekam->pendaftaran->pasien->nama }}</h4>
@else
    <h4 class="mb-3">Pemeriksaan Lab</h4>
@endif

<div class="card">
    <div class="card-body">

        <!-- TOMBOL TAMBAH UNTUK KEDUA KONDISI -->
        <div class="d-flex justify-content-end mb-3">
            @if($rekam)
                <!-- Jika ada rekam medis spesifik -->
                <a href="{{ route('lab.create', $rekam->id) }}" class="btn btn-success">
                    + Tambah Pemeriksaan Lab
                </a>
            @else
                <!-- Jika halaman global -->
                <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#pilihRekamModal">
                    + Tambah Pemeriksaan Lab
                </button>
            @endif
        </div>

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
                    @if($rekam)
                        <td colspan="5" class="text-muted text-center">
                            Belum ada data lab untuk pasien ini.
                        </td>
                    @else
                        <td colspan="6" class="text-muted text-center">
                            Belum ada data lab.
                        </td>
                    @endif
                </tr>
                @endforelse
            </tbody>
        </table>

    </div>
</div>

<!-- MODAL UNTUK PILIH REKAM MEDIS (hanya di halaman global) -->
@if(!$rekam && isset($rekamMedisList))
<div class="modal fade" id="pilihRekamModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Pilih Rekam Medis</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('lab.create') }}" method="GET">
                    <div class="mb-3">
                        <label class="form-label">Pilih Rekam Medis</label>
                        <select name="rekam_medis_id" class="form-select" required>
                            <option value="">-- Pilih Rekam Medis --</option>
                            @foreach($rekamMedisList as $rm)
                            <option value="{{ $rm->id }}">
                                {{ $rm->pendaftaran->pasien->nama ?? 'Nama tidak tersedia' }} - 
                                {{ $rm->created_at->format('d/m/Y') }}
                            </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="text-end">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary">Lanjut</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endif

@endsection