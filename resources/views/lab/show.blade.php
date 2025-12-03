@extends('layouts.app')

@section('content')

<h4 class="mb-3">Detail Pemeriksaan Lab</h4>

<div class="card shadow-sm">
    <div class="card-header bg-primary text-white">
        <h5 class="mb-0">Informasi Pemeriksaan Lab</h5>
    </div>

    <div class="card-body">

        {{-- INFORMASI PASIEN --}}
        <div class="border rounded p-3 mb-3 bg-light">
            <h6 class="fw-bold mb-2 text-secondary">Data Pasien</h6>
            <p class="mb-1"><b>Nama:</b> {{ $data->rekamMedis->pendaftaran->pasien->nama }}</p>
            <p class="mb-1"><b>Dokter:</b> {{ $data->rekamMedis->pendaftaran->dokter->nama }}</p>
            <p class="mb-0"><b>No RM:</b> {{ $data->rekamMedis->pendaftaran->pasien->no_rm }}</p>
        </div>

        {{-- DETAIL LAB --}}
        <div class="border rounded p-3">
            <h6 class="fw-bold mb-2 text-secondary">Detail Pemeriksaan</h6>

            <p class="mb-1"><b>Nama Pemeriksaan:</b> {{ $data->nama_pemeriksaan }}</p>
            <p class="mb-1"><b>Hasil:</b> {{ $data->hasil ?? '-' }}</p>
            <p class="mb-1"><b>Satuan:</b> {{ $data->satuan ?? '-' }}</p>
            <p class="mb-0"><b>Tanggal:</b> {{ $data->created_at->format('d-m-Y H:i') }}</p>
        </div>

        {{-- TOMBOL AKSI --}}
        <div class="mt-4">
            <a href="{{ route('lab.index', $data->rekam_medis_id) }}" class="btn btn-secondary">
                Kembali
            </a>

            <a href="{{ route('lab.edit', $data->id) }}" class="btn btn-warning">
                Edit
            </a>

            <form action="{{ route('lab.destroy', $data->id) }}" method="POST" 
                  style="display:inline-block">
                @csrf
                @method('DELETE')
                <button onclick="return confirm('Hapus data ini?')" 
                        class="btn btn-danger">
                    Hapus
                </button>
            </form>
        </div>

    </div>
</div>

@endsection
