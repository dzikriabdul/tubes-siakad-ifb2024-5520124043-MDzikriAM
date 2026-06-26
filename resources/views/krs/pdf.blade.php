<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>KRS - {{ $mahasiswa->nama }}</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
            color: #222;
        }
        .header {
            text-align: center;
            margin-bottom: 20px;
            border-bottom: 2px solid #0d6efd;
            padding-bottom: 10px;
        }
        .header h2 {
            margin: 0;
            color: #0d6efd;
        }
        .header p {
            margin: 2px 0;
            font-size: 11px;
            color: #555;
        }
        .info-table {
            width: 100%;
            margin-bottom: 20px;
        }
        .info-table td {
            padding: 3px 0;
        }
        .info-table td:first-child {
            width: 120px;
            font-weight: bold;
        }
        table.data {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }
        table.data th, table.data td {
            border: 1px solid #999;
            padding: 6px 8px;
            text-align: left;
        }
        table.data th {
            background-color: #0d6efd;
            color: #fff;
        }
        table.data tr:nth-child(even) {
            background-color: #f2f2f2;
        }
        .total-row td {
            font-weight: bold;
            background-color: #e9ecef;
        }
        .footer {
            margin-top: 30px;
            font-size: 10px;
            color: #777;
            text-align: right;
        }
    </style>
</head>
<body>

    <div class="header">
        <h2>KARTU RENCANA STUDI (KRS)</h2>
        <p>Sistem Informasi Akademik</p>
    </div>

    <table class="info-table">
        <tr>
            <td>NPM</td>
            <td>: {{ $mahasiswa->npm }}</td>
        </tr>
        <tr>
            <td>Nama</td>
            <td>: {{ $mahasiswa->nama }}</td>
        </tr>
        <tr>
            <td>Kelas</td>
            <td>: {{ $mahasiswa->kelas }}</td>
        </tr>
        <tr>
            <td>Tanggal Cetak</td>
            <td>: {{ now()->format('d-m-Y H:i') }} WIB</td>
        </tr>
    </table>

    <table class="data">
        <thead>
            <tr>
                <th width="40">No</th>
                <th>Kode</th>
                <th>Mata Kuliah</th>
                <th width="60">SKS</th>
            </tr>
        </thead>
        <tbody>
            @forelse($krs as $i => $k)
            <tr>
                <td>{{ $i + 1 }}</td>
                <td>{{ $k->matakuliah->kode_matakuliah ?? '-' }}</td>
                <td>{{ $k->matakuliah->nama_matakuliah ?? '-' }}</td>
                <td>{{ $k->matakuliah->sks ?? '-' }}</td>
            </tr>
            @empty
            <tr>
                <td colspan="4" style="text-align: center;">Belum ada mata kuliah diambil.</td>
            </tr>
            @endforelse
            <tr class="total-row">
                <td colspan="3" style="text-align: right;">Total SKS</td>
                <td>{{ $totalSks }}</td>
            </tr>
        </tbody>
    </table>

    <div class="footer">
        Dokumen ini dicetak otomatis oleh sistem SIAKAD.
    </div>

</body>
</html>