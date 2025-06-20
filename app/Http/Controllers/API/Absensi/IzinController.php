<?php

namespace App\Http\Controllers\API\Absensi;

use App\Http\Controllers\Controller;
use App\Models\Izin;
use Carbon\Carbon;
use Illuminate\Http\Request;

class IzinController extends Controller
{
    // GET /api/izin
    public function index(Request $request)
    {
        $izin = Izin::where('karyawan_id', $request->user()->karyawan->id)
            ->orderBy('created_at', 'desc')
            ->get();

        return response()->json([
            'success' => true,
            'data' => $izin,
        ]);
    }

    // POST /api/izin
    public function store(Request $request)
    {
        $validated = $request->validate([
            'tanggal_mulai' => 'required|date',
            'tanggal_selesai' => 'required|date|after_or_equal:tanggal_mulai',
            'jenis_izin' => 'required|in:sakit,cuti,lainnya',
            'alasan' => 'nullable|string',
            // file dokumen bisa ditambah nanti
        ]);

        $today = Carbon::now()->toDateString();
        $karyawanId = $request->user()->karyawan->id;

        $izin = Izin::where('karyawan_id', $karyawanId)
            ->where('status', 'disetujui')
            ->whereDate('tanggal_mulai', '<=', $today)
            ->whereDate('tanggal_selesai', '>=', $today)
            ->exists();

        if ($izin) {
            return response()->json([
                'success' => false,
                'message' => 'Hari ini Anda sedang dalam status izin, tidak perlu absen.'
            ], 400);
        }


        $izin = Izin::create([
            'karyawan_id' => $request->user()->karyawan->id,
            'tanggal_mulai' => $validated['tanggal_mulai'],
            'tanggal_selesai' => $validated['tanggal_selesai'],
            'jenis_izin' => $validated['jenis_izin'],
            'alasan' => $validated['alasan'] ?? null,
            'status' => 'pending',
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Pengajuan izin berhasil disimpan.',
            'data' => $izin,
        ]);
    }
}
