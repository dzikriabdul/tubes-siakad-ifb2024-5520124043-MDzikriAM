@extends('layouts.app')
@section('title', 'KRS Saya')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h3 class="mb-0">Kartu Rencana Studi Saya</h3>
    <a href="{{ route('krs.export.pdf') }}" class="btn btn-success btn-sm">
        <i class="bi bi-file-earmark-pdf"></i> Export PDF
    </a>
</div>    

<div class="row">
    <div class="col-md-5">
        <div class="card shadow-sm">
            <div class="card-body">
                <h5 class="card-title">Ambil Mata Kuliah</h5>
                <form action="{{ route('krs.store') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <select name="kode_matakuliah" class="form-select @error('kode_matakuliah') is-invalid @enderror">
                            <option value="">-- Pilih Mata Kuliah --</option>
                            @foreach($matakuliah as $mk)
                                <option value="{{ $mk->kode_matakuliah }}">
                                    {{ $mk->nama_matakuliah }} ({{ $mk->sks }} SKS)
                                </option>
                            @endforeach
                        </select>
                        @error('kode_matakuliah') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                    <button type="submit" class="btn btn-primary w-100">Tambah ke KRS</button>
                </form>
            </div>
        </div>
    </div>

    <div class="col-md-7">
        <h5>Mata Kuliah yang Diambil</h5>
        <table class="table table-bordered table-striped bg-white">
            <thead class="table-dark">
                <tr>
                    <th>Mata Kuliah</th>
                    <th>SKS</th>
                    <th width="100">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @php $totalSks = 0; @endphp
                @forelse($krs as $k)
                @php $totalSks += $k->matakuliah->sks ?? 0; @endphp
                <tr>
                    <td>{{ $k->matakuliah->nama_matakuliah ?? '-' }}</td>
                    <td>{{ $k->matakuliah->sks ?? '-' }}</td>
                    <td>
                        <form action="{{ route('krs.destroy', $k->id) }}" method="POST" onsubmit="return confirm('Yakin hapus mata kuliah ini?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger">Hapus</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr><td colspan="3" class="text-center">Belum ada mata kuliah yang diambil.</td></tr>
                @endforelse
            </tbody>
            @if($krs->count() > 0)
            <tfoot>
                <tr class="table-light fw-bold">
                    <td>Total SKS</td>
                    <td>{{ $totalSks }}</td>
                    <td></td>
                </tr>
            </tfoot>
            @endif
        </table>
    </div>
</div>
@endsection