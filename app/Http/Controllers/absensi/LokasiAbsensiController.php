<?php

namespace App\Http\Controllers\absensi;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\LokasiAbsensi;

class LokasiAbsensiController extends Controller
{
    public function index()
    {
        $LokasiRestoran = lokasiAbsensi::orderBy('created_at', 'asc')->get();
        return view('absensi.mapsKantor.index', compact('LokasiRestoran'));
    }

    public function post(Request $request)
    {
        try {
            $validated = $request->validate([
                'nama_lokasi'  => 'required',
                'latitude'      => 'required|numeric',
                'longitude'     => 'required|numeric',
                'radius_meter'  => 'required|numeric',  
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
                'nama_lokasi'               => 'required',
                'latitude'                  => 'required|numeric',
                'longitude'                 => 'required|numeric',
                'radius_meter'              => 'required|numeric',
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
