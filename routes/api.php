<?php

use App\Http\Controllers\API\Absensi\JadwalKerjaController;
use App\Http\Controllers\API\Auth\AuthController;
use App\Http\Controllers\API\Absensi\AbsensiController;
use App\Http\Controllers\API\Absensi\IzinController;
use App\Http\Controllers\Api\Absensi\LemburController;
use App\Http\Controllers\Api\Auth\ChangePasswordController;
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
Route::post('/forgot-password', [AuthController::class, 'apiForgot']);
Route::post('/verify-code', [AuthController::class, 'apiVerifyCode']);
Route::post('/reset-password', [AuthController::class, 'apiResetPassword']);

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/change-password', [ChangePasswordController::class, 'changePassword']);
    Route::get('/user', [AuthController::class, 'me']);
    Route::post('/logout', [AuthController::class, 'logout']);
    //Jadwal
    Route::get('/jadwal-kerja', [JadwalKerjaController::class, 'index']);
    Route::get('/jadwal-kerja/hari-ini', [JadwalKerjaController::class, 'jadwalHariIni']);
    //Absensi

    Route::post('/absensi', [AbsensiController::class, 'store']);
    Route::get('/absensi/history', [AbsensiController::class, 'history']);

    Route::get('/izin', [IzinController::class, 'index']);
    Route::post('/izin/store', [IzinController::class, 'store']);
    Route::put('/izin/update/{id}', [IzinController::class, 'update']);
    Route::delete('/izin/delete/{id}', [IzinController::class, 'destroy']);

    Route::get('/lembur', [LemburController::class, 'index']);
});
