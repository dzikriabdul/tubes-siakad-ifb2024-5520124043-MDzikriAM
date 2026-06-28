<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SIAKAD - @yield('title', 'Dashboard')</title>
    @vite('resources/css/app.css')
    @vite('resources/js/app.js')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.11.3/font/bootstrap-icons.min.css">
    <style>
        .sidebar {
            position: fixed;
            top: 0;
            left: -280px;
            width: 280px;
            height: 100%;
            background: #fff;
            box-shadow: 2px 0 8px rgba(0,0,0,0.15);
            z-index: 1050;
            transition: left 0.3s ease;
            overflow-y: auto;
        }
        .sidebar.show {
            left: 0;
        }
        .sidebar-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0,0,0,0.4);
            z-index: 1040;
            display: none;
        }
        .sidebar-overlay.show {
            display: block;
        }
        .sidebar-header {
            padding: 16px 20px;
            border-bottom: 1px solid #dee2e6;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .sidebar .nav-link {
            color: #333;
            padding: 12px 20px;
            border-radius: 0;
        }
        .sidebar .nav-link:hover {
            background: #f1f3f5;
        }
        .sidebar .nav-link.active {
            background: #0d6efd;
            color: #fff;
            font-weight: bold;
        }
        .sidebar-user {
            padding: 14px 20px;
            border-top: 1px solid #dee2e6;
            margin-top: 8px;
        }
        #sidebarToggle {
            background: none;
            border: none;
            color: #fff;
            font-size: 1.5rem;
            line-height: 1;
            padding: 0 8px;
        }
        .navbar-custom {
            padding-top: 0.5rem;
            padding-bottom: 0.5rem;
        }
    </style>
</head>
<body class="bg-light">

    <nav class="navbar navbar-expand-lg navbar-dark bg-primary navbar-custom">
        <div class="container">
            <button id="sidebarToggle" type="button" aria-label="Buka menu">&#9776;</button>

            <a class="navbar-brand fw-bold ms-2 d-flex align-items-center gap-2" href="{{ route('dashboard') }}">
                <i class="bi bi-mortarboard-fill"></i>
                SIAKAD
            </a>

            <button type="submit" form="logoutFormTop" class="btn btn-sm ms-auto d-flex align-items-center gap-1" style="
                background-color: rgba(255,255,255,0.12);
                color: #fff;
                border: 1px solid rgba(255,255,255,0.35);
                border-radius: 8px;
                padding: 5px 12px;
            ">
                <i class="bi bi-box-arrow-right"></i>
                <span class="d-none d-sm-inline">Logout</span>
            </button>
            <form id="logoutFormTop" method="POST" action="{{ route('logout') }}" class="d-none">
                @csrf
            </form>
        </div>
    </nav>

    <div class="sidebar-overlay" id="sidebarOverlay"></div>

    <div class="sidebar" id="sidebar">
        <div class="sidebar-header">
            <div>
                <h5 class="mb-0 text-primary fw-bold">SIAKAD</h5>
                <small class="text-muted">Menu navigasi</small>
            </div>
            <button id="sidebarClose" type="button" class="btn-close" aria-label="Tutup menu"></button>
        </div>

        <ul class="nav flex-column">
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}" href="{{ route('dashboard') }}">
                    <i class="bi bi-speedometer2 me-2"></i>Dashboard
                </a>
            </li>

            @if(auth()->user()->role === 'admin')
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('dosen.*') ? 'active' : '' }}" href="{{ route('dosen.index') }}">
                        <i class="bi bi-person-badge me-2"></i>Dosen
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('mahasiswa.*') ? 'active' : '' }}" href="{{ route('mahasiswa.index') }}">
                        <i class="bi bi-people me-2"></i>Mahasiswa
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('matakuliah.*') ? 'active' : '' }}" href="{{ route('matakuliah.index') }}">
                        <i class="bi bi-book me-2"></i>Mata kuliah
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('jadwal.*') ? 'active' : '' }}" href="{{ route('jadwal.index') }}">
                        <i class="bi bi-calendar-week me-2"></i>Jadwal
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('krs.*') ? 'active' : '' }}" href="{{ route('krs.index') }}">
                        <i class="bi bi-card-checklist me-2"></i>KRS mahasiswa
                    </a>
                </li>
            @else
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('jadwal.my') ? 'active' : '' }}" href="{{ route('jadwal.my') }}">
                        <i class="bi bi-calendar-week me-2"></i>Jadwal saya
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('krs.*') ? 'active' : '' }}" href="{{ route('krs.my') }}">
                        <i class="bi bi-card-checklist me-2"></i>KRS saya
                    </a>
                </li>
            @endif
        </ul>

        <div class="sidebar-user">
            <p class="mb-1 fw-semibold" style="font-size: 14px;">{{ auth()->user()->name }}</p>
            <span class="badge" style="background-color: #17a2b8; color: #fff;">{{ auth()->user()->role }}</span>
        </div>
    </div>

    <div class="container mt-4">
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        @yield('content')
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const sidebar = document.getElementById('sidebar');
            const overlay = document.getElementById('sidebarOverlay');
            const toggleBtn = document.getElementById('sidebarToggle');
            const closeBtn = document.getElementById('sidebarClose');

            function openSidebar() {
                sidebar.classList.add('show');
                overlay.classList.add('show');
            }

            function closeSidebar() {
                sidebar.classList.remove('show');
                overlay.classList.remove('show');
            }

            toggleBtn.addEventListener('click', function () {
                if (sidebar.classList.contains('show')) {
                    closeSidebar();
                } else {
                    openSidebar();
                }
            });

            closeBtn.addEventListener('click', closeSidebar);
            overlay.addEventListener('click', closeSidebar);
        });
    </script>

</body>
</html>