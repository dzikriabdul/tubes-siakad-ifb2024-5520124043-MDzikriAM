@extends('layouts.app')
@section('title', 'Tambah Mahasiswa')

@section('content')
<h3 class="mb-4">Tambah Mahasiswa</h3>

<form action="{{ route('mahasiswa.store') }}" method="POST" class="bg-white p-4 rounded shadow-sm">
    @csrf
    <div class="mb-3">
        <label class="form-label">NPM</label>
        <input type="text" name="npm" class="form-control @error('npm') is-invalid @enderror" value="{{ old('npm') }}" maxlength="10">
        @error('npm') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>
    <div class="mb-3">
        <label class="form-label">Nama</label>
        <input type="text" name="nama" class="form-control @error('nama') is-invalid @enderror" value="{{ old('nama') }}" maxlength="50">
        @error('nama') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>
    <div class="mb-3">
        <label class="form-label">Kelas</label>
        <input type="text" name="kelas" class="form-control @error('kelas') is-invalid @enderror" value="{{ old('kelas') }}" maxlength="1" placeholder="A / B / C">
        @error('kelas') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>
    <button type="submit" class="btn btn-primary">Simpan</button>
    <a href="{{ route('mahasiswa.index') }}" class="btn btn-secondary">Batal</a>
</form>
@endsection