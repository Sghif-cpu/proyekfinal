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
            transition: .3s;
        }

        /* ================================
           SIDEBAR SLIDE IN / SLIDE OUT
        =================================*/
        .sidebar {
            width: 250px;
            height: 100vh;
            position: fixed;
            background: #1f2d3d;
            padding: 15px 0;
            color: white;
            transition: transform .3s ease;
            overflow: hidden;
            transform: translateX(0);
        }

        /* Collapse: slide-out tetapi icon tetap muncul */
        .sidebar.collapsed {
            transform: translateX(-180px);   /* geser keluar */
        }

        /* Geser kembali ICON supaya tetap terlihat */
        .sidebar.collapsed a i,
        .sidebar.collapsed .brand i,
        .sidebar.collapsed #btn-logout i {
            transform: translateX(180px);
            transition: .3s;
        }

        /* Hide all text elements when collapsed */
        .sidebar.collapsed a span,
        .sidebar.collapsed .brand span,
        .sidebar.collapsed #btn-logout span,
        .sidebar.collapsed .menu-label {
            display: none !important;
        }

        .sidebar .brand {
            text-align: center;
            font-size: 20px;
            font-weight: bold;
            padding: 15px;
            border-bottom: 1px solid #3c4b5a;
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 8px;
            transition: .2s;
        }

        .sidebar a {
            display: flex;
            align-items: center;
            padding: 12px 20px;
            color: #c2c7d0;
            text-decoration: none;
            transition: .2s;
            font-size: 15px;
            gap: 12px;
            white-space: nowrap;
        }

        .sidebar a:hover {
            background: #2c3e50;
            color: white;
        }

        .sidebar i {
            width: 22px;
            text-align: center;
        }

        /* CONTENT SHIFT */
        .content {
            margin-left: 250px;
            padding: 25px;
            transition: margin-left .3s ease;
        }
        .content.expanded {
            margin-left: 70px;
        }

        /* TOGGLE BUTTON */
        #toggle-btn {
            width: 100%;
            text-align: right;
            padding: 0 20px;
            margin-bottom: 10px;
            cursor: pointer;
            color: #c2c7d0;
        }
        #toggle-btn:hover {
            color: white;
        }
    </style>
</head>
<body>

<div class="sidebar" id="sidebar">
    <div id="toggle-btn">
        <i class="fas fa-bars"></i>
    </div>

    <div class="brand">
        <i class="fas fa-hospital"></i>
        <span>SIM RM</span>
    </div>

    <small class="px-3 menu-label">MENU UTAMA</small>

    <a href="{{ route('dashboard') }}">
        <i class="fas fa-home"></i> <span>Dashboard</span>
    </a>

    <a href="{{ route('pasien.index') }}">
        <i class="fas fa-user-injured"></i> <span>Pasien</span>
    </a>

    <a href="{{ route('pendaftaran.index') }}">
        <i class="fas fa-hospital-user"></i> <span>Pendaftaran</span>
    </a>

    <a href="{{ route('rekam-medis.index') }}">
        <i class="fas fa-stethoscope"></i> <span>Rekam Medis</span>
    </a>

    <a href="#">
        <i class="fas fa-vials"></i> Lab
    </a>

    <a href="{{ route('obat.index') }}">
        <i class="fas fa-pills"></i> <span>Obat & Resep</span>
    </a>

    <a href="{{ route('transaksi.index') }}">
        <i class="fas fa-cash-register"></i> <span>Kasir</span>
    </a>

    <small class="px-3 mt-4 menu-label">MASTER DATA</small>

    <a href="{{ route('dokter.index') }}">
        <i class="fas fa-user-md"></i> <span>Dokter</span>
    </a>

    <a href="{{ route('poli.index') }}">
        <i class="fas fa-hospital-symbol"></i> <span>Data Poli</span>
    </a>

    <a href="#">
        <i class="fas fa-shield-alt"></i> <span>Penjamin</span>
    </a>

    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
        @csrf
    </form>

    <div class="px-3 mt-5">
        <button id="btn-logout" class="btn btn-danger w-100">
            <i class="fas fa-sign-out-alt"></i> <span>Logout</span>
        </button>
    </div>
</div>

<div class="content" id="content">
    @yield('content')
</div>

<!-- Sidebar Collapse Script -->
<script>
    const sidebar = document.getElementById('sidebar');
    const content = document.getElementById('content');

    document.getElementById('toggle-btn').addEventListener('click', function () {
        sidebar.classList.toggle('collapsed');
        content.classList.toggle('expanded');
    });
</script>

<!-- Logout Script -->
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
