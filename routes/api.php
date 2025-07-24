<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\SuratMasukController;
use App\Http\Controllers\API\SuratKeluarController;
use App\Http\Controllers\API\DisposisiController;

Route::get('/surat', [SuratMasukController::class, 'index']);
Route::get('/surat/{id}', [SuratMasukController::class, 'show']);
Route::post('/surat', [SuratMasukController::class, 'store']);
Route::put('/surat/{id}', [SuratMasukController::class, 'update']);
Route::delete('/surat/{id}', [SuratMasukController::class, 'destroy']);

Route::get('/surat-keluar', [SuratKeluarController::class, 'index']);
Route::get('/surat-keluar/{id}', [SuratKeluarController::class, 'show']);
Route::post('/surat-keluar', [SuratKeluarController::class, 'store']);
Route::put('/surat-keluar/{id}', [SuratKeluarController::class, 'update']);
Route::delete('/surat-keluar/{id}', [SuratKeluarController::class, 'destroy']);

Route::get('/disposisi', [DisposisiController::class, 'index']);
Route::get('/disposisi/{id}', [DisposisiController::class, 'show']);
Route::post('/disposisi', [DisposisiController::class, 'store']);
Route::put('/disposisi/{id}', [DisposisiController::class, 'update']);
Route::delete('/disposisi/{id}', [DisposisiController::class, 'destroy']);
