<?php

namespace App\Http\Controllers\Web\Moora;

use App\Http\Controllers\Controller;
use App\Models\Kriteria;
use App\Models\SubKriteria;
use Illuminate\Http\Request;

class SubKriteriaController extends Controller
{
    public function index($id)
    {
        $subKriteria = SubKriteria::where('kriteria_id', $id)->orderBy('created_at', 'asc')->get();
        $kriteria = Kriteria::findOrFail($id);
        return view('moora.subKriteria.index', compact('subKriteria', 'kriteria'));
    }

    public function post(Request $request)
    {
        try {
            $validated = $request->validate([
                'kriteria_id'  => 'required',
                'nama'         => 'required',
                'min_value'    => 'required|numeric|min:0',
                'max_value'    => 'required|numeric|min:0|gte:min_value',
                'bobot'        => 'required|numeric|min:0'
            ]);

            
            $overlap = SubKriteria::where('kriteria_id', $validated['kriteria_id'])
                ->where(function ($query) use ($validated) {
                    $query->where('min_value', '<=', $validated['max_value'])
                        ->where('max_value', '>=', $validated['min_value']);
                })
                ->exists();

            if ($overlap) {
                return redirect()->back()->with('error', 'Rentang nilai (min-max) bertabrakan dengan subkriteria lain.');
            }

            $bobotSama = SubKriteria::where('kriteria_id', $validated['kriteria_id'])
                ->where('bobot', $validated['bobot'])
                ->exists();

            if ($bobotSama) {
                return redirect()->back()->with('error', 'Nilai bobot sudah digunakan pada subkriteria lain.');
            }

            
            SubKriteria::create($validated);
            return redirect()->back()->with('success', 'Subkriteria berhasil ditambahkan');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'Terjadi kesalahan saat menambahkan subkriteria. Silakan coba lagi.');
        }
    }



    public function put(Request $request, $id)
    {
        try {
            $validated = $request->validate([
                'nama'                => 'required',
                'min_value'           => 'required|numeric|min:0',
                'max_value'           => 'required|numeric|min:0',
                'bobot'               => 'required|numeric|min:0'
            ]);

            $subKriteria = SubKriteria::findOrFail($id);
            
            $subKriteria->update($validated);

            return redirect()->back()->with('success', 'SubKriteria berhasil diperbarui');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'Terjadi kesalahan saat memperbarui SubKriteria. Silakan coba lagi.');
        }
    }

    public function delete($id)
    {
        $subKriteria = SubKriteria::findOrfail($id);
        $subKriteria->delete();

        return back()->with('success', 'data telah dihapus');
    }
}
