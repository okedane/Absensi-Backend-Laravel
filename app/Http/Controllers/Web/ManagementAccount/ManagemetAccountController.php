<?php

namespace App\Http\Controllers\Web\ManagementAccount;

use App\Http\Controllers\Controller;
use App\Models\Profile;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ManagemetAccountController extends Controller
{
    public function index()
    {
        $users = User::where('role', 'admin')->get();
        return view('managementAccount.index', compact('users'));
    }


    private function generateNomorAdmin()
    {
        // Gunakan DB lock untuk mencegah race condition
        return DB::transaction(function () {
            // Lock table untuk mencegah concurrent access
            $last = Profile::lockForUpdate()
                ->whereNotNull('nomor_admin')
                ->orderBy('nomor_admin', 'desc')
                ->first();

            if (!$last || !$last->nomor_admin) {
                return 'ADM001';
            }

            // Ambil angka dari belakang string (ADM001 -> 1)
            $lastNumber = (int) substr($last->nomor_admin, 3);

            // Langsung ambil nomor berikutnya
            $newNumber = $lastNumber + 1;

            // Format dengan 3 digit
            return 'ADM' . str_pad($newNumber, 3, '0', STR_PAD_LEFT);
        });
    }

    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'name'     => 'required',
                'email'    => 'required|email|unique:users,email',
                'password' => 'required|min:8|confirmed',
                'role'     => 'required|in:admin',
            ]);

            // Gunakan DB Transaction dengan retry
            $maxRetries = 3;
            $retryCount = 0;

            while ($retryCount < $maxRetries) {
                try {
                    return DB::transaction(function () use ($validated) {
                        // Generate nomor admin dengan lock
                        $nomorAdmin = $this->generateNomorAdmin();

                        // Buat user dulu
                        $user = User::create([
                            'name' => $validated['name'],
                            'email' => $validated['email'],
                            'password' => bcrypt($validated['password']),
                            'role' => $validated['role'],
                        ]);

                        // Buat profile dengan nomor admin
                        $user->profile()->create([
                            'nomor_admin' => $nomorAdmin,
                        ]);

                        return redirect()->back()->with('success', 'Admin berhasil ditambahkan dengan nomor: ' . $nomorAdmin);
                    });
                } catch (\Illuminate\Database\QueryException $e) {
                    // Jika error karena duplicate entry, coba lagi
                    if ($e->errorInfo[1] == 1062) { // MySQL duplicate entry error code
                        $retryCount++;
                        if ($retryCount >= $maxRetries) {
                            throw new \Exception('Gagal menambahkan admin setelah beberapa percobaan. Silakan coba lagi.');
                        }
                        // Sleep sebentar sebelum retry
                        usleep(200000); // 200ms
                        continue;
                    }
                    throw $e;
                }
            }
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'Terjadi kesalahan saat menambahkan Admin. ' . $th->getMessage());
        }
    }



    // ALTERNATIF: Jika Profile bisa null dan ingin handle kasus khusus


    public function update(Request $request, $id)
    {
        try {
            $validated = $request->validate([
                'name' => 'required|unique:users,name,' . $id,
                'email' => 'required|email|unique:users,email,' . $id,
                // 'password' => 'nullable|min:8',
            ]);

            $user = User::findOrFail($id);
            // `if ($request->password) {
            //     $user->password = bcrypt($request->password);
            // }`
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
