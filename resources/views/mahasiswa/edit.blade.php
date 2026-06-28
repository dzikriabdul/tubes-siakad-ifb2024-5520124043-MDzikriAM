@extends('layouts.app')
@section('title', 'Edit Mahasiswa')

@section('content')
<h3 class="mb-4">Edit Mahasiswa</h3>

<form action="{{ route('mahasiswa.update', $mahasiswa->npm) }}" method="POST" class="bg-white p-4 rounded shadow-sm">
    @csrf
    @method('PUT')
    <div class="mb-3">
        <label class="form-label">NPM</label>
        <input type="text" class="form-control" value="{{ $mahasiswa->npm }}" disabled>
    </div>
    <div class="mb-3">
        <label class="form-label">Nama</label>
        <input type="text" name="nama" class="form-control @error('nama') is-invalid @enderror" value="{{ old('nama', $mahasiswa->nama) }}" maxlength="50">
        @error('nama') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>
    <div class="mb-3">
        <label class="form-label">Kelas</label>
        <input type="text" name="kelas" class="form-control @error('kelas') is-invalid @enderror" value="{{ old('kelas', $mahasiswa->kelas) }}" maxlength="1">
        @error('kelas') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>
    <button type="submit" class="btn btn-primary">Update</button>
    <a href="{{ route('mahasiswa.index') }}" class="btn btn-secondary">Batal</a>
</form>
@endsection