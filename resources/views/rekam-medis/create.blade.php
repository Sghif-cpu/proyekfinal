@extends('layouts.app')

@section('content')
<div class="container-fluid">

    <div class="d-flex justify-content-between align-items-center mb-3">
        <h4>Tambah Pemeriksaan Baru</h4>
    </div>

    <div class="row">

        {{-- FORM PEMERIKSAAN --}}
        <div class="col-md-8">
            <div class="card shadow-sm mb-4">
                <div class="card-header bg-white">
                    <h5 class="mb-0 fw-bold">Form Pemeriksaan Pasien</h5>
                </div>

                <div class="card-body">

                    <form action="{{ route('rekam-medis.store') }}" method="POST">
                        @csrf

                        {{-- PILIH PENDAFTARAN --}}
                        <div class="mb-3">
                            <label class="fw-bold">Pilih Pasien / Pendaftaran <span class="text-danger">*</span></label>

                            <select name="pendaftaran_id" id="selectPendaftaran" class="form-control" required>
                                <option value="">-- Pilih Pendaftaran --</option>
                                @foreach($pendaftaran as $p)
                                    <option value="{{ $p->id }}"
                                        data-nama="{{ $p->pasien->nama }}"
                                        data-dokter="{{ $p->dokter->nama ?? '-' }}"
                                        data-rm="{{ $p->pasien->no_rm }}">
                                        #{{ $p->id }} – {{ $p->pasien->nama }} (Dokter: {{ $p->dokter->nama ?? '-' }})
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        {{-- DATA PASIEN OTOMATIS --}}
                        <div id="boxDataPasien" class="border rounded p-3 bg-light mb-3" style="display:none;">
                            <p class="mb-1"><b>Nama Pasien:</b> <span id="namaPasien"></span></p>
                            <p class="mb-1"><b>Dokter:</b> <span id="namaDokter"></span></p>
                            <p class="mb-0"><b>No Rekam Medis:</b> <span id="noRm"></span></p>
                        </div>

                        {{-- DIAGNOSA --}}
                        <div class="mb-3">
                            <label class="fw-bold">Diagnosa</label>
                            <textarea name="diagnosa" class="form-control" rows="3" required></textarea>
                        </div>

                        {{-- TINDAKAN --}}
                        <div class="mb-3">
                            <label class="fw-bold">Tindakan / Terapi</label>
                            <textarea name="tindakan" class="form-control" rows="3"></textarea>
                        </div>

                        {{-- CATATAN --}}
                        <div class="mb-3">
                            <label class="fw-bold">Catatan Tambahan</label>
                            <textarea name="catatan" class="form-control" rows="3"></textarea>
                        </div>

                        <div class="mt-4">
                            <button type="submit" class="btn btn-success">
                                <i class="fas fa-save me-1"></i> Simpan Pemeriksaan
                            </button>

                            <a href="{{ route('rekam-medis.index') }}" class="btn btn-secondary">
                                <i class="fas fa-times me-1"></i> Batal
                            </a>
                        </div>
                    </form>

                </div>
            </div>
        </div>

        {{-- PANEL PANDUAN --}}
        <div class="col-md-4">
            <div class="card shadow-sm">
                <div class="card-header bg-white">
                    <h5 class="fw-bold mb-0 text-primary">
                        <i class="fas fa-info-circle me-2"></i> Panduan Pemeriksaan
                    </h5>
                </div>
                <div class="card-body">
                    <ul class="mb-0">
                        <li>Pilih pasien berdasarkan pendaftaran</li>
                        <li>Diagnosa ditulis sesuai hasil pemeriksaan</li>
                        <li>Tindakan berisi terapi, injeksi, saran dokter</li>
                        <li>Catatan diisi jika perlu</li>
                        <li>Setelah disimpan, bisa tambah resep & lab</li>
                    </ul>
                </div>
            </div>
        </div>

    </div>

</div>

{{-- SCRIPT AUTO LOAD PASIEN --}}
<script>
document.getElementById('selectPendaftaran').addEventListener('change', function() {

    let selected = this.options[this.selectedIndex];

    if (this.value === "") {
        document.getElementById('boxDataPasien').style.display = 'none';
        return;
    }

    document.getElementById('namaPasien').innerText = selected.dataset.nama;
    document.getElementById('namaDokter').innerText = selected.dataset.dokter;
    document.getElementById('noRm').innerText = selected.dataset.rm;

    document.getElementById('boxDataPasien').style.display = 'block';
});
</script>

@endsection
