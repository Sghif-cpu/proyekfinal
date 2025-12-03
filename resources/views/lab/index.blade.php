@extends('layouts.app')

@section('content')
<div class="container">
    <h4 class="mb-4">Data Pemeriksaan Lab</h4>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    {{-- FILTER TANGGAL --}}
    <form method="GET" class="row g-3 mb-3">
        <div class="col-md-4">
            <input type="date" name="tanggal_mulai" class="form-control"
                   value="{{ request('tanggal_mulai') }}">
        </div>
        <div class="col-md-4">
            <input type="date" name="tanggal_selesai" class="form-control"
                   value="{{ request('tanggal_selesai') }}">
        </div>
        <div class="col-md-4 d-flex gap-2">
            <button class="btn btn-primary w-50">Filter</button>
            <a href="{{ url()->current() }}" class="btn btn-secondary w-50">Reset</a>
        </div>
    </form>

    @if(isset($rekam_medis_id))
        <a href="{{ route('lab.create', $rekam_medis_id) }}" class="btn btn-success mb-3">
            + Tambah Lab
        </a>
    @endif

    <div class="card shadow-sm">
        <div class="card-body table-responsive">

            <table class="table table-bordered text-center">
                <thead class="table-light">
                    <tr>
                        <th>No</th>
                        <th>Pasien</th>
                        <th>Dokter</th>
                        <th>Pemeriksaan</th>
                        <th>Tanggal</th>
                        <th>Hasil</th>
                        <th>Aksi</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse($labs as $lab)
                        <tr>
                            <td>{{ $loop->iteration + ($labs->currentPage() - 1) * $labs->perPage() }}</td>

                            <td>{{ $lab->rekamMedis->pendaftaran->pasien->nama ?? '-' }}</td>

                            <td>{{ $lab->rekamMedis->pendaftaran->dokter->nama ?? '-' }}</td>

                            <td>{{ $lab->nama_pemeriksaan }}</td>

                            <td>{{ $lab->created_at->format('d-m-Y') }}</td>

                            <td>{{ $lab->hasil ?? '-' }}</td>

                            <td>
                                <a href="{{ route('lab.edit', $lab->id) }}" class="btn btn-warning btn-sm">Edit</a>

                                <form action="{{ route('lab.destroy', $lab->id) }}"
                                      method="POST" style="display:inline-block">
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
                            <td colspan="7" class="text-muted">Belum ada data lab</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>

            {{-- PAGINATION --}}
            <div class="mt-3 d-flex justify-content-center">
                {{ $labs->withQueryString()->links() }}
            </div>

        </div>
    </div>
</div>
@endsection
