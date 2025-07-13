<?php

namespace App\Http\Controllers\Web\Absensi;

use App\Http\Controllers\Controller;
use App\Models\Absensi;
use App\Models\Jabatan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AbsensiController extends Controller
{
    public function index(Request $request)
    {
        // Ambil parameter sorting
        $sortJabatan = $request->get('jabatan');
        $sortBulan = $request->get('bulan');
        
        $query = DB::table('absensis')
            ->join('karyawans', 'absensis.karyawan_id', '=', 'karyawans.id')
            ->join('users', 'karyawans.user_id', '=', 'users.id')
            ->join('jabatans', 'karyawans.jabatan_id', '=', 'jabatans.id')
            ->select(
                'karyawans.id as karyawan_id',
                'karyawans.nomor_karyawan',
                'users.name as nama_karyawan',
                'jabatans.nama_jabatan',
                DB::raw('COUNT(absensis.id) as total_absensi'),
                DB::raw('SUM(CASE WHEN absensis.status = "tepat waktu" THEN 1 ELSE 0 END) as tepat_waktu'),
                DB::raw('SUM(CASE WHEN absensis.status = "terlambat" THEN 1 ELSE 0 END) as terlambat'),
                DB::raw('SUM(CASE WHEN absensis.status = "izin" THEN 1 ELSE 0 END) as izin')
            )
            ->groupBy('karyawans.id', 'karyawans.nomor_karyawan', 'users.name', 'jabatans.nama_jabatan');

        if ($sortJabatan) {
            $query->where('jabatans.id', $sortJabatan);
        }

        if ($sortBulan) {
            $query->whereMonth('absensis.tanggal', $sortBulan);
        }

        $query->orderBy('jabatans.nama_jabatan');

        $absensis = $query->get();

        // Ambil data untuk dropdown
        $jabatans = Jabatan::all();
        $bulans = [
            1 => 'Januari', 2 => 'Februari', 3 => 'Maret', 4 => 'April',
            5 => 'Mei', 6 => 'Juni', 7 => 'Juli', 8 => 'Agustus',
            9 => 'September', 10 => 'Oktober', 11 => 'November', 12 => 'Desember'
        ];

        return view('absensi.absensi.index', compact('absensis', 'jabatans', 'bulans', 'sortJabatan', 'sortBulan'));
    }

    public function show(Request $request, $karyawanId)
    {
        // Ambil parameter filter yang sama
        $sortJabatan = $request->get('jabatan');
        $sortBulan = $request->get('bulan');

        // Query untuk detail absensi karyawan
        $query = Absensi::with(['karyawan.user', 'karyawan.jabatan', 'jadwalKerja', 'izin'])
            ->where('karyawan_id', $karyawanId);

        // Terapkan filter yang sama
        if ($sortBulan) {
            $query->whereMonth('tanggal', $sortBulan);
        }

        $query->orderBy('tanggal', 'desc');

        $absensis = $query->get();
        $karyawan = $absensis->first()->karyawan ?? null;

        return view('absensi.absensi.show', compact('absensis', 'karyawan', 'sortBulan'));
    }
}