<?php
// use App\Http\Controllers\ProfileController;
use App\Http\Controllers\KaryawanController;
use App\Http\Controllers\KeuanganController;
use App\Http\Controllers\GajiController;
use App\Http\Controllers\PemilikUsahaController;
use App\Http\Controllers\BudidayaController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

// ROUTE MAIN
Route::get('/', function () {
    return view('main.welcome');
});

// ROUTE DASHBOARD (otomatis ke dashboard sesuai role)
Route::get('/dashboard', function () {
    $user = Auth::user();

    if (!$user) {
        return redirect()->route('login');
    }

    // Arahkan ke dashboard sesuai role
    return $user->role === 'admin'
        ? redirect()->route('admin.dashboard')
        : redirect()->route('karyawan.dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// ROUTE DASHBOARD KARYAWAN / USER
Route::middleware(['auth'])->prefix('user')->group(function () {
    Route::get('/dashboard', [KeuanganController::class, 'index'])->name('karyawan.dashboard');
    Route::get('/keuangan', [KeuanganController::class, 'indexKeuangan'])->name('karyawan.keuangan');
    Route::resource('keuangan', KeuanganController::class)->except(['index', 'show']);
    Route::get('/budidaya', [BudidayaController::class, 'index'])->name('karyawan.budidaya');
    Route::resource('budidaya', BudidayaController::class)->except(['index', 'show']);
    Route::get('/gaji', [GajiController::class, 'index'])->name('karyawan.gaji');
    Route::resource('gaji', GajiController::class)->except(['index', 'show']);
    Route::get('/karyawan', [KaryawanController::class, 'index'])->name('karyawan.karyawan');
    Route::resource('karyawan', KaryawanController::class)->except(['index', 'show']);
    

});

// ROUTE DASHBOARD ADMIN / PEMILIK
Route::middleware(['auth'])->prefix('admin')->group(function () {
    Route::get('/dashboard', [PemilikUsahaController::class, 'index'])->name('admin.dashboard');
});



// LOGIN & REGISTER
require __DIR__.'/auth.php';
