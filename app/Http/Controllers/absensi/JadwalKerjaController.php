<?php

namespace App\Http\Controllers\absensi;

use App\Http\Controllers\Controller;
use App\Models\Jabatan;
use App\Models\JadwalKerja;
use App\Models\Karyawan;
use App\Models\lokasiAbsensi;
use Illuminate\Http\Request;

class JadwalKerjaController extends Controller
{
    public function index(Request $request)
    {
        $bulan = $request->get('bulan', date('Y-m'));
        $jabatan = $request->get('jabatan', null);

        $JadwalKerja = JadwalKerja::whereMonth('tanggal', substr($bulan, 5, 2))
            ->whereYear('tanggal', substr($bulan, 0, 4));

        if ($jabatan) {
            $JadwalKerja = $JadwalKerja->whereHas('karyawan.jabatan', function($q) use ($jabatan) {
                $q->where('id', $jabatan);
            });
        }

        $JadwalKerja = $JadwalKerja->orderBy('created_at', 'asc')->get();
        $karyawans = Karyawan::orderBy('created_at', 'asc')->get();
        $lokasi = lokasiAbsensi::orderBy('created_at', 'asc')->get();

        // Ambil daftar jabatan unik
        $daftarJabatan = \App\Models\Jabatan::orderBy('nama_jabatan')->get();

        return view('absensi.jadwal.index', compact('JadwalKerja', 'bulan', 'karyawans', 'lokasi', 'daftarJabatan', 'jabatan'));
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
}
