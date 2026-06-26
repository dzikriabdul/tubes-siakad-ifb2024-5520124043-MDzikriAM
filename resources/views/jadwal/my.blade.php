@extends('layouts.app')
@section('title', 'Jadwal Saya')

@section('content')
    <h3 class="mb-4">Jadwal Perkuliahan — Kelas {{ $mahasiswa->kelas }}</h3>

    <table class="table table-bordered table-striped bg-white">
        <thead class="table-dark">
            <tr>
                <th>Mata Kuliah</th>
                <th>Dosen</th>
                <th>Kelas</th>
                <th>Hari</th>
                <th>Jam</th>
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
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="text-center">Belum ada jadwal tersedia.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
@endsection
