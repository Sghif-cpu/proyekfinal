<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>SIM Rekam Medis</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap + Fontawesome -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">

    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <style>
        body {
            background: #f4f6f9;
        }

        .sidebar {
            width: 250px;
            height: 100vh;
            position: fixed;
            background: #1f2d3d;
            padding: 15px 0;
            color: white;
        }

        .sidebar .brand {
            text-align: center;
            font-size: 20px;
            font-weight: bold;
            padding: 15px;
            border-bottom: 1px solid #3c4b5a;
        }

        .sidebar a {
            display: block;
            padding: 12px 20px;
            color: #c2c7d0;
            text-decoration: none;
            transition: .2s;
            font-size: 15px;
        }

        .sidebar a:hover {
            background: #2c3e50;
            color: white;
        }

        .sidebar i {
            margin-right: 10px;
        }

        .content {
            margin-left: 250px;
            padding: 25px;
        }

        .card-stat {
            border-radius: 10px;
            padding: 20px;
            color: #fff;
            margin-bottom: 10px;
        }

        .bg-blue { background: #3498db; }
        .bg-green { background: #2ecc71; }
        .bg-orange { background: #e67e22; }
        .bg-red { background: #e74c3c; }
    </style>
</head>
<body>

<div class="sidebar">
    <div class="brand">
        <i class="fas fa-notes-medical"></i> SIM RM
    </div>

    <small class="px-3">MENU UTAMA</small>

    <a href="{{ route('dashboard') }}">
        <i class="fas fa-home"></i> Dashboard
    </a>

    <a href="{{ route('pasien.index') }}">
        <i class="fas fa-user-injured"></i> Pasien
    </a>

    <a href="{{ route('pendaftaran.index') }}">
        <i class="fas fa-hospital-user"></i> Pendaftaran
    </a>

    <a href="{{ route('rekam-medis.index') }}">
        <i class="fas fa-stethoscope"></i> Rekam Medis
    </a>

    <a href="{{ route('lab.index') }}">
        <i class="fas fa-vials"></i> Lab
    </a>

    <a href="{{ route('obat.index') }}">
        <i class="fas fa-pills"></i> Obat & Resep
    </a>

    <a href="{{ route('transaksi.index') }}">
        <i class="fas fa-cash-register"></i> Kasir
    </a>

    <small class="px-3 mt-4">MASTER DATA</small>

    <a href="{{ route('dokter.index') }}">
        <i class="fas fa-user-md"></i> Dokter
    </a>

    <a href="#">
        <i class="fas fa-hospital"></i> Poli
    </a>

    <a href="#">
        <i class="fas fa-shield-alt"></i> Penjamin
    </a>

    <!-- FORM LOGOUT (HIDDEN) -->
    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
        @csrf
    </form>

    <!-- BUTTON LOGOUT -->
    <div class="px-3 mt-5">
        <button id="btn-logout" class="btn btn-danger w-100">
            <i class="fas fa-sign-out-alt"></i> Logout
        </button>
    </div>
</div>

<div class="content">
    @yield('content')
</div>

<!-- Script SweetAlert Logout -->
<script>
    document.getElementById('btn-logout').addEventListener('click', function(e){
        e.preventDefault();

        Swal.fire({
            title: 'Yakin ingin logout?',
            text: 'Anda akan keluar dari sistem!',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#6c757d',
            confirmButtonText: 'Ya, Logout',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('logout-form').submit();
            }
        });
    });
</script>

</body>
</html>
