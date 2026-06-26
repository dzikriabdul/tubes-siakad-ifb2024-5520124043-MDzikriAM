@extends('layouts.guest')
@section('title', 'Login')

@section('content')
<form method="POST" action="{{ route('login') }}">
    @csrf

    <div class="mb-3">
        <label class="form-label form-label-3d">Email</label>
        <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}" required autofocus>
        @error('email') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>

    <div class="mb-3">
        <label class="form-label form-label-3d">Password</label>
        <div class="position-relative">
            <input type="password" name="password" id="password" class="form-control @error('password') is-invalid @enderror" style="padding-right: 42px;" required>
            <button type="button" id="togglePassword" class="btn position-absolute top-0 end-0 h-100 px-3" style="background: none; border: none;" tabindex="-1">
                <i class="bi bi-eye-slash" id="toggleIcon"></i>
            </button>
        </div>
        @error('password') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>

    <div class="mb-3 form-check">
        <input type="checkbox" name="remember" class="form-check-input" id="remember">
        <label class="form-check-label" for="remember">Ingat saya</label>
    </div>

    <button type="submit" class="btn btn-login-elegant w-100 text-white py-2">Login</button>

    @if (Route::has('password.request'))
        <div class="text-center mt-3">
            <a href="{{ route('password.request') }}" class="small">Lupa password?</a>
        </div>
    @endif

    @if (Route::has('register'))
        <div class="text-center mt-2">
            <span class="small text-muted">Belum punya akun?</span>
            <a href="{{ route('register') }}" class="small">Daftar</a>
        </div>
    @endif
</form>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const toggleBtn = document.getElementById('togglePassword');
        const passwordInput = document.getElementById('password');
        const toggleIcon = document.getElementById('toggleIcon');

        toggleBtn.addEventListener('click', function () {
            const isPassword = passwordInput.type === 'password';
            passwordInput.type = isPassword ? 'text' : 'password';
            toggleIcon.classList.toggle('bi-eye');
            toggleIcon.classList.toggle('bi-eye-slash');
        });
    });
</script>
@endsection