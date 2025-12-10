<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AuthController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\PelangganController;
use App\Http\Controllers\ProdukController;

/*
|--------------------------------------------------------------------------
| LOGIN DUMMY (UNTUK HINDARI ERROR "Route [login] not defined")
|--------------------------------------------------------------------------
| Middleware auth:sanctum akan redirect user guest ke route 'login'
| Jadi kita buat route kosong yang mengembalikan JSON 401.
*/
Route::get('/login', function () {
    return response()->json(['message' => 'Unauthenticated.'], 401);
})->name('login');


// ------------------------------------------------------------
// AUTH API (Register, Login, Logout)
// ------------------------------------------------------------
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login',    [AuthController::class, 'login']);

// Logout harus pakai token
Route::middleware('auth:sanctum')->post('/logout', [AuthController::class, 'logout']);


// ------------------------------------------------------------
// KATEGORI
// ------------------------------------------------------------

// READ boleh tanpa token
Route::get('/kategori/read', [KategoriController::class, 'index']);

// CREATE, UPDATE, DELETE butuh bearer token
Route::middleware('auth:sanctum')->group(function () {
    Route::post('/kategori/create', [KategoriController::class, 'store']);
    Route::put('/kategori/update/{id}', [KategoriController::class, 'update']);
    Route::delete('/kategori/delete/{id}',[KategoriController::class, 'destroy']);
});


// ------------------------------------------------------------
// PELANGGAN
// ------------------------------------------------------------

Route::get('/pelanggan/read', [PelangganController::class, 'index']);

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/pelanggan/create', [PelangganController::class, 'store']);
    Route::put('/pelanggan/update/{id}', [PelangganController::class, 'update']);
    Route::delete('/pelanggan/delete/{id}', [PelangganController::class, 'destroy']);
});


// ------------------------------------------------------------
// PRODUK
// ------------------------------------------------------------

Route::get('/produk/read', [ProdukController::class, 'index']);

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/produk/create', [ProdukController::class, 'store']);
    Route::put('/produk/update/{id}', [ProdukController::class, 'update']);
    Route::delete('/produk/delete/{id}', [ProdukController::class, 'destroy']);
});
