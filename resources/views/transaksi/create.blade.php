@extends('layouts.app')

@section('content')
<div class="container">
    <h3>Buat Transaksi</h3>
    <a href="{{ route('transaksi.index') }}" class="btn btn-secondary btn-sm mb-3">⬅ Kembali</a>

    <form action="{{ route('transaksi.store') }}" method="POST">
        @csrf

        {{-- Pilih Pendaftaran --}}
        <label>Pendaftaran</label>
        <select name="pendaftaran_id" class="form-control" required>
            <option value="">-- Pilih Pasien --</option>
            @foreach($pendaftaran as $p)
                <option value="{{ $p->id }}">{{ $p->pasien->nama }}</option>
            @endforeach
        </select>

        <hr>

        {{-- Item Detail --}}
        <h5>Detail Transaksi</h5>

        <div id="item-container">
            <div class="row mb-2">
                
                <div class="col-6">
                    <input type="text" 
                           name="keterangan[]" 
                           class="form-control" 
                           required 
                           placeholder="Keterangan (misal: Administrasi, Tindakan, dll)">
                </div>

                <div class="col-6">
                    <input type="number" 
                           name="harga[]" 
                           class="form-control harga" 
                           required 
                           placeholder="Harga">
                </div>
            </div>
        </div>

        <button type="button" id="add" class="btn btn-info btn-sm mb-3">+ Tambah Item</button>

        <hr>

        {{-- Total --}}
        <h4>Total: <span id="totalDisplay">Rp 0</span></h4>
        <input type="hidden" name="total" id="totalInput" value="0">

        <button class="btn btn-primary">Simpan</button>
    </form>
</div>

<script>
    // Hitung total dari semua input harga
    function hitungTotal() {
        let total = 0;
        document.querySelectorAll('.harga').forEach(input => {
            total += Number(input.value);
        });

        document.getElementById('totalDisplay').innerText = formatRupiah(total);
        document.getElementById('totalInput').value = total;
    }

    // Format angka menjadi Rupiah
    function formatRupiah(angka) {
        return 'Rp ' + angka.toString().replace(/\B(?=(\d{3})+(?!\d))/g, '.');
    }

    // Tombol tambah item
    document.getElementById('add').addEventListener('click', function () {
        document.getElementById('item-container').insertAdjacentHTML('beforeend', `
            <div class="row mb-2">

                <div class="col-6">
                    <input type="text" 
                           name="keterangan[]" 
                           class="form-control" 
                           required 
                           placeholder="Keterangan">
                </div>

                <div class="col-6">
                    <input type="number" 
                           name="harga[]" 
                           class="form-control harga" 
                           required 
                           placeholder="Harga">
                </div>

            </div>
        `);

        updateListener();
    });

    // Tambahkan listener input harga
    function updateListener() {
        document.querySelectorAll('.harga').forEach(input => {
            input.removeEventListener('input', hitungTotal);
            input.addEventListener('input', hitungTotal);
        });
    }

    updateListener();
</script>
@endsection
