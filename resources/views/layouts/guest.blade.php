<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SIAKAD - @yield('title', 'Login')</title>
    @vite('resources/css/app.css')
    @vite('resources/js/app.js')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.11.3/font/bootstrap-icons.min.css">
    <style>
        body {
            background: linear-gradient(135deg, #0d3b7a 0%, #0d6efd 50%, #17a2b8 100%);
            min-height: 100vh;
        }
        .login-card {
            background: #fff;
            border-radius: 18px;
            box-shadow: 0 25px 60px rgba(0,0,0,0.35);
            overflow: hidden;
        }
        .login-logo {
            width: 72px;
            height: 72px;
            border-radius: 50%;
            background: linear-gradient(135deg, #0d6efd, #17a2b8);
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 16px;
            box-shadow: 0 8px 20px rgba(13,110,253,0.4);
        }
        .login-logo i {
            font-size: 2.1rem;
            color: #fff;
        }
        .form-label-3d {
            font-weight: 700;
            color: #1a1a2e;
            text-shadow: 0 1px 0 rgba(255,255,255,0.6), 0 2px 3px rgba(0,0,0,0.25);
            letter-spacing: 0.3px;
        }
        .form-control:focus {
            border-color: #0d6efd;
            box-shadow: 0 0 0 0.2rem rgba(13,110,253,0.2);
        }
        .btn-login-elegant {
            background: linear-gradient(135deg, #0d6efd, #0a58ca);
            border: none;
            font-weight: 600;
            letter-spacing: 0.5px;
            box-shadow: 0 6px 16px rgba(13,110,253,0.35);
            transition: all 0.2s ease;
        }
        .btn-login-elegant:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 22px rgba(13,110,253,0.45);
        }
    </style>
</head>
<body>

    <div class="d-flex align-items-center justify-content-center" style="min-height: 100vh; padding: 20px;">
        <div class="login-card" style="width: 100%; max-width: 440px;">
            <div class="p-4 p-md-5">
                <div class="text-center mb-4">
                    <div class="login-logo">
                        <i class="bi bi-mortarboard-fill"></i>
                    </div>
                    <h3 class="fw-bold mb-0" style="color: #0d1b38; text-shadow: 0 1px 0 rgba(255,255,255,0.5);">SIAKAD</h3>
                    <p class="text-muted small mb-0">Sistem Informasi Akademik</p>
                </div>

                @if(session('status'))
                    <div class="alert alert-success">
                        {{ session('status') }}
                    </div>
                @endif

                @yield('content')
            </div>
        </div>
    </div>

</body>
</html>