@extends('layouts.app')

@section('content')
<div class="container">
    <h3 class="mb-3">Data Pemeriksaan Lab</h3>

    <div class="card mb-3">
        <div class="card-body">

            <b>Nama Pasien :</b> {{ $rm->pendaftaran->pasien->nama }} <br>
            <b>Dokter :</b> {{ $rm->pendaftaran->dokter->nama }} <br>
            <b>ID Rekam Medis :</b> {{ $rm->id }}

        </div>
    </div>

    <a href="{{ route('lab.create', $rm->id) }}" class="btn btn-primary mb-3">
        + Tambah Pemeriksaan
    </a>

    <table class="table table-bordered">
        <thead class="table-dark">
            <tr>
                <th>No</th>
                <th>Nama Pemeriksaan</th>
                <th>Hasil</th>
                <th>Satuan</th>
                <th width="150">Aksi</th>
            </tr>
        </thead>

        <tbody>
            @forelse($rm->lab as $i => $lab)
            <tr>
                <td>{{ $i + 1 }}</td>
                <td>{{ $lab->nama_pemeriksaan }}</td>
                <td>{{ $lab->hasil }}</td>
                <td>{{ $lab->satuan }}</td>
                <td>
                    <a href="{{ route('lab.edit', $lab->id) }}"
                        class="btn btn-warning btn-sm">Edit</a>

                    <form action="{{ route('lab.destroy', $lab->id) }}"
                          method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')

                        <button class="btn btn-danger btn-sm"
                            onclick="return confirm('Yakin ingin menghapus?')">
                            Hapus
                        </button>
                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="5" class="text-center">
                    Data lab belum ada
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>

    <a href="{{ route('rekam-medis.show', $rm->id) }}"
       class="btn btn-secondary mt-2">
       ← Kembali ke Rekam Medis
    </a>
</div>
@endsection
