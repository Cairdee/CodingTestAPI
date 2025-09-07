<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\PenjualanController;
use App\Http\Controllers\AuthController;

Route::get('/', function () {
    return view('welcome');
});
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login'); // Tampilkan form login
Route::post('/login', [AuthController::class, 'login']); // Proses login
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
Route::group(['middleware' => 'check.jwt.session'], function () {
    Route::resource('users', UserController::class);
    Route::resource('produks', ProdukController::class);
    Route::resource('penjualans', PenjualanController::class);
});
Route::get('/penjualans/{nomer_penjualan}/add-detail', [PenjualanController::class, 'addDetailForm'])->name('penjualans.addDetail');
Route::post('/penjualans/detail', [PenjualanController::class, 'createDetail'])->name('detail-penjualans.store');
Route::get('/laporan-penjualan', [PenjualanController::class, 'laporan'])->name('penjualans.laporan');
Route::post('/penjualans/create-head', [PenjualanController::class, 'createHead'])->name('penjualans.createHead');
