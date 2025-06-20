<?php

namespace App\Http\Controllers\API\Absensi;

use App\Http\Controllers\Controller;
use App\Models\Absensi;
use App\Models\JadwalKerja;
use Carbon\Carbon;
use Illuminate\Http\Request;

class AbsensiController extends Controller
{
    public function store(Request $request)
    {
        $user = $request->user();
        $karyawan = $user->karyawan;

        $request->validate([
            'latitude' => 'required|numeric',
            'longitude' => 'required|numeric',
        ]);

        // Ambil jadwal kerja hari ini
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

        // Validasi sudah absen?
        $sudahAbsen = Absensi::where('karyawan_id', $karyawan->id)
            ->whereDate('tanggal', Carbon::today())
            ->where('shift', $jadwal->shift)
            ->exists();

        if ($sudahAbsen) {
            return response()->json([
                'success' => false,
                'message' => 'Kamu sudah absen hari ini.'
            ], 409);
        }

        // Validasi lokasi
        $userLat = $request->latitude;
        $userLong = $request->longitude;

        $lokasi = $jadwal->lokasi;
        $radius = $lokasi->radius_meter;

        $jarak = $this->hitungJarak($userLat, $userLong, $lokasi->latitude, $lokasi->longitude);

        if ($jarak > $radius) {
            return response()->json([
                'success' => false,
                'message' => 'Kamu berada di luar radius lokasi absen.',
                'jarak_meter' => round($jarak),
                'batas_radius' => $radius
            ], 403);
        }

        // Hitung keterlambatan
        $toleransi = 15; // menit
        $jamMasuk = Carbon::createFromTimeString($jadwal->jam_masuk);
        $batasToleransi = $jamMasuk->copy()->addMinutes($toleransi);
        $waktuSekarang = Carbon::now();

        if ($waktuSekarang->lte($batasToleransi)) {
            $status = 'tepat waktu';
            $keterlambatan = 0;
        } else {
            $status = 'terlambat';
            $keterlambatan = $waktuSekarang->diffInMinutes($batasToleransi) + 1;
        }


        // Simpan absensi
        $absen = Absensi::create([
            'karyawan_id'    => $karyawan->id,
            'jadwal_kerja_id' => $jadwal->id,
            'tanggal'        => Carbon::today(),
            'shift'          => $jadwal->shift,
            'jam_absen'      => $waktuSekarang->format('H:i:s'),
            'status'         => $status,
            'keterlambatan'  => $keterlambatan,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Absensi berhasil dicatat.',
            'data' => $absen
        ]);
    }

    public function index(Request $request)
    {
        $user = $request->user();
        $karyawan = $user->karyawan;

        $absensis = Absensi::with('jadwalKerja.lokasiAbsensi')
            ->where('karyawan_id', $karyawan->id)
            ->orderBy('tanggal', 'desc')
            ->get();

        return response()->json([
            'success' => true,
            'data' => $absensis
        ]);
    }

    // Fungsi hitung jarak (Haversine formula)
    private function hitungJarak($lat1, $lon1, $lat2, $lon2)
    {
        $earthRadius = 6371000; // meter
        $dLat = deg2rad($lat2 - $lat1);
        $dLon = deg2rad($lon2 - $lon1);

        $a = sin($dLat / 2) ** 2 +
            cos(deg2rad($lat1)) * cos(deg2rad($lat2)) *
            sin($dLon / 2) ** 2;

        $c = 2 * atan2(sqrt($a), sqrt(1 - $a));

        return $earthRadius * $c; // hasil meter
    }


    //  /api/absensi/history?bulan=6&tahun=2025
    

    public function history(Request $request)
    {
        $user = $request->user();
        $karyawan = $user->karyawan;

        if (!$karyawan) {
            return response()->json([
                'success' => false,
                'message' => 'Karyawan tidak ditemukan.'
            ], 404);
        }

        // Opsional: filter bulan & tahun
        $query = $karyawan->absensis()->with(['jadwalKerja', 'izin'])->orderBy('tanggal', 'desc');

        if ($request->has('bulan')) {
            $query->whereMonth('tanggal', $request->bulan);
        }

        if ($request->has('tahun')) {
            $query->whereYear('tanggal', $request->tahun);
        }

        $absensi = $query->get();

        return response()->json([
            'success' => true,
            'data' => $absensi
        ]);
    }
}
