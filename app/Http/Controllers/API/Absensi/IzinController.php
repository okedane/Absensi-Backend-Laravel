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
            'tanggal_mulai'   => 'required|date',
            'tanggal_selesai' => 'required|date|after_or_equal:tanggal_mulai',
            'jenis_izin'      => 'required|in:sakit,cuti,izin,dispensasi,lainnya',
            'alasan'          => 'nullable|string',
        ]);

        $karyawanId = $request->user()->karyawan->id;

        // Tambahkan pengecekan izin bentrok
        $izinBentrok = Izin::where('karyawan_id', $karyawanId)
            ->where(function ($query) use ($validated) {
                $query
                    ->whereBetween('tanggal_mulai', [$validated['tanggal_mulai'], $validated['tanggal_selesai']])
                    ->orWhereBetween('tanggal_selesai', [$validated['tanggal_mulai'], $validated['tanggal_selesai']])
                    ->orWhere(function ($q) use ($validated) {
                        $q->where('tanggal_mulai', '<=', $validated['tanggal_mulai'])->where('tanggal_selesai', '>=', $validated['tanggal_selesai']);
                    });
            })
            ->exists();

        if ($izinBentrok) {
            return response()->json(
                [
                    'success' => false,
                    'message' => 'Anda sudah mengajukan izin pada rentang tanggal tersebut.',
                ],
                400,
            );
        }

        // Simpan izin jika aman
        $izin = Izin::create([
            'karyawan_id'       => $karyawanId,
            'tanggal_mulai'     => $validated['tanggal_mulai'],
            'tanggal_selesai'   => $validated['tanggal_selesai'],
            'jenis_izin'        => $validated['jenis_izin'],
            'alasan'            => $validated['alasan'] ?? null,
            'status'            => 'pending',
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Pengajuan izin berhasil disimpan.',
            'data' => $izin,
        ]);
    }

    // PUT /api/izin/{id}
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'tanggal_mulai'     => 'required|date',
            'tanggal_selesai'   => 'required|date|after_or_equal:tanggal_mulai',
            'jenis_izin'        => 'required|in:sakit,cuti,izin,dispen,lainnya',
            'alasan'            => 'nullable|string',
        ]);

        $izin = Izin::where('id', $id)
            ->where('karyawan_id', $request->user()->karyawan->id)
            ->first();

        if (!$izin) {
            return response()->json(
                [
                    'success' => false,
                    'message' => 'Data izin tidak ditemukan',
                ],
                404,
            );
        }

        if ($izin->status === 'disetujui') {
            return response()->json(
                [
                    'success' => false,
                    'message' => 'Izin yang sudah disetujui tidak dapat diubah',
                ],
                400,
            );
        }

        $izin->update([
            'tanggal_mulai' => $validated['tanggal_mulai'],
            'tanggal_selesai' => $validated['tanggal_selesai'],
            'jenis_izin' => $validated['jenis_izin'],
            'alasan' => $validated['alasan'] ?? null,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Izin berhasil diperbarui',
            'data' => $izin,
        ]);
    }

    // DELETE /api/izin/{id}
    public function destroy(Request $request, $id)
    {
        $izin = Izin::where('id', $id)
            ->where('karyawan_id', $request->user()->karyawan->id)
            ->first();

        if (!$izin) {
            return response()->json(
                [
                    'success' => false,
                    'message' => 'Data izin tidak ditemukan',
                ],
                404,
            );
        }

        if ($izin->status === 'disetujui') {
            return response()->json(
                [
                    'success' => false,
                    'message' => 'Izin yang sudah disetujui tidak dapat dihapus',
                ],
                400,
            );
        }

        $izin->delete();

        return response()->json([
            'success' => true,
            'message' => 'Izin berhasil dihapus',
        ]);
    }
}
