<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\EkskulController;
use App\Http\Controllers\Api\SiswaEkskulController;
use App\Http\Controllers\Api\ProfileController;
use App\Http\Controllers\Api\ProfilewithSiswaController;
use App\Http\Controllers\Api\PengumumanController;
use App\Http\Controllers\Api\EvaluasiController;
    



/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/


Route::post('/register', [\App\Http\Controllers\Api\AuthController::class, 'register']);
Route::post('/login', [\App\Http\Controllers\Api\AuthController::class, 'login']);
Route::get('/api/siswa-terdaftar/{ekskul}', [SiswaEkskulController::class, 'getSiswaTerdaftar']);



Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::middleware('auth:sanctum')->get('/ekskuls', [EkskulController::class, 'index', 'show']);
Route::middleware('auth:sanctum')->get('/siswa/ekskuls', [SiswaEkskulController::class, 'index']);
Route::middleware('auth:sanctum')->get('/profile', [ProfileController::class, 'profile']);
Route::middleware('auth:sanctum')->get('/profilewithsiswa', [ProfilewithSiswaController::class, 'show']);
Route::middleware('auth:sanctum')->put('/editprofilewithsiswa', [ProfilewithSiswaController::class, 'update']);
Route::middleware('auth:sanctum')->get('/pengumuman/{ekskul_id}', [PengumumanController::class, 'index']);
Route::middleware('auth:sanctum')->get('/evaluasi', [EvaluasiController::class, 'index']);
Route::middleware('auth:sanctum')->post('/daftar-ekskul', [EkskulController::class, 'daftarEkskulAPI']);
Route::middleware('auth:sanctum')->get('/notifikasi-pengumuman', [PengumumanController::class, 'notifikasiBaru']);




Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [\App\Http\Controllers\Api\AuthController::class, 'logout']);
});