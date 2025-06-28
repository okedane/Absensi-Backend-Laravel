<?php

use App\Http\Controllers\Web\Moora\PenilaianKaryawanController;
use App\Http\Controllers\Web\Absensi\AbsensiController;
use App\Http\Controllers\Web\Absensi\IzinController;
use App\Http\Controllers\Web\Absensi\JadwalKerjaController;
use App\Http\Controllers\Web\Absensi\LemburController;
use App\Http\Controllers\Web\Absensi\LokasiAbsensiController;
use App\Http\Controllers\Web\Auth\AuthController;
use App\Http\Controllers\Web\data\DashboardController;
use App\Http\Controllers\Web\Data\JabatanController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Web\Data\KaryawanController;
use App\Http\Controllers\Web\Moora\KriteriaController;
use App\Http\Controllers\Web\Moora\MooraController;
use App\Http\Controllers\Web\Moora\SubKriteriaController;

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

Route::middleware(['guest'])->group(function () {
    Route::get('/', [AuthController::class, 'login'])->name('login');
    Route::post('login-proses', [AuthController::class, 'login_proses'])->name('login-proses');

    Route::get('forgot', [AuthController::class, 'forgot'])->name('forgot');
    Route::post('forgot-proses', [AuthController::class, 'forgot_proses'])->name('forgot-proses');
    Route::get('verify-code', [AuthController::class, 'verify_code'])->name('verify-code');
    Route::post('verify-code-proses', [AuthController::class, 'verify_code_proses'])->name('verify-code-proses');
    Route::get('reset-password', [AuthController::class, 'reset_password'])->name('reset-password');
    Route::post('reset-password-proses', [AuthController::class, 'reset_password_proses'])->name('reset-password-proses');
});

// Route::get('/home', function () {
//     return redirect()->route('/dashboard');
// });


Route::middleware(['auth'])->group(function () {
    Route::get('logout', [AuthController::class, 'logout'])->name('logout');

    Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard.index');

    Route::prefix('jabatan')->group(function () {
        Route::get('/', [JabatanController::class, 'index'])->name('jabatan.index');
        Route::post('/', [JabatanController::class, 'post'])->name('jabatan.post');
        Route::put('/{id}', [JabatanController::class, 'put'])->name('jabatan.put');
        Route::delete('/{id}', [JabatanController::class, 'delete'])->name('jabatan.delete');
    });

    //prefik untuk karyawan
    Route::prefix('karyawan')->group(function () {
        Route::get('/{id}', [KaryawanController::class, 'index'])->name('karyawan.index');
        Route::post('/store', [KaryawanController::class, 'store'])->name('karyawan.store');
        Route::put('edit/{id}', [KaryawanController::class, 'update'])->name('karyawan.update');
        Route::delete('/{id}', [KaryawanController::class, 'destroy'])->name('karyawan.destroy');
    });

    // Routes untuk Jadwal Kerja
    Route::prefix('jadwal-kerja')->group(function () {
        Route::get('/', [JadwalKerjaController::class, 'index'])->name('jadwal-kerja.index');
        Route::get('-{id}', [JadwalKerjaController::class, 'show'])->name('jadwal-kerja.show');
        Route::post('/', [JadwalKerjaController::class, 'store'])->name('jadwal-kerja.post');
        Route::put('/{id}', [JadwalKerjaController::class, 'update'])->name('jadwal-kerja.put');
        Route::delete('/{id}', [JadwalKerjaController::class, 'destroy'])->name('jadwal-kerja.delete');
        Route::delete('/monthly/{karyawanId}/{bulan}', [JadwalKerjaController::class, 'destroyMonthly'])->name('jadwal-kerja.delete-monthly');
    });



    //Prefik untuk Lokasi
    Route::prefix('lokasi-absensi')->group(function () {
        Route::get('/', [LokasiAbsensiController::class, 'index'])->name('lokasi-absensi.index');
        Route::post('/', [LokasiAbsensiController::class, 'post'])->name('lokasi-absensi.post');
        Route::put('/{id}', [LokasiAbsensiController::class, 'put'])->name('lokasi-absensi.put');
        Route::delete('/{id}', [LokasiAbsensiController::class, 'delete'])->name('lokasi-absensi.delete');
    });

    //Prefik Untuk JadwalKerja
    Route::prefix('jadwal-kerja')->group(function () {
        Route::get('/', [JadwalKerjaController::class, 'index'])->name('jadwal-kerja.index');
        Route::post('/store', [JadwalKerjaController::class, 'store'])->name('jadwal-kerja.store');
        Route::put('/update/{id}', [JadwalKerjaController::class, 'update'])->name('jadwal-kerja.update');
        Route::delete('/delete/{id}', [JadwalKerjaController::class, 'destroy'])->name('jadwal-kerja.destroy');
    });

    //prefik untuk izin

    Route::prefix('izin')->group(function () {
        Route::get('/', [IzinController::class, 'index'])->name('izin.index');
        Route::patch('/{id}/status', [IzinController::class, 'updateStatus'])->name('izin.updateStatus');
    });

    Route::prefix('management-account')->name('users.')->group(function () {
        Route::get('/', [\App\Http\Controllers\Web\ManagementAccount\ManagemetAccountController::class, 'index'])->name('index');
        Route::post('/', [\App\Http\Controllers\Web\ManagementAccount\ManagemetAccountController::class, 'store'])->name('store');
        Route::put('/{id}', [\App\Http\Controllers\Web\ManagementAccount\ManagemetAccountController::class, 'update'])->name('update');
        Route::delete('/{id}', [\App\Http\Controllers\Web\ManagementAccount\ManagemetAccountController::class, 'destroy'])->name('destroy');
    });

    //prefik untuk absensi
    Route::prefix('absensi')->group(function () {
        Route::get('/', [AbsensiController::class, 'index'])->name('absensi.index');
        Route::get('/-show-{karyawanId}', [AbsensiController::class, 'show'])->name('absensi.show');
    });

    Route::prefix('lembur')->name('lembur.')->group(function () {
        Route::get('/', [LemburController::class, 'index'])->name('index');
        Route::post('/', [LemburController::class, 'store'])->name('store');
        Route::get('/{id}', [LemburController::class, 'show'])->name('show');
        Route::put('/{id}', [LemburController::class, 'update'])->name('update');
        Route::delete('/{id}', [LemburController::class, 'destroy'])->name('destroy');
    });


    Route::prefix('kriteria')->group(function () {
        Route::get('/', [KriteriaController::class, 'index'])->name('kriteria.index');
        Route::post('/', [KriteriaController::class, 'post'])->name('kriteria.post');
        Route::put('/{id}', [KriteriaController::class, 'put'])->name('kriteria.put');
        Route::delete('/{id}', [KriteriaController::class, 'delete'])->name('kriteria.delete');
    });

    Route::prefix('subKriteria')->group(function () {
        Route::get('/{id}', [SubKriteriaController::class, 'index'])->name('subKriteria.index');
        Route::post('/', [SubKriteriaController::class, 'post'])->name('subKriteria.post');
        Route::put('/{id}', [SubKriteriaController::class, 'put'])->name('subKriteria.put');
        Route::delete('/{id}', [SubKriteriaController::class, 'delete'])->name('subKriteria.delete');
    });

    Route::prefix('penilaian')->group(function () {
        Route::get('/', [PenilaianKaryawanController::class, 'index'])->name('penilaian.index');
        Route::get('/jabatan/{id_jabatan}', [PenilaianKaryawanController::class, 'tampilkanKaryawanByJabatan'])->name('penilaian.byJabatan');
        Route::get('/jabatan/filter/{jabatan_id}', [PenilaianKaryawanController::class, 'tampilkanKaryawanByJabatan'])->name('penilaianKaryawan.filter');
        Route::post('/store', [PenilaianKaryawanController::class, 'store'])->name('penilaianKaryawan.post');
        Route::put('/update/{id}', [PenilaianKaryawanController::class, 'update'])->name('penilaianKaryawan.update');
        Route::delete('/delete/{id}', [PenilaianKaryawanController::class, 'destroy'])->name('penilaianKaryawan.delete');
        Route::get('/rekap-keterlambatan/{bulan}/{tahun}', [PenilaianKaryawanController::class, 'rekapKeterlambatanBulanan'])->name('penilaianKaryawan.rekapKeterlambatan');
    });

    Route::prefix('moora')->group(function () {
        Route::get('/jabatanPeringkat', [MooraController::class, 'pilihJabatan'])->name('jabatanHasil');
        Route::get('/moora/hasil/{jabatan_id}', [MooraController::class, 'hasil'])->name('moora.hasil');

        Route::get('/jabatanhasul', [MooraController::class, 'pilihJabatanAkhir'])->name('JabatanHasilAKhir');
        Route::get('/moora/peringkat/{jabatan_id}', [MooraController::class, 'hasilAkhir'])->name('moora.hasilAKhir');
    });
});
