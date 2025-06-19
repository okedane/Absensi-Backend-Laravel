<?php

namespace App\Http\Controllers\Absensi;

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
        // Ambil parameter filter dari request
        $jabatanId = $request->get('jabatan_id');
        $monthInput = $request->get('bulan', date('Y-m'));

        // Parse bulan dan tahun dari input
        $bulan = Carbon::parse($monthInput)->format('m');
        $tahun = Carbon::parse($monthInput)->format('Y');

        // Query untuk lembur dengan filter
        $lemburs = Lembur::with('karyawan.jabatan')
            ->when($jabatanId, function ($query) use ($jabatanId) {
                return $query->whereHas('karyawan', function ($q) use ($jabatanId) {
                    $q->where('jabatan_id', $jabatanId);
                });
            })
            ->when($monthInput, function ($query) use ($bulan, $tahun) {
                return $query->whereMonth('tanggal', $bulan)
                    ->whereYear('tanggal', $tahun);
            })
            ->get();

        $jabatan = Jabatan::all();
        $karyawan = Karyawan::all();

        return view('absensi.lembur.index', compact(
            'lemburs',
            'jabatan',
            'karyawan',
            'jabatanId',
            'monthInput'
        ));
    }

    public function getKaryawanByJabatan($jabatan_id)
    {

        $karyawan = Karyawan::where('jabatan_id', $jabatan_id)->get();
        return response()->json($karyawan);
    }


    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'karyawan_id'    => 'required|exists:karyawans,id',

                'tanggal'        => 'required|date',
                'jam_mulai'      => 'required|date_format:H:i',
                'jam_selesai'    => 'required|date_format:H:i|after:jam_mulai',
            ]);


            $start = strtotime($request->jam_mulai);
            $end = strtotime($request->jam_selesai);
            $totalJam = round(($end - $start) / 3600);

            $validated['total_jam'] = $totalJam;

            Lembur::create($validated);

            return redirect()->back()->with('success', 'Data lembur berhasil ditambahkan');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'Terjadi kesalahan saat menambahkan lembur');
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $validated = $request->validate([
                'karyawan_id'    => 'required|exists:karyawans,id',

                'tanggal'        => 'required|date',
                'jam_mulai'      => 'required|date_format:H:i',
                'jam_selesai'    => 'required|date_format:H:i|after:jam_mulai',
            ]);

            $start = strtotime($request->jam_mulai);
            $end = strtotime($request->jam_selesai);
            $totalJam = round(($end - $start) / 3600);

            $validated['total_jam'] = $totalJam;

            $lembur = Lembur::findOrFail($id);
            $lembur->update($validated);

            return redirect()->back()->with('success', 'Data lembur berhasil diperbarui');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'Terjadi kesalahan saat memperbarui lembur');
        }
    }
}
