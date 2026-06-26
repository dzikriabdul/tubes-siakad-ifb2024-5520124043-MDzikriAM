@extends('layouts.app')
@section('title', 'Tambah Dosen')

@section('content')
<h3 class="mb-4">Tambah Dosen</h3>

<form action="{{ route('dosen.store') }}" method="POST" class="bg-white p-4 rounded shadow-sm">
    @csrf
    <div class="mb-3">
        <label class="form-label">NIDN</label>
        <input type="text" name="nidn" class="form-control @error('nidn') is-invalid @enderror" value="{{ old('nidn') }}" maxlength="10">
        @error('nidn') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>
    <div class="mb-3">
        <label class="form-label">Nama</label>
        <input type="text" name="nama" class="form-control @error('nama') is-invalid @enderror" value="{{ old('nama') }}" maxlength="50">
        @error('nama') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>
    <button type="submit" class="btn btn-primary">Simpan</button>
    <a href="{{ route('dosen.index') }}" class="btn btn-secondary">Batal</a>
</form>
@endsection