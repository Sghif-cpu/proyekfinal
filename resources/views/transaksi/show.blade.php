@extends('layouts.app')

@section('content')
<div class="container">
    <h3>Detail Transaksi</h3>

    <table class="table">
        <tr>
            <th>Pasien</th>
            <td>{{ $transaksi->pendaftaran->pasien->nama }}</td>
        </tr>
        <tr>
            <th>Tanggal</th>
            <td>{{ $transaksi->created_at->format('d-m-Y H:i') }}</td>
        </tr>
        <tr>
            <th>Status</th>
            <td>
                <span class="badge bg-{{ $transaksi->status == 'sudah_dibayar' ? 'success' : 'warning' }}">
                    {{ ucfirst($transaksi->status) }}
                </span>
            </td>
        </tr>
        <tr>
            <th>Total</th>
            <td>Rp {{ number_format($transaksi->total,0,',','.') }}</td>
        </tr>
    </table>

    <hr>

    <h5>Rincian Biaya</h5>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Keterangan</th>
                <th>Harga</th>
            </tr>
        </thead>
        <tbody>
            @foreach($transaksi->detail as $item)
            <tr>
                <td>{{ $item->keterangan }}</td>
                <td>Rp {{ number_format($item->harga,0,',','.') }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <a href="{{ route('transaksi.index') }}" class="btn btn-secondary">Kembali</a>
</div>
@endsection
