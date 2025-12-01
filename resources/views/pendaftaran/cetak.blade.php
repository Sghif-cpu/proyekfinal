<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Cetak Antrian</title>
    <style>
        body { text-align:center; font-family: Arial, sans-serif; }
        .box {
            border:2px dashed #000;
            padding:20px;
        }
        h1 {
            font-size: 60px;
            margin: 5px 0;
        }
        h3 { margin: 0; }
    </style>
</head>
<body>

<div class="box">

    <h3>Nomor Antrian</h3>
    <h1>{{ $pendaftaran->no_antrian }}</h1>

    <hr>

    <p><b>Nama:</b> {{ $pendaftaran->pasien->nama }}</p>
    <p><b>Dokter:</b> {{ $pendaftaran->dokter->nama_dokter }}</p>
    <p><b>Penjamin:</b> {{ $pendaftaran->penjamin->nama_penjamin }}</p>
    <p><b>Tanggal:</b> {{ $pendaftaran->tanggal_daftar->format('d-m-Y') }}</p>

    <br>
    <small>Silakan menunggu giliran Anda</small>

</div>

</body>
</html>
