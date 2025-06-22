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
                'kriteria_id'        => 'required',
                'nama'              => 'required',
                'min_value'          => 'required',
                'max_value'          => 'required',
                'bobot'              => 'required'

            ]);
            SubKriteria::create($validated);
            return redirect()->back()->with('success', 'subKriteria berhasil di tambahkan');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'Terjadi kesalahan saat menambahkan subKriteria. Silakan coba lagi.');
        }
    }

    public function put(Request $request, $id)
    {
        try {
            $validated = $request->validate([
                'nama'                => 'required',
                'min_value'           => 'required',
                'max_value'           => 'required',
                'bobot'               => 'required'
            ]);

            $subKriteria = SubKriteria::findOrFail($id);
            // dd($subKriteria);
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
