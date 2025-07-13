<?php

namespace App\Http\Controllers\Web\Moora;

use App\Http\Controllers\Controller;
use App\Models\Jabatan;
use App\Models\Karyawan;
use App\Models\Kriteria;
use App\Models\PenilaianKaryawan;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf; // Pastikan Anda sudah menginstal barryvdh/laravel-dompdf

class MooraController extends Controller
{
    public function pilihJabatan()
    {
        $jabatans = Jabatan::all();
        return view('moora.perhitungan.jabatan', compact('jabatans'));
    }

    public function hasil(Request $request, $jabatan_id)
    {
        $bulan = $request->input('bulan', now()->month);
        $tahun = $request->input('tahun', now()->year);

        $kriterias = Kriteria::all();
        $karyawans = Karyawan::where('jabatan_id', $jabatan_id)
            ->whereHas('penilaians', function ($query) use ($bulan, $tahun) {
                $query->where('bulan', $bulan)->where('tahun', $tahun);
            })
            ->get();

        $adaPenilaian = PenilaianKaryawan::whereIn('karyawan_id', $karyawans->pluck('id'))
            ->where('bulan', $bulan)
            ->where('tahun', $tahun)
            ->exists();

        if (!$adaPenilaian) {
            return view('moora.perhitungan.index', [
                'kriterias' => $kriterias,
                'matriksKeputusan' => [],
                'normalisasi' => [],
                'matriksTerbobot' => [],
                'hasilMoora' => [],
                'bulan' => $bulan,
                'tahun' => $tahun,
                'jabatan_id' => $jabatan_id,
            ]);
        }

        // 1. Matriks Keputusan
        $matriksKeputusan = [];
        foreach ($karyawans as $karyawan) {
            $data = ['nama_karyawan' => $karyawan->user->name, 'keputusan' => []];
            foreach ($kriterias as $kriteria) {
                $penilaian = PenilaianKaryawan::where('karyawan_id', $karyawan->id)
                    ->where('kriteria_id', $kriteria->id)
                    ->where('bulan', $bulan)
                    ->where('tahun', $tahun)->first();

                $data['keputusan'][$kriteria->id] = $penilaian ? $penilaian->nilai : 0;
            }
            $matriksKeputusan[] = $data;
        }

        // 2. Normalisasi Matriks
        $pembagi = [];
        foreach ($kriterias as $kriteria) {
            $totalKuadrat = 0;
            foreach ($matriksKeputusan as $data) {
                $totalKuadrat += pow($data['keputusan'][$kriteria->id], 2);
            }
            $pembagi[$kriteria->id] = sqrt($totalKuadrat);
        }

        $normalisasi = [];
        foreach ($matriksKeputusan as $data) {
            $normal = ['nama_karyawan' => $data['nama_karyawan'], 'normalisasi' => []];
            foreach ($data['keputusan'] as $kriteria_id => $nilai) {
                $normal['normalisasi'][$kriteria_id] = $pembagi[$kriteria_id] != 0
                    ? $nilai / $pembagi[$kriteria_id]
                    : 0;
            }
            $normalisasi[] = $normal;
        }

        // 3. Matriks Terbobot
        $matriksTerbobot = [];
        foreach ($normalisasi as $data) {
            $row = ['nama_karyawan' => $data['nama_karyawan'], 'terbobot' => []];
            foreach ($data['normalisasi'] as $kriteria_id => $nilaiNormal) {
                $bobot = $kriterias->firstWhere('id', $kriteria_id)->bobot;
                $row['terbobot'][$kriteria_id] = $nilaiNormal * $bobot;
            }
            $matriksTerbobot[] = $row;
        }

        // 4. Hitung Yi
        $hasilMoora = [];
        foreach ($matriksTerbobot as $data) {
            $benefit = $cost = 0;
            foreach ($data['terbobot'] as $kriteria_id => $nilai) {
                $sifat = $kriterias->firstWhere('id', $kriteria_id)->sifat;
                if ($sifat === 'benefit') {
                    $benefit += $nilai;
                } else {
                    $cost += $nilai;
                }
            }

            $hasilMoora[] = [
                'nama_karyawan' => $data['nama_karyawan'],
                'max' => $benefit,
                'min' => $cost,
                'yi' => $benefit - $cost,
            ];
        }


        usort($hasilMoora, fn($a, $b) => $b['yi'] <=> $a['yi']);

        return view('moora.perhitungan.index', compact('kriterias', 'matriksKeputusan', 'normalisasi', 'matriksTerbobot', 'hasilMoora', 'bulan', 'tahun', 'jabatan_id'));
    }

















    public function pilihJabatanAkhir()
    {
        $jabatans = Jabatan::all();
        return view('moora.hasil.jabatan', compact('jabatans'));
    }


    public function hasilAkhir(Request $request, $jabatan_id)
    {
        $bulan = $request->input('bulan', now()->month);
        $tahun = $request->input('tahun', now()->year);

        $kriterias = Kriteria::all();
        $karyawans = Karyawan::where('jabatan_id', $jabatan_id)
            ->whereHas('penilaians', function ($query) use ($bulan, $tahun) {
                $query->where('bulan', $bulan)->where('tahun', $tahun);
            })
            ->get();

        $adaPenilaian = PenilaianKaryawan::whereIn('karyawan_id', $karyawans->pluck('id'))
            ->where('bulan', $bulan)
            ->where('tahun', $tahun)
            ->exists();

        if (!$adaPenilaian) {
            return view('moora.hasil.index', [
                'kriterias' => $kriterias,
                'matriksKeputusan' => [],
                'normalisasi' => [],
                'matriksTerbobot' => [],
                'hasilMoora' => [],
                'bulan' => $bulan,
                'tahun' => $tahun,
                'jabatan_id' => $jabatan_id,
            ]);
        }

        // 1. Matriks Keputusan
        $matriksKeputusan = [];
        foreach ($karyawans as $karyawan) {
            $data = ['nama_karyawan' => $karyawan->user->name, 'keputusan' => []];
            foreach ($kriterias as $kriteria) {
                $penilaian = PenilaianKaryawan::where('karyawan_id', $karyawan->id)->where('kriteria_id', $kriteria->id)->where('bulan', $bulan)->where('tahun', $tahun)->first();
                $data['keputusan'][$kriteria->id] = $penilaian ? $penilaian->nilai : 0;
            }
            $matriksKeputusan[] = $data;
        }

        // 2. Normalisasi Matriks
        $pembagi = [];
        foreach ($kriterias as $kriteria) {
            $totalKuadrat = 0;
            foreach ($matriksKeputusan as $data) {
                $totalKuadrat += pow($data['keputusan'][$kriteria->id], 2);
            }
            $pembagi[$kriteria->id] = sqrt($totalKuadrat);
        }

        $normalisasi = [];
        foreach ($matriksKeputusan as $data) {
            $normal = ['nama_karyawan' => $data['nama_karyawan'], 'normalisasi' => []];
            foreach ($data['keputusan'] as $kriteria_id => $nilai) {
                $normal['normalisasi'][$kriteria_id] = $pembagi[$kriteria_id] != 0 ? $nilai / $pembagi[$kriteria_id] : 0;
            }
            $normalisasi[] = $normal;
        }

        // 3. Matriks Terbobot
        $matriksTerbobot = [];
        foreach ($normalisasi as $data) {
            $row = ['nama_karyawan' => $data['nama_karyawan'], 'terbobot' => []];
            foreach ($data['normalisasi'] as $kriteria_id => $nilaiNormal) {
                $bobot = $kriterias->firstWhere('id', $kriteria_id)->bobot;
                $row['terbobot'][$kriteria_id] = $nilaiNormal * $bobot;
            }
            $matriksTerbobot[] = $row;
        }

        // 4. Hitung Max (Benefit) - Min (Cost) - Yi
        $hasilMoora = [];
        foreach ($matriksTerbobot as $data) {
            $benefit = $cost = 0;
            foreach ($data['terbobot'] as $kriteria_id => $nilai) {
                $sifat = $kriterias->firstWhere('id', $kriteria_id)->sifat;
                if ($sifat === 'benefit') {
                    $benefit += $nilai;
                } else {
                    $cost += $nilai;
                }
            }
            $hasilMoora[] = [
                'nama_karyawan' => $data['nama_karyawan'],
                'max' => $benefit,
                'min' => $cost,
                'yi' => $benefit - $cost,
            ];
        }

        // Urutkan berdasarkan Yi tertinggi
        usort($hasilMoora, fn($a, $b) => $b['yi'] <=> $a['yi']);


        $peringkat = 1;
        $rankingFix = [];
        $prevYi = null;
        $counter = 1; // posisi sebenarnya dalam list

        foreach ($hasilMoora as $index => $data) {
            if ($prevYi !== null && $data['yi'] != $prevYi) {
                $peringkat = $counter;
            }

            $data['ranking'] = $peringkat;
            $rankingFix[] = $data;

            $prevYi = $data['yi'];
            $counter++;
        }

        $hasilMoora = $rankingFix;

        return view('moora.hasil.index', compact('hasilMoora', 'bulan', 'tahun', 'jabatan_id'));
    }



    public function cetakPDF(Request $request, $jabatan_id)
    {
        $bulan = $request->input('bulan', now()->month);
        $tahun = $request->input('tahun', now()->year);

        $kriterias = Kriteria::all();
        $karyawans = Karyawan::where('jabatan_id', $jabatan_id)
            ->whereHas('penilaians', function ($query) use ($bulan, $tahun) {
                $query->where('bulan', $bulan)->where('tahun', $tahun);
            })
            ->get();

        // Cek jika tidak ada penilaian
        $adaPenilaian = PenilaianKaryawan::whereIn('karyawan_id', $karyawans->pluck('id'))
            ->where('bulan', $bulan)
            ->where('tahun', $tahun)
            ->exists();

        if (!$adaPenilaian) {
            return back()->with('error', 'Tidak ada data penilaian.');
        }

        // 1. Matriks Keputusan
        $matriksKeputusan = [];
        foreach ($karyawans as $karyawan) {
            $data = ['nama_karyawan' => $karyawan->user->name, 'keputusan' => []];
            foreach ($kriterias as $kriteria) {
                $penilaian = PenilaianKaryawan::where('karyawan_id', $karyawan->id)
                    ->where('kriteria_id', $kriteria->id)
                    ->where('bulan', $bulan)
                    ->where('tahun', $tahun)
                    ->first();
                $data['keputusan'][$kriteria->id] = $penilaian ? $penilaian->nilai : 0;
            }
            $matriksKeputusan[] = $data;
        }

        // 2. Normalisasi Matriks
        $pembagi = [];
        foreach ($kriterias as $kriteria) {
            $totalKuadrat = 0;
            foreach ($matriksKeputusan as $data) {
                $totalKuadrat += pow($data['keputusan'][$kriteria->id], 2);
            }
            $pembagi[$kriteria->id] = sqrt($totalKuadrat);
        }

        $normalisasi = [];
        foreach ($matriksKeputusan as $data) {
            $normal = ['nama_karyawan' => $data['nama_karyawan'], 'normalisasi' => []];
            foreach ($data['keputusan'] as $kriteria_id => $nilai) {
                $normal['normalisasi'][$kriteria_id] = $pembagi[$kriteria_id] != 0 ? $nilai / $pembagi[$kriteria_id] : 0;
            }
            $normalisasi[] = $normal;
        }

        // 3. Matriks Terbobot
        $matriksTerbobot = [];
        foreach ($normalisasi as $data) {
            $row = ['nama_karyawan' => $data['nama_karyawan'], 'terbobot' => []];
            foreach ($data['normalisasi'] as $kriteria_id => $nilaiNormal) {
                $bobot = $kriterias->firstWhere('id', $kriteria_id)->bobot / 100;
                $row['terbobot'][$kriteria_id] = $nilaiNormal * $bobot;
            }
            $matriksTerbobot[] = $row;
        }

        // 4. Hitung Yi
        $hasilMoora = [];
        foreach ($matriksTerbobot as $data) {
            $benefit = $cost = 0;
            foreach ($data['terbobot'] as $kriteria_id => $nilai) {
                $sifat = $kriterias->firstWhere('id', $kriteria_id)->sifat;
                if ($sifat === 'benefit') {
                    $benefit += $nilai;
                } else {
                    $cost += $nilai;
                }
            }
            $hasilMoora[] = [
                'nama_karyawan' => $data['nama_karyawan'],
                'yi' => $benefit - $cost,
            ];
        }

        usort($hasilMoora, fn($a, $b) => $b['yi'] <=> $a['yi']);

        $jabatan = Jabatan::findOrFail($jabatan_id);

        $pdf = Pdf::loadView('moora.hasil.pdf', compact('hasilMoora', 'jabatan', 'bulan', 'tahun'));
        return $pdf->stream("Hasil_MOORA_{$jabatan->nama}_{$bulan}_{$tahun}.pdf");
    }

    public function cetakPerhitunganPDF(Request $request, $jabatan_id)
    {
        $bulan = $request->input('bulan', now()->month);
        $tahun = $request->input('tahun', now()->year);

        $kriterias = Kriteria::all();
        $karyawans = Karyawan::where('jabatan_id', $jabatan_id)
            ->whereHas('penilaians', function ($query) use ($bulan, $tahun) {
                $query->where('bulan', $bulan)->where('tahun', $tahun);
            })
            ->get();

        // Cek jika tidak ada penilaian
        $adaPenilaian = PenilaianKaryawan::whereIn('karyawan_id', $karyawans->pluck('id'))
            ->where('bulan', $bulan)
            ->where('tahun', $tahun)
            ->exists();

        if (!$adaPenilaian) {
            return back()->with('error', 'Tidak ada data penilaian.');
        }

        // 1. Matriks Keputusan
        $matriksKeputusan = [];
        foreach ($karyawans as $karyawan) {
            $data = ['nama_karyawan' => $karyawan->user->name, 'keputusan' => []];
            foreach ($kriterias as $kriteria) {
                $penilaian = PenilaianKaryawan::where('karyawan_id', $karyawan->id)
                    ->where('kriteria_id', $kriteria->id)
                    ->where('bulan', $bulan)
                    ->where('tahun', $tahun)
                    ->first();
                $data['keputusan'][$kriteria->id] = $penilaian ? $penilaian->nilai : 0;
            }
            $matriksKeputusan[] = $data;
        }

        // 2. Normalisasi Matriks
        $pembagi = [];
        foreach ($kriterias as $kriteria) {
            $totalKuadrat = 0;
            foreach ($matriksKeputusan as $data) {
                $totalKuadrat += pow($data['keputusan'][$kriteria->id], 2);
            }
            $pembagi[$kriteria->id] = sqrt($totalKuadrat);
        }

        $normalisasi = [];
        foreach ($matriksKeputusan as $data) {
            $normal = ['nama_karyawan' => $data['nama_karyawan'], 'normalisasi' => []];
            foreach ($data['keputusan'] as $kriteria_id => $nilai) {
                $normal['normalisasi'][$kriteria_id] = $pembagi[$kriteria_id] != 0 ? $nilai / $pembagi[$kriteria_id] : 0;
            }
            $normalisasi[] = $normal;
        }

        // 3. Matriks Terbobot
        $matriksTerbobot = [];
        foreach ($normalisasi as $data) {
            $row = ['nama_karyawan' => $data['nama_karyawan'], 'terbobot' => []];
            foreach ($data['normalisasi'] as $kriteria_id => $nilaiNormal) {
                $bobot = $kriterias->firstWhere('id', $kriteria_id)->bobot / 100;
                $row['terbobot'][$kriteria_id] = $nilaiNormal * $bobot;
            }
            $matriksTerbobot[] = $row;
        }

        // 4. Hitung Yi
        $hasilMoora = [];
        foreach ($matriksTerbobot as $data) {
            $benefit = $cost = 0;
            foreach ($data['terbobot'] as $kriteria_id => $nilai) {
                $sifat = $kriterias->firstWhere('id', $kriteria_id)->sifat;
                if ($sifat === 'benefit') {
                    $benefit += $nilai;
                } else {
                    $cost += $nilai;
                }
            }
            $hasilMoora[] = [
                'nama_karyawan' => $data['nama_karyawan'],
                'yi' => $benefit - $cost,
            ];
        }

        usort($hasilMoora, fn($a, $b) => $b['yi'] <=> $a['yi']);

        $jabatan = Jabatan::findOrFail($jabatan_id);

        $pdf = Pdf::loadView('moora.perhitungan.pdf', [
            'matriksKeputusan' => $matriksKeputusan,
            'normalisasi' => $normalisasi,
            'matriksTerbobot' => $matriksTerbobot,
            'hasilMoora' => $hasilMoora,
            'kriterias' => $kriterias,
            'bulan' => $bulan,
            'tahun' => $tahun,
            'jabatan' => $jabatan,
        ]);

        return $pdf->stream("Hasil_MOORA_{$jabatan->nama}_{$bulan}_{$tahun}.pdf");
    }
}
