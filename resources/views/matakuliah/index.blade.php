@extends('layouts.app')
@section('title', 'Data Mata Kuliah')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h3>Data Mata Kuliah</h3>
    <a href="{{ route('matakuliah.create') }}" class="btn btn-primary">+ Tambah Mata Kuliah</a>
</div>

<table class="table table-bordered table-striped bg-white">
    <thead class="table-dark">
        <tr>
            <th>Kode</th>
            <th>Nama Mata Kuliah</th>
            <th>SKS</th>
            <th width="150">Aksi</th>
        </tr>
    </thead>
    <tbody>
        @forelse($matakuliah as $mk)
        <tr>
            <td>{{ $mk->kode_matakuliah }}</td>
            <td>{{ $mk->nama_matakuliah }}</td>
            <td>{{ $mk->sks }}</td>
            <td>
                <a href="{{ route('matakuliah.edit', $mk->kode_matakuliah) }}" class="btn btn-sm btn-warning">Edit</a>
                <form action="{{ route('matakuliah.destroy', $mk->kode_matakuliah) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin hapus data ini?')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-sm btn-danger">Hapus</button>
                </form>
            </td>
        </tr>
        @empty
        <tr><td colspan="4" class="text-center">Belum ada data mata kuliah.</td></tr>
        @endforelse
    </tbody>
</table>
@endsection