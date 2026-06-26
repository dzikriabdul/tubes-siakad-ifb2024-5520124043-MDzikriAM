@extends('layouts.app')
@section('title', 'Data Dosen')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h3>Data Dosen</h3>
    <a href="{{ route('dosen.create') }}" class="btn btn-primary">+ Tambah Dosen</a>
</div>

<table class="table table-bordered table-striped bg-white">
    <thead class="table-dark">
        <tr>
            <th>NIDN</th>
            <th>Nama</th>
            <th width="150">Aksi</th>
        </tr>
    </thead>
    <tbody>
        @forelse($dosen as $d)
        <tr>
            <td>{{ $d->nidn }}</td>
            <td>{{ $d->nama }}</td>
            <td>
                <a href="{{ route('dosen.edit', $d->nidn) }}" class="btn btn-sm btn-warning">Edit</a>
                <form action="{{ route('dosen.destroy', $d->nidn) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin hapus data ini?')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-sm btn-danger">Hapus</button>
                </form>
            </td>
        </tr>
        @empty
        <tr><td colspan="3" class="text-center">Belum ada data dosen.</td></tr>
        @endforelse
    </tbody>
</table>
@endsection