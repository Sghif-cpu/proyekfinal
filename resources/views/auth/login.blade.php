<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Login - Rekam Medis</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">

    <style>
        body {
            min-height: 100vh;
            margin: 0;
            display: flex;
            align-items: center;
            justify-content: center;

            /* 🌈 Gradien Bergerak Modern */
            background: linear-gradient(135deg, #4A90E2, #6A60F5, #2BC0E4);
            background-size: 200% 200%;
            animation: gradientMove 7s ease infinite;
            overflow: hidden;
            position: relative;
        }

        /* Animasi Background */
        @keyframes gradientMove {
            0% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
            100% { background-position: 0% 50%; }
        }

        /* Ornamen Bulat (Glow Decoration) */
        .circle {
            position: absolute;
            width: 260px;
            height: 260px;
            border-radius: 50%;
            background: rgba(255,255,255,0.15);
            filter: blur(25px);
            animation: float 6s infinite ease-in-out;
        }
        .circle:nth-child(1) { top: 10%; left: 15%; }
        .circle:nth-child(2) { bottom: 15%; right: 10%; animation-delay: 3s; }

        @keyframes float {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(20px); }
        }

        /* Card Glass */
        .glass-card {
            background: rgba(255,255,255,0.20);
            backdrop-filter: blur(12px);
            border-radius: 18px;
            border: 1px solid rgba(255,255,255,0.35);
            box-shadow: 0px 10px 35px rgba(0,0,0,0.20);
            animation: fadeInUp .8s ease;
            transition: .3s;
        }

        /* Animasi muncul */
        @keyframes fadeInUp {
            from { opacity: 0; transform: translateY(30px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .glass-card:hover {
            transform: translateY(-5px);
            box-shadow: 0px 15px 40px rgba(0,0,0,0.25);
        }

        .title-text {
            color: white;
            font-weight: 700;
            letter-spacing: .5px;
        }

        .footer-text {
            color: rgba(255,255,255,0.8);
        }

        /* Input styling */
        .form-control {
            background: rgba(255,255,255,0.75);
            border: none;
            border-radius: 10px;
        }

        .form-control:focus {
            background: rgba(255,255,255,0.9);
            box-shadow: 0 0 0 3px rgba(255,255,255,0.6);
        }

        /* Tombol Login */
        .btn-login {
            background: white;
            font-weight: bold;
            border-radius: 10px;
            transition: .2s;
        }

        .btn-login:hover {
            transform: scale(1.05);
            background: #f0f0f0;
        }

        /* Icon dalam input */
        .input-group-text {
            background: rgba(255,255,255,0.25);
            border: none;
            color: white;
            font-size: 18px;
        }

        /* Ilustrasi Klinik */
        .login-image {
            width: 80px;
            height: 80px;
            margin-bottom: 10px;
            animation: pulse 2s infinite ease-in-out;
        }

        @keyframes pulse {
            0%,100% { transform: scale(1); opacity: 0.9; }
            50% { transform: scale(1.08); opacity: 1; }
        }
    </style>
</head>

<body>

<!-- Ornamen -->
<div class="circle"></div>
<div class="circle"></div>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-4">

            <!-- Glass Card -->
            <div class="glass-card p-4 text-center">

                <!-- Icon Klinik -->
                <img src="https://cdn-icons-png.flaticon.com/512/2966/2966327.png" class="login-image">

                <h4 class="text-center mb-3 title-text">LOGIN SISTEM RME</h4>

                <!-- Error -->
                @if ($errors->any())
                    <div class="alert alert-danger py-2">
                        {{ $errors->first() }}
                    </div>
                @endif

                <form method="POST" action="{{ route('login.post') }}">
                    @csrf

                    <!-- Username -->
                    <div class="mb-3 text-start">
                        <label class="form-label text-white">Username</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="fas fa-user"></i></span>
                            <input type="text" name="username" class="form-control" required autofocus>
                        </div>
                    </div>

                    <!-- Password -->
                    <div class="mb-3 text-start">
                        <label class="form-label text-white">Password</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="fas fa-lock"></i></span>
                            <input type="password" name="password" class="form-control" required>
                        </div>
                    </div>

                    <!-- Button -->
                    <button type="submit" class="btn btn-login w-100 py-2 mt-2">
                        <i class="fas fa-sign-in-alt"></i> Login
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
