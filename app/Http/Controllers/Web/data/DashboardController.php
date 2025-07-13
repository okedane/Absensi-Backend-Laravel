<?php

namespace App\Http\Controllers\Web\data;

use App\Http\Controllers\Controller;
use App\Models\Karyawan;
use App\Models\Absensi;
use App\Models\Jabatan;
use Illuminate\Http\Request;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        $totalKaryawan = Karyawan::count();
        $totalJabatan = Jabatan::count();

        // Hitung total hadir hari ini (tepat waktu + terlambat)
        $totalHadir = Absensi::whereYear('tanggal', Carbon::now()->year)

            ->whereIn('status', ['tepat waktu', 'terlambat'])
            ->count();

        // Hitung total terlambat hari ini
        $totalTerlambat = Absensi::whereYear('tanggal', Carbon::now()->year)

            ->where('status', 'terlambat')
            ->count();

        // Hitung total alfa hari ini (karyawan yang tidak absen)
        $totalAbsenHariIni = Absensi::whereYear('tanggal', Carbon::now()->year)->count();
        $totalAlfa = $totalKaryawan - $totalAbsenHariIni;

        return view('dashboard.index', compact('totalKaryawan', 'totalHadir', 'totalTerlambat', 'totalAlfa', 'totalJabatan'));
    }
}
