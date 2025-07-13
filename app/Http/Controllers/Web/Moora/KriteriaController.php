<?php

namespace App\Http\Controllers\Web\Moora;

use App\Http\Controllers\Controller;
use App\Models\Kriteria;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class KriteriaController extends Controller
{
    public function index()
    {
        $kriteria = Kriteria::orderBy('created_at', 'asc')->get();
        $totalBobot = Kriteria::sum('bobot');

        return view('moora.kriteria.index', compact('kriteria', 'totalBobot'));
    }

    public function post(Request $request)
    {
        try {
            // Validasi dasar
            $validated = $request->validate([
                'kode' => 'required|string|max:10|unique:kriterias,kode',
                'nama' => 'required|string|max:255|unique:kriterias,nama',
                'sifat' => 'required|in:benefit,cost',
                'bobot' => 'required|numeric|min:0.01|max:100',
            ], [
                'kode.required' => 'Kode kriteria wajib diisi.',
                'kode.unique' => 'Kode kriteria tersebut sudah ada.',
                'kode.max' => 'Kode kriteria maksimal 10 karakter.',
                'nama.required' => 'Nama kriteria wajib diisi.',
                'nama.unique' => 'Nama kriteria tersebut sudah ada.',
                'nama.max' => 'Nama kriteria maksimal 255 karakter.',
                'sifat.required' => 'Sifat kriteria wajib dipilih.',
                'sifat.in' => 'Sifat kriteria harus benefit atau cost.',
                'bobot.required' => 'Bobot wajib diisi.',
                'bobot.numeric' => 'Bobot harus berupa angka.',
                'bobot.min' => 'Bobot tidak boleh 0 atau kurang.',
                'bobot.max' => 'Bobot tidak boleh lebih dari 100.',
            ]);

            // Cek total bobot setelah ditambahkan
            $totalBobotSekarang = Kriteria::sum('bobot');
            $totalBobotBaru = $totalBobotSekarang + $validated['bobot'];

            if ($totalBobotBaru > 100) {
                $sisaBobot = 100 - $totalBobotSekarang;
                return redirect()->back()
                    ->withErrors(['bobot' => "Total bobot tidak boleh lebih dari 100%. Sisa bobot yang tersedia: {$sisaBobot}%"])
                    ->withInput($request->all());
            }

            // Normalisasi data
            $validated['kode'] = strtoupper(trim($validated['kode']));
            $validated['nama'] = trim($validated['nama']);
            $validated['nama'] = ucwords(strtolower($validated['nama']));

            Kriteria::create($validated);

            // Pesan berdasarkan total bobot
            $totalBobotAkhir = $totalBobotBaru;
            $pesanTambahan = '';

            if ($totalBobotAkhir < 100) {
                $kurangBobot = 100 - $totalBobotAkhir;
                $pesanTambahan = " Total bobot saat ini: {$totalBobotAkhir}%. Lengkapi bobot sampai 100% (masih perlu {$kurangBobot}% lagi).";
            } elseif ($totalBobotAkhir == 100) {
                $pesanTambahan = " Total bobot sudah mencapai 100%. Sempurna!";
            }

            return redirect()->back()->with('success', 'Kriteria berhasil ditambahkan.' . $pesanTambahan);
        } catch (ValidationException $e) {
            return redirect()->back()
                ->withErrors($e->errors())
                ->withInput($request->all());
        } catch (\Throwable $th) {
            return redirect()->back()
                ->with('error', 'Terjadi kesalahan saat menambahkan Kriteria. Silakan coba lagi.')
                ->withInput($request->all());
        }
    }

    public function put(Request $request, $id)
    {
        try {
            $kriteria = Kriteria::findOrFail($id);

            // Validasi dasar
            $validated = $request->validate([
                'kode' => 'required|string|max:10|unique:kriterias,kode,' . $id,
                'nama' => 'required|string|max:255|unique:kriterias,nama,' . $id,
                'sifat' => 'required|in:benefit,cost',
                'bobot' => 'required|numeric|min:0.01|max:100',
            ], [
                'kode.required' => 'Kode kriteria wajib diisi.',
                'kode.unique' => 'Kode kriteria tersebut sudah ada.',
                'kode.max' => 'Kode kriteria maksimal 10 karakter.',
                'nama.required' => 'Nama kriteria wajib diisi.',
                'nama.unique' => 'Nama kriteria tersebut sudah ada.',
                'nama.max' => 'Nama kriteria maksimal 255 karakter.',
                'sifat.required' => 'Sifat kriteria wajib dipilih.',
                'sifat.in' => 'Sifat kriteria harus benefit atau cost.',
                'bobot.required' => 'Bobot wajib diisi.',
                'bobot.numeric' => 'Bobot harus berupa angka.',
                'bobot.min' => 'Bobot tidak boleh 0 atau kurang.',
                'bobot.max' => 'Bobot tidak boleh lebih dari 100.',
            ]);

            // Cek total bobot setelah diupdate (kecuali bobot kriteria yang sedang diupdate)
            $totalBobotSekarang = Kriteria::where('id', '!=', $id)->sum('bobot');
            $totalBobotBaru = $totalBobotSekarang + $validated['bobot'];

            if ($totalBobotBaru > 100) {
                $sisaBobot = 100 - $totalBobotSekarang;
                return redirect()->back()
                    ->withErrors(['bobot' => "Total bobot tidak boleh lebih dari 100%. Sisa bobot yang tersedia: {$sisaBobot}%"])
                    ->withInput($request->all());
            }

            // Normalisasi data
            $validated['kode'] = strtoupper(trim($validated['kode']));
            $validated['nama'] = trim($validated['nama']);
            $validated['nama'] = ucwords(strtolower($validated['nama']));

            $kriteria->update($validated);

            // Pesan berdasarkan total bobot
            $totalBobotAkhir = $totalBobotBaru;
            $pesanTambahan = '';

            if ($totalBobotAkhir < 100) {
                $kurangBobot = 100 - $totalBobotAkhir;
                $pesanTambahan = " Total bobot saat ini: {$totalBobotAkhir}%. Lengkapi bobot sampai 100% (masih perlu {$kurangBobot}% lagi).";
            } elseif ($totalBobotAkhir == 100) {
                $pesanTambahan = " Total bobot sudah mencapai 100%. Sempurna!";
            }

            return redirect()->back()->with('success', 'Kriteria berhasil diperbarui.' . $pesanTambahan);
        } catch (ValidationException $e) {
            return redirect()->back()
                ->withErrors($e->errors())
                ->withInput($request->all());
        } catch (\Throwable $th) {
            return redirect()->back()
                ->with('error', 'Terjadi kesalahan saat memperbarui Kriteria. Silakan coba lagi.')
                ->withInput($request->all());
        }
    }

    public function delete($id)
    {
        $kriteria = Kriteria::findOrfail($id);
        $kriteria->delete();

        return back()->with('success', 'data telah dihapus');
    }

    public function checkTotalBobot()
    {
        $totalBobot = Kriteria::sum('bobot');
        $status = '';

        if ($totalBobot < 100) {
            $kurang = 100 - $totalBobot;
            $status = "Kurang {$kurang}%";
        } elseif ($totalBobot == 100) {
            $status = "Sempurna!";
        } else {
            $lebih = $totalBobot - 100;
            $status = "Lebih {$lebih}%";
        }

        return response()->json([
            'total_bobot' => $totalBobot,
            'status' => $status
        ]);
    }
}
