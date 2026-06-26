<?php
namespace App\Http\Controllers;

use App\Models\MataKuliah;
use Illuminate\Http\Request;

class MataKuliahController extends Controller
{
    public function index()
    {
        $matakuliah = MataKuliah::all();
        return view('matakuliah.index', compact('matakuliah'));
    }

    public function create()
    {
        return view('matakuliah.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'kode_matakuliah'  => 'required|max:8|unique:matakuliah,kode_matakuliah',
            'nama_matakuliah'  => 'required|string|max:50',
            'sks'              => 'required|integer|min:1|max:6',
        ]);

        MataKuliah::create($request->only('kode_matakuliah', 'nama_matakuliah', 'sks'));
        return redirect()->route('matakuliah.index')->with('success', 'Mata kuliah berhasil ditambahkan.');
    }

    public function edit(string $kode)
    {
        $matakuliah = MataKuliah::findOrFail($kode);
        return view('matakuliah.edit', compact('matakuliah'));
    }

    public function update(Request $request, string $kode)
    {
        $request->validate([
            'nama_matakuliah' => 'required|string|max:50',
            'sks'             => 'required|integer|min:1|max:6',
        ]);

        MataKuliah::findOrFail($kode)->update($request->only('nama_matakuliah', 'sks'));
        return redirect()->route('matakuliah.index')->with('success', 'Mata kuliah berhasil diupdate.');
    }

    public function destroy(string $kode)
    {
        MataKuliah::findOrFail($kode)->delete();
        return redirect()->route('matakuliah.index')->with('success', 'Mata kuliah berhasil dihapus.');
    }
}