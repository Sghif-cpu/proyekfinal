<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <title>Rekam Medis #{{ $data->id }}</title>
    <style>
        body { font-family: DejaVu Sans, Arial, sans-serif; color: #222; }
        .header { text-align: center; margin-bottom: 20px; }
        .meta { margin-bottom: 10px; }
        .section { margin-bottom: 12px; }
        .label { font-weight: bold; width: 150px; display: inline-block; vertical-align: top; }
        .value { display: inline-block; max-width: 420px; }
        .box { border: 1px solid #ccc; padding: 8px; border-radius: 4px; background: #fff; }
        table { width: 100%; border-collapse: collapse; }
        th, td { padding: 6px 8px; vertical-align: top; }
    </style>
</head>
<body>

<div class="header" style="display:flex; align-items:center; justify-content:space-between;">
    <div style="display:flex; align-items:center; gap:12px;">
        {{-- Logo jika tersedia di public/images/logo.png --}}
        @php $logoPath = public_path('images/logo.png'); @endphp
        @if(file_exists($logoPath))
            <div><img src="{{ $logoPath }}" alt="Logo" style="height:60px;"></div>
        @else
            <div style="font-size:18px; font-weight:700; color:#2c3e50;">KLINIK BAKTI MEDIKA</div>
        @endif
        <div style="line-height:1;">
        <div style="font-size:12px;">Jl. Kenanga Raya No. 15, Citra Mandiri, Kota Pratama</div>
        <div style="font-size:12px;">Tel: (031) 8801-4421</div>
        </div>
    </div>

    <div style="text-align:right;">
        <div style="font-size:16px; font-weight:700;">Rekam Medis</div>
        <div>Nomor: RM-{{ $data->id }}</div>
        <div>Tanggal: {{ $data->created_at->format('d/m/Y H:i') }}</div>
    </div>
</div>

<div class="section">
    <div class="meta"><span class="label">Nama Pasien</span><span class="value">{{ optional($data->pendaftaran->pasien)->nama ?? '-' }}</span></div>
    <div class="meta"><span class="label">No. RM</span><span class="value">{{ $data->pendaftaran->no_rm ?? '-' }}</span></div>
    <div class="meta"><span class="label">Dokter</span><span class="value">{{ optional($data->pendaftaran->dokter)->nama ?? optional($data->pendaftaran->dokter)->nama_dokter ?? '-' }}</span></div>
</div>

<div class="section">
    <div class="label">Diagnosa</div>
    <div class="box">{!! nl2br(e($data->diagnosa)) !!}</div>
</div>

@if($data->tindakan)
<div class="section">
    <div class="label">Tindakan / Terapi</div>
    <div class="box">{!! nl2br(e($data->tindakan)) !!}</div>
</div>
@endif

@if($data->catatan)
<div class="section">
    <div class="label">Catatan</div>
    <div class="box">{!! nl2br(e($data->catatan)) !!}</div>
</div>
@endif

<div style="position: fixed; bottom: 20px; left: 0; right: 0; text-align:center; font-size: 12px; color: #666;">
    Dicetak: {{ \Carbon\Carbon::now()->format('d/m/Y H:i') }}
</div>

</body>
</html>
