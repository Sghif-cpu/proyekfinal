@extends('layouts.app')

@section('content')
<div class="container">

    <h3 class="mb-4">Tambah Pemeriksaan Lab</h3>

    {{-- INFO REKAM MEDIS --}}
    <div class="card mb-4">
        <div class="card-body">
            <table class="table table-borderless mb-0">
                <tr>
                    <th width="160">Nama Pasien</th>
                    <td>: {{ $rm->pendaftaran->pasien->nama }}</td>
                </tr>
                <tr>
                    <th>Dokter</th>
                    <td>: {{ $rm->pendaftaran->dokter->nama }}</td>
                </tr>
                <tr>
                    <th>No. Rekam Medis</th>
                    <td>: {{ $rm->pendaftaran->no_rm }}</td>
                </tr>
                <tr>
                    <th>ID Rekam</th>
                    <td>: {{ $rm->id }}</td>
                </tr>
            </table>
        </div>
    </div>

    {{-- FORM --}}
    <div class="card">
        <div class="card-body">

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="{{ route('lab.store') }}">
                @csrf

                <input type="hidden" name="rekam_medis_id" value="{{ $rm->id }}">

                <div class="mb-3">
                    <label class="form-label">Nama Pemeriksaan</label>
                    <input
                        type="text"
                        name="nama_pemeriksaan"
                        class="form-control"
                        value="{{ old('nama_pemeriksaan') }}"
                        required
                    >
                </div>

                <div class="mb-3">
                    <label class="form-label">Hasil</label>
                    <input
                        type="text"
                        name="hasil"
                        class="form-control"
                        value="{{ old('hasil') }}"
                    >
                </div>

                <div class="mb-3">
                    <label class="form-label">Satuan</label>
                    <input
                        type="text"
                        name="satuan"
                        class="form-control"
                        value="{{ old('satuan') }}"
                    >
                </div>

                <div class="d-flex justify-content-between">
                    <a href="{{ route('lab.index', $rm->id) }}" class="btn btn-secondary">
                        <i class="fas fa-arrow-left"></i> Kembali
                    </a>

                    <button class="btn btn-success">
                        <i class="fas fa-save"></i> Simpan
                    </button>
                </div>

            </form>

        </div>
    </div>

</div>
@endsection
