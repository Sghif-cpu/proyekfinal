@extends('layouts.app')

@section('content')
<div class="container">

    <h4 class="mb-3">Edit Rekam Medis</h4>

    <form action="{{ route('rekam-medis.update', $data->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="row">

            {{-- INFORMASI PENDAFTARAN --}}
            <div class="col-md-12 mb-3">
                <label class="fw-bold">Data Pendaftaran</label>

                <div class="border rounded p-3 bg-light">
                    <p class="mb-1"><b>Pasien:</b> {{ $data->pendaftaran->pasien->nama }}</p>
                    <p class="mb-1"><b>Dokter:</b> {{ $data->pendaftaran->dokter->nama ?? $data->pendaftaran->dokter->nama_dokter }}</p>
                    <p class="mb-0"><b>Tgl Daftar:</b> {{ $data->pendaftaran->created_at->format('d-m-Y') }}</p>
                </div>

                {{-- Hidden: supaya tetap ikut saat update --}}
                <input type="hidden" name="pendaftaran_id" value="{{ $data->pendaftaran_id }}">
            </div>

            {{-- DIAGNOSA --}}
            <div class="col-md-12 mb-3">
                <label>Diagnosa</label>
                <textarea name="diagnosa" class="form-control" rows="3">{{ $data->diagnosa }}</textarea>
            </div>

            {{-- TINDAKAN --}}
            <div class="col-md-12 mb-3">
                <label>Tindakan</label>
                <textarea name="tindakan" class="form-control" rows="3">{{ $data->tindakan }}</textarea>
            </div>

            {{-- CATATAN --}}
            <div class="col-md-12 mb-3">
                <label>Catatan</label>
                <textarea name="catatan" class="form-control" rows="3">{{ $data->catatan }}</textarea>
            </div>

        </div>

        <button type="submit" class="btn btn-primary">
            <i class="fas fa-save"></i> Update
        </button>

        <a href="{{ route('rekam-medis.index') }}" class="btn btn-secondary">
            Batal
        </a>

    </form>

</div>
@endsection
