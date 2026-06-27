<?php
namespace App\Http\Controllers;

use App\Models\Krs;
use App\Models\Mahasiswa;
use App\Models\MataKuliah;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class KrsController extends Controller
{
    // Admin: lihat semua KRS
    public function index()
    {
        $krs = Krs::with(['mahasiswa', 'matakuliah'])->get();
        return view('krs.index', compact('krs'));
    }

    // Mahasiswa: lihat KRS sendiri
    public function myKrs()
    {
        $npm = auth()->user()->npm;

    dd([
        'user_id' => auth()->id(),
        'email' => auth()->user()->email,
        'npm' => $npm,
        'npm_type' => gettype($npm),
    ]);
        if (!$npm) {
            return redirect()->route('dashboard')->with('error', 'Akun kamu belum terhubung dengan data mahasiswa. Hubungi admin.');
        }

        $mahasiswa  = Mahasiswa::findOrFail($npm);
        $krs        = Krs::with('matakuliah')->where('npm', $npm)->get();
        $matakuliah = MataKuliah::all();

        return view('krs.my', compact('krs', 'matakuliah', 'mahasiswa'));
    }

    // Mahasiswa: ambil mata kuliah
    public function store(Request $request)
    {
        $npm = auth()->user()->npm;

        if (!$npm) {
            return redirect()->route('dashboard')->with('error', 'Akun kamu belum terhubung dengan data mahasiswa. Hubungi admin.');
        }

        $request->validate([
            'kode_matakuliah' => 'required|exists:matakuliah,kode_matakuliah',
        ]);

        $exists = Krs::where('npm', $npm)
                     ->where('kode_matakuliah', $request->kode_matakuliah)
                     ->exists();

        if ($exists) {
            return redirect()->route('krs.my')->with('error', 'Mata kuliah sudah ada di KRS.');
        }

        Krs::create([
            'npm'             => $npm,
            'kode_matakuliah' => $request->kode_matakuliah,
        ]);

        return redirect()->route('krs.my')->with('success', 'Mata kuliah berhasil ditambahkan ke KRS.');
    }

    // Mahasiswa: drop mata kuliah
    public function destroy(string $id)
    {
        Krs::findOrFail($id)->delete();
        return redirect()->route('krs.my')->with('success', 'Mata kuliah berhasil di-drop dari KRS.');
    }

    // Mahasiswa: export KRS ke PDF
    public function exportPdf()
    {
        $npm = auth()->user()->npm;

        if (!$npm) {
            return redirect()->route('dashboard')->with('error', 'Akun kamu belum terhubung dengan data mahasiswa. Hubungi admin.');
        }

        $mahasiswa = Mahasiswa::findOrFail($npm);
        $krs       = Krs::with('matakuliah')->where('npm', $npm)->get();
        $totalSks  = $krs->sum(fn($k) => $k->matakuliah->sks ?? 0);

        $pdf = Pdf::loadView('krs.pdf', compact('mahasiswa', 'krs', 'totalSks'));

        return $pdf->download('KRS_' . $mahasiswa->npm . '_' . $mahasiswa->nama . '.pdf');
    }
}