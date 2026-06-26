@extends('layouts.app')
@section('title', 'Edit Jadwal')

@section('content')
    <h3 class="mb-4">Edit Jadwal</h3>

    <form action="{{ route('jadwal.update', $jadwal->id) }}" method="POST" class="bg-white p-4 rounded shadow-sm">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label class="form-label">Mata Kuliah</label>
            <select name="kode_matakuliah" class="form-select @error('kode_matakuliah') is-invalid @enderror">
                @foreach ($matakuliah as $mk)
                    <option value="{{ $mk->kode_matakuliah }}"
                        {{ old('kode_matakuliah', $jadwal->kode_matakuliah) == $mk->kode_matakuliah ? 'selected' : '' }}>
                        {{ $mk->nama_matakuliah }} ({{ $mk->sks }} SKS)
                    </option>
                @endforeach
            </select>
            @error('kode_matakuliah')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label class="form-label">Dosen Pengajar</label>
            <select name="nidn" class="form-select @error('nidn') is-invalid @enderror">
                @foreach ($dosen as $d)
                    <option value="{{ $d->nidn }}" {{ old('nidn', $jadwal->nidn) == $d->nidn ? 'selected' : '' }}>
                        {{ $d->nama }}
                    </option>
                @endforeach
            </select>
            @error('nidn')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label class="form-label">Kelas</label>
            <input type="text" name="kelas" class="form-control @error('kelas') is-invalid @enderror"
                value="{{ old('kelas', $jadwal->kelas) }}" maxlength="1">
            @error('kelas')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label class="form-label">Hari</label>
            <select name="hari" class="form-select @error('hari') is-invalid @enderror">
                @foreach (['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'] as $hari)
                    <option value="{{ $hari }}" {{ old('hari', $jadwal->hari) == $hari ? 'selected' : '' }}>
                        {{ $hari }}</option>
                @endforeach
            </select>
            @error('hari')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label class="form-label">Jam Mulai</label>
            <input type="time" name="jam" class="form-control @error('jam') is-invalid @enderror"
                value="{{ old('jam', \Carbon\Carbon::parse($jadwal->jam)->format('H:i')) }}">
            @error('jam')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
            <div class="form-text">Jam selesai akan dihitung otomatis: 1 SKS = 50 menit.</div>
        </div>

        <button type="submit" class="btn btn-primary">Update</button>
        <a href="{{ route('jadwal.index') }}" class="btn btn-secondary">Batal</a>
    </form>
@endsection
