<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
// use App\Models\JadwalKerja; // Uncomment jika sudah ada model

class JadwalKerjaController extends Controller
{
    public function index()
    {
        // $jadwalKerjas = JadwalKerja::orderBy('created_at', 'asc')->get();
        // return view('jadwal_kerja.index', compact('jadwalKerjas'));
        return view('jadwal_kerja.index');
    }

    public function create()
    {
        return view('jadwal_kerja.create');
    }

    public function store(Request $request)
    {
        try {
            $validatedData = $request->validate([
                'nama_jadwal' => 'required|string|max:255',
                'hari' => 'required|array',
                'jam_masuk' => 'required|date_format:H:i',
                'jam_keluar' => 'required|date_format:H:i',
            ]);

            // JadwalKerja::create($validatedData);

            return redirect()->route('jadwal_kerja.index')->with('success', 'Jadwal kerja berhasil dibuat.');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'Terjadi kesalahan saat membuat jadwal kerja. Silakan coba lagi.');
        }
    }

    public function edit($id)
    {
        // $jadwalKerja = JadwalKerja::findOrFail($id);
        return view('jadwal_kerja.edit', compact('id'));
    }

    public function update(Request $request, $id)
    {
        try {
            $validatedData = $request->validate([
                'nama_jadwal' => 'required|string|max:255',
                'hari' => 'required|array',
                'jam_masuk' => 'required|date_format:H:i',
                'jam_keluar' => 'required|date_format:H:i',
            ]);

            // $jadwalKerja = JadwalKerja::findOrFail($id);
            // $jadwalKerja->update($validatedData);

            return redirect()->route('jadwal_kerja.index')->with('success', 'Jadwal kerja berhasil diperbarui.');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'Terjadi kesalahan saat memperbarui jadwal kerja. Silakan coba lagi.');
        }
    }

    public function destroy($id)
    {
        try {
            // $jadwalKerja = JadwalKerja::findOrFail($id);
            // $jadwalKerja->delete();

            return redirect()->route('jadwal_kerja.index')->with('success', 'Jadwal kerja berhasil dihapus.');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'Terjadi kesalahan saat menghapus jadwal kerja. Silakan coba lagi.');
        }
    }
}
