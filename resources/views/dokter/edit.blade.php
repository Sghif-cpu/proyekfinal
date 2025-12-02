@extends('layouts.app')
@section('title','Edit Dokter')
@section('content')
<div class="container py-4">
    <div class="card shadow-sm">
        <div class="card-header"><h5>Edit Dokter</h5></div>
        <div class="card-body">
            <form action="{{ route('dokter.update',$dokter->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label>Nama Dokter</label>
                    <input type="text" name="nama" class="form-control" value="{{ old('nama',$dokter->nama) }}">
                </div>

                <div class="mb-3">
                    <label>Poli</label>
                    <select name="poli_id" class="form-select">
                        @foreach($polis as $p)
                            <option value="{{ $p->id }}" {{ $dokter->poli_id == $p->id ? 'selected':'' }}>{{ $p->nama }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label>SIP</label>
                    <input type="text" name="sip" class="form-control" value="{{ old('sip',$dokter->sip) }}">
                </div>

                <div class="mb-3">
                    <label>No HP</label>
                    <input type="text" name="no_hp" class="form-control" value="{{ old('no_hp',$dokter->no_hp) }}">
                </div>

                <a href="{{ route('dokter.index') }}" class="btn btn-secondary">Kembali</a>
                <button class="btn btn-primary">Update</button>
            </form>
        </div>
    </div>
</div>
@endsection
