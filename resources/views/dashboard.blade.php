@extends('layouts.app')

@section('content')

<div class="d-flex justify-content-between align-items-center mb-4">
    <h3 class="fw-bold">📊 Dashboard</h3>
    <span class="text-muted">{{ date('l, d F Y') }}</span>
</div>

<!-- STAT CARDS -->
<div class="row g-4 mb-4">

    <div class="col-md-3">
        <div class="card border-0 shadow-sm p-3 text-white bg-primary rounded-4">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <small>Total Pasien</small>
                    <h3 class="fw-bold">{{ \App\Models\Pasien::count() }}</h3>
                </div>
                <i class="fas fa-user-injured fa-2x opacity-75"></i>
            </div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="card border-0 shadow-sm p-3 text-white bg-success rounded-4">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <small>Pendaftaran Hari Ini</small>
                    <h3 class="fw-bold">
                        {{ \App\Models\Pendaftaran::whereDate('tanggal_daftar', date('Y-m-d'))->count() }}
                    </h3>
                </div>
                <i class="fas fa-hospital-user fa-2x opacity-75"></i>
            </div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="card border-0 shadow-sm p-3 text-white bg-warning rounded-4">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <small>Total Dokter</small>
                    <h3 class="fw-bold">{{ \App\Models\Dokter::count() }}</h3>
                </div>
                <i class="fas fa-user-md fa-2x opacity-75"></i>
            </div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="card border-0 shadow-sm p-3 text-white bg-danger rounded-4">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <small>Total Transaksi</small>
                    <h3 class="fw-bold">{{ \App\Models\Transaksi::count() }}</h3>
                </div>
                <i class="fas fa-cash-register fa-2x opacity-75"></i>
            </div>
        </div>
    </div>

</div>

<!-- CHART & WELCOME -->
<div class="row g-4">

    <div class="col-md-8">
        <div class="card border-0 shadow-sm rounded-4 p-4">
            <h5 class="fw-bold mb-3">Statistik Singkat</h5>
            <canvas id="myChart" height="130"></canvas>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card border-0 shadow-sm rounded-4 p-4 bg-light">
            <h5 class="fw-bold mb-2">👋 Selamat Datang</h5>
            <p class="mb-2">
                Halo <b>{{ auth()->user()->name ?? 'Admin' }}</b>,
                Anda login sebagai <b>{{ auth()->user()->role->name ?? 'User' }}</b>
            </p>
            <hr>
            <ul class="list-unstyled small mb-0">
                <li>✔ Kelola pasien</li>
                <li>✔ Rekam medis</li>
                <li>✔ Pendaftaran & transaksi</li>
            </ul>
        </div>
    </div>

</div>

<!-- CHART JS -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
const ctx = document.getElementById('myChart');

new Chart(ctx, {
    type: 'bar',
    data: {
        labels: ['Pasien', 'Pendaftaran', 'Dokter', 'Transaksi'],
        datasets: [{
            label: 'Jumlah Data',
            data: [
                {{ \App\Models\Pasien::count() }},
                {{ \App\Models\Pendaftaran::count() }},
                {{ \App\Models\Dokter::count() }},
                {{ \App\Models\Transaksi::count() }},
            ]
        }]
    },
    options: {
        responsive: true,
        plugins: {
            legend: { display: false }
        },
        scales: {
            y: {
                beginAtZero: true
            }
        }
    }
});
</script>

@endsection
