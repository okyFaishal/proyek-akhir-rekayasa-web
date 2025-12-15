<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AuthController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\PelangganController;
use App\Http\Controllers\ProdukController;


// Route::get('/login', function () {
//     return response()->json(['message' => 'Unauthenticated.'], 401);
// })->name('login');

// auth
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::middleware('auth:sanctum')->post('/logout', [AuthController::class, 'logout']);


Route::middleware('auth:sanctum')->group(function () {
    // kategori
    Route::post('/kategori/create', [KategoriController::class, 'store']);
    Route::get('/kategori/read/{id}', [KategoriController::class, 'show']);
    Route::get('/kategori/read', [KategoriController::class, 'index']);
    Route::put('/kategori/update/{id}', [KategoriController::class, 'update']);
    Route::delete('/kategori/delete/{id}',[KategoriController::class, 'destroy']);

    // pelanggan
    Route::post('/pelanggan/create', [PelangganController::class, 'store']);
    Route::get('/pelanggan/read/{id}', [PelangganController::class, 'show']);
    Route::get('/pelanggan/read', [PelangganController::class, 'index']);
    Route::put('/pelanggan/update/{id}', [PelangganController::class, 'update']);
    Route::delete('/pelanggan/delete/{id}', [PelangganController::class, 'destroy']);

    // produk
    Route::post('/produk/create', [ProdukController::class, 'store']);
    Route::get('/produk/read/{id}', [ProdukController::class, 'show']);
    Route::get('/produk/read', [ProdukController::class, 'index']);
    Route::put('/produk/update/{id}', [ProdukController::class, 'update']);
    Route::delete('/produk/delete/{id}', [ProdukController::class, 'destroy']);
});
