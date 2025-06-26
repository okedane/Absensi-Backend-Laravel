<?php

use App\Http\Controllers\API\Absensi\JadwalKerjaController;
use App\Http\Controllers\API\Auth\AuthController;
use App\Http\Controllers\API\Absensi\AbsensiController;
use App\Http\Controllers\API\Absensi\IzinController;
use App\Http\Controllers\Api\Absensi\LemburController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

// logo-sm.svg

Route::post('/login', [AuthController::class, 'login']);


Route::middleware('auth:sanctum')->group(function () {
    Route::get('/user', [AuthController::class, 'me']);
    Route::post('/logout', [AuthController::class, 'logout']);
    //Jadwal
    Route::get('/jadwal-kerja', [JadwalKerjaController::class, 'index']);
    Route::get('/jadwal-kerja/hari-ini', [JadwalKerjaController::class, 'jadwalHariIni']);
    //Absensi
    //  Route::get('/absensi', [AbsensiController::class, 'index']);
    Route::post('/absensi', [AbsensiController::class, 'store']);
     Route::get('/absensi/history', [AbsensiController::class, 'history']);
    Route::post('/izin', [IzinController::class, 'store']);
    Route::get('/lembur', [LemburController::class, 'index']);
});