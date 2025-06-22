<?php

namespace App\Http\Controllers\Web\Moora;

use App\Http\Controllers\Controller;
use App\Models\{Jabatan, PenilaianKaryawan, Karyawan, Kriteria, SubKriteria};
use Illuminate\Http\Request;

class PenilaianKaryawanController extends Controller
{
    public function index()
    {
        $jabatans = Jabatan::all();
        return view('moora.penilaian.jabatan', compact('jabatans'));
    }

    public function tampilkanKaryawanByJabatan($jabatan_id)
    {
        $jabatan = Jabatan::findOrFail($jabatan_id);
        $karyawans = Karyawan::where('jabatan_id', $jabatan_id)->get();
        $kriterias = Kriteria::all();
        $penilaian = PenilaianKaryawan::whereHas('karyawan', function ($query) use ($jabatan_id) {
            $query->where('jabatan_id', $jabatan_id);
        })->with('karyawan')->get();

        return view('moora.penilaian.index', compact('karyawans', 'kriterias', 'jabatan', 'penilaian'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'karyawan_id' => 'required|exists:karyawans,id',
            'penilaian' => 'required|array',
            'penilaian.*' => 'required|numeric',
        ]);

        $karyawan = Karyawan::findOrFail($validated['karyawan_id']);

        foreach ($validated['penilaian'] as $kriteria_id => $nilai) {
            $subKriteria = SubKriteria::where('kriteria_id', $kriteria_id)
                ->where('min_value', '<=', $nilai)
                ->where('max_value', '>=', $nilai)
                ->first();

            if (!$subKriteria) {
                return back()->with('error', "Sub kriteria tidak ditemukan untuk nilai: $nilai (Kriteria ID: $kriteria_id)");
            }

            PenilaianKaryawan::updateOrCreate(
                [
                    'karyawan_id' => $karyawan->id,
                    'kriteria_id' => $kriteria_id,
                    'bulan' => now()->month,
                    'tahun' => now()->year,
                ],
                [
                    'nilai' => $nilai,
                    'sub_kriteria_id' => $subKriteria->id,
                ]
            );
        }

        return back()->with('success', 'Penilaian berhasil disimpan');
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
}
