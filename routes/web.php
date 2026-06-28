<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DosenController;
use App\Http\Controllers\MahasiswaController;
use App\Http\Controllers\MataKuliahController;
use App\Http\Controllers\JadwalController;
use App\Http\Controllers\KrsController;

// Redirect root ke login
Route::get('/', function () {
    return redirect('/login');
});

Route::get('/debug-seed-all', function () {
    $result = [];

    // Admin (kalau belum ada)
    if (!\App\Models\User::where('email', 'admin@siakad.com')->exists()) {
        \App\Models\User::create([
            'name' => 'Admin SIAKAD',
            'email' => 'admin@siakad.com',
            'password' => \Illuminate\Support\Facades\Hash::make('password'),
            'role' => 'admin',
        ]);
        $result['admin'] = 'created';
    } else {
        $result['admin'] = 'already exists';
    }

    // Dosen
    if (\App\Models\Dosen::count() === 0) {
        \App\Models\Dosen::insert([
            ['nidn' => '0101019001', 'nama' => 'Tarmin Abdulghani ST.,M.T', 'created_at' => now(), 'updated_at' => now()],
            ['nidn' => '0202029002', 'nama' => 'Siti Nazilah ST.,M.Kom', 'created_at' => now(), 'updated_at' => now()],
            ['nidn' => '0303039003', 'nama' => 'Siti Sarah ST.,M.Kom', 'created_at' => now(), 'updated_at' => now()],
        ]);
        $result['dosen'] = 'seeded';
    } else {
        $result['dosen'] = 'already has data';
    }

    // Mata Kuliah
    if (\App\Models\MataKuliah::count() === 0) {
        \App\Models\MataKuliah::insert([
            ['kode_matakuliah' => 'IF001', 'nama_matakuliah' => 'Pemrograman Web', 'sks' => 3, 'created_at' => now(), 'updated_at' => now()],
            ['kode_matakuliah' => 'IF002', 'nama_matakuliah' => 'Basis Data', 'sks' => 3, 'created_at' => now(), 'updated_at' => now()],
            ['kode_matakuliah' => 'IF003', 'nama_matakuliah' => 'Jaringan Komputer', 'sks' => 2, 'created_at' => now(), 'updated_at' => now()],
            ['kode_matakuliah' => 'IF004', 'nama_matakuliah' => 'Rekayasa Perangkat Lunak', 'sks' => 3, 'created_at' => now(), 'updated_at' => now()],
        ]);
        $result['matakuliah'] = 'seeded';
    } else {
        $result['matakuliah'] = 'already has data';
    }

    $result['final_count'] = [
        'dosen' => \App\Models\Dosen::count(),
        'matakuliah' => \App\Models\MataKuliah::count(),
        'mahasiswa' => \App\Models\Mahasiswa::count(),
        'users' => \App\Models\User::count(),
    ];

    dd($result);
});

// Route setelah login
Route::middleware(['auth'])->group(function () {

    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Route khusus Mahasiswa (didaftarkan LEBIH DULU agar tidak ketabrak resource route admin)
    Route::middleware(['role:mahasiswa'])->group(function () {
        Route::get('jadwal/my', [JadwalController::class, 'myJadwal'])->name('jadwal.my');
        Route::get('krs/my', [KrsController::class, 'myKrs'])->name('krs.my');
        Route::post('krs', [KrsController::class, 'store'])->name('krs.store');
        Route::delete('krs/{id}', [KrsController::class, 'destroy'])->name('krs.destroy');
        Route::get('krs/export/pdf', [KrsController::class, 'exportPdf'])->name('krs.export.pdf');
    });

    // Route khusus Admin
    Route::middleware(['role:admin'])->group(function () {
        Route::resource('dosen', DosenController::class);
        Route::resource('mahasiswa', MahasiswaController::class);
        Route::resource('matakuliah', MataKuliahController::class);
        Route::resource('jadwal', JadwalController::class);

        // Admin lihat KRS semua mahasiswa
        Route::get('krs', [KrsController::class, 'index'])->name('krs.index');
    });

});

require __DIR__.'/auth.php';