<div class="card mb-3">
    <div class="card-header bg-white">
        <h5 class="mb-0">Aksi Cepat</h5>
    </div>
    <div class="card-body">
        @php $rekamId = isset($data) ? $data->id : (isset($rekam) ? $rekam->id : null); @endphp

        <div class="d-grid gap-2">
            @if($rekamId)
                <a href="{{ route('rekam-medis.edit', $rekamId) }}" class="btn btn-warning btn-sm">Edit Rekam</a>
                <a href="{{ route('lab.create', $rekamId) }}" class="btn btn-success btn-sm">Tambah Lab</a>
                <a href="{{ route('lab.byRekamMedis', $rekamId) }}" class="btn btn-primary btn-sm">Lihat Lab</a>
            @else
                <a href="{{ route('rekam-medis.index') }}" class="btn btn-secondary btn-sm">Daftar Rekam</a>
                <a href="{{ route('lab.index') }}" class="btn btn-secondary btn-sm">Daftar Lab</a>
            @endif
        </div>
    </div>
</div>
