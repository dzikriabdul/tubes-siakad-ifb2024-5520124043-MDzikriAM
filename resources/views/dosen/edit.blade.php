@extends('layouts.app')
@section('title', 'Edit Dosen')

@section('content')
<h3 class="mb-4">Edit Dosen</h3>

<form action="{{ route('dosen.update', $dosen->nidn) }}" method="POST" class="bg-white p-4 rounded shadow-sm">
    @csrf
    @method('PUT')
    <div class="mb-3">
        <label class="form-label">NIDN</label>
        <input type="text" class="form-control" value="{{ $dosen->nidn }}" disabled>
    </div>
    <div class="mb-3">
        <label class="form-label">Nama</label>
        <input type="text" name="nama" class="form-control @error('nama') is-invalid @enderror" value="{{ old('nama', $dosen->nama) }}" maxlength="50">
        @error('nama') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>
    <button type="submit" class="btn btn-primary">Update</button>
    <a href="{{ route('dosen.index') }}" class="btn btn-secondary">Batal</a>
</form>
@endsection