<?php

namespace App\Http\Controllers\Web\Moora;

use App\Http\Controllers\Controller;
use App\Models\{Absensi, Jabatan, PenilaianKaryawan, Karyawan, Kriteria, Lembur, SubKriteria};
use Illuminate\Http\Request;

class PenilaianKaryawanController extends Controller
{
    public function index()
    {
        $jabatans = Jabatan::all();
        return view('moora.penilaian.jabatan', compact('jabatans'));
    }

    public function tampilkanKaryawanByJabatan(Request $request, $jabatan_id)
    {
        $bulan = $request->bulan ?? now()->month;
        $tahun = $request->tahun ?? now()->year;

        $jabatan = Jabatan::findOrFail($jabatan_id);
        $karyawans = Karyawan::where('jabatan_id', $jabatan_id)->get();
        $kriterias = Kriteria::with('subKriterias')->get();

        $penilaian = PenilaianKaryawan::whereHas('karyawan', function ($query) use ($jabatan_id) {
            $query->where('jabatan_id', $jabatan_id);
        })
            ->where('bulan', $bulan)
            ->where('tahun', $tahun)
            ->with('karyawan')
            ->get();

        return view('moora.penilaian.index', compact('karyawans', 'kriterias', 'jabatan', 'penilaian', 'bulan', 'tahun'));
    }


    public function store(Request $request)
    {
        $validated = $request->validate([
            'karyawan_id' => 'required|exists:karyawans,id',
            'penilaian' => 'required|array',
            'penilaian.*' => 'nullable|numeric',
            'bulan' => 'required|integer|min:1|max:12',
            'tahun' => 'required|integer|min:2000|max:2100',
        ]);

        $karyawan = Karyawan::findOrFail($validated['karyawan_id']);
        $bulan = $validated['bulan'];
        $tahun = $validated['tahun'];

        $kriterias = Kriteria::with('subKriterias')->get();

        foreach ($kriterias as $kriteria) {
            $kriteria_id = $kriteria->id;
            $nilai = null;

            if (strtolower($kriteria->nama) === 'keterlambatan') {
                // Ambil total keterlambatan dari absensi
                $totalMenit = \App\Models\Absensi::where('karyawan_id', $karyawan->id)
                    ->whereMonth('tanggal', $bulan)
                    ->whereYear('tanggal', $tahun)
                    ->sum('keterlambatan');

                $subKriteria = $kriteria->subKriterias()
                    ->where('min_value', '<=', $totalMenit)
                    ->where('max_value', '>=', $totalMenit)
                    ->first();

                $nilai = $subKriteria ? $subKriteria->bobot : 0;
            } else if (strtolower($kriteria->nama) === 'lembur') {
                $totalJam = \App\Models\Lembur::where('karyawan_id', $karyawan->id)
                    ->whereMonth('tanggal', $bulan)
                    ->whereYear('tanggal', $tahun)
                    ->sum('total_jam');

                $subKriteria = $kriteria->subKriterias()
                    ->where('min_value', '<=', $totalJam)
                    ->where('max_value', '>=', $totalJam)
                    ->first();

                $nilai = $subKriteria ? $subKriteria->bobot : 0;
            } else {
                // Ambil dari input user biasa
                if (!isset($validated['penilaian'][$kriteria_id])) continue;

                $nilaiInput = $validated['penilaian'][$kriteria_id];

                $subKriteria = $kriteria->subKriterias()
                    ->where('min_value', '<=', $nilaiInput)
                    ->where('max_value', '>=', $nilaiInput)
                    ->first();

                $nilai = $nilaiInput;
            }

            if (!$subKriteria) {
                return back()->with('error', "Sub kriteria tidak ditemukan untuk kriteria: {$kriteria->nama}");
            }

            PenilaianKaryawan::updateOrCreate(
                [
                    'karyawan_id' => $karyawan->id,
                    'kriteria_id' => $kriteria_id,
                    'bulan' => $bulan,
                    'tahun' => $tahun,
                ],
                [
                    'nilai' => $nilai,
                    'sub_kriteria_id' => $subKriteria->id,
                ]
            );
        }

        return back()->with('success', 'Penilaian berhasil disimpan.');
    }

    public function update(Request $request, $id)
    {
        return $this->store($request); // Sederhanakan update dengan menggunakan logika store
    }

    public function destroy($karyawan_id)
    {
        PenilaianKaryawan::where('karyawan_id', $karyawan_id)->delete();
        return back()->with('success', 'Penilaian karyawan berhasil dihapus.');
    }


    public function rekapKeterlambatanBulanan($bulan, $tahun)
    {
        $kriteria = Kriteria::where('nama', 'Keterlambatan')->first();
        if (!$kriteria) {
            return 'Kriteria "Keterlambatan" belum dibuat.';
        }

        $karyawans = Karyawan::all();

        foreach ($karyawans as $karyawan) {
            $totalMenit = Absensi::where('karyawan_id', $karyawan->id)
                ->whereMonth('tanggal', $bulan)
                ->whereYear('tanggal', $tahun)
                ->sum('keterlambatan');


            $subKriteria = SubKriteria::where('kriteria_id', $kriteria->id)
                ->where('min_value', '<=', $totalMenit)
                ->where('max_value', '>=', $totalMenit)
                ->first();

            $nilai = $subKriteria ? $subKriteria->bobot : 0;

            PenilaianKaryawan::updateOrCreate(
                [
                    'karyawan_id' => $karyawan->id,
                    'kriteria_id' => $kriteria->id,
                    'bulan' => $bulan,
                    'tahun' => $tahun
                ],
                [
                    'nilai' => $nilai
                ]
            );
        }

        return 'Rekap keterlambatan berhasil disimpan.';
    }

    public function rekapLemburBulanan($bulan, $tahun)
    {
        $kriteria = Kriteria::where('nama', 'Lembur')->first();
        if (!$kriteria) {
            return 'Kriteria "Lembur" belum dibuat.';
        }

        $karyawans = Karyawan::all();

        foreach ($karyawans as $karyawan) {
            $totalMenit = Lembur::where('karyawan_id', $karyawan->id)
                ->whereMonth('tanggal', $bulan)
                ->whereYear('tanggal', $tahun)
                ->sum('Lembur');


            $subKriteria = SubKriteria::where('kriteria_id', $kriteria->id)
                ->where('min_value', '<=', $totalMenit)
                ->where('max_value', '>=', $totalMenit)
                ->first();

            $nilai = $subKriteria ? $subKriteria->bobot : 0;

            PenilaianKaryawan::updateOrCreate(
                [
                    'karyawan_id' => $karyawan->id,
                    'kriteria_id' => $kriteria->id,
                    'bulan' => $bulan,
                    'tahun' => $tahun
                ],
                [
                    'nilai' => $nilai
                ]
            );
        }

        return 'Rekap Lembur berhasil disimpan.';
    }
}
