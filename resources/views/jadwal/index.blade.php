@extends('layouts.app')
@section('title', 'Data Jadwal')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h3>Data Jadwal Perkuliahan</h3>
        <a href="{{ route('jadwal.create') }}" class="btn btn-primary">+ Tambah Jadwal</a>
    </div>

    <div class="table-responsive">
        <table class="table table-bordered table-striped bg-white">
            ...
        </table>
    </div>
    
    <thead class="table-dark">
        <tr>
            <th>Mata Kuliah</th>
            <th>Dosen</th>
            <th>Kelas</th>
            <th>Hari</th>
            <th>Jam</th>
            <th width="150">Aksi</th>
        </tr>
    </thead>
    <tbody>
        @forelse($jadwal as $j)
            <tr>
                <td>{{ $j->matakuliah->nama_matakuliah ?? '-' }}</td>
                <td>{{ $j->dosen->nama ?? '-' }}</td>
                <td>{{ $j->kelas }}</td>
                <td>{{ $j->hari }}</td>
                <td>
                    {{ \Carbon\Carbon::parse($j->jam)->format('H:i') }}
                    @if ($j->jam_selesai)
                        - {{ \Carbon\Carbon::parse($j->jam_selesai)->format('H:i') }}
                    @endif
                    WIB
                </td>
                <td>
                    <a href="{{ route('jadwal.edit', $j->id) }}" class="btn btn-sm btn-warning">Edit</a>
                    <form action="{{ route('jadwal.destroy', $j->id) }}" method="POST" class="d-inline"
                        onsubmit="return confirm('Yakin hapus jadwal ini?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-danger">Hapus</button>
                    </form>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="6" class="text-center">Belum ada data jadwal.</td>
            </tr>
        @endforelse
    </tbody>
    </table>
@endsection
