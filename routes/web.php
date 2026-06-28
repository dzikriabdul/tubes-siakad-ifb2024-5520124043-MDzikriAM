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

Route::get('/debug-seed-mahasiswa', function () {
    \App\Models\Mahasiswa::insert([
        ['npm' => '2024010001', 'nama' => 'Muhammad Dzikri Abdul Muti', 'kelas' => 'A', 'created_at' => now(), 'updated_at' => now()],
        ['npm' => '2024010002', 'nama' => 'Abdurahman', 'kelas' => 'B', 'created_at' => now(), 'updated_at' => now()],
        ['npm' => '2024010003', 'nama' => 'RafiLadzuardi', 'kelas' => 'C', 'created_at' => now(), 'updated_at' => now()],
    ]);

    $check = \App\Models\Mahasiswa::all(['npm', 'nama', 'kelas'])->toArray();
    dd($check);
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