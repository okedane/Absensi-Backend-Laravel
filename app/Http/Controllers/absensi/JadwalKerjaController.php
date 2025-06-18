<?php

namespace App\Http\Controllers\absensi;

use App\Http\Controllers\Controller;
use App\Models\Jabatan;
use App\Models\JadwalKerja;
use App\Models\Karyawan;
use App\Models\lokasiAbsensi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class JadwalKerjaController extends Controller
{
    public function index(Request $request)
    {
        $bulan = $request->get('bulan', date('Y-m'));
        $jabatan = $request->get('jabatan', null);

        // Menggunakan groupBy untuk menghindari duplikasi
        $JadwalKerjaQuery = JadwalKerja::select([
            'karyawan_id',
            'lokasi_id',
            DB::raw('DATE_FORMAT(tanggal, "%Y-%m") as bulan'),
            DB::raw('MIN(id) as id'), // Ambil ID yang pertama untuk keperluan edit/delete
            DB::raw('MIN(tanggal) as tanggal'), // Ambil tanggal pertama
            DB::raw('MIN(shift) as shift'),
            DB::raw('MIN(jam_masuk) as jam_masuk'),
            DB::raw('MIN(jam_keluar) as jam_keluar')
        ])
            ->whereMonth('tanggal', substr($bulan, 5, 2))
            ->whereYear('tanggal', substr($bulan, 0, 4))
            ->groupBy('karyawan_id', 'lokasi_id', DB::raw('DATE_FORMAT(tanggal, "%Y-%m")'));

        if ($jabatan) {
            $JadwalKerjaQuery = $JadwalKerjaQuery->whereHas('karyawan.jabatan', function ($q) use ($jabatan) {
                $q->where('id', $jabatan);
            });
        }

        $JadwalKerja = $JadwalKerjaQuery->with(['karyawan.user', 'lokasi'])
            ->orderBy('tanggal', 'asc')
            ->get();

        $karyawans = Karyawan::orderBy('created_at', 'asc')->get();
        $lokasi = lokasiAbsensi::orderBy('created_at', 'asc')->get();
        $daftarJabatan = Jabatan::orderBy('nama_jabatan')->get();

        return view('absensi.jadwal.index', compact('JadwalKerja', 'bulan', 'karyawans', 'lokasi', 'daftarJabatan', 'jabatan'));
    }

    public function show($id)
    {
        // Ambil data jadwal pertama untuk mendapatkan informasi karyawan dan bulan
        $jadwalUtama = JadwalKerja::findOrFail($id);

        // Ambil semua jadwal untuk karyawan tersebut dalam bulan yang sama
        $detailJadwal = JadwalKerja::where('karyawan_id', $jadwalUtama->karyawan_id)
            ->whereMonth('tanggal', date('m', strtotime($jadwalUtama->tanggal)))
            ->whereYear('tanggal', date('Y', strtotime($jadwalUtama->tanggal)))
            ->orderBy('tanggal', 'asc')
            ->get();

        return view('absensi.jadwal.show', compact('jadwalUtama', 'detailJadwal'));
    }



    public function store(Request $request)
    {
        try {
            $validatedData = $request->validate([
                'karyawan_id' => 'required|exists:karyawans,id',
                'lokasi_id' => 'required|exists:lokasi_absensis,id',
                'tanggal' => 'required|date',
                'shift' => 'required|in:pagi,malam',
                'jam_masuk' => 'required|date_format:H:i',
                'jam_keluar' => 'required|date_format:H:i',

            ]);

            $existingJadwal = JadwalKerja::where('karyawan_id', $validatedData['karyawan_id'])
                ->where('tanggal', $validatedData['tanggal'])
                ->first();

            if ($existingJadwal) {
                return redirect()->back()->with('error', 'Jadwal untuk karyawan ini pada tanggal tersebut sudah ada.');
            }

            JadwalKerja::create($validatedData);
            return redirect()->back()->with('success', 'Jadwal kerja berhasil dibuat.');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'Terjadi kesalahan saat membuat jadwal kerja. Silakan coba lagi.');
        }
    }


    public function update(Request $request, $id)
    {
        try {
            $validatedData = $request->validate([
                'karyawan_id' => 'required|exists:karyawans,id',
                'lokasi_id' => 'required|exists:lokasi_absensis,id',
                'tanggal' => 'required|date',
                'shift' => 'required|string|max:255',
                'jam_masuk' => 'required|date_format:H:i',
                'jam_keluar' => 'required|date_format:H:i',
            ]);

            $jadwalKerja = JadwalKerja::findOrFail($id);

            // Cek duplikasi kecuali untuk record yang sedang diupdate
            $existingJadwal = JadwalKerja::where('karyawan_id', $validatedData['karyawan_id'])
                ->where('tanggal', $validatedData['tanggal'])
                ->where('id', '!=', $id)
                ->first();

            if ($existingJadwal) {
                return redirect()->back()->with('error', 'Jadwal untuk karyawan ini pada tanggal tersebut sudah ada.');
            }

            $jadwalKerja->update($validatedData);

            return redirect()->back()->with('success', 'Jadwal kerja berhasil diperbarui.');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'Terjadi kesalahan saat memperbarui jadwal kerja. Silakan coba lagi. ' . $th->getMessage());
        }
    }

    public function destroy($id)
    {
        try {
            $jadwalKerja = JadwalKerja::findOrFail($id);
            $jadwalKerja->delete();

            return redirect()->back()->with('success', 'Jadwal kerja berhasil dihapus.');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'Terjadi kesalahan saat menghapus jadwal kerja. Silakan coba lagi.');
        }
    }

    public function destroyMonthly($karyawanId, $bulan)
    {
        try {
            JadwalKerja::where('karyawan_id', $karyawanId)
                ->whereMonth('tanggal', substr($bulan, 5, 2))
                ->whereYear('tanggal', substr($bulan, 0, 4))
                ->delete();

            return redirect()->back()->with('success', 'Semua jadwal kerja untuk bulan ini berhasil dihapus.');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'Terjadi kesalahan saat menghapus jadwal kerja bulanan.');
        }
    }
}
