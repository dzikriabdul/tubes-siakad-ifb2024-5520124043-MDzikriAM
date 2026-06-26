<?php
namespace App\Http\Controllers;

use App\Models\Mahasiswa;
use Illuminate\Http\Request;

class MahasiswaController extends Controller
{
    public function index()
    {
        $mahasiswa = Mahasiswa::all();
        return view('mahasiswa.index', compact('mahasiswa'));
    }

    public function create()
    {
        return view('mahasiswa.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'npm'  => 'required|size:10|unique:mahasiswa,npm',
            'nama' => 'required|string|max:50',
        ]);

        Mahasiswa::create($request->only('npm', 'nama'));
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
            'nama' => 'required|string|max:50',
        ]);

        Mahasiswa::findOrFail($npm)->update($request->only('nama'));
        return redirect()->route('mahasiswa.index')->with('success', 'Data mahasiswa berhasil diupdate.');
    }

    public function destroy(string $npm)
    {
        Mahasiswa::findOrFail($npm)->delete();
        return redirect()->route('mahasiswa.index')->with('success', 'Data mahasiswa berhasil dihapus.');
    }
}