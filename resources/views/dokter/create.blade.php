@extends('layouts.app')
@section('title','Tambah Dokter')
@section('content')
<div class="container py-4">
    <div class="card shadow-sm">
        <div class="card-header"><h5>Tambah Dokter</h5></div>
        <div class="card-body">
            <form action="{{ route('dokter.store') }}" method="POST">
                @csrf
                
                <div class="mb-3">
                    <label>Nama Dokter</label>
                    <input type="text" name="nama" class="form-control" value="{{ old('nama') }}">
                </div>

                <div class="mb-3">
                    <label>Poli</label>
                    <select name="poli_id" class="form-select">
                        <option value="">-- Pilih Poli --</option>
                        @foreach($poli as $p)
                            <option value="{{ $p->id }}" 
                                {{ old('poli_id') == $p->id ? 'selected' : '' }}>
                                {{ $p->nama_poli }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label>SIP</label>
                    <input type="text" name="sip" class="form-control" value="{{ old('sip') }}" readonly>
                </div>

                <div class="mb-3">
                    <label>No HP</label>
                    <input type="text" name="no_hp" class="form-control" value="{{ old('no_hp') }}">
                </div>

                <a href="{{ route('dokter.index') }}" class="btn btn-secondary">Kembali</a>
                <button class="btn btn-primary">Simpan</button>
            </form>
        </div>
    </div>
</div>

{{-- ============================================================= --}}
{{--                  AUTO-GELAR + AUTO SIP GLOBAL                 --}}
{{-- ============================================================= --}}
<script>
document.addEventListener('DOMContentLoaded', function () {

    const inputNama = document.querySelector('input[name="nama"]');
    const inputSip  = document.querySelector('input[name="sip"]');
    const selectPoli = document.querySelector('select[name="poli_id"]');

    /* ----------- AUTO-GELAR DR / DRG ----------- */
    function updateGelar() {
        if (!inputNama) return;

        let nama = inputNama.value.trim();
        if (nama === '') return;

        // Buang gelar lama
        nama = nama.replace(/^drg\.\s*/i, '')
                   .replace(/^dr\.\s*/i, '');

        const isGigi = selectPoli.options[selectPoli.selectedIndex]?.text.toLowerCase().includes('gigi');
        const gelar = isGigi ? 'drg.' : 'dr.';

        inputNama.value = `${gelar} ${nama}`;
    }

    inputNama.addEventListener('blur', updateGelar);
    selectPoli.addEventListener('change', updateGelar);

    /* ----------- AUTO GENERATE SIP GLOBAL ----------- */
    async function generateSip() {
        const res = await fetch(`/api/sip-next`);
        const data = await res.json();
        inputSip.value = data.next_sip;
    }

    // SIP otomatis ketika halaman dibuka dan saat memilih poli
    generateSip();
    selectPoli.addEventListener('change', generateSip);

});
</script>
@endsection
