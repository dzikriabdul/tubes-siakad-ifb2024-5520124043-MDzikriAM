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

//debug
Route::get('/debug-clear-cache', function () {
    \Illuminate\Support\Facades\Artisan::call('route:clear');
    \Illuminate\Support\Facades\Artisan::call('config:clear');
    \Illuminate\Support\Facades\Artisan::call('cache:clear');
    \Illuminate\Support\Facades\Artisan::call('view:clear');

    return 'Cache cleared successfully!';
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