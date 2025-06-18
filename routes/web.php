<?php

use App\Http\Controllers\absensi\JadwalKerjaController;
use App\Http\Controllers\absensi\LokasiAbsensiController;
use App\Http\Controllers\Data\JabatanController;
use App\Http\Controllers\absensi\IzinController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});


Route::get('jabatan', [JabatanController::class, 'index'])->name('jabatan.index');
Route::post('jabatanStore', [JabatanController::class, 'post'])->name('jabatan.post');
Route::put('jabatanPut/{id}', [JabatanController::class, 'put'])->name('jabatan.put');
Route::delete('jabatanDelete/{id}', [JabatanController::class, 'delete'])->name('jabatan.delete');

// Routes untuk Jadwal Kerja
Route::prefix('jadwal-kerja')->group(function () {
    Route::get('/', [JadwalKerjaController::class, 'index'])->name('jadwal-kerja.index');
    Route::get('-{id}', [JadwalKerjaController::class, 'show'])->name('jadwal-kerja.show');
    Route::post('/', [JadwalKerjaController::class, 'store'])->name('jadwal-kerja.post');
    Route::put('/{id}', [JadwalKerjaController::class, 'update'])->name('jadwal-kerja.put');
    Route::delete('/{id}', [JadwalKerjaController::class, 'destroy'])->name('jadwal-kerja.delete');
    Route::delete('/monthly/{karyawanId}/{bulan}', [JadwalKerjaController::class, 'destroyMonthly'])->name('jadwal-kerja.delete-monthly');
});

Route::get('absensi', [App\Http\Controllers\AbsensiController::class, 'index'])->name('absensi.index');
Route::post('absensiStore', [App\Http\Controllers\AbsensiController::class, 'post'])->name('absensi.post');
Route::put('absensiPut/{id}', [App\Http\Controllers\AbsensiController::class, 'put'])->name('absensi.put');
Route::delete('absensiDelete/{id}', [App\Http\Controllers\AbsensiController::class, 'delete'])->name('absensi.delete'); 

Route::get('lokasi-absensi', [LokasiAbsensiController::class, 'index'])->name('lokasi-absensi.index');
Route::post('lokasi-absensiStore', [LokasiAbsensiController::class, 'post'])->name('lokasi-absensi.post');
Route::put('lokasi-absensiPut/{id}', [LokasiAbsensiController::class, 'put'])->name('lokasi-absensi.put');
Route::delete('lokasi-absensiDelete/{id}', [LokasiAbsensiController::class, 'delete'])->name('lokasi-absensi.delete');


Route::get('jadwal-kerja', [JadwalKerjaController::class, 'index'])->name('jadwal-kerja.index');
Route::post('jadwal-kerjaStore', [JadwalKerjaController::class, 'store'])->name('jadwal-kerja.post');
Route::put('jadwal-kerjaPut/{id}', [JadwalKerjaController::class, 'update'])->name('jadwal-kerja.put');
Route::delete('jadwal-kerjaDelete/{id}', [JadwalKerjaController::class, 'destroy'])->name('jadwal-kerja.delete');
Route::get('jadwal-kerja/{id}', [JadwalKerjaController::class, 'show'])->name('jadwal-kerja.show');


Route::get('izin', [IzinController::class, 'index'])->name('izin.index');