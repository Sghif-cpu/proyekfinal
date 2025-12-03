<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Login - Rekam Medis</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            min-height: 100vh;
            margin: 0;
            display: flex;
            align-items: center;
            justify-content: center;

            /* 🔥 Gradien Modern */
            background: linear-gradient(135deg, #4A90E2, #6A60F5, #2BC0E4);
            background-size: 200% 200%;
            animation: gradientMove 8s ease infinite;
        }

        @keyframes gradientMove {
            0% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
            100% { background-position: 0% 50%; }
        }

        /* Card Glassmorphism */
        .glass-card {
            background: rgba(255,255,255,0.15);
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
            border-radius: 15px;
            border: 1px solid rgba(255,255,255,0.3);
            box-shadow: 0px 8px 25px rgba(0,0,0,0.15);
        }

        .title-text {
            color: white;
            font-weight: 600;
        }

        .footer-text {
            color: rgba(255,255,255,0.7);
        }
    </style>
</head>

<body>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-4">

            <!-- Card -->
            <div class="glass-card p-4">

                <h4 class="text-center mb-3 title-text">Login Sistem</h4>

                @if ($errors->any())
                    <div class="alert alert-danger py-2">
                        {{ $errors->first() }}
                    </div>
                @endif

                <form method="POST" action="{{ route('login.post') }}">
                    @csrf

                    <div class="mb-3">
                        <label class="form-label text-white">Username</label>
                        <input 
                            type="text" 
                            name="username" 
                            class="form-control" 
                            required 
                            autofocus>
                    </div>

                    <div class="mb-3">
                        <label class="form-label text-white">Password</label>
                        <input 
                            type="password" 
                            name="password" 
                            class="form-control" 
                            required>
                    </div>

                    <button type="submit" class="btn btn-light fw-bold w-100">
                        Login
                    </button>
                </form>

            </div>

            <!-- Footer -->
            <p class="text-center mt-3 small footer-text">
                Sistem Rekam Medis © {{ date('Y') }}
            </p>

        </div>
    </div>
</div>

</body>
</html>
