@extends('layouts.app')

@section('content')
<div class="container">
    <h3 class="mb-4">Data Obat</h3>

    <a href="{{ route('obat.create') }}" class="btn btn-primary mb-3">+ Tambah Obat</a>

    <!-- Tombol Cetak -->
    <a href="{{ route('obat.cetak') }}" target="_blank" class="btn btn-success mb-3">
        Cetak Laporan Obat
    </a>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Obat</th>
                <th>Satuan</th>
                <th>Stok</th>
                <th>Harga</th>

                <!-- ⭐ Tambahan Baru -->
                <th>Tanggal</th>
                <th>Cara Bayar</th>
                <!-- ⭐ -->

                <th>Aksi</th>
            </tr>
        </thead>

        <tbody>
            @forelse($obat as $o)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $o->nama_obat }}</td>
                    <td>{{ $o->satuan }}</td>
                    <td>{{ $o->stok }}</td>
                    <td>Rp {{ number_format($o->harga, 0, ',', '.') }}</td>

                    <!-- ⭐ Menampilkan data tambahan -->
                    <td>{{ $o->tanggal }}</td>
                    <td>{{ $o->cara_bayar }}</td>
                    <!-- ⭐ -->

                    <td>
                        <a href="{{ route('obat.show', $o->id) }}" class="btn btn-info btn-sm">Detail</a>
                        <a href="{{ route('obat.edit', $o->id) }}" class="btn btn-warning btn-sm">Edit</a>

                        <form action="{{ route('obat.destroy', $o->id) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button onclick="return confirm('Hapus obat ini?')" class="btn btn-danger btn-sm">
                                Hapus
                            </button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="8" class="text-center">Belum ada data obat</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
