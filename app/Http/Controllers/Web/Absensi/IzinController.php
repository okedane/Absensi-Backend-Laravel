<?php

namespace App\Http\Controllers\Web\Absensi;

use App\Http\Controllers\Controller;
use App\Models\Absensi;
use App\Models\Izin;
use App\Models\JadwalKerja;
use Carbon\Carbon;
use Illuminate\Http\Request;

class IzinController extends Controller
{
    public function index()
    {
        $izins = Izin::orderBy('created_at', 'asc')->get();
        return view('absensi.izin.index', compact('izins'));
    }

    public function updateStatus(Request $request, $id)
    {
        $izin = Izin::findOrFail($id);
        $izin->status = $request->status;
        $izin->save();

        // Jika izin disetujui → buat absensi dengan status "izin"
        if ($izin->status === 'disetujui') {
            $tanggalMulai = Carbon::parse($izin->tanggal_mulai);
            $tanggalSelesai = Carbon::parse($izin->tanggal_selesai);

            $tanggalRange = [];
            for ($date = $tanggalMulai; $date->lte($tanggalSelesai); $date->addDay()) {
                $tanggalRange[] = $date->copy();
            }

            foreach ($tanggalRange as $tanggal) {
                // Cek apakah ada jadwal kerja di tanggal tersebut
                $jadwal = JadwalKerja::where('karyawan_id', $izin->karyawan_id)
                    ->whereDate('tanggal', $tanggal->toDateString())
                    ->first();

                if ($jadwal) {
                    // Cek apakah absensi untuk hari itu sudah ada
                    $absen = Absensi::firstOrNew([
                        'karyawan_id' => $izin->karyawan_id,
                        'tanggal' => $tanggal->toDateString(),
                        'shift' => $jadwal->shift,
                    ]);

                    $absen->status = 'izin';
                    $absen->jadwal_kerja_id = $jadwal->id;
                    $absen->jam_absen = null;
                    $absen->keterlambatan = null;
                    $absen->izin_id = $izin->id;
                    $absen->save();
                }
            }
        }

        return back()->with('success', 'Status izin berhasil diperbarui.');
    }
}
