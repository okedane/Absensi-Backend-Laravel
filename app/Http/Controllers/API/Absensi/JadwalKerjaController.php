<?php

namespace App\Http\Controllers\API\Absensi;

use App\Http\Controllers\Controller;
use App\Models\JadwalKerja;
use Carbon\Carbon;
use Illuminate\Http\Request;

class JadwalKerjaController extends Controller
{
    public function index(Request $request)
    {
        $karyawan = $request->user()->karyawan;

        $jadwals = JadwalKerja::with('lokasi')
            ->where('karyawan_id', $karyawan->id)
            ->whereDate('tanggal', '>=', Carbon::today())
            ->orderBy('tanggal', 'asc')
            ->get();

        if ($jadwals->isEmpty()) {
            return response()->json([
                'success' => false,
                'message' => 'Tidak memiliki jadwal kerja.'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $jadwals
        ]);
    }

    public function jadwalHariIni(Request $request)
    {
        $user = $request->user();
        $karyawan = $user->karyawan;

        $jadwal = JadwalKerja::with('lokasi')
            ->where('karyawan_id', $karyawan->id)
            ->whereDate('tanggal', Carbon::today())
            ->first();

        if (!$jadwal) {
            return response()->json([
                'success' => false,
                'message' => 'Tidak ada jadwal kerja hari ini.'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => [
                'tanggal' => $jadwal->tanggal,
                'shift' => $jadwal->shift,
                'jam_masuk' => $jadwal->jam_masuk,
                'jam_keluar' => $jadwal->jam_keluar,
                'lokasi' => [
                    'nama_lokasi' => $jadwal->lokasi->nama_lokasi,
                    'latitude' => $jadwal->lokasi->latitude,
                    'longitude' => $jadwal->lokasi->longitude,
                    'radius_meter' => $jadwal->lokasi->radius_meter,
                ]
            ]
        ]);
    }
}
