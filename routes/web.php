<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\InvestorController;
use App\Http\Controllers\LaporannPerkembanganTernakController;
use App\Http\Controllers\LaporanPertumbuhanController;
use App\Http\Controllers\TernakController;
use App\Http\Controllers\InvestasiController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\PenarikanController;
use Illuminate\Support\Facades\Route;

// Rute Default
Route::get('/', function () {
    return view('auth.login');
});

// Rute Dashboard
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Rute untuk Profile yang dilindungi middleware 'auth'
Route::middleware('auth')->group(function () {
    // Mengedit profil pengguna
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Menampilkan data pengguna berdasarkan ID
    Route::get('/user/{id}', [UserController::class, 'show'])->name('user.show');

    // Menyimpan pengguna baru
    Route::post('/user', [UserController::class, 'store'])->name('user.store');

    // Rute untuk dashboard berdasarkan role pengguna
    Route::get('/admin-dashboard', [AdminController::class, 'index'])->middleware('role:admin')->name('admin-dashboard');
    Route::get('/investor-dashboard', [InvestorController::class, 'index'])->middleware('role:investor')->name('investor-dashboard');
    Route::get('/admin/profile', [AdminController::class, 'editProfile'])->name('admin.profile.edit');
    Route::patch('/admin/profile', [AdminController::class, 'updateProfile'])->name('admin.profile.update');


    // iniyang saya ganti
    Route::get('/petani-dashboard', [TernakController::class, 'index'])->middleware('role:petani')->name('petani-dashboard');

    // Route::resource('petani', TernakController::class)->middleware('role:petani');

    // Route::get('/laporan', [LaporannPerkembanganTernakController::class, 'index'])->middleware('role:petani')->name('petani-laporan');
    // Route::post('/laporan', [LaporannPerkembanganTernakController::class, 'store'])->middleware('role:petani')->name('petani-laporan');

});

Route::middleware('auth')->group(function () {
    // Route::get('/laporan-perkembangan', [LaporannPerkembanganTernakController::class, 'index']);
    // Route::post('/laporan', [LaporannPerkembanganTernakController::class, 'store']);
    // Route::get('/laporan-ternak', [LaporannPerkembanganTernakController::class, 'index'])->name('petani-laporan');
    Route::get('/laporan-ternak', [LaporanPertumbuhanController::class, 'index'])->name('petani-laporan');
    Route::get('/laporan-tambah', [LaporanPertumbuhanController::class, 'create'])->name('petani.tambah_laporan');
    Route::get('/laporan/{id}', [LaporanPertumbuhanController::class, 'show'])->name('petani.laporan');
    Route::get('/investor/laporan', [LaporanPertumbuhanController::class, 'indexInvestor'])->name('investor.laporan');
    // Route::post('/laporan-tambah', [LaporanPertumbuhanController::class, 'store'])->name('laporan.store');
    Route::post('/laporan-tambah', [LaporanPertumbuhanController::class, 'store'])->middleware('auth');
    Route::get('/petani/show/{id}', [TernakController::class, 'show'])->name('petani.detail');
    Route::get('/laporan/show/{id}', [LaporanPertumbuhanController::class, 'showdetaillaporan'])->name('petani.laporandetail');
    


    Route::get('/petani/create', [TernakController::class, 'create'])->name('petani.tambah');
    Route::post('/petani/create', [TernakController::class, 'store'])->name('petani.create');
    Route::get('/petani/update/{id}', [TernakController::class, 'edit'])->name('petani.edit');
    Route::put('/petani/update/{id}', [TernakController::class, 'update'])->name('petani.update');
    Route::delete('/petani/delete/{id}', [TernakController::class, 'destroy'])->name('petani.delete');
});

Route::middleware('auth')->group(function () {
    //     //     // Route::get('/laporan-perkembangan', [LaporannPerkembanganTernakController::class, 'index']);
    Route::get('penarikan', [PenarikanController::class, 'penarikan']);
    Route::post('penarikan', [PenarikanController::class, 'penarikanDana']);
    //     //     // Route::get('/laporan-ternak', [LaporannPerkembanganTernakController::class, 'liatlaporan'])->name('petani-laporan');
    //     //     // Route::get('/ternak', [TernakController::class, 'show'])->name('petani.show');
});

Route::middleware('auth')->group(function () {
    // Route::get('/investasi', [InvestasiController::class, 'index'])->name('investasi.index');
    Route::get('/investasi/form/{id}', [InvestasiController::class, 'showForm'])
        ->middleware(['auth', 'role:investor'])
        ->name('investasi.index');
    Route::post('/investasi/{ternak_id}', [InvestasiController::class, 'store'])
        ->middleware(['auth', 'role:investor'])
        ->name('investasi.store');
});




// Rute untuk autentikasi
require __DIR__ . '/auth.php';
