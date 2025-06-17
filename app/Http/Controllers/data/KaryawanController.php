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
        $karyawan = Karyawan::where('id_jabatan', $id)->orderBy('created_at', 'asc')->get();
        $jabatan = Jabatan::findOrFail($id);
        return view('data.karyawan.index', compact('karyawan', 'jabatan'));
    }

    public function post(Request $request)
    {
        try {

            $validated = $request->validate([
                'nomor_karyawan' => 'required|unique:karyawan,nomor_karyawan',
                'name' => 'required',
                'email' => 'required|email|unique:users,email',
                'password' => 'required|min:6',
                'id_jabatan' => 'required|exists:jabatan,id',
            ]);


            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => bcrypt($request->password),
            ]);


            Karyawan::create([
                'nomor_karyawan' => $request->nomor_karyawan,
                'id_jabatan' => $request->id_jabatan,
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
                'nomor_karyawan' => 'required|unique:karyawan,nomor_karyawan',
                'name' => 'required|string|max:255',
                'email'         => 'required|email|unique:users,email,' . $request->user_id,
                'password'      => 'nullable|min:6',
            ]);

            $karyawan = Karyawan::findOrFail($id);
            $karyawan->update([
                'nomor_karyawan' => $validated['nomor_karyawan'],
                'name'  => $validated['name'],
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
