@extends('layouts.app')
@section('title', 'Data Mahasiswa')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h3>Data Mahasiswa</h3>
    <a href="{{ route('mahasiswa.create') }}" class="btn btn-primary">+ Tambah Mahasiswa</a>
</div>

<table class="table table-bordered table-striped bg-white">
    <thead class="table-dark">
        <tr>
            <th>NPM</th>
            <th>Nama</th>
            <th width="150">Aksi</th>
        </tr>
    </thead>
    <tbody>
        @forelse($mahasiswa as $m)
        <tr>
            <td>{{ $m->npm }}</td>
            <td>{{ $m->nama }}</td>
            <td>
                <a href="{{ route('mahasiswa.edit', $m->npm) }}" class="btn btn-sm btn-warning">Edit</a>
                <form action="{{ route('mahasiswa.destroy', $m->npm) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin hapus data ini?')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-sm btn-danger">Hapus</button>
                </form>
            </td>
        </tr>
        @empty
        <tr><td colspan="3" class="text-center">Belum ada data mahasiswa.</td></tr>
        @endforelse
    </tbody>
</table>
@endsection