@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
<h2 class="mb-4">Selamat datang, {{ auth()->user()->name }}!</h2>

@if(auth()->user()->role === 'admin')
<div class="row g-4">
    <div class="col-md-3">
        <div class="card text-white bg-primary shadow-sm">
            <div class="card-body">
                <h6 class="card-title">Total Dosen</h6>
                <h2>{{ $stats['dosen'] }}</h2>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card text-white bg-success shadow-sm">
            <div class="card-body">
                <h6 class="card-title">Total Mahasiswa</h6>
                <h2>{{ $stats['mahasiswa'] }}</h2>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card text-white bg-warning shadow-sm">
            <div class="card-body">
                <h6 class="card-title">Total Mata Kuliah</h6>
                <h2>{{ $stats['matakuliah'] }}</h2>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card text-white bg-info shadow-sm">
            <div class="card-body">
                <h6 class="card-title">Total Jadwal</h6>
                <h2>{{ $stats['jadwal'] }}</h2>
            </div>
        </div>
    </div>
</div>
@else
<div class="card shadow-sm">
    <div class="card-body">
        <p>Gunakan menu di atas untuk melihat jadwal kuliah dan mengelola KRS kamu.</p>
    </div>
</div>
@endif
@endsection