<?php
namespace App\Http\Controllers;

use App\Models\Jadwal;
use App\Models\Dosen;
use App\Models\MataKuliah;
use App\Models\Mahasiswa;
use Illuminate\Http\Request;
use Carbon\Carbon;

class JadwalController extends Controller
{
    public function index()
    {
        $jadwal = Jadwal::with(['dosen', 'matakuliah'])->get();
        return view('jadwal.index', compact('jadwal'));
    }

    public function create()
    {
        $dosen      = Dosen::all();
        $matakuliah = MataKuliah::all();
        return view('jadwal.create', compact('dosen', 'matakuliah'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'kode_matakuliah' => 'required|exists:matakuliah,kode_matakuliah',
            'nidn'            => 'required|exists:dosen,nidn',
            'kelas'           => 'required|size:1',
            'hari'            => 'required|string',
            'jam'             => 'required',
        ]);

        $matakuliah  = MataKuliah::findOrFail($request->kode_matakuliah);
        $jamMulai    = Carbon::parse($request->jam);
        $jamSelesai  = $jamMulai->copy()->addMinutes($matakuliah->sks * 50);

        Jadwal::create([
            'kode_matakuliah' => $request->kode_matakuliah,
            'nidn'            => $request->nidn,
            'kelas'           => $request->kelas,
            'hari'            => $request->hari,
            'jam'             => $jamMulai->format('H:i:s'),
            'jam_selesai'     => $jamSelesai->format('H:i:s'),
        ]);

        return redirect()->route('jadwal.index')->with('success', 'Jadwal berhasil ditambahkan.');
    }

    public function edit(string $id)
    {
        $jadwal     = Jadwal::findOrFail($id);
        $dosen      = Dosen::all();
        $matakuliah = MataKuliah::all();
        return view('jadwal.edit', compact('jadwal', 'dosen', 'matakuliah'));
    }

    public function update(Request $request, string $id)
    {
        $request->validate([
            'kode_matakuliah' => 'required|exists:matakuliah,kode_matakuliah',
            'nidn'            => 'required|exists:dosen,nidn',
            'kelas'           => 'required|size:1',
            'hari'            => 'required|string',
            'jam'             => 'required',
        ]);

        $matakuliah  = MataKuliah::findOrFail($request->kode_matakuliah);
        $jamMulai    = Carbon::parse($request->jam);
        $jamSelesai  = $jamMulai->copy()->addMinutes($matakuliah->sks * 50);

        Jadwal::findOrFail($id)->update([
            'kode_matakuliah' => $request->kode_matakuliah,
            'nidn'            => $request->nidn,
            'kelas'           => $request->kelas,
            'hari'            => $request->hari,
            'jam'             => $jamMulai->format('H:i:s'),
            'jam_selesai'     => $jamSelesai->format('H:i:s'),
        ]);

        return redirect()->route('jadwal.index')->with('success', 'Jadwal berhasil diupdate.');
    }

    public function destroy(string $id)
    {
        Jadwal::findOrFail($id)->delete();
        return redirect()->route('jadwal.index')->with('success', 'Jadwal berhasil dihapus.');
    }

    // Mahasiswa: lihat jadwal sesuai kelas sendiri
    public function myJadwal()
    {
        $npm = auth()->user()->npm;

        if (!$npm) {
            return redirect()->route('dashboard')->with('error', 'Akun kamu belum terhubung dengan data mahasiswa. Hubungi admin.');
        }

        $mahasiswa = Mahasiswa::findOrFail($npm);

        $jadwal = Jadwal::with(['dosen', 'matakuliah'])
                         ->where('kelas', $mahasiswa->kelas)
                         ->get();

        return view('jadwal.my', compact('jadwal', 'mahasiswa'));
    }
}