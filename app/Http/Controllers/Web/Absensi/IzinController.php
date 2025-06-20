<?php

namespace App\Http\Controllers\Web\Absensi;

use App\Http\Controllers\Controller;
use App\Models\Absensi;
use App\Models\Izin;
use App\Models\Jabatan;
use App\Models\JadwalKerja;
use Carbon\Carbon;
use Illuminate\Http\Request;

class IzinController extends Controller
{
    public function index(Request $request)
    {
        // Ambil parameter sorting
        $sortJabatan = $request->get('jabatan');
        $sortStatus = $request->get('status');
        $sortBulan = $request->get('bulan');

        // Query dasar
        $query = Izin::with(['karyawan.user', 'karyawan.jabatan']);

        // Filter berdasarkan jabatan jika dipilih
        if ($sortJabatan) {
            $query->whereHas('karyawan.jabatan', function($q) use ($sortJabatan) {
                $q->where('id', $sortJabatan);
            });
        }

        // Filter berdasarkan status jika dipilih
        if ($sortStatus) {
            $query->where('status', $sortStatus);
        }

        // Filter berdasarkan bulan jika dipilih (berdasarkan tanggal mulai)
        if ($sortBulan) {
            $query->whereMonth('tanggal_mulai', $sortBulan);
        }

        // Urutkan berdasarkan tanggal terbaru
        $izins = $query->orderBy('created_at', 'desc')->get();

        // Ambil data untuk dropdown
        $jabatans = Jabatan::all();
        $statusOptions = [
            'pending' => 'Pending',
            'disetujui' => 'Disetujui',
            'ditolak' => 'Ditolak'
        ];
        $bulans = [
            1 => 'Januari', 2 => 'Februari', 3 => 'Maret', 4 => 'April',
            5 => 'Mei', 6 => 'Juni', 7 => 'Juli', 8 => 'Agustus',
            9 => 'September', 10 => 'Oktober', 11 => 'November', 12 => 'Desember'
        ];

        return view('absensi.izin.index', compact('izins', 'jabatans', 'statusOptions', 'bulans', 'sortJabatan', 'sortStatus', 'sortBulan'));
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

        // Redirect kembali dengan mempertahankan filter
        return redirect()->route('izin.index', $request->only(['jabatan', 'status', 'bulan']))
            ->with('success', 'Status izin berhasil diperbarui.');
    }
}
