<?php

namespace App\Http\Controllers\Web\Data;

use App\Http\Controllers\Controller;
use App\Models\Jabatan;
use Illuminate\Validation\ValidationException;
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
                'nama_jabatan' => 'required|string|max:255|unique:jabatans,nama_jabatan',
            ], [
                'nama_jabatan.required' => 'Nama jabatan wajib diisi.',
                'nama_jabatan.string' => 'Nama jabatan harus berupa text.',
                'nama_jabatan.max' => 'Nama jabatan maksimal 255 karakter.',
                'nama_jabatan.unique' => 'Nama jabatan tersebut sudah ada.',
            ]);

            // Normalisasi nama jabatan (trim whitespace dan capitalize)
            $validated['nama_jabatan'] = trim($validated['nama_jabatan']);
            $validated['nama_jabatan'] = ucwords(strtolower($validated['nama_jabatan']));

            Jabatan::create($validated);
            return redirect()->back()->with('success', 'Jabatan berhasil ditambahkan');
        } catch (ValidationException $e) {
            // Tangani validation error secara khusus
            return redirect()->back()
                ->withErrors($e->validator->errors())
                ->withInput($request->all());
        } catch (\Throwable $th) {
            return redirect()->back()
                ->with('error', 'Terjadi kesalahan saat menambahkan Jabatan. Silakan coba lagi.')
                ->withInput($request->all());
        }
    }



    public function put(Request $request, $id)
    {
        try {
            $validated = $request->validate([
                'nama_jabatan' => 'required|string|max:255|unique:jabatans,nama_jabatan,' . $id,
            ], [
                'nama_jabatan.required' => 'Nama jabatan wajib diisi.',
                'nama_jabatan.string' => 'Nama jabatan harus berupa text.',
                'nama_jabatan.max' => 'Nama jabatan maksimal 255 karakter.',
                'nama_jabatan.unique' => 'Nama jabatan tersebut sudah ada.',
            ]);

            $jabatan = Jabatan::findOrFail($id);

            // Normalisasi nama jabatan
            $validated['nama_jabatan'] = trim($validated['nama_jabatan']);
            $validated['nama_jabatan'] = ucwords(strtolower($validated['nama_jabatan']));

            $jabatan->update($validated);

            return redirect()->back()->with('success', 'Jabatan berhasil diperbarui');
        } catch (ValidationException $e) {
            return redirect()->back()
                ->withErrors($e->errors())
                ->withInput($request->all());
        } catch (\Throwable $th) {
            return redirect()->back()
                ->with('error', 'Terjadi kesalahan saat memperbarui Jabatan. Silakan coba lagi.')
                ->withInput($request->all());
        }
    }


    public function delete($id)
    {
        $jabatan = Jabatan::findOrfail($id);
        $jabatan->delete();

        return back()->with('success', 'data telah dihapus');
    }
}
