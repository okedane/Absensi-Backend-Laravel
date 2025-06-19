<?php

namespace App\Http\Controllers\Web\Data;

use App\Http\Controllers\Controller;
use App\Models\Jabatan;
use Illuminate\Http\Request;

class JabatanController extends Controller
{
    public function index()
    {
        $jabatan = Jabatan::orderBy('created_at', 'asc')->get();
        return view('data.jabatan.index', compact('jabatan'));
    }

    public function post(Request $request)
    {
        try {
            $validated = $request->validate([
                'nama_jabatan'  => 'required',
            ]);

            Jabatan::create($validated);
            return redirect()->back()->with('success', 'Jabatan berhasil di tambahkan');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'Terjadi kesalahan saat menambahkan Jabatan. Silakan coba lagi.');
        }
    }

    public function put (Request $request, $id)
    {
        try {
            $validated = $request->validate([
                'nama_jabatan'              => 'required',
            ]);

            $jabatan = Jabatan::findOrFail($id);
            $jabatan->update($validated);

            return redirect()->back()->with('success', 'Jabatan berhasil diperbarui');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'Terjadi kesalahan saat memperbarui Jabatan. Silakan coba lagi.');
        }
    }

    public function delete($id)
    {
        $jabatan = Jabatan::findOrfail($id);
        $jabatan->delete();

        return back()->with('success', 'data telah dihapus');
    }
}
