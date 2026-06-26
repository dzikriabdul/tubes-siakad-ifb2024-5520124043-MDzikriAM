<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SIAKAD - @yield('title', 'Dashboard')</title>
    @vite('resources/css/app.css')
    @vite('resources/js/app.js')
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.11.3/font/bootstrap-icons.min.css">
    <style>
        .navbar-nav .nav-link.active {
            color: #fff !important;
            border-bottom: 3px solid #fff;
        }
    </style>
</head>

<body class="bg-light">

    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <div class="container">
            <a class="navbar-brand fw-bold d-flex align-items-center gap-2" href="{{ route('dashboard') }}">
                <i class="bi bi-mortarboard-fill" style="font-size: 1.4rem;"></i>
                SIAKAD
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarMenu">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarMenu">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('dashboard') ? 'active fw-bold' : '' }}"
                            href="{{ route('dashboard') }}">Dashboard</a>
                    </li>

                    @if (auth()->user()->role === 'admin')
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('dosen.*') ? 'active fw-bold' : '' }}"
                                href="{{ route('dosen.index') }}">Dosen</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('mahasiswa.*') ? 'active fw-bold' : '' }}"
                                href="{{ route('mahasiswa.index') }}">Mahasiswa</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('matakuliah.*') ? 'active fw-bold' : '' }}"
                                href="{{ route('matakuliah.index') }}">Mata Kuliah</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('jadwal.*') ? 'active fw-bold' : '' }}"
                                href="{{ route('jadwal.index') }}">Jadwal</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('krs.*') ? 'active fw-bold' : '' }}"
                                href="{{ route('krs.index') }}">KRS Mahasiswa</a>
                        </li>
                    @else
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('jadwal.my') ? 'active fw-bold' : '' }}"
                                href="{{ route('jadwal.my') }}">Jadwal Saya</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('krs.*') ? 'active fw-bold' : '' }}"
                                href="{{ route('krs.my') }}">KRS Saya</a>
                        </li>
                    @endif
                </ul>

                <ul class="navbar-nav">
                    <li class="nav-item d-flex align-items-center me-3">
                        <span class="text-white small">
                            {{ auth()->user()->name }}
                            <span class="badge ms-1"
                                style="background-color: #00ff6a83; color: #fff;">{{ auth()->user()->role }}</span>
                        </span>
                    </li>
                    <li class="nav-item">
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="btn btn-sm d-flex align-items-center gap-1"
                                style="
                                background-color: rgba(255,255,255,0.12);
                                color: #fff;
                                border: 1px solid rgba(255,255,255,0.35);
                                border-radius: 8px;
                                padding: 6px 14px;
                                transition: all 0.2s ease;
                                "
                                onmouseover="this.style.backgroundColor='rgba(255,255,255,0.25)'"
                                onmouseout="this.style.backgroundColor='rgba(255,255,255,0.12)'">
                                <i class="bi bi-box-arrow-right"></i>
                                Logout
                            </button>
                        </form>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container mt-4">
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        @if (session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        @yield('content')
    </div>

    <div id="loadingOverlay"
        style="
    display: none;
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(13, 27, 56, 0.55);
    backdrop-filter: blur(4px);
    z-index: 9999;
    align-items: center;
    justify-content: center;
    opacity: 0;
    transition: opacity 0.25s ease;
">
        <div style="
        background: #fff;
        border-radius: 16px;
        padding: 2.5rem 3rem;
        display: flex;
        flex-direction: column;
        align-items: center;
        box-shadow: 0 10px 40px rgba(0,0,0,0.25);
        transform: translateY(10px);
        transition: transform 0.25s ease;
    "
            id="loadingCard">
            <div class="siakad-spinner"></div>
            <p class="mt-3 mb-0 fw-bold" style="color: #0d6efd; font-size: 1.05rem;">Memproses...</p>
            <p class="mb-0 text-muted" style="font-size: 0.85rem;">Mohon tunggu sebentar</p>
        </div>
    </div>

    <style>
        .siakad-spinner {
            width: 52px;
            height: 52px;
            border: 5px solid #e9ecef;
            border-top: 5px solid #0d6efd;
            border-radius: 50%;
            animation: siakad-spin 0.8s linear infinite;
        }

        @keyframes siakad-spin {
            from {
                transform: rotate(0deg);
            }

            to {
                transform: rotate(360deg);
            }
        }
    </style>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const overlay = document.getElementById('loadingOverlay');
            const card = document.getElementById('loadingCard');

            document.querySelectorAll('form').forEach(function(form) {
                form.addEventListener('submit', function(e) {
                    overlay.style.display = 'flex';
                    requestAnimationFrame(function() {
                        overlay.style.opacity = '1';
                        card.style.transform = 'translateY(0)';
                    });
                });
            });
        });
    </script>

</body>

</html>
