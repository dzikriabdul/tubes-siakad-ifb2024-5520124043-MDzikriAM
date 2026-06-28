<?php
namespace App\Http\Controllers;

use App\Models\Mahasiswa;
use App\Models\User;
use Illuminate\Http\Request;

class MahasiswaController extends Controller
{
    public function index()
    {
        $mahasiswa = Mahasiswa::with('user')->get();

        // Daftar user mahasiswa yang belum punya NPM (untuk dropdown assign)
        $userTanpaNpm = User::where('role', 'mahasiswa')->whereNull('npm')->get();

        return view('mahasiswa.index', compact('mahasiswa', 'userTanpaNpm'));
    }

    public function create()
    {
        return view('mahasiswa.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'npm'   => 'required|size:10|unique:mahasiswa,npm',
            'nama'  => 'required|string|max:50',
            'kelas' => 'required|size:1',
        ]);

        Mahasiswa::create($request->only('npm', 'nama', 'kelas'));
        return redirect()->route('mahasiswa.index')->with('success', 'Data mahasiswa berhasil ditambahkan.');
    }

    public function edit(string $npm)
    {
        $mahasiswa = Mahasiswa::findOrFail($npm);
        return view('mahasiswa.edit', compact('mahasiswa'));
    }

    public function update(Request $request, string $npm)
    {
        $request->validate([
            'nama'  => 'required|string|max:50',
            'kelas' => 'required|size:1',
        ]);

        Mahasiswa::findOrFail($npm)->update($request->only('nama', 'kelas'));
        return redirect()->route('mahasiswa.index')->with('success', 'Data mahasiswa berhasil diupdate.');
    }

    public function destroy(string $npm)
    {
        Mahasiswa::findOrFail($npm)->delete();
        return redirect()->route('mahasiswa.index')->with('success', 'Data mahasiswa berhasil dihapus.');
    }

    // Assign NPM ke user mahasiswa
    public function assignUser(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'npm'     => 'required|exists:mahasiswa,npm',
        ]);

        // Cek kalau NPM sudah dipakai user lain
        $sudahDipakai = User::where('npm', $request->npm)->exists();
        if ($sudahDipakai) {
            return redirect()->route('mahasiswa.index')->with('error', 'NPM ini sudah terhubung dengan akun lain.');
        }

        User::where('id', $request->user_id)->update(['npm' => $request->npm]);

        return redirect()->route('mahasiswa.index')->with('success', 'Akun berhasil dihubungkan dengan data mahasiswa.');
    }

    // Putus relasi NPM dari user
    public function unassignUser(string $npm)
    {
        User::where('npm', $npm)->update(['npm' => null]);
        return redirect()->route('mahasiswa.index')->with('success', 'Relasi akun berhasil diputus.');
    }
}