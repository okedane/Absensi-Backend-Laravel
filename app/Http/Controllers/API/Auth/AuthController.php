<?php

namespace App\Http\Controllers\API\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (!auth()->attempt($credentials)) {
            return response()->json([
                'success' => false,
                'message' => 'Email atau password salah',
            ], 401);
        }

        $user = auth()->user();
        $token = $user->createToken('mobile_token')->plainTextToken;

        return response()->json([
            'success' => true,
            'message' => 'Login berhasil',
            'data' => [
                'user_id' => $user->id,
                'name' => $user->name,
                'email' => $user->email,
                'token' => $token
            ]
        ]);
    }

    public function me(Request $request)
    {
        $user = $request->user()->load('karyawan.jabatan');

        return response()->json([
            'success' => true,
            'data' => [
                'user' => [
                    'id' => $user->id,
                    'name' => $user->name,
                    'email' => $user->email,
                ],
                'karyawan' => [
                    'id' => $user->karyawan->id,
                    'nomor_karyawan' => $user->karyawan->nomor_karyawan,
                    'nama_karyawan' => $user->name,
                    'jabatan' => [
                        'id' => $user->karyawan->jabatan->id,
                        'nama_jabatan' => $user->karyawan->jabatan->nama_jabatan,
                    ]
                ]
            ]
        ]);
    }

    public function logout(Request $request)
    {
        $user = $request->user();
        $user->currentAccessToken()->delete();

        return response()->json([
            'success' => true,
            'message' => 'Logout berhasil'
        ]);
    }
}
