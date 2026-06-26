@extends('layouts.app')
@section('title', 'Data KRS')

@section('content')
<h3 class="mb-4">Kartu Rencana Studi (Semua Mahasiswa)</h3>

<table class="table table-bordered table-striped bg-white">
    <thead class="table-dark">
        <tr>
            <th>NPM</th>
            <th>Nama Mahasiswa</th>
            <th>Mata Kuliah</th>
            <th>SKS</th>
        </tr>
    </thead>
    <tbody>
        @forelse($krs as $k)
        <tr>
            <td>{{ $k->npm }}</td>
            <td>{{ $k->mahasiswa->nama ?? '-' }}</td>
            <td>{{ $k->matakuliah->nama_matakuliah ?? '-' }}</td>
            <td>{{ $k->matakuliah->sks ?? '-' }}</td>
        </tr>
        @empty
        <tr><td colspan="4" class="text-center">Belum ada data KRS.</td></tr>
        @endforelse
    </tbody>
</table>
@endsection