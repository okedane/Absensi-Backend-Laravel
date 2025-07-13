<?php

namespace App\Http\Controllers\Web\Data;

use App\Http\Controllers\Controller;
use App\Models\Jabatan;
use App\Models\Karyawan;
use App\Models\User;
use Illuminate\Http\Request;

class KaryawanController extends Controller
{

    public function index($id)
    {
        $karyawan = Karyawan::where('jabatan_id', $id)->orderBy('created_at', 'asc')->get();
        $jabatan = Jabatan::findOrFail($id);
        return view('data.karyawa.index', compact('karyawan', 'jabatan'));
    }

    private function generateNomorKaryawan()
    {
        // Ambil nomor terbesar dari kolom 'nomor_karyawan'
        $last = Karyawan::orderBy('nomor_karyawan', 'desc')->first();

        if (!$last || !$last->nomor_karyawan) {
            return 'KRY001';
        }

        // Ambil angka dari belakang string (KRY028 -> 28)
        $lastNumber = (int) substr($last->nomor_karyawan, 3);

        // Langsung ambil nomor berikutnya tanpa cek exists
        $newNumber = $lastNumber + 1;

        // Format dengan 3 digit
        $nomorBaru = 'KRY' . str_pad($newNumber, 3, '0', STR_PAD_LEFT);

        return $nomorBaru;
    }




    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'name' => 'required',
                'email' => 'required|email|unique:users,email',
                'password' => 'required|min:6|confirmed',
                'jabatan_id' => 'required|exists:jabatans,id',
            ]);

            // Generate nomor karyawan otomatis
            $nomorKaryawan = $this->generateNomorKaryawan();

            // Simpan user
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => bcrypt($request->password),
                'role' => 'karyawan',
            ]);

            // Simpan karyawan
            Karyawan::create([
                'nomor_karyawan' => $nomorKaryawan,
                'tanggal_masuk' => $request->tanggal_masuk,
                'jabatan_id' => $request->jabatan_id,
                'user_id' => $user->id,
            ]);

            return redirect()->back()->with('success', 'Karyawan berhasil ditambahkan');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'Terjadi kesalahan saat menambahkan Karyawan. ' . $th->getMessage());
        }
    }



    public function update(Request $request, $id)
    {
        try {
            $validated = $request->validate([
                // 'nomor_karyawan' => 'required|unique:karyawans,nomor_karyawan,' . $id,
                'name'          => 'required|string|max:255',
                'email'         => 'required|email|unique:users,email,' . $request->user_id,
                'password'      => 'nullable|min:6',
            ]);

            $karyawan = Karyawan::findOrFail($id);

            // Update nomor_karyawan (jika diubah)
            $karyawan->update([
                'nomor_karyawan' => $validated['nomor_karyawan'],
            ]);

            // Update user
            $user = $karyawan->user;
            $user->email = $validated['email'];
            $user->name = $validated['name'];
            if (!empty($validated['password'])) {
                $user->password = bcrypt($validated['password']);
            }
            $user->save();

            return redirect()->back()->with('success', 'Data karyawan dan akun berhasil diperbarui');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'Terjadi kesalahan saat memperbarui data. ' . $th->getMessage());
        }
    }





    public function destroy($id)
    {
        try {

            $karyawan = Karyawan::where('user_id', $id)->firstOrFail();
            $user = User::findOrFail($id);


            $karyawan->delete();
            $user->delete();

            return back()->with('success', 'Karyawan & user berhasil dihapus');
        } catch (\Throwable $th) {
            return back()->with('error', 'Gagal menghapus karyawan & user. ' . $th->getMessage());
        }
    }
}
