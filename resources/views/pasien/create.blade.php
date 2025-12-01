@extends('layouts.app')

@section('content')

<h4 class="mb-3">Tambah Pasien Baru</h4>

<div class="card">
<div class="card-body">

<form action="{{ route('pasien.store') }}" method="POST">
    @csrf

    <div class="mb-2">
        <label>No RM</label>
        <input type="text" name="no_rm" value="{{ $no_rm }}" readonly class="form-control">
    </div>

    <div class="mb-2">
        <label>NIK</label>
        <input type="text" name="nik" class="form-control" required>
    </div>


    <div class="mb-2">
        <label>Nama Lengkap</label>
        <input type="text" name="nama" class="form-control" required>
    </div>

    <div class="mb-2">
        <label>Tanggal Lahir</label>
        <input type="date" name="tanggal_lahir" class="form-control" required>
    </div>

    <div class="mb-2">
        <label>Jenis Kelamin</label>
        <select name="jenis_kelamin" class="form-control" required>
            <option value="">- Pilih -</option>
            <option value="L">Laki-laki</option>
            <option value="P">Perempuan</option>
        </select>
    </div>

    <div class="mb-2">
        <label>No HP</label>
        <input type="text" name="no_hp" class="form-control" required>
    </div>

    <div class="mb-2">
        <label>Alamat</label>
        <textarea name="alamat" class="form-control"></textarea>
    </div>

    <div class="mb-3">
        <label>Penjamin</label>
        <select name="penjamin_id" class="form-control" required>
            <option value="">- Pilih -</option>
            @foreach($penjamin as $p)
                <option value="{{ $p->id }}">{{ $p->nama_penjamin }}</option>
            @endforeach
        </select>
    </div>

    <button class="btn btn-success">
        <i class="fas fa-save"></i> Simpan
    </button>

    <a href="{{ route('pasien.index') }}" class="btn btn-secondary">Kembali</a>

</form>

</div>
</div>

@endsection
