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

<!-- CHART TAMBAHAN -->
<div class="row g-4 mt-3">

    <div class="col-md-6">
        <div class="card border-0 shadow-sm rounded-4 p-4">
            <h5 class="fw-bold mb-3">Perkembangan Per Bulan</h5>
            <canvas id="lineChart" height="150"></canvas>
        </div>
    </div>

    <div class="col-md-3">
        <div class="card border-0 shadow-sm rounded-4 p-4">
            <h5 class="fw-bold mb-3">Proporsi Data</h5>
            <canvas id="pieChart" height="150"></canvas>
        </div>
    </div>

    <div class="col-md-3">
        <div class="card border-0 shadow-sm rounded-4 p-4">
            <h5 class="fw-bold mb-3">Perbandingan Pasien</h5>
            <canvas id="donutChart" height="150"></canvas>
        </div>
    </div>

</div>

<!-- CHART JS -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
// ==================== BAR CHART ====================
new Chart(document.getElementById('myChart'), {
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
        plugins: { legend: { display: false }},
        scales: { y: { beginAtZero: true }}
    }
});

// ==================== LINE CHART ====================
new Chart(document.getElementById('lineChart'), {
    type: 'line',
    data: {
        labels: ['Jan','Feb','Mar','Apr','Mei','Jun','Jul','Agu','Sep','Okt','Nov','Des'],
        datasets: [{
            label: 'Pasien Baru',
            borderWidth: 2,
            data: [
                {{ \App\Models\Pasien::whereMonth('created_at',1)->count() }},
                {{ \App\Models\Pasien::whereMonth('created_at',2)->count() }},
                {{ \App\Models\Pasien::whereMonth('created_at',3)->count() }},
                {{ \App\Models\Pasien::whereMonth('created_at',4)->count() }},
                {{ \App\Models\Pasien::whereMonth('created_at',5)->count() }},
                {{ \App\Models\Pasien::whereMonth('created_at',6)->count() }},
                {{ \App\Models\Pasien::whereMonth('created_at',7)->count() }},
                {{ \App\Models\Pasien::whereMonth('created_at',8)->count() }},
                {{ \App\Models\Pasien::whereMonth('created_at',9)->count() }},
                {{ \App\Models\Pasien::whereMonth('created_at',10)->count() }},
                {{ \App\Models\Pasien::whereMonth('created_at',11)->count() }},
                {{ \App\Models\Pasien::whereMonth('created_at',12)->count() }},
            ]
        }]
    },
    options: {
        responsive: true,
        scales: { y: { beginAtZero: true }},
    }
});

// ==================== PIE CHART ====================
new Chart(document.getElementById('pieChart'), {
    type: 'pie',
    data: {
        labels: ['Pasien', 'Pendaftaran', 'Dokter', 'Transaksi'],
        datasets: [{
            data: [
                {{ \App\Models\Pasien::count() }},
                {{ \App\Models\Pendaftaran::count() }},
                {{ \App\Models\Dokter::count() }},
                {{ \App\Models\Transaksi::count() }},
            ]
        }]
    }
});

// ==================== DOUGHNUT CHART ====================
new Chart(document.getElementById('donutChart'), {
    type: 'doughnut',
    data: {
        labels: ['Pasien Terdaftar', 'Pendaftaran Hari Ini'],
        datasets: [{
            data: [
                {{ \App\Models\Pasien::count() }},
                {{ \App\Models\Pendaftaran::whereDate('tanggal_daftar', date('Y-m-d'))->count() }},
            ]
        }]
    }
});
</script>

@endsection
