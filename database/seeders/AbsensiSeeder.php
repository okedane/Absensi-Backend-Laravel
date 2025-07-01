<?php

namespace Database\Seeders;

use App\Models\Absensi;
use App\Models\JadwalKerja;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;

class AbsensiSeeder extends Seeder
{
    public function run(): void
    {
        $data = [];

        // Mapping keterlambatan per karyawan
        $keterlambatanPerKaryawan = [
            // Chef
            1 => 125, 2 => 17, 3 => 10, 4 => 50, 5 => 5, 6 => 70, 7 => 5, 8 => 20,
            // Admin
            9 => 60, 10 => 5, 11 => 30, 12 => 130,
            // Waiter
            13 => 60, 14 => 5, 15 => 130, 16 => 120, 17 => 130,
            // Barista
            18 => 120, 19 => 60, 20 => 120, 21 => 15,
            // Security
            22 => 15, 23 => 50, 24 => 5,
            // Kurir
            25 => 15, 26 => 5, 27 => 5,
        ];

        // Kelompokkan jadwal kerja berdasarkan karyawan
        $jadwalsPerKaryawan = JadwalKerja::all()->groupBy('karyawan_id');

        foreach ($jadwalsPerKaryawan as $karyawanId => $jadwals) {
            // Pilih 1 jadwal secara acak yang akan dianggap terlambat
            $jadwalTerlambat = $jadwals->random();

            foreach ($jadwals as $jadwal) {
                $jamMasuk = Carbon::parse($jadwal->jam_masuk);

                if ($jadwal->id === $jadwalTerlambat->id) {
                    // Terlambat
                    $delay = $keterlambatanPerKaryawan[$karyawanId] ?? 0;
                    $jamAbsen = $jamMasuk->copy()->addMinutes($delay);
                    $status = 'terlambat';
                    $keterlambatan = $delay;
                } else {
                    // Tepat waktu
                    $jamAbsen = $jamMasuk;
                    $status = 'tepat waktu';
                    $keterlambatan = null;
                }

                $data[] = [
                    'karyawan_id' => $karyawanId,
                    'jadwal_kerja_id' => $jadwal->id,
                    'izin_id' => null,
                    'tanggal' => $jadwal->tanggal,
                    'shift' => $jadwal->shift,
                    'jam_absen' => $jamAbsen->format('H:i:s'),
                    'status' => $status,
                    'keterlambatan' => $keterlambatan,
                    'created_at' => now(),
                    'updated_at' => now(),
                ];
            }
        }

        Absensi::insert($data);
    }
}
