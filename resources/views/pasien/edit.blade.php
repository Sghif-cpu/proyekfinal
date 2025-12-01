@extends('layouts.app')

@section('content')

<h4 class="mb-3">Edit Data Pasien</h4>

<div class="card">
<div class="card-body">

<form action="{{ route('pasien.update',$pasien->id) }}" method="POST">
    @csrf
    @method('PUT')

    <div class="mb-2">
        <label>No RM</label>
        <input type="text" value="{{ $pasien->no_rm }}" readonly class="form-control">
    </div>

    <div class="mb-2">
        <label>Nama Lengkap</label>
        <input type="text" name="nama" value="{{ $pasien->nama }}" class="form-control" required>
    </div>

    <div class="mb-2">
        <label>Tanggal Lahir</label>
        <input type="date" name="tanggal_lahir" value="{{ $pasien->tanggal_lahir }}" class="form-control" required>
    </div>

    <div class="mb-2">
        <label>Jenis Kelamin</label>
        <select name="jenis_kelamin" class="form-control" required>
            <option value="L" {{ $pasien->jenis_kelamin=='L'?'selected':'' }}>Laki-laki</option>
            <option value="P" {{ $pasien->jenis_kelamin=='P'?'selected':'' }}>Perempuan</option>
        </select>
    </div>

    <div class="mb-2">
        <label>No HP</label>
        <input type="text" name="no_hp" value="{{ $pasien->no_hp }}" class="form-control" required>
    </div>

    <div class="mb-2">
        <label>Alamat</label>
        <textarea name="alamat" class="form-control">{{ $pasien->alamat }}</textarea>
    </div>

    <div class="mb-3">
        <label>Penjamin</label>
        <select name="penjamin_id" class="form-control" required>
            @foreach($penjamin as $p)
                <option value="{{ $p->id }}" {{ $pasien->penjamin_id == $p->id ? 'selected' : '' }}>
                    {{ $p->nama_penjamin }}
                </option>
            @endforeach
        </select>
    </div>

    <button class="btn btn-success">
        <i class="fas fa-save"></i> Update
    </button>

    <a href="{{ route('pasien.index') }}" class="btn btn-secondary">Kembali</a>

</form>

</div>
</div>

@endsection
