<?php

namespace App\Http\Controllers\Web\Absensi;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\LokasiAbsensi;

class LokasiAbsensiController extends Controller
{
    public function index()
    {
        $LokasiRestoran = LokasiAbsensi::orderBy('created_at', 'asc')->get();
        return view('absensi.mapsKantor.index', compact('LokasiRestoran'));
    }

    public function post(Request $request)
    {
        try {
            $validated = $request->validate([
                'nama_lokasi'    => 'required|string|max:255',
                'latitude'       => 'required|numeric|between:-90,90',
                'longitude'      => 'required|numeric|between:-180,180',
                'radius_meter'   => 'required|numeric|min:1',
            ]);


            lokasiAbsensi::create($validated);
            return redirect()->back()->with('success', 'Lokasi berhasil di tambahkan');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'Terjadi kesalahan saat menambahkan Lokasi. Silakan coba lagi.');
        }
    }

    public function put(Request $request, $id)
    {
        try {
            $validated = $request->validate([
                'nama_lokasi'    => 'required|string|max:255',
                'latitude'       => 'required|numeric|between:-90,90',
                'longitude'      => 'required|numeric|between:-180,180',
                'radius_meter'   => 'required|numeric|min:1',
            ]);


            $LokasiRestoran = lokasiAbsensi::findOrFail($id);
            $LokasiRestoran->update($validated);

            return redirect()->back()->with('success', 'Lokasi berhasil diperbarui');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'Terjadi kesalahan saat memperbarui Lokasi. Silakan coba lagi.');
        }
    }

    public function delete($id)
    {
        $LokasiRestoran = lokasiAbsensi::findOrfail($id);
        $LokasiRestoran->delete();

        return back()->with('success', 'data telah dihapus');
    }
}
