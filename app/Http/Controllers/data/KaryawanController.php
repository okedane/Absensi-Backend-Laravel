<?php

namespace App\Http\Controllers\Data;

use App\Http\Controllers\Controller;
use App\Models\Jabatan;
use App\Models\Karyawan;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Unique;

class KaryawanController extends Controller
{

    public function index($id)
    {
        $karyawan = Karyawan::where('jabatan_id', $id)->orderBy('created_at', 'asc')->get();
        $jabatan = Jabatan::findOrFail($id);
        return view('data.karyawa.index', compact('karyawan', 'jabatan'));
    }

    public function post(Request $request)
    {
        try {

            $validated = $request->validate([
                'nomor_karyawan' => 'required|unique:karyawans,nomor_karyawan',
                // 'foto' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                'tanggal_masuk' => 'required|date',
                'name' => 'required',
                'email' => 'required|email|unique:users,email',
                'password' => 'required|min:6',
                'jabatan_id' => 'required|exists:jabatans,id',
            ]);


            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => bcrypt($request->password),
            ]);


            Karyawan::create([
                'nomor_karyawan' => $request->nomor_karyawan,
                'tanggal_masuk' => $request->tanggal_masuk,
                'jabatan_id' => $request->jabatan_id,
                'user_id' => $user->id,
            ]);

            return redirect()->back()->with('success', 'Karyawan berhasil ditambahkan');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'Terjadi kesalahan saat menambahkan Karyawan. Silakan coba lagi. ' . $th->getMessage());
        }
    }


    public function put(Request $request, $id)
    {
        try {
            $validated = $request->validate([
                'nomor_karyawan' => 'required|unique:karyawans,nomor_karyawan',
                'name'          => 'required|string|max:255',
                'email'         => 'required|email|unique:users,email,' . $request->user_id,
                'password'      => 'nullable|min:6',
            ]);

            $karyawan = Karyawan::findOrFail($id);
            $karyawan->update([
                'nomor_karyawan' => $validated['nomor_karyawan'],
                'tanggal_masuk' => $validated['tanggal_masuk'],
            ]);

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




    public function delete($id)
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
