<?php

use App\Http\Controllers\Web\Absensi\AbsensiController;
use App\Http\Controllers\Web\Absensi\IzinController;
use App\Http\Controllers\Web\Absensi\JadwalKerjaController;
use App\Http\Controllers\Web\Absensi\LemburController;
use App\Http\Controllers\Web\Absensi\LokasiAbsensiController;
use App\Http\Controllers\Web\Data\JabatanController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Web\Data\KaryawanController;

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

Route::get('karyawan/{jabatan_id}', [KaryawanController::class, 'index'])->name('karyawan.index');
Route::post('karyawanStore', [KaryawanController::class, 'post'])->name('karyawan.post');
Route::put('karyawanPut/{id}', [KaryawanController::class, 'put'])->name('karyawan.put');
Route::delete('karyawanDelete/{id}', [KaryawanController::class, 'delete'])->name('karyawan.delete');

// Routes untuk Jadwal Kerja
Route::prefix('jadwal-kerja')->group(function () {
    Route::get('/', [JadwalKerjaController::class, 'index'])->name('jadwal-kerja.index');
    Route::get('-{id}', [JadwalKerjaController::class, 'show'])->name('jadwal-kerja.show');
    Route::post('/', [JadwalKerjaController::class, 'store'])->name('jadwal-kerja.post');
    Route::put('/{id}', [JadwalKerjaController::class, 'update'])->name('jadwal-kerja.put');
    Route::delete('/{id}', [JadwalKerjaController::class, 'destroy'])->name('jadwal-kerja.delete');
    Route::delete('/monthly/{karyawanId}/{bulan}', [JadwalKerjaController::class, 'destroyMonthly'])->name('jadwal-kerja.delete-monthly');
});

Route::get('absensi', [AbsensiController::class, 'index'])->name('absensi.index');
Route::post('absensiStore', [AbsensiController::class, 'post'])->name('absensi.post');
Route::put('absensiPut/{id}', [AbsensiController::class, 'put'])->name('absensi.put');
Route::delete('absensiDelete/{id}', [AbsensiController::class, 'delete'])->name('absensi.delete'); 

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
Route::patch('/izin/{id}/status', [IzinController::class, 'updateStatus'])->name('izin.updateStatus');

Route::get('absensi', [AbsensiController::class, 'index'])->name('absensi.index');
 Route::get('absensi-show-{karyawanId}', [AbsensiController::class, 'show'])->name('absensi.show');

Route::prefix('lembur')->name('lembur.')->group(function () {
    Route::get('/', [LemburController::class, 'index'])->name('index');
    Route::post('/', [LemburController::class, 'store'])->name('store');
    Route::get('/{id}', [LemburController::class, 'show'])->name('show');
    Route::put('/{id}', [LemburController::class, 'update'])->name('update');
    Route::delete('/{id}', [LemburController::class, 'destroy'])->name('destroy');
});