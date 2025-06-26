<?php

namespace App\Http\Controllers\Api\Absensi;

use App\Http\Controllers\Controller;
use App\Models\Lembur;
use Illuminate\Http\Request;

class LemburController extends Controller
{
    public function index(Request $request)
    {
        $lembur = Lembur::where('karyawan_id', $request->user()->karyawan->id)
           ->orderBy('tanggal', 'asc')
            ->get();


        if ($lembur->isEmpty()) {
            return response()->json([
                'success'   => false,
                'message'   => 'Tidak Meliliki Jadwal Lembur d'
            ]);
        }

        return response()->json([
            'success' => true,
            'data' => $lembur
        ]);
    }
}
