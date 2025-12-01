@extends('layouts.app')

@section('title', 'Pendaftaran Pasien')

@section('content')
<div class="container py-4">

    <div class="row justify-content-center">
        <div class="col-md-8">

            {{-- ALERT SUCCESS --}}
            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            {{-- ERROR VALIDATION --}}
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>• {{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="card shadow">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0">
                        <i class="fas fa-notes-medical me-1"></i> Form Pendaftaran Pasien
                    </h5>
                </div>

                <div class="card-body">

                    <form action="{{ route('pendaftaran.store') }}" method="POST">
                        @csrf

                        {{-- NOMOR ANTRIAN --}}
                        <div class="mb-3">
                            <label class="form-label fw-bold">Nomor Antrian</label>
                            <input type="text"
                                   class="form-control text-center fw-bold fs-4 bg-light"
                                   value="{{ $no_antrian }}"
                                   readonly>
                        </div>

                        {{-- PASIEN --}}
                        <div class="mb-3">
                            <label class="form-label">Pasien</label>
                            <select name="pasien_id" class="form-select" required>
                                <option value="">-- Pilih Pasien --</option>
                                @foreach ($pasien as $p)
                                    <option value="{{ $p->id }}">
                                        {{ $p->no_rm }} - {{ $p->nama }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        {{-- POLI --}}
                        <div class="mb-3">
                            <label class="form-label">Poli</label>
                            <select name="poli_id" class="form-select" required>
                                <option value="">-- Pilih Poli --</option>
                                @foreach ($poli as $pl)
                                    <option value="{{ $pl->id }}">
                                        {{ $pl->nama_poli }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        {{-- DOKTER --}}
                        <div class="mb-3">
                            <label class="form-label">Dokter</label>
                            <select name="dokter_id" class="form-select" required>
                                <option value="">-- Pilih Dokter --</option>
                                @foreach ($dokter as $d)
                                    <option value="{{ $d->id }}">
                                        {{ $d->nama }} ({{ $d->poli->nama_poli ?? '-' }})
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        {{-- PENJAMIN --}}
                        <div class="mb-3">
                            <label class="form-label">Penjamin</label>
                            <select name="penjamin_id" class="form-select" required>
                                <option value="">-- Pilih Penjamin --</option>
                                @foreach ($penjamin as $j)
                                    <option value="{{ $j->id }}">
                                        {{ $j->nama_penjamin }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        {{-- TANGGAL --}}
                        <div class="mb-3">
                            <label class="form-label">Tanggal Daftar</label>
                            <input type="date"
                                   class="form-control"
                                   value="{{ date('Y-m-d') }}"
                                   readonly>
                        </div>

                        {{-- KELUHAN --}}
                        <div class="mb-4">
                            <label class="form-label">Keluhan</label>
                            <textarea name="keluhan"
                                      class="form-control"
                                      rows="3"
                                      placeholder="Masukkan keluhan pasien..."></textarea>
                        </div>

                        {{-- STATUS --}}
                        <input type="hidden" name="status" value="Terdaftar">

                        <div class="d-grid gap-2">
                            <button class="btn btn-success">
                                <i class="fas fa-save me-1"></i> Simpan & Cetak Antrian
                            </button>

                            <a href="{{ route('pendaftaran.index') }}" class="btn btn-secondary">
                                <i class="fas fa-arrow-left me-1"></i> Kembali
                            </a>
                        </div>

                    </form>

                </div>

            </div>
        </div>
    </div>
</div>
@endsection
