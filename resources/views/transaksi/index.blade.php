@extends('layouts.app')

@section('content')
<div class="container">
    <h3>Data Transaksi</h3>

    {{-- KETERANGAN --}}
    <div class="alert alert-info">
        <strong>Keterangan:</strong><br>
        <span class="badge bg-danger">Belum Dibayar</span> = Transaksi sudah dibuat tetapi belum dilakukan pembayaran <br>
        <span class="badge bg-success">Sudah Dibayar</span> = Transaksi sudah dilunasi <br><br>

        <strong>Tombol Aksi:</strong><br>
        <span class="text-primary">Detail</span> = Melihat rincian transaksi lengkap <br>
        <span class="text-warning">Edit</span> = Mengubah data transaksi <br>
        <span class="text-danger">Hapus</span> = Menghapus transaksi dari sistem <br>
        <span class="text-success">Bayar</span> = Mengubah status menjadi <b>Sudah Dibayar</b>
    </div>

    <a href="{{ route('transaksi.create') }}" class="btn btn-primary mb-3">+ Tambah Transaksi</a>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Pasien</th>
                <th>Detail Transaksi</th>
                <th>Total</th>
                <th>Status</th>
                <th>Tanggal</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($data as $item)
            <tr>
                <td>{{ $loop->iteration }}</td>

                <td>{{ $item->pendaftaran->pasien->nama ?? '-' }}</td>

                {{-- DETAIL TRANSAKSI --}}
                <td>
                    @if($item->detail && count($item->detail) > 0)
                        <ul class="mb-0">
                            @foreach($item->detail as $d)
                                <li>
                                    {{ $d->keterangan }} —
                                    Rp {{ number_format($d->harga,0,',','.') }}
                                </li>
                            @endforeach
                        </ul>
                    @else
                        <small class="text-muted">Tidak ada detail</small>
                    @endif
                </td>

                {{-- TOTAL --}}
                <td>Rp {{ number_format($item->total,0,',','.') }}</td>

                {{-- STATUS --}}
                <td>
                    @if($item->status == 'belum_dibayar')
                        <span class="badge bg-danger">Belum Dibayar</span>
                    @else
                        <span class="badge bg-success">Sudah Dibayar</span>
                    @endif
                </td>

                {{-- TANGGAL --}}
                <td>{{ $item->created_at->format('d-m-Y') }}</td>

                {{-- AKSI --}}
                <td>
                    <a href="{{ route('transaksi.show', $item->id) }}" class="btn btn-info btn-sm">Detail</a>
                    <a href="{{ route('transaksi.edit', $item->id) }}" class="btn btn-warning btn-sm">Edit</a>

                    <form action="{{ route('transaksi.destroy', $item->id) }}" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger btn-sm" onclick="return confirm('Hapus?')">Hapus</button>
                    </form>

                    @if($item->status == 'belum_dibayar')
                    <form action="{{ route('transaksi.bayar', $item->id) }}" method="POST" class="d-inline">
                        @csrf
                        <button class="btn btn-success btn-sm">Bayar</button>
                    </form>
                    @endif
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="7" class="text-center">Belum ada transaksi</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
