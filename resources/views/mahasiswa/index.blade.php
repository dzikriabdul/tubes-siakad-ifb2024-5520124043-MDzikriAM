@extends('layouts.app')
@section('title', 'Data Mahasiswa')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h3>Data Mahasiswa</h3>
    <a href="{{ route('mahasiswa.create') }}" class="btn btn-primary">+ Tambah Mahasiswa</a>
</div>

<div class="table-responsive">
    <table class="table table-bordered table-striped bg-white">
        <thead class="table-dark">
            <tr>
                <th>NPM</th>
                <th>Nama</th>
                <th>Kelas</th>
                <th>Akun Terhubung</th>
                <th width="220">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($mahasiswa as $m)
            <tr>
                <td>{{ $m->npm }}</td>
                <td>{{ $m->nama }}</td>
                <td>{{ $m->kelas ?? '-' }}</td>
                <td>
                    @if($m->user)
                        <span class="badge bg-success">{{ $m->user->email }}</span>
                    @else
                        <span class="badge bg-secondary">Belum terhubung</span>
                    @endif
                </td>
                <td>
                    <a href="{{ route('mahasiswa.edit', $m->npm) }}" class="btn btn-sm btn-warning">Edit</a>

                    @if($m->user)
                        <form action="{{ route('mahasiswa.unassign-user', $m->npm) }}" method="POST" class="d-inline" onsubmit="return confirm('Putuskan relasi akun ini dari data mahasiswa?')">
                            @csrf
                            <button type="submit" class="btn btn-sm btn-outline-secondary">Putus Akun</button>
                        </form>
                    @endif

                    <form action="{{ route('mahasiswa.destroy', $m->npm) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin hapus data ini?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-danger">Hapus</button>
                    </form>
                </td>
            </tr>
            @empty
            <tr><td colspan="5" class="text-center">Belum ada data mahasiswa.</td></tr>
            @endforelse
        </tbody>
    </table>
</div>

<hr class="my-4">

<h5 class="mb-3">Hubungkan Akun Mahasiswa Baru ke Data Mahasiswa</h5>

@if($userTanpaNpm->isEmpty())
    <p class="text-muted">Semua akun mahasiswa sudah terhubung dengan data mahasiswa.</p>
@else
    <div class="card shadow-sm" style="max-width: 600px;">
        <div class="card-body">
            <form action="{{ route('mahasiswa.assign-user') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label class="form-label">Pilih Akun (belum terhubung)</label>
                    <select name="user_id" class="form-select @error('user_id') is-invalid @enderror" required>
                        <option value="">-- Pilih Akun --</option>
                        @foreach($userTanpaNpm as $u)
                            <option value="{{ $u->id }}">{{ $u->name }} ({{ $u->email }})</option>
                        @endforeach
                    </select>
                    @error('user_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label">Hubungkan ke NPM</label>
                    <select name="npm" class="form-select @error('npm') is-invalid @enderror" required>
                        <option value="">-- Pilih NPM --</option>
                        @foreach($mahasiswa as $m)
                            @if(!$m->user)
                                <option value="{{ $m->npm }}">{{ $m->npm }} - {{ $m->nama }}</option>
                            @endif
                        @endforeach
                    </select>
                    @error('npm') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                <button type="submit" class="btn btn-success">Hubungkan Akun</button>
            </form>
        </div>
    </div>
@endif
@endsection