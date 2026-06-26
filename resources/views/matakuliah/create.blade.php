@extends('layouts.app')
@section('title', 'Tambah Mata Kuliah')

@section('content')
<h3 class="mb-4">Tambah Mata Kuliah</h3>

<form action="{{ route('matakuliah.store') }}" method="POST" class="bg-white p-4 rounded shadow-sm">
    @csrf
    <div class="mb-3">
        <label class="form-label">Kode Mata Kuliah</label>
        <input type="text" name="kode_matakuliah" class="form-control @error('kode_matakuliah') is-invalid @enderror" value="{{ old('kode_matakuliah') }}" maxlength="8">
        @error('kode_matakuliah') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>
    <div class="mb-3">
        <label class="form-label">Nama Mata Kuliah</label>
        <input type="text" name="nama_matakuliah" class="form-control @error('nama_matakuliah') is-invalid @enderror" value="{{ old('nama_matakuliah') }}" maxlength="50">
        @error('nama_matakuliah') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>
    <div class="mb-3">
        <label class="form-label">SKS</label>
        <input type="number" name="sks" class="form-control @error('sks') is-invalid @enderror" value="{{ old('sks') }}" min="1" max="6">
        @error('sks') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>
    <button type="submit" class="btn btn-primary">Simpan</button>
    <a href="{{ route('matakuliah.index') }}" class="btn btn-secondary">Batal</a>
</form>
@endsection