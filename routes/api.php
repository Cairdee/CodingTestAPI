<?php
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\PenjualanController;
use Illuminate\Support\Facades\Route;

Route::post('/login', [AuthController::class, 'login']);

Route::middleware('auth:api')->group(function () {
    Route::apiResource('users', UserController::class);
    Route::apiResource('produks', ProdukController::class);
    Route::post('/head-penjualans', [PenjualanController::class, 'createHead']);
    Route::post('/detail-penjualans', [PenjualanController::class, 'createDetail']);
    Route::get('/transaksis/{nomer_penjualan}', [PenjualanController::class, 'show']);
});
