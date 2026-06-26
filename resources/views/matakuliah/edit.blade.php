@extends('layouts.app')
@section('title', 'Edit Mata Kuliah')

@section('content')
<h3 class="mb-4">Edit Mata Kuliah</h3>

<form action="{{ route('matakuliah.update', $matakuliah->kode_matakuliah) }}" method="POST" class="bg-white p-4 rounded shadow-sm">
    @csrf
    @method('PUT')
    <div class="mb-3">
        <label class="form-label">Kode Mata Kuliah</label>
        <input type="text" class="form-control" value="{{ $matakuliah->kode_matakuliah }}" disabled>
    </div>
    <div class="mb-3">
        <label class="form-label">Nama Mata Kuliah</label>
        <input type="text" name="nama_matakuliah" class="form-control @error('nama_matakuliah') is-invalid @enderror" value="{{ old('nama_matakuliah', $matakuliah->nama_matakuliah) }}" maxlength="50">
        @error('nama_matakuliah') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>
    <div class="mb-3">
        <label class="form-label">SKS</label>
        <input type="number" name="sks" class="form-control @error('sks') is-invalid @enderror" value="{{ old('sks', $matakuliah->sks) }}" min="1" max="6">
        @error('sks') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>
    <button type="submit" class="btn btn-primary">Update</button>
    <a href="{{ route('matakuliah.index') }}" class="btn btn-secondary">Batal</a>
</form>
@endsection