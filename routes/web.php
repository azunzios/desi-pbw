<?php

use App\Http\Controllers\PublikasiController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect('/publikasi');
});

Route::get('/publikasi', [PublikasiController::class, 'index']);
Route::get('/publikasi/create', [PublikasiController::class, 'create']);
Route::post('/publikasi', [PublikasiController::class, 'store']);
Route::get('/publikasi/{publikasi}/edit', [PublikasiController::class, 'edit']);
Route::put('/publikasi/{publikasi}', [PublikasiController::class, 'update']);
Route::delete('/publikasi/{publikasi}', [PublikasiController::class, 'destroy']);