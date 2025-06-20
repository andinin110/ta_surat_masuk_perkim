<?php

use App\Http\Controllers\BidangController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DataInstansiController;
use App\Http\Controllers\DisposisiController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SubBidangController;
use App\Http\Controllers\SuratController;
use App\Http\Controllers\SuratKeluarController;
use App\Http\Controllers\UserDashboardController;
use App\Http\Controllers\DataPeranController;
use App\Http\Controllers\UserDisposisiController;
use App\Http\Middleware\CheckAdminBidang;
use App\Http\Middleware\CheckUserRoleAndBidang;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return redirect()->route('login');
});





Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';

Route::middleware(['auth', CheckAdminBidang::class])->group(function () {
    Route::get('/bidang', [BidangController::class, 'index'])->name('bidang.index');
    Route::post('/bidang/store', [BidangController::class, 'store'])->name('bidang.store');
    Route::put('/bidang/update/{id}', [BidangController::class, 'update'])->name('bidang.update');
    Route::delete('/bidang/delete/{id}', [BidangController::class, 'destroy'])->name('bidang.destroy');

    Route::get('/disposisi', [DisposisiController::class, 'index'])->name('disposisi.index');
    Route::post('/disposisi/store', [DisposisiController::class, 'store'])->name('disposisi.store');
    Route::put('/disposisi/update/{id}', [DisposisiController::class, 'update'])->name('disposisi.update');
    Route::delete('/disposisi/delete/{id}', [DisposisiController::class, 'destroy'])->name('disposisi.destroy');

    Route::get('/surat', [SuratController::class, 'index'])->name('surat.index');
    Route::post('/surat/store', [SuratController::class, 'store'])->name('surat.store');
    Route::put('/surat/update/{id}', [SuratController::class, 'update'])->name('surat.update');
    Route::delete('/surat/delete/{id}', [SuratController::class, 'destroy'])->name('surat.destroy');

    Route::get('/suratkeluar', [SuratKeluarController::class, 'index'])->name('surat-keluar.index');
    Route::post('/suratkeluar/store', [SuratKeluarController::class, 'store'])->name('surat-keluar.store');
    Route::put('/suratkeluar/update/{id}', [SuratKeluarController::class, 'update'])->name('surat-keluar.edit');
    Route::delete('/suratkeluar/delete/{id}', [SuratKeluarController::class, 'destroy'])->name('surat-keluar.destroy');

    Route::get('/dataperan', [DataPeranController::class, 'index'])->name('dataperan.index');
    Route::post('/dataperan/store', [DataPeranController::class, 'store'])->name('dataperan.store');
    Route::put('/dataperan/update/{id}', [DataPeranController::class, 'update'])->name('dataperan.update');
    Route::delete('/dataperan/delete/{id}', [DataPeranController::class, 'destroy'])->name('dataperan.destroy');

    Route::get('/instansi', [DataInstansiController::class, 'index'])->name('instansi.index');
    Route::post('/instansi/store', [DataInstansiController::class, 'store'])->name('instansi.store');
    Route::put('/instansi/update/{id}', [DataInstansiController::class, 'update'])->name('instansi.update');
    Route::delete('/instansi/delete/{id}', [DataInstansiController::class, 'destroy'])->name('instansi.destroy');

    Route::get('/peran', [DataPeranController::class, 'index'])->name('peran.index');
    Route::post('/peran/store', [DataPeranController::class, 'store'])->name('peran.store');
    Route::put('/peran/update/{id}', [DataPeranController::class, 'update'])->name('peran.update');
    Route::delete('/peran/delete/{id}', [DataPeranController::class, 'destroy'])->name('peran.destroy');

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard.index');
});


Route::middleware(['auth', CheckUserRoleAndBidang::class])->group(function () {
    Route::get('/dashboard-user', [UserDashboardController::class, 'index'])->name('userdashboard.index');
    Route::get('/disposisi-user', [UserDisposisiController::class, 'index'])->name('userdisposisi.index');
    Route::post('/disposisi/update-status/{id}', [UserDisposisiController::class, 'updateStatus'])->name('disposisi.updateStatus');
});
