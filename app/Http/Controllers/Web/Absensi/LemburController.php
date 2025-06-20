<?php

namespace App\Http\Controllers\Web\Absensi;

use App\Http\Controllers\Controller;
use App\Models\Jabatan;
use App\Models\Karyawan;
use App\Models\Lembur;
use Carbon\Carbon;
use Illuminate\Http\Request;

class LemburController extends Controller
{
    public function index(Request $request)
    {
        // Ambil parameter sorting
        $sortJabatan = $request->get('jabatan');
        $sortBulan = $request->get('bulan');

        // Query dasar
        $query = Lembur::with(['karyawan.user', 'karyawan.jabatan']);

        // Filter berdasarkan jabatan jika dipilih
        if ($sortJabatan) {
            $query->whereHas('karyawan.jabatan', function ($q) use ($sortJabatan) {
                $q->where('id', $sortJabatan);
            });
        }

        // Filter berdasarkan bulan jika dipilih
        if ($sortBulan) {
            $query->whereMonth('tanggal', $sortBulan);
        }

        // Urutkan berdasarkan tanggal terbaru
        $lemburs = $query->orderBy('tanggal', 'desc')->get();

        // Ambil data untuk dropdown
        $jabatans = Jabatan::all();
        $karyawans = Karyawan::with(['user', 'jabatan'])->get();
        $bulans = [
            1 => 'Januari',
            2 => 'Februari',
            3 => 'Maret',
            4 => 'April',
            5 => 'Mei',
            6 => 'Juni',
            7 => 'Juli',
            8 => 'Agustus',
            9 => 'September',
            10 => 'Oktober',
            11 => 'November',
            12 => 'Desember'
        ];

        return view('absensi.lembur.index', compact('lemburs', 'jabatans', 'karyawans', 'bulans', 'sortJabatan', 'sortBulan'));
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                'karyawan_id' => 'required|exists:karyawans,id',
                'tanggal' => 'required|date',
                'jam_mulai' => 'required|date_format:H:i',
                'jam_selesai' => 'required|date_format:H:i|after:jam_mulai',
            ], [
                'karyawan_id.required' => 'Karyawan harus dipilih',
                'karyawan_id.exists' => 'Karyawan tidak valid',
                'tanggal.required' => 'Tanggal harus diisi',
                'tanggal.date' => 'Format tanggal tidak valid',
                'jam_mulai.required' => 'Jam mulai harus diisi',
                'jam_mulai.date_format' => 'Format jam mulai tidak valid',
                'jam_selesai.required' => 'Jam selesai harus diisi',
                'jam_selesai.date_format' => 'Format jam selesai tidak valid',
                'jam_selesai.after' => 'Jam selesai harus lebih besar dari jam mulai',
            ]);

            // Hitung total jam
            $jamMulai = Carbon::createFromFormat('H:i', $request->jam_mulai);
            $jamSelesai = Carbon::createFromFormat('H:i', $request->jam_selesai);
            $totalJam = $jamSelesai->diffInHours($jamMulai);

            Lembur::create([
                'karyawan_id' => $request->karyawan_id,
                'tanggal' => $request->tanggal,
                'jam_mulai' => $request->jam_mulai,
                'jam_selesai' => $request->jam_selesai,
                'total_jam' => $totalJam,
            ]);

            return redirect()->route('lembur.index', $request->only(['jabatan', 'bulan']))
                ->with('success', 'Data lembur berhasil ditambahkan');
        } catch (\Exception $e) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    public function show($id)
    {
        $lembur = Lembur::with(['karyawan.user', 'karyawan.jabatan'])->findOrFail($id);
        return response()->json($lembur);
    }

    public function update(Request $request, $id)
    {
        try {
            $request->validate([
                'karyawan_id' => 'required|exists:karyawans,id',
                'tanggal' => 'required|date',
                'jam_mulai' => 'required|date_format:H:i',
                'jam_selesai' => 'required|date_format:H:i|after:jam_mulai',
            ], [
                'karyawan_id.required' => 'Karyawan harus dipilih',
                'karyawan_id.exists' => 'Karyawan tidak valid',
                'tanggal.required' => 'Tanggal harus diisi',
                'tanggal.date' => 'Format tanggal tidak valid',
                'jam_mulai.required' => 'Jam mulai harus diisi',
                'jam_mulai.date_format' => 'Format jam mulai tidak valid',
                'jam_selesai.required' => 'Jam selesai harus diisi',
                'jam_selesai.date_format' => 'Format jam selesai tidak valid',
                'jam_selesai.after' => 'Jam selesai harus lebih besar dari jam mulai',
            ]);

            $lembur = Lembur::findOrFail($id);

            // Hitung total jam
            $jamMulai = Carbon::createFromFormat('H:i', $request->jam_mulai);
            $jamSelesai = Carbon::createFromFormat('H:i', $request->jam_selesai);
            $totalJam = $jamSelesai->diffInHours($jamMulai);

            $lembur->update([
                'karyawan_id' => $request->karyawan_id,
                'tanggal' => $request->tanggal,
                'jam_mulai' => $request->jam_mulai,
                'jam_selesai' => $request->jam_selesai,
                'total_jam' => $totalJam,
            ]);

            return redirect()->route('lembur.index', $request->only(['jabatan', 'bulan']))
                ->with('success', 'Data lembur berhasil diperbarui');
        } catch (\Exception $e) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    public function destroy(Request $request, $id)
    {
        try {
            $lembur = Lembur::findOrFail($id);
            $lembur->delete();

            return redirect()->route('lembur.index', $request->only(['jabatan', 'bulan']))
                ->with('success', 'Data lembur berhasil dihapus');
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }
}
