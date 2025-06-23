<?php

namespace App\Http\Controllers\Web\ManagementAccount;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class ManagemetAccountController extends Controller
{
    public function index()
    {
        $users = User::where('role', 'admin')->get();
        return view('managementAccount.index', compact('users'));
    }

    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'name'  => 'required',
                'email' => 'required|email|unique:users,email',
                'password' => 'required|min:8',
                'role' => 'required|in:admin',
            ]);


            $validated['password'] = bcrypt($validated['password']);


            User::create($validated);

            return redirect()->back()->with('success', 'Pengguna berhasil di tambahkan');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'Terjadi kesalahan saat menambahkan Pengguna. Silakan coba lagi.');
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $validated = $request->validate([
                'name' => 'required',
                'email' => 'required',
                'password' => 'nullable|min:8',
            ]);

            $user = User::findOrFail($id);
            if ($request->password) {
                $user->password = bcrypt($request->password);
            }
            $user->update($validated);

            return redirect()->back()->with('success', 'Pengguna berhasil diperbarui');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'Terjadi kesalahan saat memperbarui pengguna. Silakan coba lagi.');
        }
    }
    public function destroy($id)
    {
        $user = User::findOrfail($id);
        $user->delete();

        return back()->with('success', 'data telah dihapus');
    }
}
