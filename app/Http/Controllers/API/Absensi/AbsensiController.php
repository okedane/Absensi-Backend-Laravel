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

        // Validasi waktu absen
        $waktuSekarang = Carbon::now();
        $jamMasuk = Carbon::createFromFormat('H:i:s', $jadwal->jam_masuk);
        $jamKeluar = Carbon::createFromFormat('H:i:s', $jadwal->jam_keluar);
        $bolehAbsenMulai = $jamMasuk->copy()->subHour();
        if ($waktuSekarang->lt($bolehAbsenMulai)) {
            return response()->json([
                'success' => false,
                'message' => 'Absen hanya diperbolehkan mulai 1 jam sebelum jam masuk.',
                'jam_masuk' => $jadwal->jam_masuk,
                'waktu_boleh_absen' => $bolehAbsenMulai->format('H:i:s'),
                'waktu_sekarang' => $waktuSekarang->format('H:i:s'),
            ], 403);
        }


        $status = 'tepat waktu';
        $keterlambatan = null;

        //greater than
        if ($waktuSekarang->gt($jamMasuk)) {
            $status = 'terlambat';
            $keterlambatan = $waktuSekarang->diffInMinutes($jamMasuk); // ⬅️ hasil integer, cocok untuk kolom integer
        }



        Absensi::create([
            'karyawan_id' => $karyawan->id,
            'jadwal_kerja_id' => $jadwal->id,
            'tanggal' => Carbon::today()->toDateString(),
            'shift' => $jadwal->shift,
            'jam_absen' => $waktuSekarang->format('H:i:s'),
            'status' => $status,
            'keterlambatan' => $keterlambatan,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Absen berhasil dicatat',
            'data' => [
                'status' => $status,
                'jam_absen' => $waktuSekarang->format('H:i:s'),
                'keterlambatan' => $keterlambatan
            ]
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
        $earthRadius = 6371000; // Radius Bumi
        $dLat = deg2rad($lat2 - $lat1);
        $dLon = deg2rad($lon2 - $lon1);

        $a = sin($dLat / 2) ** 2 + cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * sin($dLon / 2) ** 2;

        $c = 2 * atan2(sqrt($a), sqrt(1 - $a));

        return $earthRadius * $c;
    }



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

        $absensi = $karyawan->absensis()
            ->with(['jadwalKerja', 'izin'])
            ->orderBy('tanggal', 'desc')
            ->get();

        return response()->json([
            'success' => true,
            'data' => $absensi
        ]);
    }
}
