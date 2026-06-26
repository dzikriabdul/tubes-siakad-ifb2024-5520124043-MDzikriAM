<?php
namespace App\Http\Controllers;

use App\Models\Dosen;
use App\Models\Mahasiswa;
use App\Models\MataKuliah;
use App\Models\Jadwal;
use App\Models\Krs;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'dosen'      => Dosen::count(),
            'mahasiswa'  => Mahasiswa::count(),
            'matakuliah' => MataKuliah::count(),
            'jadwal'     => Jadwal::count(),
        ];

        return view('dashboard', compact('stats'));
    }
}