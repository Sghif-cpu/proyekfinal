@extends('layouts.app')

@section('content')

<style>
    .dashboard-card {
        min-height: 100%;
    }
    .chart-container {
        height: 260px;
        position: relative;
    }
    .chart-container-lg {
        height: 320px;
        position: relative;
    }
    .gap-row {
        row-gap: 1.5rem !important;
    }
</style>

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
<div class="row gap-row">

    <div class="col-lg-8">
        <div class="card border-0 shadow-sm rounded-4 p-4 dashboard-card">
            <h5 class="fw-bold mb-3">Statistik Singkat</h5>
            <div class="chart-container-lg">
                <canvas id="myChart"></canvas>
            </div>
        </div>
    </div>

    <div class="col-lg-4">
        <div class="card border-0 shadow-sm rounded-4 p-4 bg-light dashboard-card">
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

<!-- LINE + PIE + DONUT -->
<div class="row gap-row mt-3">

    <div class="col-lg-6">
        <div class="card border-0 shadow-sm rounded-4 p-4 dashboard-card">
            <h5 class="fw-bold mb-3">Perkembangan Per Bulan</h5>
            <div class="chart-container">
                <canvas id="lineChart"></canvas>
            </div>
        </div>
    </div>

    <div class="col-lg-3">
        <div class="card border-0 shadow-sm rounded-4 p-4 dashboard-card">
            <h5 class="fw-bold mb-3">Proporsi Data</h5>
            <div class="chart-container">
                <canvas id="pieChart"></canvas>
            </div>
        </div>
    </div>

    <div class="col-lg-3">
        <div class="card border-0 shadow-sm rounded-4 p-4 dashboard-card">
            <h5 class="fw-bold mb-3">Perbandingan Pasien</h5>
            <div class="chart-container">
                <canvas id="donutChart"></canvas>
            </div>
        </div>
    </div>

</div>

<!-- POLI & DOKTER -->
<div class="row gap-row mt-3">

    <div class="col-lg-6">
        <div class="card border-0 shadow-sm rounded-4 p-4 dashboard-card">
            <h5 class="fw-bold mb-3">Grafik Antrian per Poli</h5>
            <div class="chart-container-lg">
                <canvas id="chartPoli"></canvas>
            </div>
        </div>
    </div>

    <div class="col-lg-6">
        <div class="card border-0 shadow-sm rounded-4 p-4 dashboard-card">
            <h5 class="fw-bold mb-3">Dokter dengan Pasien Terbanyak</h5>
            <div class="chart-container-lg">
                <canvas id="chartDokter"></canvas>
            </div>
        </div>
    </div>

</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
/* ========================== DATA ========================== */
const totalPasien = {{ \App\Models\Pasien::count() }};
const totalPendaftaran = {{ \App\Models\Pendaftaran::count() }};
const totalDokter = {{ \App\Models\Dokter::count() }};
const totalTransaksi = {{ \App\Models\Transaksi::count() }};
const daftarHariIni = {{ \App\Models\Pendaftaran::whereDate('tanggal_daftar', date('Y-m-d'))->count() }};

// Poli
const poliLabels = {!! json_encode(\App\Models\Poli::pluck('nama_poli')) !!};
const poliCounts = {!! json_encode(
    \App\Models\Poli::withCount('pendaftaran')->pluck('pendaftaran_count')
) !!};

// Dokter
const dokterLabels = {!! json_encode(\App\Models\Dokter::pluck('nama')) !!};
const dokterCounts = {!! json_encode(
    \App\Models\Dokter::withCount('pendaftaran')
        ->orderBy('pendaftaran_count','desc')
        ->pluck('pendaftaran_count')
) !!};

/* ========================== RANDOM COLOR ========================== */
function randColor(op = 0.7) {
    return `rgba(${Math.floor(Math.random()*255)}, 
                 ${Math.floor(Math.random()*255)}, 
                 ${Math.floor(Math.random()*255)}, ${op})`;
}
function rangeColor(n, op=0.7) { 
    return Array.from({length:n}, () => randColor(op)); 
}

/* ========================== CHARTS ========================== */

// BAR
new Chart(document.getElementById('myChart'), {
    type: 'bar',
    data: {
        labels: ['Pasien', 'Pendaftaran', 'Dokter', 'Transaksi'],
        datasets: [{
            backgroundColor: rangeColor(4),
            data: [totalPasien, totalPendaftaran, totalDokter, totalTransaksi]
        }]
    },
    options: { plugins: { legend: { display: false }} }
});

// LINE
new Chart(document.getElementById('lineChart'), {
    type: 'line',
    data: {
        labels: ['Jan','Feb','Mar','Apr','Mei','Jun','Jul','Agu','Sep','Okt','Nov','Des'],
        datasets: [{
            label: 'Pasien Baru',
            borderColor: randColor(1),
            backgroundColor: randColor(0.2),
            borderWidth: 2,
            data: [
                @foreach(range(1,12) as $b)
                    {{ \App\Models\Pasien::whereMonth('created_at',$b)->count() }},
                @endforeach
            ]
        }]
    },
    options: { scales: { y: { beginAtZero: true }} }
});

// PIE
new Chart(document.getElementById('pieChart'), {
    type: 'pie',
    data: {
        labels: ['Pasien', 'Pendaftaran', 'Dokter', 'Transaksi'],
        datasets: [{
            backgroundColor: rangeColor(4),
            data: [totalPasien, totalPendaftaran, totalDokter, totalTransaksi]
        }]
    }
});

// DONUT
new Chart(document.getElementById('donutChart'), {
    type: 'doughnut',
    data: {
        labels: ['Total Pasien', 'Pendaftaran Hari Ini'],
        datasets: [{
            backgroundColor: rangeColor(2),
            data: [totalPasien, daftarHariIni]
        }]
    }
});

// POLI BAR
new Chart(document.getElementById('chartPoli'), {
    type: 'bar',
    data: {
        labels: poliLabels,
        datasets: [{
            backgroundColor: rangeColor(poliLabels.length),
            data: poliCounts
        }]
    },
    options: { 
        scales: { y: { beginAtZero: true }},
        plugins:{ legend:{ display:false }}
    }
});

// DOKTER HORIZONTAL
new Chart(document.getElementById('chartDokter'), {
    type: 'bar',
    data: {
        labels: dokterLabels,
        datasets: [{
            backgroundColor: rangeColor(dokterLabels.length),
            data: dokterCounts
        }]
    },
    options: {
        indexAxis: 'y',
        scales: { x: { beginAtZero: true }},
        plugins: { legend: { display: false }}
    }
});
</script>

@endsection
